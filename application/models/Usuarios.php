<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model{
    function get(){
        $result = $this -> db
                        -> order_by("nombre", "asc")
                        -> where('activo', "1")
                        -> get('usuarios');

        return json_encode($result -> result_array(), JSON_PRETTY_PRINT);
    }

    function update($data, $id){
        $result = $this -> db   -> where("id = ".$id)
                                -> update("usuarios", $data);
    }

    function new_user($data){
        $result = $this -> db -> insert("usuarios", $data);
        return $this -> db -> insert_id();
    }

    function delete($id){
        $this -> db -> where('id', $id)
                    -> delete('usuarios');
    }
}
?>
