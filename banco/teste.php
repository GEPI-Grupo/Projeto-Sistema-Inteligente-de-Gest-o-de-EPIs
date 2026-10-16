<?php
$nome = "";
$genero = "";
$ano = 0;
$nota = 0;
$resultado = "";

require __DIR__ . "/../back-end/conexao.php";


// Cria a tabela caso ela não exista
$sql = "CREATE TABLE IF NOT EXISTS TESTE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    nota INT NOT NULL,
    ano INT NOT NULL
)";

$pdo->exec($sql);


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $ano = $_POST["ano"];
    $nota = $_POST["nota"];

    // Cadastra o jogo
    $sql_cadastro = "INSERT INTO TESTE 
        (nome, genero, nota, ano) 
        VALUES (:nome, :genero, :nota, :ano)";

    $stmt = $pdo->prepare($sql_cadastro);

    if ($stmt->execute([
        ":nome" => $nome,
        ":genero" => $genero,
        ":nota" => $nota,
        ":ano" => $ano
    ])) {

        $resultado = "Jogo cadastrado!";
    } else {

        $resultado = "Erro! Jogo não cadastrado";
    }
}


// Busca os jogos cadastrados
$buscar = "SELECT * FROM TESTE";

$stmt = $pdo->query($buscar);

$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/jogos.css">
    <title>Cadastro de Jogos</title>

</head>

<body>

    <form method="POST">

        <h1>Cadastro de jogos</h1>

        <label for="nome">
            Nome
        </label>

        <input
            type="text"
            name="nome"
            id="nome"
            placeholder="Digite o nome do jogo"
            required>

        <br>
        <br>

        <label for="genero">
            Gênero
        </label>

        <input
            type="text"
            id="genero"
            name="genero"
            placeholder="Digite o gênero do jogo"
            required>

        <br>
        <br>

        <label for="nota">
            Nota
        </label>

        <input
            type="number"
            id="nota"
            name="nota"
            min="0"
            max="5"
            placeholder="Digite a nota do jogo 0 a 5"
            required>

        <br>
        <br>

        <label for="ano">
            Ano
        </label>

        <input
            type="number"
            name="ano"
            id="ano"
            min="1980"
            max="2026"
            placeholder="Digite o ano do jogo"
            required>

        <br>
        <br>

        <button type="submit">
            Enviar
        </button>

        <?php if ($resultado != "") { ?>

            <span
                style="
                    color: <?= ($resultado == 'Jogo cadastrado!') ? 'green' : 'red' ?>;
                    font-weight: bold;
                ">
                <?= htmlspecialchars($resultado) ?>
            </span>

        <?php } ?>

    </form>


    <h2>
        Jogos cadastrados
    </h2>


    <table border="1">

        <tr>

            <th>ID</th>

            <th>Nome</th>

            <th>Gênero</th>

            <th>Nota</th>

            <th>Ano</th>

        </tr>


        <?php foreach ($jogos as $jogo) { ?>

            <tr>

                <td>
                    <?= $jogo["id"] ?>
                </td>

                <td>
                    <?= htmlspecialchars($jogo["nome"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($jogo["genero"]) ?>
                </td>

                <td>
                    <?= $jogo["nota"] ?>
                </td>

                <td>
                    <?= $jogo["ano"] ?>
                </td>

            </tr>

        <?php } ?>

    </table>

    <br><br>
    <a href="../index.php"> ← Voltar</a>

</body>

</html>

?>