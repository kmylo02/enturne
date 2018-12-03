<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Mensajes extends CI_Controller {

	/**
	 * ark Admin Panel for Codeigniter
	 * Author: Jhon Jairo Valdés Aristizabal
	 * downloaded from http://devzone.co.in
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Reportes_model', 'Productos_model', 'Empresas_model', 'Vehiculos_model', 'Alertas_model'));
	}

	public function index() {

	}

	public function get_reportes_app() {
		$idUsuario = $this->input->get('idUsuario');
		$resp = $this->Reportes_model->get_reportes_app($idUsuario);
		$cont = count($resp);
		if ($resp == false) {
			$data['cod'] = 1;
			$resultadosJson = json_encode($data);
		} else {
			$data['cod'] = 0;
			$data['reportes'] = $this->Reportes_model->get_reportes_app($idUsuario);
			$data['cont'] = $cont;
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_reportes() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
		if ($consulta->num_rows() != 0) {
			foreach ($consulta->result() as $row) {
				$permiso = $row->permisos;
			}
		}
		$consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
		if ($consulta1->num_rows() != 0) {
			foreach ($consulta1->result() as $val) {
				$activo = $val->activo;
			}
		} else {
			$activo = 0;
		}

		$conductores = $this->db->get_where('Users', array('idNivel' == '3', 'Assign_idUser' => $session_data['usuario'])); // get query result
		$vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
		$consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
		if ($consulta2->num_rows() != 0) {
			foreach ($consulta2->result() as $row) {
				$arr['conductor'] = $row->conductor;
				$arr['mensaje'] = $row->mensaje;
				$arr['created_at'] = $row->created_at;
			}
		}
		$arr['count1'] = $conductores->num_rows(); //get current query record.
		$arr['count2'] = $vehiculos->num_rows(); //get current query record.
		$arr['permiso'] = $permiso;
		$arr['activo'] = $activo;
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$idUsuario = $session_data['id'];
		$arr['id'] = $idUsuario;
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;
		$resp = $this->Reportes_model->get_reportes($idUsuario);
		$respUsu = $this->Reportes_model->get_reportes_x_idUsuario($idUsuario);
		$body = '';
		if ($permiso === '0') {
			if ($resp !== FALSE) {
				foreach ($resp as $row) {
					if ($row->id_usuario !== $idUsuario) {
						$div = '<div class="panel panel-primary">';
						$boton = '<button type="button" class="btn btn-primary btn-xs">';
					}
					if ($row->id_usuario === $idUsuario) {
						$div = '<div class="panel panel-warning">';
						$boton = '<button type="button" class="btn btn-success btn-xs">';
					}
					$repoConductor = $this->Reportes_model->get_detalle_reporte($row->conductor, $row->id_carga);
					$body .= '<div class="col-lg-3">' . $div . '
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">
                            <span class="badge">' . count($repoConductor) . '</span>
                            <img src="' . base_url('uploads') . "/" . $row->idConductor . "/" . $row->foto_ruta . '" width="140px" height="140px"/>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="' . base_url('empresa/Mensajes/ver_detalle') . '/' . $row->conductor . '/' . $row->id_carga . '">
                    <div class="panel-footer">
                        <center>
                             ' . $boton . $row->origen . ' - ' . $row->destino . ' / ' . $row->vehiculo_asignado . '</button>
                        </center>
                    </div>
                </a>
            </div>
        </div>';
				}
				$arr['body'] = $body;
				$this->load->view('empresa/vwReportes', $arr);
			} else {
				$arr['body'] = "";
				$this->load->view('empresa/vwReportes', $arr);
			}
		}
		if ($permiso !== '0') {
			if ($respUsu !== FALSE) {
				foreach ($respUsu as $row) {
					$div = '<div class="panel panel-primary">';
					$repoConductor = $this->Reportes_model->get_detalle_reporte($row->conductor, $row->id_carga);
					$body .= '<div class="col-lg-3">' . $div . '
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">
                            <span class="badge">' . count($repoConductor) . '</span>
                            <img src="' . base_url('uploads') . "/" . $row->idConductor . "/" . $row->foto_ruta . '" width="140px" height="140px"/>
                        </div>
                        <div class="col-xs-4"></div>
                    </div>
                </div>
                <a href="' . base_url('empresa/Mensajes/ver_detalle') . '/' . $row->conductor . '/' . $row->id_carga . '">
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-primary btn-xs">' . $row->origen . ' - ' . $row->destino . ' / ' . $row->vehiculo_asignado . '</button>
                        </center>
                    </div>
                </a>
            </div>
        </div>';
				}
				$arr['body'] = $body;
				$this->load->view('empresa/vwReportes', $arr);
			} else {
				$arr['body'] = "";
				$this->load->view('empresa/vwReportes', $arr);
			}
		}
	}

	public function get_reporte() {
		$conductor = $this->input->get('conductor');
		$idCarga = $this->input->get('id_carga');
		$data['reporte'] = $this->Reportes_model->get_detalle_reporte($conductor, $idCarga);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function ver_detalle($conductor, $idCarga) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
		if ($consulta->num_rows() != 0) {
			foreach ($consulta->result() as $row) {
				$permiso = $row->permisos;
			}
		}
		$consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
		if ($consulta1->num_rows() != 0) {
			foreach ($consulta1->result() as $val) {
				$activo = $val->activo;
			}
		} else {
			$activo = 0;
		}

		$conductores = $this->db->get_where('Users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
		$vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
		$consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
		if ($consulta2->num_rows() != 0) {
			foreach ($consulta2->result() as $row) {
				$arr['conductor'] = $row->conductor;
				$arr['mensaje'] = $row->mensaje;
				$arr['created_at'] = $row->created_at;
			}
		}
		$arr['count1'] = $conductores->num_rows(); //get current query record.
		$arr['count2'] = $vehiculos->num_rows(); //get current query record.
		$arr['permiso'] = $permiso;
		$arr['activo'] = $activo;
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;
		$resp = $this->Reportes_model->get_detalle_reporte($conductor, $idCarga);
		$body = '';
		if ($resp == true) {
			foreach ($resp as $row) {
				$body .= '<tr><td>' . $row->created_at . '</td><td>' . $row->nombre .
								" " . $row->apellidos . "</td><td>" . $row->celular .
								'</td><td>' . $row->mensaje . '</td><td>' . $row->ubicacion .
								'</td><td>' . "<a href='" . base_url('empresa/perfil/generar_hv_completa') .
								"/" . $row->idConductor . "' target='_blank'><i class='fa fa-file-pdf-o fa-2x'></i></a>" .
								'</a></td><td><input class="form-check-input" type="checkbox" onclick="checkRepo(' . $row->idReporte . ')"></td></tr>';
				$ruta = $row->origen . " - " . $row->destino;
			}
			$arr['ruta'] = $ruta;
			$arr['body'] = $body;
			$this->load->view('empresa/vwDetalleReportes', $arr);
		} else {
			$arr['ruta'] = "";
			$arr['body'] = "";
			$this->load->view('empresa/vwDetalleReportes', $arr);
		}
	}

	public function enviar_docs() {
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];

		$arr['mensaje'] = 'Los datos ingresados, serán verificados por Enturne en Línea, para habilitar las funciones de la plataforma.';
		$this->load->view('empresa/vwMenEnvioDocs', $arr);
	}

	public function get_licencia_xid($id) {
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];

		$arr['licencia'] = $this->Productos_model->get_producto_xid($id);
		$this->load->view('empresa/vwFormLicencia', $arr);
	}

	public function adquirir_licencia_empresa() {
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];

		if ($this->input->post('reg_lic')) {
			$res = $this->Empresas_model->adquirir_licencia();
			if ($res == FALSE) {
				$arr['mensaje'] = 'Usted ya ha hecho uso de su licencia gratuita, por favor adquiera una licencia de mesualidad o pago anual.';
				$this->load->view('empresa/vwMensajePago', $arr);
			} else {
				$this->Empresas_model->adquirir_licencia();
				$arr['mensaje'] = 'Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y tendra su panel completamente desbloqueado.';
				$this->load->view('empresa/vwMensajePago', $arr);
			}
		}
	}

	public function get_licencia_vehiculos_xid($id) {
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];

		$arr['licencia'] = $this->Productos_model->get_producto_xid($id);
		$this->load->view('empresa/vwFormLicenciaVehiculo', $arr);
	}

	public function adquirir_licencia_vehiculo() {
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];

		if ($this->input->post('reg_lic')) {
			$this->Vehiculos_model->adquirir_licencia();
			$arr['mensaje'] = 'Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y tendra en su panel el vehiculo registrado.';
			$this->load->view('empresa/vwMensajePago', $arr);
		}
	}

	public function activar_licencia_vehiculo() {
		$this->Vehiculos_model->activar_licencia();
	}

	public function reporte_visto() {
		$id = $this->input->post("id");
		$this->Reportes_model->reporte_visto($id);
	}

	public function get_sos() {
		$idEmpresa = $this->input->get('idEmpresa');
		$idUsuario = $this->input->get('idUsuario');
		$resp = $this->Alertas_model->get_sos_x_idusuario($idEmpresa, $idUsuario);
		if ($resp == false) {
			$data['resp'] = 1;
			$resultadosJson = json_encode($data);
		} else {
			$data['alerta'] = $this->Alertas_model->get_sos_x_idusuario($idEmpresa, $idUsuario);
			$data['resp'] = 0;
			$resultadosJson = json_encode($data);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function cerrar_sos() {
		$id = $this->input->post('id');
		$this->Alertas_model->cerrar_sos($id);
	}

}
