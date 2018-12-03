<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Docs_model extends CI_Model {

	public function lista_docs_x_aprobar_emp_xid($idemp) {
		$sql = "SELECT t1.*,t2.nombre_empresa FROM Imgs_temp_empresas t1 JOIN"
						. " Empresas t2 ON t1.idEmpresa=t2.idEmpresa WHERE t1.idEmpresa='$idemp'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function very_docs_x_aprobar_emp_xid($idemp) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_empresas WHERE idEmpresa='$idemp' AND estado=0";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_aprobados_emp_xid($idemp) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_empresas  WHERE idEmpresa='$idemp' AND estado=1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_rechazados_emp_xid($idemp) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_empresas  WHERE idEmpresa='$idemp' AND estado=2";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function lista_docs_x_aprobar_vehi_xid($id) {
		$sql = "SELECT t1.*,t2.placa FROM imgs_temp_vehiculo t1 JOIN Vehiculos t2 "
						. " ON t1.idVehiculo=t2.idVehiculo WHERE t1.idVehiculo='$id'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function very_docs_x_aprobar_vehi_xid($id) {
		$sql = "SELECT count(*) as num FROM imgs_temp_vehiculo  WHERE idVehiculo='$id' AND estado=0";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_aprobados_vehi_xid($id) {
		$sql = "SELECT count(*) as num FROM imgs_temp_vehiculo  WHERE idVehiculo='$id'"
						. " AND estado=1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_rechazados_vehi_xid($id) {
		$sql = "SELECT count(*) as num FROM imgs_temp_vehiculo  WHERE idVehiculo='$id'"
						. " AND estado=2";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function lista_docs_x_aprobar_cond_xid($idConductor) {
		$sql = "SELECT t1.*,t2.nombre as name,t2.apellidos "
						. "FROM Imgs_temp_users t1 JOIN Users t2 ON t1.idUser=t2.idUser "
						. "WHERE t1.idUser='$idConductor'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function very_docs_x_aprobar_cond_xid($idConductor) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_users WHERE idUser='$idConductor' AND"
						. " estado = 0";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_aprobados_cond_xid($idConductor) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_users WHERE idUser='$idConductor'"
						. " AND estado = 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function very_docs_rechazados_cond_xid($idConductor) {
		$sql = "SELECT count(*) as num FROM Imgs_temp_users WHERE idUser='$idConductor'"
						. " AND estado = 2";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function vence_licencia() {
		$sql = "SELECT nombre,apellidos,telefono,celular,fecha_ven_licencia"
						. " FROM Users WHERE DATEDIFF( fecha_ven_licencia, CURDATE( ) ) < 6";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function vence_docs() {
		$sql = "SELECT t1.placa,t1.vence_soat,t1.vence_rtecnomecanica,"
						. "t2.telefono,t2.celular FROM Vehiculos t1 JOIN Users t2"
						. " ON t1.idUser=t2.idUser WHERE DATEDIFF( vence_soat, CURDATE( ) ) < 6"
						. " OR DATEDIFF( vence_rtecnomecanica, CURDATE( ) ) < 6";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

}
