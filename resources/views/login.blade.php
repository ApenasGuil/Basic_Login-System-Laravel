<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guest</title>
</head>

<body>
    <h1>Login Page</h1>
    Nenhum usuário logado.
    <form action="{{ route('login.do') }}" method="post">
        @csrf
        <input type="text" name="email" value="kyzonner@gmail.com">
        <input type="password" name="password" value="">
        <input type="submit" value="GO">
    </form>
</body>

</html>
