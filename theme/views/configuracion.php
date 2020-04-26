<script src="/core_noodles/js/usuarios.js"></script>

<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
        <h1>Configuración</h1>
        <div class="contenedor_simple">
    		<p>Estos datos nos sirven para mejorar la indexación en Google</p>
            <p>Es un poco técnico, si no conoces del tema, mejor comunicate con el administrador</p>
        </div>
    </div>
    <div class="column large-10 content end" id="cuerpo">
        <h2>Configuración del sitio</h2>

        <form action="/api/configuracion/" method="post" enctype="multipart/form-data" autocomplete="off" id="configuracion" style="height: auto">
                <ul class="accordion acordion_basic" data-accordion data-allow-all-closed="true" >
                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Enlace dominio </a>
                        <div class="accordion-content" data-tab-content id="">
                            <input type="text" name="dominio" value="<?php echo $_SESSION['configuracion'][0]["valor"]; ?>"/>
                        </div>
                    </li>

                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Título</a>
                        <div class="accordion-content" data-tab-content id="">
                            <input type="text" name="titulo" value="<?php echo $_SESSION['configuracion'][1]["valor"]; ?>"/>
                        </div>
                    </li>

                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Correo contacto</a>
                        <div class="accordion-content" data-tab-content id="">
                            <input type="text" name="correo_contacto" value="<?php echo $_SESSION['configuracion'][2]["valor"]; ?>"/>
                        </div>
                    </li>

                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Descripción del sitio</a>
                        <div class="accordion-content" data-tab-content id="">
                            <textarea name="descripcion_sitio" rows="5"><?php echo $_SESSION['configuracion'][3]["valor"]; ?></textarea>
                        </div>
                    </li>

                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Código adicional</a>
                        <div class="accordion-content" data-tab-content id="">
                            <textarea name="meta_normal" rows="5"><?php echo $_SESSION['configuracion'][4]["valor"]; ?></textarea>
                        </div>
                    </li>

                    <li class="accordion-item" data-accordion-item>
                        <a href="#pagina" class="accordion-title"> Google Analytics</a>
                        <div class="accordion-content" data-tab-content id="">
                            <textarea name="google" rows="5"><?php echo $_SESSION['configuracion'][5]["valor"]; ?></textarea>
                        </div>
                    </li>
                </ul>

        	    <input type="submit" value="Guardad cambios" class="button expanded">
        </form>
    </div>
</div>




<div class="tiny reveal" id="guardado" data-reveal>
    <h2 id="firstModalTitle">¡Cambios guardados!</h2>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>
