<div class="container">
	<br>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background: white; padding: 0px;">
			<li class="breadcrumb-item"><a href="/">Inicio</a></li>
			<li class="breadcrumb-item active" aria-current="page">Publicidad</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-12">
			<div style="padding: 0px 10%">
				<br>
				<h1 class="texto_rojo">Publicidad</h1><br>
				<p>
					<?php echo html_entity_decode($publicidad['texto'], ENT_COMPAT, 'UTF-8'); ?>
				</p>
				<?php
					if ($handle = opendir('./uploads/archivos/articles/' . $publicidad['id'] . "/")) {
					    while (false !== ($entry = readdir($handle))) {
					      if ($entry != "." && $entry != "..") {
					        ?>
					        	<li><a href="/uploads/archivos/articles/<?php echo $publicidad['id'] . "/" . $entry; ?>" target="blank"><?php echo $entry; ?></a></li>
					        <?php
					      }
					  }
					  closedir($handle);
					}
				?>
			</div>
		</div>
	</div>
</div>