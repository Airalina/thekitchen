<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Agregar Cliente</h3>
        </div>
        <form>
            <div class="card-body">
                <x-clients.form-client disabled="0" :module="$view" />
            </div>
        </form>
        <x-layouts.form-buttons method='store' name='Guardar' />
       
    </div>
</div>