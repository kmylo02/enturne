$(document).on("ready");
function consultaSos() {
    var contIni = $("#numsos").html();
    $.ajax({
        url: get_base_url() + "empresa/Alertas/get_contsos",
        success: function (resp) {
            if (resp!== '' && resp !== contIni) {
                $("#numsos").html(resp);
            } else {
                $("#numsos").html(0);
            }
            if (resp > contIni) {
                $("#numsos").html(resp);
                ion.sound({
                    sounds: [
                        {name: "sirena"}
                    ],

                    // main config
                    path: get_base_url() + "assets/js/ion.sound/sounds/",
                    preload: true,
                    multiplay: true,
                    volume: 0.9
                });

                // play sound
                ion.sound.play("sirena");
            }
        }
    });
}
;

function consultaRepo() {
    var contIni = $("#numrepo").html();
    $.ajax({
        url: get_base_url() + "empresa/Alertas/get_contrep",
        success: function (resp) {
            if (resp!=='' && resp !== contIni) {
                $("#numrepo").html(resp);
            } else {
                $("#numrepo").html(0);
            }
            if (resp > contIni) {
                $("#numrepo").html(resp);
                ion.sound({
                    sounds: [
                        {name: "reporte"}
                    ],

                    // main config
                    path: get_base_url() + "assets/js/ion.sound/sounds/",
                    preload: true,
                    multiplay: true,
                    volume: 0.9
                });

                // play sound
                ion.sound.play("reporte");
            }
        }
    });
}
;

function elimSos(id) {
    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea dar por resuelta la llamadad de auxilio?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo
        alertify.success('Has confirmado');
        url = get_base_url() + "empresa/Alertas/cerrar_sos";

        $.ajax({
            url: url,
            type: "post",
            data: {id: id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "SOS resuelta",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "empresa/Alertas/get_soss";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}
function checkRepo(id) {
    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea dar por visto este reporte?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo
        alertify.success('Has confirmado');
        url = get_base_url() + "empresa/Alertas/cerrar_reporte";

        $.ajax({
            url: url,
            type: "post",
            data: {id: id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Reporte visto",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "empresa/Mensajes/get_reportes";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}
function vence_soat() {
    url = get_base_url() + "empresa/Dashboard/very_soat";
    $.ajax({
        url: url,
        type: 'POST',
        success: function (resp) {
            if (resp) {
                swal({
                    title: "Atención!",
                    text: resp,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Entendido",
                    cancelButtonText: "No recordar",
                    closeOnConfirm: false
                }).then(function () {

                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        $.ajax({
                            url: get_base_url() + "empresa/Dashboard/cancel_recordatorio_soat",
                            type: 'POST',
                            success: function (res) {
                                if (res === 'ok') {
                                    swal({
                                        title: "Exito!",
                                        text: "Recordatorio cancelado",
                                        type: "success",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false
                                    });
                                } else {
                                    swal("Aceptar", "Error en bbdd!", "error");
                                }
                            }
                        });

                    }
                });
            }
        }
    });
}
function vence_rtm() {
    url = get_base_url() + "empresa/Dashboard/very_rtm";
    $.ajax({
        url: url,
        type: 'POST',
        success: function (resp) {
            if (resp) {
                swal({
                    title: "Atención!",
                    text: resp,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Entendido",
                    cancelButtonText: "No recordar",
                    closeOnConfirm: false
                }).then(function () {
                    vence_licenturne();
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        $.ajax({
                            url: get_base_url() + "empresa/Dashboard/cancel_recordatorio_rtm",
                            type: 'POST',
                            success: function (res) {
                                if (res === 'ok') {
                                    swal({
                                        title: "Exito!",
                                        text: "Recordatorio cancelado",
                                        type: "success",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false
                                    });
                                } else {
                                    swal("Aceptar", "Error en bbdd!", "error");
                                }
                            }
                        });
                        vence_licenturne();
                    }
                });
            }
        }
    });
}
function vence_licenturne() {
    url = get_base_url() + "empresa/Dashboard/very_licenturne";
    $.ajax({
        url: url,
        type: 'POST',
        success: function (resp) {
            if (resp) {
                swal({
                    title: "Atención!",
                    text: resp,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Entendido",
                    cancelButtonText: "No recordar",
                    closeOnConfirm: false
                }).then(function () {

                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        $.ajax({
                            url: get_base_url() + "empresa/Dashboard/cancel_recordatorio_lice",
                            type: 'POST',
                            success: function (res) {
                                if (res === 'ok') {
                                    swal({
                                        title: "Exito!",
                                        text: "Recordatorio cancelado",
                                        type: "success",
                                        confirmButtonText: "Ok",
                                        closeOnConfirm: false
                                    });
                                } else {
                                    swal("Aceptar", "Error en bbdd!", "error");
                                }
                            }
                        });
                    }
                });
            }
        }
    });
}
setInterval(consultaSos, 5000);
setInterval(consultaRepo, 5000);
setInterval(vence_licenturne, 240000);
setInterval(vence_soat, 300000);
setInterval(vence_rtm, 320000);
