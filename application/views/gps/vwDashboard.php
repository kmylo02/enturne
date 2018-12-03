<?php
$this->load->view('gps/vwHeader');
?>
<!--  
Load Page Specific CSS and JS here
Author : Jhon Jairo Valdés Aristizabal 
Downloaded from http://devzone.co.in
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
            <h1>Panel Principal <small>GPS</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?php
                $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
                if ($query->num_rows() != 0) {
                    foreach ($query->result() as $row) {

                        echo $row->nombre . " ";
                        echo $row->apellidos;
                        $cont = $row->id;
                        $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $cont));
                        $count2 = $vehiculos->num_rows();
                    }
                }
                ?> 
            </div>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-truck fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <p class="announcement-text">Vehiculos</p>
                                    <p class="announcement-text"><?php
                                        echo $count2;
                                        ?> </p>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url() . 'gps/Perfil/get_vehiculos' ?>">
                            <div class="panel-footer announcement-bottom">
                                <div class="row">
                                    <div class="col-xs-8">
                                        Ver / Añadir
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
    </div><!-- /.row -->

</div><!-- /#page-wrapper -->


<!--  PAge Code Ends here -->
<?php
$this->load->view('gps/vwFooter');
?>