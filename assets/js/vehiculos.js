$(document).ready(function () {

	$(document).on("click focusout", "#cuentavehiculo tr td .vlrPago", function () {
		//alert("input pago");
		var Total = 0;
		var saldo = $(this).parent().parent().find("td").eq(10).text()
		console.log($(this).parent().parent().find("td").eq(10).text());
		$(".vlrPago").each(function (i, item) {
			if (item.value > 0 && item.value != "") {
				Total += parseFloat(item.value);
			}
			//console.log(item.value);
		});
		$("#totalpago").text(Total);
		return false;
	});

	$(document).on('click', '#cuentavehiculo tr', function (evt) {

		var vehiculo = ($("#idVehiculo").val() != "1") ? $("#idVehiculo").val() : $(this).find("td").eq(0).text();
		url = get_base_url() + $("#rutaDetail").val() + vehiculo;
		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			data: {},
			success: function (resp) {
				console.log(resp);

				if (resp.success) {
					var html = "";
					$.each(resp.data, function (i, item) {
						var vlr = (item.Valor == null) ? 0 : parseInt(item.Valor);
						var saldo = (parseInt(vlr) - parseInt(item.tarifa_enturne));
						var color = (saldo < 0) ? "red" : "green";
						var btnDisabled = (saldo < 0) ? "" : "disabled";
						html += "<tr>";
						html += "<td>" + (i + 1) + "</td>";
						html += "<td>" + item.Trayecto + "</td>";
						html += "<td>" + item.fecha_contratado + "</td>";
						html += "<td>" + item.tarifa_enturne + "</td>";
						html += "<td>" + vlr + "</td>";
						html += "<td style='color: " + color + "'>" + saldo + "</td>";
						html += "<td><button type='button' class='btn btn-primary' onclick='Pagos(" + item.ID + "," + Math.abs(saldo) + ")' " + btnDisabled + ">PAGO</button></td>";
						html += "</tr>";
					});
					$("#tbDetailCuenta").html(html);

					var table = $('#dataTableAccount').DataTable({
						language: {
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
						},
						paging: true,
						searching: true,
						"responsive": true,
						retrieve: true,
						//destroy: true,
						"select": true,
						"lengthMenu": [[5, 10, 15, 20, 25, 50], [5, 10, 15, 20, 25, 50]],
						"pageLength": 5,
					});
					//table.draw();
					$("#DetailCuenta").modal();
				} else {
					swal({
						title: "Error!",
						type: "error",
						text: "Error al obtener detalle de la cuenta.",
						timer: 10000,
						showConfirmButton: false
					});

				}

			}
		});

	});
});

