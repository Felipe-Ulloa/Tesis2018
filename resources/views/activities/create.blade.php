@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>Nueva Actividad</h1>
                </div>

                <div class="card-body">
                    
                    @include('activities.partials.error')


                    {{ Form::open(['route' => 'activities.store']) }}

                        @include('activities.partials.form')
                        
                    {{ Form::close() }}


                </div>
             </div>
        </div>

     </div>
 </div>

 @endsection