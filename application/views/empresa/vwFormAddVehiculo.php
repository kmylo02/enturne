<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Añadir <small> Vehiculo</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Perfil/get_vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Vehiculo</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("empresa/Perfil/guardar_vehiculo", $attributes);
    ?>
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?php
            $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row) {
                    echo $row->id;
                }
            }
            ?> "/>
            <label class="col-xs-3 control-label">Placa(*):</label>
            <div class="col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('placa') . "</h5>"; ?>
                <input type="text" class="form-control" name="placa" placeholder="Placa" value=""></input>
            </div>
        </div>

        <!--<div class = "form-group">
            <label class = "col-xs-3 control-label">País Matriula</label>
            <div class = "col-xs-4">
                <select name="pais" id="pais" class="form-control">
                    <option value="">País</option>

                </select>
            </div>
        </div>-->

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Departamento Matricula(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('provincia') . "</h5>"; ?>
                <select name="provincia" id="provincia" class="form-control">
                    <option value="">Seleccionar:</option>
                    <?php
                    foreach ($paises as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_dpto ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad Matricula(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('localidad') . "</h5>"; ?>
                <select name="localidad" id="localidad" class="form-control">
                    <option value="">Selecciona tu departamento</option>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tipo de Vehiculo(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('tipo_vehiculo_id') . "</h5>"; ?>
                <select class="form-control" name="tipo_vehiculo_id">
                    <option value="">Selecciona</option>
                    <?php
                    foreach ($tipov as $val) {
                        ?>
                        <option value="<?php echo $val->id ?>"><?php echo $val->nombre_tv ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Carroceria(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('carroceria_id') . "</h5>"; ?>
                <select class = "form-control" name = "carroceria_id">
                    <option value="">Selecciona</option>
                    <?php
                    foreach ($carr as $val) {
                        ?>
                        <option value="<?php echo $val->id ?>"><?php echo $val->nombre_carr ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "trailer" placeholder = "Trailer" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "trailermarca" placeholder = "Trailer Marca" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "satelite" placeholder = "Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Usuario Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteusuario" placeholder = "Usuario Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Clave Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteclave" placeholder = "Clave Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Repotenciación</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "repotenciación" placeholder = "Repotenciación" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Modelo(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('modelo') . "</h5>"; ?>
                <input type = "text" class = "form-control" name = "modelo" placeholder = "Modelo" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('marca') . "</h5>"; ?>
                <select class = "form-control" name = "marca">
                    <option value="">Selecciona</option>
                    <?php
                    foreach ($marca as $val) {
                        ?>
                        <option value="<?php echo $val->id ?>"><?php echo $val->nombre ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Capacidad de carga(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('capacidad_carga') . "</h5>"; ?>
                <input type = "text" class = "form-control" name = "capacidad_carga" placeholder = "Capacidad de carga en Kgs" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento SOAT(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('vence_soat') . "</h5>"; ?>
                <input type = "text" readonly name = "vence_soat">
                <input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_soat, 'yyyy/mm/dd', this)">
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento TM(*):</label>
            <div class = "col-xs-4">
                <?php echo "<h5 style='color:red'>" . form_error('vence_rtecnomecanica') . "</h5>"; ?>
                <input type = "text" readonly name = "vence_rtecnomecanica">
                <input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_rtecnomecanica, 'yyyy/mm/dd', this)">
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Agregar"/>
            </div>
        </div>
    <?php echo form_close()?>

</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
