<?php
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($email == 'loginmeusapato@gmail.com' && $senha == 'login@2022'){
        setcookie("admin", 1, time() + (86400 * 30), "/");
        header('Location: ../index.php');
    } else {
       header('Location: ../login.html'); 
    }
?>