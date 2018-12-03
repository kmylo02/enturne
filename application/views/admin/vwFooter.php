</div><!-- /#wrapper -->
<!--load jQuery library-->
<script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-ui-1.12.1/jquery-ui.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.ui.datepicker-es.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script src="<?php echo base_url('assets/js/ion.sound/ion.sound.js') ?>"></script>
<script src="<?php echo base_url() . 'assets/js/das.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/sweetalert/dist/sweetalert.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/alertify.min.js' ?>"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxBXowA9nQJ7yLqitWJDCqPqpfJ_1fNL4">
</script>
<!-- funciones -->
<script src="<?php echo base_url() . 'assets/js/base_url.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/admin/admin.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/admin/conductores.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/admin/empleo.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/admin/mapas.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/alertas.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/registro.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/vehiculos.js' ?>"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#pais").change(function () {
			$("#pais option:selected").each(function () {
				pais = $('#pais').val();
				$.post("<?php echo base_url() . 'Paises/llena_provincias' ?>", {
					pais: pais
				}, function (data) {
					$("#provincia").html(data);
				});
			});
		})
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#provincia").change(function () {
			$("#provincia option:selected").each(function () {
				provincia = $('#provincia').val();
				$.post("<?php echo base_url() . 'Paises/llena_localidades' ?>", {
					provincia: provincia
				}, function (data) {
					$("#localidad").html(data);

				});
			});
		})
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#provincia1").change(function () {
			$("#provincia1 option:selected").each(function () {
				provincia1 = $('#provincia1').val();
				$.post("<?php echo base_url() . 'Paises/llena_localidades1' ?>", {
					provincia1: provincia1
				}, function (data) {
					$("#localidad1").html(data);
				});
			});
		})
	});
</script>
<script type="text/javascript">
	$(function () { //En cuanto esté listo el DOM, deshabilitamos la lista de partidos
		$('input#user').attr('disabled', true);
	});

	function activate_match()
	{
		var user_id = $('input#nid').val(); //Obtenemos el id del torneo seleccionado en la lista
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/admin/Vehiculos/add_vehiculo', //Realizaremos la petición al metodo list_dropdown del controlador match
			data: 'user=' + user_id, //Pasaremos por parámetro POST el id del torneo
			success: function (resp) { //Cuando se procese con éxito la petición se ejecutará esta función
				//Activar y Rellenar el select de partidos
				$('input#nid').attr('disabled', false).html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
			}
		});
	}
</script>
<script type="text/javascript">
	function confirma() {
		if (confirm("¿Realmente desea descartar aspirante?")) {
			alert("El aspirante ha sido descartado.")
		}
		else {
			return false;
		}
	}
	function confirm_cerrar_oferta() {
		if (confirm("¿Realmente desea cerrar la oferta?")) {
			alert("La ofeta ha sido cerrada.")
		}
		else {
			return false;
		}
	}
	function confirm_eliminar_oferta() {
		if (confirm("¿Realmente desea eliminar la oferta?")) {
			alert("La ofeta ha sido eliminada.")
		}
		else {
			return false;
		}
	}
	function confirmar_calificar() {
		if (confirm("¿Realmente desea enviar su calificación?")) {
			alert("Calificación enviada.")
		}
		else {
			return false;
		}
	}
</script>
<script>
	$(function () {
		$('#trailer').hide();
		$('#tipov').change(function () {
			$('#trailer').hide();
			if (this.options[this.selectedIndex].value == 4 || this.options[this.selectedIndex].value == 5) {
				$('#trailer').show();
			}
		});
	});
</script>
</body>
</html>