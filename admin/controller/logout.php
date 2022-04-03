<?php
    unset($_COOKIE["admin"]);
    setcookie("admin", null, -1, "/");
    
    header('Location: ../index.php');
?>