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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->providers = Provider::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.providers', [
            'providers' => $this->providers,
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
     * Store a newly created resource in storage.
     *
     * @return Provider $provider
     */
    public function store(): Provider
    {
        $validations = validateProviders();
        $validatedData = $this->validate($validations);
        $provider = Provider::create($validatedData['provider']);
        $this->back();
        return $provider;
    }

    /**
     * Display  the specified resource.
     *
     * @param Provider $provider
     * @return Provider $provider|null
     */
    public function show(Provider $provider): Provider|null
    {
        if ($provider) {
            $this->view = "show";
            $this->provider = $provider->toArray();
            return $this->provider;
        }
        return null;
    }

    /**
     * Display  the specified resource.
     *
     * @param Provider $provider
     * @return Provider $provider|null
     */
    public function backShow(Provider $provider): Provider|null
    {
        if ($provider) {
            // $this->reset('deliveryAddress');
            return $this->show($provider);
        }
        return null;
    }

    /**
     * View to edit the specified resource.
     *
     * @param Provider $provider
     * @return Provider $provider|null
     */
    public function edit(Provider $provider): Provider|null
    {
        if ($provider) {
            $this->view = "edit";
            $this->provider = $provider->toArray();
            return $this->provider;
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return Provider $provider|null
     */
    public function update(): Provider|null
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

    /**
     * Display message delete.
     * 
     * @param integer $id
     * @return Provider $provider|null
     */
    public function deleteConfirm($id)
    {
        $this->provider =  Provider::find($id);
        if ($this->provider) {
            $this->dispatchBrowserEvent('delete_confirm');
            return $this->provider;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  void|null
     */
    public function delete(): void|null
    {
        $provider = Provider::find($this->provider['id']);
        if ($provider) {
            $provider->delete();
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
