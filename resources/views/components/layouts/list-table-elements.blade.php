@switch($module)
    @case('usuarios')
        <td class="text-center">{{ $element->id }}</td>
        <td class="text-center">{{ $element->name }}</td>
        <td class="text-center">{{ $element->email }}</td>
    @break

    @case('roles')
        <td class="text-center">{{ $element->id }}</td>
        <td class="text-center">{{ $element->name }}</td>
    @break

    @case('clientes')
        <td class="text-center">{{ $element->id }}</td>
        <td class="text-center">{{ $element->name }}</td>
        <td class="text-center">{{ $element->email }}</td>
        <td class="text-center">{{ $element->cuit }}</td>
    @break

    @default
@endswitch
