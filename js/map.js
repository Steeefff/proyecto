

window.onload = function() {

	var mapDiv = document.getElementById('map');//obtenemos la etiqueta donde generaremos el mapa

	var SanJose = new google.maps.LatLng(9.9356124,-84.1483648);

	var options = {
		center: SanJose,//centro donde inicia el mapa
		zoom: 8,
		mapTypeId: google.maps.MapTypeId.ROADMAP//tipo de mapa ya sea satelital o mapa normal

	};

	var mapa = new google.maps.Map(mapDiv, options); //creando el mapa en la etiqueta especificada("map") con las opciones que queremos pasarle y lo guardado en una variable llamada "mapa"


}