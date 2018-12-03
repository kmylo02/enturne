<?php
$this->load->view('empresa/vwHeader');
?>
<input type="hidden" id="idCarga" value="<?php echo $idoferta?>">
<input type="hidden" id="origen" value="<?php echo $origen?>">
<input type="hidden" id="destino" value="<?php echo $destino?>">
<input type="hidden" id="dpto_origen" value="<?php echo $dpto_origen?>">
<input type="hidden" id="dpto_destino" value="<?php echo $dpto_destino?>">
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $title?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Ofertas/listado_ofertas' ?>"><i class="fa fa-level-up fa-3x"></i></a></li>
                <li><?php echo $botonMapa ?></li>
                <li><a href="#" onclick="rockAndRoll()">Ver ruta</a></li>
                <li><a href="#tabla">Ver lista conductores</a></li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div id="spinner"></div>
    <div class="table-responsive">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-map"></i> <?php echo $origen."-".$destino?> </h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-chart-area"></div>
                        <br>
                        <div id="panel_ruta"></div>
                        <center><div id="loader" style="display:none"><img src="<?php echo base_url('assets/img/enturne-loading.gif')?>"></div></center>
                        <a name="tabla"></a>
                        <div class="table-responsive">
                            <table id="dataTable" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color:#FFE000">
                                        <th>Fecha creación</th>
                                        <th>Fecha aplicación</th>
                                        <th>Placa</th>
                                        <th>Dimensiones</th>
                                        <th>Valor Flete</th>
                                        <th>Nombre</th>
                                        <th>Telefonos</th>
                                        <th>Foto</th>
                                        <th>Ranking</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $body;?>
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row -->
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
