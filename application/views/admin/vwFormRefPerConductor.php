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
			<h1>Editar Referencia <small>Personal</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'admin/Conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



	<form method="post" action="<?php echo base_url() . 'admin/Conductores/edit_ref_per' ?>" id="basicBootstrapForm" class="form-horizontal">

		<div class="form-group">
			<label class="col-xs-3 control-label">Nombre Completo</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="firstName" placeholder="Nombre" value="<?php
				foreach ($refPer as $row) {
					echo $row->nombre;
				}
				?> "></input>
			</div>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "lastName" placeholder = "Apellidos" value="<?php
				echo $row->apellido
				?> " />
			</div>
		</div>

		<input type="hidden" name="id" value="<?= $row->idReferenciaPersonal ?>"/>

		<div class = "form-group">
			<label class = "col-xs-3 control-label disabled">Tipo de documento</label>


			<div class = "col-xs-3">
				<select class="form-control" name="tipo_doc">
					<option value="<?= $row->tipo_documento ?> ">Actual <?= $row->tipo_documento ?> </option>
					<option value="1">CC</option>
					<option value="2">Pasaporte</option>
					<option value="3">Libreta Militar</option>
				</select>
			</div>


			<label class = "col-xs-1 control-label">No</label>
			<div class = "col-xs-3">
				<input type="text" class = "form-control" name = "cc" value="<?php
				echo $row->identificacion
				?> "/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Parentesco</label>
			<div class = "col-xs-5">
				<select class="form-control" name="parentesco">
					<option value="<?php
					echo $row->parentesco
					?> ">Actual <?php
										echo $row->parentesco
										?> </option>
					<option value="Hijo(a)">Hijo(a)</option>
					<option value="padre">padre</option>
					<option value="madre">madre</option>
					<option value="hermano(a)">hermano(a)</option>
					<option value="tio(a)">tio(a)</option>
					<option value="primo(a)">primo(a)</option>
					<option value="abuelo(a)">abuelo(a)</option>
					<option value="conyugue">conyugue</option>
					<option value="cuñado">cuñado</option>
					<option value="suegro(a)">suegro(a)</option>
					<option value="yerno">yerno</option>
					<option value="nuera">nuera</option>
				</select>
			</div>
		</div>

		<div>
			<ol class="breadcrumb">
				<li><a href=""><i class="icon-dashboard"></i> Información Residencial</a></li>
				<li class="active"><i class="icon-file-alt"></i> Información Residencial</li>

				<div style="clear: both;"></div>
			</ol>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Departamento</label>
			<div class = "col-xs-4">
				<select name="provincia" id="provincia" class="form-control">
					<option value="<?php
					echo $row->idDepartamento
					?> ">Actual: <?php
										echo $row->nombre_dpto
										?>  </option>
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

		<!--		<div class = "form-group">
					<label class = "col-xs-3 control-label">Departamento</label>
					<div class = "col-xs-4">
						<select name="provincia" id="provincia" class="form-control">
							<option value="<?php
		echo $row->idDepartamento
		?> ">Actual: <?php
		echo $row->nombre_dpto
		?> </option>
						</select>
					</div>
				</div>-->

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Ciudad</label>
			<div class = "col-xs-4">
				<select name="localidad" id="localidad" class="form-control">
					<option value="<?php
					echo $row->ciudad
					?> ">Actual: <?php
										echo $row->nombre_ciudad
										?> </option>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Dirección</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "address" value="<?php
				echo $row->direccion
				?> " />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Tipo de vivienda</label>
			<div class = "col-xs-4">
				<select name="vivienda"  class="form-control">
					<option value="<?php
					echo $row->casa
					?> ">Actual <?php
										echo $row->casa
										?> </option>
					<option value="Propia">Propia</option>
					<option value="Arrendada">Arrendada</option>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Tiempo en meses</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "meses_vivienda" value="<?php
				echo $row->tiemporesidencia
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Teléfono 1(*):</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "phone" value="<?php
				echo $row->telefono
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Teléfono 2:</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "celphone" value="<?php
				echo $row->celular
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>


		<div class = "form-group">
			<div class = "col-xs-9 col-xs-offset-3">
				<input type = "submit" class = "btn btn-primary" name = "update_refper" value = "Actualizar">
			</div>
		</div>
	</form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
