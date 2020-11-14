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

    <title><?php echo $tituloPagina; ?></title>
    </head>
    <body>

    
    <header>
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
                            echo '<a class ="nav-link" href="mostrar.php?tabla='.$tabla.'"> Back</a>';
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid">

    <h3>Insertar registros en la tabla:
        <?php
        $tabla = trim(htmlspecialchars(addslashes($_GET['tabla'])));
        echo $tabla;
        $campos;
        ?>
        </h3>

        <form name="formInsertar" action="insertar.php" method="GET">

        
            <?php
                $result = mysqli_query($conexion,"SHOW COLUMNS FROM " . $tabla);
                echo "<input type='hidden' name='tabla' value=" . $tabla . ">";
            
                $campos="";
                while ($fila = mysqli_fetch_array($result)) {

                    print('<div class="form-group">');
                    print('<label for="'.$fila[0].'">'.$fila[0].'</label>');
                    print('<input type="text" class="form-control" id="valores[]" name="valores[]" aria-describedby="emailHelp">');
                    print('</div>');
                    $campos.="$fila[0],";
                }
            ?>
            <input type='hidden' name='campos' value='$campos' />
            <input type='submit' class="btn btn-primary" value='Insert' />
            <input type='reset' class="btn btn-primary"value='Clear'/>
            <input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='mostrar.php?tabla=<?php echo $tabla."'" ?>"/>
        </form>

</div>
</body>
</html>
<?php
    if (isset($_GET['valores'])){
        $campos = trim($campos, ',');
        $valor = array();
        $datos="";
        foreach ($_GET['valores'] as $v) {
            array_push($valor, trim(htmlspecialchars(addslashes($v))));
        }

        for ($p = 0; $p < count($valor); $p++) {
            $datos.="'" . $valor[$p] . "',";
        }
        $datos = trim($datos, ',');

        $sql = "INSERT INTO $tabla ($campos) VALUES ($datos)";

        $result = mysqli_query($conexion, $sql) or die("No se puede ejecutar la consulta: " . mysql_error());

        if (!$result) {
            die("Fallo al insertar el registro en la Base de Datos: " . mysql_error());
        }
        echo "
            <script languaje=javascript>
                alert ('Registro guardado');
            </script>
             ";
        mysql_close($conexion);
        $campos = "";
        $valor = "";
    }
?>