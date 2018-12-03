<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Enturne <small>Administrador</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-user-secret"></i> Datos Transportador</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th class="header">Nombre</th>
                    <th class="header">Apellidos </th>
                    <th class="header">Tipo de documento</th>
                    <th class="header">Fecha de Nacimiento</th>
                    <th class="header">Telefonos</th>
                    <th class="header">Email</th>
                    <th class="header">Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$datos) {
                    echo "<tr>";
                    echo "<td>" . "<h4 style='color:red'>" . $mensaje . "</h4>" . "</td>";
                    echo "</tr>";
                } else {
                    foreach ($datos as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->nombre . "</td>";
                        echo"<td>" . $row->apellidos . "</td>";
                        echo"<td>" . $row->tipo . " " . $row->cedula . "</td>";
                        echo"<td>" . $row->fecha_nac . "</td>";
                        echo"<td>" . $row->telefono . "<br>" . $row->celular . "</td>";
                        echo"<td>" . $row->email . "</td>";
                        echo"<td>" . $row->direccion . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $row->id, '<i class="fa fa-edit fa-2x"></i>',array('title' => 'Editar Transportador')) . "</td>";
                        if($row->activo==0){
                          echo"<td>" . anchor(base_url() . 'admin/Conductores', '<i class="fa fa-file-pdf-o fa-2x"></i>',array('title' => 'Transportador inactivo, debe completar Hoja de Vida')) . "</td>";
                        }else{
                          echo"<td>" . anchor_popup(base_url() . 'admin/Conductores/generar_hv_conductor/' . $row->id, '<i class="fa fa-file-pdf-o fa-2x"></i>',array('title' => 'Hoja de Vida')) . "</td>";
                        }
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
