<?php
function resizeImagen($ruta, $ancho, $alto, $calidad){
    $alto_original = $alto;
    $ancho_original = $ancho;

    $partes_ruta = pathinfo($ruta);

    $extension = $partes_ruta['extension'];

    if($extension == 'GIF' || $extension == 'gif'){
        $img_original = imagecreatefromgif($ruta);
        header('Content-Type: image/gif');
    }
    if($extension == 'jpg' || $extension == 'JPG' || $extension == 'JPEG'){
        $img_original = imagecreatefromjpeg($ruta);
        header('Content-Type: image/jpeg');
    }
    if($extension == 'png' || $extension == 'PNG'){
        $img_original = imagecreatefrompng($ruta);
        header('Content-Type: image/png');
    }

    $max_ancho = $ancho;
    $max_alto = $alto;

    list($ancho, $alto) = getimagesize($ruta);

    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;

    if(($ancho <= $max_ancho) && ($alto <= $max_alto)){
  	    $ancho_final = $ancho;
		$alto_final = $alto;
	}elseif(($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	}else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}

    $tmp = imagecreatetruecolor($ancho_final,$alto_final);

    imagecopyresampled($tmp,$img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
    imagedestroy($img_original);

    imagejpeg($tmp, NULL, $calidad);

    $ruta = $imagen = str_replace(".jpg", "", $ruta);
    imagejpeg($tmp, $ruta . "_" . $ancho_original . "_" . $alto_original . "_" . $calidad . ".jpg", $calidad);
}

$imagen = $_GET["imagen"] . ".jpg";
$ancho = $_GET["ancho"];
$alto = $_GET["alto"];
$calidad = $_GET["calidad"];

resizeImagen($imagen, $ancho, $alto, $calidad);

?>
