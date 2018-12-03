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
			<h1>Documentos Actuales <?= $vehiculo->placa; ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url() . 'admin/Vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"> Volver</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto SOAT debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<form id="frmSoat" action="javascript:updateSoat()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->soat ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			SOAT:<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_soat" value="Enviar"/>
		</div>
	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto de RTM debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmRtm" action="javascript:updateRtm()" enctype="multipart/form-data">

		<div align="center"><img id="foto_rtm" src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->rtecnomecanica ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			RTM(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_rtm" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Licencia de transito debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmLict" action="javascript:updateLict()" enctype="multipart/form-data">
		<div align="center"><img id="foto_lic" src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->licenciatransito ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Licencia de transito(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_lict" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>RUT propietario debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmRut" action="javascript:updateRut()" enctype="multipart/form-data">
		<div align="center"><img id="foto_lic" src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->rutpropietario ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			RUT propietario(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_rutp" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Cédula propietario debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmCedp" action="javascript:updateCedp()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->cedulapropietario ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Cédula propietario(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_cedp" value="Enviar"/>
		</div>

	</form>
	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto frontal debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<form id="frmFrontal" action="javascript:updateFrontal()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->foto_frontal ?>" alt="Sin foto"/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Foto Frontal(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_frontal" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1><small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto trasera debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<form id="frmTrasera" action="javascript:updateTrasera()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->foto_latizq ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Foto trasera(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_latizq" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto lateral debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmLateral" action="javascript:updateLateral()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->foto_latder ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Foto lateral derecha(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_latder" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">
				<li class="active"><i class="icon-file-alt"></i>Foto remolque debe tener formato .jpg .png o .gif de maximo 2MB</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmRemolque" action="javascript:updateRemolque()" enctype="multipart/form-data">
		<div align="center"><img src="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->remolque ?>" alt=""/></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			Foto remolque(*):<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_remolque" value="Enviar"/>
		</div>

	</form>

	<div class="row">
		<div class="col-lg-12">
			<h1> <small></small></h1>
			<ol class="breadcrumb">

				<li class="active"><i class="icon-file-alt"></i> Adjuntar Otros Documentos:</li>
			</ol>
		</div>
	</div><!-- /.row -->

	<div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

	<form id="frmPdf" action="javascript:updatePdf()" enctype="multipart/form-data">
		<div align="center"><a href="<?= base_url() ?>uploads/vehiculos/<?= $vehiculo->idVehiculo ?>/<?= $vehiculo->pdf ?>" target="_blank"><?= $vehiculo->pdf ?></a></div>
		<div align="center">
			<input type="hidden" name="idv" value="<?= $vehiculo->idVehiculo ?>"/>
			<input type="file"  name="userfile" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf">
			<input type="submit" name="update_pdf" value="Enviar"/>
		</div>
		<br>

	</form>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
