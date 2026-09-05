<!DOCTYPE html>
<html lang="en" x-data="theme" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="@yield('favicon', asset('images/favicons/login.png'))">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header.auth-header />
    <main class="px-4 md:px-12">
        @yield('content')
    </main>
</body>

</html>