<x-adminlte-input name="name" label="Nombre y apellido" id="name" placeholder="Nombre y apellido"
    wire:model="client.name" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.name' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="email" label="Email" type="email" id="email" placeholder="Email" wire:model="client.email"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.email' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="phone" label="Teléfono" id="phone" placeholder="Teléfono" wire:model="client.phone"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.phone' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="address" label="Domicilio" id="address" placeholder="Domicilio" wire:model="client.address"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.address' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="cuit" label="Cuit" id="dni" placeholder="Cuit" wire:model="client.cuit" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.cuit' />
    </x-slot>
</x-adminlte-input>

<div class="form-check">
    <input type="checkbox" class="form-check-input" id="status" wire:model="client.status" {{ $disabled ? 'disabled' : '' }}>
    <label class="form-check-label" for="status" >Estado</label>
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='client.status' />
    </x-slot>
</div>

@if ($module == 'create')
    <x-delivery-addresses.form-delivery-address :disabled="$disabled" />
@endif