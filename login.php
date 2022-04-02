<!DOCTYPE html>
    <head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
    </head>
    <body>
        <script type="text/javascript" src="index.js"></script>
        
        <form method="post" action="controller/login.php">
            <div class="centering">
                <div class="form-group container color-bg">
                    <div class="row">
                        <div class="col-xs-5">
                            <h1>Login</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>

                    <div class="row">
                        <div  class="col-xs-5">
                            <label>Senha</label>
                            <input class="form-control" name="senha" type="password" required>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 30px;">
                        <div class="col-xs-2">
                            <input class="form-control btn-primary" type="submit" value="Entrar">
                        </div>
                        <div class="col-xs-2">
                            <input class="form-control btn btn-primary" type="button" value="Cadastre-se" onclick="navigate('cliente.html')">
                        </div>
                    </div>
                    
                    <?php
                        if(isset($_GET['access'])) {
                            $access = $_GET['access'];
                            if($access == 'invalid') echo "<div class='alert alert-danger col-xs-3 row' role='alert'  style='margin-top: 30px;'><p>Email ou senha incorretos</p></div>";
                        }
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>