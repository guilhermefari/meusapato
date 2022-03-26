<?php
    require "../../classes/marca.php";
    $marcaServer = new Marca();
    $nome = $_POST["marca"];
    $id = $marcaServer->cadastrarMarca($nome);
    echo "<p>Marca ".$nome." cadastrada com sucesso!</p>";
    echo "<p>O ID dessa marca é ".$id.".</p>";
    echo "<a href='marca.html'><input type='button' value='Voltar'></a>";
?>