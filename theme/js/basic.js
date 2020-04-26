$(document).ready(function(){
	$("#form_contacto").submit(function(e){
		e.preventDefault(); // avoid to execute the actual submit of the form.

		var form = $(this);
		var url = form.attr('action');

		$.ajax({
			type: "POST",
			url: '/core_noodles/mail.php',
				data: form.serialize(), // serializes the form's elements.
				success: function(data){
					alert('Mensaje enviado correctamente, nos contactaremos contigo pronto'); // show response from the php script.
				}
			});
	});
});
