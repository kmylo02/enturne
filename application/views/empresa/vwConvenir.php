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
            <h1>Convenir vehiculo</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Ofertas/listado_ofertas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i> Información</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="javascript:convenirOferta()" id="frmConvenir" class="form-horizontal"> 
        <input type="hidden" name="idv" value="<?php echo $idv?>">
        <input type="hidden" name="idcarga" value="<?php echo $idCarga?>">
        <?php foreach($datos as $row) {            
            $placa = $row->placa;
            $tipo = $row->nombre_tv;
            $carr = $row->nombre_carr;
            $propietario = $row->nomprop;
            $apropietario = $row->apeprop;
            $marca = $row->marcav;
            $tel = $row->telefono;
            $cel = $row->celular;
        }?>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Placa:</label>
            <div class = "col-xs-2">
                <input type = "text" class = "form-control" value="<?php echo $placa?>" disabled>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tipo vehiculo:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $tipo?>" disabled>
            </div>
        </div>        
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Carroceria:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $carr?>" disabled>                
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $marca?>" disabled>                
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Telefono:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $tel?>" disabled>                
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Celular:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $cel?>" disabled>
            </div>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Propietario:</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php echo $propietario.' '.$apropietario?>" disabled>                
            </div>
        </div>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Convenir</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->
<?php
    $this->load->view('empresa/vwFooter');
?>