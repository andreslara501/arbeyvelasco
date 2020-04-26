<script src="/core_noodles/js/usuarios.js"></script>

<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
        <h1>Usuarios</h1>
        <h2>Agrega nuevo usuario</h2>

        <div class="contenedor_simple">
            <form id="xx" action="/api/usuarios/nuevo/" method="post" enctype="multipart/form-data" class="large-12">
                <label>
                    <p>Nombre</p>
                    <input type="text" value="" name="nombre" autocomplete="off" required>
                </label>
                <br>
                <label>
                    <p>Usuario</p>
                    <input type="text" value="" name="usuario" autocomplete="false" pattern="[a-zA-Z0-9-]+" title="Solo letras y números. Sin espacios" required>
                </label>
                <br>
                <label>
                    <p>Contraseña</p>
                    <input type="password" value="" name="contrasena" autocomplete="off" required>
                </label>
                <br>
                <label>
                    <p>Tipo usuario</p>
                    <select name="tipo_usuario" autocomplete="off">
                        <?php
                            $result = $this -> db
                                            -> order_by("nombre", "asc")
                                            -> get('tipo_usuario');

                            $tipos_usuario = $result -> result_array();

                            foreach($tipos_usuario as $tipo_usuario){
                                echo "<option value=\"{$tipo_usuario['id']}\">{$tipo_usuario['nombre']}</option>";
                            }
                        ?>
                    </select>
                </label>
                <br>
                <label>
                    <p>E-mail</p>
                    <input type="email" value="" name="correo" autocomplete="off" required>
                </label>
                <br>
                <label>
                    <p>Descripción</p>
                        <textarea name="descripcion" autocomplete="off" required></textarea>
                </label>
                <br>
                <label>
                    <input type="submit" class="button expanded" value="Agregar">
                </label>
            </form>
        </div>
    </div>
    <div class="column large-10 content end" style="padding: 1rem" id="cuerpo">
        <h2>Lista usuarios</h2>
        <ul class="accordion acordion_basic" data-accordion data-allow-all-closed="true">
            <?php
            $result = $this -> db
                            -> order_by("nombre", "asc")
                            -> get('usuarios');

            foreach ($result -> result() as $row){
                ?>
                        <li class="accordion-item" data-accordion-item>
                            <a href="#pagina" class="accordion-title"> <?php echo $row -> nombre;?> </a>
                            <div class="accordion-content" data-tab-content id="<?php echo $row -> id;?>">
                                <div>
                                    <button class="button alert eliminar"><strong>Eliminar usuario</strong></button>
                                </div>

                                <form action="/api/usuarios/editar/<?php echo $row -> id;?>/" method="post" enctype="multipart/form-data" class="large-12" autocomplete="off" id="id_usuario_<?php echo $row -> id;?>">
                                    <label>
                                        <div class="">Nombre </div>
                                        <p class="" id="">
                                            <input type="text" value="<?php echo $row -> nombre;?>" name="nombre" required>
                                        </p>
                                    </label>
                                    <label>
                                        <div class="">Usuario </div>
                                        <p class="" id="">
                                            <input type="text" value="<?php echo $row -> usuario;?>" name="usuario" pattern="[a-zA-Z0-9-]+" title="Solo letras y números. Sin espacios" required>
                                        </p>
                                    </label>
                                    <label>
                                        <div class="">Contraseña </div>
                                        <p class="" id="">
                                            <input type="password" value="<?php echo $row -> contrasena;?>" name="contrasena" required>
                                        </p>
                                    </label>
                                    <label>
                                        <div class="">Tipo de usuario </div>
                                        <p class="" id="">
                                            <select name="tipo_usuario">
                                                <?php
                                                    $result = $this -> db
                                			                        -> order_by("nombre", "asc")
                                			                        -> get('tipo_usuario');

                                					$tipos_usuario = $result -> result_array();

                                					foreach($tipos_usuario as $tipo_usuario){
                                                        if($row -> tipo_usuario == $tipo_usuario['id']){
                                                            echo "<option selected value=\"{$tipo_usuario['id']}\">{$tipo_usuario['nombre']}</option>";
                                                        }else{
                                                            echo "<option value=\"{$tipo_usuario['id']}\">{$tipo_usuario['nombre']}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </p>
                                    </label>
                                    <label>
                                        <div class="">E-mail </div>
                                        <p class="" id="">
                                            <input type="text" value="<?php echo $row -> correo;?>" name="correo" required>
                                        </p>
                                    </label>
                                    <label>
                                        <div class="">Descripción </div>
                                        <p class="" id="">
                                            <textarea name="descripcion" required><?php echo $row -> descripcion;?></textarea>
                                        </p>
                                    </label>
                                    <label>
                                        <p class="" id="">
                                            <input type="submit" class="button" value="Guardar cambios">
                                        </p>
                                    </label>
                                </form>
                            </div>
                        </li>
                <?php
                }
            ?>
        </ul>
    </div>
</div>

<div class="tiny reveal" id="guardado" data-reveal>
    <h2 id="firstModalTitle">¡Cambios guardados!</h2>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>
