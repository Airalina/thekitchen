<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Agregar Usuario</h3>
        </div>
        <form>
            <div class="card-body">
                <x-users.form-user disabled='0' :roles="$roles"  />
            </div>
        </form>
        <x-layouts.form-buttons method='store' name='Guardar' />
    </div>
</div>
