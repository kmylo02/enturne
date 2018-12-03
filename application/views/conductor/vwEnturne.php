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
            <h1>Enturnarme</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-truck"></i> </li><li class="active"><?php echo $placa?> </li>
                <li class="active"><button class="btn btn-success btn-xl"></button> Disponible <button class="btn btn-danger btn-xl"></button> No Disponible </li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <ul class="nav nav-tabs nav-justified">
      <?php if($tipo==1){ ?>
        <li class="<?=(current_url()==base_url('conductor/Enturne')) ? 'active':''?>"><a href="<?php echo base_url('conductor/Enturne')?>">Mi Enturne</a></li>
      <?php } ?>
      <?php if($tipo==2){ ?>
        <li class="<?=(current_url()==base_url('conductor/Enturne')) ? 'active':''?>"><a href="<?php echo base_url('conductor/Enturne')?>">Mi Enturne</a></li>
        <li class="<?=(current_url()==base_url('conductor/Enturne/conductores')) ? 'active':''?>"><a href="<?php echo base_url('conductor/Enturne/conductores')?>">Enturne de Mis Conductores</a></li>
      <?php } ?>
      <?php if($tipo==3){ ?>
        <li class="<?=(current_url()==base_url('conductor/Enturne/conductores')) ? 'active':''?>"><a href="<?php echo base_url('conductor/Enturne/conductores')?>">Enturne de Mis Conductores</a></li>
      <?php } ?>
    </ul>
  <div class="tab-content">
    <br>
  <?php echo $body?>
</div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
