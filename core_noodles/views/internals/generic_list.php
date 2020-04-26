<script>
    type = "<?php echo $type;?>";
    type_dir = "<?php echo $type_dir;?>";
</script>

<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
        <h1><?php echo $titulo_tipo; ?></h1>

        <?php
            if($type == "articulos"){
                $tipo_nuevo = "nuevo";
            }else{
                $tipo_nuevo = "nueva";
            }
        ?>

        <div class="contenedor_simple">
            <a href="/admin/<?php echo "{$type}/{$tipo_nuevo}/";?>" class="button expanded">Crear <?php echo "{$tipo_nuevo} $palabra_tipo"; ?></a>
        </div>

        <h2><?php echo $subtitulo_tipo; ?></h2>

        <ul class="vertical menu">
            <p><?php echo $texto_tipo; ?></p>
            <?php
                if($type == "articulos"){
                    if(isset($id)){
                        echo "<li><a href=\"/admin/articulos/\">Todos los artículos</a></li>";
                    }else{
                        echo "<li><a href=\"/admin/articulos/\" class=\"activo\">Todos los artículos</a></li>";
                        $id = "";
                    }
                }
                foreach($paginas as $pagina){
                    $result = $this -> db
    								-> order_by("id", "desc")
    								-> where("pagina = {$pagina["id"]}")
    								-> get('articulos');
    				$articulos_count = count($result -> result_array());

                    if($articulos_count){
                        $badge = "<span class=\"badge secondary\">{$articulos_count}</span>";
                    }else{
                        $badge = "";
                    }

                    if($pagina["id"] == $id){
                        echo "<li><a href=\"/admin/{$type}/por-pagina/{$pagina['id']}/\" class=\"activo\">{$pagina['titulo']} {$badge}</a></li>";
                    }else{
                        echo "<li><a href=\"/admin/{$type}/por-pagina/{$pagina['id']}/\">{$pagina['titulo']} {$badge} </a></li>";
                    }
                }
            ?>
        </ul>
    </div>

    <div class="column large-10" id="cuerpo">
        <h2><?php echo $titulo_tipo_interno; ?></h2>
        <br>
        <input type="text" name="busqueda" id="busqueda" placeholder="Inserte búsqueda"/>
        <br>
                <?php
                foreach ($elementos as $elemento){
                    echo "
                        <div class=\"callout lista_elementos_editar clearfix\" elemento_eliminar=\"{$elemento["id"]}\">
                            <a href=\"/admin/{$type}/editar/{$elemento["id"]}/\" class=\"large-10 column no-padding\">
                                <div class=\"large-10 column no-padding\">
                                    <h3>{$elemento["titulo"]}</h3>
                                    <p>{$elemento["descripcion"]}</p>
                                </div>
                                <div class=\"large-2 column text-center\">
                                    <p>{$elemento["fecha"]}</p>
                                </div>
                            </a>
                            <div class=\"large-2 column text-right\">
                                <button class=\"button eliminar\" href=\"#\" data-open=\"modal_eliminar\" id-elemento=\"{$elemento["id"]}\">Eliminar</button>
                            </div>
                        </div>
                        ";
                }
                if(!count($elementos)){
                    echo "<p>No hay {$type}</p>";
                }
                ?>

    </div>
</div>

<div class="reveal" id="modal_eliminar" data-reveal>
    <h2 id="firstModalTitle">¿Desea eliminar este artículo?</h2>
    <p id="eliminar_descripcion"></p>
    <br>
    <div class="columns small-12 collapse">
        <div class="columns small-6">
            <button class="button expanded radius" id="eliminar_cancelar">Cancelar</button>
        </div>
        <div class="columns small-6">
            <button class="button expanded radius alert" id="eliminar_eliminar">Eliminar</button>
        </div>
    </div>

    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script src="/core_noodles/js/generic_list.js"></script>
