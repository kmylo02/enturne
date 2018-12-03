function registroEmp() {      
    url = get_base_url() + "Registros/guardaremp";

    $.ajax({
        url: url,
        type: $("#frmRegistroEmp").attr("method"),
        data: $("#frmRegistroEmp").serialize(),
        success: function (resp) {
            if (resp == "ko") {
                swal({
                    title: "Aviso!",
                    text: "Esta empresa ya se encuentra registrada en nuestra plataforma. Por favor contacte con Enturne a las líneas (571) 4968958 . Aceptar para ir a recuperar contraseña, cancelar para intertar registrar otra empresa.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Aceptar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false
                }).then(function () {
                    window.location.href = get_base_url() + "Registros/forget_pass";
                }, function (dismiss) {
                    if (dismiss == 'cancel') {
                        swal("Cancelado", "Intentará registrar otra empresa", "error");
                    }
                })
            }
            if (resp == "ok") {
                swal({
                    title: "Exito!",
                    text: "Para continuar su registro, ingrese al email registrado y valide su usuario.",
                    type: "success",
                    confirmButtonText: "Aceptar",
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
                    window.location.href = get_base_url() + "Login";
                });
            }
        }
    });
}

function registro() {      
	url=get_base_url()+"Registros/guardar";
	$.ajax({
		url:url,
		type:$("#frmRegistro").attr("method"),
		data:$("#frmRegistro").serialize(),
		success:function(resp){
			if(resp==="ko"){
				swal({
					title: "Aviso!",
					text: "Este usuario ya existe. Aceptar para ir a recuperar contraseña, cancelar para intertar registrar otro usuario.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Aceptar",
					cancelButtonText: "Cancelar",
					closeOnConfirm: false
				}).then(function(){					window.location.href=get_base_url()+"Registros/forget_pass";
								  },function(dismiss) {
					if(dismiss == 'cancel') {
						swal("Cancelado", "Intentará registrar otro usuario", "error");
					}
				})   
			}
			if(resp==="ok"){
				swal({
					title: "Exito!",
					text: "Para continuar su registro, ingrese al email registrado y valide su usuario.",
					type: "success",
					confirmButtonText: "Ok",
					closeOnConfirm: false
				}).then(function(){
					window.location.href=get_base_url()+"Login";
				});
			}
			if(resp=="error"){
				swal({
					title: "Error!",
					text: "Error en bbdd",
					type: "warning",
					confirmButtonText: "Aceptar",
					closeOnConfirm: false
				}).then(function(){
					window.location.href=get_base_url()+"Login";
				});
			} 
			if(resp=="errorpass"){
				swal({
					title: "Error!",
					text: "Las contraseñas no son identicas, por favor reintente",
					type: "warning",
					confirmButtonText: "Aceptar",
					closeOnConfirm: false
				}).then(function(){
				});
			}        

		}
	});
}

function confirmEliminar(){
	var agree=confirm("¿Realmente desea eliminarlo? ");
	if (agree) return true ;
	return false;
	/*swal({
        title: "Esta seguro?",
        text: "Esta acción no podra ser recuperada!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false
    }).then(function() {
      swal("Eliminado!", "Registro eliminado.", "success")
    })*/
}
function activarEmp(id){
    swal({
        title: "Esta seguro de aprobar este registro?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, aprobar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then(function() {
        url= get_base_url()+"Registros/activar_registro_emp";
        $.ajax({
            url:url,
            type:"POST",
            data:{id},
            success:function(resp){
                if(resp==="error"){
                    swal({
                        title: "Error!",
                        type: "warning",
                        text: "Error en la base de datos",
                        timer: 10000,
                        showConfirmButton: false
                    });
                }                	
                if(resp==="ok"){
                    swal({
                        title: "Exito!",
                        type: "success",
                        text: "Para continuar su registro, ingrese al email registrado y valide su usuario.",
                        timer: 10000,
                        showConfirmButton: false
                    });
                    window.location.href = get_base_url()+"admin/Empresas";
                }		
            }
        });
    },function(dismiss) {
        if(dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

