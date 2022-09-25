<div class="form-group">
    <label>Ordenar por</label>
    <select wire:model="order" class="form-control w-25" tabindex="-1">
        @foreach ($items as $key => $item)
            <option value="{{ $key }}">{{ $item }}</option>
        @endforeach
    </select>
</div>
