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
            <h1>Mensajes de conductores</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'conductor/Reportes'?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active">Mensajes</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <table id="dataTable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#FFE000">
                        <th>Conductor</th>
                        <th>Comentario </th>
                        <th>Ubicacion</th>
                        <th>Fecha</th>
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