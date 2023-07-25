var activo=false;
$(function()
{
    $("#menu a").click(function()
    {
        //Anular el comportamiento normal del enlace, 
        //de saltar a la página indicada en el href

        //MIrar si está el spinner cargado, y si es así, inhabilitar la siguiente petición
        if ($("#detalles").html().indexOf("spinner-border")>=0)
        {
            return false;
        }

        //Enseñar spinner
        $("#detalles").html("<div class='spinner-border' role='status'><span class='sr-only'></span></div>");

        //Capturar la url de destino
        let urlDestino = $(this).prop("href");

        //Ejecutar la página PHP y su contenido HTML incrustarlo en el div detalles
        $("#detalles").load(urlDestino);    //AJAX

        return false;
    });

});
