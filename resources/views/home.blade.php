<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="{{ asset('js/script.js') }}" defer></script>
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

    <div class="box">
        <h2>Gerenciador de tarefas</h2>


        <!-- Forms começa akii -->
        <form class="forms" action="{{ route('tarefa.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="tituloTarefa" placeholder="Título da Tarefa" required>

                <select name="status_id" class="status-select" required>
                    <option value="" disabled selected>Selecione o Status</option>
                    @foreach($statusItem as $s)
                    <option value="{{ $s->id }}">{{ $s->valor }}</option>
                    @endforeach
                </select>

                <div class="labeis">
                    <label class="label-date">Data de Criação</label>
                    <input type="date" name="dataCriacao" required>
                </div>

                <div>
                    <label class="label-date">Data de Prazo</label>
                    <input class="date" type="date" name="prazo" required>
                </div>

                <button type="submit">Adicionar</button>
            </div>
        </form>
        <!-- termina akii -->


        <!-- Listas de tarefas vai começar poe aki -->
        <ul id="lstTarefa">
            @foreach($tarefas as $t)
            <li style="flex-direction: column; align-items: flex-start;">
                <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
                    <div class="tarefa-info">
                        <strong>{{ $t->tituloTarefa }}</strong>
                        @php $statusDaTarefa = $statusItem->firstWhere('id', $t->status_id); @endphp
                        <span class="status-tag">{{ $statusDaTarefa ? $statusDaTarefa->valor : 'Sem status' }}</span>
                        <p>Prazo: {{ $t->prazo }}</p>
                    </div>

                    <div class="acoes" style="display: flex; gap: 10px;">
                        <details class="edit-details">
                            <summary style="list-style: none; cursor: pointer;">📝</summary>
                            <div class="edit-popover">

                                <form action="{{ route('tarefa.update', $t->id) }}" method="POST" class="forms">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="tituloTarefa" value="{{ $t->tituloTarefa }}" required>
                                    <select name="status_id" class="status-select">
                                        @foreach($statusItem as $s)
                                        <option value="{{ $s->id }}" {{ $t->status_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->valor }}
                                        </option>

                                        @endforeach
                                    </select>
                                    <input type="date" name="prazo" value="{{ $t->prazo }}" required>
                                    <button type="submit" style="padding: 8px;">Salvar</button>
                                </form>
                            </div>
                        </details>

                        <form action="{{ route('tarefa.destroy', $t->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">❌</button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

        <!-- end é aqui git, ué git? entao ta KKKKKKKKKKKKK-->
    </div>

</body>

</html>