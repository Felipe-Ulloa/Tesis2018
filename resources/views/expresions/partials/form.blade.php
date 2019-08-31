


<div class="form-group">
        {{ Form::label('descripcion', 'Observacion') }}
        {{ Form::textarea('observation', null, ['class' => 'form-control', 'id' => 'email']) }}
    </div>
    <label> Rating </label>
    
        <div class="form-group text-center">
        
        <style>
            /* HIDE RADIO */
    [type=radio] { 
      position: absolute;
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    /* IMAGE STYLES */
    [type=radio] + img {
      cursor: pointer;
    }
    
    /* CHECKED STYLES */
    [type=radio]:checked + img {
      outline: 2px solid #f00;
    }
        </style>
    
    
        @foreach ($levels as $level)
            <label>
    
                {{ Form::radio('level_id', $level->id , null) }} 
            
    
                @if ($level->id <= 1)
                    <img alt="Responsive image" src="{{ url('level/level1.png') }}" width="70px">
                
                @elseif ($level->id <= 2)
                    <img alt="Responsive image" src="{{ url('level/level2.png') }}" width="70px">
                
                @elseif ($level->id <= 3)
                    <img alt="Responsive image" src="{{ url('level/level3.png') }}" width="70px">
                
                @elseif ($level->id <= 4)
                    <img alt="Responsive image" src="{{ url('level/level4.png') }}" width="70px">
                
                @elseif ($level->id <= 5)
                    <img alt="Responsive image" src="{{ url('level/level5.png') }}" width="70px">
                @endif
                </label>
        
        @endforeach
        </div>
        
        {{ Form::hidden('sesion_id', $idsesion , ['class' => 'form-control', 'id' => 'sesion_id']) }}
    
        {{ Form::hidden('fecha', $now, null) }}

    
    
    <hr>
    
    
    
    <div class="form-group text-center">
        {{ Form::submit('Guardar', ['class' => 'btn btn-raised btn-primary']) }}
    </div>