<?php
$this->load->view('conductor/vwHeader');


//echo "<pre>";
//print_r($perfil);
if ($vehiculo) {
	$idv = $vehiculo->idVehiculo;
} else {
	$idv = NULL;
}
$foto_perfil = $perfil->foto_ruta;
$foto_ced = $perfil->foto_cedula;
$foto_lic = $perfil->foto_licencia;
$pdf = $perfil->pdf;

switch ($perfil->tipo) {
	case "1":
		$tipoDocumento = "CC";
		break;
	case "2":
		$tipoDocumento = "Pasaporte";

		break;
	case "3":
		$tipoDocumento = "Libreta Militar";

		break;
	case "4":
		$tipoDocumento = "Cedula de extranjeria";

		break;
}
if ($perfil->activo == 1 && $idv != NULL) {
	$hv = anchor_popup(base_url() . 'empresa/perfil/generar_hv_completa/' . $perfil->idUser, '<i class="fa fa-file-pdf-o fa fa-2x"></i>', array('title' => 'Ver mi hoja de vida'));
} else if ($perfil->activo == 1 && $idv == NULL) {
	$hv = anchor_popup(base_url() . 'empresa/perfil/generar_hv_conductor/' . $perfil->idUser, '<i class="fa fa-file-pdf-o fa fa-2x"></i>', array('title' => 'Ver mi hoja de vida'));
} else {
	$hv = "Usted no ha sido AUTORIZADO por Enturne";
}
foreach ($edad as $fila) {
	$edad = $fila->EDAD_ACTUAL;
}
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Perfil <small>Transportador</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url() . 'conductor/Dashboard' ?>"><i class="fa fa-dashboard fa-2x"></i> Volver al Panel</a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
	<div class="table-responsive">
		<table class="table table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Nombre</th>
					<th class="header">Apellidos </th>
					<th class="header" style="text-align: center;">Documento</th>
					<th class="header">Edad</th>
					<th class="header">Ciudad</th>
					<th class="header">Telefono</th>
					<th class="header">Email</th>
					<th class="header">Dirección</th>
					<th class="header">Celular</th>

				</tr>
			</thead>
			<tbody>
				<?php
				if (!$perfil) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . $mensaje . "</h4>" . "</td>";
				} else if ($foto_ced == NULL && $foto_lic == NULL && $foto_perfil == NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe subir documentación para validar registro." . "</h4>" . "</td>";
				} else if ($foto_ced == NULL && $foto_lic == NULL && $foto_perfil == NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe colocar su foto de perfil, foto de licencia de conducción y foto de cédula." . "</h4>" . "</td>";
				} else if ($foto_ced == NULL && $foto_lic != NULL && $foto_perfil == NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe colocar su foto de perfil y foto de cédula." . "</h4>" . "</td>";
				} else if ($foto_ced != NULL && $foto_lic != NULL && $foto_perfil == NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe colocar su foto de perfil." . "</h4>" . "</td>";
				} else if ($foto_ced != NULL && $foto_lic == NULL && $foto_perfil == NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe colocar su foto de perfil, foto licencia de conducción." . "</h4>" . "</td>";
				} else if ($foto_ced != NULL && $foto_lic == NULL && $foto_perfil != NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe subir documento de licencia de conducción." . "</h4>" . "</td>";
				} else if ($foto_ced == NULL && $foto_lic == NULL && $foto_perfil != NULL) {
					echo "<tr>";
					echo"<td colspan='9'>" . "<h4 style='color:red'>" . "Debe subir fotos de cédula, licencia." . "</h4>" . "</td>";
				} else if ($foto_ced != NULL && $foto_lic != NULL && $foto_perfil != NULL) {
					echo "<tr>";
					echo"<td>" . $perfil->nombre . "</td>";
					echo"<td>" . $perfil->apellidos . "</td>";
					echo"<td style='width: 12%;'>" . $tipoDocumento . " - " . $perfil->cedula . "</td>";
					echo"<td>" . $edad . "</td>";
					echo"<td>" . $perfil->nombre_ciudad . "</td>";
					echo"<td>" . $perfil->telefono . "</td>";
					echo"<td>" . $perfil->email . "</td>";
					echo"<td>" . $perfil->direccion . "</td>";
					echo"<td>" . $perfil->celular . "</td>";
					echo"<td>" . $hv . "</td>";
					echo "</tr>";
				} else if ($foto_ced == NULL && $foto_lic == NULL && $foto_perfil != NULL && $pdf != NULL) {
					echo "<tr>";
					echo"<td>" . $perfil->nombre . "</td>";
					echo"<td>" . $perfil->apellidos . "</td>";
					echo"<td style='width: 12%;'>" . $tipoDocumento . " - " . $perfil->cedula . "</td>";
					echo"<td>" . $edad . "</td>";
					echo"<td>" . $perfil->nombre_ciudad . "</td>";
					echo"<td>" . $perfil->telefono . "</td>";
					echo"<td>" . $perfil->email . "</td>";
					echo"<td>" . $perfil->direccion . "</td>";
					echo"<td>" . $perfil->celular . "</td>";
					echo"<td>" . $hv . "</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>

	</div>
	<?php
	if (!$perfil) {
		echo " ";
	} else {
		?>
		<div align="center">
		<?php if($perfil->foto_ruta != NULL){ $src = base_url().'uploads/'. $id.'/'.$perfil->foto_ruta;} else { $src = base_url().'assets/images_login/avatar.png';}?>
			<img id="foto_perfil" src="<?= $src ?>" />
		</div>
	<?php } ?>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
