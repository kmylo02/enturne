<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Referencias_model extends CI_Model {

	public function get_ref_per() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$SqlInfo = "select t1.idUser, t2.idReferenciaPersonal,t2.nombre, t2.apellido,t2.tipo_documento,"
						. "t2.identificacion,t2.parentesco,t2.dpto,t2.ciudad,t2.direccion,"
						. "t2.casa,t2.tiemporesidencia,t2.telefono,t2.celular,"
						. "t3.nombre_ciudad FROM Users t1, ReferenciasPersonales t2"
						. " JOIN Ciudades t3 ON t2.ciudad=t3.idCiudad WHERE t1.idUser='$id'"
						. " AND t2.idUser=t1.idUser ";

		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_ref_perxid_conductor($id) {
		$query = "select t1.idReferenciaPersonal,t1.idUser,t1.nombre,t1.apellido,t1.tipo_documento,"
						. "t1.identificacion,t1.parentesco,t1.direccion,t1.telefono,"
						. "t1.celular,t1.pais,t1.dpto,t1.ciudad,t1.casa,t1.tiemporesidencia,"
						. "t2.nombre_ciudad,t3.nombre_dpto,t4.nombre_pais FROM"
						. " ReferenciasPersonales t1 JOIN Ciudades t2 ON"
						. " t2.idCiudad=t1.ciudad JOIN Departamentos t3 ON t1.dpto=t3.idDepartamento"
						. " JOIN Paises t4 ON t1.pais=t4.idPais WHERE t1.idReferenciaPersonal='$id'";
		$consulta = $this->db->query($query);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function get_ref_perxid($id) {
		$query = "select t1.idReferenciaPersonal,t1.idUser,t1.nombre,t1.apellido,t1.tipo_documento,"
						. "t1.identificacion,t1.parentesco,t1.direccion,t1.telefono,"
						. "t1.celular,t1.pais,t1.dpto,t1.ciudad,t1.casa,t1.tiemporesidencia,"
						. "t2.nombre_ciudad,t3.nombre_dpto,t4.nombre_pais "
						. "FROM ReferenciasPersonales t1 "
						. "JOIN Ciudades t2 ON t2.idCiudad=t1.ciudad "
						. "JOIN Departamentos t3 ON t1.dpto=t3.idDepartamento "
						. "JOIN Paises t4 ON t1.pais=t4.idPais "
						. "WHERE t1.idUser='$id'";
		$consulta = $this->db->query($query);
		//var_dump($this->db->last_query());

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function contar_refper() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$refper = $this->db->get_where('ReferenciasPersonales', array('idUser' => $id));
		$count = $refper->num_rows(); //get current query record.
		return $count;
	}

	public function contar_refemp() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$refper = $this->db->get_where('ReferenciasEmpresariales', array('idUser' => $id));
		$count = $refper->num_rows(); //get current query record.
		return $count;
	}

	public function get_ref_perxid_admin($id) {
		$query = "select t1.idReferenciaPersonal,t1.nombre,t1.apellido,t1.tipo_documento,"
						. "t1.identificacion,t1.parentesco,t1.direccion,t1.telefono,"
						. "t1.celular,t1.pais,t1.dpto,t1.ciudad,t1.casa,"
						. "t1.tiemporesidencia,t2.nombre_ciudad,t3.idDepartamento, t3.nombre_dpto, "
						. "t4.nombre_pais,t1.tipo_documento "
						. "FROM ReferenciasPersonales t1 "
						. "JOIN Ciudades t2 ON t2.idCiudad=t1.ciudad "
						. "JOIN Departamentos t3 ON t1.dpto=t3.idDepartamento "
						. "JOIN Paises t4 ON t1.pais=t4.idPais "
						//. "JOIN tipo_documento t5 ON t1.tipo_documento = t5.id "
						. "WHERE t1.idUser='$id'";
		$consulta = $this->db->query($query);

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function add_ref_per($data) {
		$this->db->insert("ReferenciasPersonales", $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_ref_per() {

		$data = array(
			'nombre' => $this->input->post('firstName'),
			'apellido' => $this->input->post('lastName'),
			'tipo_documento' => $this->input->post('tipo_doc'),
			'identificacion' => $this->input->post('cc'),
			'parentesco' => $this->input->post('parentesco'),
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'celular' => $this->input->post('celphone'),
			'casa' => $this->input->post('vivienda'),
			'tiemporesidencia' => $this->input->post('meses_vivienda'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idReferenciaPersonal', $this->input->post('id'));
		$this->db->update('ReferenciasPersonales', $data);
	}

	public function get_ref_emp() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$SqlInfo = "select t1.idUser,t2.idReferenciaEmpresarial, t2.razonsocial, t2.nit, t2.pais,t2.dpto,t2.ciudad,t2.direccion, t2.telefono,t2.celular, t2.contacto, t2.telcontacto, t3.nombre_ciudad FROM Users t1, ReferenciasEmpresariales t2 JOIN Ciudades t3 ON t2.ciudad=t3.idCiudad WHERE t1.idUser='$id' AND t2.idUser=t1.idUser ";
		$query = $this->db->query($SqlInfo);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_ref_empxid($id) {

		$SqlInfo = "select t2.idReferenciaEmpresarial,t2.idUser,t2.razonsocial,t2.nit,t2.pais,t2.dpto,t2.ciudad,"
						. "t2.direccion,t2.telefono,t2.celular,t2.contacto,t2.telcontacto,t3.nombre_ciudad "
						. "FROM ReferenciasEmpresariales t2 "
						. "JOIN Ciudades t3 ON t2.ciudad=t3.idCiudad "
						. "WHERE t2.idUser='$id' ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_ref_empxid_conductor($id) {

		$SqlInfo = "select t2.idReferenciaEmpresarial,t2.idUser,t2.razonsocial,t2.nit,t2.pais,t2.dpto,t2.ciudad,t2.direccion, "
						. "t2.telefono,t2.celular, t2.contacto, t2.telcontacto, t3.nombre_ciudad "
						. "FROM ReferenciasEmpresariales t2 "
						. "JOIN Ciudades t3 ON t2.ciudad=t3.idCiudad "
						. "WHERE t2.idReferenciaEmpresarial='$id' ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_ref_empxid_admin($id) {

		$SqlInfo = "select t2.idReferenciaEmpresarial,t2.idUser,t2.razonsocial,t2.nit,t2.pais,t2.dpto,t2.ciudad,"
						. "t2.direccion, t2.telefono,t2.celular, t2.contacto, t2.telcontacto, t3.nombre_ciudad "
						. "FROM ReferenciasEmpresariales t2 "
						. "JOIN Ciudades t3 ON t2.ciudad=t3.idCiudad "
						. "WHERE t2.idUser='$id' ";
		$query = $this->db->query($SqlInfo);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	public function get_ref_empxidcond($id) {

		$consulta = $this->db->get_where('sf_guard_user_profile_re', array('id' => $id));

		if ($consulta->num_rows() > 0) {
			return $consulta->result();
		} else {
			return FALSE;
		}
	}

	public function add_ref_emp($data) {
		$this->db->insert("ReferenciasEmpresariales", $data);


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
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'contacto' => $this->input->post('contacto'),
			'telcontacto' => $this->input->post('telcontacto'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$this->db->where('idReferenciaEmpresarial', $this->input->post('id'));
		$this->db->update('ReferenciasEmpresariales', $data);
	}

}
