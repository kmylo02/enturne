
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
            <h1>Crear usuario 1 <small></small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-building"></i> Datos Registro</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="<?php echo base_url() . 'admin/Empresas/guardar_usuario_empresa' ?>" id="basicBootstrapForm" class="form-horizontal">

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

      <!--<div class = "form-group">
          <label class = "col-xs-3 control-label">País</label>
          <div class = "col-xs-4">
              <select name="pais" id="pais" class="form-control">
                  <option value="">País</option>
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
          <input type="hidden" name="id_emp" value="<?php
          $this->db->select_max('id');
          $consulta = $this->db->get('Empresas');
          if ($consulta->num_rows() > 0) {
              foreach ($consulta->result()as $row) {
                  $id_emp = $row->id;
                  echo $id_emp;
              }
          }
          ?>"/>
          <label class = "col-xs-3 control-label">Usuario(*):</label>
          <div class = "col-xs-4">
              <input type = "text" class = "form-control" name = "usuario" placeholder="Usuario"/>
          </div>
      </div>

      <div class = "form-group">
          <label class = "col-xs-3 control-label">Contraseña(*):</label>
          <div class = "col-xs-4">
              <input type = "password" class = "form-control" name = "password" placeholder="Contraseña"/>
          </div>
      </div>

      <div class = "form-group">
          <label class = "col-xs-3 control-label">Repita Contraseña(*):</label>
          <div class = "col-xs-4">
              <input type = "password" class = "form-control" name = "rpassword" placeholder="Repetir Contraseña"/>
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
                <input type = "submit" class = "btn btn-primary" name = "reg_usuario_emp" value="Guardar"/>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
