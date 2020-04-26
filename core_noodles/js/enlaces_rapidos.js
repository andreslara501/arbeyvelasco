$(document).ready(function(){
    $("#enlaces_rapidos").submit(function(e){
        e.preventDefault();

        var formData = new FormData(document.getElementById("enlaces_rapidos"));

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
            $('#guardado').foundation('open');
        });
    });
});
