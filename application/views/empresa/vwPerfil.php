<?php
$this->load->view('empresa/vwHeader');
foreach ($edad as $fila) {
    $edad = $fila->EDAD_ACTUAL;
}
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <!--<h1>Perfil <small>1</small></h1>-->
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">

        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Nombre</th>
                    <th class="header">Apellidos </th>
                    <th class="header">Tipo de documento</th>
                    <th class="header">Edad</th>
                    <th class="header">Ciudad</th>
                    <th class="header">Telefono</th>
                    <th class="header">Email</th>
                    <th class="header">Dirección</th>
                    <th class="header">Tipo</th>
                </tr>
            </thead>
            <?php
            if (!$perfil) {
                echo $mensaje;
            } else {
                ?>
                <tbody>
                    <?php
                    $permisos = $perfil->permisos;
                    if ($permisos == 0)
                        $permisos = "Administrador";
                    if ($permisos == 1)
                        $permisos = "Solo Ofertas";
                    if ($perfil->tipo_doc == 1)
                        $tipoDoc = 'CC';
                    if ($perfil->tipo_doc == 2)
                        $tipoDoc = 'PP';
                    if ($perfil->tipo_doc == 3)
                        $tipoDoc = 'LM';
                    echo "<tr>";
                    echo"<td>" . $perfil->nombre . "</td>";
                    echo"<td>" . $perfil->apellidos . "</td>";
                    echo"<td>" . $tipoDoc . " " . $perfil->cedula . "</td>";
                    echo"<td>" . $edad . "</td>";
                    echo"<td>" . $perfil->nombre_ciudad . "</td>";
                    echo"<td>" . $perfil->telefono . " " . $perfil->celular . "</td>";
                    echo"<td>" . $perfil->email . "</td>";
                    echo"<td>" . $perfil->direccion . "</td>";
                    echo"<td>" . $permisos . "</td>";
                    echo"<td>" . anchor(base_url() . 'empresa/Perfil', '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Ver/Editar')) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    <?php
    if (!$perfil) {
        echo 'Tu foto de perfil aun no esta cargada';
    } else {
        ?>
        <form id="frmfoto" action="javascript:subirFotoUserEmpresa()" enctype="multipart/form-data">
            <?php
            if ($perfil->foto_ruta !== null) {
                $rutaFotoPerfil = base_url() . 'uploads/' . $perfil->idUser . '/' . $perfil->foto_ruta;
            } else {
                $rutaFotoPerfil = base_url() . 'assets/images_login/avatar.png';
            }
            ?>
            <div align="center"><img id="foto_perfil" src="<?= $rutaFotoPerfil ?>" /></div>
            <div align="center">
                <label>Seleccionar archivo si desea cambiar su foto de perfil y click en actualizar</label>
                <u><h3>El nombre del archivo, no debe contener espacios</h3></u>
                <input type="file"  name="userfile" accept="image/*">
                <input type="submit" name="update_foto" value="Enviar"/>
            </div>
        <?php }
        ?>
    </form>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
<!--<?= base_url() . 'empresa/Perfil/edit_foto_user' ?>-->
