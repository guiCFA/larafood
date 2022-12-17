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

  //Rotas de Permissão
  Route::any('/permissions/search', [\App\Http\Controllers\Admin\ACL\PermissionController::class,'search'])->name('permissions.search');
  Route::resource('/permissions', \App\Http\Controllers\Admin\ACL\PermissionController::class);

  //Rotas de Perfil
  Route::any('/profiles/search', [\App\Http\Controllers\Admin\ACL\ProfileController::class,'search'])->name('profiles.search');
  Route::resource('/profiles', \App\Http\Controllers\Admin\ACL\ProfileController::class);
  
  //detalhes de um plano
  Route::get('/plans/{url}/details', [\App\Http\Controllers\Admin\DetailPlanController::class,'index'])->name('details.plan.index');
  Route::post('/plans/{url}/details', [\App\Http\Controllers\Admin\DetailPlanController::class,'store'])->name('details.plan.store');
  Route::get('/plans/{url}/details/create', [\App\Http\Controllers\Admin\DetailPlanController::class,'create'])->name('details.plan.create');
  Route::get('/plans/{url}/details/{idDetail}/edit', [\App\Http\Controllers\Admin\DetailPlanController::class,'edit'])->name('details.plan.edit');
  Route::put('/plans/{url}/details/{idDetail}', [\App\Http\Controllers\Admin\DetailPlanController::class,'update'])->name('details.plan.update');
  Route::get('/plans/{url}/details/{idDetail}', [\App\Http\Controllers\Admin\DetailPlanController::class,'show'])->name('details.plan.show');
  Route::delete('/plans/{url}/details/{idDetail}', [\App\Http\Controllers\Admin\DetailPlanController::class,'destroy'])->name('details.plan.destroy');

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

  // home
  Route::get('/', [\App\Http\Controllers\Admin\PlanController::class,'index'])->name('admin.index');
});

Route::get('/', function () {
  return view('welcome');
});
