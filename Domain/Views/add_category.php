<!DOCTYPE html>
<html lang="es">

<head>
    <title> Inicio (Administrador)</title>
    <?php
      include_once("../Services/include_important.php"); 
      require_once("../../Repositories/Classes/conexion.php");
      include_once("../Models/Votacion.php");
      $connection = new Conexion;
    ?>
  </head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav">
            <a class="nav-link active" href="#">Inicio</a>
            <a class="nav-link" href="#"></a>
            <a class="nav-link" href="#"></a>
            <a class="nav-link" href="#"></a>

            
        </div>
      </div>
      <button class="btn btn-outline-danger" id="logout_button" align="right"> Cerrar Sesión </button>
    </div>
  </nav>



  <div class="jumbotron" id="all_content" style="background:#cfe7ff">

    <h1 class="display-3" align="center"> Inserte una Categoría </h1>

    <?php
    if(isset($_GET['nombre']))
    {
        $conn = $connection->OpenConnection();
        $nombre_categoria = $_GET["nombre"];
        $query = "INSERT INTO Categoria(nombre) value('$nombre_categoria')";
        
        mysqli_query($conn, $query);
        header('Location: add_category.php');
    }
    ?>

    <br><br>


    <div class="container" align="center">
        <form id="add_category" method="get">
            <label for="nombre"> Nombre</label>
            <input id="nombre" name="nombre" type="text" size="15">
            <button class="btn btn-primary"id="index-buttons" type="submit">Insertar</button>
        </form>
    </div>
    

    <br><br>
    <div align="right">
        <a href="admin_view.php" class="btn btn-danger"> Regresar </a>        
    </div>
    
  </div>

</div>
</body>
</html>
