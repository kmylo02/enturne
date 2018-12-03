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
            <h1>Ofertas Creadas</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Ofertas' ?>"><i class="fa fa-level-up fa-3x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos de oferta</li>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table id="dataTable" class="display" cellspacing="0" width="100%">
            <?php if ($permiso == '0') {
                ?>
                <thead>
                    <tr style="background-color:#FFE000">
                        <th></th>
                        <th class="header">ID</th>
                        <th class="header">Creada por</th>
                        <th class="header">Fecha de Cargue</th>
                        <th class="header">Estado</th>
                        <th class="header">Trayecto</th>
                        <th class="header">Vehiculo</th>
                        <th class="header">Peso</th>
                        <th class="header">Cant</th>
                        <th class="header">Dimensiones</th>
                        <th class="header">Valor Flete C/U</th>
                        <th class="header">Aplicando</th>
                        <th class="header">Contratados</th>
                        <th class="header"></th>
                        <th class="header"></th>
                        <th class="header"></th>
                    </tr>
                </thead>
            <?php } else { ?>
                <thead>
                    <tr style="background-color:#FFE000">
                        <th></th>
                        <th class="header">ID</th>
                        <th class="header">Fecha de Cargue</th>
                        <th class="header">Estado</th>
                        <th class="header">Trayecto</th>
                        <th class="header">Vehiculo</th>
                        <th class="header">Peso</th>
                        <th class="header">Cant</th>
                        <th class="header">Dimensiones</th>
                        <th class="header">Valor Flete C/U</th>
                        <th class="header">Aplicando</th>
                        <th class="header">Contratados</th>
                        <th class="header"></th>
                        <th class="header"></th>
                        <th class="header"></th>
                    </tr>
                </thead>
            <?php } ?>
            <?php if ($permiso == '0') {
                ?>
                <tbody>
                    <?php
                    if (!$ofertas) {
                        echo '<td colspan="11" style="color:red">No hay ofertas creadas</td>';
                    } else {
                        foreach ($ofertas as $row) {
                            $aplicando = $this->Ofertas_model->get_count_aplicando($row->idOfertaCarga);
                            $contratados = $this->Ofertas_model->get_count_contratados($row->idOfertaCarga);
                            if ($row->estado === 'Cupos Llenos') {
                                $iconAplicando = "";
                            } else {
                                $iconAplicando = "<a href='" .
                                        base_url('empresa/Ofertas/get_oferta_xid_aplicando') .
                                        "/" . $row->idOfertaCarga . "'><img src='" .
                                        base_url('assets/img/APLICANDO.png') .
                                        "'/>" . $aplicando->aplicando . "</a>";
                            }
                            ?>
                        <form  action="<?php echo base_url() .
                                'empresa/Ofertas/update_oferta/' .
                                $row->idOfertaCarga ?>"  method="post" >
                            <tr>
                                <td></td>
                                <td><?= $row->idOfertaCarga ?></td>
                                <td><?php echo $row->nombre . ' ' . $row->apellidos ?></td>
                                <td><?php echo $row->fecha ?></td>
                                <td><?php echo $row->estado ?></td>
                                <td><?php echo $row->origen . '-' . $row->destino ?></td>
                                <td><?php echo $row->nombre_tv . '-' . $row->nombre_carr ?></td>
                                <td><?php echo number_format($row->peso, 0, ",", ".") . " " . "Kg"; ?></td>
                                <td><?php echo $row->cantidad ?></td>
                                <td><?php echo $row->dimensiones ?></td>
                                <td><?php
                                    setlocale(LC_MONETARY, 'es_CO');
//									echo money_format('%.0n', $row->vrflete);
                                    echo number_format($row->vrflete, 2, ",", ".");
                                    ?></td>
                                <td><?= $iconAplicando ?></td>
                                <td><a href="<?php echo base_url() . 'empresa/Ofertas/get_oferta_xid_contratados/' . $row->idOfertaCarga ?>"><img src="<?php echo base_url('assets/img/CONTRATADOS.png') ?>"/><?php echo $contratados->contratados ?></a></td>
                                <?php if ($row->estado == 'Cupos Llenos') { ?>
                                    <td></td>
                                    <td><?php echo anchor(base_url() . 'empresa/Ofertas/cerrar_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-ban fa-2x"></i>', array('title' => 'Finalizar Oferta', 'onclick' => 'return confirm_cerrar_oferta();
                                ')) ?> </td>
                                    <td><?php echo anchor(base_url() . 'empresa/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();
                                ')) ?> </td>
                                <?php } if ($row->estado == 'Abierta') { ?>
                                    <td><a href="<?php echo base_url() . 'empresa/Ofertas/edit_oferta/' . $row->idOfertaCarga ?>"><i class='fa fa-pencil fa-2x'></i></a></td>
                                    <td><?php echo anchor(base_url() . 'empresa/Ofertas/cerrar_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-ban fa-2x"></i>', array('title' => 'Finalizar Oferta', 'onclick' => 'return confirm_cerrar_oferta();
                                ')) ?> </td>
                                    <td><?php echo anchor(base_url() . 'empresa/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();
                                ')) ?> </td>
                                <?php } ?>
                                <?php if ($row->estado == 'Cerrada') { ?>
                                    <td></td>
                                    <td><?= "Oferta Cerrada" ?> </td>
                                    <td><?php echo anchor(base_url() . 'empresa/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();
                                ')) ?> </td>
                                <?php } ?>
                            </tr><?php
                        }
                    }
                    ?>
                </form>
                </tbody>
            <?php } else { ?>
                <tbody>
                    <?php
                    if (!$ofertas) {
                        echo '<td colspan = "11" style = "color:red">No hay ofertas creadas</td>';
                    } else {
                        foreach ($ofertas as $row) {
                            $idCreador = $row->usuario_id;
                            if ($idCreador == $idUsuario) {
                                ?>
                            <form  action="<?php echo base_url() . 'empresa/Ofertas/update_oferta/' . $row->idOfertaCarga ?>"  method="post" >
                                <tr>
                                    <td></td>
                                    <td><?= $row->idOfertaCarga ?></td>
                                    <td><?php echo $row->fecha ?></td>
                                    <td><?php echo $row->estado ?></td>
                                    <td><?php echo $row->origen . '-' . $row->destino ?></td>
                                    <td><?php echo $row->nombre_tv . '-' . $row->nombre_carr ?></td>
                                    <td><?php echo number_format($row->peso, 0, ",", ".") . " " . "Kg"; ?></td>
                                    <td><?php echo $row->cantidad ?></td>
                                    <td><?php echo $row->dimensiones ?></td>
                                    <td><?php
                                        setlocale(LC_MONETARY, 'es_CO');
                                        echo money_format('%.0n', $row->vrflete)
                                        ?></td>
                                    <td><?= $iconAplicando ?></td>
                                    <td><a href="<?php echo base_url() . 'empresa/Ofertas/get_oferta_xid_contratados/' . $row->idOfertaCarga ?>"><img src="<?php echo base_url('assets/img/CONTRATADOS.png') ?>"/><?php echo $contratados->contratados ?></a></td>
                                    <?php if ($row->estado == 'Cupos Llenos') { ?>
                                        <td></td>
                                        <td><?php echo anchor(base_url() . 'empresa/Ofertas/cerrar_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-ban fa-2x"></i>', array('title' => 'Finalizar Oferta', 'onclick' => 'return confirm_cerrar_oferta();
                                ')) ?> </td>
                                        <td><?php echo anchor(base_url() . 'empresa/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();
                                ')) ?> </td>
                                    <?php } if ($row->estado == 'Abierta') { ?>
                                        <td><a href="<?php echo base_url() . 'empresa/Ofertas/edit_oferta/' . $row->idOfertaCarga ?>"><i class='fa fa-pencil fa-2x'></i></a></td>
                                        <td><?php echo anchor(base_url() . 'empresa/Ofertas/cerrar_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-ban fa-2x"></i>', array('title' => 'Finalizar Oferta', 'onclick' => 'return confirm_cerrar_oferta();
                                ')) ?> </td>
                                        <td><?php echo anchor(base_url() . 'empresa/Ofertas/delete_oferta/' . $row->idOfertaCarga, '<i class = "fa fa-trash fa-2x"></i>', array('title' => 'Eliminar Oferta', 'onclick' => 'return confirm_eliminar_oferta();
                                ')) ?> </td>
                                    <?php } ?>
                                </tr><?php
                            } else {
                                echo '';
                            }
                        }
                        ?>
                    </form>
                    </tbody>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>

