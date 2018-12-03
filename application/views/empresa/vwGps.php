<?php
$this->load->view('empresa/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Seguimiento Vehicular</h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> GPS - CONDUCTOR</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido
                <?php echo $nombre . " " . $apellidos?>
            </div>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">

                            <img src="<?php echo base_url('assets/img/CamionesAplicando.png')?>" alt=""/>   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="<?php echo base_url() . 'empresa/Ofertas/mapa_aplicando' ?>">          
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary">Camiones Aplicando</button>
                        </center>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-4">
                                <img src="<?php echo base_url('assets/img/CamionesContratados.png')?>" alt=""/>
                            </div>
                            <div class="col-xs-4"></div>
                        </div>                
                    </div>
                </div>

                <a href="<?php echo base_url() . 'empresa/Ofertas/mapa_contratados' ?>">
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary">Camiones Contratados</button>
                        </center>
                    </div>
                </a>
            </div>
        </div><!-- /.row -->
    </div>
</div><!--/#page-wrapper -->


<!--PAge Code Ends here -->
<?php
    $this->load->view('empresa/vwFooter');
?>
