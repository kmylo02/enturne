<?php
// Datos Vehiculo
$idv = $vehiculos->idVehiculo;
$idempresa = $vehiculos->idEmpresa;
$placa = $vehiculos->placa;
$capacidad = $vehiculos->capacidad_carga;
$modelo = $vehiculos->modelo;
$marcav = $vehiculos->marcav;
$tmarca = $vehiculos->trailermarca;
$trailer = $vehiculos->trailer;
$tmodelo = $vehiculos->modelo_trailer;
$tpesov = $vehiculos->peso_vacio_trailer;
$pesov = $vehiculos->peso_vacio;
$matricula = $vehiculos->nombre_ciudad;
$nomaseg = $vehiculos->nombre_aseguradora;
if ($idempresa != FALSE) {
	$sql = "select t1.*,t2.nombre_ciudad FROM Empresas t1 JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad WHERE t1.idEmpresa='$idempresa'";
	$query = $this->db->query($sql)->result();
	foreach ($query as $value) {
		$propietario = $value->nombre_empresa;
		$telprop = $value->telefono;
		$ciudadp = $value->nombre_ciudad;
		$dirempresa = $value->direccion;
		$nit = $value->nit;
	}
} else {
	$propietario = $vehiculos->nomprop . ' ' . $vehiculos->apeprop;
	$telprop = $vehiculos->celp;
	$ciudadp = $vehiculos->ciudadp;
	$nit = $vehiculos->cedp;
	$dirempresa = $vehiculos->dirp;
}
$numsoat = $vehiculos->numsoat;
$numtecno = $vehiculos->numtecno;
$vencesoat = $vehiculos->vence_soat;
$vencetecno = $vehiculos->vence_rtecnomecanica;
$frv = $vehiculos->created_at;
$urlsoat = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->soat;
$urlrtm = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->rtecnomecanica;
$urllict = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->licenciatransito;
$urlcedp = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->cedulapropietario;
$urlrutp = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->rutpropietario;
$urlremolque = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->remolque;
$urlfrontal = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->foto_frontal;
$urllateral = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->foto_latder;
$urltrasera = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->foto_latizq;
$docVehiculo = base_url('uploads/vehiculos') . '/' . $vehiculos->idVehiculo . '/' . $vehiculos->pdf;
// Conversion imagenes
$arrContextOptions = array(
	"ssl" => array(
		"verify_peer" => false,
		"verify_peer_name" => false,
	),
);
$type = pathinfo($urlsoat, PATHINFO_EXTENSION);
$soatData = file_get_contents($urlsoat, false, stream_context_create($arrContextOptions));
$soatBase64Data = base64_encode($soatData);
$fotosoat = 'data:image/' . $type . ';base64,' . $soatBase64Data;

$type1 = pathinfo($urlrtm, PATHINFO_EXTENSION);
$rtmData = file_get_contents($urlrtm, false, stream_context_create($arrContextOptions));
$rtmBase64Data = base64_encode($rtmData);
$fotortm = 'data:image/' . $type1 . ';base64,' . $rtmBase64Data;

$type2 = pathinfo($urlcedp, PATHINFO_EXTENSION);
$cedpData = file_get_contents($urlcedp, false, stream_context_create($arrContextOptions));
$cedpBase64Data = base64_encode($cedpData);
$fotocedp = 'data:image/' . $type2 . ';base64,' . $cedpBase64Data;

$type3 = pathinfo($urlrutp, PATHINFO_EXTENSION);
$rutpData = file_get_contents($urlrutp, false, stream_context_create($arrContextOptions));
$rutpBase64Data = base64_encode($rutpData);
$fotorutp = 'data:image/' . $type2 . ';base64,' . $rutpBase64Data;

$type4 = pathinfo($urlremolque, PATHINFO_EXTENSION);
$remolqueData = file_get_contents($urlremolque, false, stream_context_create($arrContextOptions));
$remolqueBase64Data = base64_encode($remolqueData);
$fotoremolque = 'data:image/' . $type2 . ';base64,' . $remolqueBase64Data;

