var dt;
var id;
var openRows = new Array();
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
    dt = $('#dataTable').DataTable({
        "order": [[1, "desc"]],
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

        prevText: '<Ant',

        nextText: 'Sig>',

        currentText: 'Hoy',

        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',

            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],

        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',

            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],

        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],

        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],

        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],

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
    $("#fechavensoat").datepicker({dateFormat: 'y/mm/d'});
    $("#fechavenrtecno").datepicker({dateFormat: 'y/mm/d'});
});

function actPerfil() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea actualizar su perfil?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Perfil/edit_user";

        $.ajax({
            url: url,
            type: $("#actPerfilForm").attr("method"),
            data: $("#actPerfilForm").serialize(),
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
                        text: "Perfil actualizado exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Perfil/get_perfil";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}

function editEmpleado() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea actualizar su perfil?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Perfil/edit_userxid";

        $.ajax({
            url: url,
            type: $("#frmEditEmpleado").attr("method"),
            data: $("#frmEditEmpleado").serialize(),
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 7000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Perfil actualizado exitosamente",
                        timer: 7000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Empresas";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}


function addPersonal() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea agregar un nuevo empleado?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Perfil/guardar_personal";

        $.ajax({
            url: url,
            type: $("#addPersonalForm").attr("method"),
            data: $("#addPersonalForm").serialize(),
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
                if (resp === "existe") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "El usuario ya existe",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Empleado guardado exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Perfil/get_perfil";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}

function updateConductor() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea actualizar datos de conductor?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Conductores/updateConductor";

        $.ajax({
            url: url,
            type: $("#frmConductor").attr("method"),
            data: $("#frmConductor").serialize(),
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
                        text: "Datos actualizados exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}
function actEmpresa() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea actualizar datos de empresa?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Empresas/update_empresa";

        $.ajax({
            url: url,
            type: $("#frmEmpresa").attr("method"),
            data: $("#frmEmpresa").serialize(),
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
                        text: "Datos actualizados exitosamente",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Empresas";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}
function confirmAprobarLogo() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_logo";
        $.ajax({
            url: url,
            type: $("#frmLogo").attr("method"),
            data: $("#frmLogo").serialize(),
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
                        text: "Foto Logo actualizada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function confirmAprobarRut() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_rut";
        $.ajax({
            url: url,
            type: $("#frmRut").attr("method"),
            data: $("#frmRut").serialize(),
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
                        text: "Foto RUT actualizado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}

function confirmAprobarCamara() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_camara";
        $.ajax({
            url: url,
            type: $("#frmCamara").attr("method"),
            data: $("#frmCamara").serialize(),
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
                        text: "Foto camara actualizada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}

function confirmAprobarPdf() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_pdf";
        $.ajax({
            url: url,
            type: $("#frmPdf").attr("method"),
            data: $("#frmPdf").serialize(),
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
                        text: "PDF actualizado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function confirmAprobarCedula() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_cedula";
        $.ajax({
            url: url,
            type: $("#frmCedula").attr("method"),
            data: $("#frmCedula").serialize(),
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
                        text: "Foto Cédula actualizada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function confirmAprobarLic() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_lic";
        $.ajax({
            url: url,
            type: $("#frmLic").attr("method"),
            data: $("#frmLic").serialize(),
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
                        text: "Foto Licencia actualizada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function confirmAprobarPdfUsuarios() {
    swal({
        title: "Esta seguro de aprobar este documento?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_pdf_usuarios";
        $.ajax({
            url: url,
            type: $("#frmPdf").attr("method"),
            data: $("#frmPdf").serialize(),
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
                        text: "Pdf actualizado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function confirmAprobarPerfilUsuarios() {
    swal({
        title: "Esta seguro de aprobar esta foto?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Docs/aprobar_foto_perfil_usuarios";
        $.ajax({
            url: url,
            type: $("#frmFotoPerfil").attr("method"),
            data: $("#frmFotoPerfil").serialize(),
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
                        text: "Foto perfil actualizada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Documento no aprobado!", "error");
        }
    });
}
function reprobarDoc() {
    var obs = $("#obs").val();
    swal({
        title: 'Observaciones',
        input: 'textarea',
        inputValue: obs,
        showCancelButton: true,
        confirmButtonText: 'Si, rechazar',
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    resolve();
                } else {
                    reject('Debe escribir alguna observación!');
                }
            });
        }
    }).then(function (result) {
        var idEmp = $("#id_empresa").val();
        var ndoc = $("#ndoc").val();
        url = get_base_url() + "admin/Docs/reprobar_doc";
        $.ajax({
            url: url,
            type: "POST",
            data: {idEmp, ndoc, result},
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
                        text: "Las observaciones han sido enviadas a la empresa.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Accion Cancelada", "error");
        }
    });
}
function reprobarDocUsuarios() {
    var obs = $("#obs").val();
    swal({
        title: 'Observaciones',
        input: 'textarea',
        inputValue: obs,
        showCancelButton: true,
        confirmButtonText: 'Si, rechazar',
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    resolve();
                } else {
                    reject('Debe escribir alguna observación!');
                }
            });
        }
    }).then(function (result) {
        var idUsuario = $("#id_conductor").val();
        var ndoc = $("#ndoc").val();
        url = get_base_url() + "admin/Docs/reprobar_doc_usuarios";
        $.ajax({
            url: url,
            type: "POST",
            data: {idUsuario, ndoc, result},
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
                        text: "Las observaciones han sido enviadas al transportista.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Accion Cancelada", "error");
        }
    });
}
function apto_licencia(id) {
    swal({
        title: "Esta seguro de aprobar este usuario?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Empresas/apto_licencia";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
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
                        text: "1 aprobada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Empresas";
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}
function transportista_apto_licencia(id) {
    swal({
        title: "Esta seguro de aprobar este usuario?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Conductores/apto_licencia";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Transportista aprobado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}
function bloquear(id) {
    swal({
        title: "Esta seguro de bloquear esta empresa?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, bloquear!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Empresas/bloquear";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "1 bloqueada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Empresas";
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}
function desbloquear(id) {
    swal({
        title: "Esta seguro de activar esta empresa?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, bloquear!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Empresas/desbloquear";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "1 activada correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "admin/Empresas";
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}

function bloquear_subusuario(id) {
    swal({
        title: "Esta seguro de bloquear este usuario?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, bloquear!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Empresas/bloquear_usuario";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Usuario bloqueado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}
function activar_subusuario(id) {
    swal({
        title: "Esta seguro de activar este usuario?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, activar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "admin/Empresas/activar_subusuario";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Usuario activado correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción Cancelada!", "error");
        }
    });
}
function validarEmail(id) {
    swal({
        title: "Esta seguro de validar email?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "Registros/validar_email";
        $.ajax({
            url: url,
            type: "POST",
            data: {id},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Email validado correctamente.",
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

function updateOferta() {
    url = get_base_url() + "empresa/Ofertas/update_oferta";
    $.ajax({
        url: url,
        type: $("#frmEditCarga").attr("method"),
        data: $("#frmEditCarga").serialize(),
        success: function (resp) {
            if (resp === "ok") {
                swal({
                    title: "Exito!",
                    text: "Oferta actualizada exitosamente",
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "admin/Ofertas";
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
                    window.location.href = get_base_url() + "admin/Ofertas";
                });
            }
        }
    });
}

function convenir(idv, idcarga) {
    swal({
        title: "Esta seguro que la empresa acordo con el conductor, para transportar sus mercancías?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "empresa/Ofertas/convenir_oferta";
        $.ajax({
            url: url,
            type: "POST",
            data: {idv: idv, idcarga: idcarga},
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
                        text: "Vehiculo convenido correctamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            }
        });
    }, function (dismiss) {
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

$('#dataTable tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = dt.row(tr);
    id = $(this).attr("id");
    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        $(this).html('<i class="fa fa-plus-square-o"></i>');
    } else {
        getDetails(id);
        closeOpenedRows(dt, tr);
        $(this).html('<i class="fa fa-minus-square-o"></i>');
        row.child(format(id)).show();
        tr.addClass('shown');
        openRows.push(tr);
    }
});
function format(d) {
    return '<div id="apli_' + d + '"></div><div id="cont_' + d + '"></div>';
}

function getDetails(id) {
    var url = get_base_url() + "admin/Ofertas/get_aplicando?jsoncallback=?";
    var url2 = get_base_url() + "admin/Ofertas/get_contratados?jsoncallback=?";
    $.getJSON(url, {id: id}).done(function (res) {
        $("#apli_" + id).html("Aplicando: " + res.aplicando.aplicando);
    });
    $.getJSON(url2, {id: id}).done(function (res) {
        $("#cont_" + id).html("Contratados: " + res.contratados.contratados);
    });
}
function closeOpenedRows(table, selectedRow) {
    $.each(openRows, function (index, openRow) {
        // not the selected row!
        if ($.data(selectedRow) !== $.data(openRow)) {
            var rowToCollapse = table.row(openRow);
            rowToCollapse.child.hide();
            openRow.removeClass('shown');
            // replace icon to expand
            $(openRow).find('td.details-control').html('<i class="fa fa-plus-square-o"></i>');
            // remove from list
            var index = $.inArray(selectedRow, openRows);
            openRows.splice(index, 1);
        }
    });
}

function addRefPer() {
    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea agregar referencia personal?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "admin/Conductores/guardar_refp";

        $.ajax({
            url: url,
            type: $("#addRefPerForm").attr("method"),
            data: $("#addRefPerForm").serialize(),
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
                    location.reload();
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
        url = get_base_url() + "admin/Conductores/guardar_ref_emp";

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
                    location.reload();
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });

}
;







