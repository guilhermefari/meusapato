<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Carrinho</title>
    </head>
    <?php
        if(!isset($_COOKIE["username"])){
            header('Location: login.php');
        }
    ?>
    <body>
        <script type="text/javascript" src="index.js"></script>
        <div class="end">
            <input type="button" class='btn btn-primary' value="Voltar aos produtos" onclick="navigate('produtos.php?page=1')">
            <input type="button" class='btn btn-primary' value="Menu" onclick="navigate('index.php')">
        </div>
        <div class="container">
            <div class="separate">
                <div style="display: flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-emoji-laughing" viewBox="0 0 16 16" color='#0D6EFD'>
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zM7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>
                    </svg>
                    <h3>Você está quase lá!</h3>
                </div>
                <p>Aqui estão os seus produtos:</p>
            </div>

            <?php
                require_once("classes/EstoqueProduto.php");
                $estoque = new EstoqueProduto();
                $maxId = $estoque->buscarMaiorId();
                $soma = 0;
                
                require_once("classes/ItemPedido.php");
                $arrayProdutos = array();

                for($i = 1; $i <= $maxId; $i++){
                    $prodId = 'prod'.$i;
                    if(isset($_COOKIE[$prodId])){
                        if($_COOKIE[$prodId]){
                            $r = $estoque->buscarInformacoes($i);
                            while($row = pg_fetch_row($r)){
                                $soma += $row[7];
                                $preco = $row[7]/100;

                                echo "<div class='card separate color-bg'>
                                    <h3>{$row[6]}</h3>
                                    <p>Tamanho: {$row[2]}</p>
                                    <p>Cor: {$row[3]}</p>
                                    <p>R$ {$preco}</p>
                                </div>";

                                $item = new ItemPedido($row[7], 'convencional', $i);
                                array_push($arrayProdutos, $item);
                            }
                        }
                    }
                }
                $total = $soma/100;
                if($total > 0){
                    echo "<h4>Total: ${total}</h4>";
                    $cookieProdutos = serialize($arrayProdutos);
                    setcookie('carrinho', $cookieProdutos, time() + (86400*30));
                } else {
                    echo "<h4>Você ainda não adicionou nenhum produto ao carrinho.</h4>";
                    return;
                }
            ?>
            <label>Usar meu endereço cadastrado</label>
            <input class='form-check-input' type='checkbox' id='displayAddress' name='usarEndAtual' onclick="displayAddress()" checked>
            <p id="endAtual">
                <?php 
                $cpf = $_COOKIE['cpf']; 
                require_once("classes/Cliente.php");
                $clienteServer = new Cliente();
                $r = $clienteServer->buscarClientePorCPF($cpf);
                while($row = pg_fetch_row($r)){
                    echo "${row[7]}: ${row[1]}, ${row[2]}. ${row[4]} - ${row[5]}. ${row[6]}.";
                    $idEndereco = $row[0];
                }
                ?>
            </p>
            <form method="post" action="controller/efetuar_pedido.php">
                <input type="hidden" name="idEndAtual" value="<?php echo $idEndereco; ?>" >
                <input type="hidden" name="usarEndAtual" id="endAtualForm" value="true">;

                <div id="endereco-alternativo" style="display: none" class="form-group container color-bg">
                    <label>Insira o endereço da entrega:</label>
                    <div class="row">
                        <div class="col-xs-5">
                            <label>Logradouro</label>
                            <input class='form-control' name='logradouro' id='logradouro'>
                        </div>
                        <div class="col-xs-2">
                            <label>Número</label>
                            <input id='numero' type="number" class="form-control" min="0" name="numero"> 
                        </div>
                        <div class="col-xs-2">
                            <label>Complemento</label>
                            <input id='complemento' class='form-control' name="complemento">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Cidade</label>
                            <input id='cidade' class='form-control' name="cidade">
                        </div>

                        <div class="col-xs-2">
                            <label>Estado</label>
                            <select class="form-control" name="estado">
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Nprte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>

                        <div class="col-xs-3">
                            <label>CEP</label>
                            <input id='cep' class='form-control' name="cep">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-3">
                            <label>Nome associado a este endereço:</label>
                            <input id='nomeAssociado' class='form-control' name="nome-associado">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <input class='form-control btn-primary' type="submit" value="Concluir pedido">
                    </div>
                </div>
            </form>
        </div>
        <div>

        </div>
    </body>
</html>