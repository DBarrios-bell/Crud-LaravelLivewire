<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Concatenate;
use PhpParser\Node\Expr\AssignOp\Concat;

use function PHPUnit\Framework\isEmpty;

class Resports extends Component
{
    public $fromDate, $toDate, $Vmin, $Vmax, $userid ,$expenses,$count;
    public $usuario;

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->userid = 0;
        $this->expenses = [];
    }

    public function render()
    {
        return view('livewire.resports', [
        'users' => User::orderBy('nombre', 'asc')->get()
        ])->extends('layouts.app')
        ->section('content');
    }

    public function Consultar()
    {
        if ($this->userid > 0) {
            $fi= Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
            $ff= Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

            $this->expenses =Expense::join('users as u','u.id','expenses.user_id')
            ->select('expenses.*','u.nombre as nombreuser','u.apellido as apellidouser')
            ->whereBetween('expenses.created_at', [$fi,$ff])
             ->WhereBetween('valor', [$this->Vmin ,$this->Vmax ])
             ->Where('user_id', $this->userid)
            ->get();
        }else{
            $fi= Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
            $ff= Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';
            $this->expenses =Expense::join('users as u','u.id','expenses.user_id')
            ->select('expenses.*','u.nombre as nombreuser','u.apellido as apellidouser')
            ->WhereBetween('expenses.created_at', [$fi, $ff])
            ->WhereBetween('valor', [$this->Vmin, $this->Vmax])
            ->get();
        }
    }
}
