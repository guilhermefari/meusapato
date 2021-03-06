<?php
    require_once "../classes/Cliente.php";
    require_once "../classes/Endereco.php";
    $clienteServer = new Cliente();
    $enderecoServer = new Endereco();

    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $cep = $_POST["CEP"];
    $nome_associado = $_POST["nome_associado"];

    $idEnd = $enderecoServer->cadastrarEndereco($logradouro, $numero, $complemento, $cidade, $estado, $cep, $nome_associado);

    $nome = $_POST["nome"];
    $cpf = $_POST["CPF"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];

    $clienteServer->cadastrarCliente($cpf, $nome, $sexo, $email, $senha, $telefone, $idEnd);

    setcookie("username", $nome, time() + (86400 * 30), "/");
    setcookie("cpf", $cpf, time() + (86400 * 30), "/");
    header('Location: ../index.php');
?>