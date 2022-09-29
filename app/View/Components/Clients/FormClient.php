<?php

namespace App\View\Components\Clients;

use Illuminate\View\Component;

class FormClient extends Component
{
    public $disabled, $module;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false, string $module = " ")
    {
        $this->disabled = $disabled;
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.clients.form-client');
    }
}
