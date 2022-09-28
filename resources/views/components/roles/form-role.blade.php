<x-adminlte-input name="name" label="Nombre de rol" id="name" placeholder="Nombre de rol" wire:model="role.name"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='role.name' />
    </x-slot>
</x-adminlte-input>
@php
$config = [
    'placeholder' => 'Select multiple options...',
    'allowClear' => true,
]
@endphp

<x-roles.select-permission :permissions="$dataPermissions['permissions']" :permissionsSelected="$dataPermissions['permissionsSelected']"  />