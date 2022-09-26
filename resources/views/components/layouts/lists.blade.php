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
                    <td class="text-center">
                        @can("$permission.show")
                            <button type="button" wire:click="show({{ $element->id }})"
                                class="btn btn-primary btn-sm"><i class="fas fa-solid fa-eye"></i></button>
                        @endcan
                        @can("$permission.update")
                            <button type="button" wire:click="edit({{ $element->id }})"
                                class="btn btn-success btn-sm"><i class="fas fa-light fa-pen"></i></button>
                        @endcan
                        @can("$permission.delete")
                            <button type="button" wire:click="destroy({{ $element->id }})"
                                class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
                        @endcan
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
