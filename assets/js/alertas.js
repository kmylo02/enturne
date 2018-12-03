$(document).on("ready");
function consultaSos() {
	var contIni = $("#numsos").html();
	$.ajax({
		url: get_base_url() + "admin/Alertas/get_contsos",
		success: function (resp) {
			if (resp !== contIni) {
				$("#numsos").html(resp);
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
//setInterval(consultaSos, 1000);

function elimSos(id) {
	var confirm = alertify.confirm('Confirmación', 'Esta seguro que desea dar por resuelta la llamadad de auxilio?', null, null).set('labels', {ok: 'Si', cancel: 'No'});
	confirm.set({transition: 'slide'});
	confirm.set('onok', function () { //callbak al pulsar botón positivo
		alertify.success('Has confirmado');
		url = get_base_url() + "admin/Alertas/cerrar_sos";

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
					window.location.href = get_base_url() + "admin/Dashboard";
				}
			}
		});

		confirm.set('oncancel', function () { //callbak al pulsar botón negativo

			alertify.error('Has Cancelado');

		});

	});
}
