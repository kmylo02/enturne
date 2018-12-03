<?php
$this->load->view('admin/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1>Referencias <small>Personales</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'admin/Conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
				<button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#form-refper">Agregar Referencia Personal</button>
				<div style="clear: both;"></div>
				<h5 style="color:red">Recuerde que el conductor debe tener minimo 2 referencias personales, no activar hasta no ver completo este item.</h5>
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
					<tr style="background-color:#C0C0C0">
						<th class = "header">No</th>
						<th class = "header">Nombre</th>
						<th class = "header">Documento</th>
						<th class = "header">Parentesco</th>
						<th class = "header">Ciudad</th>
						<th class = "header">Telefono</th>
						<th class = "header">Celular</th>
						<th class = "header">Dirección</th>
						<th class = "header">Vivienda</th>
						<th class = "header">Meses</th>
						<th class = "header">Acciones</th>
					</tr>
				</thead>
				<tbody><?php
					foreach ($refPer as $row) {

						echo "<tr>";
						echo"<td>" . $row->idUser . "</td>";
						echo"<td>" . $row->nombre . " " . $row->apellido . "</td>";
						echo"<td>" . $row->tipo_documento . " " . $row->identificacion . "</td>";
						echo"<td>" . $row->parentesco . "</td>";
						echo"<td>" . $row->nombre_ciudad . "</td>";
						echo"<td>" . $row->telefono . "</td>";
						echo"<td>" . $row->celular . "</td>";
						echo"<td>" . $row->direccion . "</td>";
						echo"<td>" . $row->casa . "</td>";
						echo"<td>" . $row->tiemporesidencia . "</td>";
						echo"<td>" . anchor(base_url() . 'admin/Conductores/get_ref_perxid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar')) . "</td>";
						echo "</tr>";
					}
				}
				?>
				</form>
			</tbody>
		</table>
	</div>
</div><!-- /#page-wrapper -->
<!--modal-->
<div class="modal fade" id="form-refper" tabindex="-1" role="dialog" aria-labelledby="formRefPer" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="javascript:addRefPer()" id="addRefPerForm" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Añadir Referencia Personal</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-xs-3 control-label">Nombre Completo</label>
						<div class="col-xs-4">
							<input type="hidden" name="id" value="<?= $idUser ?>"/>
							<input type="text" class="form-control" name="firstName" placeholder="Nombre"></input>
						</div>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "lastName" placeholder = "Apellidos"/>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label disabled">Tipo de documento</label>


						<div class = "col-xs-3">
							<select class="form-control" name="tipo_doc">
								<option value="1">CC</option>
								<option value="2">Pasaporte</option>
								<option value="3">Libreta Militar</option>
							</select>
						</div>


						<label class = "col-xs-1 control-label">No</label>
						<div class = "col-xs-3">
							<input type="text" class = "form-control" name = "cc"/>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Parentesco</label>
						<div class = "col-xs-5">
							<select class="form-control" name="parentesco">
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
								<?php foreach ($paises as $value) { ?>
									<option value="<?= $value->idDepartamento ?> "><?= $value->nombre_dpto ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Ciudad</label>
						<div class = "col-xs-4">
							<select name="localidad" id="localidad" class="form-control">
							</select>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Dirección</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "address"/>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Tipo de vivienda</label>
						<div class = "col-xs-4">
							<select name="vivienda"  class="form-control">
								<option>Seleccionar</option>
								<option value="Propia">Propia</option>
								<option value="Arrendada">Arrendada</option>
							</select>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Tiempo en meses</label>
						<div class = "col-xs-4">
							<input type = "number" class = "form-control" name = "meses_vivienda">
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Teléfono 1(*):</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "phone" onKeyPress="return validar(event)" maxlength="10"/>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Teléfono 2:</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "celphone" onKeyPress="return validar(event)" maxlength="10"/>
						</div>
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
<!-- modal -->

<?php
$this->load->view('admin/vwFooter');
?>
