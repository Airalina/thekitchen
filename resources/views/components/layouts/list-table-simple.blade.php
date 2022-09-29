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
                    <td class="text-center">{{ $element['location'] }}</td>
                    <td class="text-center">{{ $element['province'] }}</td>
                    <td class="text-center">{{ $element['country'] }}</td>
                    <td class="text-center">{{ $element['postcode'] }}</td>
                    <td class="text-center">
                        @if ($showButtons)
                            <button type="button" wire:click="editDeliveryAddress({{ $element['id'] }})"
                                class="btn btn-success btn-sm"><i class="fas fa-light fa-pen"></i></button>
                            <button type="button" wire:click="deleteConfirm({{ $element['id'] }})"
                                class="btn btn-danger btn-sm"><i class="fas fa-solid fa-trash"></i></button>
                        @endif
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
