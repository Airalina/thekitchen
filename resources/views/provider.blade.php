@extends('adminlte::page')

@section('title', 'Proveedores')

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')
    @livewireStyles
    <div class="col-md-8">
        @livewire('providers')
    </div>
    @livewireScripts
@stop

@section('footer')
    <strong>Airaly Cañizales</strong>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
        window.addEventListener('delete_confirm', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Livewire.emit('deleteProvider')
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@stop
