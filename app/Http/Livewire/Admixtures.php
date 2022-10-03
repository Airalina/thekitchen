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
    public $orderItems = [], $thItems = [], $user = [], $roles = [], $meat = [], $fruit = [], $vegetable = [], $replaces = [],
        $data = [], $typeData = [];
    public $admixture, $type, $types, $typeSelected;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->admixtures = Admixture::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.admixtures', [
            'admixtures' => $this->admixtures,
        ]);
    }

    /**
     * View to create a resource in storage.
     *
     * @return string $view
     */
    public function create(): string
    {
        $this->view = 'create';
        return $this->view;
    }

    /**
     * View to create a resource in storage.
     *
     * @param integer $type, integer $key, string $admixtureId 
     * @return string $view
     */
    public function updatedAdmixtureType($type, $key, $admixtureId = ''): int
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
        return $this->typeSelected;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Admixture $admixture
     */
    public function store(): Admixture
    {
        $validations = validateAdmixtures();
        $validatedData = $this->validate($validations);
        $type = $this->types[$validatedData['admixture']['type']];
        unset($validatedData['admixture']['type']);

        $validatedType = $validatedData[$type['model']];
        $model = "App\Models\\" . ucfirst($type['model']);
        //create type
        $admixtureType = $model::create($validatedType);
        //syncronize
        $typeable = $admixtureType->type()->create();
        //create admixture
        $admixture = $typeable->admixture()->create($validatedData['admixture']);
        $this->reset();

        return $admixture;
    }

    /**
     * Display  the specified resource.
     *
     * @param Admixture $admixture
     * @return Admixture $admixture|null
     */
    public function show(Admixture $admixture): Admixture|null
    {
        if ($admixture) {
            $this->view = "show";
            $this->type = $this->getType($admixture->admixtureType->typeable_type);
            $this->admixture = $admixture->toArray();
            $this->admixture['type'] = $this->type;
            $this->updatedAdmixtureType($this->admixture['type'], 1);
            $model = ($this->admixture['type'] == 1) ? 'fruit' : ($this->admixture['type'] == 2 ? 'vegetable' : 'meat');
            $this->$model = $admixture->admixtureType->typeable->toArray();
            return $this->admixture;
        }
        return null;
    }

    /**
     * Display  the specified resource.
     *
     * @param object $typeable_type
     * @return int $type
     */
    public function getType($typeable_type): int
    {
        $model = class_basename($typeable_type);
        $type = Arr::where($this->types, function ($value, $key) use ($model) {
            return $value['model'] == strtolower($model);
        });
        return key($type);
    }

    /**
     * View to edit the specified resource.
     *
     * @param Admixture $admixture
     * @return Admixture $admixture|null
     */
    public function edit(Admixture $admixture): Admixture|null
    {
        if ($admixture) {
            $this->view = "edit";
            $this->type = $this->getType($admixture->admixtureType->typeable_type);
            $this->admixture = $admixture->load('admixtureType')->toArray();
            $this->admixture['type'] = $this->type;
            $this->updatedAdmixtureType($this->admixture['type'], 1);
            $model = ($this->admixture['type'] == 1) ? 'fruit' : ($this->admixture['type'] == 2 ? 'vegetable' : 'meat');
            $this->$model = $admixture->admixtureType->typeable->toArray();
            return $this->admixture;
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return Admixture $admixture|null
     */
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
            } else {
                $modelType->update($validatedType);
            }
            $admixture->update($validatedData['admixture']);
            $this->back();
            return $admixture;
        }
        return null;
    }

    /**
     * Display message delete.
     * 
     * @param integer $id
     * @return Admixture $admixture|null
     */
    public function deleteConfirm($id)
    {
        $this->admixture = Admixture::find($id);

        $this->dispatchBrowserEvent('delete_confirm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  void|null
     */
    public function delete(): void|null
    {
        $admixture = Admixture::find($this->admixture['id']);
        $modelType = $admixture->admixtureType->typeable;
        if ($admixture) {
            $admixture->type_id = null;
            $admixture->save();
            $modelType->type()->delete();
            $modelType->delete();
            $admixture->delete();
            return;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function back(): void
    {
        $this->resetValidation();
        $this->reset();
        return;
    }
}
