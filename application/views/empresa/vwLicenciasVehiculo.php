<?php
$this->load->view('empresa/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
-->
<!--  PAge Code Starts here -->

<!-- Page Specific Plugins -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<!-- Page Specific CSS -->
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<script src="<?php echo base_url() . 'assets/js/morris/chart-data-morris.js' ?>"></script>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Adquirir Licencia <small>Empresarial</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?php
                $cons = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
                if ($cons->num_rows() != 0) {
                    foreach ($cons->result() as $row) {
                        echo $row->nombre . " " . $row->apellidos;
                    }
                }
                ?>
            </div>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">No</th>
                    <th class="header">Categoria</th>
                    <th class="header">Codigo</th>
                    <th class="header">Nombre</th>
                    <th class="header">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (!$licencias) {
                    echo "<tr>";
                    echo "<td>" . $mensaje . "</td>";
                    echo "</tr>";
                } else {
                    foreach ($licencias as $row) {
                        echo "<tr>";
                        echo"<td>" . $row->id . "</td>";
                        echo"<td>" . $row->categoria . "</td>";
                        echo"<td>" . $row->codigo . "</td>";
                        echo"<td>" . $row->nombre_producto . "</td>";
                        echo"<td>" . anchor(base_url() . 'empresa/Licencias/get_licencia_vehiculos_xid/' . $row->id, '<button type="button" class="btn btn-warning">VER</button>') . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>





</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('empresa/vwFooter');
?>
