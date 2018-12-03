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
                <li class="active"><a href="<?php echo base_url() . 'conductor/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li>Vacantes de empleo creadas</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#33D1FF">
                       <th>Nº Vacante</th>
                      <th>Apertura Vacante</th>
                      <th>Cierre Vacante</th>
                      <th>Categoria Licencia</th>
                      <th>Salario</th>
                      <th>Cant</th>
                      <th>Configuración del vehiculo</th>
                      <th>Ciudad contratación</th>
                      <th>Aplicando</th>
                      <th>Contratados</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $body;?>
                </tbody>
            </table>
    </div>
</div><!-- /#page-wrapper -->
<?php
$this->load->view('conductor/vwFooter');
?>
