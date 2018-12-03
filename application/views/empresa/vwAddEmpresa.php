<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Perfil Empresa<small> </small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Perfil/get_empresa' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <!--<li class="active"><i class="icon-file-alt"></i> Datos 1</li>-->

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <?php
    $attributes = array("class" => "form-horizontal", "id" => "basicBootstrapForm");
    echo form_open("empresa/Perfil/guardar_empresa", $attributes);
    ?>
    <div class="form-group">
        <label class="col-xs-3 control-label">Razón Social(*):</label>
        <div class="col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('name') . "</h5>"; ?>
            <input type="text" class="form-control" name="name" placeholder="Nombre" value="<?php echo set_value('name'); ?>"></input>
            <input type="hidden" id="mens" value="<?php echo $mensaje?>"></input>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Siglas:</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" name="siglas" placeholder="Siglas" value="<?php echo set_value('siglas'); ?>"></input>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Nit(*):</label>
        <div class="col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('nit') . "</h5>"; ?>
            <input type="text" class="form-control" name="nit" placeholder="Nit" value="<?php echo set_value('nit'); ?>"></input>
        </div>
    </div>

    <div>
        <ol class="breadcrumb">
            <li class="active"><i class="icon-file-alt"></i> Datos De Contacto</li>

            <div style="clear: both;"></div>
        </ol>
    </div>

    <!--<div class = "form-group">
        <label class = "col-xs-3 control-label">País</label>
        <div class = "col-xs-4">
            <select name="pais" id="pais" class="form-control">
                <option>Seleccione pais:</option>

    <?php
    /* foreach ($paises as $fila) {
      ?>
      <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_pais ?></option>
      <?php
      } */
    ?>
            </select>
        </div>
    </div>-->

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Departamento</label>
        <div class = "col-xs-4">
            <select name="provincia" id="provincia" class="form-control">
                <option>Seleccione Dpto:</option>

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
        <label class = "col-xs-3 control-label">Ciudad</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('localidad') . "</h5>"; ?>
            <select name="localidad" id="localidad" class="form-control">
                <option>Selecciona tu departamento</option>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Dirección(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('direccion') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Teléfono(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('telefono') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "telefono" placeholder="telefono" onKeyPress="return validar(event)" maxlength="10" value="<?php echo set_value('telefono'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Fax:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "fax" placeholder="Fax" onKeyPress="return validar(event)" maxlength="10" value="<?php echo set_value('fax'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Celular:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "cel" placeholder="Celular" onKeyPress="return validar(event)" maxlength="10" value="<?php echo set_value('cel'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Email(*):</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('email') . "</h5>"; ?>
            <input type = "text" class = "form-control" name = "email" placeholder="Correo Electronico" value="<?php echo set_value('email'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Web:</label>
        <div class = "col-xs-4">
            <input type = "text" class = "form-control" name = "web" placeholder="Web" value="<?php echo set_value('web'); ?>"/>
        </div>
    </div>

    <div class = "form-group">
        <label class = "col-xs-3 control-label">Tipo de carga:</label>
        <div class = "col-xs-4">
            <?php echo "<h5 style='color:red'>" . form_error('tipo_carga') . "</h5>"; ?>
            <select name="tipo_carga" class="form-control">
                <option value="">Seleccione:</option>
                <option value="Paqueteo">Paqueteo</option>
                <option value="Carga Masiva">Carga Masiva</option>
                <option value="Paqueteo y Carga Masiva<">Paqueteo y Carga Masiva</option>
            </select>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-xs-9 col-xs-offset-3">
            <input type = "submit" class = "btn btn-primary" name = "reg_empresa" id="reg1" value = "Guardar"/>
            <a href="<?php echo base_url() . 'empresa/Perfil/adj_docs_empresa'?>"><input type = "button" class = "btn btn-primary" id="reg2" value = "Continuar"/></a>
        </div>
    </div>
    <?php echo form_close() ?>
</div><!--/#page-wrapper -->
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
      if($("#mens").val()===0){
        $("#reg2").hide();
        $("#reg1").click(function () {
            alert("Registro guardado");
            $("#reg2").show();
        });
      }
      if($("#mens").val()===1){
        $("#reg1").hide();
        $("#reg2").show();
      }
    });
</script>

<?php
$this->load->view('empresa/vwFooter');
?>
