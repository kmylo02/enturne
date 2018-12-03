function getLocationConductoresContratados() {
    $("#panel_ruta").empty();
    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(successtracking1Contratados, onError, options);
    //loading();
}


function successtracking1Contratados(position) {
    //hideLoading();
    var altoVentana = window.innerHeight;
    var mapTrackCont, map_element_track_cont;
    $("div#morris-chart-area").css("height", altoVentana - 120);
    var myLocation = new google.maps.LatLng(4.6, -74.0833);
    var myOptions = {
        center: myLocation,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map_element_track_cont = document.getElementById("morris-chart-area");
    mapTrackCont = new google.maps.Map(map_element_track_cont, myOptions);
    var idCarga = $("#idCarga").val();
    $.getJSON(get_base_url() + "empresa/Ofertas/contratados_app_lista?jsoncallback=?", {idCarga: idCarga}).done(function (respuestaServer) {

        $.each(respuestaServer.contratados, function (x, contratados) {
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(contratados.Latitud, contratados.Longitud);
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var contenido = contratados.placa + "-" + contratados.nombre + " " + contratados.apellidos + "-" + contratados.celular + "<br>" + results[0].formatted_address;
                        var imgContratadosTracking = get_base_url() + 'uploads/img_apps/CONTRATADOS.png';
                        var marcador = new google.maps.Marker({
                            position: new google.maps.LatLng(contratados.Latitud, contratados.Longitud),
                            icon: imgContratadosTracking,
                            map: mapTrackCont
                                    //animation: google.maps.Animation.BOUNCE,
                        });
                        var infowindow_contratados = new google.maps.InfoWindow({
                            content: contenido
                        });
                        google.maps.event.addListener(marcador, 'click', function () {
                            infowindow_contratados.open(mapTrackCont, marcador);
                        });
                    } else {
                        alert('No se encontraron resultados');
                    }
                } else {
                    alert('Fallo al codificar coordenadas: ' + status);
                }
            });
        })
    })
}

function getLocationConductoresAplicando() {
    $("#panel_ruta").empty();
    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(successtracking1Aplicando, onError, options);
    //loading();
}

