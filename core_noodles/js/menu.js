
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
                url: "/api/menu/reorganizar/" + type + "/",
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
            $("#" + $("#editar").attr("id_elemento") + " .descripcion_texto").html( "<i class=\"fi-list\"></i> " + $("#editar [name=descripcion]").val());
            $("#" + $("#editar").attr("id_elemento")).attr("descripcion", $("#editar [name=descripcion]").val());
            $("#" + $("#editar").attr("id_elemento")).attr("enlace", $("#editar [name=enlace]").val());
            $("#lista_url_editar option[value='']").prop('selected', true);
            $('#editar').foundation('close');
            $("[name=file]").val("");
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
            url: "/api/menu/eliminar/" + type + "/" + id_elemento + "/",
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
            url:            $("#formulario_nuevo_item").attr("action"),
            type:           "post",
            dataType:       "json",
            data:           formData,
            cache:          false,
            contentType:    false,
            processData:    false
        })
        .done(function(data){
            if(type == "menu"){
                column_big 	= 6;
                show_column	= "";
            }else{
                column_big 	= 8;
                show_column	= "display:none";
            }

            $("#sortable").append("\
                <li id=\""+data["respuesta"]+"\" class=\"ui-state-default clearfix\" orden=\"" + data["respuesta"] + "\" descripcion=\"" + $("[name=descripcion]").val() + "\" enlace=\"" + $("[name=enlace]").val() + "\">\
                    <div class=\"column small-" + column_big + "\">\
                        <div class=\"descripcion_texto\"><i class=\"fi-list\"></i> " + $("[name=descripcion]").val() + "\</div>\
                    </div>\
                    <div class=\"column small-2 text-right\">\
                        <a data-open=\"editar\" class=\"editar\">Editar</a>\
                    </div>\
                    <div class=\"column small-2 text-right\">\
                        <a data-open=\"eliminar\" class=\"eliminar\">Eliminar</a>\
                    </div>\
                    <div class=\"column small-2 text-right\" style=\"" + show_column + "\">\
                        <a href=\"" + data["respuesta"] + "/\">Submenu</a>\
                    </div>\
                </li>\
            ");

            $("[name=descripcion]").val("");
            $("[name=enlace]").val("");
            $("#lista_url option[value='']").prop('selected', true);
            $("[name=file]").val("");
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
