<?php
$this->load->view('conductor/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1>Referencias <small>Personales</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'conductor/Perfil/completar_conductor' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
				<button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#form-refper">Añadir Referencia</button>
				<div style="clear: both;"></div>
				<?php
				if ($cont < 2) {
					echo "<h5 style='color:red'/>Debes añadir minimo dos referencias personales</h5>";
				}
				?>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<?php
	if (!$refPer) {
		echo "<tr>";
		echo"<td>" . "<h4 style='color:red'>" . $mensaje . "</h4>" . "</td>";
		echo "</tr>";
	} else {
		?>
		<div class = "table-responsive">
			<table class = "table table-hover tablesorter">
				<thead>
					<tr>
						<th class = "header">Nombre</th>
						<th class = "header">Documento</th>
						<th class = "header">Parentesco</th>
						<th class = "header">Ciudad</th>
						<th class = "header">Telefono</th>
						<th class = "header">Celular</th>
						<th class = "header">Dirección</th>
						<th class = "header">Vivienda</th>
						<th class = "header">Meses</th>
					</tr>
				</thead>
				<tbody><?php
					foreach ($refPer as $row) {
						if ($row->tipo_documento === '1') {
							$tipo = "CC";
						}
						if ($row->tipo_documento === '2') {
							$tipo = "Pasaporte";
						}
						if ($row->tipo_documento === '3') {
							$tipo = "LM";
						}
						if ($row->tipo_documento === '4') {
							$tipo = "NIT";
						}
						echo "<tr>";
						echo"<td>" . $row->nombre . " " . $row->apellido . "</td>";
						echo"<td>" . $tipo . " " . $row->identificacion . "</td>";
						echo"<td>" . $row->parentesco . "</td>";
						echo"<td>" . $row->nombre_ciudad . "</td>";
						echo"<td>" . $row->telefono . "</td>";
						echo"<td>" . $row->celular . "</td>";
						echo"<td>" . $row->direccion . "</td>";
						echo"<td>" . $row->casa . "</td>";
						echo"<td>" . $row->tiemporesidencia . "</td>";
						echo"<td>" . anchor(base_url() . 'conductor/Perfil/get_ref_perxid/' . $row->idReferenciaPersonal, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar')) . "</td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>
	<!--Modal-->
	<div class="modal fade" id="form-refper" tabindex="-1" role="dialog" aria-labelledby="formRefper" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="myModalLabel">Añadir referencia personal</h5>
				</div>
				<div class="modal-body">
					<form method="post" action="javascript:addRefPer()" id="frmRefper" class="form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 control-label">Nombre Completo(*):</label>
							<div class="col-xs-4">
								<?php echo "<h5 style='color:red'>" . form_error('firstName') . "</h5>"; ?>
								<input type="text" class="form-control" name="firstName" placeholder="Nombre" value="<?php echo set_value('firstName'); ?>"></input>
							</div>
							<div class = "col-xs-4">
								<?php echo "<h5 style='color:red'>" . form_error('lastName') . "</h5>"; ?>
								<input type = "text" class = "form-control" name = "lastName" placeholder = "Apellidos" value="<?php echo set_value('lastName'); ?>" />
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label disabled">Tipo de documento</label>
							<div class = "col-xs-3">
								<select class="form-control" name="tipo_doc">
									<option>Seleccione tipo de documento:</option>
									<option value="1">CC</option>
									<option value="2">Pasaporte</option>
									<option value="3">Libreta Militar</option>
                                                                        <option value="4">Cedula de extranjeria</option>
								</select>
							</div>


							<label class = "col-xs-1 control-label">No</label>
							<div class = "col-xs-3">
								<input type="text" class = "form-control" name = "cc" value="<?php echo set_value('cc'); ?>"/>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Parentesco(*):</label>
							<div class = "col-xs-3">
								<?php echo "<h5 style='color:red'>" . form_error('parentesco') . "</h5>"; ?>
								<select class="form-control" name="parentesco">
									<option value="">Seleccione:</option>
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
								<li class="active"><i class="icon-file-alt"></i> Información Residencial</li>

								<div style="clear: both;"></div>
							</ol>
						</div>
						<div class = "form-group">
							<label class = "col-xs-3 control-label">Departamento</label>
							<div class = "col-xs-4">
								<select name="provincia" id="provincia" class="form-control">
									<option>[SELECCIONE]</option>
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
							<label class = "col-xs-3 control-label">Ciudad</label>
							<div class = "col-xs-4">
								<select name="localidad" id="localidad" class="form-control">
									<option>[SELECCIONE]</option>
								</select>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Dirección</label>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "address" value="<?php echo set_value('address'); ?>"/>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Tipo de vivienda</label>
							<div class = "col-xs-4">
								<select name="vivienda"  class="form-control">
									<option value="">[SELECCIONE]</option>
									<option value="Propia">Propia</option>
									<option value="Arrendada">Arrendada</option>
									<option value="Familiar">Familiar</option>
								</select>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Tiempo en meses</label>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "meses_vivienda" value="<?php echo set_value('meses_vivienda'); ?>" onKeyPress="return validar(event)" maxlength="10"/>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Teléfono 1(*):</label>
							<div class = "col-xs-4">
								<?php echo "<h5 style='color:red'>" . form_error('phone') . "</h5>"; ?>
								<input type = "text" class = "form-control" name = "phone" value="<?php echo set_value('phone'); ?>" onKeyPress="return validar(event)" maxlength="10"/>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Teléfono 2</label>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "celphone" value="<?php echo set_value('celphone'); ?>" onKeyPress="return validar(event)" maxlength="10"/>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Guardar</button>
							<button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						</div>
					</form>
        </div>
			</div>
		</div>
	</div>
	<!--Cierra Modal-->
</div><!-- /#page-wrapper -->


<?php
$this->load->view('conductor/vwFooter');
?>
