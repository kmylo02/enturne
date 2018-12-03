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
            <h1>Planear Costos y Ruta <small></small></h1>
        </div>
    </div><!-- /.row -->

    <div class="row">        
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="col-xs-1"></div>
                            <div class="col-xs-4">
                                <img src="<?php echo base_url('assets/img/sicetac.png')?>" alt="SICE" height="125" width="125">
                            </div>
                            <div class="col-xs-4"></div>
                        </div>                
                    </div>
                </div>

                <a href="http://sicetac.mintransporte.gov.co:8080/sicetacWeb/#!/ejecutar/costos-eficientes" target="_blank">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Programa tu viaje
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
                        <div class="col-xs-4">

                            <img src="<?php echo base_url('assets/img/viajeseg.jpg')?>" alt="Viajero seguro" height="125" width="125">   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="https://app.invias.gov.co:8080/viajero/" target="_blank">        
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Calcula tu viaje
                            </div>
                            <div class="col-xs-4 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /.row -->
    </div>


</div><!--/#page-wrapper -->

<?php
    $this->load->view('conductor/vwFooter');
?>
