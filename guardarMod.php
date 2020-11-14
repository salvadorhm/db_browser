<?php
    include 'libreria/conexion.php';
    $valor = array();
    $campo = array();
    $tabla= trim(htmlspecialchars(addslashes($_POST['tabla'])));
    if (isset($_POST['campo']) & isset($_POST['valor']))
    {
        foreach ($_POST['campo'] as $c) {
            array_push($campo, trim(htmlspecialchars(addslashes($c))));
        }
        foreach ($_POST['valor'] as $v) {
            array_push($valor, trim(htmlspecialchars(addslashes($v))));
        }
        for ($p = 0; $p < count($campo); $p++) {
            $mod.=$campo[$p] . "='" . $valor[$p] . "',";
        }
        $mod = trim($mod, ',');
        $filtro = $campo[0] . "='" . $valor[0] . "'";
        $sql = "UPDATE $tabla SET $mod  WHERE $filtro;";
        $result = mysqli_query($conexion, $sql) or die("No se puede ejecutar la consulta: " . mysql_error());
        header("location:mostrar.php?tabla=" . $_POST['tabla']);
    }
?>