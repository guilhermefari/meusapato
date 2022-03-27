<?php
    require_once "../../classes/Produto.php";
    $produtoServer = new Produto();
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $material = $_POST["material"];
    $publico = $_POST["publico"];
    $tipoFechamento = $_POST["tipoFechamento"];
    $marca = $_POST["marca"];
    $amortecedor = $_POST["amortecedor"];
    $palmilhaAntiOdor = $_POST["palmilha"];
    $idMarca = $_POST["marca"];

    $id = $produtoServer->cadastrarProduto($nome, $preco*100, $material, $publico, $tipoFechamento, $idMarca, $amortecedor, $palmilhaAntiOdor);
    echo "<p>Produto ".$nome." cadastrado com sucesso!</p>";
    echo "<p>O ID desse produto é ".$id.".</p>";
    echo "<a href='produtos.php'><input type='button' value='Voltar'></a>";
?>