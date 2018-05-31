function cargarCaracteristicas(valor)
{
//hace una peticion ajax

    if (valor == "") { //valida vuando viene vacio
        document.getElementById("caracteristica").innerHTML = ""; //// si el valor viene vacio o no tiene un valor va a limpiar el combobox de caracteristicas
        $('.comboCar').prop('disabled', true); 
        $('.comboCar').selectpicker('refresh');
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }


        xmlhttp.onreadystatechange = function() { //listener que estara esperando la respuesta y si esta bien hace lo otro
            if (this.readyState == 4 && this.status == 200) {//Cuando el resultado es OK

                document.getElementById("caracteristica").innerHTML = this.responseText;//la respuesta que recibio de seleccionarcaracteristicas.php y luego le dice que le va a meter un html que en este caso es el campo de caracteristica del formulario
                document.getElementById("caracteristica").disabled=false;               // habilitamos el segundo select
                $('.comboCar').prop('disabled', false);// se le habilita a mano porque el buscador no lo hace solo porque libreria boostraop-select lo necesita
                $('.comboCar').selectpicker('refresh');
                //alert(this.responseText); //para ver que devolvio la petición
            }

        };

        //open primero le dice si es de tipo get o post, despues la url donde va a ser la consulta y en este caso como es de tipo get se le manda el parametro ahi mismo, despues se le especifica si va a ser asincrono o no en este caso al poner true le decimos que si es asincrono
        xmlhttp.open("GET","../seleccionarcaracteristicas.php?valor="+valor,true);//primer parametro es GET ó POST, Segundo es es link y el tercero para hacerlo Asíncrono
        xmlhttp.send();//send ya manda la peticion, *NOTA: si se usa POST se manda por parametros los datos
    }
}

var cont=0;//contador de filas

function agregarToList(){

    nombre=$("#caracteristica option:selected").text();
    id=$("#caracteristica option:selected").val();

    if(validarRepetido(id) == true){
        

        var fila='<tr><td id="cellmaterial"><input type="hidden" name="idCaracteristica[]" value="'+id+'">'+id+'</td> <td>'+nombre+'</td></tr>';
            
        $("#tabla").append(fila);
        cont++;
    }
    else{
        alert("Ya esta agregada esa caracteristica");
    }

}


function validarRepetido(id){//para validar que las caracteristicas no se repitan
        if(cont!=0){//si hay filas
            for($i=0;$i<cont;$i++){//se va a recorrer cada fila y sacarle el texto para compararlo con el que se selecciono actualmente
                valor = $('#tabla #cellmaterial').eq($i).text(); 

                if(valor == id){
                    return false;//esta repetido
                    break;
                }
            }
            return true;//no esta repetido
        }
        else{//si no hay no hace nada
            return true;
        }
    }