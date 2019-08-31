


<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('name', 'Nombre') }}
			{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name','maxlength' => 20]) }}
			@if ($errors->has('name'))
			<small class="form-text text-danger">{{ $errors->first('name') }}</small>
			@endif
		</div>
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::label('slug', 'Slug') }}
			{{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'apellidos','maxlength' => 20]) }}
			@if ($errors->has('slug'))
			<small class="form-text text-danger">{{ $errors->first('slug') }}</small>
			@endif
		</div>
	</div>
</div>



<div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'email','maxlength' => 40]) }}
	@if ($errors->has('description'))
			<small class="form-text text-danger">{{ $errors->first('description') }}</small>
	@endif
</div>


<hr>

<h3> Permiso Especial</h3>

<div class="form-group">
	<label>
		{{ Form::radio('special', 'all-access')}} Acceso Total
		{{ Form::radio('special', 'no-access',true)}} Ningun Total
		@if ($errors->has('special'))
			<small class="form-text text-danger">{{ $errors->first('special') }}</small>
		@endif
	</label>
</div>

<hr>

<h3> Lista de Permisos </h3>

<div class="form-group">

	<?php $n = -1; ?>
	
	<ul class="list-unstyled">
		@foreach($permissions as $permission)
			<?php $n++; ?>

		<?php if($n == 5){
			echo '<hr>';
			$n = 0;
		} ?>
			<li>
				<label>
					{{ Form::checkbox('permissions[]', $permission->id, null)  }}
					{{ $permission->name}}
					<em>({{ $permission->description ?: 'Sin Descripción' }})</em>
				</label>
			</li>
		@endforeach
	</ul>

</div>

<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-raised btn-primary']) }}
</div>