function successtracking1Aplicando(position) {
    //hideLoading();
    var altoVentana = window.innerHeight;
    var mapTrackApl, map_element_trackapl;

    $("div#morris-chart-area").css("height", altoVentana - 120);

    var myLocation = new google.maps.LatLng(4.6, -74.0833);

    var myOptions = {
        center: myLocation,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map_element_trackapl = document.getElementById("morris-chart-area");
    mapTrackApl = new google.maps.Map(map_element_trackapl, myOptions);
    var idCarga = $("#idCarga").val();
    $.getJSON(get_base_url() + "empresa/Ofertas/aplicando_x_oferta?jsoncallback=?", {idCarga: idCarga}).done(function (respuestaServer) {
        $.each(respuestaServer.aplicando, function (x, aplicando) {
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(aplicando.Latitud, aplicando.Longitud);
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var contenido = aplicando.placa + "-" + aplicando.nombre + " " + aplicando.apellidos + "-" + aplicando.celular + "<br>" + results[0].formatted_address;
                        var imgAplicandoXoferta = get_base_url() + 'uploads/img_apps/APLICANDO.png';
                        var marker_aplicando = new google.maps.Marker({
                            position: new google.maps.LatLng(aplicando.Latitud, aplicando.Longitud),
                            icon: imgAplicandoXoferta,
                            map: mapTrackApl
                                    //animation: google.maps.Animation.BOUNCE,
                        });
                        var infowindow = new google.maps.InfoWindow({
                            content: contenido
                        });
                        google.maps.event.addListener(marker_aplicando, 'click', function () {
                            infowindow.open(mapTrackApl, marker_aplicando);
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

function getLocationAplicando() {

    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(mapaAplicando, onError, options);
    //loading();
}

function mapaAplicando(position) {
    //hideLoading();
    var altoVentana = window.innerHeight;
    var mapApl, map_element_apl;
    $("div#mapa").css("height", altoVentana - 120);

    var myLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    var myOptions = {
        center: myLocation,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map_element_apl = document.getElementById("mapa");
    mapApl = new google.maps.Map(map_element_apl, myOptions);

    var imgAplicando = get_base_url() + 'uploads/img_apps/APLICANDO.png';
    var id1 = $("#id1").val();
    var idUsuario = $("#idUsuario").val();
    $.getJSON(get_base_url() + "empresa/Ofertas/aplicando_app?jsoncallback=?", {id1: id1, idUsuario: idUsuario}).done(function (respuestaServer) {
        if (respuestaServer["validacion"] == "ok") {
            $.each(respuestaServer["aplicando"], function (x, aplicando) {

                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(aplicando.Latitud, aplicando.Longitud);

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var contenido = aplicando.placa + "<br>" + results[0].formatted_address;
                            var marker_aplicando = new google.maps.Marker({
                                position: new google.maps.LatLng(aplicando.Latitud, aplicando.Longitud),
                                map: mapApl,
                                icon: imgAplicando,
                                //animation: google.maps.Animation.BOUNCE,
                            });
                            var infowindow = new google.maps.InfoWindow({
                                content: contenido
                            });
                            google.maps.event.addListener(marker_aplicando, 'click', function () {
                                infowindow.open(mapApl, marker_aplicando);
                            });
                        } else {
                            alert('No se encontraron resultados!');
                        }
                    } else {
                        alert('Fallo al codificar coordenadas: ' + status);
                    }
                });
            });
        }
    });
}

function getLocationContratados() {

    var options = {
        frequency: 1000, enableHighAccuracy: true
    };

    var watchId = navigator.geolocation.getCurrentPosition(mapaContratados, onError, options);
    //loading();
}

function mapaContratados(position) {
    //hideLoading();
    var altoVentana = window.innerHeight;
    var mapCont, map_element_cont;

    $("div#mapa").css("height", altoVentana - 120);

    var myLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    var myOptions = {
        center: myLocation,
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map_element_cont = document.getElementById("mapa");
    mapCont = new google.maps.Map(map_element_cont, myOptions);

    var imgContratados = get_base_url() + 'uploads/img_apps/CONTRATADOS.png';
    var id1 = $("#id1").val();
    var idUsuario = $("#idUsuario").val();
    $.getJSON(get_base_url() + "empresa/Ofertas/contratados_app?jsoncallback=?", {id1: id1, idUsuario: idUsuario}).done(function (respuestaServer) {
        if (respuestaServer["validacion"] == "ok") {
            $.each(respuestaServer["contratados"], function (x, contratados) {
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(contratados.Latitud, contratados.Longitud);

                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var contenido = contratados.placa + "<br>" + results[0].formatted_address;
                            var marcador = new google.maps.Marker({
                                position: new google.maps.LatLng(contratados.Latitud, contratados.Longitud),
                                map: mapCont,
                                icon: imgContratados,
                                //animation: google.maps.Animation.BOUNCE,
                            });
                            var infowindow_contratados = new google.maps.InfoWindow({
                                content: contenido
                            });
                            google.maps.event.addListener(marcador, 'click', function () {
                                infowindow_contratados.open(mapCont, marcador);
                            });
                        } else {
                            alert('No se encontraron resultados!');
                        }
                    } else {
                        alert('Fallo al codificar coordenadas: ' + status);
                    }
                });
            });
        }
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
    $.getJSON(get_base_url() + "admin/Gps/get_datos_satelital?jsoncallback=?", {idv: idv}).done(function (respuestaServer) {
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
                            $.getJSON(get_base_url() + "admin/Gps/get_ultimo_movimiento?jsoncallback=?", {idv: idv}).done(function (respuestaServer) {
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
    $('#cargando').show();
}

function hideLoading() {
    $('#cargando').hide();
}

function onError(error) {
    alert('Lo sentimos, es imposible obtener su ubicación , pongase en un espacio exterior.');
}

function rockAndRoll() {
    $("#panel_ruta").empty();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    var map_ruta = new google.maps.Map(document.getElementById('morris-chart-area'), {
        scrollwheel: false,
        zoom: 7
    });

    var request = {
        origin: $("#origen").val() + "," + $("#dpto_origen").val(),
        destination: $("#destino").val() + "," + $("#dpto_destino").val(),
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.DirectionsUnitSystem.METRIC,
        provideRouteAlternatives: true
    };

    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setMap(map_ruta);
            directionsDisplay.setPanel($("#panel_ruta").get(0));
            directionsDisplay.setDirections(response);
        } else {
            alert('No existen rutas entre ambos puntos');
        }
    });
}