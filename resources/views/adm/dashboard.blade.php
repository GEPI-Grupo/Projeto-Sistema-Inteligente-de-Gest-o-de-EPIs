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

    <h2 class="section-titulo">Trocas de EPI</h2>
        <section class="card-trocas">
            <h3>Registrar Nova Troca</h3>
            <form action="#" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="codigo">Protocolo da Troca</label>
                        <input type="text" id="codigo" name="codigo" value="TR-2026-01" readonly>
                    </div>

                    <div class="form-group">
                        <label for="funcionario">Funcionário</label>
                        <input type="text" id="funcionario" name="funcionario" placeholder="Nome do funcionário" required>
                    </div>

                    <div class="form-group">
                        <label for="epi">EPI</label>
                        <select id="epi" name="epi" required>
                            <option value="">Selecione...</option>
                            <option value="capacete">Capacete</option>
                            <option value="luva">Luva de Proteção</option>
                            <option value="bota">Bota de Segurança</option>
                        </select>
                    </div>


</main>


    


    
</body>
</html>