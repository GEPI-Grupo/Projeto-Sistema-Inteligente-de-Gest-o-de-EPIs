<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\TesteController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', function () {
    return '<h1>Login efetuado com sucesso!</h1>
            <form action="' . route('logout') . '" method="POST">
                ' . csrf_field() . '
                <button type="submit">Sair</button>
            </form>';
})->middleware('auth')->name('dashboard');




// Route::get('/', function () {
//     return view('portfolio');
// });


// Route::get('/teste', [TesteController::class, 'index'])->name('teste');

// Route::post('/teste', [TesteController::class, 'index'])->name('teste');


?>