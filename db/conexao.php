<?php

    require_once(__DIR__."/../cors.php");

    //CONFIGURAÇÕES GERAIS
    $servidor = "localhost";
    $banco = "livraria";
    $usuario = "root";
    $senha = "";

    //CONEXÃO
    $pdo = new PDO(
        "mysql:host=$servidor;dbname=$banco",
        $usuario,
        $senha
    );
?>