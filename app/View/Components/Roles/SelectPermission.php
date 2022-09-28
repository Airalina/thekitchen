<?php

namespace App\View\Components\Roles;

use Illuminate\View\Component;

class SelectPermission extends Component
{
    public $permissions, $permissionsSelected, $searchPermission;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $permissions = [], array $permissionsSelected = [], string $searchPermission = '')
    {
        $this->permissions = $permissions;
        $this->permissionsSelected = $permissionsSelected;
        $this->searchPermission = $searchPermission;
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.roles.select-permission');
    }
}
