<?php
    include 'libreria/conexion.php';
    include 'libreria/configuracion.php';

    $usuario = trim(htmlspecialchars(addslashes($_POST['usuario'])));
    $clave = trim(htmlspecialchars(addslashes($_POST['clave'])));

    $sql = "select * from $tablaUsuarios where $valorUsuario='$usuario' and $valorClave='$clave';";

    echo $sql;

    $result = mysqli_query($sql, $conexion) or die("No se puede ejecutar la consulta: " . mysql_error());

    if (mysql_num_rows($result) < 1) {
        header("location:login.php?mmm=Usuario no encontrado");
        exit();
    }

    while (($row = mysql_fetch_row($result)) !== false) {
        $usuario = $row[0];
    }
    if ($usuario != "") {
        session_start();
        $_SESSION['valido'] = 'si';
        $_SESSION['usuario'] = $usuario;

        header('location:index.php');
        exit();
    } else {
        header("location:login.php?mmm=Usuario no encontrado");
        exit();
}
?>
