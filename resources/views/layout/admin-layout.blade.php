<!DOCTYPE html>
<html lang="en" x-data="theme" :class="{'dark': darkMode}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex min-h-screen">
        <x-aside.admin-aside.admin-sidebar />
        <main class="w-full h-auto">
            <x-header.admin-header.admin-header />
            <div class="px-6 md:px-8 py-4 md:py-6   ">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>