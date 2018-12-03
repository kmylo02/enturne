<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Vehiculos <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Users' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-truck"></i> Datos Vehiculos</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <ul class="nav nav-tabs nav-justified">
        <li class="<?= (current_url() == base_url('admin/Vehiculos')) ? 'active' : '' ?>"><a href="<?php echo base_url('admin/Vehiculos') ?>">Vehiculos Autorizados</a></li>
        <li class="<?= (current_url() == base_url('admin/Vehiculos/inactivos')) ? 'active' : '' ?>"><a href="<?php echo base_url('admin/Vehiculos/inactivos') ?>">Vehiculos No Autorizados</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color:#FFE000">
                            <th>Estado</th>
                            <th>Creado</th>
                            <th>Propietario y/o Administrador</th>
                            <th>Tipo de propietario</th>
                            <!--<th>Lic-Enturne </th>-->
                            <th>Estado de Cuenta </th>
                            <th>Doc pendientes por aprobar </th>
                            <th>Conductor</th>
                            <th>Placa</th>
                            <th>Configuracion</th>
                            <th>Vto. SOAT </th>
                            <th>Vto. RTM </th>
                            <th>Vto. Lic. conducción</th>
                            <th>Acciones </th>
                            <th>HV</th>
                            <?php
                            if ($estado != "Activo") {
                                echo "<th>Autorizado</th>";
                            } else {
                                echo "<th></th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $body ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
