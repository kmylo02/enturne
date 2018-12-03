<?php
$this->load->view('admin/vwHeader');
?>
<!--
Load Page Specific CSS and JS here
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->
<!--  PAge Code Starts here -->

<!-- Page Specific Plugins -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<!-- Page Specific CSS -->
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="<?php echo base_url() . 'assets/js/morris/chart-data-morris.js' ?>"></script>

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Configuraciones<small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
			</ol>

		</div>
	</div><!-- /.row -->

	<div class="row">
		<div class="col-lg-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-flag fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Paises";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
							<p class="announcement-text">Paises</p>
						</div>
					</div>
				</div>
				<a href="#">
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
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<i class="fa fa-language fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM df_idioma";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
							<p class="announcement-text">Idioma</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Idioma' ?>">
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
							<i class="fa fa-money fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Divisas";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
							<p class="announcement-text">Divisas</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Divisas' ?>">
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
							<i class="fa fa-dollar fa-5x"></i>
						</div>
						<div class="col-xs-6 text-right">
							<p class="announcement-heading"><?php
								$sql = "SELECT * FROM Taxes";
								$consulta = $this->db->query($sql);

								$count1 = $consulta->num_rows(); //get current query record.

								echo $count1;
								?></p>
							<p class="announcement-text">Impuestos</p>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url() . 'admin/Impuestos' ?>">
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
