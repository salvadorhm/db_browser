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

    <h3>Update</h3>
            <form action='guardarMod.php' method='POST'>
                <?php
                    $tabla=trim(htmlspecialchars(addslashes($_GET['tabla'])));
                    $id=trim(htmlspecialchars(addslashes($_GET['id'])));
                    $val=trim(htmlspecialchars(addslashes($_GET['val'])));

                    $result = mysqli_query($conexion, "SHOW COLUMNS FROM " . $tabla);
                    $valores = mysqli_query($conexion, "SELECT * FROM ".$tabla." WHERE ".$id."='".$val."'");
                    $valcam=mysqli_fetch_array($valores);

                    
                    $pos=0;
                    $campos="";
                    while ($fila = mysqli_fetch_array($result)) {
                        print('<div class="form-group">');
                        print('<label for="'.$fila[0].'">'.$fila[0].'</label>');
                        print('<input type="text" class="form-control" id="valor[]" name="valor[]" value="'.$valcam[$pos].'" aria-describedby="emailHelp">');
                        print('</div>');
                        echo "<input type='hidden' name='tabla' value='".$tabla."'>";
                        echo "<input type='hidden' name=campo[] value='$fila[0]'>";
                        $pos++;
                        $campos.="$fila[0],";
                    }
                    echo "<input type='hidden' name='tabla' value='" . $tabla. "'>";
                    echo "<input type='submit' class='btn btn-primary' value='Update'>";
                ?>
                <input type="button" value="Cancel" class="btn btn-primary" onclick="window.location='mostrar.php?tabla=<?php echo $tabla."'" ?>"/>
            </form>
        </div>
    </body>
</html>