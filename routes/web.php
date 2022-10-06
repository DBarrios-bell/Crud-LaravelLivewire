<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\ExpensesController;
use App\Http\Livewire\PermissionController;
use App\Http\Livewire\Resports;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::middleware(['auth:web'])->group(function(){
    Route::get('/', UsersController::class)->name('user');
    Route::get('/roles', RolesController::class)->name('roles');
    Route::get('/permisos', PermissionController::class)->name('permisos');
    Route::get('/gastos', ExpensesController::class)->name('gastos');
    Route::get('/reportes', Resports::class)->name('reportes');

    Route::get('/exportar', [ExportController::class, 'export'])->name('exportar');

    Route::get('report/excel/{user}/{f1}/{f2}', [ExportController::class, 'reporteExcel']);

    Route::get('report/pdf/{user}/pdf/{f1}/{f2}', [ExportController::class, 'reportePDF']);
});
