<?php
    session_start();

    require_once("../Repositories/Classes/Conexion.php");

    $connection = new Conexion;
    $conn = $connection->OpenConnection();

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $clave = $_POST["clave"];
    

    $_SESSION["nombre_de_usuario"] = "$nombre_de_usuario";
               
    $query = "INSERT INTO  usuario (nombres, apellidos, correo_electronico, nombre_de_usuario, clave, telefono) VALUES ('$nombre', '$apellidos', '$correo', '$nombre_usuario', '$clave', '$telefono');";
    $result = mysqli_query($conn, $query);
    
    $last_id_query = "SELECT MAX(id) FROM Usuario;";
    $result = mysqli_query($conn, $last_id_query);
    $last_id = mysqli_fetch_row($result);   
    $id = trim( $last_id[0]);
    $_SESSION["id"] = $id;

    if ($result)
    {
        echo 0;
    }
    else
    {
        echo 1;
    }

    $connection->CloseConnection($conn);
    exit;
?>