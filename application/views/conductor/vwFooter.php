<!--load jQuery library-->
<script src="<?= base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/js/jquery-ui-1.12.1/jquery-ui.js' ?>"></script>
<script type="text/javascript" src="<?= base_url() . 'assets/js/jquery.ui.datepicker-es.js' ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
<script src="<?= base_url('assets/js/ion.sound/ion.sound.js') ?>"></script>
<script src="<?= base_url('assets/js/das.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/dist/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/js/alertify.min.js') ?>"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxBXowA9nQJ7yLqitWJDCqPqpfJ_1fNL4&sensor=false">
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$("#provincia").change(function () {
			$("#provincia option:selected").each(function () {
				provincia = $('#provincia').val();
				$.post("<?= base_url() . 'Paises/llena_localidades' ?>", {
					provincia: provincia
				}, function (data) {
					$("#localidad").html(data);
				});
			});
		})
	});
</script>
<script>
	$(function () {
		$('#trailer').hide();
		$('#tipov').change(function () {
			$('#trailer').hide();
			if (this.options[this.selectedIndex].value > 3) {
				$('#trailer').show();
				$('#placatrailer').attr('required', true);
				$('#marcatrailer').attr('required', true);
				$('#trailermodelo').attr('required', true);
				$('#pesovtrailer').attr('required', true);
			}
		});
	});
</script>
<script>
	$(function () {
		$("#vence_soat").datepicker({dateFormat: 'y/mm/d'});
		$("#vence_rtecno").datepicker({dateFormat: 'y/mm/d'});
	});
</script>
<!-- funciones -->
<script src="<?= base_url() . 'assets/js/base_url.js' ?>"></script>
<script src="<?= base_url() . 'assets/js/conductor/conductor.js' ?>"></script>
<script src="<?= base_url() . 'assets/js/conductor/alertas.js' ?>"></script>
<script src="<?= base_url() . 'assets/js/conductor/mapas.js' ?>"></script>
<script src="<?= base_url() . 'assets/js/docs.js' ?>"></script>
<script src="<?= base_url() . 'assets/js/vehiculos.js' ?>"></script>
<script language="JavaScript">
	function ConfirmAplicar() {
		if (confirm("Tu hoja de vida sera enviada al empleador, confirma si deseas aplicar."))
		{
			document.aplicar_empleo.submit();
		}
	}
	function confirmar_calificar() {
		if (confirm("¿Realmente desea enviar su calificación?")) {
			alert("Calificación enviada.");
		} else {
			return false;
		}
	}
</script>

</body>
</html>
