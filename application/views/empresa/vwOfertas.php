<?php
$this->load->view('empresa/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Buscar Camiones</h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bienvenido <?php echo $nombre . " " . $apellidos;
?>
            </div>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">
                            <img src="<?php echo base_url() . 'assets/img/CrearOferta.png' ?>" alt=""/>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="#">          
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-oferta">Crear Oferta de Carga</button>
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
                            <img src="<?php echo base_url() . 'assets/img/Consultarmisofertas.png' ?>" alt=""/>
                        </div> 
                        <div class="col-xs-4"></div>
                    </div>
                </div>

                <a href="<?php echo base_url() . 'empresa/Ofertas/listado_ofertas' ?>">
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary">Ofertas Creadas</button>
                        </center>
                    </div>
                </a>
            </div>
        </div><!-- /.row -->
    </div>
</div><!-- /#page-wrapper -->

<!--Modal-->
<div class="modal fade" id="form-oferta" tabindex="-1" role="dialog" aria-labelledby="formOferta" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" name="myModalLabel">Crear oferta de carga</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="javascript:crear_oferta()" id="formCrearOferta" class="form-horizontal">
                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Origén(*):</label>
                        <div class = "col-xs-5">
                            <select name="dpto_origen_id" id="provincia" class="form-control" required>
                                <option value="">Seleccionar:</option>
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
                        <label class = "col-xs-5 control-label"></label>
                        <div class = "col-xs-5">
                            <select name="origen_id" id="localidad" class="form-control" required>
                                <option value="">Selecciona tu departamento</option>
                            </select>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Destino(*):</label>
                        <div class = "col-xs-5">
                            <select name="dpto_destino_id" id="provinciaEmpresa" class="form-control" required>
                                <option value="">Seleccionar:</option>
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
                        <label class = "col-xs-5 control-label"></label>
                        <div class = "col-xs-5">
                            <select name="destino_id" id="localidadEmpresa" class="form-control" required>
                                <option value="">Selecciona tu departamento</option>
                            </select>
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Tipo de Vehiculo</label>
                        <div class = "col-xs-5">
                            <select class="form-control" name="tipo_vehiculo_id">
                                <option value="">Selecciona</option>
                                <?php
                                foreach ($tipo as $val) {
                                    ?>
                                    <option value="<?php echo $val->idTipoVehiculo ?>"><?php echo $val->nombre_tv ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Carroceria</label>
                        <div class = "col-xs-5">
                            <select class = "form-control" name = "carroceria_id">
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
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Peso Kg(*):</label>
                        <div class = "col-xs-5">
                            <input onkeyup="format(this)" onchange="format(this)" type = "text" class = "form-control" name = "peso" placeholder = "Peso en kg." required>
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Dimensiones:</label>
                        <div class = "col-xs-5">
                            <input type = "text" class = "form-control" name = "dimensiones" placeholder = "Opcional">
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Cantidad de Vehiculos requeridos(*):</label>
                        <div class = "col-xs-5">
                            <input type = "number" class = "form-control" name = "cantidad" placeholder = "No Vehiculos Req." required>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Fecha de cargue(*):</label>
                        <div class = "col-xs-5">
                            <input type = "date" name = "fecha" required min="<?= date("Y-m-d") ?>"/>                
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-5 control-label">Valor Flete (C/U)(*):</label>
                        <div class = "col-xs-5">
                            <input onkeyup="format(this)" onchange="format(this)" type = "text" class = "form-control" name = "valor" placeholder = "$" required>
                        </div>
                    </div>

                    <!--<div class = "form-group">
                        <label class = "col-xs-5 control-label">Manifiesto de Carga:</label>
                        <div class = "col-xs-5">
                            <label class="control-label" for="files"><div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;"><img src="<?= base_url('assets/img/clip.png') ?>" style="width: 30px;margin-top: 8px;margin-right: 1px;margin-left: 4px;"></div></label>   
                            <p id="datofile"></p>
                            <input type="file"  name="files" id="files" style="display: none" onchange="getFileName(this)" accept="*" size="2048"> 
                        </div>
                    </div>-->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Crear</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
    <!--fin modal-->
    <!--  PAge Code Ends here -->
    <?php
    $this->load->view('empresa/vwFooter');
    ?>
