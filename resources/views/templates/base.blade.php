<!DOCTYPE html>
<html lang=”en”>

<head>
    <meta charset=”UTF-8”>
    <meta name="viewport" content="width=device-width,
initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel=”stylesheet” href=”{{ url('css/app.css') }}”>
</head>

<body>
    <header>
        <h1>{{ $title }}</h1>
    </header>
    <footer>
        <p>You're on the <em>{{ $title }} page<em></p>
        <p><small>Copyright &copy; {{ date('Y') }} Seneca College. All rights reserved.<small></p>
    </footer>
</body>

</html>
