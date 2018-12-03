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
            <h1>Calificar Servicio <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'conductor/Ofertas/listado_ofertas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Ofertas</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Empresa</th>
                    <th class="header">Trayecto</th>
                    <th class="header">Ranking</th>
                    <th class="header">Calificación</th>
                    <th class="header">Observaciones</th>
                </tr>
            </thead>
            <tbody>

            <form action="<?= base_url() . 'conductor/Ofertas/enviar_calificacion/' . $datos['idEmpresa'] . '/' . $datos['idVehiculo'] . '/' . $datos['idContrato'] ?>" method="post">
                <input type="hidden" name="conductor" value="<?= $datos['idConductor'] ?>">
                <tr>
                    <td style="text-align: left"><?= $datos['nombre'] ?></td>
                    <td style="text-align: left"><?= $datos['trayecto'] ?></td>
                    <?php if ($ranking->ranking >= 0 && $ranking->ranking < 0.5) { ?>
                        <td><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 0.5 && $ranking->ranking < 1) { ?>
                        <td><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 1 && $ranking->ranking < 1.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 1.5 && $ranking->ranking < 2) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 2 && $ranking->ranking < 2.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 2.5 && $ranking->ranking < 3) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 3 && $ranking->ranking < 3.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 3.5 && $ranking->ranking < 4) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 4 && $ranking->ranking < 4.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking >= 4.5 && $ranking->ranking < 5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                        </td><?php } ?>
                    <?php if ($ranking->ranking == 5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </td><?php } ?>
                    <td style="text-align: left"><SELECT name='calificacion' class=''><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></SELECT></td>
                    <td style="text-align: left"><textarea name='obsv'></textarea></td>
                    <td style="text-align: left"><input type='submit' class='btn btn-warning' name='calificar' value="Enviar Calificación" onclick="return confirmar_calificar()"/></td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
