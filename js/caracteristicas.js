function cargarCaracteristicas(valor)
{

    if (valor == "") {
        document.getElementById("caracteristica").innerHTML = "";
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

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {//Cuando el resultado es OK
                document.getElementById("caracteristica").innerHTML = this.responseText;
                document.getElementById("caracteristica").disabled=false;               // habilitamos el segundo select
                $('.comboCar').prop('disabled', false);
                $('.comboCar').selectpicker('refresh');
                //alert(this.responseText); //para ver que devolvio la petición
            }

        };

        xmlhttp.open("GET","seleccionarcaracteristicas.php?valor="+valor,true);//primer parametro es GET ó POST, Segundo es es link y el tercero para hacerlo Asíncrono
        xmlhttp.send();//si se usa POST se pueden mandar por parametros los datos
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