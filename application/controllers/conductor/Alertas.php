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
		$this->load->model('Alertas_model');
	}

	public function index() {
		$nombre = $this->input->post('nombre');
		$comentario = $this->input->post('comentario');
		$ubicacion = $this->input->post('ubicacion');
		$this->Alertas_model->alerta($nombre, $comentario, $ubicacion);
	}

	public function sos() {
		$nombre = $this->input->post('nombre');
		$idEmpresa = $this->input->post('idEmpresa');
		$idUsuario = $this->input->post('idUsuario');
		$ubicacion = $this->input->post('ubicacion');
		$propietario = $this->input->post('propietario');
		$this->Alertas_model->sos($nombre, $ubicacion, $idEmpresa, $idUsuario, $propietario);
	}

	public function sosWeb() {
		$session_data = $this->session->userdata('datos_usuario');
		$idusuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$idEmpresa = $session_data['idempresa'];
		$ubicacion = $this->input->post("dir");
		$this->Alertas_model->sos($usuario, $ubicacion, $idEmpresa, $idusuario);
	}

	public function get_alertas() {
		$usuario = $this->input->get('usuario');
		$data['alertas'] = $this->Alertas_model->get_alertas($usuario);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_alerta() {
		$id = $this->input->get('id');
		$data['alerta'] = $this->Alertas_model->get_alerta($id);
		$resultadosJson = json_encode($data);

		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_alertas_enviadas() {
		$user = $this->input->get('user');
		$data['alerta'] = $this->Alertas_model->get_alertas_enviadas($user);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_sos() {
		$usuario = $this->input->get('usuario');
		$data['sos'] = $this->Alertas_model->get_sos($usuario);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_contsos() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$contsos = $this->Alertas_model->get_contsos_x_propietario($usuario);
		echo $contsos;
	}

	public function get_soss() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$consulta = $this->db->get_where('Users', array('usuario' => $usuario));
		//var_dump($this->db->last_query());
		if ($consulta->num_rows() != 0) {
			foreach ($consulta->result() as $row) {
				$tipo = $row->tipo;
				$cont = $row->idUser;
				$conductores = $this->db->get_where('Users', array('idNivel' => 3, 'Assign_idUser' => $usuario)); // get query result
				$vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $cont)); // get query result
				$count1 = $conductores->num_rows(); //get current query record.
				$count2 = $vehiculos->num_rows(); //get current query record.
				$refper = $this->db->get_where('ReferenciasPersonales', array('idUser' => $cont)); // get query result
				$contador = $refper->num_rows(); //get current query record.
				$refemp = $this->db->get_where('ReferenciasEmpresariales', array('idUser' => $cont)); // get query result
				$contador1 = $refemp->num_rows(); //get current query record.
				$estado = $row->activo;
			}
		}
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['count1'] = $count1;
		$arr['count2'] = $count2;
		$arr['estado'] = $estado;
		$arr['tipo'] = $tipo;

		$sos = $this->Alertas_model->get_sos_x_propietario($usuario);

		$body = "";
		if ($sos) {
			foreach ($sos as $row) {
				$body .= "<tr><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $row->created_at . "</td><td style='color:red'>" . $row->comentario . "</td><td>" . $row->vehiculo_asignado . "</td><td>" . $row->ubicacion . "</td></tr>";
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = "";
		}
		$this->load->view('conductor/vwSos', $arr);
	}

}
