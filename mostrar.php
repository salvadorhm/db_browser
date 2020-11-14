<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <?php include 'libreria/conexion.php' ?>
    <?php include 'libreria/configuracion.php' ?>

    <script src="css/jquery-latest.min.js" type="text/javascript"></script>
    <script src="css/script.js"></script>
    <title><?php echo $tituloPagina; ?></title>
    </head>
    <body>

    <nav class ="navbar navbar-expand-xl navbar-dark bg-dark">
            <a class ="navbar-brand" href ="/"> DB-Browser </a>
            <button class ="navbar-toggler" type ="button" data-toggle ="collapse" data-target ="#colNav">
            <span class ="navbar-toggler-icon"></span>
            </button>
            <div class ="collapse navbar-collapse" id ="colNav">
                <ul class ="navbar-nav">
                    <li class ="nav-item">
                        <?php
                            $tabla = trim(htmlspecialchars(addslashes($_GET['tabla'])));
                            echo '<a class ="nav-link" href="insertar.php?tabla='.$tabla.'"> Insert</a>';
                        ?>
                    </li>
                </ul>
            </div>
    </nav>

    <div class="container-fluid">

        <div id="page">
                <h1>
                    Lista de registros 
                    <?php
                        $tabla = trim(htmlspecialchars(addslashes($_GET['tabla'])));
                        echo $tabla;
                    ?>
                </h1>

            <form name='query' action='mostrar.php' method='GET'><table class="table">
            <thead class="thead-dark">
                <tr>

                <?php
                    $result1 = mysqli_query($conexion,"SHOW COLUMNS FROM " . $tabla);
                    print("<td>");
                    echo "<select class='form-control' name='field'>";
                    while ($field = mysqli_fetch_array($result1)) {
                        echo "<option value='$field[0]'>$field[0]</option>";
                    }
                    echo "</select>";
                    print("</td>");
                    print("<td>");
                    echo "<select class='form-control' name='operation'>
                        <option value='='>=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='like'>like</option>
                    </select>";
                    print("</td>");
                    print("<td><input type='text' class='form-control'  name='valor'></td>");
                    echo "<input type='hidden' name='tabla' value=" . $tabla . ">";
                    echo "<td><input type='submit' class='btn btn-primary'  name='buscar' value='Search'></td>";
                    print("</tr>");

                    print("</table>");
                    echo "</form>";
                    if (isset($_GET['valor']) && $_GET['valor'] != NULL) {
                        $consulta = " where " . $_GET['field'] . " " . $_GET['operation'] . " '" . $_GET['valor'] . "'";
                    } else {
                        $consulta = "";
                    }
                ?>

                <?php
                    $perPage = 10;
                    $tabla = trim(htmlspecialchars(addslashes($_GET['tabla'])));
                    $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $startAt = $perPage * ($page - 1);


                    $query1 = "SELECT COUNT(*) as total FROM  $tabla $consulta;";
                    $r = mysqli_fetch_assoc(mysqli_query($conexion,$query1));
                    $registros =$r['total'];
                    $totalPages = ceil($registros / $perPage);


                    $siguiente = $page + 1;
                    $anterior = $page - 1;

                    $paginaActual = "Página $page de $totalPages";

                    $paginaAnterior = "<a href='mostrar.php?page=$anterior & tabla=$tabla'> Anterior </a> ";
                    $paginaSiguiente = "<a href='mostrar.php?page=$siguiente& tabla=$tabla'> Siguiente </a> ";

                     if($page==1 & $totalPages>1){
                            $paginacion=$paginaActual . " " . $paginaSiguiente;
                        }else if($page>1 & $page<$totalPages){
                            $paginacion=$paginaAnterior. " " . $paginaActual . " " .$paginaSiguiente;
                        }else if($page==$totalPages & $totalPages>1){
                            $paginacion=$paginaAnterior. " " . $paginaActual;
                        }else{
                            $paginacion=$paginaActual;
                        }


                    echo "$paginacion <br> $registros registros encontrados";
                ?>
               

        <table class="table">
            <thead class="thead-dark">
                <tr>
                <?php
                    $result2 = mysqli_query($conexion,"SHOW COLUMNS FROM " . $tabla);
                    //echo "<a href='insertar.php?id=$id&val=$fila[0]&tabla=" . $tabla . "'>Insertar</a>";
                    //echo "<table id='tabla-a'>";
                    //echo "<tr>";
                    $p = 0;
                    while ($fila = mysqli_fetch_array($result2)) {
                        echo "<th>$fila[0]</th>";
                        if ($p == 0)
                            $id = $fila[0];
                        $p++;
                    }
                    echo "<th>Update</th>";
                    echo "<th>Delete</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "</tbody>";
                    echo "<tr>";

                    $b1 = "SELECT * FROM " . $tabla . $consulta . " LIMIT " . $startAt . "," . $perPage . ";";
                    //echo $b1;
                    $result3 = mysqli_query($conexion, $b1);
                    while ($fila = mysqli_fetch_array($result3)) {
                        $campo = count($fila);
                        $campo/=2;
                        for ($p = 0; $p < $campo; $p++) {
                            echo "<td>$fila[$p]</td>";
                        }
                        echo "<td><a href='modificar.php?id=$id&val=$fila[0]&tabla=" . $tabla . "'>Update</a></td>";
                        echo "<td><a href='borrar.php?id=$id&val=$fila[0]&tabla=" . $tabla . "'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                </table>
        </div>
    </body>
</html>