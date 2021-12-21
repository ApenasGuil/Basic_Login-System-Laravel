<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auth</title>
</head>

<body>
    <h1>System</h1>
    Usuário logado: {{ Auth::user()->name }} <br>
    <a type="button" href="{{ route('logout.do') }}">Logout</a>
</body>

</html>
