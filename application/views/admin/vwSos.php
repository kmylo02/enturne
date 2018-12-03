<?php
$this->load->view('admin/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Enturne <small>Administrador</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Users' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-bell"></i> SOS </li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Vehiculo</th>
                    <th>Ubicación</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tfoot>
                <tr style="background-color:#C0C0C0">
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Vehiculo</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                <?php echo $body?>
            </tbody>
        </table>

    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>