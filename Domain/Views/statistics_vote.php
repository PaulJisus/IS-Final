<?php session_start(); ?>

<html>
  <head>
    <title> Inicio (Administrador)</title>
    <?php
      include_once("../Services/include_important.php"); 
      require_once("../../Repositories/Classes/conexion.php");
      include_once("../Models/Persona.php");
      include_once("../Models/Statistics.php");
      $connection = new Conexion;
    ?>
    <script type="text/javascript" src="../Services/admin_view_functions.js"></script>
  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav">
            <a class="nav-link active" href="#">Regresar</a>
                        
        </div>
      </div>

    </div>
  </nav>

    <?php
        $conn = $connection->OpenConnection();
        if(isset($_GET['id']))
        {
            $id_evento = $_GET["id"];
            $query = "SELECT
            organizador.apellidos 'organizador_apellidos',
            sesion.id 'sesion_id',
            sesion.fecha 'sesion_fecha',
            usuario.apellidos 'usuario_apellidos'
        FROM 
            organizador,
            votacion_organizador,
            sesion,
            votacion_sesion,
            usuario
        WHERE
            votacion_organizador.id_votacion = 4 AND
            organizador.id = votacion_organizador.id_organizador AND
            votacion_sesion.id_votacion = 4 AND
            sesion.id = votacion_sesion.id_sesion
        LIMIT
            3";
                
        }
        $result1 = mysqli_query($conn, $query);
        $temp = mysqli_fetch_array($result1);
    ?>

    <br><br><br>

    
    <div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> <h4> Organizadores </h4> </th>
                <th scope="col"> <h4> ID Sesiones </h4> </th>
                <th scope="col"> <h4> Fecha Sesiones </h4> </th>
                <th scope="col"> <h4> Usuarios </h4> </th>
            </tr>
        </thead>
        
        <tbody>

            <?php

            while ($registro = mysqli_fetch_array($result1))
                {
                    echo "<tr>";
                    $current_vote = new Statictics($registro);
                    $datos = $current_vote->get_values();
                    echo "<th scope=\"row\"> ";

                    echo "<td>";
                    echo $datos['organizador_apellidos'];
                    echo "</td>";

                    echo "<td>";
                    echo $datos['sesion_id'];
                    echo "</td>";

                    echo "<td>";
                    echo $datos['sesion_fecha'];
                    echo "</td>";

                    echo "<td>";
                    echo $datos['usuario_apellidos'];
                    echo "</td>";
                }
            ?>

        </tbody>
    </table>
    </div>
    <br><br><br>
    </body>
    
</html>




<style>
    .ajs-message { color: #31708f;  background-color: #d9edf7;  border-color: #31708f; }
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
