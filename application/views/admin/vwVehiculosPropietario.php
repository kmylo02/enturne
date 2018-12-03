<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Vehiculos Propietario<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Conductores/propietario' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-truck"></i> Datos Vehiculos</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color:#FFE000">
                          <th>Placa</th><th>Estado</th><th>Tipo - Carroceria</th><th>Vto. SOAT </th><th>Vto. RTM </th><th>Creado </th><th>Venc Licencia.</th><th>Conductor </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $body?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
