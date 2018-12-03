<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Perfil Administrador <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>    
    <form id="frmActPersonal" method="post" action="javascript:actPersonal()" class="form-horizontal">
        <input type="hidden" class="form-control" name="id_empresa"  value="<?= $idempresa ?>" ></input>
        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre Completo(*):</label>
            <div class="col-xs-4"> 
                <?php if ($nombre === "") { ?>
                    <input type="text" name="firstName" class="form-control">
                <?php } else { ?>
                    <input type="text" class="form-control" value="<?= $nombre ?>" disabled=""> 
                    <input type="hidden" name="firstName" value="<?= $nombre ?>"> 
                <?php } ?>           
            </div>
            <div class = "col-xs-4"> 
                <?php if ($apellidos === "") { ?>
                    <input type="text" name="lastName" class="form-control">
                <?php } else { ?>
                    <input type="text" class="form-control" value="<?= $apellidos ?>" disabled="">
                    <input type="hidden" name="lastName" value="<?= $apellidos ?>">
                <?php } ?>  
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
            <div class = "col-xs-3">           
                <select name="tipo_doc" class="form-control">
                    <?= $optiondoc ?>
                </select>
            </div>
            <label class = "col-xs-1 control-label">No(*):</label>
            <div class = "col-xs-3"> 
                <?php if ($cedula === NULL) { ?>
                    <input type="text" name="cc" class="form-control">
                <?php } else { ?>
                    <input type="text" name="cc" class="form-control" value="<?= $cedula ?>" disabled=""> 
                    <input type="hidden" name="cc" value="<?= $cedula ?>"> 
                <?php } ?> 
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de nacimiento(*):</label>
            <div class="col-xs-2">
                <?php if ($fecha_nac === NULL) { ?>
                    <input type="date" class="form-control" name="theDate">
                <?php } else { ?>
                    <input type="date" name="theDate" class="form-control" value="<?= $fecha_nac ?>" readonly>
                <?php } ?> 
            </div>        
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Sexo(*):</label>        
            <div class = "col-xs-4">
                <?= $radio ?>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Departamento(*):</label>
            <div class = "col-xs-4">            
                <select name="provincia" id="provincia" class="form-control" required>
                    <?= $optdpto ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad(*):</label>
            <div class = "col-xs-4">            
                <select name="localidad" id="localidad" class="form-control" required>
                    <?= $optciudad ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Dirección(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "address" value="<?= $direccion ?>" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Teléfono(*):</label>
            <div class = "col-xs-4">
                <input type = "number" class = "form-control" name = "phone" value="<?= $telefono ?>" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Celular(*):</label>
            <div class = "col-xs-4">
                <input type = "number" class = "form-control" name = "celphone" value="<?= $celular ?>" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email(*)</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?= $email ?>" required>
            </div>
        </div>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "submit" class = "btn btn-primary" name = "update_user" value="Actualizar" />
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
