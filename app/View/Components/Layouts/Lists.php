<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Lists extends Component
{
    public $elements, $items, $module;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, array $items, string $module)
    {   
        $this->elements = $elements;
        $this->items = $items;
        $this->module = $module;
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
