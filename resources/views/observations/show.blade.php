@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center text-uppercase"> Observaciones de la sesion</h1>
                        
                    @can('observations.create')
                    <a href="{{route('observations.create',$sesion)}}" class="btn btn-raised btn-success"> <i class="fas fa-plus"> </i> Crear Nueva Observación </a>
                     @endcan


                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-success">
                                <th colspan="2" scope="col">Descripcion</th>
                                        <th colspan="1" scope="col">Rate (Menos es mejor) </th>
                                        <th colspan="1" scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($observations as $observation)
                            <tr>
                                <td colspan="2">{{ $observation->descripcion }}</td>
                                <!-- LEVEL  -->
                                    @if($observation->level_id <=2)
                                        <td>
                                            <span class="badge badge-success">Bien</span>
                                            {{ $observation->level_id }}
                                        </td>

                                    @elseif($observation->level_id <=3)
                                        <td>
                                            <span class="badge badge-warning">Peligro</span>
                                            {{ $observation->level_id }}
                                        </td>
                                    
                                    @elseif($observation->level_id >=4)
                                        <td>
                                            <span class="badge badge-danger">Mal</span>
                                            {{ $observation->level_id }}
                                        </td>
                                    @endif

            
                                <!-- END  -->
                                <td colspan="1" >{{ $observation->fecha }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody> 
                                <td class="text-uppercase"> <b> <h2> Promedio</h2></b> 
                                    <p>
                                        Promedio actual de las observaciones
                                    </p>
                                </td>
                                
                                <td class="text-uppercase"> 
                                    @if($promobservation <=1.9)
                                        <td>
                                            <h2><span class="badge badge-pill badge-success">Excelente {{ $promobservation }}</span></h2>
                                            <p>
                                                Su condición es excelente!
                                            </p>
                                        </td>
                                    @elseif($promobservation <=2.9)
                                        <td>
                                            <h2><span class="badge badge-pill badge-success">Bien {{ $promobservation }}</span></h2>
                                            <p> 
                                                Su condición es estable de momento
                                            </p>
                                        </td>

                                    @elseif($promobservation <=3.9)
                                        <td>
                                            <h2><span class="badge badge-pill badge-warning">Peligro {{ $promobservation }}</span></h2>
                                            <p> 
                                                Su condición es peligrosa, poner más atención a las observaciones
                                            </p>
                                        </td>
                                    
                                    @elseif($promobservation >=4)
                                        <td>
                                            <h2><span class="badge badge-pill badge-danger">Mal {{ $promobservation }}  </span></h2>
                                            <p class="">
                                                Su situación se encuentra en peligro! por favor tener cuidado con el paciente 
                                            </p>
                                        </td>
                                    @endif
                                </td>
                        </tbody>
                    </table>

                    {{$observations->render()}}

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
