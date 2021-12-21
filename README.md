> routes/web.php
```php
Route::group([
    'middleware' => [
        'guest', // Acessível apenas por usuários NÃO LOGADOS
        // Alterar a rota em Middleware/RedirectIfAuthenticated.php para caso falhe a verificação
    ]
], function () {
    // Rotas para usuários NÃO AUTORIZADOS
    Route::view('/login', 'login')->name('form.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.do');

});
```

> Middleware/Authenticate.php

```php
protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('form.login'); // Especificar aqui a rota para aonde ir caso a autenticação falhe
    }
}
```

<hr>

> routes/web.php
```php
Route::group([
    'middleware' => [
        'auth', // Acessível apenas por usuários logados
        // Alterar a rota em Middleware/Authenticate.php para caso falhe a verificação
    ]
], function () {
    // Rotas para usuários NÃO AUTORIZADOS
    Route::view('/system', 'system')->name('form.system');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.do');
});
```

> Middleware/RedirectIfAuthenticated.php

```php
return redirect(RouteServiceProvider::HOME);
// Especificar aqui a rota para aonde ir caso haja um usuário logado
```

<hr>

> Controllers/AuthController.php
```php
public function login(Request $request)
{
    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) { // Verificação no DB, para ver se os dados enviados pelo form 'login' batem
        return redirect()->route('form.system');
    };

    return redirect()->route('logout.do'); // Caso as credenciais estejam erradas, redirecionado ao logout e por sua vez, à tela de login
}

public function check() // Apenas uma checagem visual sobre o usuário atualmente logado
{
    if (Auth::check() == true)
        echo "Usuário logado: " . Auth::user()->name;
    else {
        dd('Nenhum usuário logado.');
    }
}

public function logout(Request $request)
{
    Auth::logout(); // Deslogando usuário e apagando as sessões do navegador e redirecionando à tela de login
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('form.login');
}
```