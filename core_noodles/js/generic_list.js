$(".eliminar").click(function(e){
    //$('#eliminar_descripcion').text($(this).attr("id-elemento"));
    $('#eliminar_descripcion').text($(this).parent().parent().find("h3").text());
    id_articulo_global = $(this).attr("id-elemento");
});

$("#eliminar_cancelar").click(function(e){
    $('#modal_eliminar').foundation('close');
});

$("#eliminar_eliminar").click(function(e){
    click_this = this;
    $.ajax({
        url: "/core_noodles/post/post.php?type=" + type_dir + "_delete&id=" + id_articulo_global,
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

$('#busqueda').keyup(function(){
    $('.lista_elementos_editar').hide();
    $('.lista_elementos_editar').each(function(){
        var txt = $('#busqueda').val();
        if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
            $(this).show();
        }
    });
});
