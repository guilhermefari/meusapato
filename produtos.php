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
            <input type="button" class='btn btn-primary' value="Voltar ao menu" onclick="navigate('index.html')">
            <input type="button" class='btn btn-primary' value="Finalizar compra" onclick="navigate('pedido.html')">
        </div>
        <div class="separate">
            <h1>Produtos Disponíveis</h1>
            <p>Para adicionar ao carrinho, marque o item que deseja.</p>
        </div>
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
                        require_once "classes/EstoqueProduto.php";
                        $estoqueServer = new EstoqueProduto();
                        $estoqueItens = $estoqueServer->buscarEstoqueProduto($row[0]);

                        
                        echo "<div class='card separate'>";
                        echo "<h3>{$row[1]}</h3>";
                        
                        $preco = $row[8]/100;
                        echo "<h3>{$preco}</h3>";
                        
                        if(pg_num_rows($estoqueItens) == 0) echo "<div class='alert alert-danger' role='alert'>Produto indisponível</div>";

                        echo "<p>Marca: {$row[7]}</p>";
                        echo "<p>Material: {$row[2]}</p>";
                        echo "<p>Público: {$row[3]}</p>";
                        echo "<p>Tipo de fechamento: {$row[4]}</p>";

                        if($row[5]){
                            echo "<div style='display: flex'>";
                                echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check' color='green' viewBox='0 0 16 16'>
                                <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                                </svg>";
                                echo "<p>Amortecedor</p>";
                            echo "</div>";
                        }
                        if($row[6]){
                            echo "<div style='display: flex'>";
                                echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check' color='green' viewBox='0 0 16 16'>
                                <path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>
                                </svg>";
                                echo "<p>Palmilha anti-odor</p>";
                            echo "</div>";
                        }
                        
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
                        echo "</div>";
                    }

                    $cont++;
                }
            ?>

    </body>
</html>