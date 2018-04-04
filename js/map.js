


//VARIABLES GLOBALES
var map;
var marker;
var hayMarcador="false";


window.onload = function() {


	
	var mapDiv = document.getElementById('map');//obtenemos la etiqueta donde generaremos el mapa

	var SanJose = new google.maps.LatLng(9.927158,-84.089313);

	var options = {
		zoom: 13,
		center: SanJose,//centro donde inicia el mapa
		mapTypeId: google.maps.MapTypeId.ROADMAP//tipo de mapa ya sea satelital o mapa normal

	};

	map = new google.maps.Map(mapDiv, options); //creando el mapa en la etiqueta especificada("map") con las opciones que queremos pasarle y lo guardado en una variable llamada "mapa"


	addMarker(SanJose);
	//Evento para cuando se haga click se ponga un marcador
	/*map.addListener('click', function(event) {
          addMarker(event.latLng);//event.latLng trae la posicion donde yo di click y la manda por parametro al metodo addMarker
    });*/

}

//PARA AGREGAR UN MARCADOR
function addMarker(location) {

	//if(hayMarcador=="false"){ // if nos especifica que solo se pueda poner un marcador sino se ponen todos los marcadores que queramos cada vez que hacemos click
          marker = new google.maps.Marker({
          position: location, //la que recibimos por ´parametro del usuario donde toco el mapa´
          draggable:true,//para mover el marcador
          animation: google.maps.Animation.DROP,//animacion para que caiga el marcador
          map: map//le pasa el mapa para poder ser dibujado
        });
		marker.addListener('click', toggleBounce);//si se le da click al marcador, llama al metodo que hace que salte el marcador

		//hayMarcador="true";
	//}
}

//PARA HACER SALTAR AL MARCADOR
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}


function onEnviar(){
       document.getElementById("latitud").value=marker.getPosition().lat();
       document.getElementById("longitud").value=marker.getPosition().lng();

}