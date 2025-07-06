<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – All Ads</title>
</head>
<body>
    <h2>Admin Panel – All Ads</h2>
    <form action="{{ route('en.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    @foreach($ads as $ad)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <strong>{{ $ad->title }}</strong><br>
            <small>Author: {{ $ad->user->email }}</small>
            <div>{!! $ad->content !!}</div>
        </div>
    @endforeach
</body>
</html>
