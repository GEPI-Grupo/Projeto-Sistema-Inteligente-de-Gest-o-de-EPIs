<?php
// require_once __DIR__ . '/../../Config/conexao.php';
$mensagem = '';
$tipoMensagem = 'sucesso';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $vidaUtil = filter_input(INPUT_POST, 'vida_util', FILTER_VALIDATE_INT);
    $dataFabricacao = $_POST['data_fabricacao'] ?? '';
    $quantidade = filter_input(INPUT_POST, 'quantidade_disponivel', FILTER_VALIDATE_INT);
    $quantidadeMinima = filter_input(INPUT_POST, 'quantidade_minima', FILTER_VALIDATE_INT);
    $localizacao = trim($_POST['localizacao'] ?? '');

    if ($nome === '' || $descricao === '' || !$vidaUtil || !$dataFabricacao || $quantidade === false || $quantidade === null || $quantidadeMinima === false || $quantidadeMinima === null || $quantidade < 0 || $quantidadeMinima < 0 || $localizacao === '') {
        $mensagem = 'Preencha corretamente todos os campos. A vida útil deve ser maior que zero e as quantidades não podem ser negativas.';
        $tipoMensagem = 'erro';
    } else {
        try {
            $pdo->beginTransaction();
            $stmtEstoque = $pdo->prepare('INSERT INTO estoque (quantidade_disponivel, quantidade_minima, localizacao) VALUES (?, ?, ?)');
            $stmtEstoque->execute([$quantidade, $quantidadeMinima, $localizacao]);
            $idEstoque = (int) $pdo->lastInsertId();

            // O modelo atual exige que cada EPI esteja relacionado a um alerta.
            $stmtAlerta = $pdo->prepare('INSERT INTO alertas (tipo_alerta, descricao_alerta, data_emissao) VALUES (?, ?, NOW())');
            $stmtAlerta->execute(['Cadastro', 'Alerta inicial do EPI: ' . $nome]);
            $idAlerta = (int) $pdo->lastInsertId();

            $stmtEpi = $pdo->prepare('INSERT INTO epis (id_estoque, id_alerta, id_troca, nome, descricao, vida_util, data_fabricacao) VALUES (?, ?, NULL, ?, ?, ?, ?)');
            $stmtEpi->execute([$idEstoque, $idAlerta, $nome, $descricao, $vidaUtil, $dataFabricacao]);
            $pdo->commit();
            $mensagem = 'EPI cadastrado com sucesso!';
        } catch (Throwable $erro) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $mensagem = 'Erro ao cadastrar EPI. Verifique os dados e a estrutura do banco.';
            $tipoMensagem = 'erro';
            error_log($erro->getMessage());
        }
    }
}

$epis = $pdo->query("SELECT e.id_epi, e.nome, e.descricao, e.vida_util, e.data_fabricacao,
                            es.quantidade_disponivel, es.quantidade_minima, es.localizacao
                     FROM epis e INNER JOIN estoque es ON es.id_estoque = e.id_estoque
                     ORDER BY e.nome")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIs | Gestão de EPIs</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body>
    <header class="topo">
        <h1>Sistema Inteligente de Gestão de EPIs</h1>
    </header>
    <nav class="menu"><a href="home.php">Início</a><a href="funcionarios.php">Funcionários</a><a href="fornecedores.php">Fornecedores</a><a class="ativo" href="epis.php">EPIs e estoque</a></nav>
    <main class="container">
        <h2>Cadastro de EPIs</h2>
        <?php if ($mensagem !== ''): ?><div class="mensagem <?= htmlspecialchars($tipoMensagem) ?>"><?= htmlspecialchars($mensagem) ?></div><?php endif; ?>
        <form method="POST" class="formulario">
            <div class="grid-form">
                <label>Nome do EPI<input name="nome" maxlength="100" required></label>
                <label>Descrição<input name="descricao" maxlength="255" required></label>
                <label>Vida útil (dias)<input type="number" name="vida_util" min="1" required></label>
                <label>Data de fabricação<input type="date" name="data_fabricacao" required></label>
                <label>Quantidade disponível<input type="number" name="quantidade_disponivel" min="0" required></label>
                <label>Quantidade mínima<input type="number" name="quantidade_minima" min="0" required></label>
                <label>Localização no estoque<input name="localizacao" maxlength="150" required></label>
            </div><button type="submit">Cadastrar EPI</button>
        </form>
        <h2 class="titulo-lista">EPIs cadastrados</h2>
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Vida útil</th>
                        <th>Fabricação</th>
                        <th>Disponível</th>
                        <th>Mínimo</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$epis): ?><tr>
                            <td colspan="7">Nenhum EPI cadastrado.</td>
                        </tr><?php else: foreach ($epis as $epi): ?><tr>
                                <td><?= htmlspecialchars($epi['nome']) ?></td>
                                <td><?= htmlspecialchars($epi['descricao']) ?></td>
                                <td><?= (int)$epi['vida_util'] ?> dias</td>
                                <td><?= htmlspecialchars($epi['data_fabricacao']) ?></td>
                                <td><?= (int)$epi['quantidade_disponivel'] ?></td>
                                <td><?= (int)$epi['quantidade_minima'] ?></td>
                                <td><?= htmlspecialchars($epi['localizacao']) ?></td>
                            </tr><?php endforeach;
                            endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>