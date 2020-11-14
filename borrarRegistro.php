<?php
    include 'libreria/conexion.php';
    $valor = array();
    $campo = array();
    if (isset($_POST['campo']) & isset($_POST['valor'])) {
        foreach ($_POST['campo'] as $c) {
            array_push($campo, $c);
        }
        foreach ($_POST['valor'] as $v) {
            array_push($valor, $v);
        }
        for ($p = 0; $p < count($campo); $p++) {
            $mod.=$campo[$p] . "='" . $valor[$p] . "',";
        }
        $mod = trim($mod, ',');
        $tabla = $_POST['tabla'];
        $filtro = $campo[0] . "='" . $valor[0] . "'";
        $sql = "DELETE FROM $tabla WHERE $filtro;";
        $result = mysqli_query($conexion,$sql) or die("No se puede ejecutar la consulta: " . mysql_error());
        header("location:mostrar.php?tabla=" . $_POST['tabla']);
    }
?>