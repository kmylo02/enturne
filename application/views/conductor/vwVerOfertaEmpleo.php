<?php
$this->load->view('conductor/vwHeader');
if (!$aplicando) {
    $id_user = '';
} else {
    foreach ($aplicando as $key) {
        $id_user = $key->id_user;
        $estado = $key->estado;
    }
}
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Detalles Oferta de Empleo <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Detalles</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <?php
    $attributes = array("class" => "form-horizontal", "name" => "aplicar_empleo", "id" => "basicBootstrapForm");
    echo form_open("conductor/Empleo/aplicar_empleo", $attributes);
    ?>
    <div class="form-group">
        <input type="hidden" name="user_id" value="<?= $user->id; ?> "/>
        <label class="col-xs-3 control-label">Razón Social</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php
            foreach ($oferta as $fila) {
                echo $fila->nombre_empresa;
            }
            ?>" disabled/>
        </div>
    </div>

    <input type="hidden" name="id_oferta" value="<?= $fila->id_oferta;
           ?>"/>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Fecha Oferta</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "apellidos" value="<?= $fila->created_at;
                   ?>" disabled/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Descripción:</label>
        <div class = "col-xs-4">
            <textarea class = "form-control" name = "desc" value="<?= $fila->descripcion;
                      ?>" disabled><?= $fila->descripcion;
                ?></textarea>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Web:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" value="<?= $fila->web;
                   ?>" disabled/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Ciudad empresa:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" value="<?= $fila->nombre_ciudad
                   ?>" disabled/>
        </div>
    </div>
<?php if ($user->id == $id_user && $estado == 'Aplicando') { ?>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <h3><span class="label label-warning">Usted ya esta aplicando a esta oferta</span>
            </div>
        </div>
<?php } if ($user->id == $id_user && $estado == 'Descartado') { ?>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <h3><span class="label label-warning">Descartado</span>
            </div>
        </div>
<?php } if ($user->id == $id_user && $estado == 'Contratado') { ?>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <h3><span class="label label-warning">Usted ha sido contratado, por favor contacte con la empresa ofertante.</span>
            </div>
        </div>
<?php } if ($user->id != $id_user) { ?>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "button" class = "btn btn-success" value="Aplicar" onclick="ConfirmAplicar()"/>
            </div>
        </div>
    <?php } ?>
<?php echo form_close(); ?>
</div><!--/#page-wrapper -->
<?php
$this->load->view('conductor/vwFooter');
?>
