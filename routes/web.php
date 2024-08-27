<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\QuoteController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ModelOfCarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VehicleColorController;
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



Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
Route::get('/{id}', [IndexController::class, 'index'])->name('frontend.home')->where('id', '[0-9]+');
Route::post('/getGrades/{id}', [IndexController::class, 'getGrades'])->name('frontend.getGrades');
Route::post('/getShowrooms/{id}', [IndexController::class, 'getShowrooms'])->name('frontend.getShowrooms');

Route::post('/getModels/{id}/second', [QuoteController::class, 'getModels'])->name('frontend.getModels.second');
Route::post('/getGrades/{id}/second', [QuoteController::class, 'getGrades'])->name('frontend.getGrades.second');

Route::post('/quote/save', [QuoteController::class, 'store'])->name('frontend.quote.save');
Route::post('/quote/store/final', [QuoteController::class, 'storeFinal'])->name('frontend.quote.store.final');
Route::get('/quote/{id}/second-part/show', [QuoteController::class, 'show'])->name('frontend.quote_second.show');
Route::get('/quote/second-part/update', [QuoteController::class, 'update'])->name('frontend.quote_second.update');

Route::get('/quote/{id}/quote/final/proform', [QuoteController::class, 'finalQuote'])->name('frontend.quote.final.proform');
Route::get('/quote/pdf/{quote_id}', [QuoteController::class, 'generatePDF'])->name('frontend.quote.pdf');
Route::get('/quote/thanks/{id}', [QuoteController::class, 'thanks'])->name('frontend.thanks');
Route::get('/quote/online/{id}/reservation', [QuoteController::class, 'online'])->name('frontend.online.reservation');
Route::post('/frontend/contact/whatsapp/{id}', [QuoteController::class, 'whatsapp'])->name('frontend.contact.whatsapp');

Route::post('/quote/online/reservation/bank/transfer', [QuoteController::class, 'bank_transfer'])->name('frontend.bank.transfer');
Route::post('/quote/quote/store/voucher', [QuoteController::class, 'voucher'])->name('frontend.quote.store.voucher');
Route::get('/quote/thanks/{id}/voucher', [QuoteController::class, 'thanksVoucher'])->name('frontend.thanks.voucher');

