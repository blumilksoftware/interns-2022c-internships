<!DOCTYPE html>
<html class="h-full bg-gray-100">
<head>
    <title>Praktyki @yield('title')</title>
    <link rel="icon" href="{{ asset('internships.svg') }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    @vite('js/app.js')
</head>
<body class="h-full w-full ssm:w-screen mt-0">
    @routes
    @inertia
</body>
</html>
