<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Conductores_model extends CI_Model {

	public function get_all_conductores() {

		$consulta = $this->db->get_where('Users', array('idNivel' => '3'));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_trans_conductores() {

		$consulta = $this->db->get_where('Users', array('idNivel' => 3, 'tipo' => 1));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_trans_propietarios() {

		$consulta = $this->db->get_where('Users', array('idNivel' => 3, 'tipo' => 3));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_trans_propconductores() {

		$consulta = $this->db->get_where('Users', array('idNivel' => 3, 'tipo' => 2));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_conductores() {
		$SqlInfo = "select t1.idUser,t1.nombre,t1.apellidos, t1.direccion,"
						. " t1.telefono, t1.celular,t1.licencia_conduccion,t1.ranking,"
						. "t1.categoria_lic,t1.vehiculo_asignado,t1.verhv,"
						. "t2.nombre_ciudad FROM Users t1, Ciudades t2"
						. " WHERE t1.idNivel='3' AND t1.activo='1' AND"
						. " t2.idCiudad=t1.ciudad AND t1.vehiculo_asignado IS NULL";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function get_conductores_contratados() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$SqlInfo = "select t1.idUser,t1.nombre,t1.apellidos, t1.direccion,"
						. " t1.telefono, t1.celular,t1.licencia_conduccion,"
						. "t1.fecha_creacion,t1.Assign_idUser,t1.ranking,"
						. "t2.nombre_ciudad FROM Users t1, Ciudades t2  WHERE"
						. " t1.idNivel='3' AND t1.Assign_idUser='$usuario' AND"
						. " t2.idCiudad=t1.ciudad ";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function contratar_conductor() {
		$id = $this->input->post('id');
		$vehiculo = $this->input->post('vehiculo');
		$data1 = array(
			'Assign_idUser' => $_SESSION['usuario'],
			'vehiculo_asignado' => $vehiculo
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);

		$data2 = array(
			'estado' => 'Asignado',
			'conductor_id' => $id
		);
		$this->db->where('placa', $vehiculo);
		$this->db->update('Vehiculos', $data2);

		$data3 = array(
			'estado' => 'Contratado'
		);
		$this->db->where('idUser', $id);
		$this->db->update('AplicacionesEmpleo', $data3);
	}

	public function finalizar_contrato_conductor() {
		$id = $this->input->post('id');
		$vehiculo = $this->input->post('vehiculo');
		$data = array(
			'Assign_idUser' => NULL,
			'vehiculo_asignado' => NULL
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);

		$datos = array(
			'estado' => 'libre',
			'conductor_id' => NULL
		);
		$this->db->where('placa', $vehiculo);
		$this->db->update('Vehiculos', $datos);

		$data3 = array(
			'estado' => 'NULL'
		);
		$this->db->where('idUser', $id);
		$this->db->update('AplicacionesEmpleo', $data3);
	}

	public function get_edad() {
		$query = "SELECT Users.id, YEAR(CURDATE())-YEAR(Users.fecha_nac) +"
						. " IF(DATE_FORMAT(CURDATE(),'%m-%d') >"
						. " DATE_FORMAT(Users.fecha_nac,'%m-%d'), 0, -1) AS EDAD_ACTUAL"
						. " FROM Users WHERE Users.idNivel='3'";
		$consulta = $this->db->query($query);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_conductor_xid($id) {
		$query = "SELECT t1.*,t2.nombre_ciudad,t4.nombre_dpto,t3.nombre_pais "
						. "FROM Users t1 "
						. "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
						. "JOIN Paises t3 ON t1.idPais=t3.idPais "
						. "JOIN Departamentos t4 ON t1.idDepartamento=t4.idDepartamento "
						. "WHERE t1.idUser='$id' ";
		$consulta = $this->db->query($query);

		if ($consulta->num_rows() > 0) {
			return $consulta->row();
		} else {
			return FALSE;
		}
	}

	public function delete_conductor_xid($id) {
		$this->db->delete('sf_guard_user_profile_re', array('userhv_id' => $id));
		$this->db->delete('sf_guard_user_profile_rp', array('userhv_id' => $id));
		$this->db->delete('Vehiculos', array('user_id' => $id));
		$this->db->delete('Users', array('id' => $id));
	}

	public function get_conductor_xcc($cc) {
		$query = "SELECT t1.*,t2.nombre_ciudad,t4.nombre_dpto,t3.nombre_pais"
						. " FROM Users t1 JOIN Ciudades t2 ON t1.ciudad=t2.idCiudad"
						. " JOIN Paises t3 ON t1.pais=t3.idPais JOIN Departamentos t4"
						. " ON t1.dpto=t4.idDepartamento  WHERE t1.usuario='$cc'";
		$consulta = $this->db->query($query);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function pend_docs_conductor($cc) {

		$sql = "SELECT * FROM Users WHERE usuario='$cc' AND foto_cedula IS NULL"
						. " AND foto_licencia IS NULL OR pdf IS NULL AND idNivel='3'";
		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function add_conductor() {

		$this->db->insert("Users", array(
			'nombre' => $this->input->post("firstName", TRUE),
			'apellidos' => $this->input->post("lastName", TRUE),
			'tipo_doc' => $this->input->post("tipo_doc", TRUE),
			'email' => $this->input->post("email", TRUE),
			'cedula' => $this->input->post('cc'),
			'fecha_nac' => $this->input->post('theDate'),
			'estado_civil' => $this->input->post('est_civil'),
			'sexo' => $this->input->post('gender'),
			'pais' => 1,
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'celular' => $this->input->post('celphone'),
			'tipo_vivienda' => $this->input->post('tipo_vivienda'),
			'meses_vivienda' => $this->input->post('meses_vivienda'),
			'licencia_conduccion' => $this->input->post('licencia'),
			'categoria_lic' => $this->input->post('categoria_lic'),
			'fecha_ven_licencia' => $this->input->post('theDatev'),
			'idNivel' => '3',
			'usuario' => $this->input->post('usuario'),
			'pass' => md5($this->input->post('password')),
			'fecha_creacion' => date('Y-m-d H:i:s')
		));

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_conductor($data, $id) {
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_lic($id, $imagen) {
		$this->db->trans_start();
		$data = array(
			'estado' => 1,
			'obsv' => 'Aprobada',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->where('codigo', 1);
		$this->db->update('Imgs_temp_users', $data);
		$data1 = array(
			'foto_licencia' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_cedula($id, $imagen) {
		$this->db->trans_start();
		$data = array(
			'estado' => 1,
			'obsv' => 'Aprobada',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->where('codigo', 0);
		$this->db->update('Imgs_temp_users', $data);
		$data1 = array(
			'foto_cedula' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_pdf($id, $imagen) {
		$this->db->trans_start();
		$data = array(
			'estado' => 1,
			'obsv' => 'Aprobado',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->where('codigo', 2);
		$this->db->update('Imgs_temp_users', $data);
		$data1 = array(
			'pdf' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_foto_perfil($id, $imagen) {
		$this->db->trans_start();
		$data = array(
			'estado' => 1,
			'obsv' => 'Aprobada',
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->where('codigo', 3);
		$this->db->update('Imgs_temp_users', $data);
		$data1 = array(
			'foto_ruta' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_cedula($id, $imagen) {
		$data1 = array(
			'foto_cedula' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_lic($id, $imagen) {
		$data = array(
			'foto_licencia' => $imagen,
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

	public function update_pdf($id, $imagen) {
		$data1 = array(
			'pdf' => $imagen,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data1);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_perfil($id, $imagen) {
		$data = array(
			'foto_ruta' => $imagen,
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

	public function get_vehiculo_asignado() {
		$session_data = $this->session->userdata('datos_usuario');
		$idusuario = $session_data['id'];
		$query = "SELECT * FROM Users WHERE idUser='$idusuario' AND vehiculo_asignado"
						. " IS NOT NULL";
		$consulta = $this->db->query($query);
		if ($consulta->num_rows() > 0) {
			return $consulta->row();
		} else {
			return FALSE;
		}
	}

	public function get_vehiculo_conductor_app($user) {
		$query = "SELECT vehiculo_asignado FROM Users WHERE usuario='$user'"
						. " AND vehiculo_asignado IS NOT NULL";
		$consulta = $this->db->query($query);
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_vehiculo_asignado_app($id) {
		$query = "SELECT * FROM Vehiculos WHERE conductor_id='$id'";
		$consulta = $this->db->query($query);
		if ($consulta->num_rows() > 0) {
			return $consulta->row();
		} else {
			return FALSE;
		}
	}

	public function edit_foto_perfil($id, $imagen) {
		$consulta = "SELECT * FROM Imgs_temp_users WHERE idUser='$id' AND codigo=3";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idUser', $id);
			$this->db->where('codigo', 3);
			$this->db->update('Imgs_temp_users', $data);
		} else {
			$this->db->insert('Imgs_temp_users', array(
				'idUser' => $id,
				'codigo' => 3,
				'nombre' => $imagen,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
	}

	public function edit_foto_cedula($id, $imagen) {
		$consulta = "SELECT * FROM Imgs_temp_users WHERE idUser='$id' AND codigo=0";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idUser', $id);
			$this->db->where('codigo', 0);
			$this->db->update('Imgs_temp_users', $data);
		} else {
			$this->db->insert('Imgs_temp_users', array(
				'idUser' => $id,
				'codigo' => 0,
				'nombre' => $imagen,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
	}

	public function edit_foto_lic($id, $imagen) {
		$consulta = "SELECT * FROM Imgs_temp_users WHERE idUser='$id' AND codigo=1";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idUser', $id);
			$this->db->where('codigo', 1);
			$this->db->update('Imgs_temp_users', $data);
		} else {
			$this->db->insert('Imgs_temp_users', array(
				'idUser' => $id,
				'codigo' => 1,
				'nombre' => $imagen,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
	}

	public function edit_pdf($id, $imagen) {
		$consulta = "SELECT * FROM Imgs_temp_users WHERE idUser='$id' AND codigo=2";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'obsv' => 'Pendiente de aprovación',
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idUser', $id);
			$this->db->where('codigo', 2);
			$this->db->update('Imgs_temp_users', $data);
		} else {
			$this->db->insert('Imgs_temp_users', array(
				'idUser' => $id,
				'codigo' => 2,
				'nombre' => $imagen,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
	}

	public function apto_licencia($id) {
		$data = array(
			'activo' => '1',
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

	public function reprobar_doc($id, $ndoc) {
		$this->db->trans_start();
		$data = array(
			'activo' => 0,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$data1 = array(
			'estado' => 2
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
		$this->db->where('idUser', $id);
		$this->db->where('nombre', $ndoc);
		$this->db->update('Imgs_temp_users',$data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			return true;
		} else {
			return false;
		}
	}

	public function get_docs_temp($id) {
		$SqlInfo = "select * FROM Imgs_temp_users WHERE idUser='$id'"
						. " AND estado = 0";
		$query1 = $this->db->query($SqlInfo);
		if ($query1->num_rows() > 0) {
			return $query1->result();
		} else {

			return false;
		}
	}

}
