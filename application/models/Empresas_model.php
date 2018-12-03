<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Empresas_model extends CI_Model {

	public function add_empresa() {
		$this->db->trans_start();
		$this->db->select_max('idEmpresa');
		$consult = $this->db->get('Empresas');
		if ($consult->num_rows() > 0) {
			foreach ($consult->result() as $row) {
				$id_emp = $row->id + 1;
			}
		}
		$data = array(
			'idEmpresa' => $id_emp
		);
		$this->db->where('usuario', $_SESSION['usuario']);
		$this->db->update('Users', $data);

		$this->db->insert('Empresas', array(
			'nit' => $this->input->post('nit', TRUE),
			'nombre_empresa' => $this->input->post('name', TRUE),
			'siglas' => $this->input->post('siglas', TRUE),
			'dpto_id' => $this->input->post('provincia', TRUE),
			'ciudad_id' => $this->input->post('localidad', TRUE),
			'email' => $this->input->post('email', TRUE),
			'telefono' => $this->input->post('telefono', TRUE),
			'celular' => $this->input->post('cel', TRUE),
			'direccion' => $this->input->post('direccion', TRUE),
			'fax' => $this->input->post('fax', TRUE),
			'web' => $this->input->post('web', TRUE),
			'rut' => $this->input->post('rut', TRUE),
			'camaracomercio' => $this->input->post('camara', TRUE),
			'logo' => $this->input->post('logo', TRUE),
			'pdf' => $this->input->post('pdf', TRUE),
			'tipo_carga' => $this->input->post('tipo_carga', TRUE),
			'created_at' => date('Y-m-d H:i:s')
		));
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function add_empresaxadmin() {

		$this->db->insert('Empresas', array(
			'nit' => $this->input->post('nit', TRUE),
			'nombre_empresa' => $this->input->post('nombre', TRUE),
			'siglas' => $this->input->post('siglas', TRUE),
			'dpto_id' => $this->input->post('provincia', TRUE),
			'ciudad_id' => $this->input->post('localidad', TRUE),
			'email' => $this->input->post('email', TRUE),
			'telefono' => $this->input->post('telefono', TRUE),
			'direccion' => $this->input->post('direccion', TRUE),
			'fax' => $this->input->post('fax', TRUE),
			'celular' => $this->input->post('cel', TRUE),
			'web' => $this->input->post('web', TRUE),
			'created_at' => date('Y-m-d H:i:s')
		));

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_empresa($data, $id) {
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_empresaxemp($data, $idempresa) {
		$this->db->where('idEmpresa', $idempresa);
		$this->db->update('Empresas', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_empresas() {

		$consulta = $this->db->get('Empresas');

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_empresas_activas() {
		$consulta = "SELECT t1.*,t2.idUser as id_admin,t2.estado,t2.activo as estadoReg FROM Empresas t1 JOIN Users t2 ON t1.idEmpresa=t2.idEmpresa WHERE t1.activo = 5 AND t2.permisos=0";
		$query = $this->db->query($consulta);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_empresas_inactivas() {
		$consulta = "SELECT t1.*,t2.idUser as id_admin,t2.estado,t2.activo as estadoReg FROM Empresas t1 JOIN Users t2 ON t1.idEmpresa=t2.idEmpresa WHERE t1.activo < 5 AND t2.permisos=0";
		$query = $this->db->query($consulta);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_empresa($usuario) {
		$SqlInfo = "select * FROM Empresas WHERE nit='$usuario' ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return [];
		}
	}

	public function get_empresa_empleado($usuario) {
		$this->db->trans_start();
		$SqlInfo = "select idEmpresa FROM Users WHERE usuario='$usuario' ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $value) {
				$id_emp = $value->idEmpresa;
			}
		}

		$SqlInfo1 = "select * FROM Empresas WHERE idEmpresa='$id_emp' ";
		$query1 = $this->db->query($SqlInfo1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return $query1->result();
		} else {

			print 'no results';
		}
	}

	public function add_personalempresaxadmin() {
		$query = $this->db->get_where('Users', array('usuario' => $this->input->post('username')));
		if ($query->num_rows() > 0) {
			return FALSE;
		} else {
			$this->db->insert('Users', array(
				'nombre' => $this->input->post('name'),
				'apellidos' => $this->input->post('sname'),
				'tipo_doc' => $this->input->post('tipo_doc'),
				'cedula' => $this->input->post('cedula'),
				'idDepartamento' => $this->input->post('provincia'),
				'idCiudad' => $this->input->post('localidad'),
				'direccion' => $this->input->post('direccion'),
				'email' => $this->input->post('email'),
				'telefono' => $this->input->post('telefono'),
				'codigo' => $this->input->post('code'),
				'idNivel' => $this->input->post('nivel'),
				'usuario' => $this->input->post('username'),
				'pass' => md5($this->input->post('password')),
				'idEmpresa' => $this->input->post('id_emp'),
				'permisos' => $this->input->post('permisos'),
				'fecha_creacion' => date('Y-m-d H:i:s')
			));

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function get_docs($idEmp) {
		$SqlInfo = "select id,rut,camaracomercio,logo,pdf FROM Empresas WHERE id='$idEmp'";
		$query1 = $this->db->query($SqlInfo);

		if ($query1->num_rows() > 0) {
			return $query1->result();
		} else {

			return false;
		}
	}

	public function get_docs_temp($idEmp) {
		$SqlInfo = "select * FROM Imgs_temp_empresas WHERE idEmpresa='$idEmp' AND estado = 0";
		$query1 = $this->db->query($SqlInfo);

		if ($query1->num_rows() > 0) {
			return $query1->result();
		} else {

			return false;
		}
	}

	public function edit_foto_perfil($id, $imagen) {
		$data = array(
			'foto_ruta' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
	}

	public function upload_logo($id, $logo) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM Imgs_temp_empresas WHERE idEmpresa='$id' AND codigo=0";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $logo,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idEmpresa', $id);
			$this->db->where('codigo', 0);
			$this->db->update('Imgs_temp_empresas', $data);
		} else {
			$this->db->insert('Imgs_temp_empresas', array(
				'codigo' => 0,
				'nombre' => $logo,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s'),
				'idEmpresa' => $id
			));
		}
		$this->db->trans_complete();
	}

	public function update_logo($id, $logo) {
		$this->db->trans_start();
		$data = array(
			'logo' => $logo
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'estado' => 1
		);
		$this->db->where('idEmpresa', $id);
		$this->db->where('nombre', $logo);
		$this->db->update('Imgs_temp_empresas', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function update_rut($id, $rut) {
		$this->db->trans_start();
		$data = array(
			'rut' => $rut
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'estado' => 1
		);
		$this->db->where('idEmpresa', $id);
		$this->db->where('nombre', $rut);
		$this->db->update('Imgs_temp_empresas', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function update_camara($id, $camara) {
		$this->db->trans_start();
		$data = array(
			'camaracomercio' => $camara
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'estado' => 1
		);
		$this->db->where('idEmpresa', $id);
		$this->db->where('nombre', $camara);
		$this->db->update('Imgs_temp_empresas', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function update_pdf($id, $pdf) {
		$this->db->trans_start();
		$data = array(
			'pdf' => $pdf
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'estado' => 1
		);
		$this->db->where('idEmpresa', $id);
		$this->db->where('nombre', $pdf);
		$this->db->update('Imgs_temp_empresas', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function reprobar_doc($id, $ndoc) {
		$this->db->trans_start();
		$data = array(
			'activo' => 2
		);
		$data1 = array(
			'estado' => 2
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$this->db->where('idEmpresa', $id);
		$this->db->where('nombre', $ndoc);
		$this->db->update('Imgs_temp_empresas',$data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function upload_rut($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM Imgs_temp_empresas WHERE idEmpresa='$id' AND codigo=1";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idEmpresa', $id);
			$this->db->where('codigo', 1);
			$this->db->update('Imgs_temp_empresas', $data);
		} else {
			$this->db->insert('Imgs_temp_empresas', array(
				'idEmpresa' => $id,
				'codigo' => 1,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
	}

	public function upload_camara($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM Imgs_temp_empresas WHERE idEmpresa='$id' AND codigo=2";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idEmpresa', $id);
			$this->db->where('codigo', 2);
			$this->db->update('Imgs_temp_empresas', $data);
		} else {
			$this->db->insert('Imgs_temp_empresas', array(
				'idEmpresa' => $id,
				'codigo' => 2,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
	}

	public function upload_empresa_pdf($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM Imgs_temp_empresas WHERE idEmpresa='$id' AND codigo=3";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idEmpresa', $id);
			$this->db->where('codigo', 3);
			$this->db->update('Imgs_temp_empresas', $data);
		} else {
			$this->db->insert('Imgs_temp_empresas', array(
				'idEmpresa' => $id,
				'codigo' => 3,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
	}

	public function get_personal($idempresa) {
		$SqlInfo = "select t1.idUser,t1.nombre,t1.apellidos,t1.tipo_doc,t1.cedula,t1.email,"
						. "t1.usuario,t1.direccion,t1.telefono,t1.celular,t1.licencia_conduccion,"
						. "t1.fecha_creacion,t1.ranking,t1.permisos,t1.activo,t2.nombre_ciudad "
						. "FROM Users t1 "
						. "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
						. "WHERE t1.idEmpresa='$idempresa' AND t1.permisos = 1 ";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_personal_noadmin($idempresa) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto FROM Users t1 JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad JOIN Departamentos t3 ON t1.idDepartamento=t3.idDepartamento WHERE t1.idEmpresa='$idempresa' AND t1.permisos != 0 AND t1.activo = 1";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_personal_empxid($id) {

		$SqlInfo = "select * FROM Users WHERE idEmpresa='$id'";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_administrador($id) {

		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto FROM Users t1 JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad JOIN Departamentos t3 ON t1.idDepartamento=t3.idDepartamento WHERE t1.idEmpresa='$id' AND t1.permisos = 0";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function get_empxid($id) {
		$consulta = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto FROM Empresas t1 JOIN Ciudades t2 ON t2.idCiudad=t1.idCiudad JOIN Departamentos t3 ON t3.idDepartamento=t1.departamentos_id WHERE t1.idEmpresa='$id'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function get_empxid_app($id) {
		$consulta = "select * from Empresas where idEmpresa = (select idEmpresa FROM Users WHERE usuario=$id)";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function get_empresa_xnit($nit) {
		$consulta = "select t1.*,t2.nombre_ciudad FROM Empresas t1
         JOIN Ciudades t2 ON t2.idCiudad=t1.idCiudad WHERE t1.nit='$nit'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_empresa_xid_carga($idCarga) {
		$consulta = "select t1.idUser,t2.nombre,t2.apellidos"
                        . " FROM OfertasCarga t1 JOIN Users t2 ON"
                        . " t2.idUser=t1.idUser WHERE t1.idOfertaCarga='$idCarga'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function get_docs_temp_empxid($id) {
		$consulta = "select * FROM Imgs_temp_empresas  WHERE idEmpresa='$id'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function adquirir_licencia() {
		$session_data = $this->session->userdata('datos_usuario');
		$idempresa = $session_data['idempresa'];
		$this->db->trans_start();
		$consulta = "SELECT or_codigo_lic FROM ordenes_empresa WHERE or_idEmpresa='$idempresa'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $value) {
				$cod_lic = $value->or_codigo_lic;
			}
		} if ($cod_lic != $this->input->post('codigo')) {

			if ($this->input->post('codigo') == 'ELE-2') {
				$dt_2MesesDespues = date('Y-m-d', strtotime('+2 month'));
				$data = array(
					'activo' => 1,
					'updated_at' => date('Y-m-d H:i:s'),
					'vence' => $dt_2MesesDespues
				);
				$this->db->where('idEmpresa', $idempresa);
				$this->db->update('Empresas', $data);
			}

			if ($this->input->post('codigo') == 'ELE-1') {
				$dt_1MesDespues = date('Y-m-d', strtotime('+1 month'));
				$data = array(
					'activo' => 1,
					'updated_at' => date('Y-m-d H:i:s'),
					'vence' => $dt_1MesDespues
				);
				$this->db->where('idEmpresa', $idempresa);
				$this->db->update('Empresas', $data);
			}

			if ($this->input->post('codigo') == 'ELE-12') {
				$dt_12MesesDespues = date('Y-m-d', strtotime('+12 month'));
				$data = array(
					'activo' => 1,
					'updated_at' => date('Y-m-d H:i:s'),
					'vence' => $dt_12MesesDespues
				);
				$this->db->where('idEmpresa', $idempresa);
				$this->db->update('Empresas', $data);
			}

			$arr = array(
				'or_idEmpresa' => $idempresa,
				'or_codigo_lic' => $this->input->post('codigo'),
				'or_precio_lic' => $this->input->post('precio'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->db->insert('ordenes_empresa', $arr);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function activar_licencia() {

		$id_emp = $this->input->post('idEmpresa');
		$data = array(
			'activo' => 2,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id_emp);
		$this->db->update('Empresas', $data);

		/* $arr = array(
		  'com_idEmpresa' => $id_emp,
		  'com_id_orden' => $this->input->post('id_orden'),
		  'com_pagada' => 1,
		  'created_at' => date('Y-m-d H:i:s')
		  );
		  $this->db->insert('compras_empresa', $arr); */
	}

	public function apto_licencia($id) {
		$this->db->trans_start();
		$data = array(
			'activo' => 5,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data = array(
			'activo' => 1,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Users', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function bloquear($id) {
		$this->db->trans_start();
		$data = array(
			'activo' => 4,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'activo' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function desbloquear($id) {
		$this->db->trans_start();
		$data = array(
			'activo' => 5,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
		$data1 = array(
			'activo' => 1,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $id);
		$this->db->where('permisos', '0');
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return true;
		} else {
			return false;
		}
	}

	public function bloquear_usuario($id) {
		$data = array(
			'activo' => 3,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function activar_usuario($id) {
		$data = array(
			'activo' => 1,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}