function updateVehiculo() {
	swal({
		title: "Esta seguro de actualizar los cambios para este vehiculo?",
		text: "Esta acción no podra ser removida!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si",
		cancelButtonText: "No",
		closeOnConfirm: false
	}).then(function () {
		url = get_base_url() + "admin/Vehiculos/update_vehiculo";
		$.ajax({
			url: url,
			type: $("#frm_edit_vehiculo").attr("method"),
			data: $("#frm_edit_vehiculo").serialize(),
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
						text: "Vehiculo actualizado correctamente.",
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
function vehiculo_apto_licencia(idv) {
	swal({
		title: "Esta seguro de autorizar la licencia para este vehiculo?",
		text: "Esta acción no podra ser removida!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si",
		cancelButtonText: "No",
		closeOnConfirm: false
	}).then(function () {
		url = get_base_url() + "admin/Vehiculos/autorizar_vehiculo";
		$.ajax({
			url: url,
			type: "POST",
			data: {idv: idv},
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
						text: "Vehiculo con licencia autorizado.",
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
function bloquear_vehiculo(idv) {
	swal({
		title: "Esta seguro de bloquear este vehiculo?",
		text: "Esta acción no podra ser removida!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si",
		cancelButtonText: "No",
		closeOnConfirm: false
	}).then(function () {
		url = get_base_url() + "admin/Vehiculos/bloquear_vehiculo";
		$.ajax({
			url: url,
			type: "POST",
			data: {idv: idv},
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
						text: "Vehiculo bloqueado exitosamente.",
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
function confirmAprobarFrontal() {
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
		url = get_base_url() + "admin/Docs/aprobar_frontal_vehiculo";
		$.ajax({
			url: url,
			type: $("#frmFrontal").attr("method"),
			data: $("#frmFrontal").serialize(),
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
						text: "Foto frontal aprobada correctamente.",
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
function confirmAprobarLateral() {
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
		url = get_base_url() + "admin/Docs/aprobar_lateral_vehiculo";
		$.ajax({
			url: url,
			type: $("#frmLateral").attr("method"),
			data: $("#frmLateral").serialize(),
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
						text: "Foto lateral aprobada correctamente.",
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
function confirmAprobarTrasera() {
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
		url = get_base_url() + "admin/Docs/aprobar_trasera_vehiculo";
		$.ajax({
			url: url,
			type: $("#frmTrasera").attr("method"),
			data: $("#frmTrasera").serialize(),
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
						text: "Foto trasera aprobada correctamente.",
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
function confirmAprobarLict() {
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
		url = get_base_url() + "admin/Docs/aprobar_lic_vehiculo";
		$.ajax({
			url: url,
			type: $("#frmLict").attr("method"),
			data: $("#frmLict").serialize(),
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
						text: "Foto licencia de transito aprobada correctamente.",
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
function confirmAprobarSoat() {
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
		url = get_base_url() + "admin/Docs/aprobar_soat";
		$.ajax({
			url: url,
			type: $("#frmSoat").attr("method"),
			data: $("#frmSoat").serialize(),
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
						text: "Foto SOAT aprobada correctamente.",
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
function confirmAprobarRtm() {
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
		url = get_base_url() + "admin/Docs/aprobar_rtecno";
		$.ajax({
			url: url,
			type: $("#frmRtm").attr("method"),
			data: $("#frmRtm").serialize(),
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
						text: "Foto revisión tecnomecanica aprobada correctamente.",
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
function confirmAprobarRegRemolque() {
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
		url = get_base_url() + "admin/Docs/aprobar_remolque";
		$.ajax({
			url: url,
			type: $("#frmRegRemolque").attr("method"),
			data: $("#frmRegRemolque").serialize(),
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
						text: "Foto remolque aprobada correctamente.",
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
function confirmAprobarCedP() {
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
		url = get_base_url() + "admin/Docs/aprobar_cedp";
		$.ajax({
			url: url,
			type: $("#frmCedP").attr("method"),
			data: $("#frmCedP").serialize(),
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
						text: "Foto cedula del propietario aprobada correctamente.",
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
function confirmAprobarRutP() {
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
		url = get_base_url() + "admin/Docs/aprobar_rutp";
		$.ajax({
			url: url,
			type: $("#frmRutP").attr("method"),
			data: $("#frmRutP").serialize(),
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
						text: "Foto rut del propietario aprobada correctamente.",
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
function confirmAprobarCarnetVehiculos() {
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
		url = get_base_url() + "admin/Docs/aprobar_carnet";
		$.ajax({
			url: url,
			type: $("#frmCarnet").attr("method"),
			data: $("#frmCarnet").serialize(),
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
						text: "Foto carnet afiliación del propietario aprobada correctamente.",
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
function confirmAprobarPdfVehiculos() {
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
		url = get_base_url() + "admin/Docs/aprobar_pdf_vehiculo";
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
						text: "Documentos en PDF aprobados correctamente.",
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
function reprobarDocVehiculo() {
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
		var idv = $("#id_vehiculo").val();
		var ndoc = $("#ndoc").val();
		url = get_base_url() + "admin/Docs/reprobar_doc_vehiculo";
		$.ajax({
			url: url,
			type: "POST",
			data: {idv: idv, ndoc: ndoc, result: result},
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
						text: "Las observaciones han sido enviadas al propietario.",
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
function eliminarVehiculo(idv) {
	swal({
		title: "Esta seguro de eliminar este vehiculo?",
		text: "Esta acción no podra ser removida!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si",
		cancelButtonText: "No",
		closeOnConfirm: false
	}).then(function () {
		url = get_base_url() + "admin/Vehiculos/eliminar_vehiculo";
		$.ajax({
			url: url,
			type: "POST",
			data: {idv: idv},
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
						text: "Vehiculo eliminado correctamente.",
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
function updateSoat() {
//información del formulario
	var formData = new FormData($("#frmSoat")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_soat_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateRtm() {
	//información del formulario
	var formData = new FormData($("#frmRtm")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_rtm_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateLict() {
	//información del formulario
	var formData = new FormData($("#frmLict")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_lict_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateRut() {
	//información del formulario
	var formData = new FormData($("#frmRut")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_rutp_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateCedp() {
	//información del formulario
	var formData = new FormData($("#frmCedp")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_cedp_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateCarnet() {
	//información del formulario
	var formData = new FormData($("#frmCarnet")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_carnet_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateFrontal() {
	//información del formulario
	var formData = new FormData($("#frmFrontal")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_frontal_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateTrasera() {
	//información del formulario
	var formData = new FormData($("#frmTrasera")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_trasera_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateLateral() {
	//información del formulario
	var formData = new FormData($("#frmLateral")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_lateral_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updateRemolque() {
	//información del formulario
	var formData = new FormData($("#frmRemolque")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_remolque_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
function updatePdf() {
	//información del formulario
	var formData = new FormData($("#frmPdf")[0]);
	var message = "";
	//hacemos la petición ajax
	$.ajax({
		url: get_base_url() + "admin/Vehiculos/subir_pdf_ajax",
		type: 'POST',
		// Form data
		//datos del formulario
		data: formData,
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
		//mientras enviamos el archivo
		beforeSend: function () {
			swal({
				title: "Aviso!",
				text: "Subiendo archivo.",
				imageUrl: get_base_url() + 'assets/img/loaderdocs.gif',
				showConfirmButton: false
			});
		},
		//una vez finalizado correctamente
		success: function (data) {
			swal({
				title: "Exito!",
				type: "success",
				text: "La imagen ha subido correctamente",
				showConfirmButton: false
			});
			location.reload();
		},
		//si ha ocurrido un error
		error: function () {
			swal({
				title: "Error!",
				type: "error",
				text: "Ha ocurrido un error.",
				showConfirmButton: false
			});
		}
	});
}
;
