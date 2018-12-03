<?php
$this->load->view('admin/vwHeader');
foreach ($edad as $value) {
	$valedad = $value->EDAD_ACTUAL;
}
?>

<div name="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1>Enturne <small>Administrador</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url() . 'admin/Users' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="fa fa-user"></i> Datos Personal</li>
				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->

	<div name="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>


	<div class="table-responsive">
		<table class="table table-hover tablesorter">
			<thead>
				<tr style="background-color:#C0C0C0">
					<th class="header">Nombre</th>
					<th class="header">Apellidos </th>
					<th class="header">Tipo de documento</th>
					<th class="header">Edad</th>
					<th class="header">Ciudad</th>
					<th class="header">Telefono</th>
					<th class="header">Email</th>
					<th class="header">Dirección</th>
					<th class="header">Celular</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($perfil->tipo == 0)
					$tipo = 'CC';
				if ($perfil->tipo == 1)
					$tipo = 'PP';
				if ($perfil->tipo == 2)
					$tipo = 'LM';
				echo "<tr>";
				echo"<td>" . $perfil->nombre . "</td>";
				echo"<td>" . $perfil->apellidos . "</td>";
				echo"<td>" . $tipo . " " . $perfil->cedula . "</td>";
				echo"<td>" . $valedad . "</td>";
				echo"<td>" . $perfil->nombre_ciudad . "</td>";
				echo"<td>" . $perfil->telefono . "</td>";
				echo"<td>" . $perfil->email . "</td>";
				echo"<td>" . $perfil->direccion . "</td>";
				echo"<td>" . $perfil->celular . "</td>";
				echo"<td>" . anchor(base_url() . 'admin/Perfil', '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Perfil')) . "</td>";
				echo "</tr>";
				?>
			</tbody>
		</table>

	</div>
	<form action="<?= base_url() . 'admin/Perfil/edit_foto_user' ?>" enctype="multipart/form-data" method="post">
		<div align="center"><img name="foto_perfil" src="<?= base_url() ?>uploads/<?= $perfil->foto_ruta ?>" /></div>
		<div align="center">
			<label>Seleccione examinar si desea cambiar su foto de perfil y click en actualizar</label>
			<input type="file"  name="userfile" accept="image/*">
			<input type="submit" name="update_foto" value="Actualizar"/>
		</div>
	</form>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
