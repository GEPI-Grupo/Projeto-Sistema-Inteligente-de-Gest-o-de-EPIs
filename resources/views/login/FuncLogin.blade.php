<?php
require_once __DIR__ . '/../../Config/conexao.php';

$mensagem = '';
$tipoMensagem = 'sucesso';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    try {
        if ($acao === 'cadastrar') {
            $nome = trim($_POST['nome_funcionario'] ?? '');
            $setor = trim($_POST['setor'] ?? '');
            $cargo = trim($_POST['cargo_funcionario'] ?? '');
            $cpf = trim($_POST['cpf_funcionario'] ?? '');
            $nascimento = $_POST['data_nascimento'] ?? '';
            $email = trim($_POST['email'] ?? '');
            $senhaDigitada = $_POST['senha'] ?? '';

            if ($nome === '' || $setor === '' || $cargo === '' || $cpf === '' || $nascimento === '' || $email === '' || $senhaDigitada === '') {
                throw new RuntimeException('Preencha todos os campos para cadastrar o funcionário.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new RuntimeException('Informe um e-mail válido.');
            }
            if (strlen($senhaDigitada) < 8) {
                throw new RuntimeException('A senha deve ter pelo menos 8 caracteres.');
            }

            $pdo->beginTransaction();
            $senhaHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);

            $sqlUsuario = "INSERT INTO usuarios
                (nome_usuario, data_nascimento, senha, email, cpf_usuario, tipo_usuario, status)
                VALUES (:nome, :nascimento, :senha, :email, :cpf, 'Funcionario', 1)";
            $stmtUsuario = $pdo->prepare($sqlUsuario);
            $stmtUsuario->execute([
                ':nome' => $nome,
                ':nascimento' => $nascimento,
                ':senha' => $senhaHash,
                ':email' => $email,
                ':cpf' => $cpf,
            ]);
            $idUsuario = (int) $pdo->lastInsertId();

            $sqlFuncionario = "INSERT INTO funcionarios
                (id_usuario, nome_funcionario, setor, status, cpf_funcionario, senha, cargo_funcionario)
                VALUES (:id_usuario, :nome, :setor, 1, :cpf, :senha, :cargo)";
            $stmtFuncionario = $pdo->prepare($sqlFuncionario);
            $stmtFuncionario->execute([
                ':id_usuario' => $idUsuario,
                ':nome' => $nome,
                ':setor' => $setor,
                ':cpf' => $cpf,
                ':senha' => $senhaHash,
                ':cargo' => $cargo,
            ]);
            $pdo->commit();
            $mensagem = 'Funcionário cadastrado com sucesso!';
        } elseif ($acao === 'alterar_status') {
            $id = filter_input(INPUT_POST, 'id_funcionario', FILTER_VALIDATE_INT);
            $novoStatus = filter_input(INPUT_POST, 'novo_status', FILTER_VALIDATE_INT);
            if (!$id || !in_array($novoStatus, [0, 1], true)) {
                throw new RuntimeException('Dados inválidos para alterar o status.');
            }
            $stmt = $pdo->prepare('UPDATE funcionarios SET status = :status WHERE id_funcionario = :id');
            $stmt->execute([':status' => $novoStatus, ':id' => $id]);
            $mensagem = 'Status do funcionário atualizado.';
        }
    } catch (Throwable $erro) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $tipoMensagem = 'erro';
        if ($erro instanceof PDOException && $erro->getCode() === '23000') {
            $mensagem = 'Não foi possível cadastrar: o e-mail ou CPF já está cadastrado.';
        } else {
            $mensagem = $erro->getMessage();
        }
    }
}

$sql = "SELECT f.id_funcionario, f.nome_funcionario, f.setor, f.cargo_funcionario,
               f.cpf_funcionario, f.status, u.email
        FROM funcionarios f
        INNER JOIN usuarios u ON u.id_usuario = f.id_usuario
        ORDER BY f.nome_funcionario";
$funcionarios = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários | Gestão de EPIs</title>
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body>
    <header class="topo">
        <h1>Sistema Inteligente de Gestão de EPIs</h1>
    </header>
    <nav class="menu">
        <a href="home.php">Início</a>
        <a class="ativo" href="funcionarios.php">Funcionários</a>
        <a href="fornecedores.php">Fornecedores</a>
        <a href="epis.php">EPIs e estoque</a>
    </nav>
    <main class="container">
        <h2>Cadastro de funcionários</h2>
        <?php if ($mensagem !== ''): ?>
            <div class="mensagem <?= htmlspecialchars($tipoMensagem) ?>"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>
        <form method="POST" class="formulario">
            <input type="hidden" name="acao" value="cadastrar">
            <div class="grid-form">
                <label>Nome completo<input type="text" name="nome_funcionario" maxlength="100" required></label>
                <label>CPF<input type="text" name="cpf_funcionario" maxlength="14" placeholder="000.000.000-00" required></label>
                <label>Setor<input type="text" name="setor" maxlength="100" required></label>
                <label>Cargo<input type="text" name="cargo_funcionario" maxlength="100" required></label>
                <label>Data de nascimento<input type="date" name="data_nascimento" required></label>
                <label>E-mail de acesso<input type="email" name="email" maxlength="150" required></label>
                <label>Senha (mínimo 8 caracteres)<input type="password" name="senha" minlength="8" required></label>
            </div>
            <button type="submit">Cadastrar funcionário</button>
        </form>

        <h2 class="titulo-lista">Funcionários cadastrados</h2>
        <div class="tabela-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Setor</th>
                        <th>Cargo</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$funcionarios): ?>
                        <tr>
                            <td colspan="7">Nenhum funcionário cadastrado.</td>
                        </tr>
                        <?php else: foreach ($funcionarios as $f): ?>
                            <tr>
                                <td><?= htmlspecialchars($f['nome_funcionario']) ?></td>
                                <td><?= htmlspecialchars($f['cpf_funcionario']) ?></td>
                                <td><?= htmlspecialchars($f['setor']) ?></td>
                                <td><?= htmlspecialchars($f['cargo_funcionario']) ?></td>
                                <td><?= htmlspecialchars($f['email']) ?></td>
                                <td><?= (int)$f['status'] === 1 ? 'Ativo' : 'Inativo' ?></td>
                                <td>
                                    <form method="POST" class="form-acao">
                                        <input type="hidden" name="acao" value="alterar_status">
                                        <input type="hidden" name="id_funcionario" value="<?= (int)$f['id_funcionario'] ?>">
                                        <input type="hidden" name="novo_status" value="<?= (int)$f['status'] === 1 ? 0 : 1 ?>">
                                        <button class="secundario" type="submit"><?= (int)$f['status'] === 1 ? 'Desativar' : 'Ativar' ?></button>
                                    </form>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>