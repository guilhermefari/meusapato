<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Produtos</title>
    </head>
    <body>
        <script type="text/javascript" src="index.js"></script>
        <div class="end">
            <input type="button" value="Voltar ao menu" onclick="navigate('index.html')">
            <input type="button" value="Finalizar compra" onclick="navigate('pedido.html')">
        </div>
        <h1>Produtos Disponíveis</h1>
        <p>Para adicionar ao carrinho, marque o item que deseja</p>
        <div class="cards">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php 
                        require_once "classes/Produto.php";
                        $prodServer = new Produto();
                        $nprod = $prodServer->contarProdutos();
                        $produtosPorPagina = 4;
                        $nPags = ceil($nprod/$produtosPorPagina);
                        $pagAtual = $_GET["page"];
                        $pagAnterior = $pagAtual-1;
                        $proxPagina = $pagAtual+1;

                        if($pagAtual == 1) echo '<li class="page-item disabled">';
                        else echo '<li class="page-item">';
                        echo "<a class='page-link' href='produtos.php?page={$pagAnterior}' tabindex='1'>Anterior</a></li>";

                        for($i = 1; $i <= $nPags; $i++){
                            echo "<li class='page-item'><a class='page-link' href='produtos.php?page={$i}'>{$i}</a></li>";
                        }

                        if($pagAtual == $nPags) echo '<li class="page-item disabled">';
                        else echo '<li class="page-item">';
                        echo "<a class='page-link' href='produtos.php?page={$proxPagina}' tabindex='1'>Próxima</a></li>";
                    ?>
                </ul>
            </nav>

            <?php
                $produtos = $prodServer->buscarProdutosComMarca();
                $cont = 1;
                while($row = pg_fetch_row($produtos)){
                    if($cont > $pagAnterior*$produtosPorPagina && $cont <= $pagAtual*$produtosPorPagina){
                        echo "<b><p>{$row[1]}</p></b>"; //adicionar demais especificações técnicas
                        echo "<p>Marca: {$row[7]}</p>";
                        echo "<p>Material: {$row[2]}</p>";
                        echo "<p>Público: {$row[3]}</p>";
                        echo "<p>Tipo de fechamento: {$row[4]}</p>";
                        echo "<p>Tem amortecedor: {$row[5]}</p>";
                        echo "<p>Tem palmilha anti-odor: {$row[6]}</p>";

                        echo "<p>Preço: {$row[8]}</p>";

                        require_once "classes/EstoqueProduto.php";
                        $estoqueServer = new EstoqueProduto();
                        $estoqueItens = $estoqueServer->buscarEstoqueProduto($row[0]);

                        if(pg_num_rows($estoqueItens) == 0) echo "<p>Produto indisponível</p>";
                        else echo "<p>Escolha o modelo desejado:</p>";
                        
                        while($itemEstoque = pg_fetch_row($estoqueItens)){
                            $tamanho = $itemEstoque[2];
                            $cor = $itemEstoque[3];
                            echo "<div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault'>
                                <label class='form-check-label' for='flexCheckDefault'>
                                    Tamanho: {$tamanho}, Cor: {$cor}
                                </label>
                            </div>";
                        }
                    }

                    $cont++;
                }
            ?>

            <div class="card">
                <div class="modelos">
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>Cor: Vermelho</p>
                    </div>
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>Cor: Verde</p>
                    </div>
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>Cor: Azul</p>
                    </div>
                </div>
                <div class="modelos">
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>40</p>
                    </div>
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>41</p>
                    </div>
                    <div class="card-modelo">
                        <input type="checkbox">
                        <p>42</p>
                    </div>
                </div>
                <h2>Tênis Naike R1</h2>
                <h2>R$129,90</h2>
                <h4>Especificações Técnicas</h4>
                <p>Material: Borracha</p>
                <p>Público: Masculino</p>
                <p>Tipo de fechamento: Cadarço</p>
                <p>Possui amortecedor de impacto: Sim</p>
                <p>Palmilha anti-odor: Não</p>
            </div>
            <div class="card">
                <input type="checkbox">
                <h2>Tênis Eizics M97</h2>
                <h2>R$178,80</h2>
                <h4>Especificações Técnicas</h4>
                <p>Material: Borracha</p>
                <p>Público: Masculino</p>
                <p>Tipo de fechamento: Cadarço</p>
                <p>Possui amortecedor de impacto: Sim</p>
                <p>Palmilha anti-odor: Não</p>
            </div>
            <div class="card">
                <input type="checkbox">
                <h2>Tênis Eizics M45</h2>
                <h2 class="indisponivel">Produto indisponível</h2>
                <h4>Especificações Técnicas</h4>
                <p>Material: Borracha</p>
                <p>Público: Masculino</p>
                <p>Tipo de fechamento: Cadarço</p>
                <p>Possui amortecedor de impacto: Sim</p>
                <p>Palmilha anti-odor: Não</p>
            </div>
        </div>
    </body>
</html>