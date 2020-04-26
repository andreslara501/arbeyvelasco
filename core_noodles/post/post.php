<?php
	session_start();

	include("../config.php");
	include("funciones.php");

	switch ($_GET["type"]) {
		case 'articles_new':
			$post = new Post($_POST, $_FILES, $_POST["upload_image_by_galerie"], "articulos");
			$post -> insert();
			break;

		case 'articles_edit':
			$post = new Post($_POST, $_FILES, $_POST["upload_image_by_galerie"], "articulos");
			$post -> edit($_GET["id"]);
			break;

		case 'articles_delete':
			$post = new Post(NULL, NULL, NULL, "articulos");
			$post -> delete($_GET["id"]);
			break;

		case 'pages_new':
			$post = new Post($_POST, $_FILES, $_POST["upload_image_by_galerie"], "paginas");
			$post -> insert();
			break;

		case 'pages_edit':
			$post = new Post($_POST, $_FILES, $_POST["upload_image_by_galerie"], "paginas");
			$post -> edit($_GET["id"]);
			break;

		case 'pages_delete':
			$post = new Post("","","", "paginas");
			$post -> delete($_GET["id"]);
			break;

		default:
			# code...
			break;
	}
?>
