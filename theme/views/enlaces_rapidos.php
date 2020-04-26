<script src="/core_noodles/js/enlaces_rapidos.js"></script>

<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
		<h1>Enlaces rápidos</h1>
        <div class="contenedor_simple">
    		<p>Los enlaces rápidos te permiten acceder a funciones del editor de manera sencilla</p>
            <p>También a direcciones externas de otras páginas o favoritos</p>
        </div>
    </div>
	<div class="column large-10 content end" style="padding: 1rem" id="cuerpo">
        <h2>Lista de enlaces</h2>
        <form action="/api/enlaces_rapidos/" method="post" enctype="multipart/form-data" class="large-12" autocomplete="off" id="enlaces_rapidos">
            <ul class="accordion acordion_basic" data-accordion data-allow-all-closed="true" >
                    <?php
                        for($i=1;$i<=10;$i++){
                            $i2 = $i + $i + 4;
                            $indice = $i2;
                            $indice_enlace = $i2 +1;
                            ?>
                            <li class="accordion-item" data-accordion-item>
                                <a href="#pagina" class="accordion-title"> Enlace <?php echo $i;?> </a>
                                <div class="accordion-content" data-tab-content id="<?php echo $i;?>">
                                    <input type="text" name="enlace_nombre_<?php echo $i;?>" value="<?php echo $_SESSION['configuracion'][$indice_enlace]["valor"]; ?>" placeholder="Nombre del enlace"/>
                                    <input type="text" name="enlace_<?php echo $i;?>" value="<?php echo $_SESSION['configuracion'][$indice]["valor"]; ?>" placeholder="Dirección"/>
                                </div>
                            </li>

                            <?php
                        }
                    ?>
                    <input type="submit" value="Guardad cambios" class="button expanded">
            </ul>
        </form>
    </div>
</div>

<div class="tiny reveal" id="guardado" data-reveal>
    <h2 id="firstModalTitle">¡Cambios guardados!</h2>


    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>
