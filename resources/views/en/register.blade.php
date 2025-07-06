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

    <h2>Register</h2>
<form method="POST" action="{{ route('en.register') }}">
    @csrf
    <input type="text" name="name" placeholder="Name"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password"><br>
    <button type="submit">Register</button>
</form>

</body>
</html>