function cargarNombre(valor)
{
    
    var arrayValores=new Array(
        new Array('Lenguaje de programacion','JavaScript',"JavaScript"),
        new Array('Lenguaje de programacion','Java',"Java"),
        new Array('Lenguaje de programacion','PHP',"PHP"),
        new Array('Lenguaje de programacion','Python',"Python"),
        new Array('Lenguaje de programacion','C#',"C#"),
        new Array('Lenguaje de programacion','C++',"C++"),
        new Array('Lenguaje de programacion','C',"C"),
        new Array('Tecnologias web','HTML',"HTML"),
        new Array('Tecnologias web','CSS',"CSS"),
        new Array('Tecnologias web','JavaScript',"JavaScript"),
        new Array('Tecnologias web','PHP',"PHP"),
        new Array('Idiomas','Ingles',"Ingles"),
        new Array('Idiomas','Frances',"Frances"),
        new Array('Idiomas','Portugues',"Portugues")
    );
    if(valor==0)
    {
        // desactivamos el segundo select
        document.getElementById("nombre").disabled=true;
    }else{
        // eliminamos todos los posibles valores que contenga el nombre
        document.getElementById("nombre").options.length=0;
 
        // añadimos los nuevos valores al nombre
        document.getElementById("nombre").options[0]=new Option("Selecciona una opcion", "0");
        for(i=0;i<arrayValores.length;i++)
        {
            // unicamente añadimos las opciones que pertenecen al id seleccionado
            // del primer select
            if(arrayValores[i][0]==valor)
            {
                document.getElementById("nombre").options[document.getElementById("nombre").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
 
        // habilitamos el segundo select
        document.getElementById("nombre").disabled=false;
    }
}
 
/**
 * Una vez selecciona una valor del segundo selecte, obtenemos la información
 * de los dos selects y la mostramos
 */
function seleccinado_nombre(value)
{
    var v1 = document.getElementById("tipo");
    var valor1 = v1.options[v1.selectedIndex].value;
    var text1 = v1.options[v1.selectedIndex].text;
    var v2 = document.getElementById("nombre");
    var valor2 = v2.options[v2.selectedIndex].value;
    var text2 = v2.options[v2.selectedIndex].text;
 
}