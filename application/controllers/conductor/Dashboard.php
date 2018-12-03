<?php

/**
 * ark Admin Panel for Codeigniter
 * Author: Jhon Jairo Valdés Aristizabal
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Vencimientos_model', 'Vehiculos_model'));
	}

	public function index() {

		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUser = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$tipo = $session_data['tipo'];
		$estado = $session_data['activo'];
		if ($tipo == 1) {
			$arr['titulo'] = 'Conductor';
		}
		if ($tipo == 2) {
			$arr['titulo'] = 'Conductor - Propietario';
		}
		if ($tipo == 3) {
			$arr['titulo'] = 'Propietario';
		}
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['estado'] = $estado;
		$arr['tipo'] = $tipo;
		$arr['totalCuentaVehiculos'] = $this->Vehiculos_model->totalCuentaVxPropieConduct($idUser);
		$this->load->view('conductor/vwDashboard', $arr);
	}

	public function very_licc() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->vence_licc($id);
		if ($res) {
			foreach ($res as $value) {
				$fv = $value->fecha_ven_licencia;
			}
			$ff = date('Y-m-d');
			$df = $this->dias_transcurridos($ff, $fv);
			if ($df > 0 && $df <= 5) {
				echo 'Tu licencia de coduccion expira en ' . $df . ' días.';
			}
		}
	}

	function dias_transcurridos($fecha_i, $fecha_f) {
		$dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
		$dias = abs($dias);
		$dias = floor($dias);
		return $dias;
	}

	public function cancel_recordatorio() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->cancel_recordatorio($id);
		if ($res === TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */