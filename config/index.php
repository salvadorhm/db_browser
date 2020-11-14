<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN http://w3.org/TR/REC-html40/strict.dtd">
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <?php include 'conexion.php'; ?>
        <?php include 'configuracion.php'; ?>
        <title>
            <?php echo $tituloPagina; ?>
        </title>
    </head>
    <body>
        <div id="cabecera">
            <center>
                <h1>
                   CONFIGURACIÓN<br> PHP Automatic DB-Browser "PAFG"
                </h1>
            </center>
        </div>
        <div id="page">
            <center>
                <h2>
                    La última base de datos de la lista es la que se mostrara

                    <br>
                    <input type="button" value="Finalizar Configuración" onclick="window.location = '../index.php'"/>
                </h2>
            </center>
            <center>
                <?php
                    $result1 = mysqli_query($conexion,"SHOW COLUMNS FROM " . $dbtable);
                    echo "<form name='query' action='index.php' method='GET'>";
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
                    echo "<input type='hidden' name='tabla' value=" . $tabla . ">";
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
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $startAt = $perPage * ($page - 1);


                    $query1 = "SELECT COUNT(*) as total FROM  $dbtable $consulta;";
                    $r = mysqli_fetch_assoc(mysqli_query($conexion,$query1));
                    $registros =$r['total'];
                    $totalPages = ceil($registros / $perPage);


                    $siguiente = $page + 1;
                    $anterior = $page - 1;

                    $paginaActual = "Página $page de $totalPages";

                    $paginaAnterior = "<a href='index.php?page=$anterior & tabla=$dbtable'> Anterior </a> ";
                    $paginaSiguiente = "<a href='index.php?page=$siguiente& tabla=$dbtable'> Siguiente </a> ";

                     if($page==1 & $totalPages>1){
                            $paginacion=$paginaActual . " " . $paginaSiguiente;
                        }else if($page>1 & $page<$totalPages){
                            $paginacion=$paginaAnterior. " " . $paginaActual . " " .$paginaSiguiente;
                        }else if($page==$totalPages & $totalPages>1){
                            $paginacion=$paginaAnterior. " " . $paginaActual;
                        }else{
                            $paginacion=$paginaActual;
                        }


                    echo "$paginacion <br> $registros sitios configurados";
                ?>
                <br>
                <?php
                    $result2 = mysqli_query($conexion,"SHOW COLUMNS FROM " . $dbtable);
                     echo "<td><a href='insertar.php?id=$id&val=$fila[0]&tabla=" . $dbtable . "'>Insertar</a></td>";
                    echo "<table id='tabla-a'>";
                    echo "<tr>";
                    $p = 0;
                    while ($fila = mysqli_fetch_array($result2)) {
                        echo "<th>$fila[0]</th>";
                        if ($p == 0)
                            $id = $fila[0];
                        $p++;
                    }
                    //echo "<th>Insertar</th>";
                    echo "<th>Modificar</th>";
                    echo "<th>Borrar</th>";
                    echo "</tr>";
                    echo "<tr>";

                    $b1 = "SELECT * FROM " . $dbtable . $consulta . " ORDER BY id LIMIT " . $startAt . "," . $perPage . ";";
                    //echo $b1;
                    $result3 = mysqli_query($conexion, $b1);
                    while ($fila = mysqli_fetch_array($result3)) {
                        $campo = count($fila);
                        $campo/=2;
                        for ($p = 0; $p < $campo; $p++) {
                            echo "<td>$fila[$p]</td>";
                        }
                       
                        echo "<td><a href='modificar.php?id=$id&val=$fila[0]&tabla=" . $dbtable . "'>Modificar</a></td>";
                        echo "<td><a href='borrar.php?id=$id&val=$fila[0]&tabla=" . $dbtable . "'>Borrar</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
            </center>
            <br>
        </div>
    </body>
</html>