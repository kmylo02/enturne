<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gps extends CI_Controller {

	/**
	 * ark Admin Panel for Codeigniter
	 * Author: Jhon Jairo Valdés Aristizabal
	 * downloaded from http://devzone.co.in
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('Mapa_model');
	}

	public function index() {
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
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;
		$this->load->view('empresa/vwGps', $arr);
	}

	public function aplicando() {
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
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;

		//creamos la configuración del mapa con un array
		$config = array();
		//la zona del mapa que queremos mostrar al cargar el mapa
		//como vemos le podemos pasar la ciudad y el país
		//en lugar de la latitud y la longitud
		$config['center'] = 'bogota,colombia';
		// el zoom, que lo podemos poner en auto y de esa forma
		//siempre mostrará todos los markers ajustando el zoom
		$config['zoom'] = '6';
		//el tipo de mapa, en el pdf podéis ver más opciones
		$config['map_type'] = 'ROADMAP';
		//el ancho del mapa
		$config['map_width'] = '925px';
		//el alto del mapa
		$config['map_height'] = '600px';
		//inicializamos la configuración del mapa
		$this->googlemaps->initialize($config);

		//hacemos la consulta al modelo para pedirle
		//la posición de los markers y el infowindow
		$markers = $this->Mapa_model->get_markers_misvehiculos_aplicando($idempresa);
		if ($markers == false) {
			$arr['datos'] = "";
			$arr['map'] = $this->googlemaps->create_map();
			$this->load->view('empresa/vwGps', $arr);
		} else {
			foreach ($markers as $info_marker) {
				$marker = array();
				//podemos elegir DROP o BOUNCE
				$marker ['animation'] = 'DROP';
				$marker ['icon'] = base_url() . 'assets/img/APLICANDO.png';
				//posición de los markers
				$marker ['position'] = $info_marker->Latitud . ',' . $info_marker->Longitud;
				//infowindow de los markers(ventana de información)
				$marker ['infowindow_content'] = $info_marker->placa;
				//la id del marker
				$marker['id'] = $info_marker->idv;
				$this->googlemaps->add_marker($marker);

				//podemos colocar iconos personalizados así de fácil
				//$marker ['icon'] = base_url().'imagenes/'.$fila->imagen;
				//si queremos que se pueda arrastrar el marker
				//$marker['draggable'] = TRUE;
				//si queremos darle una id, muy útil
			}
			//en $arr['datos'tenemos la información de cada marker para
			//poder utilizarlo en el sidebar en nuestra vista mapa_view
			$arr['datos'] = $this->Mapa_model->get_markers_misvehiculos($idempresa);
			//en data['map'] tenemos ya creado nuestro mapa para llamarlo en la vista
			$arr['map'] = $this->googlemaps->create_map();
			$arr['title'] = "Mapa Camiones Aplicando";
			$this->load->view('empresa/vwGpsAplicando', $arr);
		}
	}

	public function contratados() {
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
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;

		//creamos la configuración del mapa con un array
		$config = array();
		//la zona del mapa que queremos mostrar al cargar el mapa
		//como vemos le podemos pasar la ciudad y el país
		//en lugar de la latitud y la longitud
		$config['center'] = 'bogota,colombia';
		// el zoom, que lo podemos poner en auto y de esa forma
		//siempre mostrará todos los markers ajustando el zoom
		$config['zoom'] = '6';
		//el tipo de mapa, en el pdf podéis ver más opciones
		$config['map_type'] = 'ROADMAP';
		//el ancho del mapa
		$config['map_width'] = '925px';
		//el alto del mapa
		$config['map_height'] = '600px';
		//inicializamos la configuración del mapa
		$this->googlemaps->initialize($config);

		//hacemos la consulta al modelo para pedirle
		//la posición de los markers y el infowindow
		$markers = $this->Mapa_model->get_markers_misvehiculos_contratados($idempresa);
		if ($markers == false) {
			$arr['datos'] = "";
			$arr['map'] = $this->googlemaps->create_map();
			$this->load->view('empresa/vwGps', $arr);
		} else {
			foreach ($markers as $info_marker) {
				$marker = array();
				//podemos elegir DROP o BOUNCE
				$marker ['animation'] = 'DROP';
				$marker ['icon'] = base_url() . 'uploads/img_apps/CONTRATADOS.png';
				//posición de los markers
				$marker ['position'] = $info_marker->Latitud . ',' . $info_marker->Longitud;
				//infowindow de los markers(ventana de información)
				$marker ['infowindow_content'] = $info_marker->placa;
				//la id del marker
				$marker['id'] = $info_marker->idv;
				$this->googlemaps->add_marker($marker);

				//podemos colocar iconos personalizados así de fácil
				//$marker ['icon'] = base_url().'imagenes/'.$fila->imagen;
				//si queremos que se pueda arrastrar el marker
				//$marker['draggable'] = TRUE;
				//si queremos darle una id, muy útil
			}
			//en $arr['datos'tenemos la información de cada marker para
			//poder utilizarlo en el sidebar en nuestra vista mapa_view
			$arr['datos'] = $this->Mapa_model->get_markers_misvehiculos_contratados($idempresa);
			//en data['map'] tenemos ya creado nuestro mapa para llamarlo en la vista
			$arr['map'] = $this->googlemaps->create_map();
			$arr['title'] = "Mapa Camiones Contratados";
			$this->load->view('empresa/vwGpsContratados', $arr);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
