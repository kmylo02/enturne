<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vehiculos extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('Users_model', 'Vehiculos_model', 'Paises_model', 'Docs_model', 'Aseguradoras_model'));
	}

	function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$datos = $this->Vehiculos_model->get_all_vehiculos_activos();
		$body = "";
		$acciones = "";
		$arr["estado"] = "";
		if ($datos != false) {
			foreach ($datos as $value) {
				$res = $this->cargarEstado($value->activo);
				$arr["estado"] = $res;
				$btnAutorizar = "<button type='button' class='btn btn-primary' onclick='vehiculo_apto_licencia(" . $value->idVehiculo . ")'>Autorizado</button>";
				if ($res == "Activo") {
					$btnAutorizar = "";
				}
				$boton = $this->cargarBoton($value->activo, $value->idVehiculo);
				$conductor = $this->cargarConductor($value->conductor_id);
				$nivel = $this->cargarNivel($value->idNivel);
				$idVehiculo = $value->idVehiculo;
				$botonDocs = $this->verificarDocs($idVehiculo);
				$acciones = anchor(base_url() . 'admin/Vehiculos/get_vehiculo_xid/' . $value->idVehiculo, '<i class="fa fa-truck fa-2x"></i>', array('title' => 'Editar Vehiculo')) . "&nbsp" . anchor(base_url() . 'admin/Vehiculos/edit_docsvehiculoxid/' . $value->idVehiculo, '<i class="fa fa-folder-open-o fa-2x"></i>', array('title' => 'Documentos')) . "&nbsp" . '<a href="#" onclick="eliminarVehiculo(' . $value->idVehiculo . ')"><i class="fa fa-trash fa-2x"></i></a>' . "&nbsp" . $boton;
				$body .= "<tr><td>" . $res . "</td><td>" . $value->created_at . "</td><td>" . $value->usuario . " / " . $value->nombre . " " . $value->apellidos . "</td><td>" . $nivel . "</td><td><a href='" . base_url() . "admin/Vehiculos/GetCuentaVehiculo/" . $value->idVehiculo . "' class='cuentaVehiculo' data-vehiculo='" . $value->idVehiculo . "'>" . "<i class='fa fa-dollar fa-2x'></i>"/* $row->afiliado */ . "</td><td>" . $botonDocs . "</td><td>" . $conductor . "</td><td>" . $value->placa . "</td><td>" . $value->nombre_carr . "<br>" . $value->nombre_tv . "</td><td>" . $value->vence_soat . "</td><td>" . $value->vence_rtecnomecanica . "</td><td>" . $value->vence_rtecnomecanica . "</td><td>" . $acciones . "</td><td>N/A</td><td>" . $btnAutorizar . "</td></tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('admin/vwVehiculos', $arr);
	}

	function inactivos() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$datos = $this->Vehiculos_model->get_all_vehiculos_inactivos();
		$body = "";
		$acciones = "";
		if ($datos != false) {
			foreach ($datos as $value) {
				$res = $this->cargarEstado($value->activo);
				$arr["estado"] = $res;
				$boton = $this->cargarBoton($value->activo, $value->idVehiculo);
				$conductor = $this->cargarConductor($value->conductor_id);
				$nivel = $this->cargarNivel($value->idNivel);
				$idVehiculo = $value->idVehiculo;
				$botonDocs = $this->verificarDocs($idVehiculo);
				$acciones = anchor(base_url() . 'admin/Vehiculos/get_vehiculo_xid/' .
												$value->idVehiculo, '<i class="fa fa-truck fa-2x"></i>', array('title' => 'Editar Vehiculo')) . "&nbsp" . anchor(base_url() . 'admin/Vehiculos/edit_docsvehiculoxid/' . $value->idVehiculo, '<i class="fa fa-folder-open-o fa-2x"></i>', array('title' => 'Documentos')) . "&nbsp" . '<a href="#" onclick="eliminarVehiculo(' . $value->idVehiculo . ')"><i class="fa fa-trash fa-2x"></i></a>' . "&nbsp" . $boton;
				$body .= "<tr><td>" . $res . "</td><td>" . $value->created_at .
								"</td><td>" . $value->usuario . " / " . $value->nombre . " " .
								$value->apellidos . "</td><td>" . $nivel . "</td><td><a href='#'>" .
								"<i class='fa fa-dollar fa-2x'></i>"/* $row->afiliado */ . "</td><td>" .
								$botonDocs . "</td><td>" . $conductor . "</td><td>" . $value->placa . "</td><td>" .
								$value->nombre_carr . "<br>" . $value->nombre_tv . "</td><td>" . $value->vence_soat .
								"</td><td>" . $value->vence_rtecnomecanica . "</td><td>" .
								$value->vence_rtecnomecanica . "</td><td>" . $acciones .
								"</td><td>N/A</td><td><button type='button' class='btn btn-primary' onclick='vehiculo_apto_licencia(" . $value->idVehiculo . ")'>Autorizado</button></td></tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('admin/vwVehiculos', $arr);
	}

	function verificarDocs($id) {
		$boton = "<a href='" . base_url() .
						'admin/Docs/lista_pend_vehiculos_xid/' .
						$id . "' title='Sin Documentación'><i class='fa fa-folder fa-2x'></i></a>";
		$sinaprobar = $this->Docs_model->very_docs_x_aprobar_vehi_xid($id);
		$aprobados = $this->Docs_model->very_docs_aprobados_vehi_xid($id);
		$rechazados = $this->Docs_model->very_docs_rechazados_vehi_xid($id);
		if ($sinaprobar->num > 1) {
			$boton = "<a href='" . base_url() .
							'admin/Docs/lista_pend_vehiculos_xid/' .
							$id . "' title='Documentación pendiente por aprobar'><i class='fa fa-folder-open fa-2x'></i></a>";
		} else if ($aprobados->num > 9) {
			$boton = "<a href='" . base_url() .
							'admin/Docs/lista_pend_vehiculos_xid/' .
							$id . "' title='Sin Pendientes"
							. " documentos aprobados'><img src=" .
							base_url('assets/img/docsaprobados.png') .
							" alt='sin imagen'/></a>";
		} else if ($rechazados->num > 0) {
			$boton = "<a href='" . base_url() .
							'admin/Docs/lista_pend_vehiculos_xid/' .
							$id . "' title='Con documentos rechazados'><img src=" .
							base_url('assets/img/DocsRechazados.png') .
							" alt='sin imagen'/></a>";
		}
		return $boton;
	}

	function cargarEstado($estado) {
		if ($estado == 0) {
			$res = 'Inactivo';
		}
		if ($estado == 1) {
			$res = 'Activo';
		}
		if ($estado == 2) {
			$res = 'Pendiente Documentacion';
		}
		if ($estado == 3) {
			$res = 'Sin Licencia Enturne';
		}
		if ($estado == 4) {
			$res = 'Vehiculo Bloqueado';
		}
		if ($estado == 5) {
			$res = '';
		}
		return $res;
	}

	function cargarBoton($estado, $idVehiculo) {
		if ($estado == 0) {
			$boton = '';
		}
		if ($estado == 1) {
			$boton = '<a href="#"  onclick="bloquear_vehiculo(' . $idVehiculo . ')" title="Bloquear Vehiculo"><i class="fa fa-ban fa-2x"></i></a>';
		}
		if ($estado == 2) {
			$boton = '<a href="#"  onclick="bloquear_vehiculo(' . $idVehiculo . ')" title="Bloquear Vehiculo"><i class="fa fa-ban fa-2x"></i></a>';
		}
		if ($estado == 3) {
			$boton = '<a href="#"  onclick="bloquear_vehiculo(' . $idVehiculo . ')" title="Activar Vehiculo"><i class="fa fa-ban fa-2x"></i></a>';
		}
		if ($estado == 4) {
			$boton = '';
		}
		return $boton;
	}

	function cargarNivel($nivel) {
		if ($nivel == 1) {
			$nivel = 'Empresa';
		} else {
			$nivel = 'Transportista';
		}
		return $nivel;
	}

	function cargarConductor($id) {
		if ($id == null) {
			$conductor = "No Asignado";
		} else {
			$attr = array('title' => 'Conductor', 'target' => '_blank');
			$conductor = anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $id, '<i class="fa fa-user-secret fa-2x"></i>', $attr);
		}
		return $conductor;
	}

	function get_vehiculo_xid($idVehiculoehiculo) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$arr['mensaje'] = '';
		$arr['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xid($idVehiculoehiculo);
		$arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
		$arr['trailers'] = $this->Vehiculos_model->get_trailers();
		$arr['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
		$arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['aseg'] = $this->Aseguradoras_model->get_aseguradoras();
		$this->load->view('admin/vwFormEditVehiculo', $arr);
	}

	function get_vehiculo_xid_app() {
		$id = $this->input->get('idVehiculo');
		$resultados["vehiculo"] = $this->Vehiculos_model->get_vehiculo_xid($id);
		$resultadosJson = json_encode($resultados);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	function get_vehiculos_x_propietario($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$datos = $this->Vehiculos_model->get_vehiculos_x_propietario($id);
		$body = "";
		if ($datos) {
			foreach ($datos as $row) {
				$res = $this->cargarEstado($row->activo);
				$conductor = $this->cargarConductor($row->conductor_id);
				$body .= "<tr><td>" . $row->placa . "</td><td>" . $res . "</td><td>" . $row->carr . "<br>" . $row->nombre_tv . "</td><td>" . $row->vence_soat . "</td><td>" . $row->vence_rtecnomecanica . "</td><td>" . $row->created_at . "</td><td>" . $row->vencelic . "</td><td>" . $conductor . "</td></tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('admin/vwVehiculosPropietario', $arr);
	}

	function get_vehiculo_xidconductor($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$arr['mensaje'] = '';
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xidconductor($id);
		$this->load->view('admin/vwFormEditVehiculo', $arr);
	}

	function edit_docsvehiculoxid($idVehiculoehiculo) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$arr['mensaje'] = '';
		$arr['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xid($idVehiculoehiculo);
		$this->load->view('admin/vwFormEditDocsVehiculo', $arr);
	}

	function update_vehiculo() {
		$idVehiculo = $this->input->post('id');
		$data = array(
			'placa' => $this->input->post("placa", true),
			'idCiudad' => $this->input->post("localidad", true),
			'idTipoVehiculo' => $this->input->post("tipo_vehiculo_id", true),
			'idCamionesCarroceria' => $this->input->post("carroceria_id", true),
			'trailer' => $this->input->post('trailer'),
			'trailermarca' => $this->input->post('marcatrailer'),
			'modelo_trailer' => $this->input->post('trailermodelo'),
			'peso_vacio_trailer' => $this->input->post('pesovtrailer'),
			'satelite' => $this->input->post("satelite", true),
			'sateliteusuario' => $this->input->post("sateliteusuario", true),
			'sateliteclave' => $this->input->post("sateliteclave", true),
			'afiliado' => $this->input->post("afiliado", true),
			'repotenciacion' => $this->input->post("repotenciacion", true),
			'modelo' => $this->input->post("modelo", true),
			'idMarca' => $this->input->post("marca", true),
			'peso_vacio' => $this->input->post('pesov'),
			'capacidad_carga' => $this->input->post("capacidad_carga", true),
			'numsoat' => $this->input->post("num_soat", true),
			'idAseguradora' => $this->input->post("compania", true),
			'vence_soat' => $this->input->post("vence_soat", true),
			'vence_rtecnomecanica' => $this->input->post("vence_rtecnomecanica", true),
			'activo' => $this->input->post("activo", true),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$res = $this->Vehiculos_model->update_vehiculo_admin($idVehiculo, $data);
		if ($res === true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	function autorizar_vehiculo() {
		$idVehiculo = $this->input->post('idv');
		$datosUsuario = $this->Vehiculos_model->get_datos_propietario($idVehiculo);
		$res = $this->Vehiculos_model->activar_licencia($idVehiculo);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = true;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $datosUsuario->nombre . ' ' . $datosUsuario->apellidos
			);
			$this->email->to($datosUsuario->email);
			$this->email->cc('administrativo@enturne.co');
			$this->email->subject('Aviso de autorización usuario desde la App Enturne');
			$body = $this->load->view('emails_valida_usuario.php', $data, true);
			$this->email->message($body);
			$this->email->send();
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	function bloquear_vehiculo() {
		$idVehiculo = $this->input->post('idv');
		$res = $this->Vehiculos_model->bloquear_vehiculo($idVehiculo);
		if ($res == true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	function eliminar_vehiculo() {
		$idVehiculo = $this->input->post('idv');
		$res = $this->Vehiculos_model->delete_vehiculo_xid($idVehiculo);
		if ($res == true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	function subir_soat_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_soat($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_lict_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_lict($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_cedp_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_cedp($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_rtm_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_rtecno($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_rutp_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_rutp($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_frontal_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_frontal($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_lateral_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_lateral($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_trasera_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_trasera($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_remolque_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_foto_remolque($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	function subir_pdf_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->update_pdf($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function GetCuentaVehiculo($idVehiculo = "") {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr["vehiculo"] = $idVehiculo;
		$datos = $this->Vehiculos_model->getCuentasVehiculo($idVehiculo, $session_data['usuario'], "ADMIN");
		$body = "";
		$acciones = "";
		if ($datos != false) {
			foreach ($datos as $value) {
				$arr['placa'] = $value->placa;
				$TotalGratis = (int) $value->ViajesGratis + $value->ViajesReferidos;
				$TotalPromocion = (int) $TotalGratis * $value->tarifa_enturne;
				$PagosRecibidos = (int) $value->ViajesPendientes * $value->tarifa_enturne;
				$TotalAbonos = (int) $TotalPromocion + $PagosRecibidos;
				$ViajesRealizados = (int) $value->ViajesRealizados * $value->tarifa_enturne;
				$SaldoDisponible = (int) $TotalAbonos - $ViajesRealizados - $value->ValorPago;
				$color = ($SaldoDisponible >= 0) ? "green" : "red";

				$body .= "<tr>";
				($idVehiculo == "1") ? $body .= "<td style='display:none'>" . $value->idVehiculo . "</td><td>" . $value->placa . "</td>" : "";
				$body .= "<td>" . $value->ViajesGratis . "</td>";
				$body .= "<td>" . $value->ViajesReferidos . "</td>";
				$body .= "<td>" . $TotalGratis . "</td>";
				$body .= "<td>" . $value->tarifa_enturne . "</td>";
				$body .= "<td style='border-right: solid 1px #000'>" . $TotalPromocion . "</td>";
				$body .= "<td>" . $PagosRecibidos . "</td>";
				$body .= "<td>" . $TotalAbonos . "</td>";
				$body .= "<td>" . $ViajesRealizados . "</td>";
				$body .= "<td style='color:" . $color . "'>" . $SaldoDisponible . "</td>";
				$body .= "</tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('admin/vwCuentaVehiculo', $arr);
	}

	public function DetailAccountV($idVehiculo) {
		try {

			$jsondata['success'] = true;
			$jsondata["data"] = $this->Vehiculos_model->GetDetailAccount($idVehiculo);
		} catch (Exception $ex) {
			$jsondata['success'] = false;
			$jsondata['message'] = 'Erro, ' . $ex;
		}

		echo json_encode($jsondata);
	}

}
