<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Admin</title>
</head>
<body>
  <h2>Contact Admin</h2>

  @if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
  @endif

  @if($errors->any())
    <div style="color: red">
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('contact.send') }}">
    @csrf
    <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}"><br><br>
    <textarea name="message" placeholder="Message">{{ old('message') }}</textarea><br><br>
    <button type="submit">Send</button>
  </form>

  <p><a href="{{ route('en.dashboard') }}">← Back to Dashboard</a></p>
</body>
</html>
