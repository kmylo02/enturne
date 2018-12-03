<?php
$session_data = $this->session->userdata('datos_sos');
$contsos = $session_data['contsos'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="abhishek@devzone.co.in">

		<title>Enturne APP</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/calendar/jquery-ui.css' ?>" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
		<!-- Add custom CSS here -->
		<link href="<?php echo base_url() . 'assets/css/arkadmin.css' ?>" rel="stylesheet">
		<!-- JavaScript -->
		<link href="<?php echo base_url() . 'assets/css/img.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/estilos.css' ?>" rel="stylesheet">
		<!-- sweetalert -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/sweetalert/dist/sweetalert.css' ?>">
		<!-- alertify -->
		<link href="<?php echo base_url() . 'assets/css/alertify.min.css' ?>" rel="stylesheet" type="text/css">
	</head>

	<body>

		<div id="wrapper">
			<!-- Sidebar -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#FFE000;">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="margin-left:1em;">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="http://www.enturne.co"><span><p style="font: oblique bold 120% cursive;font-size: x-large; color:gray; "> enturne</p></span></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li class="<?= (current_url() == base_url('admin/Dashboard')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Dashboard' ?>" title="Tablero Principal"><img src="<?php echo base_url() . 'assets/img/PanelAdmin.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>
						<li class="<?= (current_url() == base_url('admin/Opciones')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Opciones' ?>" title="Opciones"><img src="<?php echo base_url() . 'assets/img/configurar.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>
						<!--<li class="<?= (current_url() == base_url('admin/Users')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Users' ?>" title="Usuarios"><img src="<?php echo base_url() . 'assets/img/usuarios.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>-->
						<li class="<?= (current_url() == base_url('admin/Ofertas')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Ofertas' ?>" title="Ofertas de Carga"><img src="<?php echo base_url() . 'assets/img/CargaAdmin.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>
						<li class="<?= (current_url() == base_url('admin/Empleo')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Empleo' ?>" title="Ofertas de Empleo"><img src="<?php echo base_url() . 'assets/img/Empleo.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>
						<li class="<?= (current_url() == base_url('admin/Gps')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'admin/Gps' ?>" title="GPS"><img src="<?php echo base_url() . 'assets/img/GpsAdmin.png' ?>" width="60px" height="60px" alt="Tablero Principal"></a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right navbar-user">

						<li class="dropdown-toggle messages-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Mensajes <span class="badge"></span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header"><?php echo $count ?> Nuevo(s) registros(s)</li>
								<li class = "divider"></li>
								<li class="dropdown-header">
								<li class = "divider"></li>
								<li><a href = "#">Total <span class = "badge"><?php echo $count ?></span></a></li>
							</ul>
						</li>
						<li>
							<a href = "<?php echo base_url('admin/Alertas/get_soss') ?>"><i class = "fa fa-bell" style="color:red"></i> SOS <span class = "badge" style="color:red" id="numsos"><?php echo $contsos ?></span></a>
						</li>
						<li class="dropdown user-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> <?php echo $usuario ?></i>
								<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url() . 'admin/Perfil/get_perfil' ?>"><i class="fa fa-user"></i> Mi Perfil</a></li>
								<li><a href="<?php echo base_url() . 'admin/Perfil/get_empresa' ?>"><i class="fa fa-building"></i> Mi Empresa</a></li>
								<li><a href="<?php echo base_url() . 'admin/Perfil/get_personal' ?>"><i class="fa fa-users"></i> Personal Empresa</a></li>
								<li><a href="#"><i class="fa fa-user-secret"></i> Mis conductores <span class="badge">7</span></a></li>
								<li><a href="#"><i class="fa fa-save"></i> Registrar como conductor</a></li>
								<li><a href="#"><i class="fa fa-truck"></i> Vehiculos</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo base_url() . 'Login/logout' ?>"><i class="fa fa-power-off"></i> Salir</a></li>
							</ul>
						</li>
					</ul>

				</div><!-- /.navbar-collapse -->
			</nav>
