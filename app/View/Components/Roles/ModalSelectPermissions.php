<?php

namespace App\View\Components\Roles;

use Illuminate\View\Component;

class ModalSelectPermissions extends Component
{
    public $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.roles.modal-select-permissions');
    }
}
