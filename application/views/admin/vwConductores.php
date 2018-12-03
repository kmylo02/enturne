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
                <li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building-o"></i> Administración Transportistas</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <ul class="nav nav-tabs nav-justified">
        <li class="<?=(current_url()==base_url('admin/Conductores')) ? 'active':''?>"><a href="<?php echo base_url('admin/Conductores')?>">Conductores</a></li>
        <li class="<?=(current_url()==base_url('admin/Conductores/propietario')) ? 'active':''?>"><a href="<?php echo base_url('admin/Conductores/propietario')?>">Propietarios</a></li>
        <li class="<?=(current_url()==base_url('admin/Conductores/propietario_conductor')) ? 'active':''?>"><a href="<?php echo base_url('admin/Conductores/propietario_conductor')?>">Conductores Propietarios</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-body">
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
    </div>
</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>
