<div>
    @switch($view)
        @case('index')
            @can('client.index')
                @include('client.index')
            @endcan
        @break

        @case('create')
            @include('client.create')
        @break

        @case('edit')
            @include('client.update')
        @break

        @case('show')
            @include('client.show')
        @break

        @case('createDeliveryAddress')
            @include('client.createDeliveryAddress')
        @break

        @case('editDeliveryAddress')
            @include('client.updateDeliveryAddress')
        @break

    @endswitch
</div>
