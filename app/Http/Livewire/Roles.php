<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    protected $listeners = ['deleteRole' => 'delete'];
    protected $paginationTheme = 'bootstrap';
    public $view = 'index', $order = 'id', $search = '', $pages = 10, $searchPermission = '';
    public $orderItems = [], $thItems = [], $user = [], $dataPermissions = [];
    public  $roles, $role, $options, $permission, $modules, $permissions;

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre'
        ];
        $this->permissions = Arr::undot(User::PERMISSIONS);
        $this->dataPermissions = [
            'permissions' => $this->permissions,
            'permissionsSelected' => []
        ];
        $this->permission = [
            'name' => '',
            'options' => [],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->roles = Role::all();

        return view('livewire.roles', [
            'roles' => $this->roles,
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
     * Permission's selection.
     *
     * @param string $permissionName
     * @return array $permission
     */
    public function selectPermission($permissionName): array
    {
        $this->permission = [
            'name' => $permissionName,
            'options' => $this->permissions[$permissionName],
        ];

        $this->dispatchBrowserEvent('show-form-permission');
        $this->resetValidation();
        return $this->permission;
    }

    /**
     * Adding permission.
     *
     * @return void
     */
    public function addPermissions(): void
    {
        $this->dispatchBrowserEvent('hide-form-permission');
        $this->backModal();
        return;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Role $role
     */
    public function store(): Role
    {
        $validations = validateRoles();
        $validatedData = $this->validate($validations);
        $permissions = $this->getPermissions($validatedData['dataPermissions']['permissionsSelected']);
        $role =  Role::firstOrCreate($validatedData['role']);
        $role->givePermissionTo($permissions);
        $this->reset();
        return $role;
    }

    /**
     * Get permission's list.
     *
     * @param array $permissionsSelected
     * @return array $permissions
     */
    public function getPermissions(array $permissionsSelected): array
    {
        $dataPermisions = collect($permissionsSelected);
        $permissionsSelected = $dataPermisions->flatten();
        foreach ($permissionsSelected as $permission) {
            $permissions[] = Permission::findOrCreate($permission);
        }
        return $permissions;
    }

    /**
     * Display  the specified resource.
     *
     * @param Role $role
     * @return Role $role|null
     */
    public function show(Role $role): Role|null
    {
        if ($role) {
            $this->view = "show";
            $this->role = $role->toArray();
            $this->dataPermissions = [
                'permissionsSelected' => [$role->getPermissionNames()->toArray()],
                'permissions' =>  [],
            ];
            return $this->role;
        }
        return null;
    }

    /**
     * View to edit the specified resource.
     *
     * @param Role $role
     * @return Role $role|null
     */
    public function edit(Role $role): Role|null
    {
        if ($role) {
            $this->view = "edit";
            $this->role = $role->toArray();
            $permissionsNames = $role->getPermissionNames();
            foreach ($permissionsNames as $permission) {
                $key = explode(".", $permission);
                $permissions[$key[0]][$permission] = $permission;
            }
            $this->dataPermissions['permissionsSelected'] = $permissions;
            return $this->view;
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return Role $role|null
     */
    public function update(): Role|null
    {
        $role = Role::find($this->role['id']);
        if ($role) {
            $validations = validateRoles();
            $validatedData = $this->validate($validations);
            $role->update($validatedData['role']);
            $role->syncPermissions([]);
            $permissions = $this->getPermissions($validatedData['dataPermissions']['permissionsSelected']);
            $role->givePermissionTo($permissions);
            $this->reset();
            return $role;
        }
        return null;
    }

    /**
     * Display message delete.
     * 
     * @param integer $id
     * @return Role $role|null
     */
    public function deleteConfirm($id)
    {
        $this->role = Role::find($id);
        if ($this->role) {
            $this->dispatchBrowserEvent('delete_confirm');
            return $this->role;
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function delete() : void|null
    {
        $role = Role::find($this->role['id']);
        if ($role) {
            $role->delete();
            return;
        }
        return null
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function back() : void|null
    {
        $this->resetValidation();
        $this->reset();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function backModal() : void
    {
        $this->resetValidation();
        return;
    }
}
