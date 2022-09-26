<div class="card-footer">
    <div class="row justify-content-start">
        <div class="col-2 mr-4">
            <x-adminlte-button label="{{ $name }}" class='bg-olive' wire:click="{{ $method }}"/>
        </div>
        <div class="col-2">
            <x-adminlte-button label="Cancelar" theme='danger' wire:click="back" />
        </div>
    </div>
</div>
