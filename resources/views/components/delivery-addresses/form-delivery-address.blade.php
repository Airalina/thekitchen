<div class="mt-2">
    <x-adminlte-input name="location" label="Locación" id="location" placeholder="Locación"
        wire:model="deliveryAddress.location" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='deliveryAddress.location' />
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input name="province" label="Provincia" id="province" placeholder="Provincia"
        wire:model="deliveryAddress.province" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='deliveryAddress.province' />
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input name="country" label="País" id="country" placeholder="País"
        wire:model="deliveryAddress.country" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='deliveryAddress.country' />
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-input name="postcode" label="Código postal" id="postcode" placeholder="Código postal"
        wire:model="deliveryAddress.postcode" :disabled="$disabled">
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='deliveryAddress.postcode' />
        </x-slot>
    </x-adminlte-input>
</div>