$type5 = pathinfo($urllict, PATHINFO_EXTENSION);
$lictData = file_get_contents($urllict, false, stream_context_create($arrContextOptions));
$lictBase64Data = base64_encode($lictData);
$fotolict = 'data:image/' . $type2 . ';base64,' . $lictBase64Data;

$type9 = pathinfo($urlfrontal, PATHINFO_EXTENSION);
$frontalData = file_get_contents($urlfrontal, false, stream_context_create($arrContextOptions));
$frontalBase64Data = base64_encode($frontalData);
$frontal = 'data:image/' . $type2 . ';base64,' . $frontalBase64Data;

$type10 = pathinfo($urllateral, PATHINFO_EXTENSION);
$lateralData = file_get_contents($urllateral, false, stream_context_create($arrContextOptions));
$lateralBase64Data = base64_encode($lateralData);
$lateral = 'data:image/' . $type2 . ';base64,' . $lateralBase64Data;

$type11 = pathinfo($urltrasera, PATHINFO_EXTENSION);
$traseraData = file_get_contents($urltrasera, false, stream_context_create($arrContextOptions));
$traseraBase64Data = base64_encode($traseraData);
$trasera = 'data:image/' . $type2 . ';base64,' . $traseraBase64Data;
// Datos Conductor
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
$fecha_reg = $perfil->fecha_creacion;
$nombre_conyuge = $perfil->nombre_conyuge;
$apellido_conyuge = $perfil->apellido_conyuge;
$cedulac = $perfil->cedulac;
$celc = $perfil->tel_conyuge;
$urlfoto = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_ruta;
$urlfotoced = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_cedula;
$urlfotolic = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->foto_licencia;
$docUser = base_url('uploads') . '/' . $perfil->idUser . '/' . $perfil->pdf;
// Conversion fotos conductor
$type6 = pathinfo($urlfoto, PATHINFO_EXTENSION);
$fotoData = file_get_contents($urlfoto, false, stream_context_create($arrContextOptions));
$fotoBase64Data = base64_encode($fotoData);
$foto = 'data:image/' . $type . ';base64,' . $fotoBase64Data;

$type7 = pathinfo($urlfotoced, PATHINFO_EXTENSION);
$cedData = file_get_contents($urlfotoced, false, stream_context_create($arrContextOptions));
$cedBase64Data = base64_encode($cedData);
$fotoced = 'data:image/' . $type1 . ';base64,' . $cedBase64Data;

