<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Confirmar Contrato <small> Conductor</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos del contratante</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("empresa/Empleo/contratar_conductor", $attributes);
    ?>
    <div class="form-group">
        <input type="hidden" name="user_id" value="<?php
        $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']))->row();
        if ($query->num_rows() != 0) {
            echo $query->id;
        }
        ?> "/>
        <label class="col-xs-3 control-label">Nombre</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" value="<?php
            echo $query->nombre;
            ?>" disabled/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Apellidos</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" value="<?php
            echo $query->apellidos;
            ?>" disabled/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Email</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" value="<?php
            echo $query->email;
            ?>" disabled/>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">

                <li class="active"><i class="icon-file-alt"></i> Datos del Contratista</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="form-group">
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
        <label class = "col-xs-3 control-label">Asignar Vehiculo</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('vehiculo') . "</h5>"; ?>
            <select name="vehiculo" class="form-control">
                <option value="">Vehiculos disponibles</option>
                <?php
                $consulta = $this->db->get_where('sf_vehiculo', array('user_id' => $query->id, 'estado' => 'libre', 'activo' => '2'))->row();

                if ($consulta->num_rows() != 0) {
                    echo "<option>" . $consulta->placa . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "update_reg" value = "Contratar"/>
        </div>
    </div>

    <?php echo form_close() ?>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
