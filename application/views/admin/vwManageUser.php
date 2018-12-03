<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Usuarios<small> Modulo de Administración</small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
			</ol>

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
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Empresas";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
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
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Users WHERE idNivel='3'";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
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
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Vehiculos";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
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
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Users WHERE idNivel='4'";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
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
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('admin/vwFooter');
?>
