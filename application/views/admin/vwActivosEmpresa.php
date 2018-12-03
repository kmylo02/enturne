<?php
$this->load->view('admin/vwHeader');
echo "<h4 style='color:red'>" . $aviso . "</h4>";
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">    
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building-o"></i> Empresas Activas</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <ul class="nav nav-tabs nav-justified">
        <li><a href="<?php echo base_url('admin/Empresas') ?>" style="color:#808080">Usuarios Inactivos</a></li>
        <li class="active"><a href="#"  style="background-color:#FFE000; color:#808080">Usuarios Activos</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color:#C0C0C0">
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Nombre</th>
                            <th>NIT </th>
                            <th>Validar Email</th>
                            <th>Documentos pendientes por aprobación</th>
                            <th>Licencia</th>           
                            <th>Acciones</th>
                            <th>HV</th>
                            <th>Autorizado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$datos) {
                            echo "<tr>";
                            echo "<td colspan='2'>" . "<h4 style='color:red'>" . $mensaje . "</h4>" . "</td>";
                            echo "</tr>";
                        } else {
                            foreach ($datos as $row) {
                                $estado = $row->activo;
                                $hv = "Empresa no ha sido AUTORIZADO por Enturne";
                                $checkMail = $row->estado;
                                if ($estado == 5) {
                                    $res = 'Licencia activa';
                                    $boton = '<a href="#"  onclick="bloquear(' . $row->idEmpresa . ')" title="Bloquear Empresa"><i class="fa fa-ban fa-2x"></i></a>';
                                    $hv = anchor(base_url() . 'empresa/Perfil/get_hv_empresa/' . $row->idEmpresa, '<i class="fa fa-file-pdf-o fa-2x"></i>', array('target' => '_blank'));
                                } else {
                                    $res = '';
                                    $boton = '<a href="#" onclick="desbloquear(' . $row->idEmpresa . ')" title="Activar Empresa"><i class="fa fa-check fa-2x"></i></a>';
                                }
                                if ($checkMail == 0) {
                                    $checkMail = "<a href='#' title = 'Email no validado' onclick='validarEmail(" . $row->id_admin . ");'><img src=" . base_url('assets/img/mail_invalido.png') . "></a>" . "</td>";
                                }
                                if ($checkMail == 1) {
                                    $checkMail = "<a href='#' title = 'Email validado'><img src=" . base_url('assets/img/mail_valido.png') . "></a>" . "</td>";
                                }
                                echo "<tr>";
                                echo"<td>" . $res . "</td>";
                                echo"<td>" . $row->created_at . "</td>";
                                echo"<td>" . $row->nombre_empresa . "</td>";
                                echo"<td>" . $row->nit . "</td>";
                                echo"<td>" . $checkMail . "</td>";
                                echo"<td>" . $row->verificarDocs . "</td>";
                                echo"<td>" . $res . "</td>";
                                echo"<td>" . anchor(base_url() . 'admin/Empresas/edit_empresaxid/' . $row->idEmpresa, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Empresa')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/edit_docsempresaxid/' . $row->idEmpresa, '<i class="fa fa-folder-open-o fa-2x"></i>', array('title' => 'Documentación actual')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/get_personal_empxid/' . $row->idEmpresa, '<i class="fa fa-male fa-2x"></i>', array('title' => 'Personal Empresa')) . "&nbsp" . anchor(base_url() . 'admin/Empresas/crear_personal_empresas/' . $row->idEmpresa, '<i class="fa fa-user-plus fa-2x"></i>', array('title' => 'Crear Personal 1')) . "&nbsp" . $boton . '</td>';
                                echo"<td>" . $hv . "</td>";
                                echo"<td><button type='button' class='btn btn-primary' onclick='apto_licencia(" . $row->idEmpresa . ")'>Autorizado</button></td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
