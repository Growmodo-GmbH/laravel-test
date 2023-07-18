<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="icon" href="{{ config('app.url') }}/favicon.ico">
        <script>
            const APP_URL="{{ config('app.url') }}";
            const ENVIRONMENT="{{ config('app.env') }}";
        </script>
        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-gray-50 h-screen antialiased leading-none font-sans overflow-x-hidden overflow-y-auto">
        <div id="app" v-cloak></div>
        @vite(['resources/js/app.js'])
    </body>
</html>
