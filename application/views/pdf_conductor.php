<?php
$nombre = $perfil->nombre;
$apellidos = $perfil->apellidos;
$cedula = $perfil->cedula;
$sexo = $perfil->sexo;
$estado = $perfil->estado_civil;
$num = $perfil->cedula;
$cat_lic = $perfil->categoria_lic;
$lic = $perfil->licencia_conduccion;
$fv = $perfil->fecha_ven_licencia;
$ciudad = $perfil->nombre_ciudad;
$direccion = $perfil->direccion;
$tel = $perfil->telefono;
$cel = $perfil->celular;
$mail = $perfil->email;
$fecha_nac = $perfil->fecha_nac;
$fecha_act = $perfil->fecha_activacion;
$nombre_conyuge = $perfil->nombre_conyuge;
$apellido_conyuge = $perfil->apellido_conyuge;
$cedulac = $perfil->cedulac;
$celc = $perfil->tel_conyuge;
$urlfoto = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_ruta;
$urlfotoced = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_cedula;
$urlfotolic = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_licencia;
$anexos = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->pdf;
$arrContextOptions = array(
	"ssl" => array(
		"verify_peer" => false,
		"verify_peer_name" => false,
	),
);
$type = pathinfo($urlfoto, PATHINFO_EXTENSION);
$fotoData = file_get_contents($urlfoto, false, stream_context_create($arrContextOptions));
$fotoBase64Data = base64_encode($fotoData);
$foto = 'data:image/' . $type . ';base64,' . $fotoBase64Data;

$type1 = pathinfo($urlfotoced, PATHINFO_EXTENSION);
$cedData = file_get_contents($urlfotoced, false, stream_context_create($arrContextOptions));
$cedBase64Data = base64_encode($cedData);
$fotoced = 'data:image/' . $type1 . ';base64,' . $cedBase64Data;

