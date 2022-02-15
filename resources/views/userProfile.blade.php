<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="User Profile" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Return to home
            </a>
        </div>
        <div class="content">
            <ul>
                <li>Name : {{ Auth::user()->name }}</li>
                <li>Surname : {{ Auth::user()->surname }}</li>
                <li>Mail : {{ Auth::user()->email }}</li>
            </ul>
        </div>
        <div class="content">
            <!--Spazione per i percorsi guidati -->
        </div>
    </div>
</body>
</html>