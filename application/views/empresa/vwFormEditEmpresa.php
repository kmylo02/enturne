

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
				<li><a href="<?= base_url() . 'empresa/Perfil/ver_completar' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<!--<li class="active"><i class="icon-file-alt"></i> Datos 1</li>-->
			</ol>
		</div>
	</div><!-- /.row -->
	<form id="frmEditEmpresa" method="post" action="javascript:actEmpresa()" class="form-horizontal">
		<div class="form-group">
			<label class="col-xs-3 control-label">Razón Social(*):</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="name"  value="<?= $nombre_empresa ?>" disabled>
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Siglas:</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="siglas"  value="<?= $siglas ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-xs-3 control-label">Nit(*):</label>
			<div class="col-xs-4">
				<input type="text" class="form-control" name="nit"  value="<?= $nit ?>" disabled="" required>
			</div>
		</div>
		<div>
			<ol class="breadcrumb">
				<li><a href="<?= base_url() . 'empresa/Perfil/ver_completar' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li><i class="fa fa-user-secret"></i> Datos Usuario Administrador <li style="color: red">(Completar en mi perfil)</li></li>
			</ol>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Nombre Completo:</label>
			<div class = "col-xs-4">
				<input type="text" class="form-control" value="<?php if ($datosAdmin) echo $datosAdmin->nombre . ' ' . $datosAdmin->apellidos; ?>" disabled>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Documento:</label>
			<div class = "col-xs-4">
				<input type="text" class="form-control" value="<?php if ($datosAdmin) echo $datosAdmin->cedula; ?>" disabled>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Fecha de nacimiento:</label>
			<div class = "col-xs-4">
				<input type="text" class="form-control" value="<?php if ($datosAdmin) echo $datosAdmin->fecha_nac; ?>" disabled>
			</div>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Sexo:</label>
			<div class = "col-xs-4">
				<input type="text" class="form-control" value="<?php if ($datosAdmin) echo $datosAdmin->sexo; ?>" disabled>
			</div>
		</div>
		<div>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i> Datos De Contacto</li>

				<div style="clear: both;"></div>
			</ol>
		</div>
		<div class = "form-group">
			<label class = "col-xs-3 control-label">Departamento:</label>
			<div class = "col-xs-4">
				<select name="provincia" id="provincia" class="form-control" required>
					<?= $optdpto ?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Ciudad(*):</label>
			<div class = "col-xs-4">
				<select name="localidad" id="localidad" class="form-control" required>
					<?= $optciudad ?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Dirección(*):</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "direccion" value="<?= $direccion ?>" required>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Teléfono(*):</label>
			<div class = "col-xs-4">
				<input type = "number" class = "form-control" name = "telefono"  onKeyPress="return validar(event)" maxlength="10" value="<?= $telefono ?>" required>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Fax:</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "fax"  onKeyPress="return validar(event)" maxlength="10" value="<?= $fax ?>"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Celular:</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "cel"  onKeyPress="return validar(event)" maxlength="10" value="<?= $celular ?>"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Email(*):</label>
			<div class = "col-xs-4">
				<input type = "email" class = "form-control" name = "email"  value="<?= $email ?>" required>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Web:</label>
			<div class = "col-xs-4">
				<input type = "text" class = "form-control" name = "web"  value="<?= $web ?>"/>
			</div>
		</div>

		<div class = "form-group">
			<label class = "col-xs-3 control-label">Tipo de carga:</label>
			<div class = "col-xs-4">
				<select name="tipo_carga" class="form-control" required>
					<?= $optcarga ?>
				</select>
			</div>
		</div>

		<div class = "form-group">
			<div class = "col-xs-9 col-xs-offset-3">
				<input type = "submit" class = "btn btn-primary" name = "update_reg" value = "Actualizar"/>
			</div>
		</div>
	</form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
