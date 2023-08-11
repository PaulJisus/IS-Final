<?php
    require_once("../Repositories/Classes/Conexion.php");

    $connection = new Conexion;
    $conn = $connection->OpenConnection();

    $nombre_votacion = $_POST["nombre_votacion"];
    $pais_votacion = $_POST["pais_votacion"];
    $categoria = $_POST["categoria"];
    $votantes = $_POST["votantes"];
    $descripcion_votacion = $_POST["descripcion_votacion"];

    $query = "INSERT INTO votacion(nombre,descripcion,pais,cantidad_votantes)
		VALUES ('$nombre_votacion','$descripcion_votacion','$pais_votacion',$votantes);";
    $result = mysqli_query($conn, $query);
    
    if ($result)
    {
        echo 0;
    }
    else
    {
        echo 1;
    }

    $connection->CloseConnection();
    exit;
?>