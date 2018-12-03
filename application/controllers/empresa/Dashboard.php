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
		$this->load->model(array('Empresas_model', 'Vencimientos_model', 'Vehiculos_model'));
	}

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']))->row();
		if ($consulta) {
			$permiso = $consulta->permisos;
		}
		$consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']))->row();
		if ($consulta1) {
			$activo = $consulta1->activo;
		}
		$empresa = $this->Empresas_model->get_empresa($session_data['usuario']);
		if ($activo == 0) {
			$arr['msn_vencimiento'] = 'Bienvenido!, ' . $nombre . ' ' . $apellidos . ' recuerde completar la información de la empresa y del perfil';
			$arr['link'] = '';
		}
		if ($activo == 1) {
			$arr['msn_vencimiento'] = 'Bienvenido!, ' . $nombre . ' ' . $apellidos . ' recuerda subir tu documentación y activar tu licencia enturne';
			$arr['link'] = '';
		}
		if ($activo == 2) {
			$arr['msn_vencimiento'] = 'Bienvenido!, ' . $nombre . ' ' . $apellidos . ' tiene documentos pendientes por subir, por aprobación o alguno ha sido rechazado';
			$arr['link'] = 'Comuniquese con Enturne por favor.'; //.'<p style="color:red">'.$row->obs.'</p>';
		}
		if ($activo == 3) {
			$arr['msn_vencimiento'] = 'Bienvenido!, ' . $nombre . ' ' . $apellidos . ' tu licencia a expirado, pagar <a href="#">ahora</a>';
			$arr['link'] = '';
		}
		if ($activo == 5) {
			$arr['msn_vencimiento'] = 'Bienvenido!, ' . $nombre . ' ' . $apellidos . ' ';
			$arr['link'] = '';
		}
		$conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
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
		$arr['usuario'] = $session_data['usuario'];
		$arr['empresa'] = $empresa;
		$arr['empresaempleado'] = $this->Empresas_model->get_empresa_empleado($session_data['usuario']);
		$arr['totalCuentaVehiculos'] = $this->Vehiculos_model->totalCuentaVxEmpresa($session_data['idempresa']);
		$this->load->view('empresa/vwDashboard', $arr);
	}

	public function send_mail() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
		if ($consulta->num_rows() != 0) {
			foreach ($consulta->result() as $row) {
				$permiso = $row->permisos;
			}
		}
		$consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
		if ($consulta1->num_rows() != 0) {
			foreach ($consulta1->result() as $val) {
				$activo = $val->activo;
			}
		} else {
			$activo = 0;
		}

		$conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
		$vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
		$consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
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
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;
		$arr['aviso'] = '';
		$arr['mensaje'] = 'Aun no has registrado empleados';
		$arr['personal'] = $this->Empresas_model->get_personal($idempresa);
		$this->load->view('empresa/vwPersonal', $arr);
	}

	public function add_emp() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$this->load->view('empresa/vwCorreo');
	}

	public function very_soat() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->very_soat($id);
		if ($res) {
			foreach ($res as $value) {
				$fv = $value->vence_soat;
			}
			$ff = date('Y-m-d');
			$df = $this->dias_transcurridos($ff, $fv);
			if ($df > 0 && $df <= 5) {
				echo 'Tu SOAT expira en ' . $df . ' días.';
			}
		}
	}

	public function very_rtm() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->very_rtm($id);
		if ($res) {
			foreach ($res as $value) {
				$fv = $value->vence_rtecnomecanica;
			}
			$ff = date('Y-m-d');
			$df = $this->dias_transcurridos($ff, $fv);
			if ($df > 0 && $df <= 5) {
				echo 'Tu revisión tecnomecanica expira en ' . $df . ' días.';
			}
		}
	}

	public function very_licenturne() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->very_licenturne($id);
		if ($res) {
			foreach ($res as $value) {
				$fv = $value->vencelic;
			}
			$ff = date('Y-m-d');
			$df = $this->dias_transcurridos($ff, $fv);
			if ($df > 0 && $df <= 5) {
				echo 'Tu licencia enturne expira en ' . $df . ' días.';
			}
		}
	}

	function dias_transcurridos($fecha_i, $fecha_f) {
		$dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
		$dias = abs($dias);
		$dias = floor($dias);
		return $dias;
	}

	public function cancel_recordatorio_soat() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->cancel_recordatorio_soat($id);
		if ($res === TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function cancel_recordatorio_rtm() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->cancel_recordatorio_rtm($id);
		if ($res === TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function cancel_recordatorio_lice() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$res = $this->Vencimientos_model->cancel_recordatorio_lice($id);
		if ($res === TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
