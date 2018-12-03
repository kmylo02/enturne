<?php
$this->load->view('admin/vwHeader');
?>
<?php
if (!$personal) {
    
} else {
    foreach ($personal as $row) {
        $id = $row->idUser;
    }
}
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Personal Empresa <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Lista de Personal</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->



    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th>Estado </th>
                    <th>Nombre </th>
                    <th>Identificación </th>
                    <th>Teléfonos</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Validar Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$personal) {
                    echo "<tr>";
                    echo "<td>" . $mensaje . "</td>";
                    echo "</tr>";
                } else {
                    foreach ($personal as $row) {
                        $checkMail = $row->estado;
                        if ($row->activo == 0) {
                            $estado = 'Inactivo';
                            $boton = "<a href='#'  onclick='activar_subusuario(" . $row->idUser . ")' title='Activar Usuario'><i class='fa fa-check fa-2x'></i></a>";
                        }
                        if ($row->activo == 1) {
                            $estado = 'Activo';
                            $boton = "<a href='#'  onclick='bloquear_subusuario(" . $row->idUser . ")' title='Bloquear Usuario'><i class='fa fa-ban fa-2x'></i></a>";
                        }
                        if ($row->activo == 2) {
                            $estado = 'Sin Validar';
                            $boton = "<a href='#'  onclick='activar_subusuario(" . $row->idUser . ")' title='Activar Usuario'><i class='fa fa-check fa-2x'></i></a>";
                        }
                        if ($row->activo == 3) {
                            $estado = 'Bloqueado';
                            $boton = "<a href='#'  onclick='activar_subusuario(" . $row->idUser . ")' title='Activar Usuario'><i class='fa fa-check fa-2x'></i></a>";
                        }
                        if ($row->permisos == 0) {
                            $tipo = 'Administrador';
                        } else {
                            $tipo = 'Solo Ofertas';
                        }
                        if ($checkMail == 0) {
                            $checkMail = '<a href="#" title = "Email no validado" onclick="validarEmail(' . $row->idUser . ');"><img src="' . base_url('assets/img/mail_invalido.png') . '"></a>' . '</td>';
                        }
                        if ($checkMail == 1) {
                            $checkMail = '<a href="#" title = "Email validado"><img src="' . base_url('assets/img/mail_valido.png') . '"></a>' . '</td>';
                        }
                        echo "<tr>";
                        echo"<td>" . $estado . "</td>";
                        echo"<td>" . $row->nombre . " " . $row->apellidos . "</td>";
                        echo"<td>" . $row->tipo . " " . $row->cedula . "</td>";
                        echo"<td>" . $row->telefono . " " . $row->celular . "</td>";
                        echo"<td>" . $row->email . "</td>";
                        echo"<td>" . $row->usuario . "</td>";
                        echo"<td>" . $tipo . "</td>";
                        echo"<td>" . $checkMail . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Perfil/get_perxid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Empleado')) . "&nbsp" . $boton . "</td>";
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
