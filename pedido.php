<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                            }
                        }
                    }
                }

                $total = $soma/100;
                echo "<h4>Total: ${total}</h4>";
            ?>
            <input class='form-check-input' type='checkbox' id='displayAddress' onclick="displayAddress()" checked>
            <label>Usar meu endereço cadastrado:</label>
            <p id="endAtual">
                <?php 
                $cpf = $_COOKIE['cpf']; 
                require_once("classes/Cliente.php");
                $clienteServer = new Cliente();
                $r = $clienteServer->buscarClientePorCPF($cpf);
                while($row = pg_fetch_row($r)){
                    echo "${row[6]}: ${row[0]}, ${row[1]}. ${row[3]} - ${row[4]}. ${row[5]}.";
                }
                ?>
            </p>
            <form>
                <div id="endereco-alternativo" style="display: none">
                    <label>Insira o endereço da entrega:</label>
                    <div class="item-field">
                        <label>Logradouro</label>
                        <input required>
                    </div>
                    <div class="item-field">
                        <label>Número</label>
                        <input type="number" required min="0"> 
                    </div>
                    <div class="item-field">
                        <label>Complemento</label>
                        <input>
                    </div>
                    <div class="item-field">
                        <label>Cidade</label>
                        <input required>
                    </div>
                    <div class="item-field">
                        <label>Estado</label>
                        <select>
                            <option>Acre</option>
                            <option>Alagoas</option>
                            <option>Amapá</option>
                            <option>Amazonas</option>
                            <option>Bahia</option>
                            <option>Ceará</option>
                            <option>Espírito Santo</option>
                            <option>Goiás</option>
                            <option>Maranhão</option>
                            <option>Mato Grosso</option>
                            <option>Mato Grosso do Sul</option>
                            <option>Minas Gerais</option>
                            <option>Pará</option>
                            <option>Paraíba</option>
                            <option>Paraná</option>
                            <option>Pernambuco</option>
                            <option>Piauí</option>
                            <option>Rio de Janeiro</option>
                            <option>Rio Grande do Sul</option>
                            <option>Rondônia</option>
                            <option>Roraima</option>
                            <option>Santa Catarina</option>
                            <option>São Paulo</option>
                            <option>Sergipe</option>
                            <option>Tocantins</option>
                            <option>Feminino</option>
                            <option>Distrito Federal</option>
                        </select>
                        <div class="item-field">
                            <label>Nome associado a este endereço:</label>
                            <input required>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <input type="submit" value="Concluir pedido">
                </div>
            </form>
        </div>
    </body>
</html>