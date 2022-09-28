<div class="card">
    <div class="card-header">
        <div class="row justify-content-between">
            <div class="col-2">
                <h3 class="card-title">{{ ucfirst($module) }} registrados</h3>
            </div>
            <div class="col-2 card-tools">
                <div class="input-group input-group-sm">
                    @if ($module != 'roles')
                        <x-adminlte-input name="search" placeholder="Buscar {{ $module }}..." igroup-size="sm"
                            wire:model="search">
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-olive">
                                    <i class="fas fa-search"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="row">
            <label class="float-left">{{ $module != 'roles' && $module != 'usuarios' ? 'Registros por página:' : '' }}</label>
        </div>
        <div class="row justify-content-between">
            <div class="col-2 w-50">
                @if ($module != 'roles' && $module != 'usuarios')
                <x-adminlte-input name="pages" placeholder="number" type="number" wire:model="pages" min=1>
                </x-adminlte-input>
                @endif
            </div>
            <div class="col-2">
                @can("$permission.create")
                    <div class="input-group input-group-sm">
                        <x-adminlte-button label="Crear {{ $module }}" class='bg-olive' wire:click="create" />
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <x-layouts.order-by :items="$orderItems" />
        <x-layouts.lists :elements="$elements" :items="$thItems" :module="$module" :permission="$permission" />
        {{ $module != 'roles' && $module != 'usuarios' ? $elements->links() : '' }}
    </div>
    <!-- /.card-body -->
</div>
