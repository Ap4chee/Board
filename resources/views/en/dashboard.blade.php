<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<h2>All Ads</h2>
<p>Welcome, {{ Auth::user()->name }}!</p>

<form action="{{ route('en.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<hr>

    @foreach($ads as $ad)
        <div class="ad-box">
            <h4>{{ $ad->title }}</h4>

            <div>{!! $ad->content !!}</div>
            <small>Author: {{ $ad->user->email }}</small>

            @if($ad->user_id === Auth::id())
                <form action="{{ route('en.ads.destroy', $ad->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Delete" class="delete-btn">🗑️</button>
                </form>
            @endif
        </div>
    @endforeach

<hr>
<a href="add">Add new ad</a>
<form action="{{ route('contact') }}" method="get" style="display:inline;">
  <button type="submit">Contact Admin</button>
</form>



</body>
</html>