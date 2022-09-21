<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::create([
            'user_id' => 1,
            'nombre' => 'Comida',
            'valor' => 20000,
            'descripcion'=>'almuerzo y cena 19-09-2022'
        ]);
    }
}
