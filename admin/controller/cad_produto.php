<?php
    require_once "../../classes/Produto.php";
    $produtoServer = new Produto();
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $material = $_POST["material"];
    $publico = $_POST["publico"];
    $tipoFechamento = $_POST["tipoFechamento"];
    $marca = $_POST["marca"];
    $idMarca = $_POST["marca"];

    $amortecedor = isset($_POST['amortecedor']) ? 1 : 0;
    $palmilhaAntiOdor = isset($_POST['palmilha']) ? 1 : 0;

    $id = $produtoServer->cadastrarProduto($nome, $preco*100, $material, $publico, $tipoFechamento, $idMarca, $amortecedor, $palmilhaAntiOdor);
    echo "<p>Produto ".$nome." cadastrado com sucesso!</p>";
    echo "<p>O código desse produto é ".$id.".</p>";
    echo "<a href='../produtos.php'><input type='button' value='Voltar'></a>";
?>