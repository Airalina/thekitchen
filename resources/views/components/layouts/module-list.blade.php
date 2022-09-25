<div class="card">
    <div class="card-header">
        <div class="row justify-content-between">
            <div class="col-2">
                <h3 class="card-title">{{ ucfirst($module) }} registrados</h3>
            </div>
            <div class="col-2 card-tools">
                <div class="input-group input-group-sm">
                    <input wire:model="search" type="text" class="form-control float-right"
                        placeholder="Buscar {{ $module }}...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <label class="float-left">Registros por página:</label>
        </div>
        <div class="row justify-content-between">
            <div class="col-2">
                <input type="number" min="1" wire:model="pages" class="form-control w-50">
            </div>
            <div class="col-2">
                <div class="input-group input-group-sm">
                    <x-adminlte-button label="Crear {{ $module }}" class='bg-olive' wire:click="create" />
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <x-layouts.order-by :items="$orderItems" />
        <x-layouts.lists :elements="$elements" :items="$thItems" :module="$module" />
        {{ $elements->links() }}
    </div>
    <!-- /.card-body -->
</div>
