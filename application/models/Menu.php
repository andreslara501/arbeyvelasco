<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Model
{
    function editar($data, $id){
        $type = $data["type"];
        unset($data["type"]);

        $result = $this -> db -> update($type, $data, "id = ".$id);
    }

    function set($data){
        $ultimo_orden   = 0;
        $type           = $data["type"];

        if($type == "menu"){
            $result = $this -> db
                            -> order_by("orden", "asc")
                            -> get($data["type"]);
        }else {
            $result = $this -> db
                            -> where("menu = {$data["menu"]}")
                            -> order_by("orden", "asc")
                            -> get($data["type"]);
        }

        unset($data["type"]);

        $submenus_para_orden = $result -> result_array();

        $ultimo_orden = end($submenus_para_orden);

        $data["orden"] =  $ultimo_orden["orden"] + 1;

        $result = $this -> db -> insert($type, $data);
        return $this -> db -> insert_id();
    }

    function reorganizar($data){
        $posiciones = explode(";", $data["posiciones"]);

        foreach ($posiciones as $posicion){
            $posicion_partes = explode("=", $posicion);

            $result = $this -> db
                            -> where('id', $posicion_partes["0"])
                            -> update($data["type"], array("orden" => $posicion_partes["1"]));
        }
        return 1;
    }

    function eliminar($id, $type){
        if($type == "menu"){
            $this -> db -> delete("submenu", "menu = ".$id);
        }

        $this -> db -> delete($type, "id = ".$id);
        return $id;
    }
}
?>
