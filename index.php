<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

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
                <a class ="nav-link" href="/config/index.php"> Config </a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tables
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        $result = mysqli_query($conexion,"SHOW TABLE STATUS FROM $dbname;");
                        while ($array = mysqli_fetch_array($result)) {
                            if ($array['Engine'] != null) {
                                echo '<a class="dropdown-item" href="mostrar.php?tabla='.$array[Name].'">'.$array[Name].'</a>';
                            }
                        }
                    ?>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Views
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        $result = mysqli_query($conexion,"SHOW TABLE STATUS FROM $dbname;");
                        while ($array = mysqli_fetch_array($result)) {
                            if ($array['Engine'] == null) {
                                echo '<a class="dropdown-item" href="mostrarVistas.php?vista='.$array[Name].'">'.$array[Name].'</a>';
                            }
                        }
                    ?>
                </li>
            </ul>
            </div>
        </nav>
</header>
    <div class="container-fluid">

    
    </div>
</body>
</html>
