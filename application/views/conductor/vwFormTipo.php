<?php
$this->load->view('conductor/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Transportista solo propietario</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Perfil/comp_info' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("conductor/Perfil/update_tipo", $attributes);
    ?>
    <div class="form-group">
        <label class="col-xs-3 control-label">Tipo transportista:</label>
        <div class="col-xs-4">
          <select name="tipo" class="form-control">
          <option value="2">Solo propietario</option>
          <option value="1">Propietario Conductor / Solo Conductor</option>  
          </select>
        </div>
    </div>
    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "update_user" value = "Actualizar" />
        </div>
    </div>
    <?php echo form_close() ?>
</div><!--/#page-wrapper -->


<?php
$this->load->view('conductor/vwFooter');
?>
