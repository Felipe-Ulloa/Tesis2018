<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Session;
use App\User;
use App\Level;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $sesion = $id;


        return view('activities.create',compact('sesion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Activity::create($request->all());

        return redirect()->route('activities.show',$activity->sesion_id)
        ->with('info','Sesion Actualizado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, $id)
    {
         $activities = Activity::orderBy('id','DESC')
            ->where('sesion_id', $id)
            ->paginate();

        $sesion = $id;

        return view('activities.index',compact('activities','sesion'));
    }

    public function pendiente(Activity $activity)
    {
        $idusuario = auth()->user()->id;

        $idsession = Session::WHERE('paciente_id', $idusuario)
                ->pluck('id');

        $id = $idsession->first();

        $activities = Activity::orderBy('id','DESC')
        ->where('sesion_id', $id)
        ->where('estado', 'Pendiente')
        ->paginate();
        
        return view('activities.indexpaciente',compact('activities'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {


        return view('activities.edit',compact('activity'));
    }

    public function editpaciente(Activity $activity)
    {
        $levels = Level::get();


        return view('activities.editpaciente',compact('activity','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());

        return redirect()->route('activities.show',$activity->sesion_id)
            ->with('info','Sesion Actualizado con exito');
    }

    public function updatepaciente(Request $request, Activity $activity)
    {   
        $activity->update($request->all());
        
        return redirect()->route('home')->with('info','Actividad puntuada');;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
