@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">

                    <h1>Cambiar mi password</h1>

                        @if (Session::has('message'))
                         <div class="text-danger">
                         {{Session::get('message')}}
                         </div>
                        @endif
                </div>

                <div class="card-body">
     
                        
                        
                        <form method="post" action="{{url('users/updatepassword')}}">
                         {{csrf_field()}}
                        
                         <div class="form-group">
                        
                          <label for="mypassword">Introduce tu actual password:</label>
                          <input type="password" name="mypassword" class="form-control">
                          <div class="text-danger">{{$errors->first('mypassword')}}</div>
                         </div>
                        
                         <div class="form-group">
                          <label for="password">Introduce tu nuevo password:</label>
                          <input type="password" name="password" class="form-control">
                          <div class="text-danger">{{$errors->first('password')}}</div>
                         </div>
                        
                         <div class="form-group">
                          <label for="mypassword">Confirma tu nuevo password:</label>
                          <input type="password" name="password_confirmation" class="form-control">
                         </div>
                        
                         <button type="submit" class="btn btn-raised btn-primary">Cambiar mi password</button>
                        
                        </form>
                </div>

             </div>
        </div>
     </div>
 </div>

 @endsection