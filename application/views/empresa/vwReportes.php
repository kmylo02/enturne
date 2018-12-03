<?php
$this->load->view('empresa/vwHeader');
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Reportes conductores contratados</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-info"></i> Reportes</li>
                <li class="active"><button type="button" class="btn btn-success btn-ls"></button> Contratos Administrador</li>
                <li class="active"><button type="button" class="btn btn-primary btn-ls"></button> Contratos Subusuario</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <?php echo $body?>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>