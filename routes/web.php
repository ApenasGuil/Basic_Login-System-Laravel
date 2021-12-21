<?php

use App\Models\{
    User,
};
use App\Http\Controllers\{
    AuthController,
};
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Route
};

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

Route::get('/', function () {
    // User::create([
    //     'name' => 'Guilherme Moraes',
    //     'email' => 'kyzonner@gmail.com',
    //     'password' => Hash::make('123'),
    // ]);

    dd(User::find(1));
});

Route::group([
    'middleware' => [
        'guest', // Acessível apenas por usuários logados
        // Alterar a rota em Middleware/RedirectIfAuthenticated.php para caso falhe a verificação
    ]
], function () {
    Route::view('/login', 'login')->name('form.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.do');
});

Route::group([
    'middleware' => [
        'auth', // Acessível apenas por usuários logados
        // Alterar a rota em Middleware/Authenticate.php para caso falhe a verificação
    ]
], function () {
    Route::view('/system', 'system')->name('form.system');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.do');
});

Route::get('/check', [AuthController::class, 'check'])->name('check.user');
