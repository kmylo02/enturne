<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Empresa <small>Editar Personal</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'empresa/Perfil/get_personal' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<form method="post" action="<?php echo base_url() . 'empresa/Perfil/update_personal/' . $perxid->idUser ?>" id="basicBootstrapForm" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Nombre</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="nombre"  value="<?= $perxid->nombre; ?>" disabled=""/>
			</div>
			<label class="col-xs-1 control-label">Apellidos</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="apellidos"  value="<?= $perxid->apellidos; ?>" disabled=""/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Tipo documento</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="tipo_doc"  value="<?php
				if ($perxid->tipo_doc === '1') {
					echo 'CC';
				}if ($perxid->tipo_doc === '2') {
					echo 'Pasaporte';
				}if ($perxid->tipo_doc === '3') {
					echo 'Libreta Militar';
				}
				?>" disabled=""/>
			</div>
			<label class="col-xs-1 control-label">No</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="cedula"  value="<?php echo $perxid->cedula ?>" disabled=""/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Fecha de nacimiento</label>
			<div class="col-xs-3">
				<input type="date" class="form-control" name="fecha_nac"  value="<?php echo $perxid->fecha_nac ?>" disabled=""/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Estado civil</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="estado_civil"  value="<?php echo $perxid->estado_civil ?>"disabled=""/>
			</div>
			<label class="col-xs-1 control-label">Sexo</label>
			<div class="col-xs-3">
				<input type="text" class="form-control" name="sexo"  value="<?php echo $perxid->sexo ?>" disabled=""/>
			</div>
		</div>
		<!--<div class = "form-group">
				<label class = "col-xs-3 control-label">País Matriula</label>
				<div class = "col-xs-4">
						<select name="pais" id="pais" class="form-control">
								<option value="">País</option>
		<?php
		foreach ($paises as $fila) {
			?>
																												<option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_pais ?></option>
			<?php
		}
		?>
						</select>
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Departamento Matricula</label>
				<div class = "col-xs-4">
						<select name="provincia" id="provincia" class="form-control">
								<option value="">Selecciona tu pais</option>
						</select>
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Ciudad Matricula</label>
				<div class = "col-xs-4">
						<select name="localidad" id="localidad" class="form-control">
								<option value="">Selecciona tu departamento</option>
						</select>
				</div>
		</div>

		-->

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Ciudad</label>
			<div class = "col-xs-3">
				<input type = "text" class = "form-control" name = "ciudad" value="<?php echo $perxid->nombre_ciudad ?>" disabled=""/>
			</div>
			<label class = "col-xs-1 control-label">Dirección</label>
			<div class = "col-xs-3">
				<input type = "text" class = "form-control" name = "direccion" value="<?php echo $perxid->direccion ?>" disabled="" />
			</div>

		</div>


		<div class = "form-group">
			<label class = "col-xs-3 control-label">Teléfono</label>
			<div class = "col-xs-3">
				<input type = "text" class = "form-control" name = "telefono" value="<?php echo $perxid->telefono ?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
			<label class = "col-xs-1 control-label">Email</label>
			<div class = "col-xs-3">
				<input type = "text" class = "form-control" name = "email" value="<?php echo $perxid->email ?>" />
			</div>
		</div>


		<!--<div class = "form-group">
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
				<label class = "col-xs-3 control-label">Modelo</label>
				<div class = "col-xs-4">
						<input type = "text" class = "form-control" name = "modelo" placeholder = "Modelo" />
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Marca</label>
				<div class = "col-xs-4">
						<select class = "form-control" name = "marca">
								<option value="">Selecciona</option>
		<?php
		/* foreach ($marca as $val) {
		  ?>
		  <option value="<?php echo $val->nombre ?>"><?php echo $val->nombre ?></option>
		  <?php
		  } */
		?>
						</select>
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Capacidad de carga</label>
				<div class = "col-xs-4">
						<input type = "text" class = "form-control" name = "capacidad_carga" placeholder = "Capacidad de carga" />
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Fecha de vencimiento SOAT</label>
				<div class = "col-xs-4">
						<input type = "text" readonly name = "vence_soat">
						<input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_soat, 'yyyy/mm/dd', this)">
				</div>
		</div>

		<div class = "form-group">
				<label class = "col-xs-3 control-label">Fecha de vencimiento TM</label>
				<div class = "col-xs-4">
						<input type = "text" readonly name = "vence_rtecnomecanica">
						<input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_rtecnomecanica, 'yyyy/mm/dd', this)">
				</div>
		</div>-->



		<div class = "form-group">
			<div class = "col-xs-9 col-xs-offset-3">
				<button type = "submit" class = "btn btn-primary" name = "update_reg" >Actualizar</button>
			</div>
		</div>
	</form>

	<div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
