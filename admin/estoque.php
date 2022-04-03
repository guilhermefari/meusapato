<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css">
    <title>Cadastro de Estoque</title>
    </head>
    <body>
        <div class="end">
            <input type="button" class='btn btn-primary' value="Voltar ao menu" onclick="navigate('index.php')">
            <input type="button" class='btn btn-primary' value="Cadastrar um produto" onclick="navigate('produtos.php')">
        </div>
        <script type="text/javascript" src="../index.js"></script>
        <div class="form-group container color-bg">
            <h1>Cadastro de Estoque</h1>
            <p>Preencha os campos abaixo:</p>
            <form class="fields" method="post" action="controller/cad_estoque.php">
                <div class="row">
                    <div class="col-xs-6">
                        <label>Produto</label>
                        <select class="form-control" name="produto">
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
                </div>
                <div class="row">
                    <div class="col-xs-2">    
                        <label>Numeração</label>
                        <input class="form-control" name="numeracao" type="number" min="0" required>
                    </div>
                    <div class="col-xs-2">
                        <label>Cor</label>
                        <input class="form-control" name="cor" required>
                    </div>
                    <div class="col-xs-2">
                        <label>Quantidade</label>
                        <input class="form-control" name="quantidade" type="number" min="0" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 25px;">
                    <div class="col-xs-2">
                        <input class="form-control btn-primary" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>