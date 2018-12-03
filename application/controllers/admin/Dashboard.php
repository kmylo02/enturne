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
		$this->load->model(array('Users_model', 'Docs_model', 'Vehiculos_model'));
	}

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['totalEmpresas'] = $this->Users_model->totalEmpresas();
		$arr['totalTransp'] = $this->Users_model->totalTransp();
		$arr['totalVehiculos'] = $this->Users_model->totalVehiculos();
		$arr['totalGps'] = $this->Users_model->totalGps();
		$arr['totalCuentaVehiculos'] = $this->Vehiculos_model->totalCuentaVehiculos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$this->load->view('admin/vwDashboard', $arr);
	}

	public function send_mail() {
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
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$this->load->view('admin/vwCorreo');
	}

	function config() {
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
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$this->load->view('admin/vwConfig', $arr);
	}

	function licencias() {
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
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$this->load->view('admin/vwLicencias', $arr);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */