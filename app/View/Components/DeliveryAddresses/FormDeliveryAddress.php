<?php

namespace App\View\Components\DeliveryAddresses;

use Illuminate\View\Component;

class FormDeliveryAddress extends Component
{
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delivery-addresses.form-delivery-address');
    }
}
