<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class ListTableElements extends Component
{
    public $element, $module;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($element, string $module)
    {
        $this->element = $element;
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.list-table-elements');
    }
}
