<?php
$this->load->view('gps/vwHeader');
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
            <h1>Perfil <small>GPS</small></h1>
            <ol class="breadcrumb">
                
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>


                <button class="btn btn-primary" type="button" style="float:right;" id="add_pais">Añadir Personal</button>
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
                    <th class="header">Celular</th>
                    <th class="header">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($perfil as $row) {
                    echo "<tr>";
                    echo"<td>" . $row->nombre . "</td>";
                    echo"<td>" . $row->apellidos . "</td>";
                    echo"<td>" . $row->tipo . " " . $row->cedula . "</td>";
                    echo"<td>" . $edad . "</td>";
                    echo"<td>" . $row->nombre_ciudad . "</td>";
                    echo"<td>" . $row->telefono . "</td>";
                    echo"<td>" . $row->email . "</td>";
                    echo"<td>" . $row->direccion . "</td>";
                    echo"<td>" . $row->celular . "</td>";
                    echo"<td>" . anchor(base_url() . 'gps/Perfil', 'Ver/Completar') . "</td>";
                    echo "</tr>";
                }
                ?>   
            </tbody>
        </table>

    </div>
    <form action="<?php echo base_url() . 'gps/Perfil/edit_foto_user' ?>" enctype="multipart/form-data" method="post">
        <div align="center"><img id="foto_perfil" src="<?php echo base_url() ?>uploads/<?php echo $row->foto_ruta ?>" /></div>
        <div align="center">
            <label>Seleccione examinar si desea cambiar su foto de perfil y click en actualizar</label>
            <input type="file"  name="userfile" />
            <input type="submit" name="update_foto" value="Actualizar"/>
        </div>
    </form>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('gps/vwFooter');
?>
