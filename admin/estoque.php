<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../index.css">
    <title>Cadastro de Estoque</title>
    </head>
    <body>
        <div class="end">
            <input type="button" value="Voltar ao menu" onclick="navigate('index.php')">
            <input type="button" value="Cadastrar um produto" onclick="navigate('produtos.php')">
        </div>
        <script type="text/javascript" src="../index.js"></script>
        <h1>Cadastro de Estoque</h1>
        <p>Preencha os campos abaixo:</p>
        <form class="fields" method="post" action="controller/cad_estoque.php">
            <div class="item-field">
                <label>Produto</label>
                <select name="produto">
                    <?php
                        require_once "../classes/Produto.php";
                        $produtoServer = new Produto();
                        $result = $produtoServer->buscarProdutos();
                        while($row = pg_fetch_row($result)){
                            echo "<option value=".$row[0].">".$row[1]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="item-field">
                <label>Numeração</label>
                <input name="numeracao" type="number" min="0" required>
            </div>
            <div class="item-field">
                <label>Cor</label>
                <input name="cor" required>
            </div>
            <div class="item-field">
                <label>Quantidade</label>
                <input name="quantidade" type="number" min="0" required>
            </div>
            <div class="item-field">
                <input type="submit">
            </div>
        </form>
    </body>
</html>