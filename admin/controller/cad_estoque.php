<?php
    require_once "../../classes/EstoqueProduto.php";
    $estoqueServer = new EstoqueProduto();
    $idProduto = $_POST["produto"];
    $numeracao = $_POST["numeracao"];
    $cor = $_POST["cor"];
    $quantidade = $_POST["quantidade"];

    $id = $estoqueServer->cadastrarEstoque($idProduto, $numeracao, $cor, $quantidade,);
    echo "<p>Estoque para o produto cadastrado com sucesso!</p>";
    echo "<p>O id desse estoque é ".$id.".</p>";
    echo "<a href='../estoque.php'><input type='button' value='Voltar'></a>";
?>