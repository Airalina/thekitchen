<?php

namespace App\View\Components\Admixtures;

use Illuminate\View\Component;

class FormVegetable extends Component
{
    public $typeData, $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $typeData = [], bool $disabled = false)
    {
        $this->typeData = $typeData;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admixtures.form-vegetable');
    }
}
