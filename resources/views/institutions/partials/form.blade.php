
<div class="form-group">
	{{ Form::label('logo','Foto') }}
	<input class="form-group" type="file" name="logo">
</div>


<div class="row">
	<div class="col">
		<div class="form-group">
		{{ Form::label('name', 'Nombre Establecimiento') }}
		{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'maxlength' => 30, 'placeholder'=>'Ejemplo Institución']) }}
		@if ($errors->has('name'))
		<small class="form-text text-danger">{{ $errors->first('name') }}</small>
		@endif

	</div>
	</div>
	<div class="col">
		<div class="form-group">
	{{ Form::label('direccion', 'Direccion') }}
	{{ Form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion','maxlength' => 30, 'placeholder'=>'Ejemplo 123']) }}
	@if ($errors->has('direccion'))
	<small class="form-text text-danger">{{ $errors->first('direccion') }}</small>
	@endif
</div>
	</div>
</div>


<div class="row">
	<div class="col">
		<div class="form-group">
			{{ Form::label('rut', 'Rut') }}
			{{ Form::text('rut', null, ['class' => 'form-control', 'id' => 'rut','maxlength' => 10, 'placeholder'=>'11111111-1']) }}
		</div>
		@if ($errors->has('rut'))
		<small class="form-text text-danger">{{ $errors->first('rut') }}</small>
		@endif
	</div>
	<div class="col">
		<div class="form-group">
			{{ Form::label('fono', 'Fono') }}
			{{ Form::text('fono', null, ['class' => 'form-control', 'id' => 'fono','min' => 9, 'max' => 999999999, 'maxlength' => 9, 'placeholder'=>'numero de telefono']) }}
		</div>
		@if ($errors->has('fono'))
		<small class="form-text text-danger">{{ $errors->first('fono') }}</small>
		@endif
	</div>
</div>




<div class="row">
	<div class="col">
		<div class="form-group">
	{{ Form::label('region_id', 'Region') }}
	{{ Form::select('region_id', $listaregiones, null, ['class' => 'form-control', 'required', 'placeholder'=>'Seleccione una opción']) }}
		</div>
		@if ($errors->has('region_id'))
		<small class="form-text text-danger">{{ $errors->first('region_id') }}</small>
		@endif
	</div>
	<div class="col">
		<div class="form-group">
	{{ Form::label('comuna_id', 'Comuna') }}
	{{ Form::select('comuna_id', $listacomunas, null, ['class' => 'form-control','required', 'placeholder'=>'Seleccione una opción']) }}
</div>
		@if ($errors->has('comuna_id'))
		<small class="form-text text-danger">{{ $errors->first('comuna_id') }}</small>
		@endif
	</div>
</div>

<div class="row">
	<div class="col">
			<div class="form-group">
					{{ Form::label('categoria_id', 'Categoria') }}
					{{ Form::select('categoria_id', $categorias, null, ['class' => 'form-control','required', 'placeholder'=>'Seleccione una opción']) }}
						@if ($errors->has('categoria_id'))
						<small class="form-text text-danger">{{ $errors->first('categoria_id') }}</small>
						@endif
				</div>
	</div>
		<div class="col">
			<div class="form-group">
		{{ Form::label('sitioweb', 'Sitioweb') }}
		{{ Form::text('sitioweb', null, ['class' => 'form-control', 'id' => 'sitioweb','maxlength' => 30, 'placeholder'=>'www.ejemplo.ejemplo']) }}
				
				@if ($errors->has('sitioweb'))
						<small class="form-text text-danger">{{ $errors->first('sitioweb') }}</small>
						@endif
			</div>
		</div>
</div>


<hr>

<style>
	#map-canvas{
	 width:100%;
	 height:370px;
	}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&libraries=places" type="text/javascript"></script>


<div class="form-group">

	<label form="">Mapa</label>

	<div class="alert alert-success" role="alert" >
	  Tomar el marcador y arrastar en donde hasta donde se encuentre el establecimiento en el mapa
	</div>

	<input class="form-control input-sm" type="text" id="searchmap" placeholder="Busqueda de lugar">
<div id="map-canvas"></div>
</div>

<hr>

<div class="row">
	<div class="col">
		<div class="form-group">
			<label form="">Latitud</label>
		   {{ Form::text('lat', null, ['class' => 'form-control','id' => 'lat', 'readonly' => 'readonly']) }}

		</div>
	</div>
	<div class="col">
		<div class="form-group">
			<label form="">Longitud</label>
			{{ Form::text('lng', null, ['class' => 'form-control','id' => 'lng', 'readonly' => 'readonly']) }}

		</div>
	</div>
</div>


<hr>


<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-raised btn-primary']) }}
</div>

<script >
	
	var map = new google.maps.Map(document.getElementById('map-canvas'), {
		center:{ lat:-34.7585596, lng:-72.0680056
		},
		zoom:7
	});


	var marker= new google.maps.Marker({
		 position:{
		  lat:-34.7585596,
		  lng:-72.0680056
		 },
		 map:map,
		 draggable:true
		});
	var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
	google.maps.event.addListener(searchBox,'places_changed',function(){

	var places = searchBox.getPlaces();

	var bounds = new google.maps.LatLngBounds();

    var i , place;

    for(i=0;place=places[i];i++){
		 bounds.extend(place.geometry.location);
		 marker.setPosition(place.geometry.location);
		}
		map.fitBounds(bounds);
		map.setZoom(17);
		});
			google.maps.event.addListener(marker,'position_changed',function(){
 var lat = marker.getPosition().lat();
 var lng = marker.getPosition().lng();
	 $('#lat').val(lat);
	 $('#lng').val(lng);
	});

</script>

