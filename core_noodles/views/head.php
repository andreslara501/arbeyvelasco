<?php
    session_start();
    $result = $this -> db
                    -> get('configuracion');

    $_SESSION['configuracion'] = $result -> result_array();
?>

<!doctype html>
<!-- head -->
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Administrador - <?php echo $_SESSION['configuracion'][1]["valor"];?></title>
    <link rel="icon" type="image/png" href="/core_noodles/img/favicon_admin.png" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <script src="/core_noodles/libs/jquery/jquery.js"></script>
    <script src="/core_noodles/js/basic_admin.js"></script>

    <script>
        var global_dominio = "<?php echo $_SESSION['configuracion'][0]["valor"];?>";

        $(document).ready(function(){
            $("#login").submit(function(e){
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("login"));

                $.ajax({
                    url: $(this).attr("action"),
                    type: "post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data){
                    if(data["respuesta"]){
                        window.location="/admin/";
                    }else{
                        $('#error_login').foundation('open');
                    }
                });
            });

            $(".login_out").click(function(e){
                e.preventDefault();
                $.ajax({
                    url: "/login/out/",
                    type: "post",
                    dataType: "html",
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data){
                    window.location="/admin/";
                });
            });
        });
    </script>

    <!-- fundation -->
    <link rel="stylesheet" href="/core_noodles/libs/foundation/css/foundation.css">
    <link rel="stylesheet" href="/core_noodles/libs/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="/core_noodles/css/stylesheets/basic_admin.css">
    <!-- /fundation -->
</head>
<body>
	<div id="pensando">
		<div class="texto">
			<img src="/core_noodles/img/admin-loader.gif"> Cargando...
		</div>
	</div>
    <?php
        /* Comprobar si está loguineado */
        if(isset($_SESSION['usuario']) AND isset($_SESSION['password'])){

            $result = $this -> db
                            -> where("usuario='" . $_SESSION['usuario'] . "' AND contrasena='" . $_SESSION['password'] . "'")
                            -> get("usuarios");
            $row = $result 	-> row_array();

            if(!count($row)){
                $this -> load -> view('../../core_noodles/views/login');
                $this -> load -> view('../../core_noodles/views/footer');
                die();
            }
        }else{
            $this -> load -> view('../../core_noodles/views/login');
            $this -> load -> view('../../core_noodles/views/footer');
            die();
        }
    ?>
