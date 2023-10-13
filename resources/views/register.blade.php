<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">name</label>
        <input type="text" name="name" id="name"><br>
        <label for="email">email</label>
        <input type="text" name="email" id="email"><br>
        <label for="alamat">alamat</label>
        <input type="text" name="alamat" id="alamat"><br>
        <label for="telepon">telepon</label>
        <input type="text" name="telepon" id="telepon"><br>
        <label for="password">password</label>
        <input type="password" name="password" id="password"><br>
        <label for="rpPassword">repeat password</label>
        <input type="password" name="rpPassword" id="rpPassword"><br>
        <input type="submit" value="register">
    </form>
    <p><a href="{{ route('register') }}">don't have an account</a></p>
</body>
</html>