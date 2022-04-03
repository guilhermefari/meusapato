<!DOCTYPE html>
    <?php
        if(!isset($_COOKIE["username"])){
            header('Location: login.php');
        }
    ?>
    <head>
        <meta charset="UTF-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="index.css">
        <title>Meu Sapato</title>
    </head>
    <body>
        <script type="text/javascript" src="index.js"></script>
        <?php
            $name = strtok($_COOKIE["username"], " ");
            echo "<h3>Olá, {$name}!</h3>";
        ?>
        <div class="row">
            <input type="button" class="btn btn-outline-primary" value="Ver Produtos" onclick="navigate('produtos.php?page=1')">
            <input type="button" class="btn btn-outline-secondary" value="Sair" onclick="navigate('controller/logout.php')">
        </div>
    </body>
</html>