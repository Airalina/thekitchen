<?php

namespace App\View\Components\Roles;

use Illuminate\View\Component;

class FormRole extends Component
{
    public $dataPermissions, $disabled, $searchPermission;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $dataPermissions = [], bool $disabled = false, string $searchPermission = '')
    {
        $this->dataPermissions = $dataPermissions;
        $this->disabled = $disabled;
        $this->searchPermission = $searchPermission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.roles.form-role');
    }
}
