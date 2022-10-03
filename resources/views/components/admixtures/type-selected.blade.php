@if (!empty($typeSelected))
    @switch($typeSelected)
        @case(1)
            <x-admixtures.form-fruit :typeData="$typeData['1']" :disabled="$disabled" />
        @break

        @case(2)
            <x-admixtures.form-vegetable :typeData="$typeData['2']" :disabled="$disabled" />
        @break

        @case(3)
            <x-admixtures.form-meat :typeData="$typeData['3']" :disabled="$disabled" />
        @break
    @endswitch
@endif

