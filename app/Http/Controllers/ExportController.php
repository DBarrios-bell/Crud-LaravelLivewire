<?php

namespace App\Http\Controllers;

use App\Exports\Export;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function reportePDF($userid, $fromDate, $toDate)
    {
        $expenses = [];

        if ($this->userid == 0) {
            $fi = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $ff = Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';
            $expenses = Expense::join('users as u', 'u.id', 'expenses.user_id')
                ->select('expenses.*', 'u.nombre as nombreuser', 'u.apellido as apellidouser')
                ->WhereBetween('expenses.created_at', [$fi, $ff])
                ->WhereBetween('valor', [$this->Vmin, $this->Vmax])
                ->get();
        } else {
            $fi = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
            $ff = Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

            $expenses = Expense::join('users as u', 'u.id', 'expenses.user_id')
                ->select('expenses.*', 'u.nombre as nombreuser', 'u.apellido as apellidouser')
                ->whereBetween('expenses.created_at', [$fi, $ff])
                ->WhereBetween('valor', [$this->Vmin, $this->Vmax])
                ->Where('user_id', $this->userid)
                ->get();
        }

        $user = $userid == 0 ? 'Todos' : User::find($userid)->nombre;
        $pdf = PDF::loadView('pdf.reporte', compact('expenses','user', 'fromDate','toDate'));
        // return $pdf->stream('reporteDeGastos.pdf');
        return $pdf->download('reporteDeGastos.pdf');
    }


    public function reporteExcel($userid, $fromDate = null, $toDate = null)
    {
        $reportName = 'Reporte de Gasto por Usuario_' . uniqid() . '.xlsx';
        return Excel::download(new Export($userid, $fromDate, $toDate), $reportName);
    }

    public function export()
    {
        return Excel::download(new Export, 'Gastos.xlsx');
    }
}
