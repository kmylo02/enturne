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
                <li class="active"><i class="icon-file-alt"></i> Activados</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'Registros/buscar_val' ?>" id="basicBootstrapForm" class="form-horizontal">
    <div class="row">
      <div class="col-sm-6"><input type="text" class="form-control" name="buscar" placeholder="Buscar x No usuario"/></div>
      <div class="col-sm-6"><input type="submit" name="submit_buscar" class="btn btn-success" value="Consultar"/></div>
    </div>
    </form>

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
