<?php
require_once __DIR__ . '/../../Config/conexao.php';
$mensagem = '';
$tipoMensagem = 'sucesso';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome_fornecedor'] ?? '');
    $cnpj = trim($_POST['cnpj'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if ($nome === '' || $cnpj === '' || $telefone === '' || $email === '') {
        $mensagem = 'Preencha todos os campos.';
        $tipoMensagem = 'erro';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = 'Informe um e-mail válido.';
        $tipoMensagem = 'erro';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO fornecedores (nome_fornecedor, cnpj, telefone, email) VALUES (:nome, :cnpj, :telefone, :email)');
            $stmt->execute([':nome' => $nome, ':cnpj' => $cnpj, ':telefone' => $telefone, ':email' => $email]);
            $mensagem = 'Fornecedor cadastrado com sucesso!';
        } catch (PDOException $erro) {
            $mensagem = 'Erro ao cadastrar fornecedor: ' . ($erro->getCode() === '23000' ? 'CNPJ já cadastrado.' : 'verifique os dados e tente novamente.');
            $tipoMensagem = 'erro';
        }
    }
}
$fornecedores = $pdo->query('SELECT id_fornecedor, nome_fornecedor, cnpj, telefone, email FROM fornecedores ORDER BY nome_fornecedor')->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores | Gestão de EPIs</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body>
    <header class="topo">
        <h1>Sistema Inteligente de Gestão de EPIs</h1>
    </header>
    <nav class="menu"><a href="home.php">Início</a><a href="funcionarios.php">Funcionários</a><a class="ativo" href="fornecedores.php">Fornecedores</a><a href="epis.php">EPIs e estoque</a></nav>
    <main class="container">
        <h2>Cadastro de fornecedores</h2>
        <?php if ($mensagem !== ''): ?><div class="mensagem <?= htmlspecialchars($tipoMensagem) ?>"><?= htmlspecialchars($mensagem) ?></div><?php endif; ?>
        <form method="POST" class="formulario">
            <div class="grid-form">
                <label>Nome do fornecedor<input name="nome_fornecedor" maxlength="100" required></label>
                <label>CNPJ<input name="cnpj" maxlength="18" placeholder="00.000.000/0000-00" required></label>
                <label>Telefone<input name="telefone" maxlength="20" required></label>
                <label>E-mail<input type="email" name="email" maxlength="150" required></label>
            </div><button type="submit">Cadastrar fornecedor</button>
        </form>
        <h2 class="titulo-lista">Fornecedores cadastrados</h2>
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$fornecedores): ?><tr>
                            <td colspan="4">Nenhum fornecedor cadastrado.</td>
                        </tr><?php else: foreach ($fornecedores as $f): ?><tr>
                                <td><?= htmlspecialchars($f['nome_fornecedor']) ?></td>
                                <td><?= htmlspecialchars($f['cnpj']) ?></td>
                                <td><?= htmlspecialchars($f['telefone']) ?></td>
                                <td><?= htmlspecialchars($f['email']) ?></td>
                            </tr><?php endforeach;
                            endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>