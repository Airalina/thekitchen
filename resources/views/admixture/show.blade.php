<div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-olive">
        <div class="card-header">
            <h3 class="card-title">Detalle del ingrediente</h3>
        </div>
        <form>
            <div class="card-body">
                <x-admixtures.form-admixture disabled='1' :types="$types" :typeSelected="$typeSelected" :typeData="$typeData"
                :replaces="$replaces"  />
            </div>
        </form>
        <x-layouts.form-buttons name='Cancelar' />
    </div>
</div>
