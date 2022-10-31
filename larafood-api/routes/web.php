<?php

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

Route::prefix('admin')->group(function() {
  // listar todos os planos
  Route::get('/plans', [\App\Http\Controllers\Admin\PlanController::class,'index'])->name('plans.index');

  // página de criar um novo plano
  Route::get('/plans/create', [\App\Http\Controllers\Admin\PlanController::class,'create'])->name('plans.create');
  Route::post('/plans/create', [\App\Http\Controllers\Admin\PlanController::class,'store'])->name('plans.store');

  //visualizar detalhes de um plano
  Route::get('/plans/{url}', [\App\Http\Controllers\Admin\PlanController::class,'show'])->name('plans.show');

  //visualizar detalhes de um plano
  Route::get('/plans/{url}/edit', [\App\Http\Controllers\Admin\PlanController::class,'edit'])->name('plans.edit');
  Route::put('/plans/{url}', [\App\Http\Controllers\Admin\PlanController::class,'update'])->name('plans.update');
  Route::delete('/plans/{url}', [\App\Http\Controllers\Admin\PlanController::class,'destroy'])->name('plans.destroy');

  // buscar um plano
  Route::any('/plans/search', [\App\Http\Controllers\Admin\PlanController::class,'search'])->name('plans.search');

  Route::get('/', [\App\Http\Controllers\Admin\PlanController::class,'index'])->name('admin.index');
});

Route::get('/', function () {
  return view('welcome');
});
