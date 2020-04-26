<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Model
{
    function editar($data, $id){
        $result = $this -> db -> update("polls", $data, "id = " . $id);
    }

    function set($data){
        $result = $this -> db -> insert("polls", $data);
        return $this -> db -> insert_id();
    }

    function eliminar($id){
        $this -> db -> delete('polls', "id = ".$id);
        return $id;
    }

    function publica($id){
        $this -> db -> update('polls', array("publica" => 0), "id > 0");
        $this -> db -> update('polls', array("publica" => 1), "id = ".$id);
        return $id;
    }
}
?>
