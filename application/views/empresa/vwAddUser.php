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
            <h1>1<small>  Crear personal</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Perfil/get_personal' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <?php echo '<h5 style="color:red">' . $mensaje . '</h5>' ?>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("empresa/Perfil/guardar_personal", $attributes);
    ?>
    <input type="hidden" name="code" value="<?php echo $code = rand(1000, 99999) ?>"/>
    <div class="form-group">
        <label class="col-xs-3 control-label">Nombre Completo(*):</label>
        <div class="col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('name') . "</h5>"; ?>
            <input type="text" class="form-control" name="name" placeholder="Nombre" value="<?php echo set_value('name'); ?>"></input>
        </div>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('sname') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "sname" placeholder = "Apellidos" value="<?php echo set_value('sname'); ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Tipo documento(*):</label>
        <div class="col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('tipo_doc') . "</h5>"; ?>
            <select name="tipo_doc" class="form-control">
                <option value="">Seleccione:</option>
                <option value="1">Cédula</option>
                <option value="2">Pasaporte</option>
                <option value="3">Libreta Militar</option>
            </select>
        </div>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('cedula') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "cedula" placeholder = "No de Cédula" <?php echo set_value('cedula'); ?>/>
            <input type="hidden" name="id_empresa" value="<?php
            foreach ($empresa as $value) {
                echo $value->id;
            }
            ?>"/>
        </div>
    </div>

    <div>
        <ol class="breadcrumb">
            <li><a href=""><i class="icon-dashboard"></i> Datos De Contacto</a></li>
            <li class="active"><i class="icon-file-alt"></i> Datos De Contacto</li>

            <div style="clear: both;"></div>
        </ol>
    </div>
    <div class = "form-group">
        <label class = "col-xs-3 control-label">Departamento(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('provincia') . "</h5>"; ?>
            <select name="provincia" id="provincia" class="form-control">
                <option value="">Selecciona:</option>
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
                <option value="">Selecciona tu departamento</option>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Dirección:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "direccion" placeholder = "Dirección" value="<?php echo set_value('direccion'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Email(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('email') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "email" placeholder="Correo electronico" value="<?php echo set_value('email'); ?>"/>
        </div>
    </div>
    <div class = "form-group">
        <label class = "col-xs-3 control-label">Teléfono(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('telefono') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "telefono" placeholder="telefono" onKeyPress="return validar(event)" maxlength="10" value="<?php echo set_value('telefono'); ?>"/>
        </div>
    </div>

    <div>
        <ol class="breadcrumb">
            <li><a href=""><i class="icon-dashboard"></i> Crear Usuario</a></li>
            <li class="active"><i class="icon-file-alt"></i> Datos Usuario</li>
            <div style="clear: both;"></div>
        </ol>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Tipo de usuario:</label>
        <div class = "col-xs-4">
            <input type = "hidden" name = "nivel" value="1"/>
            <input type = "text" class = "form-control" disabled="" value="1"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Nombre de Usuario(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('username') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "username" placeholder="Usuario" <?php echo set_value('username'); ?>/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Contraseña(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('password') . "</h5>"; ?>
            <input type = "password" class = "form-control" name = "password" placeholder="Contraseña"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Confirmar Contraseña(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('passconf') . "</h5>"; ?>
            <input type = "password" class = "form-control" name = "passconf" placeholder="Repita contraseña"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Permisos(*):</label>
            <div class = "col-xs-4">
                <input type = "hidden" name = "permisos" value="Ofertas"/>
                <input type = "text" class = "form-control" disabled="" value="Solo Ofertas"/>
            </div>
    </div>

    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "reg_user" value = "Guardar"/>
        </div>
    </div>
    <?php echo form_close() ?>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
