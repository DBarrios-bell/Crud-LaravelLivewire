<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class UsersController extends Component
{
    public $nombre, $apellido, $cedula, $telefono, $email, $password, $selected_id;


    public function render()
    {
        $idsession = Auth::user()->id;
        $users = User::where('id',$idsession)->get();
        return view('livewire.users.component',[
            'users' => $users
            ])->extends('layouts.app')->section('content');
    }

    public function store()
    {
        $rules = [
            'cedula'=> 'required|integer|min:5',
            'nombre'=> 'required|min:4',
            'apellido'=> 'required|min:6',
            'perfil'=> 'required',
            'email'=> 'required|email',
            'password'=>'required',
            'telefono'=> 'required|integer|min:10'
        ];

        $this->validate($rules);

        $user = User::create([
            'cedula'=>$this->cedula,
            'nombre'=>$this->nombre,
            'perfil'=>$this->perfil,
            'apellido'=>$this->apellido,
            'email'=>$this->email,
            'password'=>bcrypt($this->password),
            'telefono'=>$this->telefono,
        ]);

        $user->save();
        $this->resetUI();
        session()->flash('status', 'Usuario Registrado Satisfactoriamente');
    }

    public function Edit($id)
    {
        $edit = User::find($id,['id','cedula','nombre','apellido','email','password','telefono']);

        $this->selected_id = $edit->id;
        $this->cedula = $edit->cedula;
        $this->nombre = $edit->nombre;
        $this->apellido = $edit->apellido;
        $this->perfil = $edit->perfil;
        $this->email = $edit->email;
        $this->password = $edit->password;
        $this->telefono = $edit->telefono;
    }

    public function Update()
    {
        $rules = [
            'cedula'=> "required|integer|min:5|unique:users,cedula,{$this->selected_id}",
            'nombre'=> 'required|min:4',
            'apellido'=> 'required|min:6',
            'perfil'=> 'required',
            'email'=> 'required|email',
            'password'=>'required',
            'telefono'=> 'required|integer|min:10'
        ];

        $this->validate($rules);

        $user = User::find($this->selected_id);
        $user->update([
            'cedula'=>$this->cedula,
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'perfil'=>$this->perfil,
            'email'=>$this->email,
            'password'=>bcrypt($this->password),
            'telefono'=>$this->telefono,
        ]);

        $user->save();
        $this->resetUI();
        session()->flash('status', 'Usuario Actualizado Satisfactoriamente');
    }

    protected $listeners =[
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id)
    {
        try {
            $user = User::find($id);
            $user ->delete();
            session()->flash('status', "Se ha eliminado el Usuario con ID $id");
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            if (strstr($message,"Integrity constraint violation")) {
                session()->flash('danger', "El usuario con CC $user->cedula no puede ser eliminado porque tiene gastos");
            }
        }
    }

    public function resetUI(){
        $this->cedula ='';
        $this->nombre = '';
        $this->apellido = '';
        $this->perfil = '';
        $this->email='';
        $this->password='';
        $this->telefono ='';
    }
}
