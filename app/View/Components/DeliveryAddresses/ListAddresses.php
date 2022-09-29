<?php

namespace App\View\Components\DeliveryAddresses;

use Illuminate\View\Component;

class ListAddresses extends Component
{
    public $elements, $items;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($elements, array $items)
    {  
        $this->elements = $elements;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delivery-addresses.list-addresses');
    }
}
