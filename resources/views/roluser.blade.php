@extends('adminlte::page')

@section('title', 'Roles y Usuarios')

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Roles y Usuarios</h1>
@stop

@section('content')
    @livewireStyles
    <div class="card card-olive card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill"
                        href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay"
                        aria-selected="false">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill"
                        href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark"
                        aria-selected="false">Roles</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-five-overlay" role="tabpanel"
                    aria-labelledby="custom-tabs-five-overlay-tab">
                    @livewire('users')
                </div>
                <div class="tab-pane fade" id="custom-tabs-five-overlay-dark" role="tabpanel"
                    aria-labelledby="custom-tabs-five-overlay-dark-tab">
                    @livewire('roles')
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                Livewire.emit('deleteUser')
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
        window.addEventListener('show-form-permission', event => {
            $('#form-permission').modal('show');
        })
        window.addEventListener('hide-form-permission', event => {
            $('#form-permission').modal('hide');
        })
    </script>

@stop
