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
            <h1>Vehiculos <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'conductor/Dashboard' ?>"><i class="fa fa-home fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Vehiculos</li>
                <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#form-vehiculo">Añadir Vehiculo</button>
            </ol>
        </div>
    </div><!-- /.row -->
    <!--modal-->
    <div class="modal fade" id="form-vehiculo" tabindex="-1" role="dialog" aria-labelledby="formVehiculo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="javascript:addVehiculo()" id="addVehiculoForm" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Añadir Vehiculo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-xs-5 control-label">Placa(*):</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="placa" placeholder="Placa" required>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Departamento Matricula(*):</label>
                            <div class = "col-xs-5">
                                <select name="provincia" id="provincia" class="form-control" required>
                                    <option value="">[SELECCIONE]</option>
                                    <?php
                                    foreach ($paises as $fila) {
                                        ?>
                                        <option value="<?php echo $fila->idDepartamento ?>"><?php echo $fila->nombre_dpto ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Ciudad Matricula(*):</label>
                            <div class = "col-xs-5">
                                <select name="localidad" id="localidad" class="form-control" required>
                                    <option value="">[SELECCIONE]</option>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Tipo de Vehiculo(*):</label>
                            <div class = "col-xs-5">
                                <select class="form-control" name="tipo_vehiculo_id" id="tipov" required>
                                    <option value="">Selecciona</option>
                                    <?php
                                    foreach ($tipov as $val) {
                                        ?>
                                        <option value="<?php echo $val->idTipoVehiculo ?>"><?php echo $val->nombre_tv ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Carroceria(*):</label>
                            <div class = "col-xs-5">
                                <select class = "form-control" name = "carroceria_id" required>
                                    <option value="">Selecciona</option>
                                    <?php
                                    foreach ($carr as $val) {
                                        ?>
                                        <option value="<?php echo $val->idCamionesCarroceria ?>"><?php echo $val->nombre_carr ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><hr>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Satelite</label>
                            <div class = "col-xs-5">
                                <input type = "text" class = "form-control" name = "satelite" placeholder = "Satelite">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Usuario Satelite</label>
                            <div class = "col-xs-5">
                                <input type = "text" class = "form-control" name = "sateliteusuario" placeholder = "Usuario Satelite">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Clave Satelite</label>
                            <div class = "col-xs-5">
                                <input type = "text" class = "form-control" name = "sateliteclave" placeholder = "Clave Satelite">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Repotenciación</label>
                            <div class = "col-xs-5">
                                <input type = "text" class = "form-control" name = "repotenciacion" placeholder = "Repotenciación">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Modelo(*):</label>
                            <div class = "col-xs-5">
                                <input type = "number" class = "form-control" name = "modelo" placeholder = "Modelo">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Marca(*):</label>
                            <div class = "col-xs-5">
                                <select class = "form-control" name = "marca" required>
                                    <option value="">Selecciona</option>
                                    <?php
                                    foreach ($marca as $val) {
                                        ?>
                                        <option value="<?php echo $val->idMarca ?>"><?php echo $val->nombre ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Peso Vacio(*):</label>
                            <div class = "col-xs-5">
                                <input type = "number" class = "form-control" name = "pesov" id="pesov" placeholder = "Peso Vacio">
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Capacidad de carga(*):</label>
                            <div class = "col-xs-5">
                                <input type = "number" class = "form-control" name = "capacidad_carga" placeholder = "Capacidad de carga" required>
                            </div>
                        </div><hr>
                        <div id="trailer">
                            <div class = "form-group">
                                <h4><label class = "col-xs-5 control-label">TRAILER</label></h4>
                            </div>

                            <div class = "form-group">
                                <label class = "col-xs-5 control-label">Placa(*):</label>
                                <div class = "col-xs-5">                                    
                                    <input type = "text" class = "form-control" name = "trailer" id="placatrailer" placeholder = "Placa Trailer">
                                </div>
                            </div>

                            <div class = "form-group">
                                <label class = "col-xs-5 control-label">Marca(*):</label>
                                <div class = "col-xs-5">
                                    <select name = "marcatrailer" id="marcatrailer" class="form-control">
                                        <option value="">[SELECCIONE]</option>
                                        <?php
                                        foreach ($trailers as $trailer) {
                                            ?>
                                            <option value="<?php echo $trailer->idTrailer ?>"><?php echo $trailer->trailer_marca ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class = "form-group">
                                <label class = "col-xs-5 control-label">Modelo(*):</label>
                                <div class = "col-xs-5">
                                    <input type = "number" class = "form-control" name = "trailermodelo" id="trailermodelo" placeholder = "Modelo Trailer">
                                </div>
                            </div>

                            <div class = "form-group">
                                <label class = "col-xs-5 control-label">Peso Vacio(*):</label>
                                <div class = "col-xs-5">
                                    <input type = "number" class = "form-control" name = "pesovtrailer" id="pesovtrailer" placeholder = "Peso Vacio Trailer">
                                </div>
                            </div><hr>
                            </div>
                        <div class = "form-group">
                            <h4><label class = "col-xs-5 control-label">SOAT</label></h4>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Numero:</label>
                            <div class = "col-xs-5">
                                <input type = "text" name = "num_soat" class="form-control"  required>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Compañia:</label>
                            <div class = "col-xs-5">
                                <select class = "form-control" name = "compania" required>
                                    <option value="">Selecciona</option>
                                    <?php
                                    foreach ($aseg as $val) {
                                        ?>
                                        <option value="<?php echo $val->idAseguradora ?>"><?php echo $val->nombre_aseguradora ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Fecha de vencimiento SOAT(*):</label>
                            <div class = "col-xs-5">
                                <input type = "text" name = "vence_soat" id = "vence_soat" readonly class="form-control" placeholder="AAAAMMDD"  required>
                            </div>
                        </div>
                        <hr>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Fecha de vencimiento TM(*):</label>
                            <div class = "col-xs-5">
                                <input type = "text" name = "vence_rtecno" id = "vence_rtecno" readonly class="form-control" placeholder="AAAAMMDD"  required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div>
        <div class="table-responsive">
            <table id="dataTable" class="table table-hover tablesorter" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color:#FFE000">
                        <th class="header">Placa</th>
                        <th class="header">Estado</th>
                        <th class="header">Tipo - Carroceria</th>
                        <th class="header">Venc. SOAT</th>
                        <th class="header">Venc. T.M</th>
                        <th class="header">Creado</th>
                        <th class="header">Venc. Licencia</th>
                        <th class="header">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!$vehiculo) {
                        echo "<tr>";
                        echo "<td>" . $mensaje . "</td>";
                        echo "</tr>";
                    } else {
                        foreach ($vehiculo as $row) {
                            $conductor = $row->conductor_id;
                            if ($conductor != NULL) {
                                $conductor = true;
                            } else {
                                $conductor = false;
                            }
                            $estado = $row->activo;
                            if ($estado == 0) {
                                $mens = 'Sin licencia ni documentación completa';
                                $hv = '';
                            }
                            if ($estado == 1) {
                                $mens = 'Activo';
                                $mens = 'Activo';
                                if ($conductor === false) {
                                    $hv = anchor_popup(base_url("empresa/perfil/generar_hv_vehiculo") . '/' . $row->idVehiculo, '<i class="fa fa-file-pdf-o fa-2x"></i>', array('title' => 'Hoja de Vida'));
                                } else {
                                    $hv = anchor_popup(base_url("empresa/perfil/generar_hv_completa") . '/' . $row->conductor_id, '<i class="fa fa-file-pdf-o fa-2x"></i>', array('title' => 'Hoja de Vida'));
                                }
                            }
                            if ($estado == 2) {
                                $mens = 'Sin licencia';
                                $hv = '';
                            }
                            if ($estado == 3) {
                                $mens = 'Documentación pendiente';
                                $hv = '';
                            }
                            if ($estado == 4) {
                                $mens = 'Pago de licencia en proceso de verificación';
                                $hv = '';
                            }
                            echo "<tr>";
                            echo"<td>" . $row->placa . "</td>";
                            echo"<td>" . $mens . " " . $row->enturne . "</td>";
                            echo"<td>" . $row->nombre_tv . " - " . $row->carr . "/" . $row->carr2 . "</td>";
                            echo"<td>" . $row->vence_soat . "</td>";
                            echo"<td>" . $row->vence_rtecnomecanica . "</td>";
                            echo"<td>" . $row->vencelic . "</td>";
                            echo"<td>" . $row->created_at . "</td>";
                            echo "<td>" . anchor(base_url() . 'conductor/Perfil/get_vehiculo_xid/' . $row->idVehiculo, '<i class="fa fa-truck fa-2x"></i>  ', array('title' => 'Ver'))
                            . $hv . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
