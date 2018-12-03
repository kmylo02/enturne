<?php
$this->load->view('admin/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
-->
<style type="text/css">

    #sidebar{
        position: absolute;
        width: 100px;
        height: 600px;
        background: #F7E000;
        color: #fff;
        margin-left: 1005px;
        margin-top: -600px;
        border: 1px solid #F7E000;
    }
    ul{
        padding: 0;
        text-align: justify;
    }

    #li_side{
        cursor: pointer;
        border-top: 1px solid #fff;
        background: #000000;
        list-style: none;
        color: #F7E000
    }
    #li_side:hover{
        background: #F7E000;
        color: black;
    }
</style>
<div id="page-wrapper">
    <div class="row" id="controles_satelital">
        <div class="col-lg-6">
            <div class="form-group">
                <select class="form-control" id="selector" onchange="getLocationSatelital()">
                    <option>Seleccione vehiculo</option>
                    <?php
                    if ($vehiculos) {
                        foreach ($vehiculos as $value) {
                            ?>
                            <option value="<?= $value->idv ?>"><?= $value->placa ?></option>  
                        <?php }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <!--<input type="button" class="form-control btn-success" value="Ver Historico">-->
            </div>
        </div>
    </div><!--/.row -->
</div><!--/#page-wrapper -->
<div id="page-wrapper">
    <div class="table-responsive">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a href="#" onclick="getLocation()" id="cargar_mapa"><h3 class="panel-title" style="color: white"><i class="fa fa-map"></i> Cargar Mapa </h3></a>
                        <h3 id="titulo_mapa" class="panel-title" style="color: white" hidden=""><i class="fa fa-map"></i> Mapa Seguimiento Vehicular Satelital </h3>
                    </div>
                    <div class="panel-body">
                        <center><div id="loader" style="display:none"><img src="<?php echo base_url('assets/img/enturne-loading.gif') ?>"></div></center>
                        <div id="morris-chart-area"></div>
                    </div>
                </div>
            </div>
        </div><!--/.row -->
    </div>
</div><!--/#page-wrapper -->


<!--PAge Code Ends here -->
<?php
$this->load->view('admin/vwFooter');
?>
