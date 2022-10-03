<?php

namespace App\View\Components\Admixtures;

use Illuminate\View\Component;

class FormAdmixture extends Component
{
    public $disabled, $replaces, $types, $typeSelected, $typeData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false, array $replaces = [], array $types = [], array $typeData = [],  $typeSelected)
    {
        $this->disabled = $disabled;
        $this->replaces = $replaces;
        $this->types = $types;
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
        return view('components.admixtures.form-admixture');
    }
}
