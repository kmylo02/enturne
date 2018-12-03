<?php
$this->load->view('admin/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Ver / Completar <small>Perfil</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Perfil/get_perfil' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-user-secret"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" enctype="multipart/form-data" action="javascript:actPerfil()" id="actPerfilForm" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre Completo</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="firstName" placeholder="Nombre" value="<?php echo $nombre?>">
            </div>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "lastName" placeholder = "Apellidos" value="<?php echo $apellidos;
                ?>" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label disabled">Tipo de documento</label>
            <div class = "col-xs-3">
                <select class="form-control" name="tipo_doc">
                    <?php echo $optiondoc?>
                </select>
            </div>


            <label class = "col-xs-1 control-label">No</label>
            <div class = "col-xs-3">
                <input type="text" class = "form-control" name = "cc" value="<?php
                echo $cedula
                ?>"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de nacimiento</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" value="<?php
                echo $fecha_nac;
                ?>" name="theDate" id="fechanac">
            </div>            
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Estado Civil</label>
            <div class = "col-xs-5">
                <select class="form-control" name="est_civil">
                    <?php echo $optionestac?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Sexo</label>
            <div class = "col-xs-6">
                <?php echo $radio?>
            </div>
        </div>
        <div>
            <ol class="breadcrumb">
                <li><i class="fa fa-envelope"></i></li>
                <li class="active"><i class="icon-file-alt"></i> Datos De Contacto</li>
                <div style="clear: both;"></div>
            </ol>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Departamento(*):</label>
            <div class = "col-xs-4">
                <select name="provincia" id="provincia" class="form-control">
                  <?php echo $optdpto?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad(*):</label>
            <div class = "col-xs-4">
                <select name="localidad" id="localidad" class="form-control">
                    <?php echo $optciudad?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Teléfono</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "phone" value="<?php
                echo $telefono;
                ?>" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>

         <div class = "form-group">
            <label class = "col-xs-3 control-label">Celular</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "celphone" value="<?php
                echo $celular;
                ?>" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Dirección</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "address" value="<?php
                echo $direccion;
                ?>" />
            </div>
        </div>

         <div class = "form-group">
            <label class = "col-xs-3 control-label">Email</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?php
                echo $email;
                ?>" />
            </div>
        </div>

        <div>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i></li>
                <li class="active"> Datos De Vivienda</li>
                <div style="clear: both;"></div>
            </ol>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tipo de vivienda</label>
            <div class = "col-xs-4">
                <select name="tipo_vivienda" class="form-control">
                    <?php echo $optvivienda?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Meses en vivienda:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "meses_vivienda" value="<?php
                echo $mesvivienda;
                ?>" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>

       <div>
            <ol class="breadcrumb">
                <li><i class="fa fa-car"></i></li>
                <li class="active"> Datos Licencia de conducción</li>
                <div style="clear: both;"></div>
            </ol>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">No Licencia:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "licencia_conduccion" value="<?php
                echo $numlicencia;
                ?>" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Categoria:</label>
            <div class = "col-xs-4">
                <select name="categoria_lic"  class="form-control">
                    <?php echo $optcatlic?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Vence:</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" value="<?php
                echo $fecha_ven_licencia;
                ?>" name="theDatev" id="fechavenlic">
            </div>            
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "update_user" value = "Sign up">Actualizar</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
