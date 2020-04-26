$(document).ready(function() {
    /* Nuevo item */
    $("#formulario_nuevo").submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("formulario_nuevo"));

        $.ajax({
            url: $("#formulario_nuevo").attr("action"),
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $('#creado').foundation('open');
        });
    });

    /* Editar item */
    $("#formulario_editar").submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("formulario_editar"));

        $.ajax({
            url: $("#formulario_editar").attr("action"),
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $('#editado').foundation('open');
        });
    });

    $(".eliminar").click(function(e){
        $('#eliminar_descripcion').text($(this).parent().parent().find("h3").text());
        id_articulo_global = $(this).attr("id-elemento");
    });

    $(".publica").click(function(e){
        id_articulo_global = $(this).attr("id-elemento-publica");
        $.ajax({
            url: "/api/polls/publica/"+id_articulo_global+"/",
            type: "post",
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $(".publica").show();
            $("[id-elemento-publica=" + id_articulo_global + "]").fadeOut();
        });
        e.preventDefault();
    });

    $("#eliminar_cancelar").click(function(e){
        $('#eliminar').foundation('close');
    });

    $("#eliminar_eliminar").click(function(e){
        click_this = this;
        $.ajax({
            url: "/api/polls/eliminar/"+id_articulo_global+"/",
            type: "post",
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $('#modal_eliminar').foundation('close');
            $("[elemento_eliminar=" + id_articulo_global + "]").fadeOut();
        });
    });

});

$(document).on('closed.zf.reveal', function(){
    window.location="/admin/polls/";
});
