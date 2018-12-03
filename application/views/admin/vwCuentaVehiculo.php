<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1>Estado de Cuenta <small></small></h1>
			<ol class="breadcrumb">
				<?php if ($vehiculo != "1") { ?>
					<li><a href="<?php echo base_url() . 'admin/Vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
					<li class="active"><label style="color:red; font-size: 20px"><?= $placa ?></label><i class="fa fa-truck fa-2x"></i> </li>
				<?php } else { ?>
					<li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
					<li class="active"><i class="fa fa-truck fa-2x"></i> </li>

				<?php } ?>
			</ol>
		</div>
	</div><!-- /.row -->
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="hidden" id="idVehiculo" value="<?= $vehiculo ?>">
			<input type="hidden" id="rutaDetail" value="admin/Vehiculos/DetailAccountV/">
			<div class="table-responsive">
				<table id="dataTable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color:#FFE000">
							<?php if ($vehiculo == "1") { ?>
								<th style="display: none">Vehiculo</th>
								<th>Vehiculo</th>
							<?php } ?>

							<th>Viajes gratis</th>
							<th>Viajes referidos</th>
							<th>Total viajes gratis</th>
							<th>Valor viaje</th>
							<th style="border-right: solid 1px #000">Total promociones </th>
							<th>Pagos recibidos </th>
							<th>Total abonos</th>
							<th>Viajes realizados</th>
							<th>Saldo disponible</th>
						</tr>
					</thead>
					<tbody id="cuentavehiculo">
						<?php echo $body ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div><!-- /#page-wrapper -->

<!-- Modal -->
<div class="modal fade " id="DetailCuenta" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="padding:35px 50px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4><span class="glyphicon glyphicon-lock"></span> Detalle Cuenta</h4>
			</div>
			<div class="table-responsive">
				<table id="dataTableAccount" class="display" cellspacing="0" width="100%">
					<thead>
						<tr style="background-color:#FFE000">
							<th>#</th>
							<th>Trayecto</th>
							<th>Fecha contrato</th>
							<th>Valor viaje</th>
							<th>Pago realizado</th>
							<th>Saldo </th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tbDetailCuenta">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('admin/vwFooter');
?>
