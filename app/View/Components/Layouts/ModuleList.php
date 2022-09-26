<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class ModuleList extends Component
{
    public $elements, $module, $orderItems, $permission, $thItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, string $module = '', array $orderItems = [], array $thItems = [], string $permission)
    {   
        $this->elements = $elements;
        $this->module = $module;
        $this->orderItems = $orderItems;
        $this->permission = $permission;
        $this->thItems = $thItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.module-list');
    }
}
