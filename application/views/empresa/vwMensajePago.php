<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1><small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-home fa-2x"></i></a></li>
                <li class="active">Aviso Adquisición Licencia </li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <?php echo "<h4 style='color:red'>".$mensaje."</h4>"?>

</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
