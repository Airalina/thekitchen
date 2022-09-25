<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class FormButtons extends Component
{
    public $method, $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $method = '', string $name = '')
    {
        $this->method = $method;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.form-buttons');
    }
}
