<?php

namespace App\Http\Livewire;

use App\Models\Admixture;
use App\Models\Fruit;
use App\Models\Meat;
use App\Models\Vegetable;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class Admixtures extends Component
{
    use WithPagination;
    protected $listeners = ['deleteAdmixture' => 'delete'];
    protected $paginationTheme = 'bootstrap', $admixtures;
    public $view = 'index', $order = 'id', $search = '', $pages = 10;
    public $orderItems = [], $thItems = [], $user = [], $roles = [], $typeSelected, $typeData = [];
    public $admixture, $type, $types, $meat = [], $fruit = [], $vegetable = [], $replaces = [], $data = [];

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'code' => 'Código',
            'name' => 'Nombre',
        ];
        $this->thItems = [
            'Código',
            'Descripción',
            'Nombre',
            'Reemplazo',
            'Stock'
        ];

        $this->types = Admixture::TYPES;
    }

    public function render()
    {
        $this->admixtures = Admixture::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.admixtures', [
            'admixtures' => $this->admixtures,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        return $this->view;
    }

    public function updatedAdmixtureType($type, $key, $admixtureId = '')
    {
        $this->typeSelected = $type;

        switch ($this->typeSelected) {
            case 1:
                $this->typeData[$this->typeSelected] = [
                    'classifications' => Fruit::CLASSIFICATIONS,
                    'preparations' => Fruit::PREPARATIONS,
                ];
                break;
            case 2:
                $this->typeData[$this->typeSelected] = [
                    'types' => Vegetable::TYPES
                ];
                break;
            case 3:
                $this->typeData[$this->typeSelected] = [
                    'types' => Meat::TYPE,
                ];
                break;
        }

        // $this->replaces = Admixture::searchReplaces($type)->whereNotIn('id', [$admixtureId])->toArray();
        return;
    }


    public function store()
    {
        $validations = validateAdmixtures();
        $validatedData = $this->validate($validations);
        $type = $this->types[$validatedData['admixture']['type']];
        unset($validatedData['admixture']['type']);

        $validatedType = $validatedData[$type['model']];
        $model = "App\Models\\" . ucfirst($type['model']);
        $admixtureType = $model::create($validatedType);
        $typeable = $admixtureType->type()->create();
        $admixture = $typeable->admixture()->create($validatedData['admixture']);
        $this->reset();
    }

    public function show(Admixture $admixture)
    {
        if ($admixture) {
            $this->view = "show";
            $this->type = $this->getType($admixture->admixtureType->typeable_type);
            $this->admixture = $admixture->toArray();
            $this->admixture['type'] = $this->type;
            $this->updatedAdmixtureType($this->admixture['type'], 1);
            switch ($this->admixture['type']) {
                case 1:
                    $this->fruit = $admixture->admixtureType->typeable->toArray();
                    break;
                case 2:
                    $this->vegetable = $admixture->admixtureType->typeable->toArray();
                    break;
                case 3:
                    $this->meat = $admixture->admixtureType->typeable->toArray();
                    break;
            }
            return $this->view;
        }
        return null;
    }

    public function getType($typeable_type)
    {
        $model = class_basename($typeable_type);
        $type = Arr::where($this->types, function ($value, $key) use ($model) {
            return $value['model'] == strtolower($model);
        });
        return key($type);
    }

    public function edit(Admixture $admixture)
    {
        if ($admixture) {
            $this->view = "edit";
            $this->type = $this->getType($admixture->admixtureType->typeable_type);
            $this->admixture = $admixture->load('admixtureType')->toArray();
            $this->admixture['type'] = $this->type;
            $this->updatedAdmixtureType($this->admixture['type'], 1);

            switch ($this->admixture['type']) {
                case 1:
                    $this->fruit = $admixture->admixtureType->typeable->toArray();
                    break;
                case 2:
                    $this->vegetable = $admixture->admixtureType->typeable->toArray();
                    break;
                case 3:
                    $this->meat = $admixture->admixtureType->typeable->toArray();
                    break;
            } //dd($this->vegetable);
            return $this->view;
        }
        return null;
    }

    public function update()
    {
        $admixture = Admixture::findOrfail($this->admixture['id']);
        if ($admixture) {
            $validations = validateAdmixtures();
            $validatedData = $this->validate($validations);
            $type = $this->types[$validatedData['admixture']['type']];
            unset($validatedData['admixture']['type']);
            unset($validatedData['admixture']['admixture_type']);
            $validatedType = $validatedData[$type['model']];
            $modelType = $admixture->admixtureType->typeable;
            if ($this->admixture['type'] != $this->type) {
                $model = "App\Models\\" . ucfirst($type['model']);
                $typeCreated = $model::create($validatedType);
                $admixtureType = $typeCreated->type()->create();
                $admixture->type_id =  $admixtureType->id;
                $admixture->save();
                $modelType->type()->delete();
                $modelType->delete();
                //$validatedData['admixture']['type_id'] = $admixtureType->id;
            } else {
                $modelType->update($validatedType);
            }
            $admixture->update($validatedData['admixture']);
            $this->back();
            return $admixture;
        }
        return null;
    }

    public function deleteConfirm($id)
    {
        $this->admixture = Admixture::find($id);

        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
    {
        $admixture = Admixture::find($this->admixture['id']);        
        $modelType = $admixture->admixtureType->typeable;
        if ($admixture) { 
            $admixture->type_id = null;
            $admixture->save();
            $modelType->type()->delete();
            $modelType->delete();
            $admixture->delete();
        }
    }

    public function back()
    {
        $this->resetValidation();
        return $this->reset();
    }
}
