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
    protected $listeners = ['deleteUser' => 'delete'];
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
        $validations = validateUsers($this->view);
        $validatedData = $this->validate($validations);
        $validatedData['user']['password'] = Hash::make($validatedData['user']['password']);
        $user = User::create($validatedData['user']);
        $user->assignRole($validatedData['user']['rols']);
        $this->reset();
    }

    public function show(User $user)
    {
        if ($user) {
            $this->view = "show";
            $this->user = $user->toArray();
            return $this->view;
        }
        return null;
    }

    public function edit(User $user)
    {
        if ($user) {
            $this->view = "edit";
            $this->user = $user->toArray();
            return $this->view;
        }
        return null;
    }

    public function update()
    {
        $user = User::findOrfail($this->user['id']);
        if ($user) {
            $validations = validateUsers();
            $validatedData = $this->validate($validations);
            $user->update($validatedData['user']);
            $user->syncRoles([]);
            $user->assignRole($validatedData['user']['rols']);
            $this->reset();
            return $user;
        }
        return null;
    }

    public function deleteConfirm($id)
    {
        $this->user = User::find($id);

        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
    {
        $user = User::find($this->user['id']);
        if ($user) {
            $user->delete();
        }
    }

    public function back()
    {
        return $this->reset();
    }
}
