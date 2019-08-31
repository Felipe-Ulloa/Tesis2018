<?php

namespace App\Http\Controllers;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Requests\SessionRequest;
use App\Session;
use App\User;
use App\Terapy;
use App\Activity;
use App\Institution;
use App\Historial;
use App\Disease;
use App\SexualOrientation;
use App\CivilState;
use App\Derivado;
use App\Observation;
use Illuminate\Http\Request;


class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        
        if(auth()->user()->user_types_id == 4){
            $sessions = Session::orderBy('id','DESC')
            ->where('psicologo_id', auth()->user()->id)
                ->paginate();  
        }else {
            $sessions = Session::orderBy('id','DESC')
                ->where('institution_id', auth()->user()->institute_id)
                ->paginate(); 
        }

        return view('sessions.index',compact('sessions'));
    }

    public function indexcalendar(){
        
        $data = Historial::all()->where('institution_id',auth()->user()->institution_id)
        ->where('asistencia_id',3);

        $events = [];
                if($data->count())
                 {
                    foreach ($data as $key => $value) 
                    {
                        $events[] = Calendar::event(
                            'Psicologo: '. $value->sesion->psicologo->name.
                            ' Paciente: ' . $value->sesion->paciente->name,
                            false,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date),
                            null,
                         [
                             'backgroundColor' => '#6675FF',
                             'color'  => '#6675FF',
                             'url' => route("historials.show",$value->sesion->id),

                         ]
                        );
                    }
                }
                $calendar = Calendar::addEvents($events)->setOptions([
                        'firstDay' => 1,
                        'slotLabelFormat' => 'HH:mm',
                        'timeFormat' => 'HH:mm',
                        'hiddenDays' => [0,6],
                        'themeSystem' => 'bootstrap4',
                        'nowIndicator' =>true,
                        'selectable' => true,
                ])->setCallbacks([]);
                return view('sessions.calendar', compact('calendar'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $pacientes = User::OrderBy('id','ASC')
        ->where('user_types_id',5)
        ->where('estado_id', '2')
        ->where('institute_id', auth()->user()->institute_id)
        ->pluck('name','id');

         $psicologos = User::OrderBy('id','ASC')
        ->where('user_types_id',4)
        ->where('institute_id', auth()->user()->institute_id)
        ->pluck('name','id');

       $enfermedades = Disease::OrderBy('id','ASC')->pluck('name','id');
       $terapia = Terapy::OrderBy('id','ASC')->pluck('name','id'); 
       $derivado = Derivado::OrderBy('id','ASC')->pluck('name','id');
       $genero = SexualOrientation::OrderBy('id','ASC')->pluck('name','id');
       $estadocivil = CivilState::OrderBy('id','ASC')->pluck('name','id');

       return view('sessions.create',compact('pacientes','enfermedades','terapia','psicologos','derivado','genero','estadocivil'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SessionRequest $request)
    {
         
         $sesion = Session::create($request->all());

         $user =  User::find($sesion->paciente_id)->update(['estado_id' => 1]);

        return redirect()->route('sessions.index',$sesion->id)
            ->with('info','Usuario Guardado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        $valor = $session->id;

        $observations = Observation::OrderBy('id','DES')
                ->where('sesion_id',$valor)
                ->paginate(7);

        $observationsGrafic = Observation::OrderBy('fecha','ASC')
                ->where('sesion_id',$valor)
                ->get();

        $historials = Historial::OrderBy('start_date','ASC')
                ->where('sesion_id',$valor)
                ->paginate(5);

        $activities = Activity::OrderBy('id','DES')
                ->where('sesion_id',$valor)
                ->paginate(5);

        $contadorrealizadas = Activity::all()
        ->where('sesion_id',$valor)
        ->where('estado','Realizado')
        ->count();

        $contadorpendiente = Activity::all()
        ->where('sesion_id',$valor)
        ->where('estado','Pendiente')
        ->count();
        

        $contadorpresente = Historial::all()->where('sesion_id',$valor)->where('asistencia_id', 3)->count();
        $contadorausente = Historial::all()->where('sesion_id',$valor)->where('asistencia_id', 2)->count();
        $contadorcanceladas = Historial::all()->where('sesion_id',$valor)->where('asistencia_id', 5)->count();

        $observations21 = Observation::OrderBy('id','DES')
                ->where('sesion_id',$valor)
                ->get();
                
        $promedio = $observations21->avg('level_id');
        $promobservation = round($promedio,2);

        $this->authorize('pass',$session);
 
        return view('sessions.show', compact('session','observations','observationsGrafic'
        ,'historials','contadorausente','contadorpresente'
        ,'contadorcanceladas','activities','promobservation','contadorpendiente','contadorrealizadas'));
    }


    public function ficha(Session $session)
    {
        $valor = $session->id;
        $observations = Observation::OrderBy('fecha','ASC')
                ->where('sesion_id',$valor)
                ->paginate();
        $historials = Historial::OrderBy('start_date','ASC')
                ->where('sesion_id',$valor)
                ->paginate();

        $this->authorize('pass',$session);
 
        return view('sessions.ficha', compact('session','observations','historials'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
         $pacientes = User::OrderBy('id','ASC')
        ->pluck('name','id');

         $psicologos = User::OrderBy('id','ASC')
        ->pluck('name','id');

       $terapia = Terapy::OrderBy('id','ASC')->pluck('name','id');
       $institute = Institution::OrderBy('id','ASC')->pluck('name','id'); 
       $derivado = Derivado::OrderBy('id','ASC')->pluck('name','id');
       $genero = SexualOrientation::OrderBy('id','ASC')->pluck('name','id');
       $estadocivil = CivilState::OrderBy('id','ASC')->pluck('name','id');

       return view('sessions.edit',compact('session','pacientes','terapia','psicologos','derivado','genero','estadocivil','institute'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {

        $session->update($request->all());

        return redirect()->route('sessions.show',$session->id)
            ->with('info','Sesion Actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
