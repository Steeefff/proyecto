


//VARIABLES GLOBALES
var map;


window.onload = function() {


	
	var mapDiv = document.getElementById('map');//obtenemos la etiqueta donde generaremos el mapa

	var SanJose = new google.maps.LatLng(9.927158,-84.089313);

	var options = {
		zoom: 11,
		center: SanJose,//centro donde inicia el mapa
		mapTypeId: google.maps.MapTypeId.ROADMAP//tipo de mapa ya sea satelital o mapa normal

	};

	map = new google.maps.Map(mapDiv, options); //creando el mapa en la etiqueta especificada("map") con las opciones que queremos pasarle y lo guardado en una variable llamada "mapa"


	for(var i=0;i<locations.length;i++){ //recorre cada una de las empresas

		var ubicacion = new google.maps.LatLng(locations[i]['lat'],locations[i]['lng']);
		
		addMarker(ubicacion,locations[i]['nombre'],locations[i]['id']);
	}
	//Evento para cuando se haga click se ponga un marcador
	/*map.addListener('click', function(event) {
          addMarker(event.latLng);//event.latLng trae la posicion donde yo di click y la manda por parametro al metodo addMarker
    });*/

}

//PARA AGREGAR UN MARCADOR
function addMarker(location,name,id) {

	//if(hayMarcador=="false"){ // if nos especifica que solo se pueda poner un marcador sino se ponen todos los marcadores que queramos cada vez que hacemos click
        var marker = new google.maps.Marker({
          position: location, //la que recibimos por ´parametro del usuario donde toco el mapa´
          title:name,//nombre al poner el mouse encima del marcador
          draggable:false,//para no mover el marcador
          animation: google.maps.Animation.DROP,//animacion para que caiga el marcador
          map: map//le pasa el mapa para poder ser dibujado
        });


        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">'+name+'</h1>'+
            '<div id="bodyContent">'+
            '<p><a href="puestos_publicados.php?id='+id+'">'+
            'Ver puestos publicados '+
            '</p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

		marker.addListener('click', function(){
			infowindow.open(map,marker);
		});//si se le da click al marcador, llama al metodo que hace que salte el marcador

}

