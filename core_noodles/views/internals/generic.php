<script>
    type                        = "<?php echo $type;?>";
    type_dir                    = "<?php echo $type_dir;?>";
    <?php
        if(isset($pagina_articulo)){
            ?>
            pagina_del_articulo_alias   = "<?php echo $pagina_articulo["alias"];?>";
            <?php
        }else{
            ?>
            pagina_del_articulo_alias   = false;
            <?php
        }
    ?>

    <?php
        if(!isset($content)){
            $id = "";
        }
        echo "id = \"{$id}\";";
    ?>
</script>

<script type="text/javascript" src="/core_noodles/libs/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/core_noodles/js/generic.js"></script>

</head>
<body>
<!-- /head -->
<div class="tiny reveal" id="confirmar" data-reveal>
    <h2 id="firstModalTitle">¡Artículo creado con éxito!</h2>
    <p>Comparte el artículo en redes sociales</p>
    <input type="text" name="url" id="url">

    <div>
        <div class="column large-6 text-center">
            <a href="" title="Compartir en Facebook" target="_blank" id="url_facebook" class="button">
            	<i class="fi-social-facebook"></i> Compartir en Facebook
            </a>
        </div>

        <div class="column large-6 text-center">
            <a href="" title="Compartir en Twitter" target="_blank" id="url_twitter" class="button">
            	<i class="fi-social-twitter"></i> Compartir en Twitter
            </a>
        </div>
    </div>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="large reveal" id="galeries_subidos" data-reveal>
    <div id="galeria_upload_imagen_principal">
        <h1>Foto artículo <button class="small button no-margin cerrar_modal" href="#" modal="galeries_subidos"><i class="fi-check"></i> Aceptar y continuar</button></h1>
        <div class="row">
            <div class="large-3 column callout secondary no-border" style="height: 400px">
                <label class="large-collapse text-center" id="upload_image_click">
                    <?php
                        if(isset($content)){
                            if($content["image"] == 0){
                                echo "<img src=\"/core_noodles/img/upload.png\" id=\"previewing2\">";
                                $display_boton_eliminar = "display: none;";
                            }else{
                                echo "<img src=\"/uploads/{$type_dir}/" . $id . ".jpg?random=" . rand(0,1000000000000) . "\" id=\"previewing2\">";
                                $display_boton_eliminar = "";
                            }
                        }else{
                            echo "<img src=\"/core_noodles/img/upload.png\" id=\"previewing2\">";
                            $display_boton_eliminar = "display: none;";
                        }
                    ?>
                    <h6 class="subheader">Foto actual</h6>
                </label>
                <div id="content_eliminar_foto" style="<?php echo $display_boton_eliminar;?>">
                    <button id="eliminar_foto" class="small expanded button" href="#"><i class="fi-x"></i> Eliminar foto</button>
                </div>
            </div>
            <div class="large-9 column">
                <div class="galeria">
                    <p class="text-left"><strong>También puedes seleccionar una de la galería: </strong></p>
                    <div class="gallery">
                        <?php echo $galeria;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="large reveal" id="galeries" data-reveal>
    <div class="upload_div">
        <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="<?php echo $url_api_galeria_imagenes;?>">
            <h1>Galería imágenes
                <a class="small button no-margin cerrar_modal" href="#" modal="galeries"><i class="fi-check"></i> Aceptar y continuar</a>
                <label for="images" class="button small no-margin"><strong><i class="fi-upload"></i> Subir imagen</strong></label>
            </h1>
            <input type="file" name="images[]" id="images" class="show-for-sr" multiple >

            <div class="uploading none">
                <label>&nbsp;</label>
                <img src="/core_noodles/img/uploading.gif"/>
            </div>
        </form>
    </div>
    <div class="gallery" id="images_preview">
        <?php if(isset($galeria_id)){ echo $galeria_id;}?>
    </div>
    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div class="medium reveal" id="files" data-reveal>
    <div class="upload_div">
        <h1>Archivos</h1>
        <form method="post" name="multiple_upload_form_files" id="multiple_upload_form_files" enctype="multipart/form-data" action="<?php echo $url_api_archivos;?>">
            <label for="files_archivos" class="button">Subir archivo</label>
            <input type="file" name="files[]" id="files_archivos" class="show-for-sr" multiple >

            <div class="uploading none">
                <label>&nbsp;</label>
                <img src="/core_noodles/img/uploading.gif"/>
            </div>
        </form>
    </div>
    <div class="gallery" id="files_preview">
        <?php if(isset($archivos_id)){ echo $archivos_id;}?>
    </div>
    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>

