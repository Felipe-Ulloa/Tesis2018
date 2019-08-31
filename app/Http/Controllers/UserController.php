<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\Region;
use App\Commune;
use App\Institution;
use App\UserType;
use App\SocioEconomic;
use App\Fonasa;
use App\User;
use App\estado;
use Caffeinated\Shinobi\Models\Role;

use Validator;
use Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        /*  establecimiento  1
            director    2
            secretaria  3
            psicologo   4
            paciente    5
            admin   6
        */

    public function index()
    {   
        $users = User::orderBy('id','DESC')
            ->where('institute_id', auth()->user()->institute_id)
            ->paginate();

        return view('users.index',compact('users'));
    }

    public function indextdirector(){
         $directors = User::orderBy('id','DESC')
            ->where('user_types_id',2)
            ->where('institute_id', auth()->user()->institute_id)
            ->paginate();

        return view('directors.index',compact('directors'));
    }

    public function indexsecretary(){
         $secretarys = User::orderBy('id','DESC')
            ->where('user_types_id',3)
            ->where('institute_id', auth()->user()->institute_id)
            ->paginate();

        return view('secretarys.index',compact('secretarys'));
    }

     public function indexpsicologos(){
        
         $psicologos = User::orderBy('id','DESC')
            ->where('user_types_id',4)
            ->where('institute_id', auth()->user()->institute_id)
            ->paginate();

        return view('psicologos.index',compact('psicologos'));
    }

      public function indexpatients(){
        
         $patients = User::orderBy('id','DESC')
            ->where('user_types_id',5)
            ->where('institute_id', auth()->user()->institute_id)
            ->paginate();

        return view('patients.index',compact('patients'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get();

        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        return view('users.create',compact('roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa','estado'));
    }

     public function createdirector()
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        $roles = Role::get()->where('name','Director');

        return view('directors.create',compact('roles','categorias','listacomunas','listaregiones','instituciones','estado'));
    }


    public function createsecretary()
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get()->where('name','Secretaria');
        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        return view('secretarys.create',compact('roles','categorias','listacomunas','listaregiones','instituciones','estado'));
    }


    public function createpsicologo()
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get()->where('name','Psicologo');
        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        return view('psicologos.create',compact('roles','categorias','listacomunas','listaregiones','instituciones','estado'));
    }

    public function createpatient()
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get()->where('name','Paciente');
        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        return view('patients.create',compact('roles','categorias','listacomunas','listaregiones','instituciones','estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        $user->roles()->sync($request->get('roles'));
        

        return redirect()->route('home')
            ->with('info','Usuario Guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        return view('users.show', compact('user'));
    }

     public function showprofile(User $user)
    {   
        return view('users.showprofile', compact('user'));
    }

    public function showdirector(User $user)
    {   
        return view('directors.show', compact('user'));
    }

    public function showsecretary(User $user)
    {   
        return view('secretarys.show', compact('user'));
    }

    public function showpsicologo(User $user)
    {   
        return view('psicologos.show', compact('user'));
    }

    public function showpaciente(User $user)
    {   
        return view('patients.show', compact('user'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get();

        return view('users.edit',compact('user','roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa'));
    }


        public function editdirector(User $user)
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get();

        return view('directors.edit',compact('user','roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa'));
    }


    public function editsecretaria(User $user)
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get()->where('name','Secretaria');

        return view('secretarys.edit',compact('user','roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa'));
    }

    public function editpsicologo(User $user)
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')->pluck('name','id');
        $roles = Role::get()->where('name','Psicologo');

        return view('psicologos.edit',compact('user','roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa'));
    }

    public function editpaciente(User $user)
    {
        $categorias = UserType::OrderBy('name','ASC')->pluck('name','id');
        $listaregiones = Region::OrderBy('id','ASC')->pluck('name','id');
        $listacomunas = Commune::OrderBy('region_id','ASC')->pluck('name','id');
        $instituciones = Institution::OrderBy('id','ASC')->pluck('name','id');
        $nivelse = SocioEconomic::OrderBy('id','ASC')->pluck('name','id');
        $fonasa = Fonasa::OrderBy('id','ASC')-> pluck('name','id');
        $roles = Role::get()
        ->where('name','Paciente');
        $estado = estado::OrderBy('id','ASC')->pluck('name','id');

        return view('patients.edit',compact('user','roles','categorias','listacomunas','listaregiones','instituciones','nivelse','fonasa','estado'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         $user->update($request->all());

         $user->roles()->sync($request->get('roles'));

        return redirect()->route('home')
            ->with('info','Usuario Actualizado con exito');

    }

    public function password(){
        return view('users.password');
    }

    public function updatepassword(Request $request){

        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];
        
        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('users/password')->withErrors($validator);
        }
        else{
            if (Hash::check($request->mypassword, Auth()->user()->password)){
                $user = new User;
                $user->where('email', '=', Auth()->user()->email)
                     ->update(['password' => bcrypt($request->password)]);
                
                return redirect()->route('users.showprofile', Auth()->user()->id)
                ->with('info','Contraseña Actualizado con exito');
            }   
            else
            {
                return redirect('users/password')->with('message', 'Credenciales incorrectas, compruebe que las contraseñas coincidan');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('info', 'Eliminado Correctamente');
    }
}
