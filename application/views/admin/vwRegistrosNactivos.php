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
            <h1>Registros <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Sin activar</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Tipo de Usuario</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr style="background-color:#C0C0C0">
                    <th>No</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Tipo de Usuario</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fecha registro</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
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
                        echo"<td>" . anchor(base_url() . 'Registros/get_registrosxid_ult_sem/' . $row->id, '<button type="button" class="btn btn-warning">Activar</button>') . "</td>";
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
