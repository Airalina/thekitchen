<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Editar Rol</h3>
        </div>
        <form>
            <div class="card-body">
                <x-admixtures.form-admixture disabled='0' :types="$types" :typeSelected="$typeSelected" :typeData="$typeData"
                    :replaces="$replaces" />
            </div>
        </form>
        <x-layouts.form-buttons method="update" name='Guardar' />
    </div>
</div>
