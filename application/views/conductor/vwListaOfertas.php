<?php
$this->load->view('conductor/vwHeader');
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Ofertas' ?>"><img src="<?php echo base_url('assets/img/MisOfertasdeCargas.png') ?>" width="10%" height="10%"></a>Listado de Ofertas de Carga</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <ul class="nav nav-tabs nav-justified">
        <?php if ($tipo == 1) { ?>
            <li class="<?= (current_url() == base_url('conductor/Ofertas/listado_ofertas')) ? 'active' : '' ?>"><a href="<?php echo base_url('conductor/Ofertas/listado_ofertas') ?>">Mis Ofertas</a></li>
        <?php } ?>
        <?php if ($tipo == 2) { ?>
            <li class="<?= (current_url() == base_url('conductor/Ofertas/listado_ofertas')) ? 'active' : '' ?>"><a href="<?php echo base_url('conductor/Ofertas/listado_ofertas') ?>">Mis Ofertas</a></li>
            <li class="<?= (current_url() == base_url('conductor/Ofertas/listado_ofertas_conductores')) ? 'active' : '' ?>"><a href="<?php echo base_url('conductor/Ofertas/listado_ofertas_conductores') ?>">Ofertas De Mis Conductores</a></li>
        <?php } ?>
        <?php if ($tipo == 3) { ?>
            <li class="<?= (current_url() == base_url('conductor/Ofertas/listado_ofertas_conductores')) ? 'active' : '' ?>"><a href="<?php echo base_url('conductor/Ofertas/listado_ofertas_conductores') ?>">Ofertas De Mis Conductores</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <br>
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color:#FFE000">
                    <?php echo $titulos ?>
                </tr>
            </thead>
            <tbody>
                <?php echo $body ?>
            </tbody>
        </table>
        <p style="color: orange"><?= $message ?></p>
    </div>
</div><!--/#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
