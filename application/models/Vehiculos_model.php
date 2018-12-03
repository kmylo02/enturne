<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vehiculos_model extends CI_Model {

	public function get_all_vehiculos() {

		$SqlInfo = "select t2.*,t3.nombre_tv,t4.nombre_carr,t5.usuario,t5.nombre,t5.apellidos,t5.email,t5.nivel FROM Vehiculos t2 JOIN Users t5 ON t2.user_id=t5.id JOIN df_camiones_configuracion t3 ON t2.tipo_vehiculo_id=t3.id JOIN df_camiones_carroceria t4 ON t2.carroceria_id=t4.id";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function get_all_vehiculos_activos() {

		$SqlInfo = "select t2.*,t3.nombre_tv,t4.nombre_carr,t5.usuario,t5.nombre,"
						. "t5.apellidos,t5.idNivel "
						. "FROM Vehiculos t2 "
						. "JOIN Users t5 ON t2.idUser=t5.idUser "
						. "JOIN TipoVehiculos t3 ON t2.idTipoVehiculo=t3.idTipoVehiculo "
						. "JOIN CamionesCarrocerias t4 ON t2.idCamionesCarroceria=t4.idCamionesCarroceria "
						. "WHERE t2.activo = 1";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function get_all_vehiculos_inactivos() {

		$SqlInfo = "select t2.*,t3.nombre_tv,t4.nombre_carr,t5.usuario,t5.nombre,"
						. "t5.apellidos,t5.idNivel "
						. "FROM Vehiculos t2 "
						. "JOIN Users t5 ON t2.idUser=t5.idUser "
						. "JOIN TipoVehiculos t3 ON t2.idTipoVehiculo=t3.idTipoVehiculo "
						. "JOIN CamionesCarrocerias t4 ON t2.idCamionesCarroceria=t4.idCamionesCarroceria "
						. "WHERE t2.activo != 1";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function get_vehiculos_x_propietario($id) {
		$SqlInfo = "select t1.*,t2.nombre_tv,t3.nombre_carr as carr,t4.nombre_carr as carr2,t5.nombre_ciudad "
						. "FROM Vehiculos t1 "
						. "JOIN TipoVehiculos t2 ON t1.idTipoVehiculo=t2.idTipoVehiculo "
						. "JOIN CamionesCarrocerias t3 ON t1.idCamionesCarroceria=t3.idCamionesCarroceria "
						. "JOIN CamionesCarrocerias t4 ON t1.idCamionesCarroceria2=t4.idCamionesCarroceria "
						. "JOIN Ciudades t5 ON t1.origen_id=t5.idCiudad "
						. "WHERE t1.idUser='$id' AND t1.activo !=5 ";


		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_vehiculos_activos_x_propietario($id) {
		$SqlInfo = "select t1.*,t2.nombre_tv,t3.nombre_carr "
						. "FROM Vehiculos t1 "
						. "JOIN TipoVehiculos t2 ON t1.idTipoVehiculo=t2.idTipoVehiculo "
						. "JOIN CamionesCarrocerias t3 ON t1.idCamionesCarroceria=t3.idCamionesCarroceria "
						. "WHERE t1.idUser='$id' "
						. "AND t1.activo = 1 ";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_vehiculos_satelital() {
		$SqlInfo = "select t1.*,t2.placa,t2.idVehiculo FROM sf_gps t1 JOIN Vehiculos t2 ON t1.vehiculo_id=t2.idVehiculo";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_vehiculos_x_propietario_satelital($id) {
		$SqlInfo = "select idVehiculo,placa FROM Vehiculos WHERE idUser='$id'";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

// public function get_vehiculos_x_propietario_disponibles($id)
// {
//$SqlInfo = "select t1.*,t2.nombre_tv,t3.nombre_carr FROM Vehiculos t1 JOIN df_camiones_configuracion t2 ON t1.tipo_vehiculo_id=t2.id JOIN df_camiones_carroceria t3 ON t1.carroceria_id=t3.id WHERE t1.user_id='$id' AND t1.activo = 1 AND t1.conductor_id IS NULL";
	public function get_vehiculos_x_propietario_disponibles($id) {
		$SqlInfo = "select t1.*,t2.nombre_tv,t3.nombre_carr FROM Vehiculos t1 JOIN TipoVehiculos t2 ON t1.idTipoVehiculo=t2.idTipoVehiculo JOIN CamionesCarrocerias t3 ON t1.idCamionesCarroceria=t3.idCamionesCarroceria WHERE t1.idUser='$id' AND t1.activo = 1 AND t1.conductor_id IS NULL";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_marca_vehiculo() {

		$this->db->order_by('nombre', 'asc');
		$marca = $this->db->get('MarcasVehiculos');
		if ($marca->num_rows() > 0) {
			return $marca->result();
		}
	}

	public function get_tipo_vehiculo() {
		$tipo = $this->db->get('TipoVehiculos');
		if ($tipo->num_rows() > 0) {
			return $tipo->result();
		} else {
			return false;
		}
	}

	public function get_carr_vehiculo() {
		$carr = $this->db->get('CamionesCarrocerias');
		if ($carr->num_rows() > 0) {
			return $carr->result();
		} else {
			return false;
		}
	}

	public function get_trailers() {

		$this->db->order_by('trailer_marca', 'asc');
		$marca = $this->db->get('Trailers');
		if ($marca->num_rows() > 0) {
			return $marca->result();
		}
	}

	public function get_vehiculo_xid($id) {
		$SqlInfo = "select t1.nombre_ciudad,t2.*,t3.nombre_tv,t4.nombre_carr,"
						. "t5.nombre as marcav,t6.nombre as nomprop,t6.apellidos as apeprop,"
						. "t6.cedula as cedp,t6.direccion as dirp,t6.celular as celp,"
						. "t6.email as mailp,t6.idEmpresa,t7.nombre_ciudad as ciudadp,"
						. "t8.nombre_aseguradora "
						. "FROM Vehiculos t2 "
						. "JOIN Ciudades t1 ON t1.idCiudad=t2.idCiudad "
						. "JOIN TipoVehiculos t3 ON t2.idTipoVehiculo=t3.idTipoVehiculo "
						. "JOIN CamionesCarrocerias t4 ON t2.idCamionesCarroceria=t4.idCamionesCarroceria "
						. "JOIN MarcasVehiculos t5 ON t2.idMarca=t5.idMarca "
						. "JOIN Users t6 ON t2.idUser=t6.idUser  "
						. "JOIN Ciudades t7 ON t6.idCiudad=t7.idCiudad "
						. "JOIN Aseguradoras t8 ON t8.idAseguradora=t2.idAseguradora "
						. "WHERE t2.idVehiculo='$id'";
		$query = $this->db->query($SqlInfo);
//		echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_vehiculo_xidconductor($id) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad,t3.nombre_tv,t4.nombre_carr,"
						. "t5.nombre as marcav,t6.nombre as nomprop,"
						. "t6.apellidos as apeprop,t6.celular as celp,"
						. "t6.direccion as dirp,t6.cedula as cedp,t6.idEmpresa,"
						. "t7.nombre_ciudad as ciudadp,t8.nombre_aseguradora,"
						. "t9.nombre_carr as ncarr2,t10.nombre_ciudad as ciudade"
						. " FROM Vehiculos t1"
						. " JOIN Ciudades t2"
						. " ON t1.idCiudad=t2.idCiudad"
						. " JOIN TipoVehiculos t3 ON"
						. " t1.idTipoVehiculo=t3.idTipoVehiculo JOIN CamionesCarrocerias t4 ON"
						. " t1.idCamionesCarroceria=t4.idCamionesCarroceria JOIN MarcasVehiculos t5 ON"
						. " t1.idMarca=t5.idMarca JOIN Users t6 ON t1.idUser=t6.idUser"
						. " JOIN Ciudades t7 ON t6.idCiudad=t7.idCiudad"
						. " JOIN Aseguradoras t8 ON t8.idAseguradora=t1.idAseguradora"
						. " JOIN CamionesCarrocerias t9 ON t9.idCamionesCarroceria=t1.idCamionesCarroceria2"
						. " JOIN Ciudades t10 ON t10.idCiudad=t1.origen_id"
						. "  WHERE t1.conductor_id='$id'";


//echo $SqlInfo;
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_vehiculo_xidUsuario($id) {
		$this->db->select('idVehiculo');
		$this->db->from('Vehiculos');
		$this->db->where('conductor_id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_datos_propietario($idVehiculo) {
		$SqlInfo = "select t1.placa,t2.nombre,t2.apellidos,t2.email "
						. "FROM Vehiculos t1 "
						. "JOIN Users t2 ON t1.idUser=t2.idUser "
						. "WHERE t1.idVehiculo='$idVehiculo'";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_datos_conductor($idVehiculo) {
		$SqlInfo = "select t1.placa,t2.nombre,t2.apellidos,t2.email FROM Vehiculos t1 JOIN Users t2 ON t1.conductor_id=t2.idUser WHERE t1.idVehiculo='$idVehiculo'";

		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_vehiculo_xenturne($id) {
		$SqlInfo = "select t1.*,t2.nombre_ciudad "
						. "FROM Vehiculos t1 "
						. "JOIN Ciudades t2 ON t1.origen_id=t2.idCiudad "
						. "WHERE t1.conductor_id='$id'";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_vehiculo_xplaca($placa) {
		$SqlInfo = "select t1.nombre_ciudad,t2.*,t3.nombre_tv,t4.nombre_carr,t6.nombre as marcav,t5.usuario,t5.nombre,t5.apellidos,t5.nivel FROM Vehiculos t2 JOIN Users t5 ON t2.user_id=t5.id JOIN df_ciudades t1 ON t1.id=t2.matriculado_ciudad_id JOIN df_camiones_configuracion t3 ON t2.tipo_vehiculo_id=t3.id JOIN df_camiones_carroceria t4 ON t2.carroceria_id=t4.id JOIN df_marcas_vehiculos t6 ON t2.marca=t6.id  WHERE t2.placa='$placa'";

		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function add_vehiculo($data) {
		$this->db->insert("Vehiculos", $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_vehiculo() {
		$id = $this->input->post('id');
		$data = array(
			'capacidad_carga' => $this->input->post("capacidad_carga", true),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
	}

	public function update_vehiculo_admin($idVehiculo, $data) {
		$this->db->where('idVehiculo', $idVehiculo);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_vehiculo_xid($id) {
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', array('activo' => 5));
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_docs_vehiculo($id) {
		$consulta = "select * FROM Vehiculos  WHERE idVehiculo='$id'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_docs_temp_vehiculo($id) {
		$consulta = "select * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND estado = 0 ";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function aprobar_soat($id, $soat) {
		$data = array(
			'soat' => $soat
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);
		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 0);
		$this->db->update('imgs_temp_vehiculo', $datat);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_soat($id, $soat) {
		$data = array(
			'soat' => $soat
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_soat($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=0";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 0);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 0,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_rtecno($id, $rtecno) {
		$data = array(
			'rtecnomecanica' => $rtecno
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 1);
		$this->db->update('imgs_temp_vehiculo', $datat);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_rtecno($id, $rtecno) {
		$data = array(
			'rtecnomecanica' => $rtecno
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_rtecno($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=1";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 1);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 1,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_lic_vehiculo($id, $lict) {
		$data = array(
			'licenciatransito' => $lict
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 2);
		$this->db->update('imgs_temp_vehiculo', $datat);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_lict($id, $lict) {
		$data = array(
			'licenciatransito' => $lict
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_lict($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=2";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 2);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 2,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_cedp($id, $cedp) {
		$data = array(
			'cedulapropietario' => $cedp
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 3);
		$this->db->update('imgs_temp_vehiculo', $datat);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_cedp($id, $cedp) {
		$data = array(
			'cedulapropietario' => $cedp
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_cedp($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=3";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 3);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 3,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_rutp($id, $rutp) {
		$data = array(
			'rutpropietario' => $rutp
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 4);
		$this->db->update('imgs_temp_vehiculo', $datat);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_rutp($id, $rutp) {
		$data = array(
			'rutpropietario' => $rutp
		);

		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_rutp($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=4";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 4);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 4,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_frontal($id, $frontal) {
		$data = array(
			'foto_frontal' => $frontal
		);
		$this->db->trans_start();
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 5);
		$this->db->update('imgs_temp_vehiculo', $datat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_frontal($id, $frontal) {
		$data = array(
			'foto_frontal' => $frontal
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_frontal($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=5";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 5);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 5,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_lateral($id, $latd) {
		$data = array(
			'foto_latder' => $latd
		);
		$this->db->trans_start();
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 6);
		$this->db->update('imgs_temp_vehiculo', $datat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_lateral($id, $latd) {
		$data = array(
			'foto_latder' => $latd
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_lateral($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=6";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 6);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 6,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_trasera($id, $latizq) {
		$data = array(
			'foto_latizq' => $latizq
		);
		$this->db->trans_start();
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 7);
		$this->db->update('imgs_temp_vehiculo', $datat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_trasera($id, $latizq) {
		$data = array(
			'foto_latizq' => $latizq
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_trasera($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=7";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 7);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 7,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_remolque($id, $remolque) {
		$data = array(
			'remolque' => $remolque
		);
		$this->db->trans_start();
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 8);
		$this->db->update('imgs_temp_vehiculo', $datat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function update_foto_remolque($id, $remolque) {
		$data = array(
			'remolque' => $remolque
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_foto_remolque($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=8";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 8);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 8,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function aprobar_pdf_vehiculo($id, $pdf) {
		$data = array(
			'pdf' => $pdf
		);
		$this->db->trans_start();
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);

		$datat = array(
			'estado' => 1
		);

		$this->db->where('idVehiculo', $id);
		$this->db->where('codigo', 10);
		$this->db->update('imgs_temp_vehiculo', $datat);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function update_pdf($id, $pdf) {
		$data = array(
			'pdf' => $pdf
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function edit_pdf($id, $imagen) {
		$this->db->trans_start();
		$consulta = "SELECT * FROM imgs_temp_vehiculo WHERE idVehiculo='$id' AND codigo=10";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			$data = array(
				'nombre' => $imagen,
				'estado' => 0,
				'update_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('idVehiculo', $id);
			$this->db->where('codigo', 10);
			$this->db->update('imgs_temp_vehiculo', $data);
		} else {
			$this->db->insert('imgs_temp_vehiculo', array(
				'idVehiculo' => $id,
				'codigo' => 10,
				'nombre' => $imagen,
				'estado' => 0,
				'created_at' => date('Y-m-d H:i:s')
			));
		}
		$this->db->trans_complete();
	}

	public function reprobar_doc_vehiculo($id, $ndoc) {
		$this->db->trans_start();
		$data = array(
			'activo' => 2
		);
		$data1 = array(
			'estado' => 2
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		$this->db->where('idVehiculo', $id);
		$this->db->where('nombre', $ndoc);
		$this->db->update('imgs_temp_vehiculo', $data1);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function get_ref_emp() {
		$user = $_SESSION['usuario'];
		$SqlInfo = "select t1.id, t2.*, t3.nombre_ciudad FROM Users t1, sf_guard_user_profile_re t2 JOIN df_ciudades t3 ON t2.ciudad=t3.id WHERE t1.usuario='$user' AND t2.userhv_id=t1.id ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {

			print 'no results';
		}
	}

	public function get_ref_empxnit($nit) {

		$consulta = $this->db->get_where('sf_guard_user_profile_re', array('nit' => $nit));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return false;
		}
	}

	public function add_ref_emp() {

		$this->db->insert("sf_guard_user_profile_re", array(
			'userhv_id' => $this->input->post("id_hv", true),
			'razonsocial' => $this->input->post("razonsocial", true),
			'nit' => $this->input->post("nit", true),
			'pais' => 1,
			'dpto' => $this->input->post("provincia", true),
			'ciudad' => $this->input->post("localidad", true),
			'direccion' => $this->input->post("address", true),
			'telefono' => $this->input->post("phone", true),
			'celular' => $this->input->post("celphone", true),
			'contacto' => $this->input->post("contacto", true),
			'telcontacto' => $this->input->post("telcontacto", true),
			'created_at' => date('Y-m-d H:i:s')
		));

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_ref_emp() {

		$data = array(
			'razonsocial' => $this->input->post('razonsocial'),
			'nit' => $this->input->post('nit'),
			'pais' => 1,
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'contacto' => $this->input->post('contacto'),
			'telcontacto' => $this->input->post('telcontacto'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('sf_guard_user_profile_re', $data);
	}

	public function verificar_licencia($codLic, $idVehiculo) {
		$consulta = "SELECT or_codigo_lic FROM ordenes_vehiculo WHERE or_idVehiculo='$idVehiculo' AND or_codigo_lic='$codLic'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function adquirir_licencia($idVehiculo, $data, $arr) {
		$this->db->trans_start();
		$this->db->where('idVehiculo', $idVehiculo);
		$this->db->update('Vehiculos', $data);
		$this->db->insert('ordenes_vehiculo', $arr);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		} else {
			return false;
		}
	}

	public function activar_licencia($id) {

		$qSql = "SELECT idCuentaVehiculos FROM Vehiculos WHERE idVehiculo = {$id} ";
		$result = $this->db->query($qSql);
//		echo $this->db->last_query();
		$data = $result->row();

		$qSqlCuentaV = "SELECT idCuentaVehiculos FROM CuentaVehiculos WHERE idCuentaVehiculos = {$data->idCuentaVehiculos} ";
		$xSqlCuentaV = $this->db->query($qSqlCuentaV);
//		echo $this->db->last_query();
		if ($xSqlCuentaV->num_rows() == 0) {
			$dataCuentaVehiculo = array(
				'ViajesGratis' => 1,
				'ViajesPendientes' => 0,
				'ViajesReferidos' => 0,
				'ViajesRealizados' => 0,
				'ViajesPagados' => 0
			);
			$this->db->insert("CuentaVehiculos", $dataCuentaVehiculo);
			if ($this->db->affected_rows() > 0) {
				$data = array(
					'idCuentaVehiculos' => $this->db->insert_id(),
					'activo' => 1,
					'updated_at' => date('Y-m-d H:i:s')
				);
				$this->db->where('idVehiculo', $id);
				$this->db->update('Vehiculos', $data);

				if ($this->db->affected_rows() > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				$data = array(
					'activo' => 0,
					'updated_at' => date('Y-m-d H:i:s')
				);
				$this->db->where('idVehiculo', $id);
				$this->db->update('Vehiculos', $data);
				return false;
			}
		} else {
			$data = array(
				'activo' => 1,
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->db->where('idVehiculo', $id);
			$this->db->update('Vehiculos', $data);

			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function bloquear_vehiculo($id) {
		$data = array(
			'activo' => 4,
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getCuentasVehiculo($idVehiculo, $id, $Perfil) {
		$qSql = "SELECT V.idVehiculo, CV.ViajesGratis, CV.ViajesReferidos, CV.ViajesPendientes, CV.ViajesRealizados, ";
		$qSql .= "CV.ViajesPagados, TV.tarifa_enturne, V.placa, PAGOS.ValorPago ";
		$qSql .= "FROM CuentaVehiculos CV ";
		$qSql .= "INNER JOIN Vehiculos V ON V.idCuentaVehiculos = CV.idCuentaVehiculos ";
		$qSql .= "INNER JOIN TipoVehiculos TV ON TV.idTipoVehiculo = V.idTipoVehiculo ";
		$qSql .= "LEFT JOIN ( ";
		$qSql .= "		SELECT SUM(Valor) ValorPago, OCV.idVehiculo ";
		$qSql .= "		FROM OfertasCargaVehiculos OCV ";
		$qSql .= "		INNER JOIN Pagos P ON P.IdPagos = OCV.idPagos ";
		($idVehiculo != "1") ? $qSql .= "		WHERE OCV.idVehiculo = {$idVehiculo} " : "";
		$qSql .= "		) as PAGOS ON PAGOS.idVehiculo = V.idVehiculo ";

		if ($Perfil == "CONDUCTORPRO") {
			$qSql .= "INNER JOIN Users U ON U.idUser = V.idUser ";
			$qSql .= "WHERE U.idUser = '{$id}' ";
		}
		if ($Perfil == "ADMIN") {
			($idVehiculo != "1") ? $qSql .= "WHERE V.idVehiculo = {$idVehiculo} " : "";
		}

		if ($Perfil == "EMPRESA") {
			$qSql .= "INNER JOIN Users U ON U.idUser = V.idUser ";
			$qSql .= "WHERE U.idEmpresa = '{$id}' ";
		}




		$query = $this->db->query($qSql);

//		echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetDetailAccount($idVehiculo) {
		$qSql = "SELECT idOfertasCargaVehiculos as ID, CONCAT(C1.nombre_ciudad, ' - ', C2.nombre_ciudad) AS Trayecto, OCV.fecha_contratado, TV.tarifa_enturne, ";
		$qSql .= "P.Valor ";
		$qSql .= "FROM OfertasCargaVehiculos OCV ";
		$qSql .= "INNER JOIN OfertasCarga OC ON OC.idOfertaCarga = OCV.idOfertaCarga ";
		$qSql .= "INNER JOIN Vehiculos V ON OCV.idVehiculo = V.idVehiculo ";
		$qSql .= "INNER JOIN CuentaVehiculos CV ON V.idCuentaVehiculos = CV.idCuentaVehiculos ";
		$qSql .= "INNER JOIN Ciudades C1 ON C1.idCiudad = OC.origen_id ";
		$qSql .= "INNER JOIN Ciudades C2 ON C2.idCiudad = OC.destino_id ";
		$qSql .= "INNER JOIN TipoVehiculos TV ON TV.idTipoVehiculo = V.idTipoVehiculo ";
		$qSql .= "LEFT JOIN Pagos P ON OCV.idPagos= P.idPagos ";
		$qSql .= "WHERE V.idVehiculo = {$idVehiculo} ";
		//$qSql .= "AND OCV.calificacion_empresa != 0 AND OCV.calificacion_conductor != 0 AND OCV.fecha_contrato != '0000-00-00' ";
		$qSql .= "ORDER BY idOfertasCargaVehiculos ";

		$query = $this->db->query($qSql);
//		echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function totalCuentaVehiculos() {
		$sql = "SELECT IdCuentaVehiculos FROM CuentaVehiculos ";
		$consulta = $this->db->query($sql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

	public function totalCuentaVxPropieConduct($idUser) {
		$qSql = "SELECT CV.idCuentaVehiculos FROM CuentaVehiculos CV ";
		$qSql .= "INNER JOIN Vehiculos V ON V.idCuentaVehiculos = CV.idCuentaVehiculos ";
		$qSql .= "INNER JOIN Users U ON V.idUser = U.idUser ";
		$qSql .= "WHERE U.idUser = '{$idUser}' ";

		$consulta = $this->db->query($qSql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

	public function totalCuentaVxEmpresa($idEmpresa) {
		$qSql = "SELECT CV.idCuentaVehiculos FROM CuentaVehiculos CV ";
		$qSql .= "INNER JOIN Vehiculos V ON V.idCuentaVehiculos = CV.idCuentaVehiculos ";
		$qSql .= "INNER JOIN Users U ON V.idUser = U.idUser ";
		$qSql .= "WHERE U.idEmpresa = '{$idEmpresa}' ";

		$consulta = $this->db->query($qSql);
		$count = $consulta->num_rows(); //get current query record.
		return $count;
	}

}
