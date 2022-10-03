<x-adminlte-select name="vegetableType" label="Tipo"  id="vegetableType" :disabled="$disabled" wire:model="vegetable.type">
    <option selected value="" hidden>Seleccione una clasificación</option>
    @foreach ($typeData['types'] as $key => $type)
        <option value="{{ $key }}">{{ $type }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-input name="derivation" label="Derivacion" id="derivation" placeholder="Derivacion"
    wire:model="vegetable.derivation" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='vegetable.derivation' />
    </x-slot>
</x-adminlte-input>