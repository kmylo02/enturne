$(document).ready(function () {
    $('#dataTable').DataTable({
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
$(document).ready(function () {
    $('#reportesTabl').DataTable({
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
$(document).ready(function () {
    $("#cedula_subusu").change(function () {
        $('#usuario_subusu').val($(this).val());
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

function actPersonal() {

    var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea actualizar su perfil?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
    confirm.set({transition: 'slide'});
    confirm.set('onok', function () { //callbak al pulsar botón positivo

        alertify.success('Has confirmado');
        url = get_base_url() + "empresa/Perfil/update_perfil";

        $.ajax({
            url: url,
            type: $("#frmActPersonal").attr("method"),
            data: $("#frmActPersonal").serialize(),
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
                    window.location.href = get_base_url() + "empresa/Perfil/get_perfil";
                }
            }
        });

        confirm.set('oncancel', function () { //callbak al pulsar botón negativo

            alertify.error('Has Cancelado');

        });

    });
}
function crearVehiculo() {
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
        url = get_base_url() + "empresa/Perfil/guardar_vehiculo";
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
        if (dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

function addOfertaEmpleo() {
    swal({
        title: "Esta seguro que desea crear una nueva oferta de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function () {
        var descripcion = $("#descripcion").val();
        url = get_base_url() + "empresa/Empleo/guardar_oferta_empresa";
        $.ajax({
            url: url,
            type: "POST",
            data: {descripcion: descripcion},
            success: function (resp) {
                if (resp === "error") {
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error al conectar con la base de datos.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Oferta creada exitosamente.",
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

function addPersonalEmpresa() {
    url = get_base_url() + "empresa/Perfil/guardar_personal";
    $.ajax({
        url: url,
        type: $("#addPersonalForm").attr("method"),
        data: $("#addPersonalForm").serialize(),
        success: function (resp) {
            if (resp === "ko") {
                swal({
                    title: "Aviso!",
                    text: "Este usuario ya existe. Aceptar para ir a recuperar contraseña, cancelar para intertar registrar otro usuario.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "empresa/Perfil/get_personal";
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal("Cancelado", "Intentará registrar otro usuario", "error");
                    }
                })
            }
            if (resp === "ok") {
                swal({
                    title: "Exito!",
                    text: "Perfil registrado exitosamente",
                    type: "success",
                    confirmButtonText: "Ok",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "empresa/Perfil/get_personal";
                });
            }
            if (resp === "error") {
                swal({
                    title: "Error!",
                    text: "Error en bbdd",
                    type: "warning",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "empresa/Perfil/get_personal";
                });
            }
            if (resp === "errorpass") {
                swal({
                    title: "Error!",
                    text: "Las contraseñas no son identicas, por favor reintente",
                    type: "warning",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }).then(function () {
                });
            }

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
                    window.location.href = get_base_url() + "empresa/Ofertas/listado_ofertas";
                });
            }
            if (resp === "error") {
                swal({
                    title: "Error!",
                    text: "Error en bbdd",
                    type: "warning",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "empresa/Ofertas/listado_ofertas";
                });
            }
        }
    });
}
function convenir(idv, idcarga) {
    swal({
        title: "Esta seguro que acordo con el conductor, para transportar sus mercancías?",
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
                        text: "Este vehiculo ya esta contratado o existe un Error en la base de datos",
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
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

function actEmpresa() {
    swal({
        title: "Esta seguro que desea actualizar datos de su empresa?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "empresa/Perfil/update_empresaxemp";
        $.ajax({
            url: url,
            type: $("#frmEditEmpresa").attr("method"),
            data: $("#frmEditEmpresa").serialize(),
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
                        text: "Datos actualizados exitosamente.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url() + "empresa/Perfil/ver_completar";
                }
            }
        });
    }, function (dismiss) {
        if (dismiss === 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function crear_oferta() {
    swal({
        title: "Esta seguro de crear esta oferta de carga?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function () {
        url = get_base_url() + "empresa/Ofertas/guardar_oferta_empresa";
        $.ajax({
            url: url,
            type: $("#formCrearOferta").attr("method"),
            data: $("#formCrearOferta").serialize(),
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
                        text: "Oferta creada correctamente.",
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
function bloquear(id) {
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
function desbloquear(id) {
    swal({
        title: "Esta seguro de desbloquear este usuario?",
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
                }
                if (resp === "ok") {
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Usuario desbloqueado correctamente.",
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
function getFileName(elm, idContrato) {
    var fn = $(elm).val();
    $("#datofile_" + idContrato).html(fn);
}
function subirManifiesto(idContrato) {
    var formData = new FormData(document.getElementById("frmManifest_" + idContrato));
    $('#spinner').html("");
    url = get_base_url() + "empresa/Ofertas/guardar_manifiesto";
    $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    })
            .done(function (res) {
                $('#spinner').html("");
                if (res === "error") {
                    alertify.error('Error en BBDD');
                }
                if (res === "ok") {
                    alertify.success('Manifiesto guardado exitosamente');
                    location.reload();
                }
            });
}
;
function format(input)
{
    var num = input.value.replace(/\./g, '');
    if (!isNaN(num)) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/, '');
        input.value = num;
    } else {
        alert('Solo se permiten numeros');
        input.value = input.value.replace(/[^\d\.]*/g, '');
    }
}
/*
 function cambio(elemento){
 $(elemento).css("background-color", "blue");
 }*/

