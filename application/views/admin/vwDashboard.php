<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Panel Principal <small>Administrador</small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
			</ol>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Bienvenido
				<?php echo $nombre . " " . $apellidos ?>
			</div>
		</div>
	</div><!-- /.row -->
	<div class="row">
		<div class="col-lg-3">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-building fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php echo $totalEmpresas ?></p>
							<p class="announcement-text">Empresas</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Empresas' ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-user-secret fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php echo $totalTransp ?></p>
							<p class="announcement-text">Transportadores</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Conductores' ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-truck fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php echo $totalVehiculos ?></p>
							<p class="announcement-text">Vehiculos</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Vehiculos' ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-map-marker fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php echo $totalGps ?></p>
							<p class="announcement-text">GPS</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Gps/get_users_gps' ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-dollar fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?= $totalCuentaVehiculos ?></p>
							<p class="announcement-text">Estado de Cuenta</p>
						</div>
					</div>
				</div>
				<a href="<?= base_url() . "admin/Vehiculos/GetCuentaVehiculo/1" ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-calendar-times-o fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php ?></p>
							<p class="announcement-text">Vencimiento Docs</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Docs/docs_x_vencer_conductor' ?>">
					<div class="panel-footer announcement-bottom">
						<div class="row">
							<div class="col-xs-6">
								Ver
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-arrow-circle-right"></i>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('admin/vwFooter');
?>
