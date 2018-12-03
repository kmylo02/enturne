<?php
$ubicacion_data = $this->session->userdata('datos_ubicacion');
$usuario_data = $this->session->userdata('datos_usuario');
$sos_data = $this->session->userdata('datos_sos');
$lat = $ubicacion_data['latitud'];
$long = $ubicacion_data['longitud'];
$contsos = $sos_data['contsos'];
$propietario = $usuario_data['propietario'];
$tipo = $usuario_data['tipo'];
$estado = $usuario_data['activo'];
$idUsuario = $usuario_data['id'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="abhishek@devzone.co.in">
		<title>Enturne Conductor</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/calendar/jquery-ui.css' ?>" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
		<!-- JavaScript -->
		<link href="<?php echo base_url() . 'assets/css/img.css' ?>" rel="stylesheet">
		<link href="<?php echo base_url() . 'assets/css/estilos.css' ?>" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
		<!-- Add custom CSS here -->
		<link href="<?php echo base_url() . 'assets/css/arkadmin.css' ?>" rel="stylesheet">
		<!-- sweetalert -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/sweetalert/dist/sweetalert.css' ?>">
		<!-- alertify -->
		<link href="<?php echo base_url() . 'assets/css/alertify.min.css' ?>" rel="stylesheet" type="text/css">

	</head>

	<body onload="very_licc()">
		<input type="hidden" id="lat" value="<?php echo $lat ?>"><input type="hidden" id="long" value="<?php echo $long ?>">
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
					<a href="http://www.enturne.co"><span><p style="font: oblique bold 60px cursive;font-size: x-large; color:gray; "> enturne</p></span></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<?php if ($estado == 1) {
							?>
							<li class="<?= (current_url() == base_url('conductor/Dashboard')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Dashboard' ?>" title="Tablero Principal"><img src="<?php echo base_url() . 'assets/img/panel.png' ?>" alt="Tablero Principal" width="60px" height="60px"></a></li>
							<li class="<?= (current_url() == base_url('conductor/Enturne')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Enturne' ?>" title="Enturnarme"><img src="<?php echo base_url() . 'assets/img/Enturnarme.png' ?>" alt="Enturne " width="60px" height="60px"></a></li>
							<li class="<?= (current_url() == base_url('conductor/Ofertas')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Ofertas' ?>" title="Mis Ofertas de carga"><img src="<?php echo base_url() . 'assets/img/MisOfertasdeCargas.png' ?>" alt="Ofertas" width="60px" height="60px"></a></li>
							<?php if ($tipo != 3) { ?>
								<li class="<?= (current_url() == base_url('conductor/Reportes')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Reportes' ?>" title="Reportes"><img src="<?php echo base_url() . 'assets/img/MensajesConductores.png' ?>" alt="Reportes" width="60px" height="60px"></a></li>
								<li class="<?= (current_url() == base_url('conductor/Gps')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Gps' ?>" title="Gps Satelital"><img src="<?php echo base_url() . 'assets/img/GpsAdmin.png' ?>" alt="Satelital" width="60px" height="60px"></a></li>
								<?php
							} else {

							}
							?>
							<li class="<?= (current_url() == base_url('conductor/Reportes/programo_mi_viaje')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Reportes/programo_mi_viaje' ?>" title="Planear costos y Ruta"><img src="<?php echo base_url() . 'assets/img/Programomiviaje.png' ?>" alt="Programo mi viaje" width="60px" height="60px"></a></li>
							<!--<li class="<?= (current_url() == base_url('conductor/Gps')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Gps' ?>" title="Gps Satelital"><img src="<?php echo base_url() . 'assets/img/GpsAdmin.png' ?>" alt="Satelital" width="60px" height="60px"></a></li>-->
							<?php if ($tipo != 3) { ?>
								<li class="<?= (current_url() == base_url('conductor/Empleo/vacantes_Empleo')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Empleo/vacantes_Empleo' ?>" title="Ofertas de empleo"><img src="<?php echo base_url() . 'assets/img/VacantesConductores.png' ?>" alt="Empleo" width="60px" height="60px"></a></li>
								<?php
							} else {

							}
							?>
						<?php } else { ?>
							<li class="<?= (current_url() == base_url('conductor/Dashboard')) ? 'active' : '' ?>"><a href="<?php echo base_url() . 'conductor/Dashboard' ?>" title="Tablero Principal"><img src="<?php echo base_url() . 'assets/img/panel.png' ?>" alt="Tablero Principal" width="60px" height="60px"></a></li>
						<?php } ?>
					</ul>

					<ul class="nav navbar-nav navbar-right navbar-user">
						<?php if ($propietario === NULL) { ?>
							<li>
								<a href = "<?php echo base_url('conductor/Alertas/get_soss') ?>"><i class = "fa fa-bell" style="color:red"></i> SOS <span class = "badge" style="color:red" id="numsos"><?php echo $contsos ?></span></a>
							</li><?php } ?>

						<li class="dropdown messages-dropdown" id="mensajes">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Mensajes <span class="badge">1</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">1 Nuevos mensajes</li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">Admin:</span>
										<span class="message">Bienvenido a enturne, recuerde que como conductor su licencia es gratuita, si desea agregar vehiculos a su nombre para enturnar tiene varias opciones de licencia por vehiculo. Asi mismo se le habilitarán los accesos de enturne, ofertas de carga y/o GPS cuando complete su perfil. </span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>

								<li><a href="#">Inbox <span class="badge">1</span></a></li>
							</ul>
						</li>

						<li class="dropdown user-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuario ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php if ($tipo == 1) { ?>
									<li><a href="<?php echo base_url() . 'conductor/Perfil/get_perfil' ?>"><i class="fa fa-user"></i>  Mi Perfil</a></li>
									<li><a href = "#"><i class = "fa fa-file-pdf-o"></i> Mis Contratos</a></li>
									<li><a href = "#" onclick="regPropietario(<?php echo $idUsuario ?>)"><i class = "fa fa-registered"></i> Registrarme como Propietario</a></li>
									<li class = "divider"></li>
									<li><a href = "<?php echo base_url() . 'Login/logout' ?>"><i class = "fa fa-power-off"></i> Salir</a></li>
								<?php } else if ($tipo == 2) { ?>
									<li><a href="<?php echo base_url() . 'conductor/Perfil/get_perfil' ?>"><i class="fa fa-user"></i>  Mi Perfil</a></li>
									<li><a href = "<?php echo base_url() . 'Login/logout' ?>"><i class = "fa fa-power-off"></i> Salir</a></li>
								<?php } else if ($tipo == 3) { ?>
									<li><a href="<?php echo base_url() . 'conductor/Perfil/get_perfil' ?>"><i class="fa fa-user"></i>  Mi Perfil</a></li>
									<li><a href = "#"><i class = "fa fa-file-pdf-o"></i> Mis Contratos</a></li>
									<li><a href = "#"><i class = "fa fa-registered"></i> Registrarme como Propietario - Conductor</a></li>
									<li class = "divider"></li>
									<li><a href = "<?php echo base_url() . 'Login/logout' ?>"><i class = "fa fa-power-off"></i> Salir</a></li>
									<?php } ?>
							</ul>
						</li>
					</ul>
				</div><!--/.navbar-collapse -->
			</nav>
