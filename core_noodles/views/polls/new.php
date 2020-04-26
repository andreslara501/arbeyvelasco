<script src="/theme/js/admin/admin/polls.js"></script>

<div class="column large-12">
	<br>
    <h2><a href="/admin/polls/">Encuestas</a> »
        Nueva encuesta
	</h2>

	<div class="">
		<div class="large-5 column">
			<form action="/api/polls/nueva/" method="post" enctype="multipart/form-data" class="large-10" autocomplete="off" id="formulario_nuevo">
				<div class="input-group">
					<span class="input-group-label">Pegunta</span>
					<input class="input-group-field" type="text" name="descripcion" placeholder="Escriba la pregunta de la encuesta">
				</div>

				<div class="input-group">
					<span class="input-group-label">Respuesta 1</span>
					<input class="input-group-field" type="text" name="r1" placeholder="Respuesta 1">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 2</span>
					<input class="input-group-field" type="text" name="r2" placeholder="Respuesta 2">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 3</span>
					<input class="input-group-field" type="text" name="r3" placeholder="Respuesta 3">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 4</span>
					<input class="input-group-field" type="text" name="r4" placeholder="Respuesta 4">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 5</span>
					<input class="input-group-field" type="text" name="r5" placeholder="Respuesta 5">
				</div>

				<div>
					<input type="submit" class="button" value="Guardar cambios">
				</div>
			</form>
		</div>
	</div>
</div>

<div class="tiny reveal" id="creado" data-reveal>
    <h2 id="firstModalTitle">¡Encuesta editada con éxito!</h2>
	<p>No se publicará hasta que la seleccione de la sección «Encuestas»</p>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>
