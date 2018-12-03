$(document).ready(function () {
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
    $('#dataTablet').DataTable({
        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});

jQuery(function ($) {

    $.datepicker.regional['es'] = {

        closeText: 'Cerrar',

        prevText: '&#x3c;Ant',

        nextText: 'Sig&#x3e;',

        currentText: 'Hoy',

        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',

            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],

        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',

            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],

        dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],

        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],

        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],

        weekHeader: 'Sm',

        dateFormat: 'dd/mm/yy',

        firstDay: 1,

        isRTL: false,

        showMonthAfterYear: false,

        yearSuffix: ''};

    $.datepicker.setDefaults($.datepicker.regional['es']);

});



$(function () {
    $("#fechanac").datepicker({dateFormat: 'y/mm/d'});
    $("#fechavenlic").datepicker({dateFormat: 'y/mm/d'});
});

$(document).ready(function () {
    $("#controles_satelital").hide();
    $("#div_Casado").hide();
    $("#combito").change(function () {
        var est_civil = $("#combito").val();
        if (est_civil === 'Casado' || est_civil === 'Unión Libre') {
            $("#div_Casado").show();
        } else {
            $("#div_Casado").hide();
        }
    });
    $("#combito").mouseover(function () {
        var est_civil = $("#combito").val();
        if (est_civil === 'Casado' || est_civil === 'Unión Libre') {
            $("#div_Casado").show();
        } else {
            $("#div_Casado").hide();
        }
    });
});

