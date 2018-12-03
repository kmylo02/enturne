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
            <h1>SOS</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-bell"></i> SOS </li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr  style="background-color:#FFE000">
                    <th>Contrató</th>
                    <th>Conductor</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Vehiculo</th>
                    <th>Ubicación</th>
                    <th>Visto</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $body?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h5>Estos mensajes son activados desde el botón de pánico del celular registrado
previamente en www.enturne.co .
Favor tomar las medidas necesarias acordadas con el conductor, para que le
puedan brindar atención inmediata. Recuerde que la vida, el camión y la mercancía
pueden estar en peligro.<br><br>
Nota: Enturne En Línea, es una aplicación informativa para este Servicio de SOS,
es responsabilidad de la 1 de Transporte que lo contrate, el Propietario ó
Administrador del vehículo, de tomar las medidas pertinentes (Protocolos de
Seguridad, acordados con el conductor) a este evento notificado por los usuarios a
través de nuestra Plataforma.</h5>
        </div>
    </div><!-- /.row -->
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
