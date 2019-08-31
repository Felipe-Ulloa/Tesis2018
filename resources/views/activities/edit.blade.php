@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1> Editar Actividad </h1>
                </div>

                <div class="card-body">



               
                     {!! Form::model($activity, ['route' => ['activities.update', $activity->id],
                    'method' => 'PUT']) !!}

                        @include('activities.partials.formedit')
                        
                    {!! Form::close() !!}



                </div>
             </div>
        </div>
     </div>
 </div>

 @endsection