$(document).ready(function(){
    $("form").submit(function(e){
        e.preventDefault();

        id_usuario = $(this).attr("id");


        var formData = new FormData(document.getElementById(id_usuario));

        $.ajax({
            url: $(this).attr("action"),
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            window.location="/admin/usuarios/";
        });
    });

    $(".eliminar").click(function(){
        if(confirm("¿Seguro desea eliminar este usuario?")){

                id_usuario = $(this).parent().parent().attr("id"); console.log(id_usuario);

                $.get({
                    url: "/api/usuarios/eliminar/" + id_usuario,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data){
                    window.location="/admin/usuarios/";
                });

        }
    })
});
