<?php

namespace App\Http\Controllers;

use App\Observation;
use App\Level;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ObservationController extends Controller
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
        $levels = Level::get();
        $now = Carbon::now();
        $sesion = $id;

        $psicologo = auth()->user()->id;
        return view('observations.create',compact('levels','now','psicologo','sesion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $observation = Observation::create($request->all());


        return redirect()->route('observations.show', $observation->sesion_id)
            ->with('info','Observación Guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function show(Observation $observation, $id)
    {   

        $sesion = $id;

        $observations = Observation::orderBy('id','DESC')
            ->where('sesion_id', $id)
            ->paginate();
        
        $observations21 = Observation::OrderBy('id','DES')
            ->where('sesion_id',$id)
            ->get();
            
        $promedio = $observations21->avg('level_id');
        $promobservation = round($promedio,2);

        return view('observations.show',compact('observations','promobservation','sesion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function edit(Observation $observation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Observation $observation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Observation  $observation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Observation $observation)
    {
        //
    }
}
