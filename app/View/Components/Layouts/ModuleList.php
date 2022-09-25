<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class ModuleList extends Component
{
    public $elements, $module, $orderItems, $thItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, string $module = '', array $orderItems = [], array $thItems = [])
    {   
        $this->elements = $elements;
        $this->module = $module;
        $this->orderItems = $orderItems;
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
