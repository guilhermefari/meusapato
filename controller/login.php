<?php
    require_once "../classes/Cliente.php";
    $clienteServer = new Cliente();

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $result = $clienteServer->login($email, $senha);

    if(pg_num_rows($result) == 0) header('Location: ../login.php?access=invalid');
    else{
        while($row = pg_fetch_row($result)){
           setcookie("username", $row[1], time() + (86400 * 30), "/");
           setcookie("cpf", $row[0], time() + (86400 * 30), "/");
           header('Location: ../index.php');
        }
    }

?>