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
            <h1>Historico de contratos <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'conductor/Reportes'?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active">Historico</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <table id="dataTable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#FFE000">
                        <th>Contrató</th>
                        <th>Placa</th>
                        <th>Trayecto</th>
                        <th>Inicio Contrato</th>
                        <th>Final Contrato</th>
                        <th>Conductor</th>
                        <th>Celular</th>
                        <th>Camión</th>
                        <th>Dimensiones Carga</th>
                        <th>Valor Flete</th>
                        <th>Calificación por mi servicio</th>      
                        <th>Observaciones</th>
                        <th>HV</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $body ?>
                </tbody>
            </table>
        </div>
    </div><!-- /.row -->


</div><!--/#page-wrapper -->

<?php
    $this->load->view('conductor/vwFooter');
?>
