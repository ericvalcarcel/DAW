//Zona Global Variables

//posición inicial del heroe
var varTop=348;
var varLeft=257;
//velocidad desplazamiento
var baseDesplaza=87;
var desplazamiento = 87;

function mover(direccion)
{
    //Zona Local Variables
    var divHeroe=document.getElementById("divHeroe");
    
    switch(direccion)
    {
        case "up":
            posicionar(-desplazamiento,0);
            break;
         case "upRight":
            posicionar(-desplazamiento,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "right":
            posicionar(0,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "downRight":
            posicionar(desplazamiento,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "down":
            posicionar(desplazamiento,0);
            break;
         case "downLeft":
            posicionar(desplazamiento,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break;
        case "left":
            posicionar(0,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break; 
        case "upLeft":
            posicionar(-desplazamiento,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break;
        
        default:
            alert("Raro,raro,raro...");
            break;    
    }
}

function posicionar (despTop,despLeft)
{    
    varTop+=despTop;
    varLeft+=despLeft;
    
    if(varTop < 0 )
    {
        varTop=0;
    }
    else if(varTop>348)
    {
        varTop=348;
    }
    
    if(varLeft < 0 )
    {
        varLeft=0;
    }
    else if(varLeft>514)
    {
        varLeft=514;
    } 
    
    var divHeroe=document.getElementById("divHeroe");
    divHeroe.style.top=varTop+"px";
    divHeroe.style.left=varLeft+"px";    

    var posicion = document.getElementById("posicion");
    posicion.innerHTML="( "+varTop+" , "+varLeft+" )";    
}

function reset()
{
    varTop=348;
    varLeft=257;    
    
    var divHeroe=document.getElementById("divHeroe");
    divHeroe.classList.add("invisible");
    divHeroe.style.top=varTop+"px";
    divHeroe.style.left=varLeft+"px";    

    var posicion = document.getElementById("posicion");
    posicion.innerHTML="( "+varTop+" , "+varLeft+" )";
    
}
function set()
{
    var divHeroe=document.getElementById("divHeroe");
    divHeroe.classList.remove("invisible");
    
    divHeroe.classList.remove("derecha");
}

function ajustar()
{
    var rngSpeed= parseInt(document.getElementById("rngSpeed").value);
    desplazamiento= baseDesplaza * rngSpeed;
}

function moverPorTeclado(evt)
{
    var tecla = evt.keyCode;
    var letra = String.fromCharCode(tecla).toLowerCase();

    //Letras aceptadas: a, w, z, s, q, e, x, <
    switch(letra)
    {
        case "w":
            posicionar(-desplazamiento,0);
            break;
         case "e":
            posicionar(-desplazamiento,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "s":
            posicionar(0,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "x":
            posicionar(desplazamiento,desplazamiento*3/2);
            divHeroe.classList.add("derecha");
            break;
        case "z":
            posicionar(desplazamiento,0);
            break;
         case "<":
            posicionar(desplazamiento,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break;
        case "a":
            posicionar(0,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break; 
        case "q":
            posicionar(-desplazamiento,-desplazamiento*3/2);
            divHeroe.classList.remove("derecha");
            break;
        
        default:
            break;    
    }

}