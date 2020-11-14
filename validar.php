<?php
    include 'configuracion.php';
    if($validar=='si'){
        session_start();
        if (isset($_SESSION['valido']) == true){
            if ($_SESSION['valido'] != "si"){
                header("location:login.php");
                exit();
            }
        }
        else{
             header('location:login.php');
        }
    }
?>
