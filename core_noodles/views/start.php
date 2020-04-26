<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
        <h1>Principal</h1>
        <h2>Enlaces rápidos</h2>
        <ul class="vertical menu">
            <?php
            for($i=1;$i<=10;$i++){
                $i2 = $i + $i + 4;
                $indice_enlace = $i2;
                $indice = $i2 +1;
                if($_SESSION['configuracion'][$indice]["valor"]!=""){
                    echo "<li><a href=\"{$_SESSION['configuracion'][$indice_enlace]["valor"]}\">{$_SESSION['configuracion'][$indice]["valor"]}</a></li>";
                }
            }
            ?>
        </ul>
        <ul class="accordion" data-accordion data-allow-all-closed="true">
            <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title"><i class="fi-download"></i> Copia de seguridad</a>
                <div class="accordion-content" data-tab-content>
                    <a href="/core_noodles/scripts/export_db.php" class="button expanded" target="_blank"><i class="fi-check"></i>Base de datos</a>
                    <br>
                    <a href="/core_noodles/scripts/zip.php" class="button expanded" target="_blank"><i class="fi-check"></i>Archivos</a>
                </div>
            </li>
        </ul>
        <ul class="accordion" data-accordion data-allow-all-closed="true">
            <li class="accordion-item" data-accordion-item>
                <a href="#" class="accordion-title"><i class="fi-download"></i> Mantenimiento</a>
                <div class="accordion-content" data-tab-content>
                    <a href="/core_noodles/scripts/mantenimiento.php" class="button expanded" target="_blank"><i class="fi-check"></i>Mantenimiento</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="column large-10 content end" style="padding: 1rem" id="cuerpo">
        <h2>Artículos organizados por páginas</h2>
        <ul class="accordion acordion_basic" data-accordion data-allow-all-closed="true">
            <?php
            foreach ($paginas as $pagina){
                $result_articulo = $this -> db
                                -> order_by("id", "desc")
                                -> where("pagina = {$pagina["id"]}")
                                -> get('articulos');

                $result_articulo = $result_articulo -> result();

                $cantidad = count($result_articulo);
                echo "
                    <li class=\"accordion-item\" data-accordion-item>
                        <a href=\"#pagina{$pagina["id"]}\" class=\"accordion-title\"> {$pagina["titulo"]} ({$cantidad}) › </a>
                        <div class=\"accordion-content\" data-tab-content id=\"pagina{$pagina["id"]}\">
                            <div>
                                <a href=\"/admin/articulos/nuevo/?pagina={$pagina["id"]}\" class=\"button small\"><strong>Crear nuevo artículo para: \"{$pagina["titulo"]}\"</strong></a>
                            </div>
                            ";
                            foreach ($result_articulo as $articulo_row){
                                echo "
                                <div class=\"callout lista_elementos_editar clearfix\" elemento_eliminar=\"". $articulo_row -> id ."\" pagina=\"". $articulo_row -> pagina ."\">
                                    <a href=\"/admin/articulos/editar/". $articulo_row -> id ."/\" class=\"large-10 column no-padding\">
                                        <div class=\"large-10 column no-padding\">
                                            <h3>". $articulo_row -> titulo ."</h3>
                                            <p>". $articulo_row -> descripcion ."</p>
                                        </div>
                                        <div class=\"large-2 column text-center\">
                                            <p>". $articulo_row -> fecha ."</p>
                                        </div>
                                    </a>
                                    <div class=\"large-2 column text-right\">
                                        <button class=\"button eliminar\" href=\"#\" data-open=\"modal_eliminar\" id-elemento=\"". $articulo_row -> id ."\">Eliminar</button>
                                    </div>
                                </div>
                                ";
                            }
                            echo "
                        </div>
                    </li>
                ";
            }
            ?>
        </ul>
    </div>
</div>
