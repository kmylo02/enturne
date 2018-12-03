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
            <h1>Cargas Vehiculos <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'empresa/Perfil/get_vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Cargas Vehiculo</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
      <table id="dataTable" class="table table-hover tablesorter" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#FFE000">
                        <?php echo $titulos ?>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $body ?>
                </tbody>
            </table>
    </div>
</div><!--/#page-wrapper -->

<?php
    $this->load->view('empresa/vwFooter');
?>
