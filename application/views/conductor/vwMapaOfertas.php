<?php
$this->load->view('conductor/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
-->
<style type="text/css">

    #sidebar{
        position: absolute;
        width: 100px;
        height: 600px;
        background: #F7E000;
        color: #fff;
        margin-left: 1005px;
        margin-top: -600px;
        border: 1px solid #F7E000;
    }
    ul{
        padding: 0;
        text-align: justify;
    }

    #li_side{
        cursor: pointer;
        border-top: 1px solid #fff;
        background: #000000;
        list-style: none;
        color: #F7E000
    }
    #li_side:hover{
        background: #F7E000;
        color: black;
    }
</style>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $title?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Ofertas' ?>"><i class="fa fa-level-up fa-3x"></i></a></li>
                <li><?php echo $botonMapa ?></li>
                <li><a href="<?php echo base_url() . 'conductor/Ofertas/listado_ofertas' ?>">Ver lista ofertas</a></li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-map"></i> </h3>
                    </div>
                    <div class="panel-body">
                        <center><div id="loader" style="display:none"><img src="<?php echo base_url('assets/img/enturne-loading.gif')?>"></div></center>
                      <div id="morris-chart-area"></div>
                    </div>
                </div>
            </div>
        </div><!--/.row -->
    </div>
</div><!--/#page-wrapper -->


<!--PAge Code Ends here -->
<?php
    $this->load->view('conductor/vwFooter');
?>