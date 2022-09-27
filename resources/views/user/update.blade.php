<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Editar Usuario</h3>
        </div>
        <form>
            <div class="card-body">
                <x-users.form-user disabled='0' showPassword='0' :roles="$roles"  />
            </div>
        </form>
        <x-layouts.form-buttons method="update" name='Guardar' />
    </div>
</div>
