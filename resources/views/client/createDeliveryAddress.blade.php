<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Agregar direccion de entrega</h3>
        </div>
        <form>
            <div class="card-body">
                <x-delivery-addresses.form-delivery-address disabled="0" />
            </div>
        </form>
        <div class="card-footer">
            <div class="row justify-content-start">
                <div class="col-2 mr-4">
                    <x-adminlte-button label="Guardar" class='bg-olive'
                        wire:click="storeDeliveryAddress({{ $client['id'] }})" />
                </div>
                <div class="col-2">
                    <x-adminlte-button label="Cancelar" theme='danger' wire:click="backShow({{ $client['id'] }})" />
                </div>
            </div>
        </div>
    </div>
</div>
