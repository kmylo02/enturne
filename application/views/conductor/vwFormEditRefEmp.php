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
			<h1>Editar Referencia <small>1rial</small></h1>
			<a href="vwFormEditRefEmp.php"></a>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'conductor/Perfil/get_ref_emp' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Datos 1</li>

				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



	<form method="post" action="<?php echo base_url() . 'conductor/Perfil/edit_ref_emp' ?>" id="basicBootstrapForm" class="form-horizontal">

		<div class="form-group">
			<label class="col-xs-3 control-label">Razón Social</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="razonsocial" placeholder="Razón Social" value="<?php
				foreach ($ref as $row) {
					echo $row->razonsocial;
				}
				?> "></input>
			</div>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "nit" placeholder = "NIT" value="<?php
				echo $row->nit
				?> " />
			</div>
		</div>

		<input type="hidden" name="id" value="<?= $row->idReferenciaEmpresarial ?>"/>
		<div>
			<ol class="breadcrumb">
				<li><a href=""><i class="icon-dashboard"></i> Información Residencial</a></li>
				<li class="active"><i class="icon-file-alt"></i> Información Residencial</li>

				<div style="clear: both;"></div>
			</ol>
		</div>

		<!--<div class = "form-group">
				<label class = "col-xs-3 control-label">País</label>
				<div class = "col-xs-4">
						<select name="pais" id="pais" class="form-control">
								<option value="<?php
		/* echo $row->pais
		  ?> ">Seleccione solo si desea cambiar</option>
		  <?php
		  foreach ($paises as $fila) {
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
					<option value="<?php
					echo $row->dpto
					?> ">Seleccione solo si desea cambiar</option>
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
					<option value="<?php
					echo $row->ciudad
					?> ">Selecciona tu departamento</option>
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
			<label class = "col-xs-3 control-label">Teléfono</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "phone" value="<?php
				echo $row->telefono
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Celular</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "celphone" value="<?php
				echo $row->celular
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Contacto</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "contacto" value="<?php
				echo $row->contacto
				?>" />
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Tel. Contacto</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "telcontacto" value="<?php
				echo $row->telcontacto
				?>" onKeyPress="return validar(event)" maxlength="10"/>
			</div>
		</div>

		<div class = "form-group">
			<div class = "col-xs-9 col-xs-offset-3">
				<button type = "submit" class = "btn btn-primary" name = "update_reg" value = "Sign up">Actualizar</button>
			</div>
		</div>
	</form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('conductor/vwFooter');
?>
