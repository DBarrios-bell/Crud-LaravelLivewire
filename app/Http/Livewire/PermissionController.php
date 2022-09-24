<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class PermissionController extends Component
{
    public $selected_id, $permisoName;

    public function render()
    {
        $permiso = Permission::all();
        return view('livewire.permisos.component',[
            'permisos' => $permiso
        ])->extends('layouts.app')
        ->section('content');
    }

    public function CreatePermiso()
    {
        $rules = [
            'permisoName'=>'required|min:3|unique:permissions,name'
        ];
        $this->validate($rules);

        Permission::create(['name'=>$this->permisoName]);

        session()->flash('status', 'Permiso Registrado');
        $this->resetUI();
    }

    public function Edit($id)
    {
        $permiso = Permission::find($id);
        $this->selected_id = $permiso->id;
        $this->permisoName = $permiso->name;
    }

    public function UpdatePermiso()
    {
        $rules = [
        'permisoName'=>"required|min:3|unique:permissions,name,{$this->selected_id}"
        ];
        $this->validate($rules);
        $permiso = Permission::find($this->selected_id);

        $permiso->name = $this->permisoName;
        $permiso->save();
        session()->flash('status', 'Permiso Actalizado');
        $this->resetUI();
    }

    protected $listeners =[
        'deleteRow'=>'Destroy'
    ];

    public function Destroy($id)
    {
        Permission::find($id)->delete();
        session()->flash('status', 'Permiso Eliminado');
    }

    public function resetUI()
    {
        $this->permisoName = ' ';
        $this->selected_id = 0;
    }
}
