<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap', $users;
    public $view = 'list', $order = 'id', $search = '',$pages = 10;
    public $orderItems = [], $thItems = [];

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email'
        ];
        //$this->thItems = ['Código', 'Descripción', 'Cliente', 'Precio U$D', 'Fecha de Ingreso'];
        
    }

    public function render()
    {  
        $this->users = User::search($this->search)->paginate($this->pages);
        
        return view('livewire.users', [
            'users' => $this->users,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        return $this->view;
    }
    
}
