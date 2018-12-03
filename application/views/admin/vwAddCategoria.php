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
            <h1>Crear<small>Categoria</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Categorias' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active">Categoria</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'admin/Categorias/guardar_categoria' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Descripción</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="desc"  placeholder="Descripción"></input>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "reg_cat">Actualizar</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
