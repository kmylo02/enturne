<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gps_model extends CI_Model {

	public function get_users_gps() {

		$consulta = $this->db->get_where('Users', array('idNivel' => '4'));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_user_gps_xid($id) {
		$consulta = "select t1.id,t1.nombre,t1.apellidos,t1.tipo_doc,t1.cedula,t1.telefono,t1.email,t1.direccion,t1.celular,t1.foto_ruta,t1.fecha_nac,t1.sexo,t1.estado_civil,t1.pais,t1.dpto,t1.ciudad,t1.tipo_vivienda,t1.licencia_conduccion,t1.categoria_lic,t1.fecha_ven_licencia,t1.meses_vivienda,t1.nombre_conyuge,t1.apellido_conyuge,t1.tipo_docc,t1.cedulac,t1.tel_conyuge,t1.permisos,t2.nombre_ciudad,t3.nombre_dpto,t4.nombre_pais FROM users t1 JOIN df_ciudades t2 ON t2.id=t1.ciudad JOIN df_departamentos t3 ON t1.dpto=t3.id JOIN df_paises t4 ON t1.pais=t4.id WHERE t1.id='$id'";
		$query = $this->db->query($consulta);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function update_perfil() {
		$id = $this->input->post('id');
		$data = array(
			'nombre' => $this->input->post('firstName'),
			'apellidos' => $this->input->post('lastName'),
			'tipo_doc' => $this->input->post('tipo_doc'),
			'cedula' => $this->input->post('cc'),
			'fecha_nac' => $this->input->post('theDate'),
			'estado_civil' => $this->input->post('est_civil'),
			'nombre_conyuge' => $this->input->post('nombre_conyuge'),
			'apellido_conyuge' => $this->input->post('apellido_conyuge'),
			'tipo_docc' => $this->input->post('tipo_docc'),
			'cedulac' => $this->input->post('ccc'),
			'tel_conyuge' => $this->input->post('tel_conyuge'),
			'sexo' => $this->input->post('gender'),
			'pais' => 1,
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'tipo_vivienda' => $this->input->post('tipo_vivienda'),
			'meses_vivienda' => $this->input->post('meses_vivienda'),
			'licencia_conduccion' => $this->input->post('licencia_conduccion'),
			'categoria_lic' => $this->input->post('categoria_lic'),
			'fecha_ven_licencia' => $this->input->post('theDatev')
		);

		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function get_ubicacion($usuario) {
		$sql = "Select vehiculo_asignado from Users where usuario='$usuario'";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) {
			return false;
		} else {
			foreach ($query->result() as $row) {
				$placa = $row->vehiculo_asignado;
			}
			$sqlubi = "Select Latitud,Longitud from Vehiculos where placa='$placa'";
			$ubi = $this->db->query($sqlubi);
			if ($ubi->num_rows() > 0) {
				return $ubi->result();
			} else {
				return false;
			}
		}
	}

	public function get_imei($imei) {
		$sql = "Select vehiculo_id from sf_gps where codigo='$imei'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function add_mensaje_completo($data) {
		$query = $this->db->insert('sf_gps_mensaje', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_movimiento($data) {
		$query = $this->db->insert('sf_vehiculo_gps', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_datos_satelital($idv) {
		$sql = "SELECT * FROM sf_vehiculo_gps WHERE vehiculo_id = '$idv' AND latitud != '' ORDER BY id DESC LIMIT 1";
		$q = $this->db->query($sql);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return false;
		}
	}

	public function get_ultimo_movimiento($idv) {
		$sql = "SELECT * FROM sf_vehiculo_gps WHERE vehiculo_id = '$idv' ORDER BY id DESC LIMIT 1";
		$q = $this->db->query($sql);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return false;
		}
	}

}
