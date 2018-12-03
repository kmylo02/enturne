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
        url = get_base_url() + "empresa/Empleo/crear_vacante";
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
function postularVacante(idVacante) {
    swal({
        title: "Esta seguro que desea aplicar a esta vacante de empleo?",
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
            type: "POST",
            data: {idVacante},
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
                        text: "Ya estas aplicando para esta vancate.",
                        type: "warning",
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
    url = get_base_url() + "empresa/Empleo/detalle_vacante";
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
        url = get_base_url() + "empresa/Empleo/contratar_conductor";
        $.ajax({
            url: url,
            type: $("#frm_asignar_vehiculo_empresa").attr("method"),
            data: $("#frm_asignar_vehiculo_empresa").serialize(),
            success: function (resp) {
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        text: "Conductor contratado correctamente .",
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    }).then(function () {
                        window.location.href = get_base_url() + 'empresa/Empleo/Ofertas_Empleo';
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
        url = get_base_url() + "empresa/Empleo/cerrar_vacante";
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
                        window.location.href = get_base_url() + 'empresa/Empleo/Ofertas_Empleo';
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
        url = get_base_url() + "empresa/Empleo/cerrar_vacante";
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
                        window.location.href = get_base_url() + 'empresa/Empleo/Ofertas_Empleo';
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
        url = get_base_url() + "empresa/Empleo/finalizar_contrato_empleo";
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



