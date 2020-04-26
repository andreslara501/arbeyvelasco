<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Login extends CI_Controller
{
	public function index(){
		echo "hola ;)";
	}

	public function login_form(){
		$data = $this -> input -> post();

		if(isset($data["usuario"]) AND isset($data["password"])){
			$result = $this -> db
	                        -> where("usuario='" . $data["usuario"] . "' AND contrasena='" . $data["password"] . "'")
	                        -> get("usuarios");
			$row = $result -> row_array();

			if(count($row)){
				echo json_encode(array("respuesta" => 1));
				$_SESSION['usuario'] 			= $data["usuario"];
				$_SESSION['password'] 			= $data["password"];
				$_SESSION['nombre_usuario'] 	= $row["nombre"];
				$_SESSION['tipo_usuario'] 		= $row["tipo_usuario"];
			}else{
				echo json_encode(array("respuesta" => 0));
			}
		}
	}

	public function out() {
		$_SESSION['usuario'] = "";
		$_SESSION['password'] = "";
		session_destroy();
	}
}
?>
