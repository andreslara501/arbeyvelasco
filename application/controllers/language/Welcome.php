<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
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
		$data_ultimas_noticias = $this 	-> db
							 			-> order_by("id","DESC")
							 			-> limit(5)
							 			-> get('articulos');
		$data_ultimas_noticias = $data_ultimas_noticias -> result_array();

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
			"img" => "http://zenpronoticias.com/theme/img/principal.jpg",
			"url" => $data_configuracion["0"]["valor"],
			"google" => $data_configuracion["5"]["valor"]
		];

		$this -> paginas = $data_paginas;
		$data["menus"] = $data_menu -> result();
		$data["paginas"] = $data_paginas;
		$data["ultimas_noticias"] = $data_ultimas_noticias;
		$data["seccion_locales"] = $this -> noticias_seccion("locales", 2);
		$data["seccion_politica"] = $this -> noticias_seccion("politica", 2);
		$data["seccion_judicial"] = $this -> noticias_seccion("judicial", 2);
		$data["seccion_nacional"] = $this -> noticias_seccion("nacional", 2);
		$data["seccion_denuncias_principal"] = $this -> noticias_seccion("denuncias", 1);
		$data["seccion_denuncias"] = $this -> noticias_seccion("denuncias", 2, 1);
		$data["seccion_lapluma_principal"] = $this -> noticias_seccion("lapluma", 1);
		$data["seccion_lapluma"] = $this -> noticias_seccion("lapluma", 2, 1);
		$data["publicidades"] = $data_publicidades;
		$data["etiquetas"] = $data_etiquetas;
		$this -> theme_load($data);
	}

	public function noticias_seccion($seccion, $limite = 2, $inicio = 0){
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

	function theme_load($data){
		$this -> load -> view('../../theme/views/principal/config');
		$this -> load -> view('../../theme/views/principal/start', $data);
		$this -> load -> view('../../theme/views/principal/head', $data);
		$this -> load -> view('../../theme/views/principal/menu');
		$this -> load -> view('../../theme/views/principal/content');
		$this -> load -> view('../../theme/views/principal/footer');
	}

}
?>
