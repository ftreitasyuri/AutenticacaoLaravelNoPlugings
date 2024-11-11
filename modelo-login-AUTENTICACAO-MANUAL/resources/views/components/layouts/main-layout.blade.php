<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pageTitle}}</title>
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png"> --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

    <nav class="navbar container-fluid bg-primary justify-content-end py-3 px-3">
        @if (Auth::user())
        <a href="{{ route('logout') }}" class="nav-link mr-4">LogOut</a>    
        @else
        <a href="{{ route('login') }}" class="nav-link">Home</a>
        @endif
        
    </nav>
    
    {{-- Permit que todo o conteúdo seja vinculado com essa página layout --}}
    {{$slot}}
    

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>