<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends CI_Controller {
	function _output($output){
        echo $this -> sanitize_output($output);
    }

	function sanitize_output($buffer){
	    $search = array(
	        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
	        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
	        '/(\s)+/s',         // shorten multiple whitespace sequences
	        '/<!--(.|\s)*?-->/' // Remove HTML comments
	    );
	    $replace = array(
	        '>',
	        '<',
	        '\\1',
	        ''
	    );
	    $buffer = preg_replace($search, $replace, $buffer);
	    return $buffer;
	}

	/* Configuración */
	public $menu_activo = 1;

	/* Propiedades */
	public $paginas;

	public function index(){
		/* data Menú */
		$data_menu = $this 	-> db
							-> order_by("orden", "asc")
							-> get('menu');

		$data["menu_activo"] = $this -> menu_activo;

		/* data Páginas */
		$data_paginas = $this 	-> db
							 	-> get('paginas');
		$data_paginas = $data_paginas -> result_array();

		/* data Ultimas noticias */
		$data_noticias = $this 	-> db
							 			-> order_by("id","DESC")
							 			-> where("pagina = 9")
							 			-> limit(40)
							 			-> get('articulos');
		$data_noticias = $data_noticias -> result_array();

		/* data Publicidad */
		$data_publicidades = $this 		-> db
							 			-> order_by("RAND()")
							 			-> limit(5)
							 			-> get('banners');
		$data_publicidades = $data_publicidades -> result_array();

		/* data Etiquetas */
		$data_configuracion = $this 	-> db
							 			-> order_by("id")
							 			-> limit(6)
							 			-> get('configuracion');
		$data_configuracion = $data_configuracion -> result_array();

		$data_etiquetas =[
		    "titulo" => $data_configuracion["1"]["valor"],
		    "descripcion" => $data_configuracion["3"]["valor"],
			"img" => "/theme/img/principal.jpg",
			"url" => $data_configuracion["0"]["valor"],
			"google" => $data_configuracion["5"]["valor"]
		];

		$this -> paginas = $data_paginas;
		$data["menus"] = $data_menu -> result();
		$data["paginas"] = $data_paginas;
		$data["noticias"] = $data_noticias;
		$data["informacion_principal"] = $this -> noticias_seccion("informacion-principal", 2);
		$data["propuestas"] = $this -> noticias_seccion_desendiendo("propuestas", 20);
		$data["noticias"] = $this -> noticias_seccion_desendiendo("noticias", 20);
		$data["publicidades"] = $data_publicidades;
		$data["etiquetas"] = $data_etiquetas;
		$this -> theme_load($data, 'noticias');
	}

	public function noticia($alias){
		/* data Menú */
		$data_menu = $this 	-> db
							-> order_by("orden", "asc")
							-> get('menu');

		$data["menu_activo"] = $this -> menu_activo;

		/* data Páginas */
		$data_paginas = $this 	-> db
							 	-> get('paginas');
		$data_paginas = $data_paginas -> result_array();

		/* data Ultimas noticias */
		$data_noticia  = $this 	-> db
							 			-> order_by("id","DESC")
							 			-> where("pagina = 9 AND alias LIKE '" . $alias . "'")
							 			-> get('articulos');
		$data_noticia = $data_noticia -> row_array();

		/* data Publicidad */
		$data_publicidades = $this 		-> db
							 			-> order_by("RAND()")
							 			-> limit(5)
							 			-> get('banners');
		$data_publicidades = $data_publicidades -> result_array();

		/* data Etiquetas */
		$data_configuracion = $this 	-> db
							 			-> order_by("id")
							 			-> limit(6)
							 			-> get('configuracion');
		$data_configuracion = $data_configuracion -> result_array();

		$data_etiquetas =[
		    "titulo" => $data_configuracion["1"]["valor"],
		    "descripcion" => $data_configuracion["3"]["valor"],
			"img" => "/theme/img/principal.jpg",
			"url" => $data_configuracion["0"]["valor"],
			"google" => $data_configuracion["5"]["valor"]
		];

		$this -> paginas = $data_paginas;
		$data["menus"] = $data_menu -> result();
		$data["paginas"] = $data_paginas;
		$data["noticia"] = $data_noticia;
		$data["informacion_principal"] = $this -> noticias_seccion("informacion-principal", 2);
		$data["noticias"] = $this -> noticias_seccion_desendiendo("noticias", 20);
		$data["publicidades"] = $data_publicidades;
		$data["etiquetas"] = $data_etiquetas;
		$this -> theme_load($data, 'noticia');
	}

	public function noticias_seccion($seccion, $limite = 2, $inicio = 0){
		foreach($this -> paginas as $pagina){
			if($seccion == $pagina["alias"]){
				$pagina_seleccion = $pagina;
			}
		}

		$data_ultimas_noticias = $this 	-> db
							 			-> order_by("id","ASC")
							 			-> limit($limite, $inicio)
							 			-> where("pagina = " . $pagina_seleccion["id"])
							 			-> get('articulos');

		return $data_ultimas_noticias -> result_array();
	}

	public function noticias_seccion_desendiendo($seccion, $limite = 2, $inicio = 0){
		foreach($this -> paginas as $pagina){
			if($seccion == $pagina["alias"]){
				$pagina_seleccion = $pagina;
			}
		}

		$data_ultimas_noticias = $this 	-> db
							 			-> order_by("id","DESC")
							 			-> limit($limite, $inicio)
							 			-> where("pagina = " . $pagina_seleccion["id"])
							 			-> get('articulos');

		return $data_ultimas_noticias -> result_array();
	}

	function theme_load($data, $name){
		$this -> load -> view('../../theme/views/start', $data);
		$this -> load -> view('../../theme/views/principal/' . $name, $data);
		$this -> load -> view('../../theme/views/footer', $data);
	}

}
?>
