<script src="/core_noodles/js/menu.js"></script>
<script>
    type = "<?php echo $type;?>";
</script>
<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
        <h1>Editor <?php echo $titulo_tipo;?></h1>
        <h2>Agrega nuevo item</h2>

		<div class="contenedor_simple">
			<form action="/api/menu/nuevo/<?php echo $type;?>/" method="post" enctype="multipart/form-data" autocomplete="off" id="formulario_nuevo_item">
				<?php
					if($type == "submenu"){
						echo "<input type=\"hidden\" value=\"{$menu_principal["id"]}\" name=\"menu\">";
					}
				?>
				<label>
					<p>Título del item</p>
					<input type="text" name="descripcion" placeholder="Nombre item" required>
				</label>
				<br>
				<label>
					<p>Dirección del item (url)</p>
					<input type="text" name="enlace" placeholder="Nombre item" required>
				</label>
				<br>
				<label>
					<p>También puedes seleccionar una dirección de abajo</p>
					<select id="lista_url">
						<option value="">Selecciona una dirección</option>";
						<optgroup label="Páginas">
							<?php
								foreach($paginas as $elemento){
									$urls[] = "/{$elemento["alias"]}/";
								}

								sort($urls);

								foreach ($urls as $url) {
									echo "<option value=\"{$url}\">{$url}</option>";
								}
							?>
						</optgroup>

						<optgroup label="Artículos">
							<?php
								unset($urls);
								foreach($articulos as $elemento){
									foreach($paginas as $elemento_pagina){
										if($elemento_pagina["id"] == $elemento["pagina"]){
											$urls[] = "/{$elemento_pagina["alias"]}/{$elemento["alias"]}/";
										}
									}
								}

								sort($urls);

								foreach ($urls as $url) {
									echo "<option value=\"{$url}\">{$url}</option>";
								}
							?>
						</optgroup>
					</select>
				</label>
				<br>
				<div>
					<input type="submit" class="button expanded" value="Agregar">
				</div>
			</form>
		</div>
    </div>

	<div class="column large-10 content end" style="padding: 1rem" id="cuerpo">
		<h2>
			<?php
				if($type == "menu"){
					echo "Menú general";
				}else{
					echo "	<a href=\"/admin/menu/\">Menú general</a>
							»
							{$menu_principal["descripcion"]}
 						 ";
				}
			?>
		</h2>

		<div class="large-9 column">
			<ul id="sortable">
				<?php
					if($type == "menu"){
						$column_big 	= 6;
						$show_column	= "";
					}else{
						$column_big 	= 8;
						$show_column	= "display:none";
					}

					foreach ($menu_items as $item){
						echo "
							<li class=\"ui-state-default clearfix\" orden=\"{$item["orden"]}\" id=\"{$item["id"]}\" descripcion=\"{$item["descripcion"]}\" enlace=\"{$item["enlace"]}\">
								<div class=\"column small-{$column_big}\">
									<div class=\"descripcion_texto\"><i class=\"fi-list\"></i> {$item["descripcion"]}</div>
								</div>
								<div class=\"column small-2 text-right\">
									<a data-open=\"editar\" class=\"editar\">Editar</a>
								</div>
								<div class=\"column small-2 text-right\">
									<a data-open=\"eliminar\" class=\"eliminar\">Eliminar</a>
								</div>
								<div class=\"column small-2 text-right\" style=\"{$show_column}\">
									<a href=\"submenu/{$item["id"]}/\">Submenu</a>
								</div>
							</li>
						";
					}
				?>
			</ul>
		</div>
		<div class="large-3 column">
			<p>
				El editor de <?php echo $titulo_tipo;?> te permite reorganizar los items de acuerdo al orden que necesites. <br> <br>
				<?php
					if($type == "menu"){
						echo "Puedes ver un submenú asignado a un ítem haciendo click en el boton «Submenú»";
					}
				?>
			</p>
		</div>

		</div>
	</div>
</div>

<div class="reveal" id="editar" data-reveal>
	<h1>Editar item</h1>

	<form action="/api/menu/editar/<?php echo $type;?>/" method="post" enctype="multipart/form-data" autocomplete="off" id="formulario_editar_item">
		<label>
			<p>Título del ítem</p>
			<input class="input-group-field" type="text" name="descripcion" placeholder="Nombre item">
		</label>
		<br>
		<label>
			<p>Dirección del item (url)</p>
			<input type="text" name="enlace" placeholder="Nombre item">
		</label>

		<label>
			<p>También puedes seleccionar una dirección de abajo</p>
			<select id="lista_url_editar">
				<option value="">Selecciona una dirección</option>";
				<optgroup label="Páginas">
					<?php
						foreach($paginas as $elemento){
							$urls[] = "/{$elemento["alias"]}/";
						}

						sort($urls);

						foreach ($urls as $url) {
							echo "<option value=\"{$url}\">{$url}</option>";
						}
					?>
				</optgroup>

				<optgroup label="Artículos">
					<?php
						unset($urls);
						foreach($articulos as $elemento){
							foreach($paginas as $elemento_pagina){
								if($elemento_pagina["id"] == $elemento["pagina"]){
									$urls[] = "/{$elemento_pagina["alias"]}/{$elemento["alias"]}/";
								}
							}
						}

						sort($urls);

						foreach ($urls as $url) {
							echo "<option value=\"{$url}\">{$url}</option>";
						}
					?>
				</optgroup>
			</select>
		</label>
		<br>
		<div>
			<input type="submit" class="button" value="Guardar cambios">
		</div>
	</form>

  	<button class="close-button" data-close aria-label="Close modal" type="button">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>

<div class="reveal" id="eliminar" data-reveal>
	<h1 class="text-center">¿Eliminar este item?</h1>
	<p class="titulo_eliminar text-center"></p>
	<p class="text-center"></p>

	<div>
		<div class="large-6 column">
			<input type="submit" class="button expanded cerrar " value="No">
		</div>
		<div class="large-6 column">
			<input type="submit" class="button expanded alert si" value="Sí">
		</div>
	</div>

  	<button class="close-button" data-close aria-label="Close modal" type="button">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>
