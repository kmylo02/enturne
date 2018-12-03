<?php
$this->load->view('empresa/vwHeader');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Historico conductores contratados</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i> Historico</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#FFE000">
                    <?php echo $creador ?>
                    <th>Placa</th>
                    <th>Trayecto</th>
                    <th>Inicio‐contrato</th>
                    <th>Final-contrato</th>
                    <th>Conductor</th>
                    <th>Celular</th>
                    <th>Camion</th>
                    <th>Dimensiones Carga</th>
                    <th>Valor Flete</th>
                    <th>Manifiesto</th>
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


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
