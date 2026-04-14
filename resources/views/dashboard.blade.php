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
        <h2>Minhas Tarefas 
              @auth
            | user: {{ Auth::user()->name }}
            @endauth
        </h2>

        <div class="dashboard-grid" 
        style="display: flex; gap: 20px; flex-wrap: wrap; color:blue;">
            <div class="card">
                <h3>Total</h3>
                <p>{{ $total }}</p>
            </div>


            <div class="card" style="color: orange
            ;">
                <h3>Pendentes</h3>
                <p>{{ $pendentes }}</p> 
            </div>

            <div class="card" style="color: green;">
                <h3>Concluídas</h3>
                <p>{{ $concluidas }}</p>
            </div>

            <div class="card" style="color: red;">
                <h3>Atrasadas</h3>
                <p>{{ $atrasadas }}</p>
            </div>
        </div>
    </div>



</body>

</html>