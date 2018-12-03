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
            <h1>Mensajes</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'conductor/Mensajes'?>"><i class="fa fa-home fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-opencart"></i> Mensajeria</li>
                <div style="clear: both;"></div>
            </ol>
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
                                <img src="<?php echo base_url('assets/img/msnconductores.png')?>" alt=""/>
                            </div>
                            <div class="col-xs-4"></div>
                        </div>                
                    </div>
                </div>

                <a href="<?php echo base_url() . 'conductor/Reportes/lista_mensajes' ?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Mensajes de Conductores
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

                            <img src="<?php echo base_url('assets/img/msnenviar.png')?>" alt=""/>   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="#" data-toggle="modal" data-target="#enviarmsn">        
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Enviar
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
                            <img src="<?php echo base_url('assets/img/MSNEnviados.png')?>" alt=""/>   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="<?php echo base_url() . 'conductor/Reportes/lista_enviados' ?>">        
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-8">
                                Enviados
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

    <!-- Modal -->
    <div id="enviarmsn" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enviar mensaje</h4>
                </div>
                <form id="frmEnviarMsn" method="post" action="javascript:enviarMsn()">
                    <div class="modal-body">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/#page-wrapper -->

<?php
    $this->load->view('conductor/vwFooter');
?>