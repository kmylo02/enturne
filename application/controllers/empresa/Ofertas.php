<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Ofertas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Paises_model', 'Vehiculos_model', 'Ofertas_model', 'Mapa_model', 'Conductores_model', 'Empresas_model'));
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

		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
		$arr['tipo'] = $this->Vehiculos_model->get_tipo_vehiculo();
		$arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
		$this->load->view('empresa/vwOfertas', $arr);
	}

	public function listado_ofertas() {
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
		$arr['idUsuario'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['mensaje'] = 'No has realizado ofertas';
		$arr['ofertas'] = $this->Ofertas_model->get_ofertas_emp($idempresa);
		$this->load->view('empresa/vwListaOfertas', $arr);
	}

	public function crear_oferta_app() {
		$pesoS = $this->input->post("peso", TRUE);
		$peso = str_replace('.', '', $pesoS);
		$vrS = $this->input->post("valor", TRUE);
		$vr = str_replace('.', '', $vrS);
		$data = array(
			//'empresa_id' => $this->input->post('idEmpresa', TRUE),
			'idUser' => $this->input->post('userid', TRUE),
			'origen_id' => $this->input->post("localidad", TRUE),
			'dpto_origen_id' => $this->input->post("dptoorigen", TRUE),
			'destino_id' => $this->input->post("localidaddestino", TRUE),
			'dpto_destino_id' => $this->input->post("dptodestino", TRUE),
			'idTipoVehiculo' => $this->input->post("tipov", TRUE),
			'idCamionesCarroceria' => $this->input->post("carroceria", TRUE),
			'peso' => $peso,
			'dimensiones' => $this->input->post("dimensiones", TRUE),
			'fecha' => $this->input->post("date", TRUE),
			'vrflete' => $vr,
			'cantidad' => $this->input->post("cantidad", TRUE),
			'created_at' => date('Y-m-d H:i:s')
		);
		$res = $this->Ofertas_model->guardar_oferta_empresa($data);
		if ($res === TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function carga() {
		$idUsuario = $this->input->get('idUsuario');
		$arr['cargas'] = $this->Ofertas_model->get_cargas_app_empresa($idUsuario);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function conteo() {
		$id = $this->input->get('idCarga');
		$arr['aplicando'] = $this->Ofertas_model->get_count_aplicando($id);
		$arr['contratados'] = $this->Ofertas_model->get_count_contratados($id);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function aplicando_x_oferta() {
		$idCarga = $this->input->get('idCarga');
		$arr['aplicando'] = $this->Ofertas_model->aplicando_x_oferta($idCarga);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function contratados_app_lista() {
		$idCarga = $this->input->get('idCarga');
		$arr['contratados'] = $this->Ofertas_model->get_contratados($idCarga);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function contratados_app() {
		$idEmpresa = $this->input->get('idEmpresa');
		$idUsuario = $this->input->get('idUsuario');
		$marcador = $this->Mapa_model->get_markers_contratados_empresa($idEmpresa, $idUsuario);
		if ($marcador == false) {
			$arr["validacion"] = "error";
			$resultadosJson = json_encode($arr);
		} else {
			$arr["validacion"] = "ok";
			$arr['contratados'] = $marcador;
			$resultadosJson = json_encode($arr);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function contratados_historico_app() {
		$idEmpresa = $this->input->get('idEmpresa');
		$idUsuario = $this->input->get('idUsuario');
		$marcador = $this->Ofertas_model->get_historico_contratados_empresa($idEmpresa, $idUsuario);
		if ($marcador == false) {
			$arr["validacion"] = "error";
			$resultadosJson = json_encode($arr);
		} else {
			$arr["validacion"] = "ok";
			$arr['contratados'] = $this->Ofertas_model->get_historico_contratados_empresa($idEmpresa, $idUsuario);
			$resultadosJson = json_encode($arr);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function verifica_contratados() {
		$id = $this->input->get('id');
		$res = $this->Ofertas_model->verifica_contratados($id);
		if ($res === false) {
			$arr["cod"] = 0;
			$resultadosJson = json_encode($arr);
		} else {
			$arr["cod"] = 1;
			$arr['cont'] = $this->Ofertas_model->verifica_contratados($id);
			$resultadosJson = json_encode($arr);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function verifica_rechazos() {
		$id = $this->input->get('id');
		$res = $this->Ofertas_model->verifica_rechazos($id);
		if ($res === false) {
			$arr["cod"] = 0;
			$resultadosJson = json_encode($arr);
		} else {
			$arr["cod"] = 1;
			$arr['rechazos'] = $this->Ofertas_model->verifica_rechazos($id);
			$resultadosJson = json_encode($arr);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function contratados_historico() {
		setlocale(LC_MONETARY, 'es_CO');
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
		$arr['idUsuario'] = $idUsuario;
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['idempresa'] = $idempresa;
		$permisos = $session_data['permisos'];
		$body = "";
		if ($permisos == 0) {
			$marcador = $this->Ofertas_model->get_historico_contratados_empresa($idempresa);
			if ($marcador !== false) {
				foreach ($marcador as $row) {
					if ($row->calificacion_empresa == 0) {
						$ranking = '';
					}
					if ($row->calificacion_empresa == 1) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 2) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 3) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 4) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 5) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
					}
					if ($row->manifest == NULL) {
						$manifiest = '';
					} else {
						$manifiest = '<a href="'
										. base_url("uploads/empresas") . "/" . $row->empresa_id . "/manifiestos/" . $row->idContrato . "/" . $row->manifest . '" title="PDF Manifiesto" target="blank">Ver Manifiesto carga</a>';
					}
					$body .= '<tr><td>' . $row->ncreador . ' ' . $row->acreador . '</td><td>' . $row->placa . '</td><td>' . $row->origen . ' ' . $row->destino . '</td><td>' . $row->fecha_contratado . '</td><td>' . $row->date_end . '</td><td>' . $row->nombre . ' ' . $row->apellidos . '</td><td>' . $row->celular . '</td><td>' . $row->nombre_tv . '</td><td>' . $row->dimensiones . '</td><td>' . money_format('%.0n', $row->vrflete) . '</td><td>' . $manifiest . '</td><td style="color:#E7AE18">' . $ranking . '</td><td>' . $row->observaciones . '</td><td><a href="' . base_url('empresa/perfil/generar_hv_conductor') . '/' . $row->conductor_id . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a></td><tr>';
				}
				$arr['creador'] = '<th>Contrató</th>';
				$arr['body'] = $body;
				$this->load->view('empresa/vwHistorico', $arr);
			} else {
				$arr['creador'] = "";
				$arr['body'] = "";
				$this->load->view('empresa/vwHistorico', $arr);
			}
		} else {
			$marcador = $this->Ofertas_model->get_historico_contratados_subusuario($idempresa, $idUsuario);
			if ($marcador !== false) {
				foreach ($marcador as $row) {
					if ($row->calificacion_empresa == 0) {
						$ranking = '';
					}
					if ($row->calificacion_empresa == 1) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 2) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 3) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 4) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
					}
					if ($row->calificacion_empresa == 5) {
						$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
					}
					if ($row->manifest == NULL) {
						$manifiest = '';
					} else {
						$manifiest = '<a href="'
										. base_url("uploads/empresas") . "/" . $row->empresa_id . "/manifiestos/" . $row->idContrato . "/" . $row->manifest . '" title="PDF Manifiesto" target="blank">Ver Manifiesto carga</a>';
					}
					$body .= '<tr><td>' . $row->placa . '</td><td>' . $row->origen . ' ' . $row->destino . '</td><td>' . $row->fecha_contratado . '</td><td>' . $row->date_end . '</td><td>' . $row->nombre . ' ' . $row->apellidos . '</td><td>' . $row->celular . '</td><td>' . $row->nombre_tv . '</td><td>' . $row->dimensiones . '</td><td>' . money_format('%.0n', $row->vrflete) . '</td><td>' . $manifiest . '</td><td style="color:#E7AE18">' . $ranking . '</td><td>' . $row->observaciones . '</td><td><a href="' . base_url('empresa/perfil/generar_hv_conductor') . '/' . $row->conductor_id . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a></td><tr>';
				}
				$arr['creador'] = '';
				$arr['body'] = $body;
				$this->load->view('empresa/vwHistorico', $arr);
			} else {
				$arr['creador'] = "";
				$arr['body'] = "";
				$this->load->view('empresa/vwHistorico', $arr);
			}
		}
	}

	public function aplicando_app() {
		$idEmpresa = $this->input->get('idEmpresa');
		$idUsuario = $this->input->get('idUsuario');
		$marcador = $this->Mapa_model->get_markers_aplicando_empresa($idEmpresa, $idUsuario);

		if ($marcador == false) {
			$arr["validacion"] = "error";
			$resultadosJson = json_encode($arr);
		} else {
			$arr["validacion"] = "ok";
			$arr['aplicando'] = $this->Mapa_model->get_markers_aplicando_empresa($idEmpresa, $idUsuario);
			$resultadosJson = json_encode($arr);
		}
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function guardar_oferta_empresa() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$idempresa = $session_data['idempresa'];
		$pesoS = $this->input->post("peso", TRUE);
		$peso = str_replace('.', '', $pesoS);
		$vrS = $this->input->post("valor", TRUE);
		$vr = str_replace('.', '', $vrS);
		$data = array(
			//'empresa_id' => $idempresa,
			'idUser' => $id,
			'origen_id' => $this->input->post("origen_id", TRUE),
			'dpto_origen_id' => $this->input->post("dpto_origen_id", TRUE),
			'destino_id' => $this->input->post("destino_id", TRUE),
			'dpto_destino_id' => $this->input->post("dpto_destino_id", TRUE),
			'idTipoVehiculo' => $this->input->post("tipo_vehiculo_id", TRUE),
			'idCamionesCarroceria' => $this->input->post("carroceria_id", TRUE),
			'peso' => $peso,
			'fecha' => $this->input->post("fecha", TRUE),
			'cantidad' => $this->input->post("cantidad", TRUE),
			'dimensiones' => $this->input->post("dimensiones", TRUE),
			'vrflete' => $vr,
			'created_at' => date('Y-m-d H:i:s')
		);
		$res = $this->Ofertas_model->guardar_oferta_empresa($data);
		echo $this->valida($res);
	}

	public function guardar_manifiesto() {
		$session_data = $this->session->userdata('datos_usuario');
		$idempresa = $session_data['idempresa'];
		$idContrato = $this->input->post('id');
		//Creamos las carpetas
		if (!is_dir("./uploads/empresas/" . $idempresa . "/manifiestos/" . $idContrato)) {
			mkdir("./uploads/empresas/" . $idempresa . "/manifiestos/" . $idContrato, 0777, true);
		}
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			//obtenemos el archivo a subir
			$file = $_FILES['files']['name'];
			//subimos el archivo
			move_uploaded_file($_FILES['files']['tmp_name'], "./uploads/empresas/" . $idempresa . "/manifiestos/" . $idContrato . "/" . $_FILES['files']['name']);

			$data = array(
				'pdf' => $file
			);
			$res = $this->Ofertas_model->update_carga_vehiculo($this->input->post('id'), $data);
			echo $this->valida($res);
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function valida($res) {
		if ($res == TRUE) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function get_oferta_xid_contratados($id) {
		setlocale(LC_MONETARY, 'es_CO');
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
			//$body = $this->getContratadosOferta($contratados);
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
				if ($info_contratados->manifest == NULL) {
					$manifiest = '';
				} else {
					$manifiest = '<a href="'
									. base_url("uploads/empresas") . "/" . $info_contratados->idEmpresa . "/manifiestos/" . $info_contratados->idContrato . "/" . $info_contratados->manifest . '" title="PDF Manifiesto" target="blank">Ver Manifiesto carga</a>';
				}
				$body .= '<tr>'
								. '<td>' . $info_contratados->created_at . '</td>'
								. '<td>' . $info_contratados->fecha_creacion_oferta . '</td>'
								. '<td>' . $info_contratados->placa . '</td>'
								. '<td>' . $info_contratados->dimensiones . '</td>'
								. '<td>' . money_format('%.0n', $info_contratados->vrflete) . '</td>'
								. '<td>' . $info_contratados->nombre . ' ' . $info_contratados->apellidos . '</td>'
								. '<td>' . $info_contratados->celular . '</td>'
								. '<td><img src="' . base_url("uploads") . "/" . $info_contratados->idConductor . '/' . $info_contratados->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90" onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td>'
								. '<td style="color:#E7AE18">' . $ranking . '</td>'
								. '<td><a href="' . base_url('empresa/perfil/generar_hv_completa') .
								"/" . $info_contratados->idConductor . '" target="_blank" title="Hoja de vida">' .
								'<i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp<a href="'
								. base_url("empresa/Ofertas/calificar_conductor_xid") . "/"
								. $info_contratados->idConductor . "/" . $info_contratados->idVehiculo .
								"/" . $info_contratados->idOfertaCarga . '" title="Cancelar Contrato">' .
								'<i class="fa fa-ban fa-2x"></i></a><form id="frmManifest_' . $info_contratados->idContrato . '" action="javascript:subirManifiesto(' . $info_contratados->idContrato . ')" enctype="multipart/form-data">' .
								'<label class="control-label" for="files_' . $info_contratados->idContrato . '">' .
								'<div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;">' .
								'<img src="' . base_url('assets/img/clip.png') . '" style="width: 30px;margin-top: 8px;margin-right: 1px;margin-left: 4px;"></div></label>
                            <p id="datofile_' . $info_contratados->idContrato . '"></p><input type="hidden" name="id" value="' . $info_contratados->idContrato . '">' .
								'<input type="file" name="files" id="files_' . $info_contratados->idContrato . '" style="display: none" onchange="getFileName(this,' . $info_contratados->idContrato . ')" accept="*" size="2048" required>' .
								'<input type="submit" class="btn-success" value="Subir Manifiesto"></form>' . $manifiest . '</td>'
								. '<tr>';
			}
			$arr['body'] = $body;
		}
		$arr['botonMapa'] = '<a href="#" onclick="getLocationConductoresContratados()">Cargar mapa</a>';
		$arr['mensaje2'] = 'No hay vehiculos aplicando';
		$arr['title'] = "Mapa Camiones Contratados";
		$arr['idoferta'] = $id;
		$this->load->view('empresa/vwVerOferta', $arr);
	}

	public function getContratadosOferta($param) {
		foreach ($param as $info_contratados) {
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
			$body .= '<tr>'
							. '<td>' . $info_contratados->created_at . '</td>'
							. '<td>' . $info_contratados->fecha_creacion_oferta . '</td>'
							. '<td>' . $info_contratados->placa . '</td>'
							. '<td>' . $info_contratados->dimensiones . '</td>'
							. '<td>' . money_format('%.0n', $info_contratados->vrflete) . '</td>'
							. '<td>' . $info_contratados->nombre . ' ' . $info_contratados->apellidos . '</td>'
							. '<td>' . $info_contratados->celular . '</td>'
							. '<td><img src="' . base_url("uploads") . "/" . $info_contratados->idConductor . '/' . $info_contratados->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90" onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td>'
							. '<td style="color:#E7AE18">' . $ranking . '</td>'
							. '<td><a href="' . base_url('empresa/perfil/generar_hv_completa') .
							"/" . $info_contratados->idConductor . '" target="_blank" title="Hoja de vida">' .
							'<i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp<a href="'
							. base_url("empresa/Ofertas/calificar_conductor_xid") . "/"
							. $info_contratados->idConductor . "/" . $info_contratados->vehiculo_id .
							"/" . $info_contratados->carga_id . '" title="Cancelar Contrato">' .
							'<i class="fa fa-ban fa-2x"></i></a><form id="frmManifest" enctype="multipart/form-data">' .
							'<label class="control-label" for="files">' .
							'<div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;">' .
							'<img src="' . base_url('assets/img/clip.png') . '" style="width: 30px;margin-top: 8px;margin-right: 1px;margin-left: 4px;"></div></label>
                            <p id="datofile"></p><input type="hidden" name="id" value="' . $info_contratados->idContrato . '">' .
							'<input type="hidden" name="idConductor" value="' . $info_contratados->idConductor . '">' .
							'<input type="file" name="files" id="files" style="display: none" onchange="getFileName(this)" accept="*" size="2048" required>' .
							'<input type="submit" class="btn-success" value="Subir Manifiesto"></form><a href="'
							. base_url("uploads/empresas/") . $info_contratados->empresa_id . "/manifiestos/conductores/" . $info_contratados->idConductor . "/" . $info_contratados->pdf . '" title="PDF Manifiesto">Manifiesto carga</a></td>'
							. '<tr>';
		}
		return $body;
	}

	public function get_oferta_xid_aplicando($id) {
		setlocale(LC_MONETARY, 'es_CO');
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
				if ($info_aplicando->enturne < '2') {
					if ($info_aplicando->contratado === '0') {
						$btnap = '<button type="button" class="btn btn-success" onclick="convenir(' . $info_aplicando->idVehiculo . ',' . $id . ')">Convenir</button>';
					}
					if ($info_aplicando->contratado === '1') {
						$btnap = '<button type="button" class="btn btn-danger" disabled>Solicitado</button>';
					}
					if ($info_aplicando->contratado === '2') {
						$btnap = '<button type="button" class="btn btn-danger" disabled>Contrato aceptado por el conductor</button>';
					}
					if ($info_aplicando->contratado === '3') {
						$btnap = '<button type="button" class="btn btn-danger" disabled>Conductor rechazo oferta</button>';
					}
				} else {
					$btnap = '<button type="button" class="btn btn-danger" disabled>No disponible</button>';
				}
				if ($info_aplicando->ranking >= 0.0 && $info_aplicando->ranking < 0.5) {
					$ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 0.5 && $info_aplicando->ranking < 1.0) {
					$ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}

				if ($info_aplicando->ranking >= 1.0 && $info_aplicando->ranking < 1.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 1.5 && $info_aplicando->ranking < 2.0) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 2.0 && $info_aplicando->ranking < 2.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 2.5 && $info_aplicando->ranking < 3.0) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 3 && $info_aplicando->ranking < 3.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 3.5 && $info_aplicando->ranking < 4.0) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 4.0 && $info_aplicando->ranking < 4.5) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
				}
				if ($info_aplicando->ranking >= 4.5 && $info_aplicando->ranking < 5.0) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
				}
				if ($info_aplicando->ranking > 4.9) {
					$ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}
				$body .= '<tr><td>' .
                                        $info_aplicando->fecha_creacion_oferta .
                                        '</td><td>' .
                                        $info_aplicando->fecha_aplicacion .
                                        '</td><td>' . $info_aplicando->placa .
                                        '</td><td>' . $info_aplicando->dimensiones .
                                        '</td><td>' .
                                        money_format('%.0n', $info_aplicando->vrflete) .
                                        '</td><td>' . $info_aplicando->nombre .
                                        ' ' . $info_aplicando->apellidos .
                                        '</td><td>' . $info_aplicando->celular .
                                        '</td><td><img src="' .
                                        base_url("uploads") . "/" .
                                        $info_aplicando->conductor_id . '/' .
                                        $info_aplicando->foto_ruta .
                                        '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;">
                </td><td  style="color:#E7AE18">' . $ranking .
                                        '</td><td><a href="' .
                                        base_url('empresa/perfil/generar_hv_completa') .
                                        "/" . $info_aplicando->conductor_id .
                                        '" target="_blank" title="Hoja de vida">'
                                        . '<i class="fa fa-file-pdf-o fa-2x"></i>'
                                        . '</a>&nbsp' . $btnap . '</td><tr>';
			}
			$arr['body'] = $body;
		}
		$arr['title'] = "Mapa Camiones Aplicando";
		$arr['mensaje2'] = 'No hay vehiculos aplicando';
		$arr['idoferta'] = $id;
		$arr['botonMapa'] = '<a href="#" onclick="getLocationConductoresAplicando()">Cargar mapa</a>';
		$this->load->view('empresa/vwVerOferta', $arr);
	}

	public function mapa_aplicando() {
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
		$arr['idusuario'] = $idUsuario;
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['title'] = "Mapa Camiones Aplicando";
		$arr['mensaje2'] = 'No hay vehiculos aplicando';
		$arr['botonMapa'] = '<a href="#" onclick="getLocationAplicando()">Cargar mapa</a>';
		$aplicando = $this->Ofertas_model->aplicando_x_usuario($idUsuario);
		if ($aplicando) {
			$body = "";
			foreach ($aplicando as $info_aplicando) {
				if ($info_aplicando->ocupado === '1') {
					$btnap = '<button type="button" class="btn btn-danger" disabled>Contratado en otra oferta</button>';
				} else {
					$btnap = '<button type="button" class="btn btn-success" onclick="convenir(' . $info_aplicando->vehiculo_id . ',' . $info_aplicando->carga_id . ')">Convenir</button>';
				}

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
				$body .= '<tr><td>' . $info_aplicando->fecha_creacion_oferta . '</td><td>' . $info_aplicando->fecha_aplicacion . '</td><td>' . $info_aplicando->origen . '-' . $info_aplicando->destino . '</td><td>' . $info_aplicando->placa . '</td><td>' . $info_aplicando->nombre . ' ' . $info_aplicando->apellidos . '</td><td>' . $info_aplicando->celular . '</td><td><img src="' . base_url("uploads") . "/" . $info_aplicando->conductor_id . "/" . $info_aplicando->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td  style="color:#E7AE18">' . $ranking . '</td><td><a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $info_aplicando->conductor_id . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp' . $btnap . '</td><tr>';
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = "";
		}
		$this->load->view('empresa/vwMapaGps', $arr);
	}

	public function mapa_contratados() {
		setlocale(LC_MONETARY, 'es_CO');
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
		$idUsuario = $session_data['id'];
		$arr['idusuario'] = $idUsuario;
		$usuario = $session_data['usuario'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['title'] = "Mapa Camiones Contratados";
		$arr['mensaje2'] = 'No hay vehiculos contratados';
		$arr['botonMapa'] = '<a href="#" onclick="getLocationContratados()">Cargar mapa</a>';
		$contratados = $this->Ofertas_model->contratado_x_usuario($idUsuario);
		if ($contratados) {
			$body = "";
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
				$body .= '<tr><td>' . $info_contratados->fecha_creacion_oferta . '</td><td>'
								. $info_contratados->fecha_aplicacion . '</td><td>'
								. $info_contratados->origen . '-' . $info_contratados->destino . '</td><td>'
								. $info_contratados->placa . '</td><td>'
								. $info_contratados->dimensiones . '</td><td>' . money_format('%.0n', $info_contratados->vrflete) . '</td><td>' .
								$info_contratados->nombre . ' ' . $info_contratados->apellidos . '</td><td>' .
								$info_contratados->celular . '</td><td>' .
								'<img src="' . base_url("uploads") . "/" . $info_contratados->conductor_id . "/" . $info_contratados->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90" onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;">' .
								'</td><td style="color:#E7AE18">' . $ranking . '</td><td>' .
								'<a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $info_contratados->conductor_id . '" target="_blank">' .
								'<i class="fa fa-file-pdf-o fa-2x"></i></a>&nbsp' .
								'<a href="' . base_url("empresa/Ofertas/calificar_conductor_xid") . "/" . $info_contratados->conductor_id . "/" . $info_contratados->idVehiculo . "/" . $info_contratados->idOfertaCarga . '">' .
								'<i class="fa fa-ban fa-2x"></i></a></td><tr>';
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = "";
		}
		$this->load->view('empresa/vwMapaGps', $arr);
	}

	public function delete_oferta($id) {
		$this->Ofertas_model->delete_oferta($id);
		redirect(base_url() . 'empresa/Ofertas');
	}

	public function cerrar_oferta($id) {
		$this->Ofertas_model->cerrar_oferta($id);
		redirect(base_url() . 'empresa/Ofertas');
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
		$this->load->view('empresa/vwEditOferta', $arr);
	}

	public function update_oferta() {
		$id = $this->input->post('id');
		$data = array(
			'peso' => $this->input->post('peso'),
			'cantidad' => $this->input->post('cantidad'),
			'fecha' => $this->input->post('fecha'));
		$res = $this->Ofertas_model->update_oferta($id, $data);
		if ($res == true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function aplicando($id) {
		$arr['datos'] = $this->Ofertas_model->aplicando($id);
		$this->load->view('empresa/vwAplicando', $arr);
	}

	public function contratar_vehiculo($id, $idCarga) {
		$this->Ofertas_model->contratar($id, $idCarga);
		redirect(base_url() . 'empresa/Ofertas');
	}

	public function convenir_oferta() {
		$id = $this->input->post('idv');
		$idCarga = $this->input->post('idcarga');
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($id);
		$datosContratado = $this->Vehiculos_model->get_datos_conductor($id);
		$datosContratista = $this->Empresas_model->get_empresa_xid_carga($idCarga);
		$datosCarga = $this->Ofertas_model->get_oferta_xid($idCarga);
		$res = $this->Ofertas_model->convenir_oferta($id, $idCarga);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre_contratado' => $datosPropietario->nombre . ' ' . $datosPropietario->apellidos,
				'nombre_empresa' => $datosContratista->nombre.''.$datosContratista->apellidos,
				'conductor' => $datosContratado->nombre . ' ' . $datosContratado->apellidos,
				'placa' => $datosContratado->placa,
				'trayecto' => $datosCarga->origen . '-' . $datosCarga->destino,
				'fecha' => $datosCarga->created_at,
				'flete' => $datosCarga->vrflete,
				'peso' => $datosCarga->peso,
				'volumen' => $datosCarga->dimensiones,
				'mensaje' => 'Para aceptar este contrato, el conductor ó conductor-propietario, debe ingresar con su usuario y contraseña al aplicativo conductor ó la web <a href="https://dev.enturne.co" title="Web Enturne">https://dev.enturne.co</a> carga/listado ofertas de carga/aceptar ó rechazar.
<br><br>Nota: Enturne En Línea, es una aplicación informativa para el servicio de consecución de carga, es responsabilidad del <br>conductor, la validación y aceptación de este contrato de transporte.
<br><br>'
			);
			$this->email->to($datosPropietario->email);
			$this->email->cc('administrativo@enturne.co');
			$this->email->subject('Empresa de Transporte, solicita confirmación de camión');
			$body = $this->load->view('emails_contrato.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function terminarContratoOfertaApp() {
		$idVehiculo = $this->input->post('idVehiculo');
		$idOferta = $this->input->post('idOferta');
		$idConductor = $this->input->post('idConductor');
		$ranking = $this->input->post('ranking');
		$obsv = $this->input->post('obsv');
		$this->Ofertas_model->terminarContrato($idVehiculo, $idOferta, $idConductor, $ranking, $obsv);
	}

	public function cancelar_contrato() {
		$idVehiculo = $this->input->post('idVehiculo');
		$idOferta = $this->input->post('idOferta');
		$idConductor = $this->input->post('idConductor');
		$ranking = $this->input->post('ranking');
		$obsv = $this->input->post('obsv');
		$this->Ofertas_model->terminarContrato($idVehiculo, $idOferta, $idConductor, $ranking, $obsv);
	}

	public function contratados($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['datos'] = $this->Ofertas_model->contratados($id);
		$this->load->view('empresa/vwContratados', $arr);
	}

	public function calificar_conductor_xid($idConductor, $idv, $idCarga) {
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
		$consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
		if ($consulta1->num_rows() != 0) {
			foreach ($consulta1->result() as $val) {
				$activo = $val->activo;
				$empresa = $val->nombre_empresa;
			}
		} else {
			$activo = 0;
		}

		$conductores = $this->db->get_where('Users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
		$vehiculos = $this->db->get_where('Vehiculos', array('user_id' => $session_data['id'])); // get query result
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
		$arr['idEmpresa'] = $session_data['idempresa'];
		$arr['idConductor'] = $idConductor;
		$arr['idv'] = $idv;
		$arr['idCarga'] = $idCarga;
		$arr['empresa'] = $empresa;
		$arr['datos'] = $this->Conductores_model->get_conductor_xid($idConductor);
		$this->load->view('empresa/vwCalificarConductor', $arr);
	}

	public function enviar_calificacion($idConductor, $idVehiculo, $idOferta) {
		$calificacion = $this->input->post('calificacion');
		$obsv = $this->input->post('obsv');
		$this->Ofertas_model->terminarContrato($idVehiculo, $idOferta, $idConductor, $calificacion, $obsv);
		redirect(base_url() . 'empresa/Ofertas');
	}

	public function editarOfertaApp() {
		$id = $this->input->get('id');
		$arr['carga'] = $this->Ofertas_model->get_oferta_xid($id);
		$resultadosJson = json_encode($arr);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function actualizarOfertaApp() {
		$id = $this->input->post('id');
		$peso = $this->input->post('peso');
		$cantidad = $this->input->post('cantidad');
		$fecha = $this->input->post('fecha');
		$this->Ofertas_model->update_oferta_xid_app($id, $peso, $cantidad, $fecha);
	}

	public function finalizarOfertaApp() {
		$id = $this->input->post('id');
		$this->Ofertas_model->cerrar_oferta($id);
	}

	public function eliminarOfertaApp() {
		$id = $this->input->post('id');
		$this->Ofertas_model->delete_oferta($id);
	}

	public function solicitud_calificacion() {
		$idUser = $this->input->get('idUser');
		$data['carga'] = $this->Ofertas_model->solicitud_calificacion_conductor($idUser);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function carga_x_id() {
		$id = $this->input->get('id');
		$data['carga'] = $this->Ofertas_model->get_oferta_xid($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

}
