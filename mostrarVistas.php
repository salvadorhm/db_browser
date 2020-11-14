<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN http://w3.org/TR/REC-html40/strict.dtd">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <?php include 'libreria/conexion.php'; ?>
        <?php include 'libreria/configuracion.php'; ?>

        <title><?php echo $tituloPagina; ?></title>
    </head>
    <body>
        <div id="cabecera">
            <center>
                <h1><?php echo $tituloPagina; ?></h1>

            </center>
        </div>
        <div id="page">
            <center><h1>Lista de registros 
                <?php
                $tabla = trim(htmlspecialchars(addslashes($_GET['vista'])));
                echo $tabla;
                ?>
                </h1></center>
            <center>
                <input type="button" value="Regresar" onclick="window.location = 'index.php'"/>
                <?php
                    $result1 = mysqli_query($conexion,"SHOW COLUMNS FROM " . $tabla);
                    echo "<form name='query' action='mostrarVistas.php' method='GET'>";
                    echo "<select name='field'>";
                    while ($field = mysqli_fetch_array($result1)) {
                        echo "<option value='$field[0]'>$field[0]</option>";
                    }
                    echo "</select>";
                    echo "<select name='operation'>
                        <option value='='>=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='like'>like</option>
                    </select>
                    <input type='text' name='valor'>";
                    echo "<input type='hidden' name='vista' value=" . $tabla . ">";
                    echo "<input type='submit' name='buscar' value='Buscar'>";
                    echo "</form>";

                    if (isset($_GET['valor']) && $_GET['valor'] != NULL) {
                        $consulta = " where " . $_GET['field'] . " " . $_GET['operation'] . " '" . $_GET['valor'] . "'";
                    } else {
                        $consulta = "";
                    }
                ?>
                <br>
                <?php
                    $perPage = 10;
                    $vista = trim(htmlspecialchars(addslashes($_GET['vista'])));
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $startAt = $perPage * ($page - 1);

                    $query1 = "SELECT COUNT(*) as total FROM  $tabla $consulta;";
                    $r = mysqli_fetch_assoc(mysqli_query($conexion,$query1));

                    $totalPages = ceil($r['total'] / $perPage);


                    $siguiente=$page+1;
                    $anterior =$page-1;

                    $paginaActual= "Página $page de $totalPages";

                    $paginaAnterior= "<a href='mostrarVistas.php?page=$anterior & vista=$vista'> Anterior </a> ";
                    $paginaSiguiente= "<a href='mostrarVistas.php?page=$siguiente& vista=$vista'> Siguiente </a> ";

                    if($page==1){
                        $paginacion=$paginaActual . " " . $paginaSiguiente;
                    }else if($page>1 & $page<$totalPages){
                        $paginacion=$paginaAnterior. " " . $paginaActual . " " .$paginaSiguiente;
                    }else if($page==$totalPages){
                        $paginacion=$paginaAnterior. " " . $paginaActual;
                    }


                    echo $paginacion;

                    $result = mysqli_query($conexion,"SHOW COLUMNS FROM " . $tabla);
                    echo "<table id='tabla-a'>";
                    echo "<tr>";
                    $p = 0;
                    while ($fila = mysqli_fetch_array($result)) {

                        echo "<th>$fila[0]</th>";
                        if ($p == 0)
                            $id = $fila[0];
                        $p++;
                    }
                    echo "</tr>";
                    echo "<tr>";
                    $result = mysqli_query($conexion,"SELECT * FROM " . $tabla . $consulta ." LIMIT ". $startAt.",". $perPage.";");
                    while ($fila = mysqli_fetch_array($result)) {
                        $campo = count($fila);
                        $campo/=2;
                        for ($p = 0; $p < $campo; $p++) {
                            echo "<td>$fila[$p]</td>";
                        }

                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
                <input type="button" value="Regresar" onclick="window.location = 'index.php'"/>
            </center>
            <br>
        </div>
    </body>
</html>