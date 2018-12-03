<?php
$this->load->view('conductor/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'conductor/Dashboard'?>"><img src="<?php echo base_url('assets/img/panel.png')?>" width="10%" height="10%"></a> Carga</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-6">

                            <img src="<?php echo base_url('assets/img/MapaOfertasCarga.png')?>" alt=""/>   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="<?php echo base_url() . 'conductor/Ofertas/mapa_ofertas' ?>">        
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Mapa Ofertas de carga disponibles
                            </div>
                            <div class="col-xs-4 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                          <div class="col-xs-2"></div>
                            <div class="col-xs-8">
                                <img src="<?php echo base_url('assets/img/OfertasCarga.png')?>" alt=""/>
                            </div>
                          <div class="col-xs-2"></div>                
                    </div>
                </div>
                <?php if($tipo!=3){ ?>
                <a href="<?php echo base_url() . 'conductor/Ofertas/listado_ofertas' ?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Listado de Ofertas de carga
                            </div>
                            <div class="col-xs-4 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php } else { ?>
                <a href="<?php echo base_url() . 'conductor/Ofertas/listado_ofertas_conductores' ?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Listado de Ofertas de carga
                            </div>
                            <div class="col-xs-4 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php } ?>
            </div>
        </div><!-- /.row -->
    </div>


</div><!--/#page-wrapper -->

<?php
    $this->load->view('conductor/vwFooter');
?>
