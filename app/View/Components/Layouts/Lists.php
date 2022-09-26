<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Lists extends Component
{
    public $elements, $items, $module, $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, array $items, string $module, string $permission)
    {   
        $this->elements = $elements;
        $this->items = $items;
        $this->module = $module;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.lists');
    }
}
