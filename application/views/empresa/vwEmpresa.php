<?php
$this->load->view('empresa/vwHeader');
echo "<h5 style='color:red'>" . $error . "</h5>";
$registro = $perfil->activo;
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Empresa <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Empresa</li>
                <!--<a href="<?php echo base_url() . 'empresa/Perfil/add_emp' ?>"><button class="btn btn-primary" type="button" style="float:right;">Crear 1</button></a>-->
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Razón Social</th>
                    <!--<th class="header">Ciudad</th>-->
                    <th class="header">Dirección</th>
                    <th class="header">Telefono</th>
                    <th class="header">Email</th>
                    <th class="header">Web</th>
                    <!--<th class="header">Licencia Actual</th>-->

                </tr>
            </thead>
            <tbody>

                <?php
                if (!$empresa) {
                    echo "<tr>";
                    echo "<td>" . "<h5 style='color:red'>" . $mensaje . "</h5>" . "</td>";
                    echo "</tr>";
                } else {
                    $estado = $empresa->activo;
                    $hv = "Usted no ha sido AUTORIZADO por Enturne";
                    /* if ($estado == 0) {
                      $lic = 'Sin licencia';
                      }
                      if ($estado == 1) {
                      $lic = 'En proceso de verificación';
                      }
                      if ($estado == 2) {
                      $lic = 'Activa, documentación pendiente';
                      }
                      if ($estado == 3) {
                      $lic = 'Vencida';
                      } */
                    if ($estado == 5) {
                        //$lic = 'Activa';
                        $hv = anchor(base_url() . 'empresa/Perfil/get_hv_empresa/' . $empresa->idEmpresa, '<i class="fa fa-file-pdf-o fa-2x"></i>', array('target' => '_blank'));
                    }
                    echo "<tr>";
                    echo"<td>" . $empresa->nombre_empresa . "</td>";
                    //echo"<td>" . $row->nombre_ciudad . "</td>";
                    echo"<td>" . $empresa->direccion . "</td>";
                    echo"<td>" . $empresa->telefono . "</td>";
                    echo"<td>" . $empresa->email . "</td>";
                    echo"<td>" . "<a href='http://" . $empresa->web . "' target='parent'>" . $empresa->web . "</a>" . "</td>";
                    //echo"<td>" . $lic . "</td>";
                    /* if ($registro == 1 && $estado == 0) {
                      echo"<td>" . anchor(base_url() . 'empresa/Licencias', '<i class="fa fa-copyright fa-2x"></i>', array('title' => 'Adquirir licencia')) . "</td>";
                      } else {
                      echo"<td>" . "</td>";
                      } */
                    echo"<td>" . "</td>";
                    echo"<td>" . $hv . "</td>";
                    echo"<td>" . anchor(base_url() . 'empresa/Perfil/get_empxid/' . $empresa->idEmpresa, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Ver/Editar')) . "</td>";
                    echo"<td>" . anchor(base_url() . 'empresa/Perfil/get_docsempxid/' . $empresa->idEmpresa, '<i class="fa fa-folder-open-o fa-2x"></i>', array('title' => 'Documentos')) . "</td>";                    
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </div>

    <div class="col-lg-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="<?php echo base_url() . 'assets/img/UsuariosEmpresa.png' ?>" width="175" height="125" alt=""/>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-text">Mis Usuarios</p>
                    </div>
                </div>
            </div>

            <a href="<?php echo base_url() . 'empresa/Perfil/get_personal' ?>" title="Mis Usuarios">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-8">
                            Ver
                        </div>
                        <div class="col-xs-4 text-right">
                            <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
