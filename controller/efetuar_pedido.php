<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Produtos</title>
    </head>
    <?php
        if(!isset($_COOKIE["username"])){
            header('Location: login.php');
        }
    ?>
    <body onload="unsetCookies()">
        <script type="text/javascript" src="../index.js"></script>
        <?php
            require_once "../classes/Endereco.php";
            require_once "../classes/ItemPedido.php";
            require_once "../classes/Pedido.php";
            require_once "../classes/EstoqueProduto.php";
            $pedidoServer = new Pedido();
            $estoqueServer = new EstoqueProduto();

            $cpf = $_COOKIE['cpf'];

            $usarEnderecoAtual = $_POST["usarEndAtual"] == 'true';

            if(!$usarEnderecoAtual){
                $logradouro = $_POST["logradouro"];
                $numero = $_POST["numero"];
                $complemento = $_POST["complemento"];
                $cidade = $_POST["cidade"];
                $estado = $_POST["estado"];
                $cep = $_POST["cep"];
                $nome_associado = $_POST["nome-associado"];

                $enderecoServer = new Endereco();
                $enderecoPedido = $enderecoServer->cadastrarEndereco($logradouro, $numero, $complemento, $cidade, $estado, $cep, $nome_associado);
            } else $enderecoPedido = $_POST["idEndAtual"];

            $idPedido = $pedidoServer->criarPedido($cpf, $enderecoPedido);

            $arrayProdutos = unserialize($_COOKIE['carrinho']);
            foreach($arrayProdutos as $produto){
                $pedidoServer->cadastrarItem($produto, $idPedido);
                $estoqueServer->abaixarEstoque($produto->getIdEstoqueProduto(), 1);
            }
        ?>
        <div class='alert alert-success' role='alert'>Seu pedido foi efetuado!</div>
        <button type="button" class="btn btn-primary" onclick="navigate('../index.php')">Voltar ao Menu Principal</button>
    </body>
</html>