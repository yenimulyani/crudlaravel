<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
    @yield('head')
</head>
<body>
    @yield('navbar')

    @yield('content')
    
    @yield('footer')
</body>
</html>