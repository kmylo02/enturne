<?php
$this->load->view('conductor/vwHeader');
if (!$apl) {
	echo '';
} else {
	foreach ($apl as $key) {
		$apl_id = $key->id;
		$estado = $key->estado;
	}
}
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1>Aspirantes oferta de empleo <small></small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'conductor/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


	<div class="table-responsive">
		<table class="table table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Nombre</th>
					<th class="header">Ciudad / Dirección</th>
					<th class="header">Telefonos</th>
					<th class="header">Licencia</th>
					<th class="header">Ranking</th>
					<th class="header"></th>
				</tr>
			</thead>
			<tbody>

				<?php if (!$aspirante) { ?>
					<tr>
						<td><h3 style='color:red'><?php echo $mensaje ?></h3></td>
					</tr>
<?php } else {
	foreach ($aspirante as $row) {
		?>
						<tr>
							<td><?php echo $row->nombre . "  " . $row->apellidos ?></td>
							<td><?php echo $row->nombre_ciudad . " / " . $row->direccion ?></td>
							<td><?php echo $row->telefono . " / " . $row->celular ?></td>
							<td><?php echo $row->categoria_lic . " " . $row->licencia_conduccion ?></td>
							<?php if ($row->ranking == 0) { ?>
								<td><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
		<?php if ($row->ranking == 0.5) { ?>
								<td><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 1) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 1.5) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 2) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
		<?php if ($row->ranking == 2.5) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 3) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 3.5) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 4) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
								</td><?php } ?>
		<?php if ($row->ranking == 4.5) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
								</td><?php } ?>
							<?php if ($row->ranking == 5) { ?>
								<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
								</td><?php } ?>
							<?php if ($estado != 'contratado') { ?>
								<?php
								echo"<td>" . anchor_popup(base_url() . 'conductor/Perfil/generar_hv_conductor/' . $row->id, '<i class="fa fa-file-pdf-o fa-2x"></i>', array('title' => 'Ver Hoja de vida')) . "</td>";
								echo"<td>" . anchor(base_url() . 'conductor/Perfil/get_conductor_xid/' . $row->id, '<i class="fa fa-check-circle-o fa-2x"></i>', array('title' => 'Contratar')) . "</td>";
								?>
								<td><a onclick="if (confirma() == false)
																				return false" class="fa fa-trash fa-2x" href="<?php echo base_url() . 'conductor/Empleo/descartar_oferta_xid/' . $apl_id ?>" title="Descartar Aspirante"></a></td>
							<?php } else {
								echo "<td>" . 'Conductor contratado para esta oferta' . "</td>";
							} ?>
						</tr>
						<?php }
					} ?>
			</tbody>

		</table>


	</div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
