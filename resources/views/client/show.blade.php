<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Detalle del cliente</h3>
        </div>
        <form>
            <div class="card-body">
                <x-clients.form-client disabled='1' />
                <div class="m-2">
                    <x-delivery-addresses.list-addresses :items="$deliveryInformation"  :elements="$deliveryAddresses"  />
                </div>
            </div>
        </form>
        <x-layouts.form-buttons name='Cancelar' />
    </div>
</div>
