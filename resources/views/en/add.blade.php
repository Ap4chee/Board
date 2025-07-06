<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ad</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
<body>
<h2>Add new Ad</h2>

<form method="POST" action="{{ route('en.ads.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Title"><br><br>

    <textarea name="content" id="editor" placeholder="Content"></textarea><br>

    <button type="submit">Add Ad</button>
</form>

<hr>
<a href="dashboard">Back to Dashboard</a>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
