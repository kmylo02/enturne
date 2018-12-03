<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Enturne APP</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.png">
        <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
        <!-- sweetalert -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/sweetalert/dist/sweetalert.css'?>">
		<!-- alertify -->
		<link href="<?php echo base_url() . 'assets/css/alertify.min.css'?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() . 'assets/css/estilos.css'?>" />
        <style type="text/css">
            body{
                background-image: url("<?php echo base_url().'assets/images_login/bg1.png'?>")
            }
            .colbox {
                margin-left: 0px;
                margin-right: 0px;
            }
            .panel{
                background: rgba(255, 255, 255, 0.4);
            }
        </style>
    </head>
    <body>
        <div class="container" id="regusu">
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Registro en plataforma Enturne</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="frmRegistro" method="post" action="javascript:registro()" class="form-horizontal">
                        <div style="margin-bottom: 25px" class="input-group">
                            <label>Los campos con * son obligatorios.</label>
                        </div>
                        <div style="margin-bottom: 25px" class="select-group">  
                            <select class="form-control" name="nivel" id="nivel" required>
                                <option value="">Seleccione tipo de usuario(*):</option>
                                <option value="2">Empresa de transporte</option>
                                <option value="3">Transportador</option>
                                <option value="4">Solicitud GPS-Vehiculo</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 25px" class="select-group">  
                            <select class="form-control" name="tipo" id="tipo" required>
                                <option value="">Seleccione tipo de transportista(*):</option>
                                <option value="1">Solo Conductor</option>
                                <option value="2">Conductor-Propietario</option>
                                <option value="3">Solo Propietario</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class=""></i></span>
                            <input id="login-username" type="text" class="form-control" name="nombre" value="" placeholder="Nombre(*):" required>
                        </div>
                        
                        <div style="margin-bottom: 25px" class="input-group">

                            <span class="input-group-addon"><i class=""></i></span>
                            <input  type="text" class="form-control" name="apellidos" placeholder="Apellidos(*):" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                            <input  type="text" class="form-control" name="telefono" placeholder="Teléfono(*):" onKeyPress="return validar(event)" maxlength="10" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input  type="email" class="form-control" name="email" placeholder="E-mail(*):" required>
                        </div>
                        <input type="hidden" name="code" value="<?php echo $code = rand(1000, 99999) ?>"/>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  type="text" class="form-control" name="username" placeholder="Usuario(*): No Doc Identidad" onKeyPress="return validar(event)" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <?php echo form_error('password'); ?>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input  type="password" class="form-control" name="password" id="pswd" placeholder="Contraseña(*):" required>                            
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <?php echo form_error('passconf'); ?>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input  type="password" class="form-control" name="passconf" id="pswdc" placeholder="Confirmar Contraseña(*):" required>
                        </div>
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="terminos" value="1" required>Acepto los <a href="<?php echo base_url().'Terypo/term'?>" target="_blank">Terminos del servicio</a> y sus<a href="<?php echo base_url().'Terypo/pol'?>" target="_blank"> Politicas de Privacidad</a>
                                </label>
                            </div>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <div class="pager">
                                    <input type="submit" class="btn btn-success" value="Registrar"/>

                                    <!--<a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>-->


                                    <li class="previous"><a href="<?php echo base_url() . 'Login' ?>"><span aria-hidden="true">&larr;</span> Volver</a></li>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <div class="container" id="regemp">
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Registro en plataforma Enturne</div>
                    </div>
                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="frmRegistroEmp" method="post" action="javascript:registroEmp()" class="form-horizontal">
                        <div style="margin-bottom: 25px" class="input-group">
                            <label>Los campos con * son obligatorios.</label>
                        </div>
                        <div style="margin-bottom: 25px" class="select-group">
                            <input type="hidden" class="form-control" name="nivel" value="2"/>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class=""></i></span>
                            <input type="text" class="form-control" name="nombre" value="" placeholder="Empresa(*):" required>
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class=""></i></span>
                            <input  type="text" class="form-control" name="siglas" placeholder="Siglas:">
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                            <input  type="text" class="form-control" name="telefono" placeholder="Teléfono(*):" onKeyPress="return validar(event)" maxlength="12" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input  type="email" class="form-control" name="email" placeholder="E-mail(*):" required>
                        </div>
                        <input type="hidden" name="code" value="<?php echo $code = rand(1000, 99999) ?>"/>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input  type="text" class="form-control" name="username" placeholder="Usuario(*): Nit de empresa" onKeyPress="return validar(event)" maxlength="9" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input  type="password" class="form-control" name="password" placeholder="Contraseña(*):" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input  type="password" class="form-control" name="passconf" placeholder="Confirmar Contraseña(*):" required>
                        </div>
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="terminos" value="1" required>Acepto los <a href="<?php echo base_url().'Terypo/term'?>" target="_blank">Terminos del servicio</a> y sus<a href="<?php echo base_url().'Terypo/pol'?>" target="_blank"> Politicas de Privacidad</a>
                                </label>
                            </div>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <div class="pager">
                                    <input type="submit" class="btn btn-success" value="Registrar"/><li class="previous"><a href="<?php echo base_url() . 'Login' ?>"><span aria-hidden="true">&larr;</span> Volver</a></li>
                                </div>
                            </div>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
        </div>
    <!--//End-login-form-->
    <!--load jQuery library-->
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <!--load bootstrap.js-->
    <script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/base_url.js'?>"></script>
    <script src="<?php echo base_url() . 'assets/js/registro.js'?>"></script>
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
        <script>
        $(function () {
           $('#regemp').hide();
           $('#nivel').change(function () {
               $('#regemp').hide();
               if (this.options[this.selectedIndex].value == '2') {
                   $('#regemp').show();
                   $('#regusu').hide();
               }
           });
           $('#tipo').hide();
           $('#nivel').change(function () {
               $('#tipo').hide();
               if (this.options[this.selectedIndex].value == '3') {
                   $('#tipo').show();
               }
           });
           $('#pswdc').mouseout(function(){
               if($('#pswdc').val()!=$('#pswd').val()){
                   alert('Las contraseñas no coinciden!');
               }
           })
        });
</script>
<script src="<?php echo base_url().'assets/sweetalert/dist/sweetalert.min.js'?>"></script>
<script src="<?php echo base_url() . 'assets/js/alertify.min.js'?>"></script>
</body>
</html>
