<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN http://w3.org/TR/REC-html40/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <meta http-equiv="expires" content="-1" >
        <META HTTP-EQUIV="REFRESH" CONTENT="60;">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <?php include 'libreria/configuracion.php'; ?>
        <title><?php echo $tituloPagina; ?></title>
    </head>
    <body>
        <div id="cabecera">
            <center><h1><?php echo $tituloPagina; ?></h1></center>
        </div>
        <div id="page">
            <form name="usuarios" action="validacion.php" method="POST">
                <?php if(isset($_GET['mmm']))echo $_GET['mmm'];?>
                <br>
                <table>
                    <thead>
            <tr>
                <th colspan="2">Identificación del usuario</th>
            </tr>
        </thead>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" name="usuario"></td>
                    </tr>
                    <tr>
                        <td>Contraseña</td>
                        <td><input type="password" name="clave"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value='Ingresar'>
                            <input type="reset" value='Limpiar'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>        
    </body>
</html>
