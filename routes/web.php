<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;

Route::get('/', function () {
    return view('portfolio');
});


Route::get('/teste', [TesteController::class, 'index'])->name('teste');

Route::post('/teste', [TesteController::class, 'index'])->name('teste');


?>