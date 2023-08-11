<?php
//Implementacion principio SOLID LSP
interface IStatictics
{
    public function __construct($result_array);
    public function get_values();
}

//class Statictics usada para crear el array de cada columna visitada
class Statictics implements IStatictics
{
    public  $organizador_apellidos;
    public  $session_id;
    public  $session_date;
    public  $usuario_apellidos;

    public function __construct($result_array)
    {
        $this->organizador_apellidos = $result_array["organizador_apellidos"];
        $this->sesion_id = $result_array["sesion_id"];
        $this->sesion_fecha = $result_array["sesion_fecha"];
        $this->usuario_apellidos = $result_array["usuario_apellidos"];
    }

    public function get_values()
    {
        $values = [
            "organizador_apellidos" => "$this->organizador_apellidos",
            "sesion_id" => "$this->sesion_id",
            "sesion_fecha" => "$this->sesion_fecha",
            "usuario_apellidos" => "$this->usuario_apellidos"
        ];
        return $values;
    }
    
}

