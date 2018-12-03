<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 */
class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_Users() {
		$query = $this->db->get('Users');
		if ($query->num_rows() != 0) {
			return $query->result();
		} else {

			return false;
		}
	}

	public function get_user_xusu($xusu) {
		$query = $this->db->get_where('Users', array('usuario' => $xusu));
		if ($query->num_rows() != 0) {
			return $query->row(); //retorna 1 sola fila
		} else {
			return FALSE;
		}
	}

	public function get_Usersxdoc($user_id) {
		$query = $this->db->get_where('Users', array('cedula' => $user_id));
		if ($query->num_rows() != 0) {
			return $query->result();
		} else {

			return FALSE;
		}
	}

	public function get_perfil($usuario) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto,t4.nombre_pais"
						. " FROM Users t1 JOIN Ciudades t2 ON t2.idCiudad=t1.idCiudad JOIN"
						. " Departamentos t3 ON t1.idDepartamento=t3.idDepartamento JOIN Paises t4 ON"
						. " t1.idPais=t4.idPais"
						. " WHERE t1.usuario='$usuario'";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() != 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	public function get_perfil_app($user) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto,t4.nombre_pais "
						. "FROM Users t1 "
						. "JOIN Ciudades t2 ON t2.idCiudad=t1.idCiudad "
						. "JOIN Departamentos t3 ON t1.idDepartamento=t3.idDepartamento "
						. "JOIN Paises t4 ON t1.idPais=t4.idPais "
						. "WHERE t1.usuario='$user'";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() != 0) {
			return $query->row();
		}
	}

	public function get_perfilxid($id) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_dpto FROM Users t1 JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad JOIN Departamentos t3 ON t1.idDepartamento=t3.idDepartamento WHERE t1.idUser='$id'";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() != 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_perfil_completo($usuario) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t1.tipo_doc "
						. "FROM Users t1 "
						. "JOIN Ciudades t2 ON t2.idCiudad=t1.idCiudad  "
						. "WHERE t1.usuario='$usuario'";
		//JOIN tipo_documento t3 ON t1.tipo_doc=t3.id
		$query = $this->db->query($SqlInfo);

