<div class="form-group">
    <label>Ordenar por</label>
    <div class="w-25">
        <x-adminlte-select name="selBasic" wire:model="order">
            @foreach ($items as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </x-adminlte-select>
    </div>
</div>
