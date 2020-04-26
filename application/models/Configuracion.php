<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Model
{
    function update($nombre, $data)
    {
        $data = array("valor" => $data);
        $result = $this -> db -> update("configuracion", $data, "nombre = '" . $nombre . "'");
        return json_encode($result);
    }
}
?>
