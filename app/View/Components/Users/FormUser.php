<?php

namespace App\View\Components\Users;

use Illuminate\View\Component;

class FormUser extends Component
{
    public $disabled, $roles, $showPassword;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false, array $roles, bool $showPassword = true)
    {
        $this->disabled = $disabled;
        $this->roles = $roles;
        $this->showPassword = $showPassword;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.users.form-user');
    }
}
