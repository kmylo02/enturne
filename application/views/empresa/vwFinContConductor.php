<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Finalizar Contrato <small> Conductor</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Empleo/get_conductores_contratados' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



    <form method="post" action="<?php echo base_url() . 'empresa/Empleo/finalizar_contrato_conductor' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?php
            $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row) {
                    echo $row->id;
                }
            }
            ?> "/>
            <label class="col-xs-3 control-label">Nombre</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre" value="<?= $conxid->nombre;?>" disabled/>
            </div>
        </div>

        <input type="hidden" name="id" value="<?= $conxid->id; ?>"/>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Apellidos</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "apellidos" value="<?= $conxid->apellidos;?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?= $conxid->email;?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Vehiculo Asignado</label>
            <div class = "col-xs-4">
                <input type = "text"  class = "form-control"  value="<?php
                $consulta = $this->db->get_where('sf_vehiculo', array('conductor_id' => $conxid->id))->row();

                if ($consulta->num_rows() != 0) {
                        echo $consulta->placa;
                }
                else{
                    echo "Sin vehiculo";
                }
                ?>" disabled/>
                <input type = "hidden"  name="vehiculo"  value="<?php
                $q = $this->db->get_where('sf_vehiculo', array('conductor_id' => $conxid->id))->row();

                if ($q->num_rows() != 0) {
                        echo $q->placa;
                }
                else{
                    echo "Sin vehiculo";
                }
                ?>"/>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "update_reg" value = "Sign up">Finalizar Contrato</button>
            </div>
        </div>

    </form>


    <div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
