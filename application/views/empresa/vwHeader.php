<?php $session_data = $this->session->userdata('datos_sos');
$session_data2 = $this->session->userdata('datos_repo');
$contsos = $session_data['contsos'];
$contrepo = $session_data2['contrep'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="abhishek@devzone.co.in">
        <title>Enturne APP</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/calendar/jquery-ui.css'?>" />
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/sweetalert/dist/sweetalert.css'?>">
        <!-- alertify -->
        <link href="<?php echo base_url() . 'assets/css/alertify.min.css'?>" rel="stylesheet" type="text/css">
        <style type="text/css">
            #sidebar{
                position: absolute;
                width: 100px;
                height: 600px;
                background: #F7E000;
                color: #fff;
                margin-left: 1005px;
                margin-top: -600px;
                border: 1px solid #F7E000;
            }
            ul{
                padding: 0;
                text-align: justify;
            }

            #li_side{
                cursor: pointer;
                border-top: 1px solid #fff;
                background: #000000;
                list-style: none;
                color: #F7E000
            }
            #li_side:hover{
                background: #F7E000;
                color: black;
            }
        </style>

    </head>

    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#FFE000;">
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
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <ul class="nav navbar-nav side-nav">
                        <li class="<?=(current_url()==base_url('empresa/Dashboard')) ? 'active':''?>"><a href="<?php echo base_url() . 'empresa/Dashboard' ?>" title="Tablero Principal"><img src="<?php echo base_url().'assets/img/panel.png'?>" alt="Panel Principal" width="60px" height="60px"></a></li>
                        <!--<li><?php if ($permiso === '0' && $activo==5) { ?><a href="<?php echo base_url() . 'empresa/Perfil/get_personal' ?>" title="Mis Usuarios"><i class="fa fa-users fa-3x"></i> </a><?php } else { ?><?php } ?></li>-->
                        <li class="<?=(current_url()==base_url('empresa/Ofertas')) ? 'active':''?>"><?php if ($activo == 5) { ?><a href="<?php echo base_url() . 'empresa/Ofertas' ?>" title="Busque Camiones"><img src="<?php echo base_url().'assets/img/BuscarCamiones.png'?>" alt="Buscar Camiones" width="60px" height="60px" onclick="cambio(this)"></a><?php } else { ?><?php } ?></li>
                        <li class="<?=(current_url()==base_url('empresa/Gps')) ? 'active':''?>"><?php if ($activo == 5) { ?><a href="<?php echo base_url() . 'empresa/Gps' ?>" title="GPS-CONDUCTOR"><img src="<?php echo base_url().'assets/img/GpsCamiones.png'?>" alt="Gps Camiones" width="60px" height="70px"></a><?php } else { ?><?php } ?></li>         
                        <li class="<?=(current_url()==base_url('empresa/Mensajes/get_reportes')) ? 'active':''?>"><?php if ($activo == 5) { ?><a href="<?php echo base_url() . 'empresa/Mensajes/get_reportes' ?>" title="Reportes Conductores"><img src="<?php echo base_url().'assets/img/Reportarme.png'?>" alt="Reportes Conductores" width="60px" height="60px"></a><?php } else { ?><?php } ?></li>
                        <li class="<?=(current_url()==base_url('empresa/Ofertas/contratados_historico')) ? 'active':''?>"><?php if ($activo == 5) { ?><a href="<?php echo base_url() . 'empresa/Ofertas/contratados_historico' ?>" title="Historico de camiones contratados"><img src="<?php echo base_url().'assets/img/Historico.png'?>" alt="Historico de camiones contratados" width="60px" height="60px"></a><?php } else { ?><?php } ?></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li>
                            <a href = "<?php echo base_url('empresa/Mensajes/get_reportes')?>"><i class = "fa fa-info" style="color:red"></i> Reportes <span class = "badge" style="color:orange" id="numrepo"><?php echo $contrepo?></span></a>           
                        </li>
                        <li>
                            <a href = "<?php echo base_url('empresa/Alertas/get_soss')?>"><i class = "fa fa-bell" style="color:red"></i> SOS <span class = "badge" style="color:red" id="numsos"><?php echo $contsos?></span></a>           
                        </li>

                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $usuario ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . 'empresa/Perfil/get_perfil' ?>"><i class="fa fa-user"></i>  Mi Perfil</a></li>
                                <li><?php if ($permiso === '0') { ?><a href="<?php echo base_url() . 'empresa/Perfil/get_empresa' ?>"><i class="fa fa-building"></i> Mi empresa </a><?php } else { ?><?php } ?></li>
                                <li><?php if ($permiso === '0' && $activo==5) { ?><?php } ?></li>
                                <li><a href="<?php echo base_url() . 'Registros'?>" target="_blank"><i class="fa fa-registered"></i> RegistrarME como transportador</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url() . 'Login/logout' ?>"><i class="fa fa-power-off"></i> Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
