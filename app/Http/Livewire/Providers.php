<?php

namespace App\Http\Livewire;

use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;

class Providers extends Component
{
    use WithPagination;
    protected $listeners = ['deleteProvider' => 'delete'];
    protected $paginationTheme = 'bootstrap', $providers;
    public $view = 'index', $order = 'id', $search = '', $pages = 10;
    public $orderItems = [], $thItems = [], $provider = [];

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email',
            'cuit' => 'Cuit',
        ];
        $this->provider['status'] = true;
    }

    public function render()
    {
        $this->providers = Provider::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.providers', [
            'providers' => $this->providers,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        return $this->view;
    }

    public function store()
    {
        $validations = validateProviders();
        $validatedData = $this->validate($validations);
        $provider = Provider::create($validatedData['provider']);
        $this->back();
    }

    public function show(Provider $provider)
    {
        if ($provider) {
            $this->view = "show";
            $this->provider = $provider->toArray();
            return $this->view;
        }
        return null;
    }

    public function backShow(Provider $provider)
    {
        if ($provider) {
            // $this->reset('deliveryAddress');
            return $this->show($provider);
        }
        return null;
    }

    public function edit(Provider $provider)
    {
        if ($provider) {
            $this->view = "edit";
            $this->provider = $provider->toArray();
            return $this->view;
        }
        return null;
    }

    public function update()
    {
        $provider = Provider::findOrfail($this->provider['id']);
        if ($provider) {
            $validations = validateProviders();
            $validatedData = $this->validate($validations);
            $provider->update($validatedData['provider']);
            $this->back();
            return $provider;
        }
        return null;
    }

    public function deleteConfirm($id)
    {
        $this->provider =  Provider::find($id);
        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
    {
        $provider = Provider::find($this->provider['id']);
        if ($provider) {
            $provider->delete();
        }
    }

    public function back()
    {
        $this->resetValidation();
        return $this->reset();
    }
}
