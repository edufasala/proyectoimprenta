<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - Imprenta Anton</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}" />
        
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #F8F3F6;
            }
            
        </style>
    </head>
    <body>
        

        @yield('content')

        
    </body>
</html>
