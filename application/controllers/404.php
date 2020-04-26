<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locales extends CI_Controller {
	/* Configuración */
	public $seccion = "locales";
	public $menu_activo = 2;
	public $articulos_por_pagina = 10;

	/* Propiedades */
	public $primer_identificador;
	public $segundo_identificador;
	public $tercer_identificador;

	public $pagina;
	public $posicion_pagina_registros;

	public function __construct(){
 		parent::__construct();

        $this -> load -> view('principal/config');
		$this -> load -> view('principal/start');
		$this -> load -> view('principal/head', $data);
		$this -> load -> view('principal/menu');
		$this -> load -> view('internas/' . $interna);
		$this -> load -> view('principal/footer');
	}
}
?>
