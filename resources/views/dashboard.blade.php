<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="{{ asset('js/script.js') }}" defer></script>
    <title></title>

        @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/app.css'])
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

    <div id="dashboard-root" 
        data-user="{{ Auth::user()->name ?? '' }}"
        data-total="{{ $total }}"
        data-pendentes="{{ $pendentes }}"
        data-concluidas="{{ $concluidas }}"
        data-atrasadas="{{ $atrasadas }}">
        {{-- O React vai renderizar tudo aqui dentro --}}
    </div>
       
    </div>



</body>

</html>