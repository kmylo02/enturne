<?php
$this->load->view('conductor/vwHeader');
?>

<div id="page-wrapper">

  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'conductor/Dashboard'?>"><i class="fa fa-level-up fa-2x"></i></a> <?php echo $titulo;?></li>
      </ol>
      <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?= $nombre . " " . $apellidos ?> / <?= $placa ?>
      </div>
      <?= $aviso ?>
    </div>
  </div><!-- /.row -->
      <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#33D1FF">
                      <th>Apertura Vacante</th>
                      <th>Cant. Vacante</th>
                      <th>Ofertante</th>
                      <th>Ciudad Contrato</th>
                      <th>Ejecución de Labores</th>
                      <th>Tipo Vehiculo</th>
                      <th>Salario</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $body ?>
                </tbody>
            </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>