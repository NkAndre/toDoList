<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status das Tarefas</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/app.css'])
</head>

<body>
    <header class="navbar">
        <div class="logo">Gerenciador de Tarefas-todoList</div>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="/status">Status</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-login" style="border:none; cursor:pointer; margin-left:20px;">
                        Sair ({{ Auth::user()->name }})
                    </button>
                </form>
            @else
                <a href="/login" class="btn-login">Login</a>
            @endauth
        </nav>
    </header>

    <button id="themeBtn">🌙</button>

    <div class="box status-box">
        <h2>Minhas Tarefas por Status</h2>
        <div class="table-container">
            <table class="status-table">
                <thead>
                    <tr>
                        <th>Tarefa</th>
                        <th>Status</th>
                        <div id="react-root"></div>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarefasComStatus as $t)
                        <tr>
                            <td>{{ $t->tituloTarefa }}</td>
                            <td><span class="status-badge">{{ $t->valor }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($tarefasComStatus->isEmpty())
                <p style="text-align: center; margin-top: 20px; color: var(--text-main);">
                    Nenhuma tarefa encontrada para o seu usuário.
                </p>
            @endif
        </div>
    </div>
</body>

</html>