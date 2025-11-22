<?php

use App\Http\Controllers\CepController;
use App\Http\Controllers\ControllerPaysments;
use App\Http\Controllers\ControllerProducts;
use App\Http\Controllers\FreteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/crud', function () {
    return view('crud');
});


Route::get('/404', function () {
    return view('404Page');
});

Route::get('/countsProducts', [ControllerProducts::class, 'getProductsCount']);
Route::post('/product', [ControllerProducts::class, 'insertProducts']);
Route::get('/product', [ControllerProducts::class, 'getProducts']);
Route::get('/updateItens/{id}', [ControllerProducts::class, 'updateItemPay']);
Route::post('/cep', [CepController::class, 'getCep']);
Route::post('/addreas', [CepController::class, 'insertAddreas']);
Route::get('/userExistAddreas/{id}', [CepController::class, 'getUserExistAddreas']);
Route::get('/idUser', [ProfileController::class, 'getIduser']);
Route::get('/frete/{userId}', [FreteController::class, 'getFrete']);
Route::post('/pay', [ControllerPaysments::class, 'main']);
Route::get('/test', [ControllerPaysments::class, 'test']);
Route::get('/itens/{id}', [ControllerProducts::class, 'getItensUser']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
