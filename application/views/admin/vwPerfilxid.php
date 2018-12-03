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
            <h1>Editar Personal <small>1</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-user-secret"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <form id="frmEditEmpleado" action="javascript:editEmpleado()" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre Completo(*):</label>
            <div class="col-xs-4">            
                <input type="text" class="form-control" name="firstName"  value="<?php echo $nombre?>" required>
                <input type="hidden" name="idempleado" value="<?php echo $idempleado ?>">
            </div>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "lastName" value="<?php echo $apellidos?>" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
            <div class = "col-xs-3">
                <select name="tipo_doc" class="form-control">
                    <?php echo $optiondoc?>
                </select>
            </div>
            <label class = "col-xs-1 control-label">No(*):</label>
            <div class = "col-xs-3">
                <input type="text" class = "form-control" name = "cc" value="<?php echo $cedula?>" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Sexo(*):</label>
            <div class = "col-xs-4">
                <?php echo $radio?>            
            </div>
        </div>

        <div>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i></li>
                <li class="active"><i class="icon-file-alt"></i> Información Residencial</li>
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
            <label class = "col-xs-3 control-label">Dirección(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "address" value="<?php echo $direccion?>" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Teléfono(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "phone" value="<?php echo $telefono?>" onKeyPress="return validar(event)" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Celular(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "celphone" value="<?php echo $celular?>" onKeyPress="return validar(event)" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email(*)</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?php echo $email?>" required>
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