$type2 = pathinfo($urlfotolic, PATHINFO_EXTENSION);
$licData = file_get_contents($urlfotolic, false, stream_context_create($arrContextOptions));
$licBase64Data = base64_encode($licData);
$fotolic = 'data:image/' . $type2 . ';base64,' . $licBase64Data;
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Hoja de vida transportador</title>
		<style type = "text/css">
			table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
									font-size: 12px;    margin: 35px;     width: 720px; text-align: left;    border-collapse: collapse; }

			th {     font-size: 13px;     font-weight: normal;     padding: 2px;     background: #BDBDBD; border: 1px solid #000000; color: #fff; }

			td {   text-align: center; padding: 2px;     background: #fff;     border: 1px solid #000000;
						 color: #000000;}
			.footer {
				position: fixed;
				left: 0px;
				bottom: -180px;
				right: 0px;
				height: 220px;
				text-align: center
			}
			.footer .page:after {
				content: counter(page, upper-roman);
			}
			h2{
				color: #DFBE00;
				text-decoration: underline;
				text-align: center
			}
			h3 {
				color: #DFBE00;
				text-decoration: underline
			}
			h5 {
				color: #B4002A;
				text-align: center;
			}
			hr {color:#DFBE00;
					width: 100%
			}
			.ext {
				margin-left: auto;
				margin-right: auto;
				padding-top: 17px;
				width: 190px;
				height: 70px;
				background-color: #DFBE00;
				text-align: center;
				border-radius: 40%;
				border: 3px solid #CCC;
			}
			.rectangulo {
				margin: 0 auto;
				width: 160px;
				height: 50px;
				background-color: #DFBE00;
				text-align: center;
				color: white;
				border: 2px solid #CCC;
				font-size: 21;
			}
			.docs {
				max-width:100%;width:auto;height:auto
			}
		</style>
	</head>
	<body>
		<div class="footer"><hr><h5>Enturne En Línea SAS, No se hace responsable de la informacion contenida en esta hoja de vida, es deber del usuario que haga uso de ésta,
				validar su autenticidad y de realizar el uso adecuado.</h5></div>
		<h2>HOJA DE VIDA - CONDUCTOR</h2>
	<center><img src = "<?= $foto ?>" width = "120" height = "120"></center>
	<table>
		<thead>
			<tr>
				<th>TIPO</th>
				<th>NOMBRE</th>
				<th>IDENTIFICACIÓN</th>
				<th>DIRECCION</th>
				<th>CIUDAD</th>
				<th>TEL. 1</th>
				<th>TEL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>CONDUCTOR</td>
				<td> <?= $nombre . ' ' . $apellidos ?></td>
				<td> <?= $cedula ?></td>
				<td> <?= $direccion ?></td>
				<td> <?= $ciudad ?></td>
				<td> <?= $tel ?></td>
				<td> <?= $cel ?></td>
			</tr>
			<?php if ($nombre_conyuge == "" && $apellido_conyuge == "") { ?>
			<?php } else { ?>
				<tr>
					<td>CONYUGE</td>
					<td> <?= $nombre_conyuge . ' ' . $apellido_conyuge ?></td>
					<td> <?= $cedulac ?></td>
					<td> <?= $direccion ?></td>
					<td> <?= $ciudad ?></td>
					<td> <?= $celc ?></td>
					<td> <?= $celc ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				<th>LICENCIA DE CONDUCCION No.</th>
				<th>CATEGORIA</th>
				<th>VENCIMIENTO</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td> <?= $lic ?></td>
				<td> <?= $cat_lic ?></td>
				<td> <?= $fv ?></td>
			</tr>
		</tbody>
	</table>
	<h3>REFERENCIAS FAMILIARES</h3>
	<table>
		<thead>
			<tr>
				<th>NOMBRE</th>
				<th>VINCULO</th>
				<th>IDENTIFICACION</th>
				<th>DIRECCION</th>
				<th>CIUDAD</th>
				<th>TEL. 1</th>
				<th>TEL</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!$refPer) { ?>
				<tr>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
				</tr>
			<?php } else { ?>
				<?php foreach ($refPer as $row) { ?>
					<tr>
						<td> <?= $row->nombre . " " . $row->apellido ?></td>
						<td> <?= $row->parentesco ?></td>
						<td> <?= $row->identificacion ?></td>
						<td> <?= $row->direccion ?></td>
						<td> <?= $row->nombre_ciudad ?></td>
						<td> <?= $row->telefono ?></td>
						<td> <?= $row->celular ?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
	<h3>REFERENCIAS DE EMPRESA</h3>
	<table>
		<thead>
			<tr>
				<th>NOMBRE / RAZON SOCIAL</th>
				<th>CONTACTO</th>
				<th>IDENTIFICACION</th>
				<th>DIRECCION</th>
				<th>CIUDAD</th>
				<th>TEL. 1</th>
				<th>TEL</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!$refEmp) { ?>
				<tr>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
					<td> <?= 'No registra' ?></td>
				</tr>
			<?php } else { ?>
				<?php foreach ($refEmp as $row) { ?>
					<tr>
						<td><?= $row->razonsocial ?></td>
						<td><?= $row->contacto ?></td>
						<td><?= $row->nit ?></td>
						<td><?= $row->direccion ?></td>
						<td><?= $row->nombre_ciudad ?></td>
						<td><?= $row->telefono ?></td>
						<td><?= $row->telcontacto ?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table><br><br>
	<h2>DOCUMENTACIÓN</h2><br>
	<center><img class = "docs" src = "<?= $fotoced ?>" alt="sin imagen"></center>
	<br>
	<center><img class = "docs" src = "<?= $fotolic ?>" alt="sin imagen"></center>
	<br>
	<center><a href="<?= $anexos ?>" target="_blank">Otros documentos del conductor. (Para visualizarlos, dar clic derecho y seleccionar abrir enlace en una pestaña nueva)</a></center>
	<br>
	<h5>DECLARACION DE CONSENTIMIENTO
		Declaracion de los clientes que reciben asistencia ÚNICAMENTE para el ingreso de informacion en la solicitud en línea: He recibido ayuda del personal de Enturne En Línea SAS para ingresar la hoja de vida mía y de los datos del vehículo que conduzco. He proporcionado toda la informacion y respuestas requeridas en el formulario de Hoja de vida. He leído el formulario de solicitud una vez completo e impreso. Asimismo declaro que la informacion que he brindado es verdadera y que los documentos que presento para apoyar mi solicitud son genuinos y no han sido alterados de ninguna forma.
		POLÍTICA DE PRIVACIDAD Y DE PROTECCIÓN DE DATOS PERSONALES

		La presente política de privacidad y de proteccion de datos personales; regula la recoleccion, almacenamiento, tratamiento, administracion, transferencia, transmision y proteccion de aquella informacion que se reciba de terceros a través de los diferentes canales de recoleccion de informacion (en adelante los "Datos Personales") que Enturne En Líneas SAS. identificada con NIT 900.612.664-1, y domiciliada en la Cra 96G N° 19A -18 de la ciudad de Bogotá D.C., Colombia, Correo electronico: administrativo@enturne.co, Teléfono: 4968958-, a través de los servicios ofrecidos en www.enturne.co, ha dispuesto al público en general, de acuerdo con las disposiciones contenidas en la Ley Estatutaria 1581 de 2012, Decreto 1377 de 2013, y demás normas concordantes, por las cuales se dictan disposiciones generales para la proteccion de datos personales.
		ENTURNE, quien será el responsable del tratamiento de los Datos Personales, tal y como este término se define en la Ley 1581 de 2012, respeta la privacidad de cada uno de los terceros que le suministren sus Datos Personales a través de los diferentes puntos de recoleccion y captura de dicha informacion dispuestos para tal efecto. Enturne en Línea SAS recibe la mencionada informacion, la almacena de forma adecuada y segura, y usa, lo que no impide que los terceros puedan verificar la exactitud de la misma y ejercer sus derechos relativos a conocer, actualizar, rectificar y suprimir la informacion suministrada, así como su derecho a revocar la autoriza-cion suministrada a Enturne en Línea SAS para el tratamiento de sus Datos Personales. Los datos que Enturne en Línea SAS recolecta de terceros, se procesan y usa de conformidad con las regulaciones actuales de proteccion de informacion y privacidad, antes mencionadas.</h5>
	<br><br><br><br><br><br><br><br><br><br><br><table>
		<thead>
			<tr>
				<td height = "120px">FIRMA-CONDUCTOR</td>
				<td></td>
			</tr>
			<tr>
				<td height = "20px">NOMBRE-CC</td>
			</tr>
			<tr>
				<td>Fecha de Registro a Enturne En Linea</td>
				<td><?= $fecha_act ?></td>
			</tr>
		</thead>
	</table>
</body>
</html>
