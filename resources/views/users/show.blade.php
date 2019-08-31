@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Perfil de usuario de <strong>{{ $user->name }}</strong></h1>

                    <div class="row pull-right">
                            @can('users.edit')
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                    class="btn btn-sm btn-primary">
                                        editar
                                    </a>
                            @endcan
                    </div>
                </div>

                <div class="card-body">
                        <div class="table responsive">
                            <table class="table table-bordered table-md ">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold"> Nombre </th>
                                        <th> {{ $user->name }}  {{ $user->apellidos }}</th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Rut </th>
                                            <th> {{ $user->rut }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Email </th>
                                            <th> {{ $user->email }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Telefono </th>
                                            <th> {{ $user->telefono }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Sexo </th>
                                            <th> {{ $user->sexo }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Fecha de Nacimiento </th>
                                            <th> {{ $user->fechanacimiento }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Región </th>
                                            <th> {{ $user->region->name }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Comuna </th>
                                            <th> {{ $user->comuna->name }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Nivel Socio Economico </th>
                                            <th> {{ $user->nivelse->name  }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> fonasa </th>
                                            <th> {{ $user->fonasa->name }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Institución </th>
                                            <th> {{ $user->lugar->name  }} </th>
                                    </tr>
                                    <tr>
                                            <th class="font-weight-bold"> Tipo de usuario </th>
                                            <th> {{ $user->tipo->name }} </th>
                                    </tr>
    
    
                                </thead>
                            </table>
                        </div>
                    </div>

             </div>
        </div>
     </div>
 </div>

 @endsection