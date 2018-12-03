<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ofertas extends CI_Controller {

	/**
	 * ark Admin Panel for Codeigniter
	 * Author: Jhon Jairo Valdés Aristizabal
	 * downloaded from http://devzone.co.in
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(array('Users_model', 'Ofertas_model', 'Paises_model', 'Vehiculos_model', 'Empresas_model', 'Conductores_model'));
	}

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['mensaje'] = 'No se han realizado ofertas';
		$arr['ofertas'] = $this->Ofertas_model->get_ofertas();
		$this->load->view('admin/vwOfertas', $arr);
	}

	public function crear_oferta() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
		$arr['tipo'] = $this->Vehiculos_model->get_tipo_vehiculo();
		$arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
		$this->load->view('admin/vwFormOferta', $arr);
	}

	public function guardar_oferta_empresa() {
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

		if ($this->input->post('submit_reg')) {

			$this->Ofertas_model->guardar_oferta_empresa();
			$arr = array('mensaje' => 'Oferta creada');
			redirect(base_url() . 'admin/Ofertas', $arr);
		} else {
			$arr = array('mensaje' => 'No se creo la oferta');
			redirect(base_url() . 'admin/Ofertas', $arr);
		}
	}

	public function edit_oferta($id) {
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

		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['mensaje'] = 'No has realizado ofertas';
		$arr['oferta'] = $this->Ofertas_model->get_oferta_xid($id);
		$this->load->view('admin/vwEditOferta', $arr);
	}

	public function delete_oferta($id) {
		$this->Ofertas_model->delete_oferta($id);
		redirect(base_url() . 'admin/Ofertas');
	}

	public function cerrar_oferta($id) {
		$this->Ofertas_model->cerrar_oferta($id);
		redirect(base_url() . 'admin/Ofertas');
	}

	public function update_oferta($id) {
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
		$this->Ofertas_model->update_oferta($id);
		redirect(base_url() . 'admin/Ofertas');
	}

	public function aplicando($id) {
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
		$arr['datos'] = $this->Ofertas_model->aplicando($id);
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$this->load->view('admin/vwAplicando', $arr);
	}

	public function get_aplicando() {
		$id = $this->input->get('id');
		$arr['aplicando'] = $this->Ofertas_model->get_count_aplicando($id);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_contratados() {
		$id = $this->input->get('id');
		$arr['contratados'] = $this->Ofertas_model->get_count_contratados($id);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function contratar_vehiculo($id) {
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
		$this->Ofertas_model->contratar($id);
		redirect(base_url() . 'admin/Ofertas');
	}

	public function contratados($id) {
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
		$arr['datos'] = $this->Ofertas_model->contratados($id);
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$this->load->view('admin/vwContratados', $arr);
	}

	public function calificar_conductor_xid($idConductor, $idv, $idCarga) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['id1'] = $session_data['idempresa'];
		$arr['idConductor'] = $idConductor;
		$arr['idv'] = $idv;
		$arr['idCarga'] = $idCarga;
		$sqlempresa = $this->Empresas_model->get_empresa_xid_carga($idCarga);
		foreach ($sqlempresa as $row) {
			$empresa = $row->nombre_empresa;
		}
		$arr['empresa'] = $empresa;
		$arr['datos'] = $this->Conductores_model->get_conductor_xid($idConductor);
		$this->load->view('admin/vwCalificarConductor', $arr);
	}

	public function enviar_calificacion($idConductor, $idv, $idCarga) {
		$calificacion = $this->input->post('calificacion');
		$obsv = $this->input->post('obsv');
		$empresa = $this->input->post('empresa');
		$this->Ofertas_model->enviar_califacion_conductor($idConductor, $idv, $idCarga, $empresa, $calificacion, $obsv);
		redirect(base_url() . 'admin/Ofertas');
	}

	public function get_oferta_xid_aplicando($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$datos = $this->Ofertas_model->get_oferta_xid($id);
		$arr['origen'] = $datos->origen;
		$arr['destino'] = $datos->destino;
		$arr['dpto_origen'] = $datos->dpto_origen;
		$arr['dpto_destino'] = $datos->dpto_destino;
		$aplicando = $this->Ofertas_model->aplicando_x_oferta($id);
		if ($aplicando == false) {
			$arr['body'] = "";
		} else {
			$body = "";
			foreach ($aplicando as $info_aplicando) {
				if ($info_aplicando->ranking >= 0 && $info_aplicando->ranking < 0.5) {
					$ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 0.5 && $info_aplicando->ranking < 1) {
					$ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}

				if ($info_aplicando->ranking >= 1 && $info_aplicando->ranking < 1.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 1.5 && $info_aplicando->ranking < 2) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 2 && $info_aplicando->ranking < 2.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 2.5 && $info_aplicando->ranking < 3) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 3 && $info_aplicando->ranking < 3.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 3.5 && $info_aplicando->ranking < 4) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 4 && $info_aplicando->ranking < 4.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 4.5 && $info_aplicando->ranking < 5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
				}
				if ($info_aplicando->ranking == 5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}
				$body .= '<tr><td>' . $info_aplicando->fecha_creacion_oferta . '</td><td>' . $info_aplicando->fecha_aplicacion . '</td><td>' . $info_aplicando->placa . '</td><td>' . $info_aplicando->nombre . ' ' . $info_aplicando->apellidos . '</td><td>' . $info_aplicando->celular . '</td><td><img src="' . base_url("uploads") . "/" . $info_aplicando->conductor_id . '/' . $info_aplicando->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td  style="color:#E7AE18">' . $ranking . '</td><td><a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $info_aplicando->conductor_id . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp<button type="button" class="btn btn-success" onclick="convenir(' . $info_aplicando->vehiculo_id . ',' . $id . ')">Convenir</button></td><tr>';
			}
			$arr['body'] = $body;
		}
		$arr['title'] = "Mapa Camiones Aplicando";
		$arr['mensaje2'] = 'No hay vehiculos aplicando';
		$arr['idoferta'] = $id;
		$arr['botonMapa'] = '<a href="#" onclick="getLocationConductoresAplicando()">Cargar mapa</a>';
		$this->load->view('admin/vwVerOferta', $arr);
	}

	public function get_oferta_xid_contratados($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$datos = $this->Ofertas_model->get_oferta_xid($id);
		$arr['origen'] = $datos->origen;
		$arr['destino'] = $datos->destino;
		$arr['dpto_origen'] = $datos->dpto_origen;
		$arr['dpto_destino'] = $datos->dpto_destino;
		$contratados = $this->Ofertas_model->get_contratados($id);
		$body = "";
		if ($contratados == false) {
			$arr['body'] = "";
		} else {
			foreach ($contratados as $info_contratados) {
				if ($info_contratados->ranking >= 0 && $info_contratados->ranking < 0.5) {
					$ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 0.5 && $info_contratados->ranking < 1) {
					$ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 1 && $info_contratados->ranking < 1.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 1.5 && $info_contratados->ranking < 2) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 2 && $info_contratados->ranking < 2.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 2.5 && $info_contratados->ranking < 3) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 3 && $info_contratados->ranking < 3.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 3.5 && $info_contratados->ranking < 4) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 4 && $info_contratados->ranking < 4.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_contratados->ranking >= 4.5 && $info_contratados->ranking < 5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
				}
				if ($info_contratados->ranking == 5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}
				$body .= '<tr><td>' . $info_contratados->created_at . '</td><td>' . $info_contratados->fecha_creacion_oferta . '</td><td>' . $info_contratados->placa . '</td><td>' . $info_contratados->nombre . ' ' . $info_contratados->apellidos . '</td><td>' . $info_contratados->celular . '</td><td><img src="' . base_url("uploads") . "/" . $info_contratados->idConductor . '/' . $info_contratados->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td style="color:#E7AE18">' . $ranking . '</td><td><a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $info_contratados->idConductor . '" target="_blank"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp<a href="' . base_url("admin/Ofertas/calificar_conductor_xid") . "/" . $info_contratados->idConductor . "/" . $info_contratados->vehiculo_id . "/" . $info_contratados->carga_id . '"><i class="fa fa-ban fa-2x"></i></a></td><tr>';
			}
			$arr['body'] = $body;
		}
		$arr['botonMapa'] = '<a href="#" onclick="getLocationConductoresContratados()">Cargar mapa</a>';
		$arr['mensaje2'] = 'No hay vehiculos aplicando';
		$arr['title'] = "Mapa Camiones Contratados";
		$arr['idoferta'] = $id;
		$this->load->view('admin/vwVerOferta', $arr);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
