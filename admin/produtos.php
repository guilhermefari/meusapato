<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css">
    <title>Cadastro de Produto</title>
    </head>
    <body>
        <div class="end">
            <input type="button" class='btn btn-primary' value="Voltar ao menu" onclick="navigate('index.php')">
            <input type="button" class='btn btn-primary' value="Cadastrar Marca" onclick="navigate('marca.html')">
        </div>
        <script type="text/javascript" src="../index.js"></script>
        <div class="form-group container color-bg">
            <h1>Cadastro de Produto</h1>
            <p>Preencha os campos abaixo:</p>
            <form action="controller/cad_produto.php" method="post" class="form-group container color-bg">
                <div class="row">
                    <div class="col-xs-6">
                        <label>Nome do produto</label>
                        <input class="form-control" name="nome" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <label>Preço</label>
                        <input class="form-control" name="preco" type="number" step="0.01" min="0" value="0.00" required>
                    </div>
                    <div class="col-xs-3">
                        <label>Material</label>
                        <input class="form-control" name="material" required>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label>Público</label>
                        <select class="form-control" name="publico">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="U">Unissex</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label>Tipo de fechamento</label>
                        <select class="form-control" name="tipoFechamento">
                            <option value="cadarço">Cadarço</option>
                            <option value="fivela">Fivela</option>
                            <option value="velcro">Velcro</option>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <label>Marca</label>
                        <select class="form-control" name="marca">
                            <?php
                            require_once "../classes/Marca.php";
                            $marcaServer = new Marca();
                            $result = $marcaServer->buscarMarcas();
                            while($row = pg_fetch_row($result)){
                                echo "<option value=".$row[0].">".$row[1]."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <input class="form-check-input" name="amortecedor" type="checkbox">
                        <label>Amortecedor</label>
                    </div>
                    <div class="col-xs-3">
                        <input class="form-check-input" name="palmilha" type="checkbox">
                        <label>Palmilha anti-odor</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <input class="form-control btn-primary" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>