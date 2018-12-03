<?php
$this->load->view('empresa/vwHeader');
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
                <li><a href="<?php echo base_url() . 'empresa/Ofertas/listado_ofertas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Conductores</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Nombre Completo</th>
                    <th class="header">Ranking</th>
                    <th class="header">Calificación</th>
                    <th class="header">Observaciones</th>
                </tr>
            </thead>
            <tbody>

            <form action="<?php echo base_url() . 'empresa/Ofertas/enviar_calificacion/' . $idConductor . '/' . $idv . '/' . $idCarga ?>" method="post">
                <input type="hidden" name="empresa" value="<?php echo $empresa ?>">
                <tr>
                    <td><?php echo $datos->nombre . " " . $datos->apellidos ?></td>
                    <?php if ($datos->ranking >= 0 && $datos->ranking < 0.5) { ?>
                        <td><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 0.5 && $datos->ranking < 1) { ?>
                        <td><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 1 && $datos->ranking < 1.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 1.5 && $datos->ranking < 2) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 2 && $datos->ranking < 2.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 2.5 && $datos->ranking < 3) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 3 && $datos->ranking < 3.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 3.5 && $datos->ranking < 4) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 4 && $datos->ranking < 4.5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking >= 4.5 && $datos->ranking < 5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                        </td><?php } ?>
                    <?php if ($datos->ranking == 5) { ?>
                        <td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </td><?php } ?>
                    <td><SELECT name='calificacion' class=''><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></SELECT></td>
                    <td><textarea name='obsv'></textarea></td>
                    <td><input type='submit' class='btn btn-warning' name='calificar' value="Enviar Calificación" onclick="return confirmar_calificar()"/></td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
