<div class="card">
    <!-- /.card-header -->
    @if (count($permissions) > 0)
        <div class="card-header">
            <h3 class="card-title">Seleccione permiso a ser agregado:</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $name => $permission)
                        <tr>
                            <td class="text-center">{{ $name }}</td>
                            <td><button type="button" wire:click="selectPermission('{{ $name }}')"
                                    class="btn btn-success btn-sm">Seleccionar</button></td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="100%" class="py-3 italic">No hay información</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-slot name="bottomSlot">
            <x-layouts.show-error error='user.dni' />
        </x-slot>
    @endif
    <!-- /.card-body -->
</div>
@if (!empty($permissionsSelected))
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permisos seleccionados:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permissionsSelected as $permissions)
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-center">{{ $permission }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr class="text-center">
                            <td colspan="100%" class="py-3 italic">No hay permisos seleccionados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endif
