<?php
$session_data = $this->session->userdata('datos_usuario');
if(!$session_data){
    redirect('Login');
}  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="sistemas@enturne.co">
        <title>Enturne APP</title>
        <link rel="icon" href="<?php echo base_url();?>assets/ico/favicon.ico">
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>" rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="<?php echo base_url() . 'assets/css/img.css' ?>" rel="stylesheet">
        <!-- Add custom CSS here -->
        <link href="<?php echo base_url() . 'assets/css/arkadmin.css' ?>" rel="stylesheet">
        <!-- JavaScript -->
        <script src="<?php echo base_url() . 'assets/js/jquery-1.10.2.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/das.js' ?>"></script>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/base_url.js'?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#pais").change(function () {
                    $("#pais option:selected").each(function () {
                        pais = $('#pais').val();
                        $.post("<?php echo base_url() . 'Paises/llena_provincias' ?>", {
                            pais: pais
                        }, function (data) {
                            $("#provincia").html(data);
                        });
                    });
                })
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#provincia").change(function () {
                    $("#provincia option:selected").each(function () {
                        provincia = $('#provincia').val();
                        $.post("<?php echo base_url() . 'Paises/llena_localidades' ?>", {
                            provincia: provincia
                        }, function (data) {
                            $("#localidad").html(data);
                        });
                    });
                })
            });
        </script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
          <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
        <![endif]-->
        <!--

    Author : Jhon Jairo Valdés Aristizabal
    Downloaded from http://devzone.co.in
        -->
        <script type="text/javascript">
            function validar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla == 8)
                    return true; //Tecla de retroceso (para poder borrar)
                if (tecla == 44)
                    return true; //Coma ( En este caso para diferenciar los decimales )
                if (tecla == 48)
                    return true;
                if (tecla == 49)
                    return true;
                if (tecla == 50)
                    return true;
                if (tecla == 51)
                    return true;
                if (tecla == 52)
                    return true;
                if (tecla == 53)
                    return true;
                if (tecla == 54)
                    return true;
                if (tecla == 55)
                    return true;
                if (tecla == 56)
                    return true;
                if (tecla == 57)
                    return true;
                patron = /1/; //ver nota
                te = String.fromCharCode(tecla);
                alert('Campo solo númerico');
                return patron.test(te);
            }
        </script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                <?php
// Define a default Page
                $pg = isset($page) && $page != '' ? $page : 'dash';
                ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li <?php echo $pg == 'dash' ? 'class="active"' : '' ?>><a href="<?php echo base_url() . 'gps/Dashboard'?>" title="Tablero Principal"><i class="fa fa-dashboard fa-3x"></i></a></li>
                        <li <?php echo $pg == 'gps' ? 'class="active"' : '' ?>><a href="<?php echo  base_url().'gps/Gps'?>" title="GPS"><i class="fa fa-map-marker fa-3x"></i></a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario'] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . 'gps/Perfil/get_perfil' ?>"><i class="fa fa-user"></i>  Mi Perfil</a></li>
                                <li><a href="#"><i class="fa fa-truck"></i> Mis Vehiculos</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url().'Login/logout'?>"><i class="fa fa-power-off"></i> Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
