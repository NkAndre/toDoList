<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/login2.css')}}">
    <title>Login - ToDoList</title>
</head>
<body>
    <div class="box-forms">
        <div class="login-banner">
            <img src="{{url('assets/imagem-login.jpg')}}"  alt="imagem de login">
        </div>

        <div class="login-section">
            <div class="login-header">
                <h2 class="titulo">Bem-vindo</h2>
                <p>Faça login para gerenciar suas tarefas</p>
            </div>

            <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" required placeholder="E-mail">
                </div>
                <div class="input-group">
                    <input type="password" name="password" required placeholder="Senha">
                </div>
                
                <button type="submit">Entrar</button>

                @if(session('erro'))
                    <div class="alert-error">
                        {{ session('erro') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>