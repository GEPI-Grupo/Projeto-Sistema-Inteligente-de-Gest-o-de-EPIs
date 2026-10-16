<?php

$host = "localhost";
$banco = "portscan";
$usuario = "portscan";
$senha = "portscan!@#";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $erro) {

    die("Erro ao conectar: " . $erro->getMessage());

}

?>