<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap', $users;
    public $view = 'index', $order = 'id', $search = '', $pages = 10;
    public $orderItems = [], $thItems = [], $user = [], $roles = [];


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
        $this->roles = Role::all()->toArray(); 
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

    public function store()
    {  
        $validations = validateUsers();
        $validatedData = $this->validate($validations);  
        $validatedData['user']['password'] = Hash::make($validatedData['user']['password']);
        $user = User::create($validatedData['user']);
        $user->assignRole($validatedData['user']['roles']);
        $this->emit('userStore');
        $this->reset();
    }

    public function show(User $user)
    {
        if ($user) {
            $this->view = "show";
            $this->user = $this->fillData($user);
           
            return $this->view;
        }
        return null;
    }

    
    public function fillData(User $user)
    {
        if ($user) {
            $user = [
                'name' => $user->name,
                'email' => $user->email, 
                'dni' => $user->dni, 
                'domicile' => $user->domicile, 
                'phone' => $user->phone, 
                'username' => $user->username, 
                'roles' => $user->getRoleNames()
            ];

            return $user;
        }
        return null;
    }


    public function back()
    {
        return $this->reset();
    }
}
