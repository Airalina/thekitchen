<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Editar cliente</h3>
        </div>
        <form>
            <div class="card-body">
                <x-clients.form-client disabled='0' />
            </div>
        </form>
        <x-layouts.form-buttons method="update" name='Guardar' />
    </div>
</div>