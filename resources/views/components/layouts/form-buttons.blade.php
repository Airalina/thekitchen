<div class="row justify-content-start">
    <div class="col-2 m-4">
        <x-adminlte-button label="{{ $name }}" class='bg-olive' wire:click="{{ $method }}"/>
    </div>
    <div class="col-2 m-4">
        <x-adminlte-button label="Cancelar" theme='danger' wire:click="back" />
    </div>
</div>
