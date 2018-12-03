<?php
$this->load->view('admin/vwHeader');
echo "<h4 style='color:red'>".$aviso."</h4>";
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Enturne <small>Administrador</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Users' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building-o"></i> Datos Empresas</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th>Nombre</th>
                    <th>NIT </th>
                    <th>Telefonos</th>
                    <th>Email</th>
                    <th>Web</th>
                    <th>Fecha Creación</th>
                    <th>Licencia</th>
                    <th>Obsv</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
    if (!$datos) {
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
                $res = 'Documentación pendiente, licencia paga';
            }
            if ($estado == 3) {
                $res = 'Licencia pendiente de pago';
            }
            if ($estado == 4) {
                $res = 'Licencia activa';
            }
            echo "<tr>";
            echo"<td>" . $row->nombre_empresa . "</td>";
            echo"<td>" . $row->nit . "</td>";
            echo"<td>" . $row->telefono . " " . $row->fax . "</td>";
            echo"<td>" . $row->email . "</td>";
            echo"<td>" . $row->web . "</td>";
            echo"<td>" . $row->created_at . "</td>";
            echo"<td>" . $res . "</td>";
            echo"<td><textarea style='color:red'>" . $row->obs . "</textarea></td>";
            echo"<td>" . anchor(base_url() . 'admin/Empresas/edit_empresaxid/' . $row->id, '<i class="fa fa-edit fa-2x"></i>',array('title' => 'Editar 1')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/edit_docsempresaxid/' . $row->id, '<i class="fa fa-folder-open-o fa-2x"></i>',array('title' => 'Documentos')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/get_personal_empxid/' . $row->id, '<i class="fa fa-male fa-2x"></i>',array('title' => 'Personal 1')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/crear_personal_empresas/' . $row->id, '<i class="fa fa-user-plus fa-2x"></i>',array('title' => 'Crear Personal 1')) . "&nbsp" . '<a href="#"  onclick="bloquear('.$row->id.')" title="Bloquear 1"><i class="fa fa-ban fa-2x"></i></a></td></tr>';
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