//		var_dump($this->db->last_query());
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			print 'no results';
		}
	}

	public function get_edad($usuario) {
		$query = "SELECT Users.usuario, YEAR(CURDATE())-YEAR(Users.fecha_nac) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(Users.fecha_nac,'%m-%d'), 0, -1) AS EDAD_ACTUAL FROM Users WHERE Users.usuario='$usuario'";
		$consulta = $this->db->query($query);
		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function update_perfil($data, $usuario) {


		$this->db->where('usuario', $usuario);
		$this->db->update('Users', $data);

		//var_dump($this->db->last_query());
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_personal() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$data = array(
			'nombre' => $this->input->post('firstName'),
			'apellidos' => $this->input->post('lastName'),
			'tipo_doc' => $this->input->post('tipo_doc'),
			'cedula' => $this->input->post('cc'),
			'fecha_nac' => $this->input->post('theDate'),
			'sexo' => $this->input->post('gender'),
			'pais' => 1,
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'id_empresa' => $this->input->post('id_empresa'),
		);

		$this->db->where('usuario', $usuario);
		$this->db->update('Users', $data);
	}

	public function update_perfilxid($data, $idempleado) {
		$this->db->where('idUser', $idempleado);
		$this->db->update('Users', $data);

		//echo $this->db->last_query();

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_tipo($id, $tipo) {

		$data = array(
			'tipo' => $tipo
		);
		$this->db->where('id', $id);
		$this->db->update('Users', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_user_pdf($imagen) {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$data = array(
			'pdf' => $imagen
		);

		$this->db->where('usuario', $usuario);
		$this->db->update('Users', $data);
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

	public function get_doc() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$this->db->select('foto_cedula');
		$this->db->where('usuario', $usuario);
		$this->db->from('Users');
		$query = $this->db->get();
		if ($query->num_rows() != 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function obtenerPendDocs() {
		$Qsql = "SELECT * FROM Users WHERE  foto_cedula IS NULL AND foto_licencia IS NULL OR pdf IS NULL AND idNivel='3' AND idNivel='4' AND idNivel!='0'";
		$consult = $this->db->query($Qsql);
		$count2 = $consult->num_rows(); //get current query record.
		$Qsql1 = "SELECT * FROM Empresas WHERE rut AND camaracomercio IS NULL OR pdf IS NULL ";
		$consult1 = $this->db->query($Qsql1);
		$count3 = $consult1->num_rows(); //get current query record.
		$Qsql2 = "SELECT * FROM Vehiculos WHERE soat AND rtecnomecanica AND licenciatransito AND cedulapropietario AND rutpropietario AND carnetafiliacion  IS NULL OR pdf IS NULL";
		$consult2 = $this->db->query($Qsql2);
		$count4 = $consult2->num_rows(); //get current query record.
		$totalPenDocs = $count2 + $count3 + $count4;
		return $totalPenDocs;
	}

	public function obtenerCompletos() {
		$Qsql1 = "SELECT * FROM Users "
						. "WHERE idNivel!='0' "
						. "AND tipo_doc IS NOT NULL "
						. "AND cedula IS NOT NULL "
						. "AND fecha_nac IS NOT NULL "
						. "AND sexo IS NOT NULL "
						. "AND idPais IS NOT NULL "
						. "AND idDepartamento IS NOT NULL "
						. "AND idCiudad IS NOT NULL "
						. "AND direccion IS NOT NULL "
						. "AND telefono IS NOT NULL "
						. "AND celular IS NOT NULL "
						. "AND licencia_conduccion IS NOT NULL "
						. "AND categoria_lic IS NOT NULL "
						. "AND fecha_ven_licencia IS NOT NULL "
						. "AND pdf IS NOT NULL OR foto_cedula "
						. "AND foto_licencia IS NOT NULL "
						. "AND estado='1'  ";
		$consul = $this->db->query($Qsql1);
	}

	public function add_user() {
		$this->db->insert("Users", array(
			'nombre' => $this->input->post('firstName'),
			'apellidos' => $this->input->post('lastName'),
			'tipo_doc' => $this->input->post('tipo_doc'),
			'cedula' => $this->input->post('cc'),
			'fecha_nac' => $this->input->post('theDate'),
			'estado_civil' => $this->input->post('est_civil'),
			'sexo' => $this->input->post('gender'),
			'idPais' => 1,
			'idDepartamento' => $this->input->post('provincia'),
			'idCiudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'tipo_vivienda' => $this->input->post('vivienda'),
			'meses_vivienda' => $this->input->post('meses_vivienda'),
			'licencia_conduccion' => $this->input->post('licencia_conduccion'),
			'categoria_lic' => $this->input->post('categoria_lic'),
			'fecha_ven_licencia' => $this->input->post('theDatev'),
			'usuario' => $this->input->post('usuario'),
			'pass' => md5($this->input->post('contraseña')),
			'nivel' => $this->input->post('nivel'),
			/* 'activo' => $this->input->post("activo", TRUE), */
			'fecha_creacion' => date('Y-m-d H:i:s')
		));

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_personalxempresa($data, $usuario) {


		$this->db->where('idUser', $usuario);
		$this->db->update('Users', $data);

		//var_dump($this->db->last_query());
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_lic() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$this->db->select('foto_licencia');
		$this->db->where('usuario', $usuario);
		$this->db->from('Users');
		$query = $this->db->get();
		if ($query->num_rows() != 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function obtenerUsersNuevos() {
		$sqlQ = 'SELECT * FROM Users WHERE WEEK(fecha_creacion)=WEEK(curdate())';
		$cons = $this->db->query($sqlQ);
		$count = $cons->num_rows(); //get current query record.
		return $count;
	}

	public function obtenerUsersInactivos() {
		$sql = "SELECT * FROM Users WHERE activo='0'";
		$consulta = $this->db->query($sql);
		$activos = $consulta->num_rows(); //get current query record.
		return $activos;
	}

	public function obtenerUsersActivos() {
		$sql = "SELECT * FROM Users WHERE activo='1' AND idNivel!='0'";
		$consulta = $this->db->query($sql);
		$activos = $consulta->num_rows(); //get current query record.
		return $activos;
	}

	public function obtenerPendValidarEmail() {
		$sql = "SELECT * FROM Users WHERE estado='0'";
		$consulta = $this->db->query($sql);
		$pendEmail = $consulta->num_rows(); //get current query record.
		return $pendEmail;
	}

	public function totalEmpresas() {
		$sql = "SELECT * FROM Empresas";
		$consulta = $this->db->query($sql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

	public function totalTransp() {
		$sql = "SELECT * FROM Users WHERE idNivel='3'";
		$consulta = $this->db->query($sql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

	public function totalVehiculos() {
		$sql = "SELECT * FROM Vehiculos";
		$consulta = $this->db->query($sql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

	public function totalGps() {
		$sql = "SELECT * FROM Users WHERE idNivel='4'";
		$consulta = $this->db->query($sql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

}
