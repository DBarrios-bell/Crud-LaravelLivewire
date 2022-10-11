<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $rules = [
        "cedula"     =>     ['required', "numeric" , 'unique:users,cedula'],
        'nombre'     =>     ['required', 'string', 'max:255'],
        'apellido'   =>     ['required', 'string', 'max:255'],
        'email'      =>     ['required', 'email', 'max:255', 'unique:users,email'],
        'password'   =>     ['required', 'string', 'min:8'],
        'telefono'   =>     ['required', 'min:3',"max:15"],
        "perfil"     =>     ['in:User,Admin']
    ];


    public function index()
    {
        $users = User::get();
        return ResponseController::Success($users,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $validator = Validator::make($req->input(), $this->rules);
        if ($validator->fails()) {
            return ResponseController::Error($validator->errors(),500);
        }
        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);
        $user= User::create($data);
        return ResponseController::Success($user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user){
            return ResponseController::Error("No Existe Un Usuario Con Ese Registo",404);
        }
        return ResponseController::Success($user,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();
        if(!$user){
            return ResponseController::Error("No Existe Un Usuario Con Ese Registo",404);
        }
        $validator = Validator::make($request->input(),[
            "cedula"     =>     ['required', "numeric" , 'unique:users,cedula,'. $user->cedula],
            'nombre'     =>     ['required', 'string', 'max:255'],
            'apellido'   =>     ['required', 'string', 'max:255'],
            'email'      =>     ['required', 'email', 'max:255', 'unique:users,email,'. $user->cedula],
            'password'   =>     ['required', 'string', 'min:8'],
            'telefono'   =>     ['required', 'min:3',"max:15"],
            "perfil"     =>     ['in:User,Admin']
        ]);
        if($validator->fails()){
            return ResponseController::Error($validator->errors(),400);
        }
        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return ResponseController::Success($user,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(!User::where('id',$id)->delete()){
                return ResponseController::Error("No Existe Un Usuario Con Ese Registo",404);
            }
            return ResponseController::Success("Eliminado Correctamente",200);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (strstr($message,"Integrity constraint violation")) {
                return ResponseController::Error("No Se Puede Eliminar El Usuario Con ID $id, Tiene Gastos Asociados",200);
            }
        }
        // if(!User::where('id',$id)->delete()){
        //     return ResponseController::Error("No Existe Un Usuario Con Ese Registo",404);
        // }
        // return ResponseController::Success("Eliminado Correctamente",200);
    }

    public function rol(){
        return Auth::guard('api')->user()->perfil;
    }
}
