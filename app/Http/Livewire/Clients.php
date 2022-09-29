<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination;
    protected $listeners = ['deleteClient' => 'delete'];
    protected $paginationTheme = 'bootstrap', $clients;
    public $view = 'index', $order = 'id', $search = '', $pages = 10;
    public $orderItems = [], $thItems = [], $client = [], $deliveryAddress, $deliveryAddresses = [];
    public $deliveryInformation;

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

    public function render()
    {
        $this->clients = Client::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.clients', [
            'clients' => $this->clients,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        return $this->view;
    }

    public function store()
    {
        $validations = validateClients();
        $validatedData = $this->validate($validations);
        $client = Client::create($validatedData['client']);
        if ($client) {
            $this->storeDeliveryAddress($client);
        }
        $this->back();
    }

    public function createDeliveryAddress()
    {
        $this->view = 'createDeliveryAddress';
        return $this->view;
    }


    public function storeDeliveryAddress(Client $client)
    {
        $validations = validateDeliveryAddresses();
        $validatedData = $this->validate($validations);
        $deliveryAddress = $client->deliveryAddresses()->updateOrCreate($validatedData['deliveryAddress']);
        ($this->view == 'create') ? $this->back() : $this->backShow($client);
        return $deliveryAddress;
    }

    public function show(Client $client)
    {
        if ($client) {
            $this->view = "show";
            $this->client = $client->toArray();
            $this->deliveryAddresses = $client->deliveryAddresses->toArray();
            return $this->view;
        }
        return null;
    }

    public function backShow(Client $client)
    {
        if ($client) {
            $this->reset('deliveryAddress');
            return $this->show($client);
        }
        return null;
    }

    public function edit(Client $client)
    {
        if ($client) {
            $this->view = "edit";
            $this->client = $client->toArray();
            return $this->view;
        }
        return null;
    }

    public function editDeliveryAddress($deliveryAddressId)
    {
        $client = Client::find($this->client['id']);
        if ($client) {
            $this->deliveryAddress = $client->deliveryAddresses()->whereId($deliveryAddressId)->first()->toArray();
            $this->view = "editDeliveryAddress";
            return $this->view;
        }
        return null;
    }
    public function updateDeliveryAddress(Client $client)
    {
        $validations = validateDeliveryAddresses();
        $validatedData = $this->validate($validations);
        $deliveryAddress = $client->deliveryAddresses()->updateOrCreate(
            [
                'id' => $this->deliveryAddress['id']
            ],
            $validatedData['deliveryAddress']
        );
        $this->backShow($client);
    }

    public function update()
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

    public function deleteConfirm($id)
    {
        $cliendId = ($this->view == 'index') ? $id : $this->client['id'];
        $this->client =  Client::find($cliendId);
        $this->deliveryAddress['id'] = $id;
        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
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
        }
    }

    public function back()
    {
        $this->resetValidation();
        return $this->reset();
    }
}
