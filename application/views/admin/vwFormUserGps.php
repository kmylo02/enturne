<?php
$this->load->view('admin/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Ver / Completar <small>Perfil</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Gps/get_users_gps' ?>"><i class="fa fa-level-up"></i></a></li>
                <li class="active"><i class="fa fa-user-secret"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

     <div style="width: 60%; margin: 0 auto;"><?php echo '<h3 style="color:red">' . $mensaje . '</h3>'; ?></div>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("admin/Gps/edit_user_gps", $attributes);
    ?>
    <div class="form-group">
        <label class="col-xs-3 control-label">Nombre Completo(*):</label>
        <div class="col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('firstName') . "</h5>"; ?>
            <input type="text" class="form-control" name="firstName"  value="<?php
            foreach ($conxid as $row) {
                echo $row->nombre;
            }
            ?>" ></input>
            <input type="hidden" name="id" value="<?php echo $row->id ?>"/>
        </div>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('lastName') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "lastName" value="<?php
            echo $row->apellidos;
            ?>" />
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
        <div class = "col-xs-3">
            <?php echo "<h5 style='color:red'>" . form_error('tipo_doc') . "</h5>"; ?>
            <select name="tipo_doc" class="form-control">
                <option value="<?php echo $row->tipo_doc ?>">Actual: <?php echo $row->tipo_doc ?></option>
                <option value="">Seleccione tipo de documento a continuación si desea cambiar:</option>
                <option value="1">CC</option>
                <option value="2">Pasaporte</option>
                <option value="3">Libreta Militar</option>
                <option value="4">NIT</option>
            </select>
        </div>
        <label class = "col-xs-1 control-label">No(*):</label>
        <div class = "col-xs-3">
            <?php echo "<h5 style='color:red'>" . form_error('cc') . "</h5>"; ?>
            <input type="text" class = "form-control" name = "cc" value="<?php
            echo $row->cedula;
            ?>" />
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Fecha de nacimiento(*):</label>
        <div class="col-xs-2">
            <?php echo "<h5 style='color:red'>" . form_error('theDate') . "</h5>"; ?>
            <input type="text" class="form-control" value="<?php
            echo $row->fecha_nac;
            ?>" name="theDate">
        </div>
        <div class="col-xs-0">
            <button type="button" onclick="displayCalendar(document.forms[0].theDate, 'yyyy/mm/dd', this)"><i class="fa fa-calendar"></i></button>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Estado Civil(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('est_civil') . "</h5>"; ?>
            <select class="form-control" name="est_civil" id="combito">
                <option value="<?php echo $row->estado_civil ?>">Actual: <?php echo $row->estado_civil ?></option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Unión Libre">Unión Libre</option>
                <option value="Separado">Separado</option>
                <option value="Viudo">Viudo</option>
            </select>
        </div>
    </div>

    <div id="div_Casado" class="subida">
        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre Conyuge(*):</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre_conyuge"  value="<?php
                echo $row->nombre_conyuge;
                ?>" placeholder="Nombres"/>
            </div>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "apellido_conyuge" value="<?php
                echo $row->apellido_conyuge;
                ?>" placeholder="Apellidos"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
            <div class = "col-xs-3">

                <select name="tipo_docc" class="form-control">
                    <option value="<?php echo $row->tipo_docc ?>">Actual: <?php echo $row->tipo_docc ?></option>
                    <option value="">Seleccione tipo de documento a continuación si desea cambiar:</option>
                    <option value="1">CC</option>
                    <option value="2">Pasaporte</option>
                    <option value="3">Libreta Militar</option>
                    <option value="4">NIT</option>
                </select>
            </div>
            <label class = "col-xs-1 control-label">No(*):</label>
            <div class = "col-xs-3">

                <input type="text" class = "form-control" name = "ccc" value="<?php
                echo $row->cedulac;
                ?>" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Telefono Conyuge(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "tel_conyuge" value="<?php
                echo $row->tel_conyuge;
                ?>" placeholder="Teléfono" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>
    </div>



    <div class = "form-group">
        <label class = "col-xs-3 control-label">Sexo(*):</label>
        <?php echo "<h5 style='color:red'>" . form_error('gender') . "</h5>"; ?>
        <div class = "col-xs-4">
            <div class = "radio">
                <label>
                    <input type = "radio" name = "gender" checked="" value = "<?php
                    echo $row->sexo;
                    ?>" /> Tu sexo actual es <b><?php echo $row->sexo ?></b> selecciona otro si deseas cambiar
                </label>
            </div>
            <div class = "radio">
                <label>
                    <input type = "radio" name = "gender" value = "Masculino" /> Masculino
                </label>
            </div>
            <div class = "radio">
                <label>
                    <input type = "radio" name = "gender" value = "Femenino" /> Femenino
                </label>
            </div>
            <div class = "radio">
                <label>
                    <input type = "radio" name = "gender" value = "Otro" /> Otro
                </label>
            </div>
        </div>
    </div>

    <div>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i></li>
            <li class="active"><i class="icon-file-alt"></i> Información Residencial</li>

            <div style="clear: both;"></div>
        </ol>
    </div>

    <!--<div class = "form-group">
        <label class = "col-xs-3 control-label">País(*):</label>
        <div class = "col-xs-4">
            <select name="pais" id="pais" class="form-control">
                <option value="<?php /* echo $row->pais ?>">Actual: <?php echo $row->nombre_pais ?> </option>

                             <?php
                             foreach ($paises as $fila) {
                             ?>
                             <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_pais ?></option>
                             <?php
                             } */
                    ?>
            </select>
        </div>
    </div>-->

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Departamento(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('provincia') . "</h5>"; ?>
            <select name="provincia" id="provincia" class="form-control">
                <option value="<?php echo $row->dpto ?>">Actual: <?php echo $row->nombre_dpto ?> </option>

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
        <label class = "col-xs-3 control-label">Ciudad(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('localidad') . "</h5>"; ?>
            <select name="localidad" id="localidad" class="form-control">
                <option value="<?php echo $row->ciudad ?>">Actual: <?php echo $row->nombre_ciudad ?></option>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Dirección(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('address') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "address" value="<?php
            echo $row->direccion;
            ?>" />
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Tipo de vivienda(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('tipo_vivienda') . "</h5>"; ?>
            <select class="form-control" name="tipo_vivienda">
                <option value="<?php echo $row->tipo_vivienda ?>">Actual: <?php echo $row->tipo_vivienda ?></option>
                <option value="Propia">Propia</option>
                <option value="Arrendada">Arrendada</option>
                <option value="Familiar">Familiar</option>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Tiempo en meses(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('meses_vivienda') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "meses_vivienda" value="<?php
            echo $row->meses_vivienda;
            ?>" onKeyPress="return validar(event)" maxlength="10"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Teléfono(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('phone') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "phone" value="<?php
            echo $row->telefono;
            ?>" onKeyPress="return validar(event)" maxlength="10"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Celular(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('celphone') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "celphone" value="<?php
            echo $row->celular;
            ?>" onKeyPress="return validar(event)" maxlength="10"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Email(*)</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('email') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "email" value="<?php
            echo $row->email;
            ?>" />
        </div>
    </div>

    <div>
        <ol class="breadcrumb">
            <li><i class="fa fa-photo"></i></li>
            <li class="active"><i class="icon-file-alt"></i> Licencia de conducción</li>
            <div style="clear: both;"></div>
        </ol>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Nº licencia de conducción(*)</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('licencia_conduccion') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "licencia_conduccion" value="<?php
            echo $row->licencia_conduccion;
            ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Categoria(*):</label>
        <?php echo "<h5 style='color:red'>" . form_error('categoria_lic') . "</h5>"; ?>
        <div class = "col-xs-4">
            <select class="form-control" name="categoria_lic">
                <option value="<?php echo $row->categoria_lic ?>">Actual: <?php echo $row->categoria_lic ?></option>
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
        <label class = "col-xs-3 control-label">Vence(*)</label>
        <div class="col-xs-2">
            <?php echo "<h5 style='color:red'>" . form_error('theDatev') . "</h5>"; ?>
            <input type="text" class="form-control" name="theDatev" value="<?php
            echo $row->fecha_ven_licencia;
            ?>" />
        </div>
        <div class="col-xs-0">
            <button type="button" onclick="displayCalendar(document.forms[0].theDatev, 'yyyy/mm/dd', this)"><i class="fa fa-calendar"></i></button>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "update_user" value = "Actualizar" />
        </div>
    </div>
<?php echo form_close() ?>
</div><!--/#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
