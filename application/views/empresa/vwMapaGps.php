<?php
$this->load->view('empresa/vwHeader');
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

    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $title ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Gps' ?>"><i class="fa fa-level-up fa-3x"></i></a></li>
                <li><?php echo $botonMapa ?></li>
                <li><a href="#tabla">Ver lista conductores</a></li>
            </ol>
        </div>
    </div><!-- /.row -->
    <input type="hidden" id="idEmpresa" value="<?php echo $idempresa ?>">
    <input type="hidden" id="idUsuario" value="<?php echo $idusuario ?>">
    <div class="table-responsive">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-map"></i> </h3>
                    </div>
                    <div class="panel-body">
                        <div id="mapa">
                        </div>
                        <div id="morris-chart-area"></div>
                        <br>
                        <div id="panel_ruta"></div>
                        <a name="tabla">
                            <div class="table-responsive">
                                <table id="dataTable" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr style="background-color:#FFE000">
                                            <th>Fecha creación</th>
                                            <th>Fecha aplicación</th>
                                            <th>Trayecto</th>
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
                                        <?php echo $body; ?>
                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div><!--/.row -->
    </div>
</div><!--/#page-wrapper -->


<!--PAge Code Ends here -->
<?php
$this->load->view('empresa/vwFooter');
?>