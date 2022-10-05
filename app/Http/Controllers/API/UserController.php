<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        "cedula"     =>  ['required', "numeric" , 'unique:users,cedula'],
        'nombre'     =>  ['required', 'string', 'max:255'],
        'apellido'   =>  ['required', 'string', 'max:255'],
        'email'    =>  ['required', 'email', 'max:255', 'unique:users,email'],
        'password' =>  ['required', 'string', 'min:8'],
        'telefono' =>  ['required', 'min:3',"max:15"],
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
        ResponseController::Success($users,200);
        return User::create($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
