<?php
$this->load->view('conductor/vwHeader');
?>
<!--
Load Page Specific CSS and JS here
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>¿Como desea registrarse?</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>

        </div>
    </div><!-- /.row -->

    <div class="row">

        <div class="col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"></p>
                            <p class="announcement-text">Solo propietario</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url().'conductor/Perfil/tipo'?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Ver
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
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fa fa-user-secret fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading"></p>
                            <p class="announcement-text">Propietario / conductor. Solo Conductor</p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url().'conductor/Perfil/completar_conductor'?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-6">
                                Ver
                            </div>
                            <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div><!-- /.row -->



</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('conductor/vwFooter');
?>