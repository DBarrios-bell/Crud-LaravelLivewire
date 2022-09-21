<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\User;
use Livewire\Component;


class UsersController extends Component
{
    public $nombre, $apellido, $cedula, $telefono, $email, $password, $selected_id;


    public function render()
    {
        $users = User::all();
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
            'email'=> 'required|email',
            'password'=>'required',
            'telefono'=> 'required|integer|min:10'
        ];

        $this->validate($rules);

        $user = User::create([
            'cedula'=>$this->cedula,
            'nombre'=>$this->nombre,
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
        $gastousuario = Expense::where('user_id', $id)->count();
        if ($gastousuario > 1) {
            session()->flash('danger', "El usuario tiene gastos ID $id");
        }else{
            $user = User::find($id);
            $user ->delete();
            session()->flash('danger', "Se ha eliminado el Usuario con ID $id");

        }
    }

    public function resetUI(){
        $this->cedula ='';
        $this->nombre = '';
        $this->apellido = '';
        $this->email='';
        $this->password='';
        $this->telefono ='';
    }
}
