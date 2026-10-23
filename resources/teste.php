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


// Busca o banco cadastrado
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
    <title></title>

</head>

<body>

 

</body>

</html>

?>