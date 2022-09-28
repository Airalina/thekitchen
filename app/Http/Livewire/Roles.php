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
    public $view = 'index', $order = 'id', $search = '', $pages = 10, $searchPermission = '', $roles, $role, $options;
    public $orderItems = [], $thItems = [], $user = [], $dataPermissions = [], $permission, $modules, $permissions;

    public function __construct()
    {
        $this->orderItems = [
            'id' => 'ID',
            'name' => 'Nombre'
        ];

        $this->permissions = Arr::undot(User::PERMISSIONS);
        /*  [$keys, $values] = Arr::divide(Arr::undot($permissions));
        $this->modules = $keys;  dd(Arr::undot($permissions));*/

        $this->dataPermissions = [
            'permissions' => $this->permissions,
            'permissionsSelected' => []
        ];

        $this->permission = [
            'name' => '',
            'options' => [],
        ];
    }

    public function render()
    {
        $this->roles = Role::all();

        return view('livewire.roles', [
            'roles' => $this->roles,
        ]);
    }

    public function create()
    {
        $this->view = 'create';
        return $this->view;
    }

    public function selectPermission($permissionName)
    {
        $this->permission = [
            'name' => $permissionName,
            'options' => $this->permissions[$permissionName],
        ];

        $this->dispatchBrowserEvent('show-form-permission');
        $this->resetValidation();
        return $this->permission;
    }

    public function addPermissions()
    {
        $this->dispatchBrowserEvent('hide-form-permission');
        $this->backModal();
    }

    public function store()
    {
        $validations = validateRoles();
        $validatedData = $this->validate($validations);
        $permissions = $this->getPermissions($validatedData['dataPermissions']['permissionsSelected']);
        $role =  Role::firstOrCreate($validatedData['role']);
        $role->givePermissionTo($permissions);

        $this->reset();
    }

    public function getPermissions(array $permissionsSelected)
    {
        $dataPermisions = collect($permissionsSelected);
        $permissionsSelected = $dataPermisions->flatten();
        foreach ($permissionsSelected as $permission) {
            $permissions[] = Permission::findOrCreate($permission);
        }
        return $permissions;
    }

    public function show(Role $role)
    {
        if ($role) {
            $this->view = "show";
            $this->role = $role->toArray();
            $this->dataPermissions = [
                'permissionsSelected' => [$role->getPermissionNames()->toArray()],
                'permissions' =>  [],
            ];
            return $this->view;
        }
        return null;
    }

    public function edit(Role $role)
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

    public function update()
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

    public function deleteConfirm($id)
    {
        // $this->user = User::find($id);

        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
    {
        /*  $user = User::find($this->user['id']);
        if ($user) {
            $user->delete();
        }*/
    }

    public function back()
    {
        return $this->reset();
    }

    public function backModal()
    {
        $this->resetValidation();
    }
}
