<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class ListTableSimple extends Component
{
    public $elements, $items, $showButtons;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, array $items, bool $showButtons = false)
    {  
        $this->elements = $elements;
        $this->items = $items;
        $this->showButtons = $showButtons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.list-table-simple');
    }
}
