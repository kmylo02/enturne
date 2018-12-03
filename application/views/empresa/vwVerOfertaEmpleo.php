<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Editar <small> Oferta de empleo</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i></li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="<?php echo base_url() . 'empresa/Empleo/update_oferta' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_oferta" value="<?php foreach($oferta as $row){
              echo $row->id_oferta;
            }?> "/>

        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Describe tu oferta:</label>
            <div class = "col-xs-4">
              <textarea class="form-control" name="descripcion"><?php echo $row->descripcion?></textarea>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "submit" class = "btn btn-primary" name = "update_reg" value = "Actualizar"/>
            </div>
        </div>
    </form>

    <div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
