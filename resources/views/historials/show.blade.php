@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center text-uppercase">Historial</h1>
                        
                    @can('historials.create')
                    <a href="{{ route('historials.create', $idsesion) }}" 
                       class="btn btn-raised btn-danger "> Nueva fecha/ Nueva sesion
                    </a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-success">
                                <th width="10px">ID</th>
                                <th scope="col">Sesión</th>
                                <th scope="col">Asistencia</th>
                                <th scope="col">Horario</th>

                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($historials as $historial)
                            <tr>
                                <td>{{ $historial->id }}</td>
                                <td> Psicologo: {{ $historial->sesion->psicologo->name }} <br>
                                     Paciente: {{ $historial->sesion->paciente->name }}

                                </td>
                                <td> Inicio: {{ date('d-m-Y H:i', strtotime($historial->start_date))}} <br>
                                     Termino: {{ date('d-m-Y H:i', strtotime($historial->end_date)) }}

                                </td>
                                    @if($historial->asistencia_id <= 1)
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $historial->asistencia->name }}
                                                </span>   
                                            </td>
                                        @elseif($historial->asistencia_id <= 2)
                                            <td>
                                                <span class="badge badge-light">
                                                    {{ $historial->asistencia->name }}
                                                </span>   
                                            </td>
                                        @elseif($historial->asistencia_id <= 3)
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $historial->asistencia->name }}
                                                </span>   
                                            </td>
                                        @elseif($historial->asistencia_id <= 4)
                                            <td>
                                                <span class="badge badge-secondary">
                                                    {{ $historial->asistencia->name }}
                                                </span>   
                                            </td>
                                        @elseif($historial->asistencia_id <= 5)
                                            <td>
                                                <span class="badge badge-danger">
                                                    {{ $historial->asistencia->name }}
                                                </span>  
                                            </td>
                                        @endif

                                @can('secretarys.show')

                                @endcan
                                @can('historials.edit')
                                <td width="10px">
                                    <a href="{{ route('historials.edit', $historial->id) }}" 
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>

                                    </a>
                                </td>
                                @endcan
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$historials->render()}}

                     <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
