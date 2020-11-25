<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} :: @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="logo">
        <img src="{{asset('img/1.png')}}" alt="logo">
    </div>
    <!-- herdado da classe filho  -->
    <div class="container">
        @yield('conteudo') 
    </div>
    <footer>
        <p>Digital - 2019</p>
    </footer>
</body>
</html>