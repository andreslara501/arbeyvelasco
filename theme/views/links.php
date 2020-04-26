<script src="/core_noodles/js/links.js"></script>

<div id="internal">
    <div class="column large-2 callout secondary panel-aside large-collapse">
		<h1>Links (Estáticas)</h1>
		<h2>Agrega nuevo link</h2>
		<div class="contenedor_simple">
			<form action="/api/links/nuevo/" method="post" enctype="multipart/form-data" autocomplete="off" id="formulario_nuevo_item">
				<label>
					<p>Título</p>
					<input type="text" name="titulo" placeholder="Nombre item" required>
				</label>
				<br>
				<label>
					<p>Descripción</p>
					<input type="text" name="descripcion" placeholder="Nombre item" required>
				</label>
				<br>
				<label>
					<p>Dirección del link (url)</p>
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
				<label>
					<p>Imagen</p>
					<input type="file" name="file" id="file"  required/>
				</label>
				<br>
				<div>
					<input type="submit" class="button expanded" value="Agregar">
				</div>
			</form>
		</div>
	</div>

	<div class="column large-10 content end" style="padding: 1rem" id="cuerpo">
        <h2>Links (Enlaces estáticos)</h2>
		<ul id="sortable">
			<?php
				foreach ($links as $link){
					echo "
						<li class=\"ui-state-default clearfix\" orden=\"{$link["orden"]}\" id=\"{$link["id"]}\" descripcion=\"{$link["descripcion"]}\" enlace=\"{$link["enlace"]}\" titulo=\"{$link["titulo"]}\">
							<div class=\"column large-2\">
								<img src=\"../../uploads/links/{$link["id"]}.jpg\">
							</div>
							<div class=\"column large-6\">
								<div class=\"descripcion_texto\"><i class=\"fi-list\"></i> {$link["descripcion"]}</div>
							</div>
							<div class=\"column large-2 text-right\">
								<a data-open=\"editar\" class=\"editar\">Editar</a>
							</div>
							<div class=\"column large-2 text-right\">
								<a data-open=\"eliminar\" class=\"eliminar\">Eliminar</a>
							</div>
						</li>
					";
				}
			?>
		</ul>
	</div>
</div>

<div class="reveal" id="editar" data-reveal>
	<h1>Editar item</h1>

	<form action="/api/links/editar/" method="post" enctype="multipart/form-data" class="large-10" autocomplete="off" id="formulario_editar_item">
		<label>
			<p>Título</p>
			<input class="input-group-field" type="text" name="titulo" placeholder="Nombre item" required>
		</label>
		<br>
		<label>
			<p>Descripción</p>
			<input class="input-group-field" type="text" name="descripcion" placeholder="Nombre item" required>
		</label>
		<br>
		<label>
			<p>Dirección del link (url)</p>
			<input class="input-group-field" type="text" name="enlace" placeholder="Nombre item" required>
		</label>
		<br>
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
		<label>
			<p>Imagen</p>
			<input type="file" name="file" id="file" required/>
		</label>
		<br>
		<div>
			<input type="submit" class="button" value="Agregar">
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
