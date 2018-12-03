<?php
$this->load->view('conductor/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Empleo/Ofertas_Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Asignar vehiculo al conductor a contratar</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <form id="frm_asignar_vehiculo" method="post" action="javascript:contratarConductor()">
        <div class="form-group">
            <input type="hidden" name="id_conductor" value="<?php echo $id_conductor ?> ">
            <input type="hidden" name="id_oferta" value="<?php echo $id_oferta ?> ">
            <div class="col-xs-12">
                <select class="form-control" name="placa" required><?php echo $body ?></select>
            </div>
            <div class="col-xs-12">
                <input type="submit" class="form-control" value="Asignar">
            </div>
        </div>
    </form>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');

