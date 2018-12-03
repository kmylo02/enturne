<?php
$this->load->view('conductor/vwHeader');
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1><?php echo $titulo ?></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-dashboard"> Tablero</i></li>
			</ol>
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Bienvenido <?php echo $nombre . " " . $apellidos; ?>
			</div>
		</div>
	</div><!-- /.row -->
	<?php if ($tipo == 1) { ?>
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?php echo base_url() . 'assets/img/user.png' ?>" alt="usuario">
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-heading"></p>
								<p class="announcement-text">Información personal</p>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url() . 'conductor/Perfil/completar_conductor' ?>">
						<div class="panel-footer announcement-bottom">
							<div class="row">
								<div class="col-xs-8">
									Ver / Completar
								</div>
								<div class="col-xs-4 text-right">
									<i class="fa fa-arrow-circle-right"></i>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	<?php } else {
		?>
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?php echo base_url() . 'assets/img/user.png' ?>" alt="usuario">
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-heading"></p>
								<p class="announcement-text">Información personal</p>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url() . 'conductor/Perfil/completar_conductor' ?>">
						<div class="panel-footer announcement-bottom">
							<div class="row">
								<div class="col-xs-8">
									Ver / Completar
								</div>
								<div class="col-xs-4 text-right">
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
								<img src="<?php echo base_url() . 'assets/img/MisVehiculos.png' ?>" alt="Mis vehiculos">
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-text">Mis Vehiculos</p>
								<p class="announcement-text"></p>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url() . 'conductor/Perfil/get_vehiculos' ?>">
						<div class="panel-footer announcement-bottom">
							<div class="row">
								<div class="col-xs-8">
									Ver / Añadir
								</div>
								<div class="col-xs-4 text-right">
									<i class="fa fa-arrow-circle-right"></i>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<?php if ($estado == 1) { ?>
				<div class="col-lg-3">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
									<img src="<?php echo base_url() . 'assets/img/Misconductores.png' ?>" alt="Mis conductores">
								</div>
								<div class="col-xs-6 text-right">
									<p class="announcement-text">Mis Conductores</p>
									<p class="announcement-text"></p>
								</div>
							</div>
						</div>
						<a href="<?php echo base_url() . 'conductor/Empleo' ?>">
							<div class="panel-footer announcement-bottom">
								<div class="row">
									<div class="col-xs-8">
										Ver / Añadir
									</div>
									<div class="col-xs-4 text-right">
										<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			<?php }
			?>
			<?php if ($tipo == 2 || $tipo == 3) { ?>
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
						<a href="<?= base_url() . "conductor/Vehiculos/GetCuentaVehiculo/1" ?>">
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
			<?php }
			?>
		</div><!-- /.row -->
	<?php }
	?>
</div><!-- /#page-wrapper -->
<!--  PAge Code Ends here -->
<?php
$this->load->view('conductor/vwFooter');
?>
