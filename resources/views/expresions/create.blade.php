@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Cuenta algo</h1>
                </div>

                <div class="card-body">
                    
                    @include('expresions.partials.error')


                    {{ Form::open(['route' => 'expresions.store']) }}

                        @include('expresions.partials.form')
                        
                    {{ Form::close() }}


                </div>
             </div>
        </div>

     </div>
 </div>

 @endsection