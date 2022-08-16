<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script>
            window.loggedIn = @json( Auth::check() );
            window.user = @json( Auth::user(), JSON_PRETTY_PRINT );
        </script>
        
    </head>
    <body class="bg-white">
        
        <div id="app">

            <main-component />

        </div>

        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
