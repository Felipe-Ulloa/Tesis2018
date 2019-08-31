



<div class="form-group">
	{{ Form::label('name', 'Nombre') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>


<div class="form-group">
	{{ Form::label('apellidos', 'Apellido') }}
	{{ Form::text('apellidos', null, ['class' => 'form-control', 'id' => 'apellidos']) }}
</div>

<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
</div>



<div class="form-group">
	{{ Form::label('rut', 'Rut') }}
	{{ Form::text('rut', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('telefono', 'Telefono') }}
	{{ Form::text('telefono', null, ['class' => 'form-control', 'maxlength' =>  10]) }}
</div>

<div class="form-group">
	{{ Form::label('Sexo') }} <br>
	{{ Form::radio('sexo', 'Hombre', true) }} {{ Form::label('Hombre') }}
	{{ Form::radio('sexo', 'Mujer', true) }} {{ Form::label('Mujer') }}
</div>

<div class="form-group">
	{{ Form::label('fechanacimiento', 'Fecha de Nacimiento') }}
	{{ Form::Date('fechanacimiento', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('region_id', 'Region') }}
	{{ Form::select('region_id', $listaregiones, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('comuna_id', 'Comuna') }}
	{{ Form::select('comuna_id', $listacomunas, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
	{{ Form::label('direccion', 'Direccion') }}
	{{ Form::text('direccion', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
		{{ Form::label('nivelse_id', 'Nivel SocioEconomico') }}
		{{ Form::select('nivelse_id', $nivelse, null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
			{{ Form::label('fonasa_id', 'Fonasa') }}
			{{ Form::select('fonasa_id', $fonasa, null, ['class' => 'form-control']) }}
	</div>

	<div class="form-group">
			{{ Form::label('estado_id', 'Estado') }}
			{{ Form::select('estado_id', $estado, null, ['class' => 'form-control']) }}
	</div>

<div class="form-group">
	{{ Form::hidden('user_types_id', '5') }}
</div>

<div class="form-group">
		{{ Form::label('institute_id', 'Instituto') }}
		{{ Form::select('institute_id', $instituciones, null, ['class' => 'form-control']) }}
</div>

<hr>

<h3> Roles </h3>

<div class="form-group">
	
	<ul class="list-unstyled">
		@foreach($roles as $role)
			<li>
				<label>
					{{ Form::checkbox('roles[]', $role->id, null)  }}
					{{ $role->name}}
					<em>({{ $role->description ?: 'Sin Descripción' }})</em>
				</label>
			</li>
		@endforeach
	</ul>

</div>

<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>