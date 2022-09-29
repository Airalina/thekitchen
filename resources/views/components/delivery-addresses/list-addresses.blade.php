<div class="row justify-content-between mb-2">
    <div class="col-6">
        <label>Direcciones de entrega</label>
    </div>
    <div class="col-6">
        @can('client.create')
            <div class="input-group input-group-sm">
                <x-adminlte-button label="Crear domicilio" class='bg-olive' wire:click="createDeliveryAddress" />
            </div>
        @endcan
    </div>
</div>
<x-layouts.list-table-simple :items="$items" :elements="$elements" showButtons="1" />