<?php session_start(); ?>

<html>
  <head>
    <title> Inicio (Administrador)</title>
    <?php
      include_once("../Services/include_important.php"); 
      require_once("../../Repositories/Classes/conexion.php");
      include_once("../Models/Votacion.php");
      include_once("../Models/Persona.php");
      $connection = new Conexion;
    ?>
    <script type="text/javascript" src="../Services/admin_view_functions.js"></script>
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
      <button class="btn btn-outline-danger" id="logout_button" onclick="logout();" align="right"> Cerrar Sesión </button>
    </div>
  </nav>

    <br>

    <div class="container">
        
    <?php
        $conn = $connection->OpenConnection();
        $query = "SELECT nombre, id, descripcion, pais
                  FROM Votacion";
        $query2 = "SELECT id, nombres, apellidos, correo_electronico, telefono FROM";
        
        if ($_SESSION["permisos"] == "admin")
        {
            $query2 = $query2 . " Organizador";
        }
        else
        {
            $query2 = $query2 . " Usuario";
        }

        $result1 = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);
        $temp = mysqli_fetch_array($result2);
        $administrador = new Persona($temp, "Administrador");
    ?>

    <h1 class="display-4">Bienvenido a tu Inicio, <?php echo $administrador->nombres;?></h1>
    
    <br><br><br>

    

    
    <div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col"> <h4> ID de Votacion </h4> </th>
                <th scope="col"> <h4> Nombre de Votacion </h4> </th>
                <th scope="col"> <h4> Descripcion </h4> </th>
                <th scope="col"> <h4> Pais </h4> </th>                
            </tr>
        </thead>
        
        <tbody>

            <?php
            if(isset($_GET['id']))
            {
                $id_evento = $_GET["id"];
                echo $id_votacion;
                $query = "DELETE FROM sesion_usuario WHERE id_sesion=$id_votacion";
                $query2 = "DELETE FROM sesion WHERE id_votacion=$id_votacion";
                $query3 = "DELETE FROM Votacion WHERE id=$id_votacion";

                mysqli_query($conn, $query);
                mysqli_query($conn, $query2);
                mysqli_query($conn, $query3);
                header('Location: admin_view.php');
                
            }
                while ($registro = mysqli_fetch_array($result1))
                {
                    echo "<tr>";
                    $current_vote = new Votacion( $registro);
                    $datos = $current_vote->get_values();
                    echo "<th scope=\"row\"> ";
                    echo $datos['id'];
                    echo "</th>";

                    echo "<td>";
                    echo $datos['nombre'];
                    echo "</td>";

                    echo "<td>";
                    echo $datos['descripcion'];
                    echo "</td>";

                    echo "<td>";
                    echo $datos['pais'];
                    echo "</td>";

                    echo "<td>";?>
                    <a href="admin_view.php?id=<?php echo $current_vote->idVotacion; ?>" class="btn btn-danger">Eliminar</a>
                    <a href="edit_vote.php?id=<?php echo $current_vote->idVotacion; ?>" class="btn btn-secondary">Editar</a>
                    <a href="statistics_vote.php?id=<?php echo $current_vote->idVotacion; ?>" class="btn btn-secondary">Estadisticas</a>
                    <a href="vote_sesion_register_page.php?id_votacion=<?php echo $current_vote->idVotacion; ?>" class="btn btn-success"> Agregar sesión </a>
                    <?php
                    echo "</td>"; 
                    echo "</tr>";
                }
            ?>

        </tbody>
    </table>
    </div>
    <br><br>

    
    <br>
        
    <div class="container">
    <a href="vote_register_page.php" class="btn btn-success"> Agregar Votacion</a>
    
    <a href="add_category.php" class="btn btn-info"> Agregar Categoría</a>
    </div>
    <br><br>


    <h4>Información de Contacto:</h4>
    <br>
    Correo Electrónico:  <?php echo $administrador->correoElectronico; ?>
    <br>
    Teléfono:  <?php echo $administrador->telefono; ?>
    <br><br>

    </body>
    
</html>








<style>
    .ajs-message { color: #31708f;  background-color: #d5edf6;  border-color: #21306f; }
</style>


<?php


function session_finish()
{
    if ($_GET['logout'] = 'true')
    {
        session_unset();
        session_destroy();
    }
}
?>
