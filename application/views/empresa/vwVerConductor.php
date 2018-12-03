<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Datos <small> Conductor</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



    <form  id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?php echo $iduser ?> "/>
            <label class="col-xs-3 control-label">Nombre</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $conxid->nombre; ?>" disabled/>
            </div>
        </div>

        <input type="hidden" name="id" value="<?= $conxid->id; ?>"/>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Apellidos</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "apellidos" value="<?= $conxid->apellidos; ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?= $conxid->email; ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Vehiculo Asignado</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php
                $consulta = $this->db->get_where('sf_vehiculo', array('conductor_id' => $conxid->id))->row();

                if ($consulta->num_rows() != 0) {
                    echo $consulta->placa;
                } else {
                    echo "Sin vehiculo";
                }
                ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Estado Vehiculo</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php
                       $sql = $this->db->get_where('sf_vehiculo', array('conductor_id' => $conxid->id))->row();
                       if ($sql->num_rows() != 0) {
                           if ($sql->activo == 0) {
                               $est = 'Disponible';
                           } else {
                               $est = 'Ocupado';
                           }
                           echo $est;
                       }
                       ?>" disabled/>
            </div>
        </div>

    </form>


    <div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
