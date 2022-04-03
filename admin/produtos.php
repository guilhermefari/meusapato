<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../index.css">
    <title>Cadastro de Produto</title>
    </head>
    <body>
        <div class="end">
            <input type="button" value="Voltar ao menu" onclick="navigate('index.php')">
            <input type="button" value="Cadastrar marca" onclick="navigate('marca.html')">
        </div>
        <script type="text/javascript" src="../index.js"></script>
        <h1>Cadastro de Produto</h1>
        <p>Preencha os campos abaixo:</p>
        <form action="controller/cad_produto.php" method="post" class="fields">
            <div class="item-field">
                <label>Nome do produto</label>
                <input name="nome" required>
            </div>
            <div class="item-field">
                <label>Preço</label>
                <input name="preco" type="number" step="0.01" min="0" value="0.00" required>
            </div>
            <div class="item-field">
                <label>Material</label>
                <input name="material" required>
            </div>
            <div class="item-field">
                <label>Público</label>
                <select name="publico">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="U">Unissex</option>
                </select>
            </div>
            <div class="item-field">
                <label>Tipo de fechamento</label>
                <select name="tipoFechamento">
                    <option value="cadarço">Cadarço</option>
                    <option value="fivela">Fivela</option>
                    <option value="velcro">Velcro</option>
                </select>
            </div>
            <div class="item-field">
                <label>Marca</label>
                <select name="marca">
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
            <input name="amortecedor" type="checkbox">
            <label>Amortecedor</label>
            <input name="palmilha" type="checkbox">
            <label>Palmilha anti-odor</label>
            <div class="item-field">
                <input type="submit">
            </div>
        </form>
    </body>
</html>