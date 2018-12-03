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
            <h1>Crear<small>Producto</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Productos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active">Producto</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'admin/Productos/guardar_producto' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Categoria</label>
            <div class="col-xs-4">
                <select class="form-control" name="categoria">
                    <?php foreach ($cat as $fila) {
                        ?>
                        <option value="<?php echo $fila->idc ?>"><?php echo $fila->descripcion ?></option>
                        <?php
                    }
                    ?>	
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Codigo</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="codigo" placeholder="Codigo"></div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre"></div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Descripción:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="desc" placeholder="Descripción"></div>
        </div>
        
        <div class="form-group">
            <label class="col-xs-3 control-label">Idioma:</label>
            <div class="col-xs-4">
                <select class="form-control" name="idioma">
                    <?php foreach ($idioma as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->idioma ?></option>
                        <?php
                    }
                    ?>	
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Tipo de usuario:</label>
            <div class="col-xs-4">
                <select class="form-control" name="tipouser">

                    <option value="0">Administrador</option>
                    <option value="1">Empresa</option>
                    <option value="3">Conductor</option>

                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-xs-3 control-label">Moneda:</label>
            <div class="col-xs-4">
                <select class="form-control" name="moneda_id">
                    <?php foreach ($moneda as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->moneda ?></option>
                        <?php
                    }
                    ?>	
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-xs-3 control-label">Impuesto:</label>
            <div class="col-xs-4">
                <select class="form-control" name="moneda_id">
                    <?php foreach ($tax as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->titulo ?></option>
                        <?php
                    }
                    ?>	
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-xs-3 control-label">Cantidad:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="cant" placeholder="Cantidad">     
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "reg_product" value = "Sign up">Guardar</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
