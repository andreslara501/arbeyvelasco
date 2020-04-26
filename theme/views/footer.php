
<br><br><br><br>

<div id="video">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<h1 class="texto_rojo">
					<?php
						function getYoutubeEmbedUrl($url){
							$string     = $url;
							$search     = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
							$replace    = "youtube.com/embed/$1";    
							$url = preg_replace($search,$replace,$string);
							return $url;
						}
						echo $informacion_principal['1']['titulo'];
					?>
				</h1>
				<p>
					<?php echo html_entity_decode($informacion_principal['1']['texto'], ENT_COMPAT, 'UTF-8'); ?>
				</p>
			</div>
			<div class="col-md-6 col-sm-12">
				<iframe 
					width="560" 
					height="315" 
					src="<?php echo getYoutubeEmbedUrl($informacion_principal['1']['youtube']);?>" 
					frameborder="0" 
					allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
					allowfullscreen
				>
				</iframe>
			</div>
		</div>
	</div>
</div>



<footer>

	<br><br>

	<div id="contacto" class="container clearfix">
		<div class="row">
			<div class="col-md-5 col-sm-12">
				<form id="form_contacto">
					<h3 class="texto_rojo">Comunícate con nosotros</h3>
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre</label>
						<input 
							type="text" 
							class="form-control" 
							placeholder="Ingresa tu nombre"
							name="nombre"
						>
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Celular</label>
						<input 
							type="text" 
							class="form-control" 
							placeholder="Ingresa tu celular"
							name="celular"
						>
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Correo electrónico</label>
						<input 
							type="email" 
							class="form-control" 
							id="exampleInputEmail1" 
							aria-describedby="emailHelp" 
							placeholder="Enter email"
							name="correo"
						>
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Mensaje</label>
						<textarea 
							class="form-control" 
							id="exampleFormControlTextarea1" 
							rows="3"
							name="mensaje"
						></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Enviar</button>
				</form>
			</div>
			<div class="col-md-7 col-sm-12">

				<div style="position: relative;">
					<h4 style="margin-top: 0px;">Sede política</h4>
					<p>Calle 7 # 2 - 18 Barrio Panamericano / Belalcázar - Páez - Cauca</p>

					<h4>Whatsappy celular</h4>
					<p>312 847 7392</p>

					<h4>Correo</h4>
					<p>contacto@arbeyvelasco.com</p>

					<!-- Button trigger modal -->
					<span data-toggle="modal" data-target="#exampleModal" >Crédito de fotos</span>

					<img src="/theme/img/solo.png" id="foto">
					<hr class="clearfix">

					<img src="/theme/img/logo.png" id="logo">
				</div>

			</div>
		</div>
	</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        - https://www.municipios.com.co/cauca/paez <br>
        - https://mapio.net/a/114361344/?lang=ms <br>
        - http://wradio.com.co
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/theme/js/basic.js"></script>
</body>
</html>