Route::post('/quote/online/reservation/libelula/transfer', [QuoteController::class, 'libelula_transfer'])->name('frontend.quote.libelula.transfer');
Route::get('/quote/online/reservation/libelula/successfulPayment', [QuoteController::class, 'successfulPayment'])->name('frontend.quote.libelula.successfulPayment');



Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('backend/quote/index', [QuoteController::class, 'index'])->name('backend.quote.index');
    Route::post('backend/quote/index/export', [QuoteController::class, 'export'])->name('backend.quote.index.export');
    Route::get('backend/quote/index/online', [QuoteController::class, 'transferOnline'])->name('backend.quote.index.online');
    Route::get('backend/quote/index/bank', [QuoteController::class, 'bank'])->name('backend.quote.index.bank');
    Route::get('backend/quote/create', [QuoteController::class, 'create'])->name('backend.quote.create');
    Route::post('backend/quote/store', [QuoteController::class, 'store'])->name('backend.quote.store');
    Route::get('backend/quote/{id}/edit', [QuoteController::class, 'edit'])->name('backend.quote.edit');
    Route::post('backend/quote/update', [QuoteController::class, 'update'])->name('backend.quote.update');
    Route::post('backend/quote/delete', [QuoteController::class, 'destroy'])->name('backend.quote.delete');
    Route::get('backend/quote/resend/{id}/information', [QuoteController::class, 'resend'])->name('backend.quote.resend.information');
    Route::get('backend/quote/verify/{id}/payment', [QuoteController::class, 'verifyPayment'])->name('backend.quote.verify.payment');

    Route::get('backend/vehicle/grade/index', [GradeController::class, 'index'])->name('backend.vehicle.grade.index');
    Route::get('backend/vehicle/grade/create', [GradeController::class, 'create'])->name('backend.vehicle.grade.create');
    Route::post('backend/vehicle/grade/store', [GradeController::class, 'store'])->name('backend.vehicle.grade.store');
    Route::get('backend/vehicle/grade/{id}/edit', [GradeController::class, 'edit'])->name('backend.vehicle.grade.edit');
    Route::post('backend/vehicle/grade/update', [GradeController::class, 'update'])->name('backend.vehicle.grade.update');
    Route::post('backend/vehicle/grade/delete', [GradeController::class, 'destroy'])->name('backend.vehicle.grade.delete');


    Route::get('backend/vehicle/color/index', [VehicleColorController::class, 'index'])->name('backend.vehicle.color.index');
    Route::get('backend/vehicle/color/create', [VehicleColorController::class, 'create'])->name('backend.vehicle.color.create');
    Route::post('backend/vehicle/color/store', [VehicleColorController::class, 'store'])->name('backend.vehicle.color.store');
    Route::get('backend/vehicle/color/{id}/edit', [VehicleColorController::class, 'edit'])->name('backend.vehicle.color.edit');
    Route::post('backend/vehicle/color/update', [VehicleColorController::class, 'update'])->name('backend.vehicle.color.update');
    Route::post('backend/vehicle/color/delete', [VehicleColorController::class, 'destroy'])->name('backend.vehicle.color.delete');


    Route::get('backend/vehicle/additional/index', [ModelOfCarController::class, 'index'])->name('backend.vehicle.additional.index');

    Route::get('backend/vehicle/model/index', [ModelOfCarController::class, 'index'])->name('backend.vehicle.model.index');
    Route::get('backend/vehicle/model/create', [ModelOfCarController::class, 'create'])->name('backend.vehicle.model.create');
    Route::post('backend/vehicle/model/store', [ModelOfCarController::class, 'store'])->name('backend.vehicle.model.store');
    Route::get('backend/vehicle/model/{id}/edit', [ModelOfCarController::class, 'edit'])->name('backend.vehicle.model.edit');
    Route::post('backend/vehicle/model/update', [ModelOfCarController::class, 'update'])->name('backend.vehicle.model.update');
    Route::post('backend/vehicle/model/delete', [ModelOfCarController::class, 'destroy'])->name('backend.vehicle.model.delete');

    Route::get('backend/vehicle/type/index', [TypeController::class, 'index'])->name('backend.vehicle.type.index');
    Route::post('backend/vehicle/type/store', [TypeController::class, 'store'])->name('backend.vehicle.type.store');
    Route::get('backend/vehicle/type/{id}/edit', [TypeController::class, 'edit'])->name('backend.vehicle.type.edit');
    Route::post('backend/vehicle/type/update', [TypeController::class, 'update'])->name('backend.vehicle.type.update');
    Route::post('backend/vehicle/type/{id}/delete', [TypeController::class, 'destroy'])->name('backend.vehicle.type.delete');


    Route::get('backend/configuration/city/index', [CityController::class, 'index'])->name('backend.configuration.city.index');
    Route::post('backend/configuration/city/store', [CityController::class, 'store'])->name('backend.configuration.city.store');
    Route::get('backend/configuration/city/{id}/edit', [CityController::class, 'edit'])->name('backend.configuration.city.edit');
    Route::post('backend/configuration/city/update', [CityController::class, 'update'])->name('backend.configuration.city.update');
    Route::post('backend/configuration/city/{id}/delete', [CityController::class, 'destroy'])->name('backend.configuration.city.delete');

    Route::get('backend/configuration/showroom/index', [ShowroomController::class, 'index'])->name('backend.configuration.showroom.index');
    Route::post('backend/configuration/showroom/store', [ShowroomController::class, 'store'])->name('backend.configuration.showroom.store');
    Route::get('backend/configuration/showroom/{id}/edit', [ShowroomController::class, 'edit'])->name('backend.configuration.showroom.edit');
    Route::post('backend/configuration/showroom/update', [ShowroomController::class, 'update'])->name('backend.configuration.showroom.update');
    Route::post('backend/configuration/showroom/{id}/delete', [ShowroomController::class, 'destroy'])->name('backend.configuration.showroom.delete');


    Route::get('backend/configuration/agent/index', [AgentController::class, 'index'])->name('backend.configuration.agent.index');
    Route::post('backend/configuration/agent/store', [AgentController::class, 'store'])->name('backend.configuration.agent.store');
    Route::get('backend/configuration/agent/{id}/edit', [AgentController::class, 'edit'])->name('backend.configuration.agent.edit');
    Route::post('backend/configuration/agent/update', [AgentController::class, 'update'])->name('backend.configuration.agent.update');
    Route::post('backend/configuration/agent/{id}/delete', [AgentController::class, 'destroy'])->name('backend.configuration.agent.delete');


    Route::get('backend/whatsapp/index', [ContactFormController::class, 'index'])->name('backend.whatsapp.index');
    Route::get('backend/configuration/whatsapp/{id}/edit', [ContactFormController::class, 'edit'])->name('backend.configuration.whatsapp.edit');
    Route::post('backend/configuration/whatsapp/{id}/delete', [ContactFormController::class, 'destroy'])->name('backend.configuration.whatsapp.delete');
    Route::get('backend/whatsapp/resend/{id}/information', [ContactFormController::class, 'resend'])->name('backend.whatsapp.resend.information');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
