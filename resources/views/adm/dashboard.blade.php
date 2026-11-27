<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Administrador - Gestão de EPIs</title>
</head>

<body>
    <header>
        <h1>Sistema de Gestão de EPIs</h1>
        <h2>Área do Administrador</h2>
        <p>Bem vindo ao Sistema de gestão de EPIs, {{ Auth::user()->name ?? 'Administrador'}}</p>

        <form action="{{route ('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn">Sair</button>
        </form>
    </header>

    <main class="container">
        <h2 class="section-titulo">Resumo geral</h2>
        <section class="summario-grid">
            <div class="summario-verde">
                <span class="summario-icon">&#128737;</span>
                <span class="summario-value">???</span>
                <span class="summario-label">EPIs em estoque</span>
            </div>

            <div class="summario-azul">
                <span class="summario-icon">&#128101;</span>
                <span class="summario-value">???</span>
                <span class="summario-label">Funcionários ativos</span>
            </div>

            <div class="summario-bege">
                <span class="summario-icon">&#9888; &#65039;</span>
                <span class="summario-value">???</span>
                <span class="summario-label">Alertas de Estoque</span>
            </div>

            <div class="summario-roxo">
                <span class="summario-icon">&#128666;</span>
                <span class="summario-value">???</span>
                <span class="summario-label">Movimentação pendente</span>
            </div>
        </section>

        <h2 class="section-titulo">Gerenciamento do Sistema</h2>
        <section class="menu-grid">
            <a href="#" class="menu-card">
                <span class="menu-icon">&#128101;</span>
                <h3>Gerenciar Usuários</h3>
                <p>Acessos, cadastro e consulta de funcionários e RGE</p>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-icon">&#128737;</span>
                <h3>Gerenciar EPIs</h3>
                <p>Cadastrar, consulta e gerenciar EPIs</p>
            </a>

            <a href="#" class="menu-card">
                <span class="menu-icon">&#127970;</span>
                <h3>Gerenciar Fornecedores</h3>
                <p>Acessos, cadastro e consulta de Fornecedores</p>
            </a>

    </main>

</body>

</html>