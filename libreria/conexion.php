<?php

    $con = mysqli_connect("127.0.0.1", "root", "toor","pafg");
    
    $query1 = "SELECT host,db,user,pass FROM bases ORDER BY id DESC LIMIT 1;";
    $result3 = mysqli_query($con,$query1);

    $dbhost = "";
    $dbname = "";
    $dbuser = "";
    $dbpassword = "";
    while ($fila = mysqli_fetch_array($result3)) {
        $dbhost = $fila[0];
        $dbname = $fila[1];
        $dbuser = $fila[2];
        $dbpassword = $fila[3];
    }

    $conexion = mysqli_connect($dbhost, $dbuser, $dbpassword,$dbname);

?>