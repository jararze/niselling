<?php

use App\Http\Controllers\ModelOfCarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth','verified'])->group(function () {

    Route::get('backend/vehicle/model/index', [ModelOfCarController::class, 'index'])->name('backend.vehicle.model.index');
    Route::get('backend/vehicle/model/create', [ModelOfCarController::class, 'create'])->name('backend.vehicle.model.create');
    Route::post('backend/vehicle/model/store', [ModelOfCarController::class, 'store'])->name('backend.vehicle.model.store');





    Route::get('backend/vehicle/type/index', [TypeController::class, 'index'])->name('backend.vehicle.type.index');
    Route::post('backend/vehicle/type/store', [TypeController::class, 'store'])->name('backend.vehicle.type.store');
    Route::get('backend/vehicle/type/{id}/edit', [TypeController::class, 'edit'])->name('backend.vehicle.type.edit');
    Route::post('backend/vehicle/type/update', [TypeController::class, 'update'])->name('backend.vehicle.type.update');
    Route::post('backend/vehicle/type/{id}/delete', [TypeController::class, 'destroy'])->name('backend.vehicle.type.delete');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
