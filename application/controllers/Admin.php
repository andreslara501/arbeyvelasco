<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this -> limpiar_tmp("./uploads/tmps");
		$this -> limpiar_tmp("./uploads/archivos/tmps");
	}

	public function index(){

		$result = $this 	-> db
							-> order_by("titulo", "asc")
							-> get('paginas');
		$paginas = $result 	-> result_array();

		$data["paginas"]					= $paginas;

		$this -> theme_load('start', $data);
	}

	public function configuracion(){
		$this -> theme_load('configuracion');
	}

	public function usuarios(){
		$this -> theme_load('usuarios');
	}

	public function enlaces_rapidos(){
		$this -> theme_load('enlaces_rapidos');
	}

	public function paginas($seccion="", $id=""){
		switch($seccion){
			case 'nueva':
				/*configuración*/
				$type 			= "paginas";
				$type_dir 		= "pages";
				$titulo_tipo 	= "Nueva página";
				$palabra_tipo 	= "página";

				$pagina_get = "";
				if(isset($_GET["pagina"])){
					$data["pagina_get"] = htmlentities($_GET["pagina"]);

					$result = $this -> db
									-> where("id = " . $data["pagina_get"])
									-> order_by("titulo", "asc")
									-> get('paginas');
					$pagina = $result -> row_array();

					$data["nombre_pagina"] = $pagina;
				}else{
					$data["pagina_get"] = FALSE;
				}

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["paginas"]					= $paginas;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["galeria"] 					= $this -> galeria($type_dir);
				$data["url_api_galeria_imagenes"] 	= "/api/galeries_upload/{$type_dir}/{$id}/";
				$data["url_api_archivos"]			= "/api/files_{$type}/upload/";
				$data["url_form"]					= "/core_noodles/post/post.php?type={$type_dir}_new";

				$this -> theme_load("internals/generic", $data);
				break;

			case 'editar':
				/*configuración*/
				$type 			= "paginas";
				$type_dir 		= "pages";
				$titulo_tipo 	= "Editar página";
				$palabra_tipo 	= "página";

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$result = $this -> db
								-> where("id='" . $id ."'")
								-> get($type);

				$content = $result -> row_array();

				$data["id"]							= $id;
				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["paginas"]					= $paginas;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["galeria"] 					= $this -> galeria($type_dir);
				$data["url_api_galeria_imagenes"] 	= "/api/galeries_upload/{$type_dir}/{$id}/";
				$data["url_api_archivos"]			= "/api/files_upload/{$type_dir}/{$id}/";
				$data["url_form"]					= "/core_noodles/post/post.php?type={$type_dir}_edit&id={$id}";
				$data["content"]					= $content;
				$data["pagina_get"]					= "";
				$data["galeria_id"]					= $this -> galeria_id($type_dir, $id);
				$data["archivos_id"]				= $this -> archivos_id($type_dir, $id);

				$this -> theme_load("internals/generic", $data);
				break;

			case '':
				$type 					= "paginas";
				$type_dir 				= "pages";
				$titulo_tipo 			= "Páginas";
				$subtitulo_tipo 		= "Páginas";
				$palabra_tipo 			= "página";
				$titulo_tipo_interno 	= "Todas las páginas";
				$texto_tipo				= "Las páginas son como categorías, en ellas van agrupados los artículos";

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["subtitulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["titulo_tipo_interno"]		= $titulo_tipo_interno;
				$data["paginas"]					= [];
				$data["elementos"]					= $paginas;
				$data["texto_tipo"]					= $texto_tipo;

				$this -> theme_load("internals/generic_list", $data);
				break;

			default:
				$this -> load -> view('errors/noaccess');
				break;
		}
	}

	public function articulos($seccion="", $id=""){
		switch($seccion){
			case 'nuevo':
				/*configuración*/
				$type 			= "articulos";
				$type_dir 		= "articles";
				$titulo_tipo 	= "Nuevo artículo";
				$palabra_tipo 	= "artículo";

				$pagina_get = "";
			    if(isset($_GET["pagina"])){
			        $data["pagina_get"] = htmlentities($_GET["pagina"]);

					$result = $this -> db
									-> where("id = " . $data["pagina_get"])
									-> order_by("titulo", "asc")
									-> get('paginas');
					$pagina = $result -> row_array();

					$data["pagina_articulo"] 	= $pagina;
			    }else{
					$data["pagina_get"] = FALSE;
				}

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["paginas"]					= $paginas;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["galeria"] 					= $this -> galeria($type_dir);
				$data["url_api_galeria_imagenes"] 	= "/api/galeries_upload/{$type_dir}/{$id}/";
				$data["url_api_archivos"]			= "/api/files_upload/{$type_dir}/{$id}/";
				$data["url_form"]					= "/core_noodles/post/post.php?type={$type_dir}_new";

				$this -> theme_load("internals/generic", $data);
				break;

			case 'editar':
				/*configuración*/
				$type 			= "articulos";
				$type_dir 		= "articles";
				$titulo_tipo 	= "Editar artículo";
				$palabra_tipo 	= "artículo";

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$result = $this -> db
			                    -> where("id='" . $id ."'")
			                    -> get($type);

			    $content = $result -> row_array();

				$data["id"]							= $id;
				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["paginas"]					= $paginas;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["galeria"] 					= $this -> galeria($type_dir);
				$data["url_api_galeria_imagenes"] 	= "/api/galeries_upload/{$type_dir}/{$id}/";
				$data["url_api_archivos"]			= "/api/files_upload/{$type_dir}/{$id}/";
				$data["url_form"]					= "/core_noodles/post/post.php?type={$type_dir}_edit&id={$id}";
				$data["content"]					= $content;
				$data["pagina_get"]					= "";
				$data["galeria_id"]					= $this -> galeria_id($type_dir, $id);
				$data["archivos_id"]				= $this -> archivos_id($type_dir, $id);

				$this -> theme_load("internals/generic", $data);
				break;

			case '':
				$type 					= "articulos";
				$type_dir 				= "articles";
				$titulo_tipo 			= "Artículos";
				$subtitulo_tipo 		= "Páginas";
				$palabra_tipo 			= "artículo";
				$titulo_tipo_interno 	= "Todos los artículos";
				$texto_tipo				= "Los artículos pertenecen a las páginas";

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$result = $this -> db
								-> order_by("id", "desc")
								-> get('articulos');
				$elementos = $result -> result_array();

				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["subtitulo_tipo"]				= $subtitulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["titulo_tipo_interno"]		= $titulo_tipo_interno;
				$data["paginas"]					= $paginas;
				$data["elementos"]					= $elementos;
				$data["texto_tipo"]					= $texto_tipo;

				$this -> theme_load("internals/generic_list", $data);
				break;

			case 'por-pagina':
				$type 					= "articulos";
				$type_dir 				= "articles";
				$titulo_tipo 			= "Artículos";
				$subtitulo_tipo 		= "Artículos";
				$palabra_tipo 			= "artículo";
				$titulo_tipo_interno 	= "Todos los artículos";
				$texto_tipo				= "Los artículos pertenecen a las páginas";

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> get('paginas');
				$paginas = $result -> result_array();

				$result = $this -> db
								-> order_by("titulo", "asc")
								-> where("id = {$id}")
								-> get('paginas');
				$pagina = $result -> row_array();

				$result = $this -> db
								-> order_by("id", "desc")
								-> where("pagina = {$id}")
								-> get('articulos');
				$elementos = $result -> result_array();

				$data["id"]							= $id;
				$data["type"]						= $type;
				$data["type_dir"]					= $type_dir;
				$data["titulo_tipo"]				= $titulo_tipo;
				$data["subtitulo_tipo"]				= $titulo_tipo;
				$data["palabra_tipo"]				= $palabra_tipo;
				$data["titulo_tipo_interno"]		= $titulo_tipo . " de " . $pagina["titulo"];
				$data["paginas"]					= $paginas;
				$data["pagina"]						= $pagina;
				$data["elementos"]					= $elementos;
				$data["texto_tipo"]					= $texto_tipo;

				$this -> theme_load("internals/generic_list", $data);
				break;

			default:
				$this -> theme_load('internals/articles');
				break;
		}
	}

	public function menu($seccion="", $id=""){
		switch($seccion){
			case "":
				$type 				= "menu";
				$titulo_tipo		= "menú";

				$result 	= $this -> db
									-> order_by("titulo", "asc")
									-> get('paginas');
				$paginas 	= $result -> result_array();

				$result 	= $this -> db
									-> order_by("titulo", "asc")
									-> get('articulos');
				$articulos 	= $result -> result_array();

				$result = $this 	-> db
									-> order_by("orden", "asc")
									-> get('menu');

				$menu_items = $result -> result_array();

				$data["type"]			= $type;
				$data["titulo_tipo"]	= $titulo_tipo;
				$data["paginas"]		= $paginas;
				$data["articulos"]		= $articulos;
				$data["menu_items"]		= $menu_items;

				$this -> theme_load('menu_editor', $data);
				break;

			case 'submenu':
				$type 				= "submenu";
				$titulo_tipo		= "submenú";

				$result 	= $this -> db
									-> order_by("titulo", "asc")
									-> get('paginas');
				$paginas 	= $result -> result_array();

				$result 	= $this -> db
									-> order_by("titulo", "asc")
									-> get('articulos');
				$articulos 	= $result -> result_array();

				$result = $this 	-> db
									-> where("id = {$id}")
									-> get('menu');

				$menu_principal 	= $result -> row_array();

				$result = $this 	-> db
									-> order_by("orden", "asc")
									-> where("menu = {$id}")
									-> get('submenu');

				$menu_items = $result -> result_array();

				$data["id"]				= $id;
				$data["type"]			= $type;
				$data["titulo_tipo"]	= $titulo_tipo;
				$data["paginas"]		= $paginas;
				$data["articulos"]		= $articulos;
				$data["menu_principal"]	= $menu_principal;
				$data["menu_items"]		= $menu_items;

				$this -> theme_load('menu_editor', $data);
				break;

			default:
				$this -> load -> view('errors/noaccess'); //OJO
				break;
		}
	}

	public function banners($seccion="", $id=""){
		$result 	= $this -> db
							-> order_by("titulo", "asc")
							-> get('paginas');
		$paginas 	= $result -> result_array();

		$result 	= $this -> db
							-> order_by("titulo", "asc")
							-> get('articulos');
		$articulos 	= $result -> result_array();

		$result = $this 	-> db
							-> order_by("orden", "asc")
							-> get('banners');

		$banners = $result -> result_array();

		$data["paginas"]		= $paginas;
		$data["articulos"]		= $articulos;
		$data["banners"]		= $banners;

		$this -> theme_load('banners', $data);
	}

	public function links($seccion="", $id=""){
		$result 	= $this -> db
							-> order_by("titulo", "asc")
							-> get('paginas');
		$paginas 	= $result -> result_array();

		$result 	= $this -> db
							-> order_by("titulo", "asc")
							-> get('articulos');
		$articulos 	= $result -> result_array();

		$result = $this 	-> db
							-> order_by("orden", "asc")
							-> get('links');

		$links = $result -> result_array();

		$data["paginas"]		= $paginas;
		$data["articulos"]		= $articulos;
		$data["links"]			= $links;

		$this -> theme_load('links', $data);
	}

	public function polls($seccion="", $id=""){
		switch($seccion){
			case "":
				$this -> theme_load('polls/polls');
				break;

			case 'nueva':
				$this -> theme_load('polls/new');
				$this -> load -> view('administrator/polls/new');
				break;

			case 'editar':
				$result = $this -> db
								-> where("id='" . $id ."'")
								-> get('polls');

				$polls = $result -> row_array();

				$result = $this -> db
								-> where("poll='" . $id ."'")
								-> get('polls_opciones');

				$polls_opciones = $result -> result_array();

				$polls["opciones"] = $polls_opciones;

				$this -> theme_load('polls/edit', $polls);//ojo
				break;

			default:
				$this -> load -> view('errors/noaccess');//ojo
				break;
		}
	}

	public function calendario($seccion="", $id=""){
		switch($seccion){
			case 'nuevo':
				$this -> theme_load('calendario/new');
				break;
				/* Falta terminar*/
		}
	}

	public function theme_load($view, $data = NULL){
		$this -> load -> view('../../core_noodles/views/head');

		$this -> permite($_SESSION["tipo_usuario"], $_SERVER['REQUEST_URI']);

		$data_menu["permisos"] = $this -> permisos();

    	$this -> load -> view('../../core_noodles/views/menu', $data_menu);
		$this -> load -> view('../../core_noodles/views/' . $view, $data);
		$this -> load -> view('../../core_noodles/views/footer');
	}

	public function permite($tipo_usuario, $pagina){
		$pagina 	= str_replace("/", "", $pagina);

		$permisos = $this -> permisos();

		if(is_numeric(array_search($pagina, $permisos[$tipo_usuario]))){
			//var_dump($permisos[$tipo_usuario]);
			echo "No tienes permiso";
			exit();
		}
	}

	public function permisos(){
		$tipo["1"] 	= 	array();
		$tipo["2"] 	= 	array(
						"adminconfiguracion",
						"adminenlaces_rapidos",
						"adminusuarios"
					);

		$tipo["3"]	= 	array(
						"adminconfiguracion",
						"adminenlaces_rapidos",
						"adminusuarios",
						"adminmenu",
						"adminlinks",
						"adminbanners",
						"adminpolls"
					);

		$tipo["4"]	= 	array(
						"adminconfiguracion",
						"adminenlaces_rapidos",
						"adminusuarios",
						"adminmenu",
						"adminlinks",
						"adminbanners",
						"adminpolls",
						"adminarticulosnuevo"
					);

		return $tipo;
	}

	public function limpiar_tmp($path){
        if(file_exists($path . "/")){
            $handle = opendir($path . "/");
            while ($file = readdir($handle)){
                if(is_file($path . "/" . $file)){
                    unlink($path . "/" . $file);
                }
            }
        }else{
            mkdir($path, 777);
        }
    }

	/*articulos y paginas*/
	public function galeria($type){
		$html = "";
		$carpeta =  "uploads/{$type}/";

		if($dir = opendir($carpeta)){
			while(($archivo = readdir($dir)) !== false){
				$archivo_sin_extension = trim($archivo, ".jpg");
				if(!strpos($archivo_sin_extension, "_")){
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != 'index.php'){
						$html .= "
						<div class=\"img-wrap imagen\" id-image=\"{$archivo_sin_extension}\">
							<img src=\"/uploads/{$type}/{$archivo_sin_extension}_168_168_90.jpg\">
						</div>";
					}
				}
			}
			closedir($dir);
		}
		return $html;
	}

	public function galeria_id($type, $id){
		$html = "";
		$carpeta =  "uploads/galeries/{$type}/" . $id;

		if(file_exists($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					$archivo_sin_extension = trim($archivo, ".jpg");
					if(!strpos($archivo_sin_extension, "_")){
						if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != 'index.php'){
							$html .= "
							<div class=\"img-wrap imagen\" id-image=\"{$archivo_sin_extension}\">
								<span class=\"close button tiny close\"><i class=\"fi-x\"></i></span>
								<img src=\"/uploads/galeries/{$type}/{$id}/{$archivo_sin_extension}.jpg\">
							</div>";
						}
					}
				}
				closedir($dir);
			}
		}

		return $html;
	}

	public function archivos_id($type, $id){
		$html = "";
		$carpeta =  "uploads/archivos/{$type}/" . $id;

		if(is_dir($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
						$html .= "
						<div class=\"file-wrap\" id-file=\"{$archivo}\">
							<div class=\"large-10 column\"><i class=\"fi-page\"></i> {$archivo}</div>
							<div class=\"large-2 column text-right\"><span class=\"close button tiny\"><i class=\"fi-x\"></i></span></div>
						</div>";
					}
				}
			}
			closedir($dir);
		}
		return $html;
	}
}
