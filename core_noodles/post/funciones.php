<?php
	class Post extends config{
		public $type;
		public $type_dir;
		public $imagen_principal;
		public $imagen_principal_galeria;
		public $conn;

	    public $fecha;
		public $titulo;
		public $descripcion;
		public $texto;
		public $alias;
		public $youtube;
		public $soundcloud;

		public $id;

		public function __construct($_POSTS, $imagen_principal = NULL, $imagen_principal_galeria = NULL, $type){
			$this -> type = $type;

			switch($this -> type){
				case 'articulos':
					$this -> type_dir = "articles";
					break;

				case 'paginas':
					$this -> type_dir = "pages";
					break;
			}

			$this -> configuration();
			$this -> sql_connect();

			if($_POSTS != NULL){
				$this -> load_variables($_POSTS, $imagen_principal, $imagen_principal_galeria, $type);
			}
	 	}

		function __destruct() {
	        $this -> conn -> close();
	    }

		function load_variables($_POSTS, $imagen_principal, $imagen_principal_galeria, $type){
			$this -> imagen_principal = $imagen_principal;
			$this -> imagen_principal_galeria = $imagen_principal_galeria;

			$this -> fecha 			= date('Y-m-d');
			if(isset($_POSTS["pagina"])){
				$this -> pagina 		= $this -> clear($_POSTS["pagina"]);
			}
			$this -> titulo 		= $this -> clear($_POSTS["titulo"]);
			$this -> titulo_simple	= $this -> clear_caracteres_simple($_POSTS["titulo"]);
			$this -> descripcion 	= $this -> clear($_POSTS["descripcion"]);
			$this -> texto 			= $this -> clear($_POSTS["texto"]);
			$this -> alias 			= $this -> clear_caracteres($_POSTS["titulo"]);
			$this -> youtube 		= $this -> clear($_POSTS["youtube"]);
			$this -> soundcloud 	= $this -> clear($_POSTS["soundcloud"]);
		}

		function sql_connect(){
			$this -> conn = new mysqli($this -> servername, $this -> username, $this -> password, $this -> dbname);
			if($this -> conn -> connect_error){
				die("Connection failed: " . $this -> conn -> connect_error);
			}
		}

		function insert(){
			if(isset($this -> pagina)){
				$sql = "SELECT * FROM paginas WHERE id = {$this -> pagina}";
				$result = $this -> conn -> query($sql);
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        $pagina_alias = $row["alias"];
				    }
				} else {
				    echo "0 results";
				}
			}


			$sql = "INSERT INTO {$this -> type}
			(
				fecha,";
				if(isset($this -> pagina)){
					$sql .= "pagina,";
				}
				$sql .= "
				titulo,
				descripcion,
				texto,
				alias,
				youtube,
				soundcloud
			)
			VALUES
			(
				'{$this -> fecha}',";
				if(isset($this -> pagina)){
					$sql .= "'{$this -> pagina}',";
				}
				$sql .= "
				'{$this -> titulo}',
				'{$this -> descripcion}',
				'{$this -> texto}',
				'{$this -> alias}',
				'{$this -> youtube}',
				'{$this -> soundcloud}'
			)";

			if ($this -> conn -> query($sql) === TRUE) {
				if(isset($this -> pagina)){
					echo json_encode(array(
											"respuesta" 		=> $_SESSION['configuracion'][0]["valor"] . $pagina_alias . "/" . $this -> alias . "/",
											"respuesta_twitter" => $this -> clear_caracteres_simple($this -> titulo_simple) .  $_SESSION['configuracion'][0]["valor"] . $pagina_alias . "/" . $this -> alias . "/"), JSON_UNESCAPED_SLASHES);
				}else{
					echo json_encode(array(
											"respuesta" 		=> $_SESSION['configuracion'][0]["valor"] . $this -> alias . "/",
											"respuesta_twitter" => $this -> clear_caracteres_simple($this -> titulo_simple) . $_SESSION['configuracion'][0]["valor"] . $this -> alias . "/"), JSON_UNESCAPED_SLASHES);
				}
				$this -> id = preg_replace('/[^0-9]+/', '', $this -> conn -> insert_id);
			} else {
				echo "Error: " . $sql . "<br>" . $this -> conn -> error;
			}

			$this -> upload_imagen_principal();
			$this -> upload_imagen_principal_galeria();

			$this -> crear_album();

			$this -> clear_tmp("tmps/");
			$this -> clear_tmp("archivos/tmps/");
		}

		function edit($id){
			$this -> id = $id;
			if(isset($this -> pagina)){
				$sql = "SELECT * FROM paginas WHERE id = {$this -> pagina}";
				$result = $this -> conn -> query($sql);
				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        $pagina_alias = $row["alias"];
				    }
				} else {
				    echo "0 results";
				}
			}

			$sql = "UPDATE {$this -> type}
			SET
				fecha = '{$this -> fecha}',";
				if(isset($this -> pagina)){
					$sql .= "pagina = '{$this -> pagina}',";
				}
				$sql .= "
				titulo = '{$this -> titulo}',
				descripcion = '{$this -> descripcion}',
				texto = '{$this -> texto}',
				alias = '{$this -> alias}',
				youtube = '{$this -> youtube}',
				soundcloud = '{$this -> soundcloud}'
			WHERE
				id = {$id}
			";

			if ($this -> conn -> query($sql) === TRUE) {
				if(isset($this -> pagina)){
					echo json_encode(array(
											"respuesta" 		=> $_SESSION['configuracion'][0]["valor"] . $pagina_alias . "/" . $this -> alias . "/",
											"respuesta_twitter" => $this -> clear_caracteres_simple($this -> titulo_simple) .  $_SESSION['configuracion'][0]["valor"] . $pagina_alias . "/" . $this -> alias . "/"), JSON_UNESCAPED_SLASHES);
				}else{
					echo json_encode(array(
											"respuesta" 		=> $_SESSION['configuracion'][0]["valor"] . $this -> alias . "/",
											"respuesta_twitter" => $this -> clear_caracteres_simple($this -> titulo_simple) . $_SESSION['configuracion'][0]["valor"] . $this -> alias . "/"), JSON_UNESCAPED_SLASHES);
				}
			} else {
				echo "Error: " . $sql . "<br>" . $this -> conn -> error;
			}

			$this -> upload_imagen_principal();
			$this -> upload_imagen_principal_galeria();

			$this -> crear_album();

			$this -> clear_tmp("tmps/");
			$this -> clear_tmp("archivos/tmps/");

			$this -> limpiar_tmp_img($this -> type_dir, $id);
		}

		function delete($id){
			if($this -> type == "paginas"){
				$sql = "DELETE FROM articulos
				WHERE
					pagina = {$id}
				";

				if ($this -> conn -> query($sql) === TRUE) {
					$this -> id = preg_replace('/[^0-9]+/', '', $id);
				} else {
					echo "Error: {$sql}<br>" . $this -> conn -> error;
				}
			}


			$sql = "DELETE FROM {$this -> type}
			WHERE
				id = {$id}
			";

			if ($this -> conn -> query($sql) === TRUE) {
				echo json_encode(array("respuesta" => $id));
				$this -> id = preg_replace('/[^0-9]+/', '', $id);
			} else {
				echo "Error: {$sql}<br>" . $this -> conn -> error;
			}

			$this -> limpiar_tmp_img($this -> type_dir, $id);

			$targetPath = "../../uploads/{$this -> type_dir}/{$id}.jpg";
			if(file_exists($targetPath)){
				unlink($targetPath);
			}

			$dir = "../../uploads/galeries/{$this -> type_dir}/{$id}/";
			$this -> eliminar_directorio($dir);

			$dir = "../../uploads/archivos/{$this -> type_dir}/{$id}/";
			$this -> eliminar_directorio($dir);
		}

		function upload_imagen_principal(){	
			if(!empty($this -> imagen_principal['file']["name"])){
				$archivo = pathinfo($this -> imagen_principal['file']["name"]);

				$tempFile = $this -> imagen_principal['file']['tmp_name'];
				$targetPath = "../../uploads/{$this -> type_dir}/{$this -> id}.jpg";

				if(strtolower($archivo['extension'])=="png"){
					// Creamos PNG temporal
					$targetPath_png = "../../uploads/{$this -> type_dir}/tmp.png";
					move_uploaded_file($tempFile, $targetPath_png);

					// Abrimos una Imagen PNG
					$imagen = imagecreatefrompng($targetPath_png);

					imagejpeg($imagen, $targetPath, 100);
					unlink($targetPath_png);
				}else{
					move_uploaded_file($tempFile, $targetPath);
				}

				/* actualizar image bd */
				$sql = "UPDATE {$this -> type} SET image = 1 WHERE id = {$this -> id}";
				$this -> conn -> query($sql);
			}
		}

		function upload_imagen_principal_galeria(){
			if(!empty($this -> imagen_principal_galeria)){
				$viejo = "../../uploads/{$this -> type_dir}/{$this -> imagen_principal_galeria}.jpg";
				$nuevo = "../../uploads/{$this -> type_dir}/{$this -> id}.jpg";

				if(!copy($viejo, $nuevo)){
				    echo "failed to copy by galerie...\n";
				}

				$sql = "UPDATE {$this -> type} SET image = 1 WHERE id = {$this -> id}";
				$this -> conn -> query($sql);
			}
		}

		function crear_album(){
			$this -> full_copy("../../uploads/tmps/", 			"../../uploads/galeries/{$this -> type_dir}/{$this -> id}");
			$this -> full_copy("../../uploads/archivos/tmps/", 	"../../uploads/archivos/{$this -> type_dir}/{$this -> id}");
		}

		function full_copy($source, $target){
			if(is_dir($source)){
				if(!file_exists($target)){
					mkdir($target);
				}
				$d = dir($source);
				while(FALSE !== ($entry = $d -> read())){
					if ($entry == '.' || $entry == '..'){
						continue;
					}
					$Entry = $source . '/' . $entry;
					if(is_dir($Entry)){
						full_copy($Entry, $target . '/' . $entry);
						continue;
					}
					copy($Entry, $target . '/' . $entry);
				}

				$d -> close();
			}else{
				copy($source, $target);
			}
		}

		function clear_tmp($dir){
			$handle = opendir("../../uploads/" . $dir);
			while ($file = readdir($handle)){
				if(is_file("../../uploads/" . $dir . $file)){
					unlink("../../uploads/" . $dir . $file);
				}
			}
		}

	    function clear($html){
			$html = htmlentities($html, ENT_COMPAT, 'UTF-8');
			$html = str_replace("'" , "\"" , $html);
	        return $html;
	    }

		public function limpiar_tmp_img($type, $id){
			foreach(glob("../../uploads/{$type}/{$id}_*.jpg") AS $file_image){
				unlink($file_image);
			}
		}

		public function eliminar_directorio($dir){
			if(file_exists($dir)){
				foreach(glob($dir . "*") AS $file_image){
					unlink($file_image);
				}
				rmdir($dir);
			}
		}

		public function clear_caracteres($string){
			$string = trim($string);

		    $string = str_replace(
		         array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		         array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		         $string
		    );

		     $string = str_replace(
		         array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		         array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		         $string
		     );

		     $string = str_replace(
		         array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		         array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		         $string
		     );

		     $string = str_replace(
		         array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		         array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		         $string
		     );

		     $string = str_replace(
		         array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		         array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		         $string
		     );

		     $string = str_replace(
		         array('ñ', 'Ñ', 'ç', 'Ç'),
		         array('n', 'N', 'c', 'C',),
		         $string
		     );

		     //Esta parte se encarga de eliminar cualquier caracter extraño
		     $string = str_replace(
		         array("¨", "º", '-', '~',
		              '#', '@', '|', '!', '"',
					  "«", "»",
		              "·", "$", "%", "&", "/",
		              "(", ")", "?", "'", "¡",
		              "¿", "[", "^", "<code>", "]",
		              "+", "}", "{", "¨", "´",
		              ">", "< ", ";", ",", ":",
		              "."),
		         '',
		         $string
		     );

			$string_explode = explode("/", $string);
			foreach ($string_explode as &$tmp_explode){
				$tmp_explode = filter_var($tmp_explode, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
				$tmp_explode = htmlentities($tmp_explode);
				$tmp_explode = str_replace(" ", "-", $tmp_explode);
				$tmp_explode = preg_replace('/[^a-z0-9-\.]/', '', strtolower($tmp_explode));
			}

			return implode("/", $string_explode);
		}


		public function clear_caracteres_simple($string){
			$string = trim($string);

		    $string = str_replace(
		         array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		         array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		         $string
		    );

		     $string = str_replace(
		         array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		         array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		         $string
		     );

		     $string = str_replace(
		         array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		         array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		         $string
		     );

		     $string = str_replace(
		         array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		         array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		         $string
		     );

		     $string = str_replace(
		         array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		         array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		         $string
		     );

		     $string = str_replace(
		         array('ñ', 'Ñ', 'ç', 'Ç'),
		         array('n', 'N', 'c', 'C',),
		         $string
		     );

		     //Esta parte se encarga de eliminar cualquier caracter extraño
		     $string = str_replace(
		         array("¨", "º", '-', '~',
		              '#', '@', '|', '!', '"',
					  "«", "»",
		              "·", "$", "%", "&", "/",
		              "(", ")", "?", "'", "¡",
		              "¿", "[", "^", "<code>", "]",
		              "+", "}", "{", "¨", "´",
		              ">", "< ", ";", ",", ":",
		              "."),
		         '',
		         $string
		     );

			return $string;
		}
	}
?>
