<div>
    @switch($view)
        @case('index')
            @can('admixture.index')
                @include('admixture.index')
            @endcan
        @break

        @case('create')
            @include('admixture.create')
        @break

        @case('edit')
            @include('admixture.update')
        @break

        @case('show')
            @include('admixture.show')
        @break

    @endswitch
</div>

