<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Api extends CI_Controller{
	public function index(){
		echo "hola ;)";
	}

	public function configuracion(){
		$data = $this -> input -> post();
		$this -> load -> model("configuracion");
		$this -> configuracion -> update("dominio", $data["dominio"]);
		$this -> configuracion -> update("titulo", $data["titulo"]);
		$this -> configuracion -> update("correo_contacto", $data["correo_contacto"]);
		$this -> configuracion -> update("descripcion_sitio", $data["descripcion_sitio"]);
		$this -> configuracion -> update("meta_normal", $data["meta_normal"]);
		$this -> configuracion -> update("google", $data["google"]);

		echo json_encode(array("respuesta" => "guardado"));
	}

	public function usuarios($tipo, $id = 0){
		/*switch($seccion){
			case 'nueva':*/
		switch ($tipo) {
			case 'editar':
					$data = $this -> input -> post();
					$this -> load -> model("usuarios");
					$this -> usuarios -> update($data, $id);

					echo json_encode(array("respuesta" => "guardado"));
				break;

			case 'nuevo':
					$data = $this -> input -> post();
					$this -> load -> model("usuarios");

					echo json_encode(array("respuesta" => $this -> usuarios -> new_user($data)));
				break;
			case 'eliminar':
					$this -> load -> model("usuarios");
					$this -> usuarios -> delete($id);

					echo json_encode(array("respuesta" => "eliminado"));
				break;
		}
	}

	public function enlaces_rapidos(){
		$data = $this -> input -> post();
		$this -> load -> model("configuracion");
		$this -> configuracion -> update("enlace_1", $data["enlace_1"]);
		$this -> configuracion -> update("enlace_nombre_1", $data["enlace_nombre_1"]);
		$this -> configuracion -> update("enlace_2", $data["enlace_2"]);
		$this -> configuracion -> update("enlace_nombre_2", $data["enlace_nombre_2"]);
		$this -> configuracion -> update("enlace_3", $data["enlace_3"]);
		$this -> configuracion -> update("enlace_nombre_3", $data["enlace_nombre_3"]);
		$this -> configuracion -> update("enlace_4", $data["enlace_4"]);
		$this -> configuracion -> update("enlace_nombre_4", $data["enlace_nombre_4"]);
		$this -> configuracion -> update("enlace_5", $data["enlace_5"]);
		$this -> configuracion -> update("enlace_nombre_5", $data["enlace_nombre_5"]);
		$this -> configuracion -> update("enlace_6", $data["enlace_6"]);
		$this -> configuracion -> update("enlace_nombre_6", $data["enlace_nombre_6"]);
		$this -> configuracion -> update("enlace_7", $data["enlace_7"]);
		$this -> configuracion -> update("enlace_nombre_7", $data["enlace_nombre_7"]);
		$this -> configuracion -> update("enlace_8", $data["enlace_8"]);
		$this -> configuracion -> update("enlace_nombre_8", $data["enlace_nombre_8"]);
		$this -> configuracion -> update("enlace_9", $data["enlace_9"]);
		$this -> configuracion -> update("enlace_nombre_9", $data["enlace_nombre_9"]);
		$this -> configuracion -> update("enlace_10", $data["enlace_10"]);
		$this -> configuracion -> update("enlace_nombre_10", $data["enlace_nombre_10"]);

		echo json_encode(array("respuesta" => "guardado"));
	}

	public function eliminar_foto($tipo, $id){
		/* actualizar image bd */
		$data["image"] = 0;
		if($tipo == "pages"){
			$this -> load -> model("paginas");
			$this -> paginas -> update($data, $id);
		}else{
			$this -> load -> model("articulos");
			$this -> articulos -> update($data, $id);
		}
		/* fin actualizar image bd */

		$targetPath = dirname( __FILE__ ). "/../../uploads/" . $tipo . "/" . $id . ".jpg";
		unlink($targetPath);

		$targetPath = dirname( __FILE__ ). "/../../uploads/" . $tipo . "/" . $id . "_*";
		array_map('unlink', glob($targetPath));
	}

	public function menu($seccion = "", $type = "", $id = ""){
		switch($seccion){
			case 'editar':
				$data 		= $this -> input -> post();
				$data["type"] 	= $type;

				$this -> load -> model("menu");
				$this -> menu -> editar($data, $id);

				echo json_encode(array("respuesta" => "editado"));

				break;

			case 'nuevo':
				$data 			= $this -> input -> post();
				$data["type"] 	= $type;

				$this -> load -> model("menu");
				$id_pagina = $this -> menu -> set($data);

				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);

				break;

			case 'reorganizar':
				$data 			= $this -> input -> post();
				$data["type"] 	= $type;

				$this -> load -> model("menu");
				$id_pagina = $this -> menu -> reorganizar($data);

				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);
				break;

			case 'eliminar':
				$this -> load -> model("menu");
				$this -> menu -> eliminar($id, $type);

				echo json_encode(array("respuesta" => $id));
				break;
		}
	}

	public function banners($seccion="", $id=""){
		switch($seccion){
			case 'editar':
				$data = $this -> input -> post();

				$this -> load -> model("banners");
				$this -> banners -> editar($data, $id);

				/* upload archivos */
				if (!empty($_FILES['file']["name"])){
					$archivo = pathinfo($_FILES['file']["name"]);

					$tempFile = $_FILES['file']['tmp_name'];

					$targetPath = dirname( __FILE__ ). "/../../uploads/banners/" . $id . ".jpg";

					if(strtolower($archivo['extension'])=="png"){
						// Creamos PNG temporal
						$targetPath_png = dirname( __FILE__ ) . "/../../uploads/banners/tmp.png";
			    		move_uploaded_file($tempFile, $targetPath_png);

						// Abrimos una Imagen PNG
						$imagen = imagecreatefrompng($targetPath_png);

						imagejpeg($imagen, $targetPath, 100);
						unlink($targetPath_png);
					}else{
			    		move_uploaded_file($tempFile, $targetPath);
					}

					/* actualizar image bd */
					$data["image"] = 1;
					$this -> load -> model("banners");
					$this -> banners -> editar($data, $id);
				}

				echo json_encode(array("respuesta" => "editado"));

				break;

			case 'nuevo':
				//Obteniendo datos de POST
				$data = $this -> input -> post();

				//Cargando modelo
				$this -> load -> model("banners");
				$id_pagina = $this -> banners -> set($data);

				/* Devolviendo id de página*/
				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);

				/* upload archivos */
				if (!empty($_FILES['file']["name"])){
					$archivo = pathinfo($_FILES['file']["name"]);

					$tempFile = $_FILES['file']['tmp_name'];
				    //$targetPath = dirname( __FILE__ ). "/../../uploads/articles/" . $id . "." . $archivo['extension'];

					$targetPath = dirname( __FILE__ ). "/../../uploads/banners/" . $id . ".jpg";

					if(strtolower($archivo['extension'])=="png"){
						// Creamos PNG temporal
						$targetPath_png = dirname( __FILE__ ) . "/../../uploads/banners/tmp.png";
			    		move_uploaded_file($tempFile, $targetPath_png);

						// Abrimos una Imagen PNG
						$imagen = imagecreatefrompng($targetPath_png);

						imagejpeg($imagen, $targetPath, 100);
						unlink($targetPath_png);
					}else{
			    		move_uploaded_file($tempFile, $targetPath);
					}

					/* actualizar image bd */
					$data["image"] = 1;
					$this -> load -> model("banners");
					$this -> banners -> editar($data, $id);
				}

				break;

			case 'reorganizar':
				$data = $this -> input -> post();

				$this -> load -> model("banners");
				$id_pagina = $this -> banners -> reorganizar($data);

				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);
				break;

			case 'eliminar':
				$result = $this -> db
			                    -> where("id='" . $id ."'")
			                    -> get('banners');

			    $banner = $result -> row_array();

				if($banner["image"]){
					$targetPath = dirname( __FILE__ ). "/../../uploads/banners/" . $id . ".jpg";
					unlink($targetPath);
				}

				$this -> load -> model("banners");
				$this -> banners -> eliminar($id);

				echo json_encode(array("respuesta" => $id));
				break;
		}
	}

	public function links($seccion="", $id=""){
		switch($seccion){
			case 'editar':
				$data = $this -> input -> post();

				$this -> load -> model("links");
				$this -> links -> editar($data, $id);

				/* upload archivos */
				if (!empty($_FILES['file']["name"])){
					$archivo = pathinfo($_FILES['file']["name"]);

					$tempFile = $_FILES['file']['tmp_name'];
				    //$targetPath = dirname( __FILE__ ). "/../../uploads/articles/" . $id . "." . $archivo['extension'];

					$targetPath = dirname( __FILE__ ). "/../../uploads/links/" . $id . ".jpg";

					if(strtolower($archivo['extension'])=="png"){
						// Creamos PNG temporal
						$targetPath_png = dirname( __FILE__ ) . "/../../uploads/links/tmp.png";
			    		move_uploaded_file($tempFile, $targetPath_png);

						// Abrimos una Imagen PNG
						$imagen = imagecreatefrompng($targetPath_png);

						imagejpeg($imagen, $targetPath, 100);
						unlink($targetPath_png);
					}else{
			    		move_uploaded_file($tempFile, $targetPath);
					}

					/* actualizar image bd */
					$data["image"] = 1;
					$this -> load -> model("links");
					$this -> links -> editar($data, $id);
				}

				echo json_encode(array("respuesta" => "editado"));

				break;

			case 'nuevo':
				//Obteniendo datos de POST
				$data = $this -> input -> post();

				//Cargando modelo
				$this -> load -> model("links");
				$id_pagina = $this -> links -> set($data);

				/* Devolviendo id de página*/
				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);

				/* upload archivos */
				if (!empty($_FILES['file']["name"])){
					$archivo = pathinfo($_FILES['file']["name"]);

					$tempFile = $_FILES['file']['tmp_name'];
				    //$targetPath = dirname( __FILE__ ). "/../../uploads/articles/" . $id . "." . $archivo['extension'];

					$targetPath = dirname( __FILE__ ). "/../../uploads/links/" . $id . ".jpg";

					if(strtolower($archivo['extension'])=="png"){
						// Creamos PNG temporal
						$targetPath_png = dirname( __FILE__ ) . "/../../uploads/links/tmp.png";
			    		move_uploaded_file($tempFile, $targetPath_png);

						// Abrimos una Imagen PNG
						$imagen = imagecreatefrompng($targetPath_png);

						imagejpeg($imagen, $targetPath, 100);
						unlink($targetPath_png);
					}else{
			    		move_uploaded_file($tempFile, $targetPath);
					}

					/* actualizar image bd */
					$data["image"] = 1;
					$this -> load -> model("links");
					$this -> links -> editar($data, $id);
				}

				break;

			case 'reorganizar':
				$data = $this -> input -> post();

				$this -> load -> model("links");
				$id_pagina = $this -> links -> reorganizar($data);

				echo json_encode(array("respuesta" => $id_pagina));
				$id = preg_replace('/[^0-9]+/', '', $id_pagina);
				break;

			case 'eliminar':
				$result = $this -> db
			                    -> where("id='" . $id ."'")
			                    -> get('links');

			    $banner = $result -> row_array();

				if($banner["image"]){
					$targetPath = dirname( __FILE__ ). "/../../uploads/links/" . $id . ".jpg";
					unlink($targetPath);
				}

				$this -> load -> model("links");
				$this -> links -> eliminar($id);

				echo json_encode(array("respuesta" => $id));
				break;
		}
	}

	public function polls($seccion="", $id=""){
		switch($seccion){
			case 'editar':
				$data = $this -> input -> post();

				$poll["descripcion"] = $data["descripcion"];

				$this -> load -> model("polls");
				$this -> polls -> editar($poll, $id);

				// Recorriendo respuestas
				for($i=1; $i<=5; $i++){
					$poll_opcion = array();
					$poll_opcion["respuesta"] = $data["r" . $i];

					$this -> load -> model("polls_opciones");
					$this -> polls_opciones -> editar($poll_opcion, $id, $i);
				}

				echo json_encode(array("respuesta" => "editado"));
				break;

			case 'nueva':
				//Obteniendo datos de POST
				$data = $this -> input -> post();
				$poll = array();
				$poll["fecha"] = date('Y-m-d');
				$poll["descripcion"] = $data["descripcion"];

				//Cargando modelo
				$this -> load -> model("polls");
				$id_poll = $this -> polls -> set($poll);


				// Recorriendo respuestas
				for($i=1; $i<=5; $i++){
					$poll_opcion = array();
					$poll_opcion["respuesta"] = $data["r" . $i];
					$poll_opcion["poll"] = $id_poll;
					$poll_opcion["orden"] = $i;

					$this -> load -> model("polls_opciones");
					$id_pagina = $this -> polls_opciones -> set($poll_opcion);
				}

				/* Devolviendo id de página*/
				echo json_encode(array("respuesta" => $id_poll));
				$id = preg_replace('/[^0-9]+/', '', $id_poll);
				break;

			case 'eliminar':
				$this -> load -> model("polls");
				$this -> polls -> eliminar($id);

				echo json_encode(array("respuesta" => $id));
				break;

			case 'publica':
				$this -> load -> model("polls");
				$this -> polls -> publica($id);

				echo json_encode(array("respuesta" => $id));
				break;
		}
	}

	public function galeries_upload($type = "", $elemento = 0){
		$i = 0;

		if($elemento == 0){
			$target_dir = dirname( __FILE__ ). "/../../uploads/tmps/";
			$target_dir_img = "/uploads/tmps/";
		}else{
			$target_dir = dirname( __FILE__ ). "/../../uploads/galeries/{$type}/{$elemento}";
			$target_dir_img = "/uploads/galeries/articles/{$elemento}/";
		}

		if(!file_exists($target_dir)){mkdir($target_dir, 0777);}

		foreach($_FILES['images']['name'] as $key => $val){
			$i++;
			$image_name = $_FILES['images']['name'][$key];
			$tmp_name 	= $_FILES['images']['tmp_name'][$key];
			$size 		= $_FILES['images']['size'][$key];
			$type 		= $_FILES['images']['type'][$key];
			$error 		= $_FILES['images']['error'][$key];

			$time = uniqid();
			$target_file = $target_dir . "/" .  $time . ".jpg";

			$archivo = pathinfo($_FILES['images']['name'][$key]);

			if(strtolower($archivo['extension'])=="png"){
				$imagen = imagecreatefrompng($_FILES['images']['tmp_name'][$key]);
				imagejpeg($imagen, $target_file, 100);
			}else{
				if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)){

				}
			}
		}

		if($dir = opendir($target_dir . "/")){
			while(($archivo = readdir($dir)) !== false){
				if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
					$archivo_sin_extension = trim($archivo, ".jpg");
					?>
					<div class="img-wrap imagen" id-image="<?php echo $archivo_sin_extension; ?>">
						<span class="close button tiny close"><i class="fi-x"></i></span>
						<img src="<?php echo $target_dir_img . $archivo; ?>" alt="">
					</div>
					<?php
				}
			}
			closedir($dir);
		}
	}

	public function galeries_delete($type = "", $elemento = 0, $id_image = ""){
		if($elemento == 0){
			$targetPath = dirname( __FILE__ ). "/../../uploads/tmps/{$id_image}.jpg";
		}else{
			$targetPath = dirname( __FILE__ ). "/../../uploads/galeries/{$type}/{$elemento}/{$id_image}.jpg";
		}

		unlink($targetPath);

		echo json_encode(array("respuesta" => $id_image));
	}


	public function files_upload($type = "", $elemento = 0){
		$i = 0;

		if($elemento == 0){
			$target_dir = dirname( __FILE__ ). "/../../uploads/archivos/tmps/";
			$target_dir_img = "/uploads/archivos/tmps/";
		}else{
			$target_dir = dirname( __FILE__ ). "/../../uploads/archivos/{$type}/{$elemento}/";
			$target_dir_img = "/uploads/archivos/{$type}/{$elemento}/";
		}

		if(!file_exists($target_dir)){
			mkdir($target_dir, 0777);
		}

		foreach($_FILES['files']['name'] as $key=>$val){
			$i++;
			$image_name = $_FILES['files']['name'][$key];
			$tmp_name 	= $_FILES['files']['tmp_name'][$key];
			$size 		= $_FILES['files']['size'][$key];
			$type 		= $_FILES['files']['type'][$key];
			$error 		= $_FILES['files']['error'][$key];

			$target_file = $target_dir . $_FILES['files']['name'][$key];

			if(!move_uploaded_file($_FILES['files']['tmp_name'][$key], $this -> clear_caracteres($target_file))){
				echo "no se pudo subir el archivo";
			}
		}

		$carpeta = $target_dir;

		if(is_dir($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
						?>
						<div class="file-wrap" id-file="<?php echo $archivo; ?>">
							<div class="large-10 column"><i class="fi-page"></i> <?php echo $archivo; ?> </div>
							<div class=" large-2 column text-right"><span class="close button tiny"><i class="fi-x"></i></span></div>
						</div>
						<?php
					}
				}
				closedir($dir);
			}
		}
	}

	public function files_delete($type = "", $elemento = 0, $archivo = ""){
		if($elemento == 0){
			$targetPath = dirname( __FILE__ ). "/../../uploads/archivos/tmps/{$archivo}";
		}else{
			$targetPath = dirname( __FILE__ ). "/../../uploads/archivos/{$type}/{$elemento}/{$archivo}";
		}

		unlink($targetPath);

		echo json_encode(array("respuesta" => $archivo));
	}

	public function clear_caracteres($string){
		$string_explode = explode("/", $string);
		foreach ($string_explode as &$tmp_explode){
			$tmp_explode = filter_var($tmp_explode, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$tmp_explode = htmlentities($tmp_explode);
			$tmp_explode = str_replace(" ", "_", $tmp_explode);
			$tmp_explode = preg_replace('/[^a-z0-9_\.]/', '', strtolower($tmp_explode));
		}

		return implode("/", $string_explode);
	}
}
?>
