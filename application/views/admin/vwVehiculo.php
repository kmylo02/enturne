<?php
$this->load->view('admin/vwHeader');
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
                <li><a href="<?php echo base_url() . 'admin/Vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-truck"></i> Datos Vehiculos</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th class="header">Propietario y/o Administrador</th>
                    <th class="header">Tipo Propietario y/o Administrador</th>
                    <th class="header">Conductor</th>
                    <th class="header">Placa</th>
                    <th class="header">Estado</th>
                    <th class="header">Tipo - Carroceria</th>
                    <th class="header">Venc. SOAT</th>
                    <th class="header">Venc. T.M</th>
                    <th class="header">Creado</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!$datos) {
                    echo "<tr>";
                    echo "<td>"."<h4 style='color:red'>" . $mensaje ."</h4>"."</td>";
                    echo "</tr>";
                } else {
                    foreach ($datos as $row) {
                        $estado = $row->activo;
                        if ($estado == 0) {
                            $res = 'Sin licencia';
                        }
                        if ($estado == 1) {
                            $res = 'Compro licencia, verificar pago';
                        }
                        if ($estado == 2) {
                            $res = 'Licencia Activa';
                        }
                        echo "<tr>";
                        echo"<td>" . $row->usuario ." / " . $row->nombre ." ". $row->apellidos . "</td>";
                        echo"<td>" . $row->nivel . "</td>";
                        if($row->conductor_id == NULL){
                          echo "<td>" . " No asignado " . "</td>";
                        }else {
                          echo"<td>" . anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $row->conductor_id, '<i class="fa fa-user-secret fa-2x"></i>',array('title' => 'Condutor')) . "</td>";
                        }
                        echo"<td>" . $row->placa . "</td>";
                        echo"<td>" . $res . "</td>";
                        echo"<td>" . $row->nombre_tv . " - " . $row->nombre_carr . "</td>";
                        echo"<td>" . $row->vence_soat . "</td>";
                        echo"<td>" . $row->vence_rtecnomecanica . "</td>";
                        echo"<td>" . $row->created_at . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Vehiculos/get_vehiculo_xid/' . $row->idv, '<i class="fa fa-truck fa-2x"></i>',array('title' => 'Editar Vehiculo')) . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Vehiculos/edit_docsvehiculoxid/' . $row->idv, '<i class="fa fa-folder-open-o fa-2x"></i>',array('title' => 'Documentos')) . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Vehiculos/delete_vehiculo_xid/' . $row->idv, '<i class="fa fa-trash fa-2x"></i>',array('title' => 'Eliminar vehiculo','onclick'=>'return confirmDialog();')) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
