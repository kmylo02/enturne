<?php
$this->load->view('admin/vwHeader');
echo "<h4 style='color:red'>" . $aviso . "</h4>";
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

	<div class="row">
		<div class="col-lg-12">
			<h1>Empresa <small></small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'admin/Dashboard' ?>"><i class="fa fa-home fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Lista de Personal</li>
				<button class="btn btn-primary" type="button" style="float:right;" data-toggle="modal" data-target="#form-personal">Crear Personal</button>
				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<!--modal-->
	<div class="modal fade" id="form-personal" tabindex="-1" role="dialog" aria-labelledby="formPersonal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title" id="myModalLabel">Añadir Empleado</h5>
				</div>
				<div class="modal-body">
					<form method="post" action="javascript:addPersonal()" id="addPersonalForm" class="form-horizontal">
						<div class="form-group">
							<label class="col-xs-3 control-label">Nombre Completo(*):</label>
							<div class="col-xs-4">
								<input type="text" class="form-control" name="name"  placeholder="Nombre" value="<?php echo set_value('name'); ?>" required/>
							</div>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "sname" placeholder = "Apellidos" value="<?php echo set_value('sname'); ?>" required/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-xs-3 control-label">Tipo documento(*):</label>
							<div class="col-xs-4">
								<select name="tipo_doc" class="form-control">
									<option value="">Seleccione:</option>
									<option value="1">Cédula</option>
									<option value="2">Pasaporte</option>
									<option value="3">Libreta Militar</option>
								</select>
							</div>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "cedula" placeholder = "No de Cédula" <?php echo set_value('cedula'); ?>/>
								<input type="hidden" name="id_empresa" value="<?php
foreach ($empresa as $value) {
	echo $value->idEmpresa;
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
								<select id="provincia" name="provincia" class="form-control">
									<option value="">Selecciona:</option>
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
							<label class = "col-xs-3 control-label">Ciudad(*):</label>
							<div class = "col-xs-4">
								<select id="localidad" name="localidad" class="form-control">
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
								<input type = "text" class = "form-control" name = "email" placeholder="Correo electronico" value="<?php echo set_value('email'); ?>" required>
							</div>
						</div>
						<div class = "form-group">
							<label class = "col-xs-3 control-label">Teléfono(*):</label>
							<div class = "col-xs-4">
								<input type = "text" class = "form-control" name = "telefono" placeholder="telefono" onKeyPress="return validar(event)" maxlength="10" value="<?php echo set_value('telefono'); ?>" required>
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
								<input type = "text" class = "form-control" name = "username" placeholder="Usuario" <?php echo set_value('username'); ?> required>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Contraseña(*):</label>
							<div class = "col-xs-4">
								<input type = "password" class = "form-control" name = "password" placeholder="Contraseña" required>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Confirmar Contraseña(*):</label>
							<div class = "col-xs-4">
								<input type = "password" class = "form-control" name = "passconf" placeholder="Repita contraseña" required>
							</div>
						</div>

						<div class = "form-group">
							<label class = "col-xs-3 control-label">Permisos(*):</label>
							<div class = "col-xs-4">
								<input type = "hidden" name = "permisos" value="Ofertas"/>
								<input type = "text" class = "form-control" disabled="" value="Solo Ofertas">
							</div>
						</div>

						<div class = "form-group">
							<div class = "col-xs-9 col-xs-offset-3">
								<button type = "submit" class = "btn btn-primary" name = "reg_user" value = "Sign up">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--fin modal-->


	<div class="table-responsive">
		<table class="table table-hover tablesorter">
			<thead>
				<tr>
					<th class="header">Nombre <i class="fa fa-sort"></i></th>
					<th class="header">Identificación <i class="fa fa-sort"></i></th>
					<th class="header">Ciudad<i class="fa fa-sort"></i></th>
					<th class="header">Teléfono<i class="fa fa-sort"></i></th>
					<th class="header">Email<i class="fa fa-sort"></i></th>
					<th class="header">Usuario<i class="fa fa-sort"></i></th>
					<th class="header">Tipo<i class="fa fa-sort"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!$personal) {
					echo "<tr>";
					echo "<td>" . $mensaje . "</td>";
					echo "</tr>";
				} else {
					foreach ($personal as $row) {
						echo "<tr>";
						echo"<td>" . $row->nombre . " " . $row->apellidos . "</td>";
						echo"<td>" . $row->tipo_doc . " " . $row->cedula . "</td>";
						echo"<td>" . $row->nombre_ciudad . "</td>";
						echo"<td>" . $row->telefono . " " . $row->celular . "</td>";
						echo"<td>" . $row->email . "</td>";
						echo"<td>" . $row->usuario . "</td>";
						echo"<td>" . $row->permisos . "</td>";
						echo"<td>" . anchor(base_url() . 'admin/Perfil/get_perxid/' . $row->idemp, '<i class="fa fa-pencil fa-2x"></i>', array('title' => 'Ver/Editar')) . "</td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div>




</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
