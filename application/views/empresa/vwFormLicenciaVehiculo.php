<?php
$this->load->view('empresa/vwHeader');
$user = $_SESSION['usuario'];
$consulta = "SELECT id FROM users WHERE usuario='$user'";
$this->db->select_max('idv');
$consulta = $this->db->get('sf_vehiculo');
if($consulta->num_rows()>0){
    foreach ($consulta->result() as $value) {
        $idv=$value->idv;
    }
}
?>

<!--  
Author : Jhon Jairo Valdés Aristizabal 
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Licencias Disponibles <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Licencias' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos </li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="<?php echo base_url() . 'empresa/Licencias/adquirir_licencia_vehiculo' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">          
            <label class="col-xs-3 control-label">Codigo</label>
            <div class="col-xs-4">
                <input type="text" name="codigo" class="form-control" value="<?php
                foreach ($licencia as $row) {
                    echo $row->codigo;
                }
                ?>" readonly=""></input>
                <input type="hidden" name="idv" value="<?php echo $idv ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre</label>
            <div class = "col-xs-4">
                <input type="text" class = "form-control" value="<?php
                echo $row->nombre_producto
                ?> " disabled=""/>
            </div>
        </div>  

        <div class="form-group">
            <label class="col-xs-3 control-label">Descripción</label>
            <div class = "col-xs-4">
                <textarea class = "form-control" disabled=""><?php echo $row->descripcion?>
                </textarea>
            </div>
        </div>  

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Precio</label>
            <div class = "col-xs-4">
                <input type = "text" name="precio" class = "form-control" value="<?php
                echo $row->precio
                ?>" readonly=""/>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "submit" class = "btn btn-primary" name="reg_lic" value="Adquirir Licencia"/>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>