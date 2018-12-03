<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Enturne <small>Administrador</small></h1>
			<ol class="breadcrumb">
				<li><i class="fa fa-shopping-cart"></i></li>
				<li class="active"><i class="icon-file-alt"></i> Ofertas de carga</li>
			</ol>
		</div>
	</div><!-- /.row -->
	<div class="table-responsive">
		<table id="dataTable" class="display" cellspacing="0" width="100%">
			<thead>
				<tr style="background-color:#FFE000">
					<th></th>
					<th class="header">ID</th>
					<th class="header">Creada por</th>
					<th class="header">Fecha de Cargue</th>
					<th class="header">Estado</th>
					<th class="header">Trayecto</th>
					<th class="header">Vehiculo</th>
					<th class="header">Peso</th>
					<th class="header">Cant</th>
					<th class="header">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!$ofertas) {

				} else {
					foreach ($ofertas as $row) {
						?>
						<tr>
							<td class="details-control" id="<?php echo $row->idOfertaCarga; ?>">
								<i class="fa fa-plus-square-o"></i>
							</td>
							<td><?= $row->idOfertaCarga ?></td>
							<td><?= $row->nombre . ' ' . $row->apellidos ?><br><a href="<?= base_url() . 'admin/Empresas/edit_empresaxid/' . $row->id_empresa ?>" target="_blank"><i class="fa fa-building"></i></a><br><?= $row->nombre_empresa . " Nit: " . $row->nit ?></td>
							<td><?= $row->fecha ?></td>
							<td><?= $row->estado ?></td>
							<td><?= $row->origen . '-' . $row->destino ?></td>
							<td><?= $row->nombre_tv . '-' . $row->nombre_carr ?></td>
							<td><?= $row->peso ?></td>
							<td><?= $row->cantidad ?></td><?php if ($row->estado == 'Cerrada') { ?>
								<td>Esta oferta ya ha terminado, solo puedes recalificar el servicio</td>
							<?php } else { ?>
								<td><a href="<?= base_url() . 'admin/Ofertas/edit_oferta/' . $row->idOfertaCarga ?>"><i class='fa fa-pencil fa-2x'></i></a>
										<?= anchor(base_url() . 'admin/Ofertas/cerrar_oferta/' . $row->idOfertaCarga, '<i class="fa fa-ban fa-2x"></i>', array('title' => 'Finalizar Oferta', 'onclick' => 'return confirm_cerrar_oferta();')) ?>
										<?= anchor(base_url() . 'admin/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class="fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();')) ?> </td>
								<?php } ?>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>
