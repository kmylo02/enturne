<?php
$this->load->view('admin/vwHeader');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tablero
            <small>Ofertas de Empleo Activas por transportistas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tablero</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="table-responsive">
            <table id="dataTable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#C0C0C0">
                        <th>Fecha Oferta</th>
                        <th>Descripcion</th>
                        <th>1</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr style="background-color:#C0C0C0">
                        <th>Fecha Oferta</th>
                        <th>Descripcion</th>
                        <th>1</th>
                        <th>Detalles</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (!$ofertast) {
                        echo "<tr>";
                        echo "<td>" . $mensaje . "</td>";
                        echo "</tr>";
                    } else {
                        foreach ($ofertast as $row) {
                            echo "<tr>";
                            echo"<td>" . $row->created_at . "</td>";
                            echo"<td>" . $row->descripcion . "</td>";
                            echo"<td>" . $row->nombre." ".$row->apellidos. "</td>";
                            echo"<td>" . anchor(base_url() . 'empresa/Empleo/get_ofertat_xid/' . $row->id_oferta, '<i class="fa fa-newspaper-o fa-2x"></i>',array('title'=>'Ver oferta')) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div> 

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--  PAge Code Ends here -->
<?php
$this->load->view('admin/vwFooter');
?>