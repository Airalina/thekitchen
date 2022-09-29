<x-adminlte-input name="name" label="Nombre y apellido" id="name" placeholder="Nombre y apellido"
    wire:model="provider.name" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.name' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="email" label="Email" type="email" id="email" placeholder="Email" wire:model="provider.email"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.email' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="phone" label="Teléfono" id="phone" placeholder="Teléfono" wire:model="provider.phone"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.phone' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="address" label="Direccion" id="address" placeholder="Direccion" wire:model="provider.address"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.address' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="cuit" label="Cuit" id="dni" placeholder="Cuit" wire:model="provider.cuit" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.cuit' />
    </x-slot>
</x-adminlte-input>

<div class="form-check">
    <input type="checkbox" class="form-check-input" id="status" wire:model="provider.status"
        {{ $disabled ? 'disabled' : '' }}>
    <label class="form-check-label" for="status">Estado</label>
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='provider.status' />
    </x-slot>
</div>

<x-adminlte-input name="url" label="Url" wire:model="provider.url" :disabled="$disabled">
    <x-slot name="prependSlot">
        <div class="input-group-text">
            www
        </div>
    </x-slot>
    <x-slot name="bottomSlot">
        <span class="text-sm text-gray">
            [www.example.com]
        </span>
        <x-layouts.show-error error='provider.url' />
    </x-slot>
</x-adminlte-input>
