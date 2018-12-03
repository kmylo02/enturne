<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vehiculos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Paises_model', 'Vehiculos_model', 'Empleos_model', 'Conductores_model', 'Ofertas_model'));
	}

	public function index() {

	}

	public function get_docsvehiculo_xid($id) {
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
		$consulta2 = $this->db->get_where('Reportes', array('id_empresa' => $session_data['idempresa']));
		if ($consulta2->num_rows() != 0) {
			foreach ($consulta2->result() as $row) {
				$data['conductor'] = $row->conductor;
				$data['mensaje'] = $row->mensaje;
				$data['created_at'] = $row->created_at;
			}
		} else {
			$data['conductor'] = "";
			$data['mensaje'] = "";
			$data['created_at'] = "";
		}
		$data['count1'] = $conductores->num_rows(); //get current query record.
		$data['count2'] = $vehiculos->num_rows(); //get current query record.
		$data['permiso'] = $permiso;
		$data['activo'] = $activo;
		$data['idusuario'] = $session_data['id'];
		$data['usuario'] = $session_data['usuario'];
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['idempresa'] = $session_data['idempresa'];
		$row = $this->Vehiculos_model->get_vehiculo_xid($id);
		if ($row != FALSE) {
			$data['idv'] = $row->idv;
			$data['placa'] = $row->placa;
			$data['nombre_ciudad'] = $row->nombre_ciudad;
			$data['nombre_tv'] = $row->nombre_tv;
			$data['nombre_ciudad'] = $row->nombre_ciudad;
			$data['nombre_carr'] = $row->nombre_carr;
			$data['trailer'] = $row->trailer;
			$data['trailermarca'] = $row->trailermarca;
			$data['modelo_trailer'] = $row->modelo_trailer;
			$data['peso_vacio_trailer'] = $row->peso_vacio_trailer;
			$data['satelite'] = $row->satelite;
			$data['sateliteusuario'] = $row->sateliteusuario;
			$data['sateliteclave'] = $row->sateliteclave;
			$data['repotenciacion'] = $row->repotenciacion;
			$data['modelo'] = $row->modelo;
			$data['marca'] = $row->marcav;
			$data['capacidad_carga'] = $row->capacidad_carga;
			$data['vence_soat'] = $row->vence_soat;
			$data['soat'] = $row->soat;
			$data['rtecnomecanica'] = $row->rtecnomecanica;
			$data['vence_rtecnomecanica'] = $row->vence_rtecnomecanica;
			$data['licenciatransito'] = $row->licenciatransito;
			$data['rutpropietario'] = $row->rutpropietario;
			$data['foto_frontal'] = $row->foto_frontal;
			$data['foto_latder'] = $row->foto_latder;
			$data['foto_latizq'] = $row->foto_latizq;
			$data['carnetafiliacion'] = $row->carnetafiliacion;
			$data['pdf'] = $row->pdf;
			$data['cedulapropietario'] = $row->cedulapropietario;
			$data['remolque'] = $row->remolque;
		}
		$sql = $this->Vehiculos_model->get_docs_temp_vehiculo($id);
		if ($sql != FALSE) {
			foreach ($sql as $fila) {
				$codigo = $fila->codigo;
				$estado = $fila->estado;
				if ($codigo == 0 && $estado == 0) {
					$data['soattemp'] = $fila->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
				if ($codigo == 1 && $estado == 0) {
					$data['rtecnotemp'] = $fila->nombre;
					$data["obsv1"] = "Pendiente por aprobación";
				}
				if ($codigo == 2 && $estado == 0) {
					$data['lictemp'] = $fila->nombre;
					$data["obsv2"] = "Pendiente por aprobación";
				}
				if ($codigo == 3 && $estado == 0) {
					$data['cedptemp'] = $fila->nombre;
					$data["obsv3"] = "Pendiente por aprobación";
				}
				if ($codigo == 4 && $estado == 0) {
					$data['rutptemp'] = $fila->nombre;
					$data["obsv4"] = "Pendiente por aprobación";
				}
				if ($codigo == 5 && $estado == 0) {
					$data['frontaltemp'] = $fila->nombre;
					$data["obsv5"] = "Pendiente por aprobación";
				}
				if ($codigo == 6 && $estado == 0) {
					$data['latdertemp'] = $fila->nombre;
					$data["obsv6"] = "Pendiente por aprobación";
				}
				if ($codigo == 7 && $estado == 0) {
					$data['traseratemp'] = $fila->nombre;
					$data["obsv7"] = "Pendiente por aprobación";
				}
				if ($codigo == 8 && $estado == 0) {
					$data['remolquetemp'] = $fila->nombre;
					$data["obsv8"] = "Pendiente por aprobación";
				}
				if ($codigo == 9 && $estado == 0) {
					$data['carnettemp'] = $fila->nombre;
					$data['obsv9'] = "Pendiente por aprobación";
				}
				if ($codigo == 10 && $estado == 0) {
					$data['pdftemp'] = $fila->nombre;
					$data['obsv10'] = "Pendiente por aprobación";
				}
			}
		}
		$data['paises'] = $this->Paises_model->get_pais();
		$this->load->view('empresa/vwFormEditDocsVehiculo', $data);
	}

	public function edit_foto_soat_temp() {
		if ($this->input->post('update_soat')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_foto_soat($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_foto_rtecno_temp() {
		if ($this->input->post('update_rtm')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_foto_rtecno($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_foto_lict_temp() {
		if ($this->input->post('update_lict')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_foto_lict($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_foto_cedp_temp() {
		if ($this->input->post('update_cedp')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_foto_cedp($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_foto_rutp_temp() {
		if ($this->input->post('update_rutp')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_foto_rutp($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_vehiculo_pdf_temp() {
		if ($this->input->post('update_pdf')) {
			$id = $this->input->post('idv');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '1600';
			$config['max_height'] = '1600';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Vehiculos_model->edit_pdf($imagen, $id);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function get_aspirantes($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['mensaje'] = 'Aun no hay aspirantes aplicando al empleo';
		$arr['aspirante'] = $this->Empleos_model->get_aspirantes($id);
		$arr['apl'] = $this->Empleos_model->get_aplicaciones();
		$this->load->view('empresa/vwConductores', $arr);
	}

	public function get_oferta_xid($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['oferta'] = $this->Empleos_model->get_oferta_xid($id);
		$this->load->view('empresa/vwVerOfertaEmpleo', $arr);
	}

	public function descartar_oferta_xid($id) {

		$this->Empleos_model->descartar_oferta_xid($id);
		redirect(base_url() . 'empresa/Empleo');
	}

	public function delete_oferta($id) {
		$this->Empleos_model->delete_oferta($id);
		redirect(base_url() . 'empresa/Empleo');
	}

	public function update_oferta() {
		$id = $this->input->post('id_oferta');
		$this->Empleos_model->update_oferta($id);
		redirect(base_url() . 'empresa/Empleo');
	}

	public function get_conductor_xid($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['mensaje'] = '';
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['conxid'] = $this->Conductores_model->get_conductor_xid($id);
		$this->load->view('empresa/vwFormContratarConductor', $arr);
	}

	public function listado_ofertas_vehiculo($idv) {
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

		$conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
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
		$arr['id'] = $idUsuario;
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$body = "";
		$boton = "";
		$ofertas = $this->Ofertas_model->get_ofertas_xidv($idv);
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
				$body .= "<tr><td>" . $row->placa . "</td>"
								. "<td>" . $row->nombre_empresa . "</td>"
								. "<td>" . $row->origen . " / " . $row->destino . "</td>"
								. "<td>" . $row->telefono . "-" . $row->celular . "</td>"
								. "<td>" . $row->fecha . "</td>"
								. "<td>" . number_format($row->peso, 0, '', '.') . "</td>"
								. "<td>" . $row->dimensiones . "</td>"
								. "<td>" . money_format('%.0n', $row->vrflete) . "</td>"
								. "<td>" . $boton . "</td>"
								. "</tr>";
			}
		} else {
			$body = "<tr><td colspan='9'><h5><b>Para visualizar el Estado del enturne de este vehiculo, debe ingresar a Panel/Mis Conductores <a href=" . base_url('empresa/Empleo') . ">Crear vacante</a> y crear una vacante de empleo para contratar a su conductor. </b></h5><td><tr>";
		}
		$arr['body'] = $body;
		$arr['titulos'] = '<th>Placa</th>
                        <th>Empresa </th>
                        <th>Ori/Dest</th>
                        <th>Teléfonos</th>
                        <th>Fecha</th>
                        <th>Peso Kg</th>
                        <th>Dimensiones</th>
                        <th>Valor Flete C/U</th>
                        <th>Estado</th>';
		$this->load->view('empresa/vwCargasVehiculo', $arr);
	}

	public function contratar_conductor() {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		if ($this->input->post('update_reg')) {
			$id = $this->input->post('id');
			$this->form_validation->set_rules('vehiculo', 'Vehiculo', 'required');

			if ($this->form_validation->run() == FALSE) {
				$arr['mensaje'] = '';
				$arr['paises'] = $this->Paises_model->get_pais();
				$arr['conxid'] = $this->Conductores_model->get_conductor_xid($id);
				$this->load->view('empresa/vwFormContratarConductor', $arr);
			} else {
				$arr['mensaje'] = '';
				$arr['conductor'] = $this->Conductores_model->contratar_conductor();
				redirect(base_url() . 'empresa/Empleo/get_conductores_contratados');
			}
		} else {
			redirect(base_url() . 'empresa/Empleo');
		}
	}

	public function get_conductores_contratados() {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['mensaje'] = 'Aun no has contratado conductores';
		$arr['conductor'] = $this->Conductores_model->get_conductores_contratados();
		$this->load->view('empresa/vwConductorescont', $arr);
	}

	public function finalizar_contrato_conductor() {

		$arr['mensaje'] = 'Aun no has contratado conductores';
		$arr['conductor'] = $this->Conductores_model->finalizar_contrato_conductor();
		redirect(base_url() . 'empresa/Empleo/get_conductores_contratados');
	}

	public function finalizar_contrato_conductorxid($id) {
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
		$arr['conductor'] = '';
		$arr['mensaje'] = '';
		$arr['created_at'] = '';
		$arr['id'] = $session_data['id'];
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['conxid'] = $this->Conductores_model->get_conductor_xid($id);
		$this->load->view('empresa/vwFinContConductor', $arr);
	}

	public function GetCuentaVehiculo($idVehiculo = "") {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idempresa = $session_data['idempresa'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr["vehiculo"] = $idVehiculo;
		$datos = $this->Vehiculos_model->getCuentasVehiculo($idVehiculo, $idempresa, "EMPRESA");
		$body = "";
		$acciones = "";
		if ($datos != false) {
			foreach ($datos as $value) {
				$arr['placa'] = $value->placa;
				$TotalGratis = (int) $value->ViajesGratis + $value->ViajesReferidos;
				$TotalPromocion = (int) $TotalGratis * $value->tarifa_enturne;
				$PagosRecibidos = (int) $value->ViajesPendientes * $value->tarifa_enturne;
				$TotalAbonos = (int) $TotalPromocion + $PagosRecibidos;
				$ViajesRealizados = (int) $value->ViajesRealizados * $value->tarifa_enturne;
				$SaldoDisponible = (int) $TotalAbonos - $ViajesRealizados - $value->ValorPago;
				$color = ($SaldoDisponible >= 0) ? "green" : "red";

				$body .= "<tr>";
				($idVehiculo == "1") ? $body .= "<td style='display:none'>" . $value->idVehiculo . "</td><td>" . $value->placa . "</td>" : "";
				$body .= "<td>" . $value->ViajesGratis . "</td>";
				$body .= "<td>" . $value->ViajesReferidos . "</td>";
				$body .= "<td>" . $TotalGratis . "</td>";
				$body .= "<td>" . $value->tarifa_enturne . "</td>";
				$body .= "<td>" . $TotalPromocion . "</td>";
				$body .= "<td>" . $PagosRecibidos . "</td>";
				$body .= "<td>" . $TotalAbonos . "</td>";
				$body .= "<td>" . $ViajesRealizados . "</td>";
				$body .= "<td style='color:" . $color . "'>" . $SaldoDisponible . "</td>";
				$body .= "</tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('empresa/vwCuentaVehiculo', $arr);
	}

	public function DetailAccountV($idVehiculo) {
		try {

			$jsondata['success'] = true;
			$jsondata["data"] = $this->Vehiculos_model->GetDetailAccount($idVehiculo);
		} catch (Exception $ex) {
			$jsondata['success'] = false;
			$jsondata['message'] = 'Erro, ' . $ex;
		}

		echo json_encode($jsondata);
	}

}
