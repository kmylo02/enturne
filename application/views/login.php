<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Enturne</title> 
        <link rel="icon" href="<?= base_url() ?>assets/ico/favicon.ico">
        <!--link the bootstrap css file-->
        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <!--load jQuery library-->
        <script src="<?= base_url() ?>assets/js/jquery.js"></script>
        <!--load bootstrap.js-->
        <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
        <!-- sweetalert -->
        <script src="<?= base_url() ?>assets/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/sweetalert/dist/sweetalert.css">
        <!-- funciones -->
        <script src="<?= base_url() ?>assets/js/base_url.js"></script>
        <script src="<?= base_url() ?>assets/js/login.js"></script>

        <style type="text/css">
            body{
                background-image: url("<?= base_url() . 'assets/images_login/bg.jpg' ?>")
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
        <?= validation_errors(); ?>
        <div class="container"> 

            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Acceso a plataforma Enturne</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-5px"><a href="<?= base_url() . 'Registros/forget_pass' ?>">Olvido su contraseña</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>                        
                        <form method="post" action="javascript:login()" id="loginForm" class="form-horizontal">
                            <div style="margin-bottom: 25px" class="input-group">
                                <?= "<h5 style='color:red'>" . form_error('username') . "</h5>"; ?>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="number" class="form-control" name="username" placeholder="No. De identificación" required>                                        
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <?= "<h5 style='color:red'>" . form_error('password') . "</h5>"; ?>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            </div>
                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Recordarme
                                    </label>
                                </div>
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <div class="pager">
                                        <input type="submit" id="btn-login" class="btn btn-success" name="submit_login" value="Ingresar"/>

                                        <!--<a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>-->


                                        <li class="previous"><a href="http://www.enturne.co"><span aria-hidden="true">&larr;</span> Volver</a></li>                                        
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        <h4>No tengo cuenta!</h4> 
                                        <a href="<?= base_url() . 'Registros' ?>"> <h3>Registrarme</h3>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </form>
                    </div>                     
                </div> 
            </div>

        </div>
    </body>
</html>
