<html>
<head>
<title> Registrar Votacion </title>
<link rel="stylesheet" href="CSS_Files/register.css">
<?php
      include_once("../Services/include_important.php"); 
      require_once("../../Repositories/Classes/conexion.php");
      $connection = new Conexion;
?>
<script type="text/javascript" src="../Services/vote_register_functions.js"></script>
</head>

<body background="Images/blue_background.jpg"  style="background-size: cover"> 

    <br><br>
    <div class="jumbotron" id="signup_container" style="background:#cfe5ff"> 
        <div align="center" >
            <img src="Images/calendar.png" alt="Icono de calendario" width="150" height="150"> 
            <br><br>
            <h1 class="display-5"> Registrar Votación</h1>
        </div>
        <br>

<form id="vote_form">
  <label for="nombre_votacion">Nombre:</label><br>
  <input type="text" id="nombre_votacion" name="nombre_votacion" value="" class="form-control"><br>
  
  <?php
    $conn = $connection->OpenConnection();
    $query = "SELECT * FROM Categoria";
    $result = mysqli_query($conn, $query);
  ?>

  <label for="categoria">Categoria:</label><br>

  
    <?php
    while ($registro = mysqli_fetch_array($result))
    {
    ?>
    <input type="radio" id="<?php echo "option" . $registro["id"] ?>" name="category" value="<?php echo "option" . $registro["id"] ?>">
    <label for="<?php echo "option" . $registro["id"] ?>"> <?php echo $registro["nombre"]?> </label>
    <br>
    <?php
    }
    ?>
     <br>
  
  <label for="descripcion_votacion">Descripcion:</label><br>
  <input type="text" id="descripcion_votacion" name="descripcion_votacion" value="" class="form-control"><br>

  <label for="pais_votacion">Pais:</label><br>
  <input type="text" id="pais_votacion" name="pais_votacion" value="" class="form-control"><br>

  <label for="votantes">Cantidad votantes: </label><br>
  <input type="number" id="votantes" name="votantes" value="" class="form-control"><br>
  <br>
    
  <div align="right">
    <button type="button" id="submit_button" class="btn btn-success" onclick="register_vote()" > Ingresar Votacion </button>
  </div>
</form> 

<a href="admin_view.php" class="btn btn-danger"> Regresar</a>
</body>
</html>
