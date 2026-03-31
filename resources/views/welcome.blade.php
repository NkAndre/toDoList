<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="{{url('css/login2.css')}}">
    <title>Login- ToDoList</title>
</head>
<body>
    <div class="box-forms">
    <form action="{{ route('login.auth') }}" method="POST">
    @csrf
        <input type="email" name="email" required placeholder="E-mail">
        <input type="password" name="password" required placeholder="Senha">
        <button type="submit">Entrdar</button>
        @if(session('erro'))
        <div style="background-color: #fee2e2; color: #dc2626; 
        padding: 10px; border-radius: 8px; text-align: center; font-size: 0.875rem; 
        border: 1px solid #fecaca;">
        {{ session('erro') }}
        </div>
        @endif
    </form> 
    </div>

</body>
</html>