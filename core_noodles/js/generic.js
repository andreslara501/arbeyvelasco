tinymce.init({
	selector:'#texto',
	language : "es",
	plugins: [
	  "advlist autolink lists link charmap print preview anchor",
	  "searchreplace visualblocks code fullscreen",
	  "insertdatetime media table contextmenu paste jbimages"
	],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
});


$(document).ready(function(){
	/*Youtube paste*/
	$("#youtube").on('input paste',function(e){
		youtube();
	});

	/*Enviar formulario*/
	$("#enviar").click(function(e){
		$("#pensando").show();
		e.preventDefault();
		var f = $("#formulario_campos");
		var formData = new FormData(document.getElementById("formulario_campos"));

		var texto = tinymce.get('texto').getContent();

		$(document).on('closed.zf.reveal', function (){
			window.location="/admin/" + type + "/";
		});

		formData.append("texto", texto);

		$.ajax({
			url: f.attr("action"),
			type: "post",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		}).
		done(function(data){
			$("#pensando").hide();
			$('#confirmar').foundation('open');
			$('#url').val(data["respuesta"]);
			$('#url_facebook').attr("href", "https://www.facebook.com/sharer/sharer.php?u=" + data["respuesta"]);
			$('#url_twitter').attr("href", "https://twitter.com/intent/tweet?text=" + data["respuesta_twitter"]);
		}).
	    fail(function(jqXHR, exception){
			var msg = '';
	        if (jqXHR.status === 0) {
	            msg = 'Sin internet';
	        } else if (jqXHR.status == 404) {
	            msg = 'Página de destino no encontrada. [404]';
	        } else if (jqXHR.status == 500) {
	            msg = 'Error interno [500].';
	        } else if (exception === 'parsererror') {
	            msg = 'Requested JSON parse failed.';
	        } else if (exception === 'timeout') {
	            msg = 'Time out error.';
	        } else if (exception === 'abort') {
	            msg = 'Ajax request aborted.';
	        } else {
	            msg = 'Uncaught Error.\n' + jqXHR.responseText;
	        }
			alert("No se pudo publicar " + msg);
	    })

	});

	/*Imagen principal*/
	$("#file").change(function(){
		var file = this.files[0];
		var imagefile = file.type;
		var match = ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
			$("#previewing").attr("src","/core_noodles/img/no-image.png");
			alert("La imagen no es válida");
			return false;
		}
		else{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$("#upload_image_by_galerie").val("");
		}
	});

	$("#upload_image_click").click(function(){
		$("#file").click();
	});

	$("#eliminar_foto").click(function(){
		$("#previewing").attr("src", "/core_noodles/img/camara.png");
		$("#previewing2").attr("src", "/core_noodles/img/upload.png");
		$("#file").val("");
		$("#file").css("color","black");
		$("#content_eliminar_foto").fadeOut();
		$("#boton_subida_foto").show();

		$("#galeria_upload_imagen_principal .img-wrap").removeClass("wrap_activo");
	});

	function imageIsLoaded(e){
		$("#file").css("color","green");
		$('#previewing').attr('src', e.target.result);
		$('#previewing2').attr('src', e.target.result);
		$("#content_eliminar_foto").fadeIn();

		$("#galeria_upload_imagen_principal .img-wrap").removeClass("wrap_activo");
	};

	/* Galeria upload principal*/
	$("#galeria_upload_imagen_principal .img-wrap").click(function(){
		$("#previewing").attr("src", "/uploads/" + type_dir + "/" + $(this).attr("id-image") + ".jpg");
		$("#previewing2").attr("src", "/uploads/" + type_dir + "/" + $(this).attr("id-image") + ".jpg");
		$("#file").val("");
		$("#upload_image_by_galerie").val($(this).attr("id-image"));
		$("#file").css("color","black");

		$("#galeria_upload_imagen_principal .img-wrap").removeClass("wrap_activo");

		$(this).addClass("wrap_activo");
		$("#content_eliminar_foto").fadeIn();
	});

	/* Galeries */
		$('#images').on('change',function(){
			$('#multiple_upload_form').ajaxForm({
				target:'#images_preview',
				beforeSubmit:function(e){
					$('.uploading').show();
				},
				success:function(e){
					$('.uploading').hide();
				},
				error:function(e){
				}
			}).submit();
		});
		$("body").on("click", ".img-wrap .close", function(){
			id_image = $(this).parent().attr("id-image");
			$.ajax({
				url: "/api/galeries_delete/" + type_dir + "/" + id + "/" + id_image,
				type: "post",
				dataType: "json"
			})
			.done(function(data){
			});
			$(this).parent().fadeOut();
		});

	/* Files */
		$('#files').on('change',function(){
			$('#multiple_upload_form_files').ajaxForm({
				target:'#files_preview',
				beforeSubmit:function(e){
					$('.uploading').show();
				},
				success:function(e){
					$('.uploading').hide();
				},
				error:function(e){
				}
			}).submit();
		});

		$("body").on("click", ".file-wrap .close", function(){
			id_file = $(this).parent().parent().attr("id-file");
			$.ajax({
				url: "/api/files_delete/" + type_dir + "/" + id + "/" + id_file,
				type: "post",
				dataType: "json"
			})
			.done(function(data){
			});
			$(this).parent().parent().fadeOut();
		});

	function youtube(){
		if($("#youtube").val()==""){
			$("#video_thumbnail").fadeOut();
		}else{
			try {
				var iframe_src       = $("#youtube").val();
				var youtube_video_id = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();

				if (youtube_video_id.length == 11) {
					var video_thumbnail = 'http://img.youtube.com/vi/'+youtube_video_id+'/0.jpg';
					$("#video_thumbnail").fadeIn();
					$("#video_thumbnail").attr("src", video_thumbnail);
				}
			}
			catch(e) {
				$("#video_thumbnail").fadeOut();
			}
		}
	}

	$(".cerrar_modal").click(function(e){
		e.preventDefault();
		$('#' + $(this).attr("modal")).foundation('close');
	})
});
