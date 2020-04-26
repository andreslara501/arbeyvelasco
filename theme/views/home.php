

<div class="container-fluid">
	<div class="row">
		<div class="col-6 text-center mt-2">
			<a href="/arbey/" id="boton_principal" type="button" class="btn bg-success btn-lg" style="color:white">Conoce más</a>
		</div>
		<div class="col-6 text-right">
			<img src="/theme/img/paz.jpg" style="width: 100%">
		</div>
	</div>
</div>

<br><br><br><br>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<img src="/uploads/articles/<?php echo $informacion_principal['0']['id']; ?>.jpg">
		</div>
		<div class="col-md-6 col-sm-12">
			<h1 class="texto_rojo"><?php echo $informacion_principal['0']['titulo']; ?></h1>
			<p>
				<?php echo html_entity_decode($informacion_principal['0']['texto'], ENT_COMPAT, 'UTF-8'); ?>
			</p>
		</div>
	</div>
</div>

<br><br><br>

<div id="propuestas" class="container" style="border-bottom: 1px solid #CCC">
	<h2 class="texto_rojo">Noticias</h2>
	<div class="row">

		<?php
			foreach ($noticias as $noticia) {
				?>
				<div class="col-md-6 col-sm-12">
						<div class="card noticia">
							<img
								src="/uploads/articles/<?php echo $noticia['id']; ?>.jpg"
								class="card-img-top" alt="..."
							>
							<div class="card-body">
								<h5 
									class="card-title"
									style="color: black;"
								>
									<a href="/noticias/noticia/<?php echo $noticia['alias']; ?>/">
										<?php echo $noticia['titulo'];?>
									</a>
								</h5>
								<p
									class="card-text"
									style="color: black; text-decoration: none;"
								>
									<?php echo $noticia['descripcion'];?>
								</p>
								<a href="/noticias/noticia/<?php echo $noticia['alias']; ?>/" class="card-link">Leer más</a>
							</div>
						</div>
						<br>
				</div>
				<?php
			}
		?>
	</div>
	<br><br>
	<a href="/noticias/" id="boton_principal" type="button" class="btn bg-success btn-lg btn-block" style="color:white">Conoce más</a>
</div>

<style>
	.noticia .card-body .card-text:hover{
		text-decoration: none;
	}
</style>