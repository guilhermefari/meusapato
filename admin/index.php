<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../index.css">
    <title>Admin Meu Sapato</title>
    </head>
    <?php 
        if(!isset($_COOKIE['admin'])){
            header('Location: login.html');
        }
    ?>
    <body>
        <script type="text/javascript" src="../index.js"></script>
        <div class="row">
            <input type="button" class="btn btn-outline-primary" value="Cadastrar Marca" onclick="navigate('marca.html')">
            <input type="button" class="btn btn-outline-primary" value="Cadastrar Produtos" onclick="navigate('produtos.php')">
            <input type="button" class="btn btn-outline-primary" value="Cadastrar Estoque" onclick="navigate('estoque.php')">
            <input type="button" class="btn btn-outline-secondary" value="Sair" onclick="navigate('controller/logout.php')">
        </div>
    </body>
</html>