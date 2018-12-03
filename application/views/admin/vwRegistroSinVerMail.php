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
            <h1>Registro <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Sin verificar email</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th class="header">No</th>
                    <th class="header">Nombre</th>
                    <th class="header">Usuario</th>
                    <th class="header">Tipo de Usuario</th>
                    <th class="header">Email</th>
                    <th class="header">Telefono</th>
                    <th class="header">Fecha registro</th>
                    <th class="header">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($registros) {
                    foreach ($registros as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->id . "</td>";
                        echo"<td>" . $row->nombre . "  " . $row->apellidos . "</td>";
                        echo"<td>" . $row->usuario . "</td>";
                        echo"<td>" . $row->nivel . "</td>";
                        echo"<td>" . $row->email . "</td>";
                        echo"<td>" . $row->telefono . "</td>";
                        echo"<td>" . $row->fecha_creacion . "</td>";
                        echo"<td>" . anchor(base_url() . 'Registros/validar_email/' . $row->id, '<i class="fa fa-check-circle-o fa-2x"></i>',array('title' => 'Validar email','onclick'=>'return confirmValidar();')) . "</td>";
                        echo"<td>" . anchor(base_url() . 'Registros/eliminar/' . $row->id, '<i class="fa fa-trash fa-2x"></i>',array('title' => 'Eliminar','onclick'=>'return confirmEliminar();')) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td>" . $mensaje . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
