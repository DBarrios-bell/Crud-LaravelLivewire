<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ExpensesController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    private $pagination = 6;

    public $nombre, $valor, $descripcion, $selected_id, $search, $dateFrom, $dateTo;

    public function render()
    {
        $idsession = Auth::user()->id;
        $gastos = Expense::where('user_id', $idsession)->paginate($this->pagination);
        $count = Expense::where('user_id', $idsession)->count();
        return view('livewire.gastos.component', [
            'gastos' => $gastos,
            'counts'=> $count
        ])->extends('layouts.app')->section('content');
    }

    public function store()
    {
        $rules = [
            'nombre' => 'required',
            'valor' => 'required|numeric',
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
        session()->flash('status', "Gasto ($gasto->nombre) Actualizado");
        $this->resetUI();

    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->valor = '';
        $this->descripcion = '';
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id)
    {
        Expense::find($id)->delete();
        session()->flash('status', 'Gasto Eliminado');
    }

    public function searchExpenses()
    {
        if($this->reportType == 0) // ventas del dia
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';

        } else {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo =='')) {
            return;
        }

        if($this->userId == 0)
        {
            // $this->data = Sale::join('users as u','u.id','sales.user_id')
            // ->join('sale_points as sp', 'sp.id', 'sales.salepoint_id')
            // ->select('sales.*','u.name as user','sp.name as puntoventa')
            // ->whereBetween('sales.created_at', [$from, $to])
            // ->where('salepoint_id', $this->session)
            // ->get();
        } else {
        //  $this->data = Sale::join('users as u','u.id','sales.user_id')
        //     ->join('sale_points as sp', 'sp.id', 'sales.salepoint_id')
        //     ->select('sales.*','u.name as user','sp.name as puntoventa')
        //     ->whereBetween('sales.created_at', [$from, $to])
        //     ->where('user_id', $this->userId)
        //     ->where('salepoint_id', $this->session)
        //     ->get();
        }
    }
}
