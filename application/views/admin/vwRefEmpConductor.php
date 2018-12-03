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
			<h1>Referencias <small>Empresariales</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'admin/Conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos Empresa</li>
				<button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#form-refemp">Agregar Referencia Empresarial</button>
				<div style="clear: both;"></div>
				<h5 style="color:red">Recuerde que el conductor debe tener minimo 2 referencias empresariales, no activar hasta no ver completo este item.</h5>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
	<?php
	if (!$refEmp) {
		echo "<tr>";
		echo"<td>" . "<h4 style='color:red'>" . $mensaje . "</h4>" . "</td>";
		echo "</tr>";
	} else {
		?>

		<div class="table-responsive">
			<table class="table table-hover tablesorter">
				<thead>
					<tr style="background-color:#C0C0C0">
						<th class="header">Razón Social</th>
						<th class="header">NIT</th>
						<th class="header">Ciudad</th>
						<th class="header">Dirección</th>
						<th class="header">Telefono</th>
						<th class="header">Celular</th>
						<th class="header">Contacto</th>
						<th class="header">Tel. Contacto</th>
						<th class="header">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($refEmp as $row) {

						echo "<tr>";
						echo"<td>" . $row->razonsocial . "</td>";
						echo"<td>" . $row->nit . "</td>";
						echo"<td>" . $row->nombre_ciudad . "</td>";
						echo"<td>" . $row->direccion . "</td>";
						echo"<td>" . $row->telefono . "</td>";
						echo"<td>" . $row->celular . "</td>";
						echo"<td>" . $row->contacto . "</td>";
						echo"<td>" . $row->telcontacto . "</td>";
						echo"<td>" . anchor(base_url() . 'admin/Conductores/get_ref_empxid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar')) . "</td>";
						echo "</tr>";
					}
				}
				?>
				</form>
			</tbody>
		</table>
	</div>
</div><!-- /#page-wrapper -->
<!--Modal-->
<div class="modal fade" id="form-refemp" tabindex="-1" role="dialog" aria-labelledby="formRefEmp" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="myModalLabel">Añadir referencia empresarial</h5>
			</div>
			<div class="modal-body">
				<form method="post" action="javascript:addRefEmp()" id="frmRefemp" class="form-horizontal">
					<div class="form-group">
						<label class="col-xs-3 control-label">Razón Social(*):</label>
						<div class="col-xs-4">
							<input type="hidden" name="idUsuario" value="<?= $idUsusario ?>"/>
							<input type="text" class="form-control" name="razonsocial" placeholder="Razón Social" required>
						</div>
						<div class = "col-xs-4">
							<input type = "number" class = "form-control" name = "nit" placeholder = "NIT">
						</div>
					</div>
					<div>
						<ol class="breadcrumb">
							<li class="active"><i class="icon-file-alt"></i> Información Residencial</li>
							<div style="clear: both;"></div>
						</ol>
					</div>
					<div class = "form-group">
						<label class = "col-xs-3 control-label">Departamento(*):</label>
						<div class = "col-xs-4">
							<select name="provincia" id="provincia" class="form-control" required>
								<option value="">Dpto</option>
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
							<select name="localidad" id="localidad" class="form-control" required>
								<option value="">Selecciona tu departamento</option>
							</select>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Dirección</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "address" placeholder="Dirección">
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Teléfono 1(*):</label>
						<div class = "col-xs-4">
							<input type = "number" class = "form-control" name = "phone" placeholder="Teléfono" value="<?php echo set_value('phone'); ?>" onKeyPress="return validar(event)" maxlength="10" required>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Teléfono 2:</label>
						<div class = "col-xs-4">
							<input type = "number" class = "form-control" name = "celphone" placeholder="Celular" value="<?php echo set_value('celphone'); ?>" onKeyPress="return validar(event)" maxlength="10">
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Contacto(*):</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "contacto" placeholder="Contacto" required>
						</div>
					</div>

					<div class = "form-group">
						<label class = "col-xs-3 control-label">Tel. Contacto</label>
						<div class = "col-xs-4">
							<input type = "text" class = "form-control" name = "telcontacto" placeholder="Teléfono contacto" onKeyPress="return validar(event)" maxlength="10"/>
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
<?php
$this->load->view('admin/vwFooter');
?>
