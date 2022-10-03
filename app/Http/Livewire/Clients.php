<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\DeliveryAddress;
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination;
    protected $listeners = ['deleteClient' => 'delete'];
    protected $paginationTheme = 'bootstrap', $clients;
    public $view = 'index', $order = 'id', $search = '', $pages = 10;
    public $orderItems = [], $thItems = [], $client = [], $deliveryAddresses = [];
    public $deliveryInformation, $deliveryAddress;

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email',
            'cuit' => 'Cuit',
        ];
        $this->deliveryInformation = ['Localidad', 'Provincia', 'País', 'Código postal'];
        $this->client['status'] = true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->clients = Client::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.clients', [
            'clients' => $this->clients,
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
     * @return Client $client
     */
    public function store(): Client
    {
        $validations = validateClients();
        $validatedData = $this->validate($validations);
        $client = Client::create($validatedData['client']);
        if ($client) {
            $this->storeDeliveryAddress($client);
        }
        $this->back();
        return $client;
    }

    /**
     * View to create a resource in storage.
     *
     * @return string $view
     */
    public function createDeliveryAddress(): string
    {
        $this->view = 'createDeliveryAddress';
        return $this->view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Client $client
     * @return DeliveryAddress $deliveryAddress
     */
    public function storeDeliveryAddress(Client $client): DeliveryAddress
    {
        $validations = validateDeliveryAddresses();
        $validatedData = $this->validate($validations);
        $deliveryAddress = $client->deliveryAddresses()->updateOrCreate($validatedData['deliveryAddress']);
        ($this->view == 'create') ? $this->back() : $this->backShow($client);
        return $deliveryAddress;
    }

    /**
     * Display  the specified resource.
     *
     * @param Client $client
     * @return Client $client|null
     */
    public function show(Client $client): Client|null
    {
        if ($client) {
            $this->view = "show";
            $this->client = $client->toArray();
            $this->deliveryAddresses = $client->deliveryAddresses->toArray();
            return $this->client;
        }
        return null;
    }


    /**
     * Display  the specified resource.
     *
     * @param Client $client
     * @return Client $client|null
     */
    public function backShow(Client $client): Client|null
    {
        if ($client) {
            $this->reset('deliveryAddress');
            return $this->show($client);
        }
        return null;
    }

    /**
     * View to edit the specified resource.
     *
     * @param Client $client
     * @return Client $client|null
     */
    public function edit(Client $client): Client|null
    {
        if ($client) {
            $this->view = "edit";
            $this->client = $client->toArray();
            return $this->client;
        }
        return null;
    }

    /**
     * View to edit the specified resource.
     *
     * @param integer $deliveryAddressId
     * @return DeliveryAddress $deliveryAddress|null
     */
    public function editDeliveryAddress($deliveryAddressId) : Client|null
    {
        $client = Client::find($this->client['id']);
        if ($client) {
            $this->deliveryAddress = $client->deliveryAddresses()->whereId($deliveryAddressId)->first()->toArray();
            $this->view = "editDeliveryAddress";
            return $this->deliveryAddress;
        }
        return null;
    }


    /**
     * Update the specified resource in storage.
     * 
     * @param Client $client
     * @return Client $client|null
     */
    public function updateDeliveryAddress(Client $client) : Client|null
    {
        $validations = validateDeliveryAddresses();
        $validatedData = $this->validate($validations);
        $deliveryAddress = $client->deliveryAddresses()->updateOrCreate(
            [
                'id' => $this->deliveryAddress['id']
            ],
            $validatedData['deliveryAddress']
        );
        return $this->backShow($client);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return Client $client|null
     */
    public function update(): Client|null
    {
        $client = Client::findOrfail($this->client['id']);
        if ($client) {
            $validations = validateClients();
            $validatedData = $this->validate($validations);
            $client->update($validatedData['client']);
            $this->back();
            return $client;
        }
        return null;
    }

    /**
     * Display message delete.
     * 
     * @param integer $id
     * @return Client $client|null
     */
    public function deleteConfirm($id): Client|null
    {
        $cliendId = ($this->view == 'index') ? $id : $this->client['id'];
        $this->client =  Client::find($cliendId);
        if ($this->client) {
            $this->deliveryAddress['id'] = $id;
            $this->dispatchBrowserEvent('delete_confirm');
            return $this->client;
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
        $client = Client::find($this->client['id']);
        if ($client) {
            if ($this->view == 'show') {
                $deliveryAddress = $this->client->deliveryAddresses()->whereId($this->deliveryAddress['id'])->first();
                $deliveryAddress->delete();
                return $this->show($client);
            }
            foreach ($client->deliveryAddresses as $address) {
                $address->delete();
            }
            $client->delete();
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
