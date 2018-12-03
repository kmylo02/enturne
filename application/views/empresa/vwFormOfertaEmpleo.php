<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Crear <small> Oferta de empleo</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Empleo' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i></li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="<?php echo base_url() . 'empresa/Empleo/guardar_oferta_empresa' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <?php
            $query = $this->db->get_where('Users', array('usuario' => $_SESSION['usuario']));
            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row) {
                    $id_emp = $row->id_empresa;
                }
                $cons = $this->db->get_where('Empresas', array('idEmpresa' => $id_emp));
                if ($cons->num_rows() != 0) {
                    foreach ($cons->result() as $row) {
                        $id = $row->id;
                    }
                }
            }
            ?>
            <input type="hidden" class="form-control" name="id_empresa" value="<?php
            echo $id;
            ?> "/>

        </div>

        <!--<div class = "form-group">
            <label class = "col-xs-3 control-label">Origén(*):</label>
            <div class = "col-xs-4">
                <select name="pais" id="pais" class="form-control">
                    <option value="">País</option>
                    <?php
                    /*foreach ($paises as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_pais ?></option>
                        <?php
                    }*/
                    ?>
                </select>
            </div>
        </div>-->


        <div class = "form-group">
            <label class = "col-xs-3 control-label">Describe tu oferta:</label>
            <div class = "col-xs-4">
              <textarea class="form-control" name="descripcion"></textarea>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Crear</button>
            </div>
        </div>
    </form>

    <div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
