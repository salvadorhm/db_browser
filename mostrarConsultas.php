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

        <div id="page">
            <h1>Lista de registros 
                <?php
                $sql = $_GET['sql'];
                echo $sql;
                ?>
            </h1>
            <center>
                <input type="button" value="Regresar" onclick="window.location='index.php'"/>
                <?php
                    echo "<table id='tabla-a'>";
                    echo "<tr>";
                    $result = mysqli_query($conexion, $sql);
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
                <input type="button" value="Regresar" onclick="window.location='index.php'"/>
            </center>
            <br>
        </div>
    </body>
</html>