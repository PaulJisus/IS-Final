<?php
    session_start();

    require_once("../Repositories/Classes/Conexion.php");
  
    $conn = $connection->OpenConnection();

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $nacionalidad=$_POST["nacionalidad"];
    

               
    $query = "INSERT INTO  autor (nombres, apellidos, correo_electronico, telefono, nacionalidad) VALUES ('$nombre', '$apellidos', '$correo', '$telefono','$nacionalidad');";
    $result = mysqli_query($conn, $query);
    
   
    CloseConnection($conn);
    exit;
?>