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
                <li class="active"><i class="icon-file-alt"></i> Vehiculos Contratados</li>
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
                    <th class="header">Ruta No</th>
                    <th class="header">Fecha Contrato</th>
                    <th class="header"></th>
                    <th class="header"></th>
                </tr>
            </thead>
            <tbody>

                <?php
                  if(!$datos){
                    echo "<tr>";
                    echo"<td>" . "No hay vehiculos contratados" . "</td>";
                    echo "</tr>";
                  } else {
                    foreach ($datos as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->vehiculo_id . "</td>";
                        echo"<td>" . $row->carga_id . "</td>";
                        echo"<td>" . $row->updated_at . "</td>";
                        //echo"<td>" .  "</td>";
                        //echo"<td>" . "</td>";
                        echo"<td>" . anchor(base_url() . 'empresa/Ofertas/calificar_conductor_xid/' . $row->vehiculo_id, '<i class="fa fa-thumbs-o-up fa-2x"></i>',array('title'=>'Calificar servicio')) . "</td>";
                        echo "</tr>";
                    }
                  }          
                ?>
            </tbody>
        </table>

    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
