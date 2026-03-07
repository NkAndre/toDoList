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
    <div class="logo">Gerenciador de Tarefas-todoList

    @auth 
        | Olá, {{ Auth::user()->name }} 
    @endauth
    </div>
    
    <nav>
 <a href="{{ route('home') }}">Home</a>
<a href="{{ url('/status') }}">Status</a>
<a href="{{ route('login') }}" class="btn-login">Login</a>
    </nav>
</header>
    <button id="themeBtn">🌙</button>

   <div class="box">
    <h2>Gerenciador de tarefas</h2>

   <form action="{{ route('tarefa.store') }}" method="POST">
    @csrf
    <div class="input-group">
        <input type="text" name="tituloTarefa" placeholder="Título da Tarefa" required>
        
        <select name="status_id" class="status-select" required>
            <option value="" disabled selected>Selecione o Status</option>
            @foreach($statusItem as $s)
                <option value="{{ $s->id }}">{{ $s->valor }}</option>
            @endforeach
        </select>

        <input type="date" name="dataCriacao" required>
        <input type="date" name="prazo" required>
        <button type="submit">Adicionar</button>
    </div>
</form>

<ul id="lstTarefa">
    @foreach($tarefas as $t) 
        <li>
            <div class="tarefa-info">
                <strong>{{ $t->tituloTarefa }}</strong>
                
                {{-- Busca o nome do status baseado no ID que salvamos --}}
                @php
                    $statusDaTarefa = $statusItem->firstWhere('id', $t->status_id);
                @endphp
                
                <span class="status-tag">
                    {{ $statusDaTarefa ? $statusDaTarefa->valor : 'Sem status' }}
                </span>

                <p>Início: {{ $t->dataCriacao }} | Prazo: {{ $t->prazo }}</p>
            </div>
            
            <form action="{{ route('tarefa.destroy', $t->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">❌</button>
            </form>
        </li>
    @endforeach
</ul>
</div>

</body>

</html>