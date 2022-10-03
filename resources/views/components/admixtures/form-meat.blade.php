<x-adminlte-select name="meatType" label="Tipo" id="meatType" :disabled="$disabled" wire:model="meat.type">
    <option selected value="" hidden>Seleccione una clasificación</option>
    @foreach ($typeData['types'] as $key => $type)
        <option value="{{ $key }}">{{ $type }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-input name="conservation" label="Conservacion" id="conservation" placeholder="Conservacion"
    wire:model="meat.conservation" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='meat.conservation' />
    </x-slot>
</x-adminlte-input>
