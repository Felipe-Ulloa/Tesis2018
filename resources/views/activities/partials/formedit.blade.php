


<div class="form-group">
	{{ Form::label('name', 'Nombre de la Actividad') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>


<div class="form-group">
		{{ Form::label('Estado') }} <br>
		{{ Form::radio('estado', 'Realizado', true) }} {{ Form::label('Realizado') }}
		{{ Form::radio('estado', 'Pendiente', true) }} {{ Form::label('Pendiente') }}
	</div>

{{ Form::hidden('sesion_id', $activity->sesion_id) }}


<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>