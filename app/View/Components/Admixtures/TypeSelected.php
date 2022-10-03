<?php

namespace App\View\Components\Admixtures;

use Illuminate\View\Component;

class TypeSelected extends Component
{
    public $disabled, $replaces, $typeSelected, $typeData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false, array $replaces = [], array $typeData, $typeSelected)
    {
        $this->disabled = $disabled;
        $this->replaces = $replaces;
        $this->typeData = $typeData;
        $this->typeSelected = $typeSelected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admixtures.type-selected');
    }
}
