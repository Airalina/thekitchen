<x-adminlte-input name="username" label="Nombre de usuario" id="username" placeholder="Nombre de usuario"
    wire:model="user.username" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.username' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="name" label="Nombre y apellido" id="name" placeholder="Nombre y apellido" wire:model="user.name"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.name' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="email" label="Email" type="email" id="email" placeholder="Email" wire:model="user.email"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.email' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="phone" label="Teléfono" id="phone" placeholder="Teléfono" wire:model="user.phone"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.phone' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="domicile" label="Domicilio" id="domicile" placeholder="Domicilio" wire:model="user.domicile"
    :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.domicile' />
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="dni" label="D.N.I" id="dni" placeholder="D.N.I" wire:model="user.dni" :disabled="$disabled">
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.dni' />
    </x-slot>
</x-adminlte-input>

@php
$config = [
    'placeholder' => 'Select multiple options...',
    'allowClear' => true,
];
@endphp
<x-adminlte-select2 id="role" name="role[]" label="Roles" igroup-size="lg" :config="$config" wire:model="user.rols"
    multiple :disabled="$disabled">
    @foreach ($roles as $role)
        <option>{{ $role['name'] }}</option>
    @endforeach
    <x-slot name="bottomSlot">
        <x-layouts.show-error error='user.rols' />
    </x-slot>
</x-adminlte-select2>

@if ($showPassword)
    <x-adminlte-input name="password" label="Contraseña" type="password" id="password" placeholder="Contraseña"
        wire:model="user.password" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='user.password' />
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input name="password_confirmation" label="Repetir contraseña" type="password" id="password_confirmation"
        placeholder="Repetir contraseña" wire:model="user.password_confirmation" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='user.password_confirmation' />
        </x-slot>
    </x-adminlte-input>
@endif
