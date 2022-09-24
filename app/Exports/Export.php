<?php

namespace App\Exports;

use App\Models\Expense;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromCollection, WithHeadings
{

    public function collection()
    {
        $gastos = Expense::select('id','user_id','nombre','valor','created_at','descripcion')
        ->where('user_id', Auth::user()->id)->get();
        return $gastos;
    }

    public function headings(): array
    {
        return [
            'Id',
            'Id Usuario',
            'Nombre gasto',
            'Valor',
            'Fecha',
            'Descripcion',
        ];
    }

}
