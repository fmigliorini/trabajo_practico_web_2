$(document).ready(function(){
    if ( $("#mapa") ) {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(cargarMapa,error);
        } else {
            alert("Dispositivo sin soporte de geolocalización");
        }

        function cargarMapa(pos) { // siempre recive pos ya que es llamada desde navigator.
            var lat = pos.coords.latitude;
            var long = pos.coords.longitude;
            console.log(lat,long);
            var contenedor = $("mapa");
            $("#longitud").val(lat);
            $("#latitud").val(long);

            var mapOptions = {
                center:new google.maps.LatLng(lat,long),
                zoom:12,
                panControl: false,
                zoomControl: false,
                scaleControl: false,
                mapTypeControl:false,
                streetViewControl:true,
                overviewMapControl:true,
                rotateControl:true,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat,long),
                map: map
            });
        }

        function error()
        {
            alert("Algo ha salido mal");
        }
    }
})
