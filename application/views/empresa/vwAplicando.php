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
            <h1>Vehiculos <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Ofertas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Vehiculos Aplicando</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">No</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach ($datos as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->vehiculo_id . "</td>";
                        /*echo"<td>" . $row->placa . "</td>";
                        echo"<td>" . $row->nombre_tv . " - ".$row->nombre_carr."</td>";
                        echo"<td>" . $row->vence_soat . "</td>";
                        echo"<td>" . $row->vence_rtecnomecanica . "</td>";*/
                        echo"<td>" . anchor_popup(base_url() . 'empresa/Perfil/get_vehiculo_xid/' . $row->vehiculo_id, '<i class="fa fa-file-pdf-o fa-2x"></i>',array('title'=>'Ver Hoja de vida vehiculo')) . "</td>";
                        echo"<td>" . anchor(base_url() . 'empresa/Ofertas/contratar_vehiculo/' . $row->vehiculo_id, '<i class="fa fa-check-square fa-2x"></i>',array('title'=>'Contratar vehiculo')) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
