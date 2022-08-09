<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <div class="navbar-collapse" id="navbar">
                <a href="{{ route('homepage') }}" class="navbar-brand">
                    <img src="{{ asset('assets/img/hdcevents_logo.svg') }}" alt="{{ config('app.name') }}">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('homepage') }}" class="nav-link">Eventos</a>
                    </li>

                    @auth
                    <li class="nav-item">
                        <a href="{{ route('events.create') }}" class="nav-link">Criar Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">Meus eventos</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                        </form>
                    </li>
                    @endauth

                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Cadastrar</a>
                    </li>
                    @endguest
                </ul>    
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <div class="row">
            @if(session('msg'))
            <p class="msg">{{ session('msg') }}</p>
            @endif

            @yield('content')
        </div>
    </main>
    
    <footer>
        <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>