<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('images/icon.ico') }}">
    <title>Arabito Facturación</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table/table.css') }}" rel="stylesheet">
   
</head>
<body>
    <section class="content">
        
        @yield('nav')
        
        <div id="app"></div>
        
        @yield('content')
    </section> 
    
    
</body>
</html>
