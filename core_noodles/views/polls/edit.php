<script src="/theme/js/admin/admin/polls.js"></script>

<div class="column large-12">
	<br>
    <h2><a href="/admin/polls/">Encuestas</a> »
        Editar
	</h2>

	<div class="">
		<div class="large-6 column">
			<form action="/api/polls/editar/<?php echo $id;?>/" method="post" enctype="multipart/form-data" class="large-12" autocomplete="off" id="formulario_editar">
				<div class="input-group">
					<span class="input-group-label">Pegunta</span>
					<input class="input-group-field" type="text" value="<?php echo $descripcion;?>" name="descripcion" placeholder="Escriba la pregunta de la encuesta">
				</div>

				<div class="input-group">
					<span class="input-group-label">Respuesta 1</span>
					<input class="input-group-field" type="text" value="<?php echo $opciones[0]["respuesta"];?>"  name="r1" placeholder="Respuesta 1">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 2</span>
					<input class="input-group-field" type="text" value="<?php echo $opciones[1]["respuesta"];?>" name="r2" placeholder="Respuesta 2">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 3</span>
					<input class="input-group-field" type="text" value="<?php echo $opciones[2]["respuesta"];?>" name="r3" placeholder="Respuesta 3">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 4</span>
					<input class="input-group-field" type="text" value="<?php echo $opciones[3]["respuesta"];?>" name="r4" placeholder="Respuesta 4">
				</div>

                <div class="input-group">
					<span class="input-group-label">Respuesta 5</span>
					<input class="input-group-field" type="text" value="<?php echo $opciones[4]["respuesta"];?>" name="r5" placeholder="Respuesta 5">
				</div>

				<div>
					<input type="submit" class="button" value="Guardar cambios">
				</div>
			</form>
		</div>
        <div class="large-6 column">
            <div class="row">
            	<div class="large-4 small-4 columns">
                	<ul data-pie-id="pie">
						<?php if($opciones[0]["votacion"]){ ?>
                  			<li data-value="<?php echo $opciones[0]["votacion"];?>">Respuesta 1 (<?php echo $opciones[0]["votacion"];?> votos)</li>
						<?php }
						if($opciones[1]["votacion"]){ ?>
                  			<li data-value="<?php echo $opciones[1]["votacion"];?>">Respuesta 2 (<?php echo $opciones[1]["votacion"];?> votos)</li>
						<?php }
						if($opciones[2]["votacion"]){ ?>
                  			<li data-value="<?php echo $opciones[2]["votacion"];?>">Respuesta 3 (<?php echo $opciones[2]["votacion"];?> votos)</li>
						<?php }
						if($opciones[3]["votacion"]){ ?>
                  			<li data-value="<?php echo $opciones[3]["votacion"];?>" data-text="Respuesta 4 {{percent}} ({{value}} total)">Respuesta 4 (<?php echo $opciones[3]["votacion"];?> votos)</li>
						<?php }
						if($opciones[4]["votacion"]){ ?>
                  			<li data-value="<?php echo $opciones[4]["votacion"];?>">Respuesta 5 (<?php echo $opciones[4]["votacion"];?> votos)</li>
						<?php } ?>
                	</ul>
              	</div>
              	<div class="large-8 small-8 columns">
        			<div id="pie"></div>
              	</div>
            </div>
        </div>
	</div>
</div>

<div class="tiny reveal" id="editado" data-reveal>
    <h2 id="firstModalTitle">¡Encuesta editada con éxito!</h2>
	<p>Los cambios fueron guardados exitosamente, la votación no se modificó</p>

    <button class="close-button" data-close="" aria-label="Close reveal" type="button">
        <span aria-hidden="true">×</span>
    </button>
</div>

<link href="/theme/libs/pizza-master/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />

<script src="/theme/libs/pizza-master/dist/js/snap.svg.min.js"></script>
<script src="/theme/libs/pizza-master/dist/js/pizza.js"></script>

<script>
	$(window).load(function() {
    	Pizza.init();
    	$(document).foundation();
	});
</script>
