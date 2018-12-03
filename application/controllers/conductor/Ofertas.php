<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Ofertas extends CI_Controller {

	/**
	 * ark Admin Panel for Codeigniter
	 * Author: Jhon Jairo Valdés Aristizabal
	 * downloaded from http://devzone.co.in
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Conductores_model', 'Ofertas_model', 'Vehiculos_model', 'Mapa_model', 'Empresas_model'));
	}

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$this->load->view('conductor/vwOfertas', $data);
	}

	public function listado_ofertas() {
		setlocale(LC_MONETARY, 'es_CO');
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idusuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['message'] = 'Si desea cambiar su enturne estando contratado, debe primero cancelar su contrato y calificar a su empleador.';
		$body = "";
		$botones = "";
		$res = $this->Conductores_model->get_vehiculo_asignado_app($idusuario);
		$data['titulos'] = '<th>No. </th><th>Ofertante </th><th>Ori/Dest</th><th>Teléfonos</th>
                        <th>Cantidad</th><th>Fecha</th><th>Peso Kg</th><th>Dimensiones</th>
                        <th>Valor Flete</th><th>Manifiesto</th><th>Acciones</th>';
		if ($res) {
			$idVehiculo = $res->idVehiculo;
			$enturne = $this->Vehiculos_model->get_vehiculo_xenturne($idusuario);
			$contrato = $this->Ofertas_model->contratado($idVehiculo);
			if (isset($contrato) && $contrato !== FALSE) {
				$botones = "<td>" . "<button type='button' class='btn btn-success' disabled>Contratado</button>"
								. "<a href='" . base_url('conductor/Ofertas/calificar_contrato?idEmpresa=')
								. $contrato->idEmpresa . '&idV=' . $idVehiculo . '&idContrato=' . $contrato->idOfertaCarga
								. '&nombre=' . $contrato->nombre_empresa . '&trayecto=' . $contrato->origen .
								" / " . $contrato->destino . '&idConductor=' . $idusuario . "'><button type='button' class='btn btn-warning'>Cancelar Contrato</button></a>"
								. "</td>";
				$body = $body . "<tr><td>" . $contrato->idOfertaCarga . "</td><td>" .
								$contrato->nombre_empresa . "</td><td>" . $contrato->origen .
								" / " . $contrato->destino . "</td><td>" . $contrato->telefono .
								"  " . $contrato->fax . "</td><td>" . $contrato->cantidad .
								"</td><td>" . $contrato->fecha . "</td><td>" .
								number_format($contrato->peso, 0, '', '.') . ' Kg' . '</td><td>' .
								$contrato->dimensiones . '</td><td>' . money_format('%.0n', $contrato->vrflete) .
								"</td><td>" . $this->getManifiesto($contrato->idEmpresa, $contrato->contrato_id) . "</td>" . $botones;
			} else if ($enturne->enturne === '2') {
				$body = "<tr style='background-color:#C0C0C0'><td colspan='11'><h3 style='color:red'>Para ver ofertas de carga, debe cambiar su Enturne a disponible</h3></tr></td>";
			} else if ($enturne->enturne !== '2') {
				$ofertas = $this->Ofertas_model->get_ofertas_xorigen($idusuario);
				if ($ofertas) {
					foreach ($ofertas as $row) {
						$estadoap = $this->Ofertas_model->estados_aplicaciones_conductor($row->idOfertaCarga);
						if ($estadoap) {
							foreach ($estadoap as $key) {
								if ($key->contratado == 0 && $key->aplicando == 1 && $key->ocupado == 0) {
									$botones = "<td>" . "<label class='alert alert-danger'>Aplicando</label>" . "</td>";
								}
								if ($key->contratado == 1 && $key->aplicando == 1 && $key->ocupado == 0) {
									$botones = "<td>" . "<label class='alert alert-danger'>Usted en este momento esta siendo solicitado por ofertante <br>
 Contacto: $row->nombre $row->apellidos<br>
Trayecto: $row->origen - $row->destino<br><a href='" . base_url('conductor/Ofertas/aceptar_oferta_web') . "/" . $idVehiculo . "/" . $row->idOfertaCarga . "'><button type='button' class='btn btn-success'>Aceptar</button></a> <a href='" . base_url('conductor/Ofertas/rechazar_oferta_web') . "/" . $idVehiculo . "/" . $row->idOfertaCarga . "'><button type='button' class='btn btn-danger'>Rechazar</button></a></label>" . "</td>";
								}
								if ($key->contratado == 2 && $key->aplicando == 0 && $key->ocupado == 0) {
									$botones = "<td>" . "<label class='alert alert-danger'>Contrato finalizado</label>" . "</td>";
								}
								if ($key->contratado == 3 && $key->aplicando == 0 && $key->ocupado == 0) {
									$botones = "<td>" . "<label class='alert alert-danger'>Oferta rechazada <button type='button' class='btn btn-success' id='btnAplicar' onclick='aplicar(\"" . $row->id . "\",\"" . $idVehiculo . "\",\"" . $row->empresa_id . "\",\"" . $row->usuario_id . "\")'>Aplicar</button></label>" . "</td>";
								}
							}
						} else {
							$botones = "<td>" . "<button type='button' class='btn btn-success' id='btnAplicar' onclick='aplicar(\"" . $row->idOfertaCarga . "\",\"" . $idVehiculo . "\")'>Aplicar</button>" . "</td>";
						}
						$body = $body . "<tr><td>" . $row->idOfertaCarga . "</td><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $row->origen . " / " . $row->destino . "</td><td>" . $row->telefono . "  " . $row->celular . "</td><td>" . $row->cantidad . "</td><td>" . $row->fecha . "</td><td>" . number_format($row->peso, 0, '', '.') . '</td><td>' . $row->dimensiones . '</td><td>' . money_format('%.0n', $row->vrflete) . "</td><td>" . $botones . "</td>";
					}
				} else {
					$body = "<tr style='background-color:#C0C0C0'><td colspan='11'><h3 style='color:red'>En la ciudad de su Enturne no hay ofertas de carga</h3></tr></td>";
				}
			}
		} else {
			$body = "<tr style='background-color:#C0C0C0'><td colspan='11'><h3 style='color:red'>Usted aun no tiene vehiculo para recibir ofertas de carga</h3></tr></td>";
		}
		$data['body'] = $body . "</tr>";
		$this->load->view('conductor/vwListaOfertas', $data);
	}

	public function calificar_contrato() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['datos'] = array(
			'idEmpresa' => $this->input->get('idEmpresa'),
			'idVehiculo' => $this->input->get('idV'),
			'idContrato' => $this->input->get('idContrato'),
			'nombre' => $this->input->get('nombre'),
			'trayecto' => $this->input->get('trayecto'),
			'idConductor' => $this->input->get('idConductor')
		);
		$data['ranking'] = $this->Empresas_model->get_empxid($this->input->get('idEmpresa'));
		$this->load->view('conductor/vwCalificarEmpresa', $data);
	}

	public function enviar_calificacion($idEmpresa, $idVehiculo, $idOferta) {
		$calificacion = $this->input->post('calificacion');
		$obsv = $this->input->post('obsv');
		$this->Ofertas_model->cancelarContrato($idVehiculo, $idOferta, $idEmpresa, $calificacion, $obsv);
		redirect(base_url() . 'conductor/Ofertas');
	}

	public function getManifiesto($idEmpresa, $idContrato) {
		$res = $this->Ofertas_model->getManifiesto($idContrato);
		if ($res !== FALSE) {
			$manifiesto = $res->pdf;
			if ($manifiesto !== NULL) {
				return "<a href='" . base_url('uploads/empresas') . '/' . $idEmpresa .
								'/manifiestos/' . $idContrato . '/' . $manifiesto .
								"' title='Manifiesto' target='blank'>Manifiesto de carga</a>";
			} else {
				return '';
			}
		} else {
			return '';
		}
	}

	public function listado_ofertas_conductores() {
		setlocale(LC_MONETARY, 'es_CO');
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idusuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['message'] = 'Si desea cambiar su enturne estando contratado, debe primero cancelar su contrato y calificar a su empleador.';
		$body = '';
		$boton = '';
		$ofertas = $this->Ofertas_model->get_vehiculos_aplicando_x_propietario($idusuario);
		if (is_array($ofertas)) {
			foreach ($ofertas as $row) {
				if ($row->contratado === '0' && $row->aplicando === '1' && $row->ocupado === '0') {
					$boton = "<button type='button' class='btn btn-warning' disabled>Aplicando</button>";
				}
				if ($row->contratado === '1' && $row->aplicando === '1' && $row->ocupado === '0') {
					$boton = "<button type='button' class='btn btn-danger' disabled>Solicitado</button>";
				}
				if ($row->contratado === '2' && $row->aplicando === '0' && $row->ocupado === '1') {
					$boton = "<button type='button' class='btn btn-success' disabled>Contratado</button>";
				}
				if ($row->contratado === '3' && $row->aplicando === '0' && $row->ocupado === '0') {
					$boton = "<button type='button' class='btn btn-success' disabled>Rechazo Oferta</button>";
				}
				if ($row->pdf === NULL) {
					$pdf = '';
				} else {
					$pdf = 'Manifiesto Carga';
				}
				$body .= "<tr>"
								. "<td>" . $row->idContrato . "</td>"
								. "<td>" . $row->placa . "</td>"
								. "<td>" . $row->nombre_empresa . "</td>"
								. "<td>" . $row->origen . " / " . $row->destino . "</td>"
								. "<td>" . $row->telefono . "-" . $row->celular . "</td>"
								. "<td>" . $row->fecha . "</td>"
								. "<td>" . number_format($row->peso, 0, '   ', '.') . "</td>"
								. "<td>" . $row->dimensiones . "</td>"
								. "<td>" . number_format($row->vrflete, 0, '   ', '.') /* money_format(' %.0n ', $row->vrflete) */ . "</td>"
								. "<td>" . "<a href='" . base_url('uploads/empresas') . '/' . $row->idEmpresa . '/manifiestos/' . $row->idContrato . '/' . $row->pdf . "' title='PDF Manifiesto' target='blank'>" . $pdf . "</a>" . "</td>"
								. "<td>" . $boton . "</td>"
								. "</tr>";
			}
		} else {
			$body = "<tr><td colspan='5'><h3 style='color:red'>No tienes vehiculos aplicando en ofertas </h3><td><tr>";
		}
		$data['body'] = $body;
		$data['titulos'] = '<th>ID</th>
                            <th>Placa</th>
                            <th>Empresa </th>
                            <th>Ori/Dest</th>
                            <th>Teléfonos</th>
                            <th>Fecha</th>
                            <th>Peso Kg</th>
                            <th>Dimensiones</th>
                            <th>Valor Flete C/U</th>
                            <th>Manifiesto</th>
                            <th>Estado</th>';
		$this->load->view('conductor/vwListaOfertas', $data);
	}

	public function carga() {
		$idConductor = $this->input->get('idConductor');
		$ofertas = $this->Ofertas_model->get_ofertas_xorigen($idConductor);
		$data = array();
		if ($ofertas === FALSE) {
			$data["validacion"] = "error";
			$resultadosJson = json_encode($data);
		} else {
			$data["validacion"] = "ok";
			$data['cargas'] = $ofertas;
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function ofertas_aplicando() {
		$user = $this->input->get('usuario');
		$ofertas = $this->Ofertas_model->get_ofertas_aplicando($user);
		$data = array();
		if ($ofertas == false) {
			$data["validacion"] = "error";
			$resultadosJson = json_encode($data);
		} else {
			$data["validacion"] = "ok";
			$data['cargas'] = $this->Ofertas_model->get_ofertas_aplicando($user);
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function confirmar_oferta() {
		$idOferta = $this->input->get('idOferta');
		$idVehiculo = $this->input->get('idVehiculo');
		$ofertas = $this->Ofertas_model->confirmacion_aplicando($idOferta, $idVehiculo);
		$data = array();
		if ($ofertas == false) {
			$data["validacion"] = "error";
			$resultadosJson = json_encode($data);
		} else {
			$data["validacion"] = "ok";
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function oferta_app() {
		$id = $this->input->get('id');
		$data['oferta'] = $this->Ofertas_model->get_oferta_xid($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function aplicar_oferta() {

		$res = $this->Ofertas_model->aplicar_oferta();
		if ($res == false) {
			$data = 0;
			$resultadosJson = json_encode($data);
		} else {
			$data = 1;
			$resultadosJson = json_encode($data);
		}
		echo $resultadosJson;
	}

	public function aplicar_oferta_app() {
		$idCarga = $this->input->post('idOferta');
		$idVehiculo = $this->input->post('idVehiculo');
		$res = $this->Ofertas_model->aplicar_oferta_app($idCarga, $idVehiculo);
		if ($res === TRUE) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function enviarPosicion() {
		$idVehiculo = $this->input->post('idVehiculo');
		$Latitud = $this->input->post('Latitud');
		$Longitud = $this->input->post('Longitud');
		$this->Mapa_model->enviarPosicion($idVehiculo, $Latitud, $Longitud);
	}

	public function contratado() {
		$vehiculo = $this->input->get('vehiculo');
		$res = $this->Ofertas_model->contratado($vehiculo);
		if ($res == false) {
			$data["cod"] = 0;
			$resultadosJson = json_encode($data);
		} else {
			$data["cod"] = 1;
			$data["empresa"] = $res;
			$data["vehiculo"] = $this->Ofertas_model->get_contratado_xid_vehiculo($vehiculo);
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function solicitud_contrato() {
		$vehiculo = $this->input->get('vehiculo');
		$res = $this->Ofertas_model->solicitud_contrato($vehiculo);
		if ($res == false) {
			$data["cod"] = 0;
			$resultadosJson = json_encode($data);
		} else {
			$data["cod"] = 1;
			$data["empresa"] = $this->Ofertas_model->solicitud_contrato($vehiculo);
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function aceptar_oferta() {
		$id = $this->input->post('idv');
		$idCarga = $this->input->post('idcarga');
		$res = $this->Ofertas_model->aceptar_oferta($id, $idCarga);
		if ($res === true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function aceptar_oferta_web($id, $idCarga) {
		$res = $this->Ofertas_model->aceptar_oferta($id, $idCarga);
		if ($res === true) {
			redirect('conductor/Ofertas/listado_ofertas');
		} else {
			echo 'error';
		}
	}

	public function rechazar_oferta_web($id, $idCarga) {
		$res = $this->Ofertas_model->rechazar_oferta($id, $idCarga);
		if ($res === true) {
			redirect('conductor/Ofertas/listado_ofertas');
		} else {
			echo 'error';
		}
	}

	public function rechazar_oferta() {
		$id = $this->input->post('idv');
		$idCarga = $this->input->post('idcarga');
		$res = $this->Ofertas_model->rechazar_oferta($id, $idCarga);
		if ($res === true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function cancelarContrato() {
		$idVehiculo = $this->input->post('idVehiculo');
		$idOferta = $this->input->post('idOferta');
		$idEmpresa = $this->input->post('idEmpresa');
		$ranking = $this->input->post('ranking');
		$obsv = $this->input->post('obsv');
		$this->Ofertas_model->cancelarContrato($idVehiculo, $idOferta, $idEmpresa, $ranking, $obsv);
	}

	public function historial() {
		$id = $this->input->get('idVehiculo');
		$data['historial'] = $this->Ofertas_model->get_ofertas_xidvehiculo_app($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function historico() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idusuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$historico = $this->Ofertas_model->historico($idusuario);
		$body = '';
		if ($historico != false) {
			foreach ($historico as $row) {
				if ($row->calificacion_conductor === '0') {
					$ranking = '<i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i>';
				}
				if ($row->calificacion_conductor === '1') {
					$ranking = '<i class = "fa fa-star"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i>';
				}
				if ($row->calificacion_conductor === '2') {
					$ranking = '<i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i>';
				}
				if ($row->calificacion_conductor === '3') {
					$ranking = '<i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star-o"></i><i class = "fa fa-star-o"></i>';
				}
				if ($row->calificacion_conductor === '4') {
					$ranking = '<i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star-o"></i>';
				}
				if ($row->calificacion_conductor === '5') {
					$ranking = '<i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i><i class = "fa fa-star"></i>';
				}
				$body .= '<tr><td>' . $row->nombre_empresa . '</td>'
								. '<td>' . $row->placa . '</td>'
								. '<td>' . $row->origen . '-' . $row->destino . '</td>'
								. '<td>' . $row->fecha_contratado . '</td>'
								. '<td>' . $row->date_end . '</td>'
								. '<td>' . $row->nombre . ' ' . $row->apellidos . '</td>'
								. '<td>' . $row->celular . '</td>'
								. '<td>' . $row->nombre_tv . '</td>'
								. '<td>' . $row->dimensiones . '</td>'
								. '<td>' . money_format('%.0n', $row->vrflete) . '</td>'
								. '<td style = "color:#E7AE18">' . $ranking . '</td>'
								. '<td>' . $row->observaciones . '</td>'
								. '<td>' . '<a href = "' . base_url('empresa/perfil/generar_hv_conductor') . '/' . $idusuario . '" target = "_blank" title = "Hoja de vida"><i class = "fa fa-file-pdf-o fa-2x"></i></a>' . '</td></tr>';
			}
			$data['body'] = $body;
		} else {
			$data['body'] = "";
		}
		$this->load->view('conductor/vwHistorico', $data);
	}

	public function detalleHistorico() {
		$id = $this->input->get('idCarga');
		$data['carga'] = $this->Ofertas_model->get_oferta_xid($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function coords_oferta_app() {
		$id = $this->input->get('idOferta');
		$data['coords'] = $this->Ofertas_model->get_oferta_xid_app($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function mapa_ofertas() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['title'] = 'Mapa ofertas de carga';
		$data['botonMapa'] = '<a href = "#" onclick = "getLocationCarga()">Cargar mapa</a>';
		$this->load->view('conductor/vwMapaOfertas', $data);
	}

	public function get_mapa_ofertas() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idusuario = $session_data['id'];
		$arr['ofertas'] = $this->Ofertas_model->get_ofertas_xorigen($idusuario);
		;
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');
                            ';
	}

	public function solicitud_calificacion() {
		$idv = $this->input->get('idv');
		$data['carga'] = $this->Ofertas_model->solicitud_calificacion_empresa($idv);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');












                    ';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
