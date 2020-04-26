<?php
// Si son demasiados archivos colocamos el tiempo limite en 0 (sin limite)
set_time_limit(0);
/*
 @autor : Arthusu
 @fecha : 15/03/2015
 @descripcion : Compresor de todos los archivos del directorio
 @archivo : compresor.php
*/

// definimos las variables (las podemos modificar segun sea nuestro caso)
$nombre_del_archivo_comprimido = "tmp.zip"; // el nombre del archivo a generar
$ruta_relativa = "../../uploads/"; // el directorio que nos encontremos. Ejemplo: images/algo/ para generar un link correcto
$dir = "../../uploads/";

unlink($nombre_del_archivo_comprimido);

if(phpversion() >= "5.2.0"){ // verificamos que contengan la version correcta para crear archivos zip
	$zip = new ZipArchive(); // Creamos un nuevo objeto
	if($zip -> open($nombre_del_archivo_comprimido,ZIPARCHIVE::CREATE) === TRUE){ // creamos un archivo
  		$iterator = new RecursiveDirectoryIterator($dir); // recorremos el directorio
  		$recursiveIterator = new RecursiveIteratorIterator($iterator); // recorremos los directorios dentro de otros directorios y asi sucesivamente
  		foreach($recursiveIterator as $entry){ // recorremos los archivos
			if(is_file($entry -> getRealPath())){ // verificamos que sea archivo
	 		// debug
	 		//echo $entry -> getRealPath()."\n";
			$zip -> addFile($entry -> getRealPath(), $recursiveIterator -> getSubPathname()); // lo agregamos al zip
	   		}
  		}
	}else{
	  	echo "Ha ocurrido un error: " . $zip -> getStatusString();
	}

	$zip -> close();
	header("Content-disposition: attachment; filename=uploads" . date('ymd-his') . ".zip");
	header('Content-type: application/zip');
	readfile($nombre_del_archivo_comprimido);
}else{
	echo "Su version de PHP debe ser 5.2.0 o superior";
}
?>