<div id="internal">
    <form action="<?php echo $url_form;?>" method="post" enctype="multipart/form-data" class="large-12" autocomplete="off" id="formulario_campos">
        <div class="column large-2 callout secondary panel-aside large-collapse">
            <h1><?php echo $titulo_tipo;?></h1>
            <div style="padding: 10px;">
                <button type="submit" id="enviar" class="medium button radius success expanded"><strong>
                    <i class="fi-check"> </i>Guardar <?php echo $palabra_tipo;?></strong>
                </button>
            </div>
            <ul class="accordion" data-accordion data-allow-all-closed="true">
                <li class="accordion-item is-active" data-accordion-item>
                    <a href="#" class="accordion-title"><i class="fi-photo"></i> Foto <?php echo $palabra_tipo;?></a>
                    <div class="accordion-content clearfix large-collapse" data-tab-content>
                        <label class="large-collapse">
                            <div class="medium-12 columns end text-center">
                                    <?php
                                        if(isset($content)){
                                            if($content["image"] == 0){
                                                echo "<img src=\"/core_noodles/img/camara.png\" id=\"previewing\">";
                                            }else{
                                                echo "<img src=\"/uploads/{$type_dir}/" . $id . ".jpg?random=" . rand(0,1000000000000) . "\" id=\"previewing\">
                                                ";
                                            }
                                        }else{
                                            echo "<img src=\"/core_noodles/img/camara.png\" id=\"previewing\">";
                                        }
                                    ?>
                            </div>
                        </label>
                        <div class="medium-12 columns end">
                            <br>
                            <a data-open="galeries_subidos" class="button expanded"><i class="fi-photo"></i>Seleccionar foto</a>

                            <input type="file" name="file" id="file" class="show-for-sr"/>
                            <input type="hidden" id="upload_image_by_galerie" name="upload_image_by_galerie" value="">
                        </div>
                    </div>
                </li>

                <li class="accordion-item " data-accordion-item>
                    <a href="#" class="accordion-title"><i class="fi-photo"></i> Galería imágenes</a>
                    <div class="accordion-content clearfix large-collapse" data-tab-content>
                        <a data-open="galeries" class="button expanded"><i class="fi-photo"></i> Ver / subir imágenes</a>
                    </div>
                </li>

                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title"><i class="fi-play-video"></i> Youtube</a>
                    <div class="accordion-content clearfix" data-tab-content>
                        <p>Inserte la URL del video de Youtube</p>
                        <label>
                            <input type="text" name="youtube" id="youtube" placeholder="URL video Youtube" value="<?php if(isset($content)){ echo $content["youtube"];}?>"/>
                            <div class="medium-12 text-center end columns">
                                <img id="video_thumbnail" src="" style="width:100%; display:none;"></img>
                            </div>
                        </label>
                    </div>
                </li>

                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title"><i class="fi-play"></i> Soundcloud</a>
                    <div class="accordion-content clearfix" data-tab-content>
                        <p>Inserte el código de Soundcloud</p>
                        <label>
                            <textarea type="text" name="soundcloud" id="soundcloud" placeholder="Código de soundcloud" rows="4"/><?php if(isset($content)){ echo $content["soundcloud"];}?></textarea>
                        </label>
                    </div>
                </li>

                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title"><i class="fi-folder"></i> Archivos</a>
                    <div class="accordion-content" data-tab-content>
                        <a data-open="files" class="button expanded"><i class="fi-check"></i>Ver / subir archivos</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="column large-10 content end" style="padding: 1rem" id="cuerpo">

            <?php
                if($type == "articulos"){
                    if(isset($pagina_get)){
                        if(!$pagina_get){
                            ?>
                            <div>
                                <label>
                                    <div class="">Página a la que va a agregar el artículo</div>

                                    <p class="" id="infoajax_numero_nitrut">
                                        <select name="pagina">
                                            <?php
                            					foreach($paginas as $pagina){
                                                    if(isset($content)){
                                                        if($content["pagina"] == $pagina["id"]){
                                                            echo "<option selected value=\"{$pagina['id']}\" alias=\"{$pagina['alias']}\">{$pagina['titulo']}</option>";
                                                        }else{
                                                            echo "<option value=\"{$pagina['id']}\" alias=\"{$pagina['alias']}\">{$pagina['titulo']}</option>";
                                                        }
                                                    }else{
                                                        echo "<option value=\"{$pagina['id']}\" alias=\"{$pagina['alias']}\">{$pagina['titulo']}</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </p>
                                </label>
                            </div>
                            <?php
                        }else{
                            echo "<h2>Crear artículo en: {$pagina_articulo["titulo"]}</h2>";
                            echo "<input type=\"hidden\" name=\"pagina\" value=\"{$pagina_get}\">";
                        }
                    }
                }
            ?>

            <div>
                <label>
                    <div class="">Título <span style="color: red">*</span></div>
                    <p class="">
                        <input type="text" name="titulo"  maxlength="140" required placeholder="Inserte el título" value="<?php if(isset($content)){ echo $content["titulo"];}?>"/>
                    </p>
                </label>
            </div>

            <div>
                <label>
                    <div class="">Resumen </div>
                    <textarea name="descripcion" required placeholder="Inserte el resumen" maxlength="250"><?php if(isset($content)){ echo $content["descripcion"];}?></textarea>
                </label>
            </div>

            <div>
                <label>
                    <div class="">Texto </div>
                    <textarea id="texto" name="no2" style="height:300px"><?php if(isset($content)){ echo $content["texto"];}?></textarea>
                </label>
            </div>

        </div>
    </form>
</div>
