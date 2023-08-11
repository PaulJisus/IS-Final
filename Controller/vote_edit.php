
<?php
    require_once("../Repositories/Classes/Conexion.php");

    $connection = new Conexion;
    $conn = $connection->OpenConnection();
    $id_votacion = $_POST["id_votacion"];
    $nombre_votacion = $_POST["nombre_votacion"];
    $pais_votacion = $_POST["pais_votacion"];
    $categoria = $_POST["categoria"];
    $votantes = $_POST["votantes"];
    $descripcion_votacion = $_POST["descripcion_votacion"];



    $query = "UPDATE votacion
                SET nombre = '$nombre_votacion',
                descripcion = '$descripcion_votacion',
                pais = '$pais_votacion',
                cantidad_votantes = '$votantes'
                WHERE id = $id_votacion;";
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