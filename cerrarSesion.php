<?php
    session_start();
    $_SESSION['valido'] = "";
    $_SESSION['usuario'] = "";
    if (isset($_GET['mmm']))
        header("location:login.php?mmm=" . $_GET['mmm']);
    else
        header("location:login.php");
    exit();
?>
