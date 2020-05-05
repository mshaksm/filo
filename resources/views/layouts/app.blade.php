<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{config('app.name', 'Filo')}}</title>
</head>
<body>
    
    <div id="app">
        @include('inc.navbar')
        <br>
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>