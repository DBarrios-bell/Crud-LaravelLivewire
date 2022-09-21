<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpensesController extends Component
{
    public $nombre, $valor, $descripcion, $selected_id;

    public function render()
    {
        $idsession = Auth::user()->id;
        $gastos = Expense::where('user_id', $idsession)->paginate(5);
        return view('livewire.gastos.component', [
            'gastos' => $gastos
        ])->extends('layouts.app')->section('content');
    }

    public function store()
    {
        $rules = [
            'nombre' => 'required',
            'valor' => 'required',
            'descripcion' => 'required',
        ];
        $this->validate($rules);
        $gasto = Expense::create([
            'user_id' => Auth::user()->id,
            'nombre' => $this->nombre,
            'valor' => $this->valor,
            'descripcion' => $this->descripcion,
        ]);
        $gasto->save();
        $this->resetUI();
        session()->flash('status', "Gasto ($gasto->nombre) Creado");
    }

    public function Edit($id)
    {
        $gasto = Expense::find($id, ['id', 'nombre', 'valor', 'descripcion']);

        $this->selected_id = $gasto->id;
        $this->nombre = $gasto->nombre;
        $this->valor = $gasto->valor;
        $this->descripcion = $gasto->descripcion;
    }

    public function Update()
    {
        $rules = [
            'nombre' => 'required',
            'valor' => 'required',
            'descripcion' => 'required',
        ];
        $this->validate($rules);
        $gasto = Expense::find($this->selected_id);
        $gasto->update([
            'nombre' => $this->nombre,
            'valor' => $this->valor,
            'descripcion' => $this->descripcion,
        ]);
        $gasto->save();
        $this->resetUI();
        session()->flash('status', "Gasto ($gasto->nombre) Actualizado");

    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->valor = '';
        $this->descripcion = '';
    }
}
