
$(document).ready(function() {
    /* Sortable */
    $("#sortable").sortable({
        placeholder: "ui-state-highlight",
        update: function(event, ui){
            var order = [];
            $('#sortable li').each( function(e){
                order.push($(this).attr('id')  + '=' + ( $(this).index() + 1 ) );
            });

            positions = order.join(';');

            $.ajax({
                url: "/api/banners/reorganizar/",
                type: "post",
                dataType: "json",
                data: {"posiciones" : positions},
            })
            .done(function(data){

            });
        }
    });

    /* Editar */
    $("body").on("click", ".editar", function(){
        $("#editar [name=descripcion]").val($(this).parent().parent().attr("descripcion"));
        $("#editar [name=enlace]").val($(this).parent().parent().attr("enlace"));
        $("#editar").attr("id_elemento", $(this).parent().parent().attr("id"));
    });

    $("#formulario_editar_item").submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("formulario_editar_item"));

        $.ajax({
            url: $("#formulario_editar_item").attr("action") + $("#editar").attr("id_elemento") + "/",
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $("#" + $("#editar").attr("id_elemento") + " .descripcion_texto").text($("#editar [name=descripcion]").val());
            $("#" + $("#editar").attr("id_elemento")).attr("descripcion", $("#editar [name=descripcion]").val());
            $("#" + $("#editar").attr("id_elemento")).attr("enlace", $("#editar [name=enlace]").val());
            $("#" + $("#editar").attr("id_elemento") + " img").attr("src", "../../uploads/banners/" + $("#editar").attr("id_elemento") + ".jpg?random" + Math.round(Math.random()*10));
            $("#lista_url_editar option[value='']").prop('selected', true);
            $("[name=file]").val("");
            $('#editar').foundation('close');
        });
    });

    /* Eliminar */
    $("body").on("click", ".eliminar", function(){
        $(".titulo_eliminar").text($(this).parent().parent().attr("descripcion"));
        $("#eliminar .si").attr("id_elemento", $(this).parent().parent().attr("id"));
    });

    $('#eliminar .si').on('click', function() {
        id_elemento = $(this).attr("id_elemento");
        $.ajax({
            url: "/api/banners/eliminar/" + id_elemento + "/",
            type: "post",
            dataType: "json"
        })
        .done(function(data){
            $("#" + data["respuesta"]).remove();
            $('#eliminar').foundation('close');
        });
    });

    /* Nuevo item */
    $("#formulario_nuevo_item").submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("formulario_nuevo_item"));

        $.ajax({
            url: $("#formulario_nuevo_item").attr("action"),
            type: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            $("#sortable").append("\
                <li id=\""+data["respuesta"]+"\" class=\"ui-state-default clearfix\" orden=\"" + data["respuesta"] + "\" descripcion=\"" + $("[name=descripcion]").val() + "\" enlace=\"" + $("[name=enlace]").val() + "\">\
                    <div class=\"column large-2\">\
                        <img src=\"../../uploads/banners/"+data["respuesta"]+".jpg\">\
                    </div>\
                    <div class=\"column large-6\">\
                        <span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>\
                        <div class=\"descripcion_texto\">" + $("[name=descripcion]").val() + "\</div>\
                    </div>\
                    <div class=\"column large-2 text-right\">\
                        <a data-open=\"editar\" class=\"editar\">Editar</a>\
                    </div>\
                    <div class=\"column large-2 text-right\">\
                        <a data-open=\"eliminar\" class=\"eliminar\">Eliminar</a>\
                    </div>\
                </li>\
            ");

            $("[name=descripcion]").val("");
            $("[name=enlace]").val("");
            $("[name=file]").val("");
            $("#lista_url option[value='']").prop('selected', true);
        });
    });

    /* Clase cerrar */

    $('.cerrar').on('click', function() {
        $('#eliminar').foundation('close');
    });

    $("#lista_url").change(function(){
        $("#formulario_nuevo_item [name=enlace]").val($(this).val());
    });

    $("#lista_url_editar").change(function(){
        $("#formulario_editar_item [name=enlace]").val($(this).val());
    });
});
