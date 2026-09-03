<!DOCTYPE html>
<html lang="en" x-data="theme" :class="{'dark':darkMode}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <aside></aside>
    {{-- dynamic contents --}}
    <main>
        @yield('content')
    </main>
</body>

</html>