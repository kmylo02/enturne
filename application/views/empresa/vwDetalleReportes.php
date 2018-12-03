<?php
$this->load->view('empresa/vwHeader');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Reportes conductor</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Mensajes/get_reportes' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-road"></i> <?php echo $ruta?></li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr style="background-color:#FFE000">
                                <th>Fecha - Hora</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Reporte</th>
                                <th>Ubicación</th>
                                <th>HV</th>
                                <th>Visto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $body; ?>
                        </tbody>
                    </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
