<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Alertas extends CI_Controller {

	/**
	 * ark Admin Panel for Codeigniter
	 * Author: Jhon Jairo Valdés Aristizabal
	 * downloaded from http://devzone.co.in
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Alertas_model', 'Reportes_model'));
	}

	public function index() {

	}

	public function get_soss() {
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
		$consulta2 = $this->db->get_where('Reportes', array('id_empresa' => $session_data['idempresa']));
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
		$idUsuario = $session_data['id'];
		$arr['idUsuario'] = $idUsuario;
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$permisos = $session_data['permisos'];
		if ($permisos == "0") {
			$sos = $this->Alertas_model->get_sos_x_idempresa_web($idempresa, $idUsuario);
		} else {
			$sos = $this->Alertas_model->get_sos_x_idusuario_web($idempresa, $idUsuario);
		}
		$body = "";
		if ($sos) {
			foreach ($sos as $row) {
				$body .= "<tr><td>" . $row->nsub . " " . $row->asub . "</td><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $row->created_at . "</td><td style='color:red'>" . $row->comentario . "</td><td>" . $row->vehiculo_asignado . "</td><td>" . $row->ubicacion . "</td><td><input class='form-check-input' type='checkbox' onclick='elimSos(" . $row->idUser . ")'></td></tr>";
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = "";
		}
		$this->load->view('empresa/vwSos', $arr);
	}

	public function get_contsos() {
		$session_data = $this->session->userdata('datos_usuario');
		$idUsuario = $session_data['id'];
		$idEmpresa = $session_data['idempresa'];
		$permisos = $session_data['permisos'];
		if ($permisos === 0) {
			$contsos = $this->Alertas_model->get_contsos_x_empresa($idEmpresa);
		} else {
			$contsos = $this->Alertas_model->get_contsos_x_idusuario($idUsuario);
		}
		return $contsos;
	}

	public function cerrar_sos() {
		$id = $this->input->post("id");
		$sos = $this->Alertas_model->cerrar_sos_admin($id);
		if ($sos == true) {
			echo "ok";
		} else {
			echo "ko";
		}
	}

	public function cerrar_reporte() {
		$id = $this->input->post("id");
		$repo = $this->Reportes_model->reporte_visto($id);
		if ($repo == true) {
			echo "ok";
		} else {
			echo "ko";
		}
	}

	public function get_contrep() {
		$session_data = $this->session->userdata('datos_usuario');
		$idUsuario = $session_data['id'];
		$idEmpresa = $session_data['idempresa'];
		$permisos = $session_data['permisos'];
		if ($permisos === 0) {
			$res = $this->Reportes_model->get_contrepo_x_empresa($idEmpresa);
		} else {
			$res = $this->Reportes_model->get_contrepo_x_idusuario($idUsuario);
		}
		return $res;
	}

}
