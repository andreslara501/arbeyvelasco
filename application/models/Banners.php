<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Model
{
    function editar($data, $id){
        $result = $this -> db -> update("banners", $data, "id = ".$id);
    }

    function set($data){
        $result = $this -> db
                        -> order_by("orden", "asc")
                        -> get('banners');
        $ultimo_orden = 0;
        foreach ($result -> result() as $row){
            $ultimo_orden = $row -> orden + 1;
        }
        $data["orden"] =  $ultimo_orden;

        $result = $this -> db -> insert("banners", $data);
        return $this -> db -> insert_id();
    }

    function reorganizar($data){
        //$this -> db -> query("DELETE FROM banners");
        var_dump($data);
        $posiciones = explode(";", $data["posiciones"]);

        foreach ($posiciones as $posicion){
            $posicion_partes = explode("=", $posicion);

            $result = $this -> db
                            -> where('id', $posicion_partes["0"])
                            -> update("banners", array("orden" => $posicion_partes["1"]));
        }
        return 1;
    }

    function eliminar($id){
        $this -> db -> delete('banners', "id = ".$id);
        return $id;
    }
}
?>
