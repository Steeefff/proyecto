<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
/**
 * Funcion que se ejecuta al seleccionar una opcion del primer select
 */
function cargarSelect2(valor)
{
    /**
     * Este array contiene los valores sel segundo select
     * Los valores del mismo son:
     *  - hace referencia al value del primer select. Es para saber que valores
     *  mostrar una vez se haya seleccionado una opcion del primer select
     *  - value que se asignara
     *  - testo que se asignara
     */
    var arrayValores=new Array(
        new Array(1,1,"opcion1-1"),
        new Array(1,2,"opcion1-2"),
        new Array(1,3,"opcion1-3"),
        new Array(2,1,"opcion2-1"),
        new Array(3,1,"opcion3-1"),
        new Array(3,2,"opcion3-2"),
        new Array(3,3,"opcion3-3"),
        new Array(3,4,"opcion3-4")
    );
    if(valor==0)
    {
        // desactivamos el segundo select
        document.getElementById("select2").disabled=true;
    }else{
        // eliminamos todos los posibles valores que contenga el select2
        document.getElementById("select2").options.length=0;
 
        // añadimos los nuevos valores al select2
        document.getElementById("select2").options[0]=new Option("Selecciona una opcion", "0");
        for(i=0;i<arrayValores.length;i++)
        {
            // unicamente añadimos las opciones que pertenecen al id seleccionado
            // del primer select
            if(arrayValores[i][0]==valor)
            {
                document.getElementById("select2").options[document.getElementById("select2").options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
 
        // habilitamos el segundo select
        document.getElementById("select2").disabled=false;
    }
}
 
/**
 * Una vez selecciona una valor del segundo selecte, obtenemos la información
 * de los dos selects y la mostramos
 */
function seleccinado_select2(value)
{
    var v1 = document.getElementById("select1");
    var valor1 = v1.options[v1.selectedIndex].value;
    var text1 = v1.options[v1.selectedIndex].text;
    var v2 = document.getElementById("select2");
    var valor2 = v2.options[v2.selectedIndex].value;
    var text2 = v2.options[v2.selectedIndex].text;
 
    alert("Se ha seleccionado el valor "+valor1+" ("+text1+") del primer select y el valor "+valor2+" ("+text2+") del segundo select");
}
</script>
</head>
 
<body>
</body>
<form>
    <p>
        <select id='select1' onchange='cargarSelect2(this.value);'>
            <option value='0'>Selecciona una opcion</option>
            <option value='1'>opcion 1</option>
            <option value='2'>opcion 2</option>
            <option value='3'>opcion 3</option>
        </select>
    </p>
 
    <p>
        <select id='select2' onchange='seleccinado_select2();' disabled>
            <option value='0'>Selecciona una opcion</option>
        </select>
    </p>
</form>
</html>