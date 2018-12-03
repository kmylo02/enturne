<?php
$this->load->view('empresa/vwHeader');
?>

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1><?php
				if (!$empresa) {
					foreach ($empresaempleado as $fila) {
						echo $fila->nombre_empresa;
					}
				} else {
					echo $empresa->nombre_empresa;
				}
				?>
				<small></small></h1>

			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
			</ol>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= $msn_vencimiento . " " . $link;
				?>
			</div>
		</div>
	</div><!-- /.row -->
	<?php if ($permiso == '0' && $activo != 5) { ?>
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?= base_url() . 'assets/img/MiEmpresa.png' ?>" alt=""/>
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-heading"></p>
								<p class="announcement-text">Mi Empresa</p>
							</div>
						</div>
					</div>

					<a href="<?= base_url() . 'empresa/Perfil/ver_completar' ?>">
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
		</div><?php } ?>
	<?php if ($permiso == '0' && $activo == 5) { ?>
		<div class="row">
			<div class="col-lg-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?= base_url() . 'assets/img/MiEmpresa.png' ?>" alt=""/>
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-heading"></p>
								<p class="announcement-text">Mi Empresa</p>
							</div>
						</div>
					</div>

					<a href="<?= base_url() . 'empresa/Perfil/ver_completar' ?>">
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
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?= base_url() . 'assets/img/UsuariosEmpresa.png' ?>" width="175" height="125"/>
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-heading"></p>
								<p class="announcement-text">Mis Usuarios</p>
							</div>
						</div>
					</div>
					<a href="<?= base_url() . 'empresa/Perfil/get_personal' ?>">
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
								<img src="<?= base_url() . 'assets/img/MisVehiculos.png' ?>" alt="Mis vehiculos">
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-text">Mis Vehiculos</p>
								<p class="announcement-text"></p>
							</div>
						</div>
					</div>
					<a href="<?= base_url() . 'empresa/Perfil/get_vehiculos' ?>">
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
			<div class="col-lg-3">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<img src="<?= base_url() . 'assets/img/Misconductores.png' ?>" alt="Mis conductores">
							</div>
							<div class="col-xs-6 text-right">
								<p class="announcement-text">Mis Conductores</p>
								<p class="announcement-text"></p>
							</div>
						</div>
					</div>
					<a href="<?= base_url() . 'empresa/Empleo' ?>">
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
					<a href="<?= base_url() . "empresa/Vehiculos/GetCuentaVehiculo/1" ?>">
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
		</div>
	<?php } ?>
	<!-- /.row -->
</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('empresa/vwFooter');
?>
