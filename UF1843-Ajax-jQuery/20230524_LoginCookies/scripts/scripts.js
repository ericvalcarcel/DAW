$(function()
{
    //Si la página es diferente de login
    //Mirar si existe la cookie del nombre
    //Si no existe, redirigir a login
    //Si existe, se deja entrar en la página
    if (location.href.indexOf("login") == -1)
    {
        //No se está cargando la página de login
        //Si existe la cookie, entrar en la página
        if (!cookieExists("nombre"))
        {
            location.href="login.html";
        }

        //Mostrar el nombre del usuario en la parte derecha, con el color preferido
        let nombre = getCookie("nombre");
        let color = getCookie("colorPreferido");
        $("#login").html("<span style='color: "+color+";'>"+nombre+"</span><br/><a href='javascript:logout();'>logout</a>");
    }
    else
    {
        if (cookieExists("nombre"))
        {
            location.href="index.html";
        }
    }


    //Login
    $("#btnEntrar").click(function()
    {
        //Recoger NIF y passwords y validarlos
        let nif = $("#txtNif").val();
        let pass = $("#pasContrasena").val();

        //Validación por javascript
        if(nif == "" || pass == "")
        {
            $("#divMensaje").html("Debe introducir datos válidos.");
        }
        else
        {
            //Ajax para validar credenciales
            $.post("validar.php",
            {
                n: nif,
                p: pass
            },
            function(resp)
            {
                //Update UI
                if(resp != "ko")
                {
                    //Credenciales válidas

                    //Guardar las cookies
                    setCookie("nombre",resp,365);
                    setCookie("dni",nif,365);
                    setCookie("colorPreferido","#ff0000",365);

                    //Redirigimnos a inicio
                    location.href="index.html";
                }
                else
                {
                    //Credenciales inválidas
                    $("#divMensaje").html("Credenciales incorrectas.");
                    $("#txtNif").val("");
                    $("#pasContrasena").val("");
                    $("#txtNif").focus();
                }
            });

        }


    });


});


function logout()
{
    //Eliminar las cookies 
    deleteCookie("nombre");
    deleteCookie("dni");
    deleteCookie("colorPreferido");

    //Redirigir a login
    location.href="login.html";
}