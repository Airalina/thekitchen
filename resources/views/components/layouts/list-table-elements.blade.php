@switch($module)
    @case('usuarios')
        <td class="text-center">{{ $element->id }}</td>
        <td class="text-center">{{ $element->name }}</td>
        <td class="text-center">{{ $element->email }}</td>
    @break

    @case(2)
    @break

    @default
@endswitch
