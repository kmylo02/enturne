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
            <h1>Editar <small> Oferta</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'empresa/Ofertas/listado_ofertas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i> Información</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="javascript:updateOferta()" id="frmEditCarga" class="form-horizontal">
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Peso Kg(*):</label>
            <div class = "col-xs-2">
                <input type = "number" class = "form-control" name = "peso" placeholder = "Peso en kg." required value="<?= $oferta->peso ?>">
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Cantidad de Vehiculos requeridos(*):</label>
            <div class = "col-xs-2">
                <input type = "hidden" value="<?= $oferta->idOfertaCarga ?>" name="id">
                <input type = "number" class = "form-control" name = "cantidad" placeholder = "No Vehiculos Req." required value="<?= $oferta->cantidad ?>">
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de cargue(*):</label>
            <div class = "col-xs-4">
              <input type = "date" name = "fecha" id="fecha_cargue" value="<?= $oferta->fecha ?>"  min="<?= date("Y-m-d") ?>" required/>  
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Actualizar</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->
<?php
$this->load->view('empresa/vwFooter');
?>
