

<div class="form-group">
	{{ Form::hidden('sesion_id', $sesion_id) }}
</div>

<div class="form-group">
	{{ Form::label('asistencia_id', 'Asistencia') }}
	{{ Form::select('asistencia_id', $asistencia, null, ['class' => 'form-control','placeholder' => 'seleccione una opción']) }}
</div>

<div class="form-group">
		{{ Form::label('start_date', 'Inicio') }}
		
		<input class="form-control" id="start_date"
       name="start_date">

</div>
<em> Favor de tener en cuenta que cada sesión dura 1 HORA</em>
<div class="form-group ">
		{{ Form::label('end_date', 'Fin') }}
		
		<input class="form-control" id="end_date"
       name="end_date">

       @php
       	
       @endphp
</div>

<hr>




<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>


    <script>
		    var today, startdate, enddate ;

			today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());

			startdate  = $('#start_date').datetimepicker({
				uiLibrary: 'materialdesign',
				iconsLibrary: 'fontawesome',
				disableDaysOfWeek: [0, 6],
				minDate: today,
				footer: true, 
				modal: true, 
				locale: 'es-es', 
				format: 'yyyy-mm-dd hh:mm',
				
				maxDate: function () {
					return $('#end_date').val();
				}
			});

			enddate = $('#end_date').datetimepicker({
				uiLibrary: 'materialdesign',
				iconsLibrary: 'fontawesome',
				footer: true, 
				modal: true, 
				locale: 'es-es', 
				format: 'yyyy-mm-dd hh:mm',
				disableDaysOfWeek: [0, 6],
				minDate: function () {
					return $('#start_date').date();
				}
			});
			
    </script>