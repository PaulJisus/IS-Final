<?php

interface funcionalidad_get
{
    public function get_values();
    
}

class Sesion implements funcionalidad_get
{
    public  $id;
    public  $hora;
    public  $fecha;
    public  $InformacionExtra;
    public  $Votacion;


    public function __construct($result_array)
    {
        $this->id = $result_array["id"];
        $this->fecha = $result_array["fecha"];
        $this->hora = $result_array["hora"];
        $this->Votacion = $result_array["informacionExtra"];
    }

    public function get_values()
    {
        $values = [
            "id" => "$this->id",
            "fecha" => "$this->fecha",
            "hora" => "$this->hora",
            "informacionExtra" => "$this->Votacion",
        ];
        return $values;
    }

    public function setId($id)
    {
        $this->$id = $id;
    }

    public function getId()
    {
        return $this->$id;
    }

    public function setHora($hora)
    {
        $this->$hora = $hora;
    }

    public function getHora()
    {
        return $this->$hora;
    }

    public function setFecha($fecha)
    {
        $this->$fecha = $fecha;
    }

    public function getFecha()
    {
        return $this->$fecha;
    }

    public function setInformacionExtra($InformacionExtra)
    {
        $this->$InformacionExtra = $InformacionExtra;
    }

    public function getInformacionExtra()
    {
        return $this->$InformacionExtra;
    }

    public function setVotacion($Votacion)
    {
        $this->$Votacion = $Votacion;
    }

    public function getVotacion()
    {
        return $this->$Votacion;
    }

}
