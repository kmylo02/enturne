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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Enturne</title>
        <link rel="icon" href="<?= base_url();?>assets/ico/favicon.ico">
        <!--link the bootstrap css file-->
        <link href="<?= base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">

        <style type="text/css">
            body{
                background-image: url("<?php echo base_url() . 'assets/images_login/bg.jpg' ?>")
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

        <div class="container">

            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Recordar contraseña</div>

                    </div>

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <?php
                        $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
                        echo form_open("Registros/new_password", $attributes);
                        ?>
                        <input type="hidden" name="id" value="<?= $datos->idUser;?>"/>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="password" class="form-control" name="password" placeholder="Nueva Contraseña">
                        </div>
                        <?php echo "<h5 style='color:red'>" . form_error('password') . "</h5>"; ?>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="password" class="form-control" name="passconf" placeholder="Repita Contraseña">
                        </div>
                        <?php echo "<h5 style='color:red'>" . form_error('passconf') . "</h5>"; ?>
                        <h5 style="color:red"><?php echo $mensaje?></h5>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <div class="pager">
                                    <input type="submit" id="btn-login" class="btn btn-success" name="reg_newpass" value="Validar"/>

                                    <!--<a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>-->


                                    <li class="previous"><a href="<?= base_url() . 'Login' ?>"><span aria-hidden="true">&larr;</span> Volver</a></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>


        </div>
        <!--load jQuery library-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!--load bootstrap.js-->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() . 'assets/js/base_url.js'?>"></script>
    </body>
</html>
