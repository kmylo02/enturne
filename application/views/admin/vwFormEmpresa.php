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
            <h1>Empresa <small>Ver / Editar </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building"></i> Datos Empresa</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <div style="width: 60%; margin: 0 auto;"></div>    
    <form id="frmEmpresa" method="post" action="javascript:actEmpresa()" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">Nombre(*):</label>
        <div class="col-xs-4">
           
            <input type="text" class="form-control" name="nombre"  value="<?php echo $nombre_empresa?>" required>
            <input type="hidden" name="id" value="<?php echo $id ?>"/>
        </div>
        <label class="col-xs-1 control-label">Logo</label>
        <div class="col-xs-4">
            <img id="foto_carnet" src="<?php echo base_url() ?>uploads/<?php echo $logo
                                       ?>" width="80px" height="50px" alt="Sin logo"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Siglas</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" name="siglas"  value="<?php echo $siglas ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Nit(*):</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "nit" value="<?php echo $nit ?>" required>
        </div>
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
            <select name="localidad" id="localidad" class="form-control" required>
                <?php echo $optciudad?>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Dirección(*):</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "direccion" value="<?php echo $direccion ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-envelope"></i> Datos De Contacto</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Teléfono(*):</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "telefono" value="<?php echo $telefono ?>" onKeyPress="return validar(event)" maxlength="10" required>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Fax</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "fax" value="<?php echo $fax ?>" onKeyPress="return validar(event)" maxlength="10">
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Celular</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "celular" value="<?php echo $celular ?>" onKeyPress="return validar(event)" maxlength="10">
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Email(*):</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "email" value="<?php echo $email ?>" required>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Web</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "web" value="<?php echo $web ?>" />
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Tipo de carga(*):</label>
        <div class = "col-xs-4">
            <select name="tipo_carga" class="form-control" required>
                <?php echo $optcarga?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dollar fa-2x"></i> Licencia</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Estado Licencia</label>
        <div class = "col-xs-4">
            <select class = "form-control" name = "activo">
                <?php echo $optlic?>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "update_reg" value="Actualizar"/>
        </div>
    </div>
    </form>

</div><!--/#page-wrapper -->


<?php
    $this->load->view('admin/vwFooter');
?>
