<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="{{url('js/script.js')}}"></script>
</head>

<body>
    
    <button id="themeBtn">🌙</button>

    <div class="box">
        <h2>Gerenciador de tarefas</h2>

        <div class="input-group">
            <input type="text" id="tarefaInput" placeholder="Insira a tarefa">
            
            <!--  <input type="date" name="data" value="{{ isset($dataCriacao) ? $dataCriacao->data_nascimento->format('Y-m-d') : old('data_nascimento') }}"> -->
           
            
            <button id="addButton">Adicionar</button>
        </div>
        <ul id="lstTarefa">
            @foreach($tarefas as $t) 
            <span id="tituloTarefa">{{ $t->tituloTarefa }}
                <p>Início:{{ $t->dataCriacao }} Conaaclusão:{{ $t->prazo }}</p>
            </span>
            @endforeach

            @foreach($statusItem as $s)
            <p>Status:{{ $s->valor }}</p>
            @endforeach
        </ul>
    </div>

</body>

</html>