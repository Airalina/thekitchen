<x-adminlte-modal id="form-permission" title="Permiso" size="lg" theme="olive" v-centered static-backdrop scrollable>
    <div><label>Permisos a seleccionar:</label></div>
    @if (!empty($permission))
        <div class="form-group">
            <p><label>Nombre: </label> {{ $permission['name'] }}</p>
        </div>
        @if (count($permission['options']) > 0)
            @php
                $config = [
                    'placeholder' => 'Select multiple options...',
                    'allowClear' => true,
                ];
            @endphp
            <x-adminlte-select2 id="permission" name="permission[]" label="Opciones" igroup-size="lg" :config="$config"
                wire:model.defer="dataPermissions.permissionsSelected.{{ $permission['name'] }}" multiple>
                @foreach ($permission['options'] as $option)
                    <option>{{ $option }}</option>
                @endforeach
                <x-slot name="bottomSlot">
                    <x-layouts.show-error error='options' />
                </x-slot>
            </x-adminlte-select2>
        @endif
    @endif
    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="olive" class='bg-olive' label="Aceptar"
            wire:click.prevent="addPermissions" />
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" />
    </x-slot>
</x-adminlte-modal>
