function concatenar()
{
    //Leer la frase 1
    var txtFrase1 = document.getElementById("txtFrase1");
    var frase1 = txtFrase1.value;

    //Leer la frase 2
    var txtFrase2 = document.getElementById("txtFrase2");
    var frase2 = txtFrase2.value;

    //Concatenar
    var frase = frase1 + " " + frase2;

    //Mostrar
    alert(frase);

    //Borrar el contenido de las cajas
    txtFrase1.value = "";
    txtFrase2.value = "";
    //txtFrase1.style.backgroundColor="yellow";
}

function concatenarDiv()
{
    //Leer la frase 1
    var txtFrase1 = document.getElementById("txtFrase1");
    var frase1 = txtFrase1.value;

    //Leer la frase 2
    var txtFrase2 = document.getElementById("txtFrase2");
    var frase2 = txtFrase2.value;

    //Concatenar
    var frase = frase1 + " " + frase2;

    //Mostrar en el div lateral
    var divLateral = document.getElementById("divLateral");

    //Preparo un alert danger
    var texto ="<div class='alert alert-danger'><strong>alert-danger </strong>" + frase + "</div>";

    divLateral.innerHTML = texto;
    

    //Borrar el contenido de las cajas
    txtFrase1.value = "";
    txtFrase2.value = "";
    //txtFrase1.style.backgroundColor="yellow";
}