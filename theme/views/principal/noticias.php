<div class="container">
	<br>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: white; padding: 0px;">
			<li class="breadcrumb-item"><a href="/">Inicio</a></li>
			<li class="breadcrumb-item active" aria-current="page">Noticias</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div>
				<br>
				<h1 class="texto_rojo">Noticias</h1><br>

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

			</div>
		</div>
	</div>
</div>