<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="{{ asset('js/script.js') }}" defer></script>
    <title></title>
</head>

<body>
    <header class="navbar">
        <div class="logo">Gerenciador de Tarefass-todoList

            <!--  -->
            @auth
            | Olá, {{ Auth::user()->name }}
            @endauth
        </div>

        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('dashboard') }}">dashboard</a>
            <a href="{{ route('status.index') }}">Status</a>

            @auth
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout" style="background:none; border:none; color:red; cursor:pointer;">Sair</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            @endauth
        </nav>
    </header>

    <button id="themeBtn">🌙</button>
    <div class="estatisticas">
        <h2>Gerenciador de tarefas ({{ $total }})</h2>
        <h3>Total de Tarefas: {{ $total }}</h3>
    </div>




</body>

</html>