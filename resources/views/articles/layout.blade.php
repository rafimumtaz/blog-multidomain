<!DOCTYPE html>
<html>
<head>
    <title>Multi-Institusi Blog</title>
</head>
<body>
    <nav>
        <a href="{{ route('articles.index') }}">Beranda</a>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
