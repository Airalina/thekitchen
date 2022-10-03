<x-adminlte-select name="classification" label="Clasificación" id="classification" :disabled="$disabled" wire:model="fruit.classification">
    <option selected value="" hidden>Seleccione una clasificación</option>
    @foreach ($typeData['classifications'] as $key => $classification)
        <option value="{{ $key }}">{{ $classification }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-select name="preparation" label="Preparación"  id="preparation" :disabled="$disabled" wire:model="fruit.preparation">
    <option selected value="" hidden>Seleccione una preparación</option>
    @foreach ($typeData['preparations'] as $key => $preparation)
        <option value="{{ $key }}">{{ $preparation }}</option>
    @endforeach
</x-adminlte-select>
