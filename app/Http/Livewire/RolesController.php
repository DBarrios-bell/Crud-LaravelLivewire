<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class RolesController extends Component
{
    public $selected_id, $roleName;

    public function render()
    {
        $roles = Role::all();
        return view('livewire.roles.component',[
            'roles' => $roles
        ])->extends('layouts.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = [
            'roleName'=>'required|min:3|unique:roles,name'
        ];
        $this->validate($rules);

        Role::create(['name'=>$this->roleName]);

        session()->flash('status', 'Rol Registrado Satisfactoriamente');
        $this->resetUI();
    }

    public function Edit($id)
    {
        $role = Role::find($id);
        $this->selected_id = $role->id;
        $this->roleName = $role->name;
    }

    public function UpdateRole()
    {
        $rules = [
        'roleName'=>"required|min:3|unique:roles,name,{$this->selected_id}"
        ];
        $this->validate($rules);
        $role = Role::find($this->selected_id);

        $role->name = $this->roleName;
        $role->save();
        session()->flash('status', 'Rol Actalizado Satisfactoriamente');
        $this->resetUI();
    }

    protected $listeners =[
        'deleteRow'=>'Destroy'
    ];

    public function Destroy($id)
    {
        Role::find($id)->delete();
        session()->flash('status', 'Rol Eliminado');
    }

    public function resetUI()
    {
        $this->roleName = ' ';
        $this->selected_id = 0;
    }
}
