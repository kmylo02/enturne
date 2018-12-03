<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Author : Jhon Jairo Valdés Aristizabal 
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Impuestos <small>Listado</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'admin/Dashboard/config'?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Impuestos</li>


                <button class="btn btn-primary" type="button" style="float:right;">Añadir Impuesto</button>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->



    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr style="background-color:#C0C0C0">
                    <th class="header">No</th> 
                    <th class="header">Titulo </th>   
                    <th class="header">País <i class="fa fa-flag"></i></th>                  
                    <th class="header">Porcentaje </th> 
                    <th class="header">Descripción</th>                        
                    <th class="header"><i class="fa fa-calendar"></i></th>
                    <th class="header">Detalle <i class="fa fa-info"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($datos as $row) {
                    echo "<tr>";
                    echo"<td>" . $row->id . "</td>";
                    echo"<td>" . $row->titulo . "</td>";
                    echo"<td>" . $row->pais_id . "</td>";
                    echo"<td>" . $row->porcentaje . "</td>";
                    echo"<td>" . $row->description . "</td>";                   
                    echo"<td>" . $row->created_at . "</td>";                 
                    echo"<td></td>";
                    echo "</tr>";
                }
                ?>      

            </tbody>
        </table>
    </div>

    <ul class="pagination pagination-sm">
        <li class="disabled"><a href="#"><<</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">>></a></li>
    </ul>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>