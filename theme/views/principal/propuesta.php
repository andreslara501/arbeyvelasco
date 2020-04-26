<div class="container">
	<br>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: white; padding: 0px;">
			<li class="breadcrumb-item"><a href="/">Inicio</a></li>
			<li class="breadcrumb-item"><a href="/propuestas/">Propuestas</a></li>
			<li class="breadcrumb-item active" aria-current="page">Propuesta</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div style="padding: 0px 10%">
				<br>
				<h1 class="texto_rojo"><?php echo $propuesta['titulo']; ?></h1><br>
				<p>
					<?php echo html_entity_decode($propuesta['texto'], ENT_COMPAT, 'UTF-8'); ?>
				</p>
			</div>
		</div>
	</div>
</div>