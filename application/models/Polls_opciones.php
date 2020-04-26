<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls_opciones extends CI_Model
{
    function editar($data, $id, $orden){
        $result = $this -> db -> update("polls_opciones", $data, "poll = " . $id . " AND orden = " . $orden);
    }

    function set($data){
        $result = $this -> db -> insert("polls_opciones", $data);
        return $this -> db -> insert_id();
    }

    function votar($id = 0){
        $this -> db -> where('id', $id);
        $this -> db -> set('votacion', 'votacion+1', FALSE);
        $this -> db -> update('polls_opciones');
    }
}
?>
