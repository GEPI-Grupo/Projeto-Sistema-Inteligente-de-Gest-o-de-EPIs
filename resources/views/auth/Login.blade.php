<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
}

body {
    background-color: #7d846c; /* Fundo verde-oliva escuro */
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-card {
    background-color: #a9b290; /* Card verde-sálvia claro */
    width: 100%;
    max-width: 460px;
    padding: 45px 50px 55px 50px;
    border-radius: 22px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.login-card h1 {
    text-align: center;
    color: #0d0d0d;
    font-size: 26px;
    font-weight: 400;
    margin-bottom: 45px;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    color: #0d0d0d;
    font-size: 17px;
    margin-bottom: 6px;
}

.form-group input {
    width: 100%;
    height: 44px;
    background-color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 0 15px;
    font-size: 14px;
    color: #333333;
    outline: none;
}

.form-group input::placeholder {
    color: #7a7a7a;
    text-align: center; /* Placeholder centralizado como na imagem */
}

.form-group input:focus::placeholder {
    color: transparent; /* Esconde o placeholder ao digitar */
}

.btn-container {
    display: flex;
    justify-content: center;
    margin-top: 32px;
}

.btn-enviar {
    background-color: #f3ecec; /* Botão off-white levemente rosado */
    color: #0d0d0d;
    border: none;
    border-radius: 10px;
    padding: 10px 36px;
    font-size: 17px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-enviar:hover {
    background-color: #e6dddd;
}

.btn-enviar:active {
    transform: scale(0.98);
}

/* Estilo opcional para exibir mensagens de erro de validação do Laravel */
.error-msg {
    color: #7a1c1c;
    font-size: 13px;
    margin-top: 5px;
    display: block;
}
    </style>
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