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
        //users data
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->roles = Role::all()->toArray();
        $this->users = User::search($this->search, $this->order)->paginate($this->pages);

        return view('livewire.users', [
            'users' => $this->users,
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
     * @return User $user
     */
    public function store(): User
    {
        $validations = validateUsers($this->view);
        $validatedData = $this->validate($validations);
        $validatedData['user']['password'] = Hash::make($validatedData['user']['password']);
        $user = User::create($validatedData['user']);
        $user->assignRole($validatedData['user']['rols']);
        $this->reset();
        return $user;
    }

    /**
     * Display  the specified resource.
     *
     * @param User $user
     * @return User $user|null
     */
    public function show(User $user): User|null
    {
        if ($user) {
            $this->view = "show";
            $this->user = $user->toArray();
            return $this->user;
        }
        return null;
    }

    /**
     * View to edit the specified resource.
     *
     * @param User $user
     * @return User $user|null
     */
    public function edit(User $user)
    {
        if ($user) {
            $this->view = "edit";
            $this->user = $user->toArray();
            return $this->user;
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return User $user|null
     */
    public function update(): User|null
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

    /**
     * Display message delete.
     * 
     * @param integer $id
     * @return User $user|null
     */
    public function deleteConfirm($id): User|null
    {
        $this->user = User::find($id);
        if ($this->user) {
            $this->dispatchBrowserEvent('delete_confirm');
            return $this->user;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  void|null
     */
    public function delete() : void|null
    {
        $user = User::find($this->user['id']);
        if ($user) {
            $user->delete();
            return;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function back() : void
    {
        $this->resetValidation();
        $this->reset();
        return; 
    }
}
