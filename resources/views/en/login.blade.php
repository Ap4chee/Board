<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <a href="{{ route('en.login.form') }}">Login</a> |
    <a href="{{ route('en.register.form') }}">Register</a>
    <h2>Login</h2>
<form method="POST" action="{{ route('en.login') }}">
    @csrf
    <input name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

</body>
</html>