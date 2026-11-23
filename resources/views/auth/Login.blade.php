<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="login-card">
        <h1 class="login-title">Bem-vindo</h1>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

<form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Usuario</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Digite seu email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite a sua senha" required>
            </div>

            <div class="button-container">
                <button type="submit" class="btn-submit">Enviar</button>
            </div>
        </form>
    </div>

</body>
</html>