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
			<h1>Datos <small> Vehiculo</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url() . 'admin/Vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="fa fa-truck"></i> Datos Vehiculo</li>
			</ol>
		</div>
	</div><!-- /.row -->
	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
	<form id="frm_edit_vehiculo" method="post" action="javascript:updateVehiculo()" class="form-horizontal">
		<div class="form-group">

			<label class="col-xs-3 control-label">Placa(*):</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="placa" placeholder="Placa" value="<?= $vehiculo->placa; ?>" required>
			</div>
		</div>

		<input type="hidden" name="id" value="<?= $vehiculo->idVehiculo; ?>"/>

		<!--<div class = "form-group">
				<label class = "col-xs-3 control-label">País Matricula:</label>
				<div class = "col-xs-4">
						<select name="pais" id="pais" class="form-control">
								<option>Seleccione Pais solo si desea cambiar su actual ciudad de matricula::</option>
		<?php
		/* foreach ($paises as $row) {
		  ?>
		  <option value="<?= $row->id ?>"><?= $row->nombre_pais ?></option>
		  <?php
		  } */
		?>
						</select>
				</div>
		</div>-->

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Departamento Matricula(*):</label>
			<div class = "col-xs-4">
				<select name="provincia" id="provincia" class="form-control" required>
					<option>Seleccionar para cambiar de ciudad:</option>
					<?php foreach ($paises as $row) { ?>
						<option value="<?= $row->idDepartamento ?>"><?= $row->nombre_dpto ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Ciudad Matricula(*):</label>
			<div class = "col-xs-4">
				<select name="localidad" id="localidad" class="form-control" required>
					<option value="<?= $vehiculo->idCiudad ?>"><?= $vehiculo->nombre_ciudad ?></option>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Tipo de vehiculo(*):</label>
			<div class = "col-xs-4">
				<select name="tipo_vehiculo_id" id="tipov"  class="form-control" required>
					<?php
					foreach ($tipov as $fila) {
						$tipovid = $fila->idTipoVehiculo;
						if ($tipovid === $vehiculo->idTipoVehiculo) {
							?>
							<option value="<?= $tipovid ?>" selected = "selected"><?= $fila->nombre_tv ?></option>
						<?php } else { ?>
							<option value="<?= $tipovid ?>"><?= $fila->nombre_tv ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>


		<div class = "form-group">
			<label class = "col-xs-3 control-label">Carroceria:</label>
			<div class = "col-xs-4">
				<select name="carroceria_id"  class="form-control">
					<?php
					foreach ($carr as $fila) {
						$carrid = $fila->idCamionesCarroceria;
						if ($carrid === $vehiculo->idCamionesCarroceria) {
							?>
							<option value="<?= $carrid ?>" selected = "selected"><?= $fila->nombre_carr ?></option>
						<?php } else { ?>
							<option value="<?= $carrid ?>"><?= $fila->nombre_carr ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Satelite</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "satelite" value="<?php
				echo $vehiculo->satelite;
				?> " />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Usuario Satelite</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "sateliteusuario" value="<?php
				echo $vehiculo->sateliteusuario;
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Clave Satelite</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "sateliteclave" value="<?php
				echo $vehiculo->sateliteclave;
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Afiliado</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "afiliado" value="<?php
				echo $vehiculo->sateliteclave;
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Repotenciación</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "repotenciacion" value="<?php
				echo $vehiculo->repotenciacion;
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Modelo(*):</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "modelo" value="<?php
				echo $vehiculo->modelo;
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Marca(*):</label>
			<div class = "col-xs-4">
				<select name="marca"  class="form-control">
					<?php
					foreach ($marca as $fila) {
						$valmarca = $fila->idMarca;
						if ($valmarca === $vehiculo->idMarca) {
							?>
							<option value="<?= $valmarca ?>" selected = "selected"><?= $fila->nombre ?></option>
						<?php } else { ?>
							<option value="<?= $valmarca ?>"><?= $fila->nombre ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Peso Vacio(*):</label>
			<div class = "col-xs-4">
				<input type = "number" class = "form-control" name = "pesov" id="pesov" placeholder = "Peso Vacio" value="<?= $vehiculo->peso_vacio;
					?>" required>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Capacidad de carga(*):</label>
			<div class = "col-xs-4">
				<input type = "number" class = "form-control" name = "capacidad_carga" value="<?= $vehiculo->capacidad_carga;
					?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div><hr>
		<div id="trailer">
			<div class = "form-group">
				<h4><label class = "col-xs-3 control-label">TRAILER</label></h4>
			</div>

			<div class = "form-group">
				<label class = "col-xs-3 control-label">Placa:</label>
				<div class = "col-xs-4">
					<input type = "text" class = "form-control" name = "trailer" placeholder = "Placa Trailer" value="<?= $vehiculo->trailer;
					?>">
				</div>
			</div>

			<div class = "form-group">
				<label class = "col-xs-3 control-label">Marca:</label>
				<div class = "col-xs-4">
					<input type = "text" class = "form-control" name = "marcatrailer" id="marcatrailer" placeholder = "Marca Trailer" value = "<?= $vehiculo->trailermarca ?>">
				</div>
			</div>

			<div class = "form-group">
				<label class = "col-xs-3 control-label">Modelo:</label>
				<div class = "col-xs-4">
					<input type = "number" class = "form-control" name = "trailermodelo" placeholder = "Modelo Trailer" value = "<?= $vehiculo->modelo_trailer ?>">
				</div>
			</div>

			<div class = "form-group">
				<label class = "col-xs-3 control-label">Peso Vacio:</label>
				<div class = "col-xs-4">
					<input type = "number" class = "form-control" name = "pesovtrailer" placeholder = "Peso Vacio Trailer" value = "<?= $vehiculo->peso_vacio_trailer ?>">
				</div>
			</div><hr></div>
		<div class = "form-group">
			<h4><label class = "col-xs-3 control-label">SOAT</label></h4>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Numero:</label>
			<div class = "col-xs-4">
				<input type = "text" name = "num_soat" class="form-control"  value = "<?= $vehiculo->numsoat ?>" required>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Compañia:</label>
			<div class = "col-xs-4">
				<select class = "form-control" name = "compania" required>
					<?php
					foreach ($aseg as $val) {
						$valaseg = $val->idAseguradora;
						if ($valaseg === $vehiculo->idAseguradora) {
							?>
							<option value="<?= $valaseg ?>" selected = "selected"><?= $val->nombre_aseguradora ?></option>
						<?php } else { ?>
							<option value="<?= $valaseg ?>"><?= $val->nombre_aseguradora ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Fecha de vencimiento SOAT(*):</label>
			<div class = "col-xs-2">
				<input type = "text" class="form-control" value="<?php
				echo $vehiculo->vence_soat;
				?>"  name = "vence_soat" id="fechavensoat">
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Fecha de vencimiento TM(*):</label>
			<div class = "col-xs-2">
				<input type = "text" class="form-control" value="<?php
				echo $vehiculo->vence_rtecnomecanica;
				?>"  name = "vence_rtecnomecanica" id="fechavenrtecno">
			</div>
		</div>

		<!--		<div class = "form-group">
					<label class = "col-xs-3 control-label">Estado Licencia</label>
					<div class = "col-xs-4">
						<select class = "form-control" name = "activo">
							<option value="<?= $vehiculo->activo; ?>"><?php
		$res = $vehiculo->activo;
		if ($res == 0) {
			echo 'Inactivo';
		}
		if ($res == 1) {
			echo 'Activo';
		}
		if ($res == 2) {
			echo 'Pendiente de documentación';
		}
		if ($res == 3) {
			echo 'Pendiente pago de licencia';
		}
		if ($res == 4) {
			echo 'Vehiculo Bloqueado';
		}
		?> </option>
							<option value="1">Activar</option>
						</select>
					</div>
				</div>-->
		<div class = "form-group">
			<div class = "col-xs-9 col-xs-offset-3">
				<input type = "submit" class = "btn btn-primary" value = "Actualizar">
			</div>
		</div>
	</form>

	<div><?php $mensaje
		?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
