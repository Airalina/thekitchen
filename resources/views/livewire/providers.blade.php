<div>
    @switch($view)
        @case('index')
            @can('provider.index')
                @include('provider.index')
            @endcan
        @break

        @case('create')
            @include('provider.create')
        @break

        @case('edit')
            @include('provider.update')
        @break

        @case('show')
            @include('provider.show')
        @break

        @case('createDeliveryAddress')
            @include('provider.createDeliveryAddress')
        @break

        @case('editDeliveryAddress')
            @include('provider.updateDeliveryAddress')
        @break

    @endswitch
</div>
