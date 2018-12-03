<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Conductores <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Empleo/Ofertas_Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Mis Conductores Actuales</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#33D1FF">
                    <th class="header">No</th>
                    <th class="header">Apertura Vacante</th>
                    <th class="header">Inicio de Contrato</th>
                    <th class="header">Conductor</th>
                    <th class="header">Categoria Licencia</th>
                    <th class="header">Camión Asignado</th>
                    <th class="header">Ciudad de Residencia</th>
                    <th class="header">Celular</th>
                    <th class="header">Foto</th>
                    <th class="header">Ranking</th>
                    <th class="header">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $body;?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Mis Conductores Anteriores</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
