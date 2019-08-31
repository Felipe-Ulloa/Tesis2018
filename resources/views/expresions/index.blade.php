@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-center text-uppercase">Expresiones contadas por el usuario </h1>
                        
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="bg-success">
                                <th scope="col">Descripción</th>
                                <th scope="col">Nivel </th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($expresiones as $expresione)
                            <tr>
                                <td>{{ $expresione->observation }}</td>
                                <td>{{ $expresione->nivel->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($expresione->fecha)->format('d/m/Y')}}</td>
   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$expresiones->render()}}

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
