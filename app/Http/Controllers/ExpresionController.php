<?php

namespace App\Http\Controllers;

use App\Expresion;

use App\Level;
use Carbon\Carbon;
use App\Session;

use Illuminate\Http\Request;

class ExpresionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {   
        $expresiones = Expresion::where('sesion_id',$id)->paginate();

        return view('expresions.index',compact('expresiones'));   
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = auth()->user()->id;
        $sesion = Session::where('paciente_id', $userid)
        ->pluck('id');

        $idsesion = $sesion->first();




        $levels = Level::get();
        $now = Carbon::now();

        return view('expresions.create',compact('levels','now','idsesion'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Expresion::create($request->all());

        return redirect()->route('home')
        ->with('info','expresion guardad con exito');   
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expresion  $expresion
     * @return \Illuminate\Http\Response
     */
    public function show(Expresion $expresion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expresion  $expresion
     * @return \Illuminate\Http\Response
     */
    public function edit(Expresion $expresion)
    {
        //
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expresion  $expresion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expresion $expresion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expresion  $expresion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expresion $expresion)
    {
        //
    }
}
