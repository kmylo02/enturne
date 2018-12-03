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
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Users' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building-o"></i> Documentación por vencer</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <ul class="nav nav-tabs nav-justified">
        <li class="<?=(current_url()==base_url('admin/Docs/docs_x_vencer_conductor')) ? 'active':''?>"><a href="<?php echo base_url('admin/Docs/docs_x_vencer_conductor')?>">Conductores</a></li>
        <li class="<?=(current_url()==base_url('admin/Docs/docs_x_vencer_vehiculo')) ? 'active':''?>"><a href="<?php echo base_url('admin/Docs/docs_x_vencer_vehiculo')?>">Vehiculos</a></li>
    </ul>
    <div class="tab-content">
            <div class="table-responsive">
                <table id="dataTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color:#FFE000">
                          <?php echo $titulos?>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $body?>
                    </tbody>
                </table>

            </div>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>