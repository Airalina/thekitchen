<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Detalle del rol</h3>
        </div>
        <form>
            <div class="card-body">
                <x-roles.form-role disabled='1' :dataPermissions="$dataPermissions" />
            </div>
        </form>
        <x-layouts.form-buttons name='Cancelar' />
    </div>
</div>