function tipo() {
    url = get_base_url() + "conductor/Perfil/update_tipo";
    $.ajax({
        url: url,
        type: $("#frmTipo").attr("method"),
        data: $("#frmTipo").serialize(),
        success: function (resp) {
            if (resp === "ok") {
                swal({
                    title: "Exito!",
                    text: "Tu registro se ha actualizado correctamente, por favor ingresa de nuevo para actualizar tu panel, gracias.",
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "Login";
                });
            }
            if (resp == "error") {
                swal({
                    title: "Error!",
                    text: "Error en bbdd",
                    type: "warning",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "conductor/Dashboard";
                });
            }
        }
    });
}
function addVehiculo() {
    swal({
        title: "Esta seguro de agregar el vehiculo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Perfil/guardar_vehiculo";
        $.ajax({
            url: url,
            type: $("#addVehiculoForm").attr("method"),
            data: $("#addVehiculoForm").serialize(),
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "El Vehículo que está registrando, ya ha sido creado\n\
  en la Plataforma Enturne. Favor contactarse con soporte. 0314968958",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Vehiculo agregado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

function aplicar(idCarga, idVehiculo) {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea aplicar a esta oferta?, su hoja de vida será enviada a la empresa.', null, null).set('labels', {ok: 'Si', cancel: 'No'});



    confirm.set({transition: 'slide'});



    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');

        url = get_base_url() + "conductor/Ofertas/aplicar_oferta_app";

        $.post(url, {idOferta: idCarga, idVehiculo: idVehiculo}).done(function () {

            alertify.alert("<b>Confirmación</b>", "Has aplicado a una oferta de carga, la empresa recibira tu hv y se pondra en contacto si desea contratarte, gracias.", function () {

                location.reload(true);

            });

        })

                .fail(function () {

                    alertify.alert("<b>Confirmación</b>", "Error en bbdd");

                })

    });

    confirm.set('oncancel', function () { //callbak al pulsar botón negativo

        alertify.error('Has Cancelado');

    });

}
;

function addRefPer() {
    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea agregar referencia personal?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "conductor/Perfil/guardar_refp";

        $.ajax({
            url: url,
            type: $("#frmRefper").attr("method"),
            data: $("#frmRefper").serialize(),
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
                        text: "Referencia guardada exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "conductor/Perfil/get_ref_per";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });

}
;

function addRefEmp() {
    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea agregar referencia empresarial?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "conductor/Perfil/guardar_ref_emp";

        $.ajax({
            url: url,
            type: $("#frmRefemp").attr("method"),
            data: $("#frmRefemp").serialize(),
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
                        text: "Referencia guardada exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "conductor/Perfil/get_ref_emp";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });

}
;
function updatePerfil() {
    swal({
        title: "Esta seguro que desea actualizar su perfil?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Perfil/edit_user";
        $.ajax({
            url: url,
            type: $("#frmPerfil").attr("method"),
            data: $("#frmPerfil").serialize(),
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Perfil actualizado exitosamente.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + "conductor/Perfil/completar_conductor";
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        type: "warning",
                        text: "No se ha realizado ningún cambio",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

function sos() {
    var lat = $("#lat").val();
    var long = $("#long").val();

    var dir = "";
    var latlng = new google.maps.LatLng(lat, long);
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({"latLng": latlng}, function (results, status)
    {
        if (status == google.maps.GeocoderStatus.OK)
        {
            if (results[0])
            {
                dir = results[0].formatted_address;
            } else
            {
                dir = "";
            }
        } else
        {
            dir = "";
        }

    });


    url = get_base_url() + "conductor/Alertas/sosWeb";
    $.ajax({
        url: url,
        type: "POST",
        data: dir,
        success: function (resp) {
            if (resp == "ko") {
                swal({
                    title: "Exito!",
                    text: "Aviso de SOS enviado",
                    type: "Success",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "conductor/Dashboard";
                })
            }
        }
    });
}
function addLic() {
    swal({
        title: "Esta seguro que desea adquirir esta licencia?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Licencias/adquirir_licencia";
        $.ajax({
            url: url,
            type: $("#frmLicencia").attr("method"),
            data: $("#frmLicencia").serialize(),
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y su vehiculo estara disponible para enturnar.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + "conductor/Perfil/get_vehiculos";
                    });
                }
                if (resp === "ko") {
                    swal({
                        title: "Aviso!",
                        text: "Usted ya ha hecho uso de su licencia gratuita, por favor adquiera una licencia de mesualidad o pago anual.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + "conductor/Perfil/get_vehiculos";
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function regPropietario() {
    swal({
        title: "Esta seguro que desea registrarse como propietario?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Perfil/reg_Propietario";
        $.ajax({
            url: url,
            type: "POST",
            data: {},
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Has quedado registrado como conductor porpietario, por favor volver a loguearse para activar su nuevo perfil.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url + 'Login';
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function enviarMsn() {
    url = get_base_url() + "conductor/Reportes/enviar_mensaje_web";
    $.ajax({
        url: url,
        type: $("#frmEnviarMsn").attr("method"),
        data: $("#frmEnviarMsn").serialize(),
        success: function (resp) {
            if (resp === "ok") {
                swal({
                    title: "Exito!",
                    text: "Mensaje enviado con exito.",
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }).then(function () {
                    location.reload();
                });
            }
            if (resp === "error") {
                swal({
                    title: "Aviso!",
                    text: "Error en bbdd.",
                    type: "warning",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }).then(function () {
                    location.reload();
                });
            }
        }
    });
}
function crearVacante() {
    swal({
        title: "Esta seguro que desea crear esta vacante de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/crear_vacante";
        $.ajax({
            url: url,
            type: $("#addVacanteForm").attr("method"),
            data: $("#addVacanteForm").serialize(),
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Has creado con exito la vacante de empleo.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function postularVacante(id) {
    swal({
        title: "Esta seguro que desea aplicar para esta vacante de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/aplicar_vacante";
        $.ajax({
            url: url,
            type: 'POST',
            data: {id},
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Has aplicado con exito a la vacante de empleo.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
                if (resp === "ko") {
                    swal({
                        title: "Aviso!",
                        text: "La oferta de empleo ya lleno su cupo, gracias.",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function detalleVacante(idVacante) {
    url = get_base_url() + "conductor/Empleo/detalle_vacante";
    $.ajax({
        url: url,
        type: 'POST',
        data: {idVacante},
        success: function (resp) {
            swal({
                title: "Detalle vacante de empleo " + idVacante,
                text: resp,
                confirmButtonText: "Ok",
                closeOnConfirm: false
            });
        }
    });
}
function contratarConductor() {
    swal({
        title: "Esta seguro que desea contratar esta conductor?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/contratar_conductor";
        $.ajax({
            url: url,
            type: $("#frm_asignar_vehiculo").attr("method"),
            data: $("#frm_asignar_vehiculo").serialize(),
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Conductor contratado correctamente .",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + 'conductor/Empleo/Ofertas_Empleo';
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function finalizarContrato(idOferta, idConductor) {
    swal({
        title: "Esta seguro que desea finalizar el contrato con este conductor?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/finalizar_contrato_empleo";
        $.ajax({
            url: url,
            type: 'POST',
            data: {idOferta, idConductor},
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Contrato finalizado correctamente .",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + 'conductor/Empleo/Ofertas_Empleo';
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function cerrarVacante(id) {
    swal({
        title: "Esta seguro que desea cerrar esta oferta de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/cerrar_vacante";
        $.ajax({
            url: url,
            type: 'POST',
            data: {id},
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Vacante eliminada correctamente .",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + 'conductor/Empleo/Ofertas_Empleo';
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function eliminarVacante(id) {
    swal({
        title: "Esta seguro que desea eliminar esta oferta de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "conductor/Empleo/eliminar_vacante";
        $.ajax({
            url: url,
            type: 'POST',
            data: {id},
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Vacante eliminada correctamente .",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + 'conductor/Empleo/Ofertas_Empleo';
                    });
                }
                if (resp === "error") {
                    swal({
                        title: "Aviso!",
                        text: "Error en bbdd.",
                        type: "warning",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function avisoSinVehiculos() {
    swal({
        title: "Aviso!",
        text: "Aún no tienes vehiculos para contratar conductores o tienes pendiente documentación o pago de licencia Enturne.",
        type: "warning",
        confirmButtonText: "Ok",
        closeOnConfirm: false
    }).then(function () {
        location.reload();
    });
}



