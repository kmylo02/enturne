<?php
$this->load->view('empresa/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-level-up fa-2x"></i></a> <?php echo $titulo; ?></li>
            </ol>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?php echo $nombre . " " . $apellidos; ?>
            </div>
        </div>
    </div><!-- /.row -->
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">
                            <img src="<?php echo base_url('assets/img/crear_vacante.png') ?>" alt="" width="255%" height="255%">   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="#">          
                    <div class="panel-footer">
                        <center>
                            <?php if ($vehiculos == FALSE) { ?>
                                <button type="button" class="btn btn-primary" onclick="avisoSinVehiculos()">Crear vacante</button><?php } else { ?><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-vacante">Crear vacante</button><?php } ?>                  
                        </center>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">

                            <img src="<?php echo base_url('assets/img/vacantes_creadas.png') ?>" alt="" width="200%" height="200%">   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="<?php echo base_url() . 'empresa/Empleo/Ofertas_Empleo' ?>">          
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary">Vacantes creadas</button>
                        </center>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">
                            <img src="<?php echo base_url('assets/img/ConductoresContratados.png') ?>" alt="" width="255%" height="255%">   
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="<?php echo base_url() . 'empresa/Empleo/get_all_conductores_contratados' ?>">          
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary">Conductores Contratados</button>
                        </center>
                    </div>
                </a>
            </div>
        </div>
    </div><!-- /.row -->
    <!--Modal-->
    <div class="modal fade" id="form-vacante" tabindex="-1" role="dialog" aria-labelledby="formVehiculo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" name="myModalLabel">Crear vacante de empleo para conductores</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="javascript:crearVacante()" id="addVacanteForm" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-5 control-label">Cantidad de vacantes(*):</label>
                            <div class="col-xs-5">
                                <input type="number" class="form-control" name="cant" required>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Categoria Licencia(*):</label>
                            <div class = "col-xs-5">
                                <select name="categorialic" class="form-control" required>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C1">C1</option>
                                    <option value="C2">C2</option>
                                    <option value="C3">C3</option>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Configuración del vehiculo de la vacante(*):</label>
                            <div class = "col-xs-5">
                                <select class="form-control" name="tipo_vehiculo_id" required>
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
                            <label class = "col-xs-5 control-label">Contratación en(*):</label>
                            <div class = "col-xs-5">
                                <select name="provincia" id="provincia" class="form-control" required>
                                    <option value="">Dpto</option>
                                    <?php
                                    foreach ($paises as $fila) {
                                        ?>
                                        <option value="<?php echo $fila->idDepartamento ?>"><?php echo $fila->nombre_dpto ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select name="localidad" id="localidad" class="form-control" required>
                                    <option value="">Selecciona tu departamento</option>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Ejecución de labores en(*):</label>
                            <div class = "col-xs-5">
                                <select name="zona" class="form-control" required>
                                    <option value="Zona Urbana">Zona Urbana</option>
                                    <option value="Zona Nacional">Zona Nacional</option>
                                    <option value="Zona Urbana y Nacional">Zona Urbana y Nacional</option>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Salario:</label>
                            <div class = "col-xs-5">
                                <textarea class = "form-control" name="salario"></textarea>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Cierre de la vacante(*):</label>
                            <div class = "col-xs-5">
                                <input type="text" class="form-control" name="fechavenlic" id="fechavenlic" placeholder="AAAAMMDD" required>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-5 control-label">Detalle de la vacante:</label>
                            <div class = "col-xs-5">
                                <textarea class="form-control" name="detalle" placeholder="Breve descripción del cargo. Se sugiere en este campo, experiencia laboral requerida, Tipo de contrato, educación minima."></textarea>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <p style="text-align:center">Para crear su vancante de empleo, es necesario que tenga registrado los vehiculos de su propiedad administración.</p>
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--fin modal-->

    </div><!-- /#page-wrapper -->

    <?php
    $this->load->view('empresa/vwFooter');
    ?>
