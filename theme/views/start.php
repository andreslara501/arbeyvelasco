<!DOCTYPE html>
<html lang="es">
<head>
<title><?php echo $etiquetas["titulo"];?></title>
<meta charset="utf-8" />
<meta name="description" content="Alcaldía de Páez, Candidato - Cauca - Belalcázar, Indígena honesto 2020 - 2023 ">
<link rel="stylesheet" href="/theme/css/basic.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="shortcut icon" type="image/png" href="/theme/img/favicon.png"/>
</head>
 
<body>
<header>
	<div class="container-fluid">
		<div class="row" id="menu">
			<?php
			foreach ($menus as $menu)
			{
				echo "
					<div class=\"col-2\" style=\"display: table; height: 50px;\">
						<a href=\"" . $menu -> enlace . "\" style=\"display: table-cell; vertical-align: middle;\">
							" . $menu -> descripcion . "
						</a>
					</div>
				";
			}
			?>
		</div>
	</div>
</header>

<div class="container-fluid">
	<?php
		if(isset($banner_principal)){
			?>
				<img src="/theme/img/header.jpg" style="width: 100%">
			<?php
		}else{
			?>
				<img src="/theme/img/interna.jpg" style="width: 100%">
			<?php
		}
	?>
</div>
