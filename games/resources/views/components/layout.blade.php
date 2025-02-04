<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body>

        <x-navigation />
        
        @if(session("success"))
            <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                <p>
                    Success
                </p>
                <p>
                    {{ session('success') }}
                </p>
            </div>
        @endif
        @if(session("error"))
            <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                <p>
                    Error
                </p>
                <p>
                    {{ session('error') }}
                </p>
            </div>
        @endif

        {{ $slot }}
    </body>
</html>
