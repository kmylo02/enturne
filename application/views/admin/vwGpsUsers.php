<?php
$this->load->view('admin/vwHeader');
foreach ($edad as $value) {
    $valedad=$value->EDAD_ACTUAL;
    
}
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
                <li class="active"><i class="fa fa-map-marker"></i> Datos Usuarios solo GPS</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#C0C0C0">                                      
                    <th>Nombre</th>
                    <th>Apellidos </th>
                    <th>Tipo de documento</th>
                    <th>Edad</th>                                      
                    <th>Telefonos</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tfoot>
                <tr style="background-color:#C0C0C0">                                      
                    <th>Nombre</th>
                    <th>Apellidos </th>
                    <th>Tipo de documento</th>
                    <th>Edad</th>                                      
                    <th>Telefonos</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if (!$datos) {
                    echo "<tr>";
                    echo "<td>"."<h4 style='color:red'>" . $mensaje ."</h4>"."</td>";
                    echo "</tr>";
                } else {
                    foreach ($datos as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->nombre . "</td>";
                        echo"<td>" . $row->apellidos . "</td>";
                        echo"<td>" . $row->tipo . " " . $row->cedula . "</td>";
                        echo"<td>" . $valedad . "</td>";
                        echo"<td>" . $row->telefono . "<br>" . $row->celular . "</td>";
                        echo"<td>" . $row->email . "</td>";
                        echo"<td>" . $row->direccion . "</td>";
                        echo"<td>" . anchor(base_url() . 'admin/Gps/get_user_gps_xid/' . $row->id, '<i class="fa fa-pencil fa-2x"></i>',array('title' => 'Editar Usuario GPS')) . "</td>";
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
