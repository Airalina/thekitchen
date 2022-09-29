<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Editar Rol</h3>
        </div>
        <form>
            <div class="card-body">
                <x-roles.form-role disabled='0' :dataPermissions="$dataPermissions" />
            </div>
        </form>
        <x-layouts.form-buttons method="update" name='Guardar' />
    </div>
</div>

<x-roles.modal-select-permissions :permission="$permission" />