$type8 = pathinfo($urlfotolic, PATHINFO_EXTENSION);
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
			table {
				margin: 0 auto;
				font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
				font-size: 12px; margin-top: 25px; margin-bottom: 25px; width: 720px; text-align: left;
				border-collapse: collapse;
			}

			th {
				font-size: 13px;     font-weight: normal;     padding: 2px;     background: #BDBDBD; border: 1px solid #000000; color: #fff;
			}

			td {
				text-align: center; padding: 2px;     background: #fff;     border: 1px solid #000000;
				color: #000000;
			}
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
				color: #B1562A;
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
				validar su autenticidad y de realizar el uso adecuado.</h5><p class="page"></p></div>
		<h2>HOJA DE VIDA - VEHICULO</h2>
		<div class = "ext"><div class = "rectangulo"><?= $placa ?></div></div><br>
		<h3>INFORMACION DEL VEHICULO</h3>
		<br><br>
		<div style="text-align:center">
			<img src = "<?= $frontal ?>" width = "160" height = "190" alt="">&nbsp;&nbsp;
			<img src = "<?= $lateral ?>" width = "320" height = "190" alt="">&nbsp;&nbsp;
			<img src = "<?= $trasera ?>" width = "160" height = "190" alt="">
		</div>
		<table>
			<thead>
				<tr>
					<th>PLACA</th>
					<th>MARCA</th>
					<th>MODELO</th>
					<th>PESO VACIO</th>
					<th>CAPACIDAD</th>
					<th>MATRICULA</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $placa ?></td>
					<td><?= $marcav ?></td>
					<td><?= $modelo ?></td>
					<td><?= $pesov ?></td>
					<td><?= $capacidad ?></td>
					<td><?= $matricula ?></td>
				</tr>
				<?php if ($trailer == '') { ?>
				<?php } else { ?>
					<tr>
						<td><?= $trailer ?></td>
						<td><?= $tmarca ?></td>
						<td><?= $tmodelo ?></td>
						<td><?= $tpesov ?></td>
						<td style="border: 0"></td>
						<td style="border: 0"></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<th>DOCUMENTO</th>
					<th>VENCIMIENTO</th>
					<th>NUMERO</th>
					<th>ASEGURADORA</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>SOAT</td>
					<td><?= $vencesoat ?></td>
					<td><?= $numsoat ?></td>
					<td><?= $nomaseg ?></td>
				</tr>
				<tr>
					<td>REVISION TECNOMECANICA</td>
					<td><?= $vencetecno ?></td>
					<td style="border: 0"></td>
					<td style="border: 0"></td>
				</tr>
			</tbody>
		</table>
		<h3>INFORMACION DEL PROPIETARIO</h3>
		<table>
			<thead>
				<tr>
					<th>NOMBRE</th>
					<th>IDENTIFICACIÓN</th>
					<th>DIRECCIÓN</th>
					<th>CIUDAD</th>
					<th>TEL. 2</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $propietario ?></td>
					<td><?= $nit ?></td>
					<td><?= $dirempresa ?></td>
					<td><?= $ciudadp ?></td>
					<td><?= $telprop ?></td>
				</tr>
			</tbody>
		</table>
		<table><tr><td style="border: 0;
									 text-align: right"><i>Registro: <?= $frv ?></i></td></tr></table>
		<br><br><br>
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
				<td><?= $nombre . ' ' . $apellidos ?></td>
				<td><?= $cedula ?></td>
				<td><?= $direccion ?></td>
				<td><?= $ciudad ?></td>
				<td><?= $tel ?></td>
				<td><?= $cel ?></td>
			</tr>
			<?php if ($nombre_conyuge == "" && $apellido_conyuge == "") { ?>
			<?php } else { ?>
				<tr>
					<td>CONYUGE</td>
					<td><?= $nombre_conyuge . ' ' . $apellido_conyuge ?></td>
					<td><?= $cedulac ?></td>
					<td><?= $direccion ?></td>
					<td><?= $ciudad ?></td>
					<td><?= $celc ?></td>
					<td><?= $celc ?></td>
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
				<td><?= $lic ?></td>
				<td><?= $cat_lic ?></td>
				<td><?= $fv ?></td>
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
						<td> <?= $row->razonsocial ?></td>
						<td> <?= $row->contacto ?></td>
						<td> <?= $row->nit ?></td>
						<td> <?= $row->direccion ?></td>
						<td> <?= $row->nombre_ciudad ?></td>
						<td> <?= $row->telefono ?></td>
						<td> <?= $row->telcontacto ?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
	<br><br><br><br><br><br>
	<h2>DOCUMENTACIÓN</h2><br>
	<center><img class = "docs" src = "<?= $fotolict ?>" width = "454" height = "156" alt="sin imagen"></center><br>
	<br>
	<center><img class = "docs" src = "<?= $fotosoat ?>" width = "482" height = "153" alt="sin imagen"></center>
	<br>
	<center><img class = "docs" src = "<?= $fotortm ?>" width = "454" height = "156" alt="sin imagen"></center>
	<?php if ($trailer == '') { ?>
	<?php } else { ?>
		<br>
		<center><img class = "docs" src = "<?= $fotoremolque ?>" alt="Remolque"></center>
	<?php } ?>
	<br>
	<center><img class = "docs" src = "<?= $fotocedp ?>" width = "482" height = "153" alt="sin imagen"></center>
	<br>
	<center><img class = "docs" src = "<?= $fotolic ?>" width = "737" height = "567" alt="sin imagen"></center>
	<br>
	<center><img class = "docs" src = "<?= $fotorutp ?>" width = "737" height = "567" alt="sin imagen"></center>
	<br>
	<center><a href="<?= $docVehiculo ?>" target="_blank">Otros documentos del Vehiculo. (Para visualizarlos, dar clic derecho y seleccionar abrir enlace en una pestaña nueva)</a></center>
	<br>
	<center><a href="<?= $docUser ?>" target="_blank">Otros documentos del Conductor. (Para visualizarlos, dar clic derecho y seleccionar abrir enlace en una pestaña nueva)</a></center>
	<br>
	<h5>DECLARACION DE CONSENTIMIENTO
		Declaracion de los clientes que reciben asistencia ÚNICAMENTE para el ingreso de informacion en la solicitud en línea: He recibido ayuda del personal de Enturne En Línea SAS para ingresar la hoja de vida mía y de los datos del vehículo que conduzco. He proporcionado toda la informacion y respuestas requeridas en el formulario de Hoja de vida. He leído el formulario de solicitud una vez completo e impreso. Asimismo declaro que la informacion que he brindado es verdadera y que los documentos que presento para apoyar mi solicitud son genuinos y no han sido alterados de ninguna forma.
		POLÍTICA DE PRIVACIDAD Y DE PROTECCIÓN DE DATOS PERSONALES

		La presente política de privacidad y de proteccion de datos personales; regula la recoleccion, almacenamiento, tratamiento, administracion, transferencia, transmision y proteccion de aquella informacion que se reciba de terceros a través de los diferentes canales de recoleccion de informacion (en adelante los "Datos Personales") que Enturne En Líneas SAS. identificada con NIT 900.612.664-1, y domiciliada en la Cra 96G N° 19A -18 de la ciudad de Bogotá D.C., Colombia, Correo electronico: administrativo@enturne.co, Teléfono: 4968958-, a través de los servicios ofrecidos en www.enturne.co, ha dispuesto al público en general, de acuerdo con las disposiciones contenidas en la Ley Estatutaria 1581 de 2012, Decreto 1377 de 2013, y demás normas concordantes, por las cuales se dictan disposiciones generales para la proteccion de datos personales.
		ENTURNE, quien será el responsable del tratamiento de los Datos Personales, tal y como este término se define en la Ley 1581 de 2012, respeta la privacidad de cada uno de los terceros que le suministren sus Datos Personales a través de los diferentes puntos de recoleccion y captura de dicha informacion dispuestos para tal efecto. Enturne en Línea SAS recibe la mencionada informacion, la almacena de forma adecuada y segura, y usa, lo que no impide que los terceros puedan verificar la exactitud de la misma y ejercer sus derechos relativos a conocer, actualizar, rectificar y suprimir la informacion suministrada, así como su derecho a revocar la autoriza-cion suministrada a Enturne en Línea SAS para el tratamiento de sus Datos Personales. Los datos que Enturne en Línea SAS recolecta de terceros, se procesan y usa de conformidad con las regulaciones actuales de proteccion de informacion y privacidad, antes mencionadas.</h5>
	<table>
		<thead>
			<tr>
				<td height = "120px">FIRMA-CONDUCTOR</td>
				<td></td>
			</tr>
			<tr>
				<td height = "20px">NOMBRE-CC</td>
			</tr>
			<tr>
				<td>Fecha de Activación</td>
				<td><?= $fecha_act ?></td>
			</tr>
		</thead>
	</table>
	<table><tr><td style="border: 0; text-align: right"><i>Registro: <?= $fecha_reg ?></i></td></tr></table>
</body>
</html>
