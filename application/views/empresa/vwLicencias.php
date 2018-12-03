<?php
$this->load->view('empresa/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Adquirir Licencia <small>Empresarial</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?php echo $nombre . " " . $apellidos?>
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
                        echo"<td>" . anchor(base_url() . 'empresa/Licencias/get_licencia_xid/' . $row->id, '<button type="button" class="btn btn-warning">VER</button>') . "</td>";
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
