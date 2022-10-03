<x-adminlte-input name="code" label="Codigo" id="code" placeholder="Codigo" wire:model="admixture.code"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='admixture.code' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="name" label="Nombre" id="name" placeholder="Nombre" wire:model="admixture.name"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='admixture.name' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-textarea name="description" label="Descripcion" rows=5 wire:model="admixture.description" igroup-size="sm"
    placeholder="Inserte descripcion..." :disabled="$disabled">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-dark">
            <i class="fas fa-lg fa-file-alt"></i>
        </div>
    </x-slot>
</x-adminlte-textarea>

<x-adminlte-select name="admixtureType" id="admixtureType" label="Tipo" :disabled="$disabled" wire:model="admixture.type">
    <option selected value="" hidden>Seleccione un tipo de ingrediente</option>
    @foreach ($types as $key => $type)
        <option value="{{ $key }}">{{ $type['name'] }}</option>
    @endforeach
</x-adminlte-select>

<x-admixtures.type-selected :typeSelected="$typeSelected" :typeData="$typeData" :replaces="$replaces" :disabled="$disabled" />

<x-adminlte-input name="stock" label="Stock" id="stock" placeholder="Stock" wire:model="admixture.stock" :disabled="$disabled"  >
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='admixture.stock' />
    </x-slot>
</x-adminlte-input>
