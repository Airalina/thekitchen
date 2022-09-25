<div>
    <table class="table table-head table-sm">
        <thead>
            <tr>
                @foreach ($items as $item)
                    <th class="text-center">{{ $item }}</th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($elements as $element)
                <tr>
                    <x-layouts.list-table-elements :element="$element" :module="$module" />
                    <td style="text-align: center">
                        <button type="button" wire:click="detail({{ $element->id }})"
                            class="btn btn-primary btn-sm">Ver</button>
                        <button type="button" wire:click="edit({{ $element->id }})"
                            class="btn btn-success btn-sm">Actualizar</button>
                        <button type="button" wire:click="destroy({{ $element->id }})"
                            class="btn btn-danger btn-sm">Borrar</button>
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="100%" class="py-3 italic">No hay información</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
