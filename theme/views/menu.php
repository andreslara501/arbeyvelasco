<?php
    function permite($tipo_usuario, $pagina, $permisos){
        $pagina 	= str_replace("/", "", $pagina);

        if(is_numeric(array_search($pagina, $permisos[$tipo_usuario]))){
            $respuesta = FALSE;
        }else{
            $respuesta = TRUE;
        }

        return $respuesta;
    }
?>
<nav class="mobile hide-for-medium-up">
    <button>Toggle</button>
    <div>
        <a href="/admin/articulos/">Artículos</a>
        <a href="/admin/paginas/">Páginas</a>
        <a href="/admin/menu/">Configuración Menú</a>
        <a href="/admin/banners/">Banners</a>
        <a class="login_out" href="/admin/paginas/">Salir</a>
    </div>
</nav>

<nav class="top-bar hide-for-small-only hide-for-medium-only" data-topbar role="navigation">
	<div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
	      	<li>
                <a href="/admin/"><i class="fi-asterisk"></i> Noodles 2.0 | Inicio</a>
            </li>

            <li>
  		        <a href="/admin/articulos/"><i class="fi-list-thumbnails"></i> Artículo</a>
  		        <ul class="menu vertical">
                    <?php
                        if(permite($_SESSION["tipo_usuario"], "/admin/articulos/nuevo", $permisos)){
                            ?>
                                <li><a href="/admin/articulos/nuevo"><i class="fi-page"></i> Nuevo</a></li>
                            <?php
                        }
                    ?>
                    <?php
                        if(permite($_SESSION["tipo_usuario"], "/admin/articulos/", $permisos)){
                            ?>
  					            <li><a href="/admin/articulos/"><i class="fi-list"></i> Artículos</a></li>
                            <?php
                        }
                    ?>
  		        </ul>
  	      	</li>

            <li>
		        <a href="#"><i class="fi-widget"></i> Enlaces rápidos</a>
		        <ul class="menu vertical">
                    <?php
                    for($i=1;$i<=10;$i++){
                        $i2 = $i + $i + 4;
                        $indice_enlace = $i2;
                        $indice = $i2 +1;
                        if($_SESSION['configuracion'][$indice]["valor"]!=""){
                            if(permite($_SESSION["tipo_usuario"], $_SESSION['configuracion'][$indice_enlace]["valor"], $permisos)){
                                ?>
                                    <li><a href="<?php echo $_SESSION['configuracion'][$indice_enlace]["valor"]; ?>"><i class="fi-link"></i> <?php echo $_SESSION['configuracion'][$indice]["valor"]; ?></a></li>
                                <?php
                            }
                        }
                    }
                    ?>
		        </ul>
	      	</li>

			<li>
		        <a href="#"><i class="fi-lightbulb"></i> Otros</a>
		        <ul class="menu vertical">
                    <li>
                        <a href="/admin/paginas/"><i class="fi-page-copy"></i> Páginas</a>
                        <ul class="menu vertical">
                            <?php
                                if(permite($_SESSION["tipo_usuario"], "/admin/paginas/nueva/", $permisos)){
                                    ?>
                                        <li><a href="/admin/paginas/nueva/"><i class="fi-page"></i> Nueva Página</a></li>
                                    <?php
                                }
                                if(permite($_SESSION["tipo_usuario"], "/admin/paginas/", $permisos)){
                                    ?>
                                        <li><a href="/admin/paginas/"></i><i class="fi-page-copy"></i>  Páginas</a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </li>
                    <?php
                        if(permite($_SESSION["tipo_usuario"], "/admin/menu/", $permisos)){
                            ?>
    					        <li><a href="/admin/menu/"><i class="fi-link"></i> Menú general</a></li>
                            <?php
                        }
                        if(permite($_SESSION["tipo_usuario"], "/admin/links/", $permisos)){
                            ?>
    					        <li><a href="/admin/links/"><i class="fi-link"></i> Links (Estáticas)</a></li>
                            <?php
                        }
                        if(permite($_SESSION["tipo_usuario"], "/admin/banners/", $permisos)){
                            ?>
    					        <li><a href="/admin/banners/"></i><i class="fi-photo"></i> Banners</a></li>
                            <?php
                        }
                    ?>
					<li><a href="/admin/banners/"></i><i class="fi-graph-pie"></i> Encuestas</a>
						<ul class="menu vertical">
							<li><a href="/admin/polls/nueva/"><i class="fi-graph-pie"></i> Nueva encuesta</a></li>
							<li><a href="/admin/polls/"><i class="fi-graph-pie"></i> Encuestas</a></li>
				        </ul>
					</li>
		        </ul>
	      	</li>

            <li>
		        <a href="#"><i class="fi-widget"></i> Configuración</a>
		        <ul class="menu vertical">
                    <?php if(permite($_SESSION["tipo_usuario"], "/admin/configuracion/", $permisos)){
                        ?>
					        <li><a href="/admin/configuracion/"><i class="fi-widget"></i> Sitio</a></li>
                        <?php
                    }?>
                    <?php if(permite($_SESSION["tipo_usuario"], "/admin/enlaces_rapidos/", $permisos)){
                        ?>
					        <li><a href="/admin/enlaces_rapidos/"><i class="fi-widget"></i> Enlaces rápidos</a></li>
                        <?php
                    } ?>
                    <?php if(permite($_SESSION["tipo_usuario"], "/admin/usuarios/", $permisos)){
                        ?>
                            <li><a href="/admin/usuarios/"><i class="fi-widget"></i> Usuarios</a></li>
                        <?php
                    } ?>
		        </ul>
	      	</li>
	    </ul>
	</div>

	<div class="top-bar-right">
	    <ul class="menu">
	        <li class="alert" class="login_out"> ¡Hola <?php echo $_SESSION['usuario'];?>!</li>
            <li class="alert" class="login_out"><a href="/admin/nuevo/" class="login_out"> Cerrar sesión</a></li>
	    </ul>
  	</div>
</nav>
