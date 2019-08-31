@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center text-uppercase">Actividades Pendientes </h1>
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-warning text-uppercase">
                                <th scope="col">Actividades</th>
                            </tr>
                        </thead>
                        <tbody id="myTable ">
                            @forelse($activities as $activitie)
                            <tr>
                                <td>
                                    <a href="{{ route('activities.editpaciente', $activitie->id) }}" 
                                    class="btn btn-primary btn-sm">
                                    
                                        {{ $activitie->name }}
                                    </a>
                                </td>
                                
                            </tr>
                            @empty

                            <h4> No hay actividades pendientes </h4>

                            @endforelse
                        </tbody>
                    </table>

                    {{$activities->render()}}

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
