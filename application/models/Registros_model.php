<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Registros_model extends CI_Model {

	public function add_user($user, $data) {
		$query = $this->db->get_where('Users', array('usuario' => $user));
		if ($query->num_rows() > 0) {
			return false;
		} else {
			$this->db->insert("Users", $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return 0;
			}
		}
	}

	public function add_conductor_app($nombre, $apellidos, $telefono, $email, $usuario, $pass, $code) {
		$query = $this->db->get_where('Users', array('usuario' => $usuario));
		if ($query->num_rows() > 0) {
			return FALSE;
		} else {

			$this->db->insert("Users", array(
				'nombre' => $nombre,
				'apellidos' => $apellidos,
				'email' => $email,
				'telefono' => $telefono,
				'idNivel' => '3',
				'usuario' => $usuario,
				'pass' => md5($pass),
				'codigo' => $code,
				'estado' => '3',
				'permisos' => '3',
				'tipo' => '3',
				'activo' => '2',
				'fecha_creacion' => date('Y-m-d H:i:s')
			));

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function add_empresa_app($empresa, $siglas, $telefono, $email, $usuario, $pass, $code) {

		$this->db->select_max('idEmpresa');
		$consult = $this->db->get('Empresas');
		if ($consult->num_rows() > 0) {
			foreach ($consult->result() as $row) {
				$id_emp = $row->id + 1;
			}
		}
		$query = $this->db->get_where('Empresas', array('nit' => $usuario));
		if ($query->num_rows() > 0) {
			return FALSE;
		} else {

			$this->db->insert("Empresas", array(
				'nombre_empresa' => $empresa,
				'siglas' => $siglas,
				'nit' => $usuario,
				'email' => $email,
				'telefono' => $telefono,
				'created_at' => date('Y-m-d H:i:s')
			));

			$this->db->insert("Users", array(
				'email' => $email,
				'telefono' => $telefono,
				'idNivel' => '1',
				'usuario' => $usuario,
				'pass' => md5($pass),
				'codigo' => $code,
				'estado' => '3',
				'activo' => '2',
				'idEmpresa' => $id_emp,
				'permisos' => '3',
				'fecha_creacion' => date('Y-m-d H:i:s')
			));

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function add_reg_emp($nit, $dataEmp, $dataUser) {
		$query = $this->db->get_where('Empresas', array('nit' => $nit));
		if ($query->num_rows() > 0) {
			return false;
		} else {
			$this->db->insert("Empresas", $dataEmp);
			$this->db->insert("Users", $dataUser);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return 0;
			}
		}
	}

	public function add_user_empresa($usuarioemp, $data) {
		$query = $this->db->get_where('Users', array('usuario' => $usuarioemp));

		if ($query->num_rows() > 0) {
			return FALSE;
		} else {
			$this->db->insert("Users", $data);
			if ($this->db->affected_rows() > 0) {
				return TRUE;
			} else {
				return 0;
			}
		}
	}

	public function very($code) {
		$consulta = $this->db->get_where('Users', array('codigo' => $code));

		if ($consulta->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function re_password() {
		$user = $this->input->post('username');
		$consulta = $this->db->get_where('Users', array('usuario' => $user));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function new_password() {
		$id = $this->input->post('id');
		$str = $this->input->post('password');
		$this->db->where('idUser', $id);
		$this->db->update('Users', array('pass' => md5($str), 'estado' => 1));
	}

	public function very_estado_admin($usuario, $passw) {
		$consulta = $this->db->get_where('Users', array('usuario' => $usuario,
			'pass' => md5($passw), 'idNivel' => '1'));

		if ($consulta->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function very_estado_empresa($usuario, $passw) {
		$consulta = $this->db->get_where('Users', array('usuario' => $usuario,
			'pass' => md5($passw), 'idNivel' => '2', 'estado' => '1', 'activo !=' => '3'));

		if ($consulta->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function very_estado_conductor($usuario, $passw) {
		$consulta = $this->db->get_where('Users', array('usuario' => $usuario,
			'pass' => md5($passw), 'idNivel' => '3', 'estado' => '1', 'activo !=' => '3'));
		if ($consulta->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function very_estado_gps() {
		$consulta = $this->db->get_where('Users', array('usuario' => $this->input->post('username', TRUE),
			'pass' => md5($this->input->post('password', TRUE)), 'idNivel' => '4', 'estado' => '1', 'activo !=' => '3'));

		if ($consulta->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_user($code) {
		$this->db->where('codigo', $code);
		$this->db->update('Users', array('estado' => '1'));
	}

	public function registros_ult_sem() {
		$query = 'SELECT * FROM Users WHERE WEEK(fecha_creacion)=WEEK(curdate())';
		$consulta = $this->db->query($query);
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function registros_sin_val() {

		$consulta = $this->db->get_where('Users', array('activo' => '0')); // get query result

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function registros_val() {

		$consulta = $this->db->get_where('Users', array('activo' => '1')); // get query result

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function buscar_val($user) {

		$consulta = $this->db->get_where('Users', array('usuario' => $user)); // get query result

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function get_registroxid_ult_sem($id) {

		$consulta = $this->db->get_where('Users', array('idUser' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function activar_registro() {
		$id = $this->input->post('id');
		$data = array(
			'activo' => 1,
			'fecha_activacion' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
	}

	public function activar_registro_emp($idemp) {
		$data = array(
			'activo' => 1,
			'fecha_activacion' => date('Y-m-d H:i:s')
		);
		$this->db->where('idEmpresa', $idemp);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function registros_completos() {

		$sql = "SELECT * FROM Users WHERE idNivel!='1' AND tipo_doc IS NOT NULL AND cedula IS NOT NULL AND fecha_nac IS NOT NULL AND sexo IS NOT NULL AND pais IS NOT NULL AND dpto IS NOT NULL AND ciudad IS NOT NULL AND direccion IS NOT NULL AND telefono IS NOT NULL AND celular IS NOT NULL AND licencia_conduccion IS NOT NULL AND categoria_lic IS NOT NULL AND fecha_ven_licencia IS NOT NULL AND pdf IS NOT NULL OR foto_cedula AND foto_licencia IS NOT NULL AND estado='1' ";
		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function pen_docs_empresa() {

		$sql = "SELECT * FROM Empresas WHERE rut IS NULL OR camaracomercio IS NULL OR pdf IS NULL ";
		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function pend_docs_vehiculos() {

		$sql = "SELECT * FROM Vehiculos WHERE soat AND rtecnomecanica AND licenciatransito AND cedulapropietario AND rutpropietario AND carnetafiliacion IS NULL OR pdf IS NULL ";
		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function pend_docs_conductores() {

		$sql = "SELECT * FROM Users WHERE foto_cedula IS NULL AND foto_licencia IS NULL OR pdf IS NULL AND nivel='3'";
		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {

			print 'no results';
		}
	}

	public function get_pendocsxid($id) {

		$consulta = $this->db->get_where('Users', array('idUser' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_pendocs_vehiculoxid($id) {

		$consulta = $this->db->get_where('Vehiculos', array('idVehiculo' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_pendocs_emp_xid($id) {

		$consulta = $this->db->get_where('Empresas', array('idEmpresa' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function validar_email($id) {
		$data = array(
			'estado' => 1,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function eliminar_usuario($id) {
		$this->db->delete('Users', array('idUser' => $id));
	}

	public function search() {
		$cadena = $this->input->post("buscar");
		$this->db->like('usuario', $cadena, 'both');
		$this->db->or_like('usuario', $cadena, 'before');
		$this->db->or_like('usuario', $cadena, 'after');

		$consulta = $this->db->get('Users');

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function subir_foto_cc_user($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'foto_cedula' => $imagen
		);

		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
	}

	public function subir_foto_lic_user($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'foto_licencia' => $imagen
		);

		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
	}

	public function subir_pdf_user($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'pdf' => $imagen
		);

		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);
	}

	public function subir_logo($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'logo' => $imagen
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
	}

	public function subir_rut($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'rut' => $imagen
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
	}

	public function subir_camaracomercio($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'camaracomercio' => $imagen
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
	}

	public function subir_pdf_emp($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'pdf' => $imagen
		);

		$this->db->where('idEmpresa', $id);
		$this->db->update('Empresas', $data);
	}

	public function subir_soat($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'soat' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_rtecno($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'rtecnomecanica' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_ltransito($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'licenciatransito' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_ccprop($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'cedulapropietario' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_rutprop($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'rutpropietario' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_carnet($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'carnetafiliacion' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function subir_pdf_vehiculo($imagen) {
		$id = $this->input->post('id');
		$data = array(
			'pdf' => $imagen
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function get_perxid($id) {

		$SqlInfo = "select t1.*, t2.nombre_ciudad "
						. "FROM Users t1 "
						. "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
						. "WHERE t1.idUser='$id' ";
		$consulta = $this->db->query($SqlInfo);
//		$consulta = $this->db->get_where('Users', array('idUser' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->row();
		} else {
			return [];
		}
	}

	public function tipoPropietario($id) {
		$data = array(
			'tipo' => 2,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->db->where('idUser', $id);
		$this->db->update('Users', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
