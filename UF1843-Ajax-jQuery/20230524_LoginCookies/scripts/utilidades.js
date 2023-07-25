/** Rutinas de fechas */

function getFecha(fecha, tipo)
{
    //Formato 1: dd/mm/yyyy
    //Formato 2: dd/mes/yyyy
    //Formato 3: d de mescompleto de yyyy
    //Formato 4: diasemana, d de mescompleto de yyyy
    //Formato 5: dd/mescompleto/yyyy

    var resultado = "";
    
    switch(tipo)
    {
        case 1:
            resultado = fecha.getDate().toString().padStart(2,"0") + "/" +
                        (fecha.getMonth()+1).toString().padStart(2,"0") + "/" +
                        fecha.getFullYear();
            break;

        case 2:
            resultado = fecha.getDate().toString().padStart(2,"0") + "/" +
                        getMes(fecha.getMonth(),2) + "/" +
                        fecha.getFullYear();
            break;

        case 3:
            resultado = fecha.getDate() + " de " +
                        getMes(fecha.getMonth(),1) + " de " +
                        fecha.getFullYear();
            break;

        case 4:
            resultado = getDiaSemana(fecha.getDay(),1) + ", " + 
                        fecha.getDate () + " de " +
                        getMes(fecha.getMonth(),1) + " de " +
                        fecha.getFullYear();
            break;
    }
 
    return resultado;
}

function getMes(mes,tipo)       // 2, 1
{
    var meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                    "Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    var resultado = "";

    resultado = (tipo==1) ? meses[mes] : meses[mes].substring(0,3);

    return resultado;
}

function getDiaSemana(dia,tipo)
{
    //1 - Día completo
    //2 - Día con 3 letras
    //3 - Día con 1 letra  OJO Miércoles

    var dias = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
    var resultado = "";

    switch(tipo)
    {
        case 1:
            resultado = dias[dia];
            break;

        case 2:
            resultado = dias[dia].substring(0,3);
            break;

        case 3:
            resultado = (dia==2) ? "X" : dias[dia].substring(0,1);
            break;
    }

    return resultado;
}


/** Rutinas de cookies */

//Grabar cookie
function setCookie(cname, cvalue, exdays) 
{
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//Obtener cookie
function getCookie(cname) 
{
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) 
    {
      let c = ca[i];
      while (c.charAt(0) == ' ') 
      {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) 
      {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

//Si existe la cookie
function cookieExists(name) 
{
  return document.cookie.split(';').some(function(cookie) 
  {
    return cookie.trim().startsWith(name + '=');
  });
}

//Borrar cookie
function deleteCookie(name) 
{
  document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
