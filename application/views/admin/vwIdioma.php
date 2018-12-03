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
			<h1>Idiomas <small>Listado</small></h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url() . 'admin/Dashboard/config' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
				<li class="active"><i class="icon-file-alt"></i> Idioma</li>


				<button class="btn btn-primary" type="button" style="float:right;">Añadir Idioma</button>
				<div style="clear: both;"></div>
			</ol>
		</div>
	</div><!-- /.row -->



	<div class="table-responsive">
		<table class="table table-hover tablesorter">
			<thead>
				<tr style="background-color:#C0C0C0">
					<th class="header">No</th>
					<th class="header">Código <i class="fa fa-code"></i></th>
					<th class="header">Idioma</th>
					<th class="header">Fecha creación</th>
					<th class="header">Fecha acutalización</th>
					<th class="header">Detalle</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($datos as $row) {
					echo "<tr>";
					echo"<td>" . $row->id . "</td>";
					echo"<td>" . $row->codigo . "</td>";
					echo"<td>" . $row->idioma . "</td>";
					echo"<td>" . $row->created_at . "</td>";
					echo"<td>" . $row->updated_at . "</td>";
					echo"<td></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</div>

	<ul class="pagination pagination-sm">
		<li class="disabled"><a href="#"><<</a></li>
		<li class="active"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">>></a></li>
	</ul>


</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
