function getLocationCarga() {
    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(successtrackingCarga, onError, options);
    loading();
}


function successtrackingCarga(position) {
    hideLoading();
    var altoVentana = window.innerHeight;
    $("div#morris-chart-area").css("height", altoVentana - 120);
    var myLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var myOptions = {
        center: myLocation,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map_element = document.getElementById("morris-chart-area");
    map = new google.maps.Map(map_element, myOptions);
    var image = get_base_url() + 'uploads/img_apps/APLICANDO.png';
    var meinfo = new google.maps.InfoWindow({
        content: "Usted está aquí"
    });
    var me = new google.maps.Marker({
        position: myLocation,
        icon: image,
        map: map,
        animation: google.maps.Animation.DROP
    });
    google.maps.event.addListener(me, 'click', function () {
        meinfo.open(map, me);
    });
    $.getJSON(get_base_url() + "conductor/Ofertas/get_mapa_ofertas?jsoncallback=?").done(function (respuestaServer) {

        $.each(respuestaServer.ofertas, function (x, ofertas) {
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(ofertas.Latitud, ofertas.Longitud);
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var contenido = ofertas.origen + "-" + ofertas.destino + " " + ofertas.nombre_empresa + "-" + ofertas.telefono + "<br>" + results[0].formatted_address;
                        var imgCarga = get_base_url() + 'uploads/img_apps/carga.png';
                        var marcador = new google.maps.Marker({
                            position: new google.maps.LatLng(ofertas.Latitud, ofertas.Longitud),
                            icon: imgCarga,
                            map: map
                                    //animation: google.maps.Animation.BOUNCE,
                        });
                        var infowindow_contratados = new google.maps.InfoWindow({
                            content: contenido
                        });
                        google.maps.event.addListener(marcador, 'click', function () {
                            infowindow_contratados.open(map, marcador);
                        });
                    } else {
                        alert('No se encontraron resultados');
                    }
                } else {
                    alert('Fallo al codificar coordenadas: ' + status);
                }
            });
        });
    });
}
function getLocationSatelital() {
    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(successtracking, onError, options);
    loading();
}


function successtracking(position) {
    hideLoading();
    var altoVentana = window.innerHeight;
    $("div#morris-chart-area").css("height", altoVentana - 120);
    var idv = $("#selector").val();
    $.getJSON(get_base_url() + "conductor/Gps/get_datos_satelital?jsoncallback=?", {idv: idv}).done(function (respuestaServer) {
        if (respuestaServer.vehiculo === false) {
            swal({
                title: "Atención!",
                text: "El vehiculo seleccionado no tiene activado GPS satelital.",
                type: "warning",
                confirmButtonText: "Entendido",
                closeOnConfirm: true
            });
            getLocation();
        } else {
            $.each(respuestaServer.vehiculo, function (x, vehiculo) {
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(vehiculo.latitud, vehiculo.longitud);
                var myOptions = {
                    center: latlng,
                    zoom: 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map_element = document.getElementById("morris-chart-area");
                map = new google.maps.Map(map_element, myOptions);
                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $.getJSON(get_base_url() + "conductor/Gps/get_ultimo_movimiento?jsoncallback=?", {idv: idv}).done(function (respuestaServer) {
                                $.each(respuestaServer.mov, function (x, mov) {
                                    var estado = mov.nombreevento;
                                    if (estado === "DEFAULT") {
                                        estado = "Estacionado";
                                    }
                                    var velocidad = mov.velocidad;
                                    if (velocidad === "") {
                                        velocidad = "0";
                                    }
                                    var fecha = mov.created_at;
                                    var contenido = "Fecha y Hora: " + fecha + "<br>" + "Ultima Ubicación: " + results[0].formatted_address + "<br>Velocidad: " + velocidad + "Km/h<br>Estado: " + estado;
                                    var imgCarga = get_base_url() + 'uploads/img_apps/CONTRATADOS.png';
                                    var marcador = new google.maps.Marker({
                                        position: new google.maps.LatLng(vehiculo.latitud, vehiculo.longitud),
                                        icon: imgCarga,
                                        map: map,
                                        animation: google.maps.Animation.BOUNCE,
                                    });
                                    var infowindow_contratados = new google.maps.InfoWindow({
                                        content: contenido
                                    });
                                    google.maps.event.addListener(marcador, 'click', function () {
                                        infowindow_contratados.open(map, marcador);
                                    });
                                });
                            });
                        } else {
                            alert('No se encontraron resultados');
                        }
                    } else {
                        alert('Fallo al codificar coordenadas: ' + status);
                    }
                });
            })
        }
        ;
    });
}
function getLocation() {
    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(success, onError, options);
    loading();
}
function success(position) {
    hideLoading();
    $("#controles_satelital").show();
    $("#cargar_mapa").hide();
    $("#titulo_mapa").show();
    var altoVentana = window.innerHeight;
    $("div#morris-chart-area").css("height", altoVentana - 120);
    var myLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var myOptions = {
        center: myLocation,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map_element = document.getElementById("morris-chart-area");
    map = new google.maps.Map(map_element, myOptions);
}
function loading() {
    $('#loader').show();
}

function hideLoading() {
    $('#loader').hide();
}

function onError(error) {
    alert('Lo sentimos, es imposible obtener su ubicación , pongase en un espacio exterior.');
}
