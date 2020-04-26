<div class="container">
	<br>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: white; padding: 0px;">
			<li class="breadcrumb-item"><a href="/">Inicio</a></li>
			<li class="breadcrumb-item active" aria-current="page">Propuestas</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div>
				<br>
				<h1 class="texto_rojo">Propuestas</h1><br>

				<div class="row">
					<?php
						$contador = 1;
						foreach ($propuestas as $propuesta) {
							?>
							<div class="col-sm-12 col-md-6">
								<div class="row">
									<div class="col-12">
										<h3><?php echo $propuesta['titulo'];?></h3>
									</div>
									<div class="col-sm-12 col-md-6">
										<div class="foto">
											<img src="/uploads/articles/<?php echo $propuesta['id']; ?>.jpg" style="width: 100%">
										</div>
									</div>

									<div class="col-sm-12 col-md-6">
										<?php echo $propuesta['descripcion'];?>
									</div>
								</div>

								<a href="/propuestas/propuesta/<?php echo $propuesta['alias']; ?>/" type="button" class="btn btn-link">Ver más</a>
								<br><br>
							</div>
							<?php
							$contador ++;
						}
					?>
				</div>

			</div>
		</div>
	</div>
</div>
