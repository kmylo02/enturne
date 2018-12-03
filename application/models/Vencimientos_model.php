<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vencimientos_model extends CI_Model {

// Funcion que obtiene datos para ver fecha de vencimiento de licencia del conductor con recordatorio
	public function vence_licc($id) {
		$que = $this->db->get_where('Users', array('idUser' => $id, 'r' => 0));
		if ($que->num_rows() != 0) {
			if ($que->num_rows() > 0) {
				return $que->result();
			} else {
				return false;
			}
		}
	}

// Funcion que obtiene datos para ver fecha de vencimiento de soat del vehiculo con recordatorio
	public function very_soat($id) {
		$que = $this->db->get_where('sf_vehiculo', array('user_id' => $id, 'rvsoat' => 0));
		if ($que->num_rows() != 0) {
			if ($que->num_rows() > 0) {
				return $que->result();
			} else {
				return false;
			}
		}
	}

// Funcion que obtiene datos para ver fecha de vencimiento de la rtm del vehiculo con recordatorio
	public function very_rtm($id) {
		$que = $this->db->get_where('sf_vehiculo', array('user_id' => $id, 'rvrtm' => 0));
		if ($que->num_rows() != 0) {
			if ($que->num_rows() > 0) {
				return $que->result();
			} else {
				return false;
			}
		}
	}

// Funcion que obtiene datos para ver fecha de vencimiento de la licencia enturne del vehiculo con recordatorio
	public function very_licenturne($id) {
		$que = $this->db->get_where('sf_vehiculo', array('user_id' => $id, 'rvlien' => 0));
		if ($que->num_rows() != 0) {
			if ($que->num_rows() > 0) {
				return $que->result();
			} else {
				return false;
			}
		}
	}

// Funcion para cancelar recordatorio de la licencia de conduccion
	public function cancel_recordatorio($id) {
		$data = array(
			'r' => 1
		);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

// Funcion para cancelar recordatorio del soat
	public function cancel_recordatorio_soat($id) {
		$data = array(
			'rvsoat' => 1
		);
		$this->db->where('user_id', $id);
		$this->db->update('sf_vehiculo', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

// Funcion para cancelar recordatorio de la rtm
	public function cancel_recordatorio_rtm($id) {
		$data = array(
			'rvrtm' => 1
		);
		$this->db->where('user_id', $id);
		$this->db->update('sf_vehiculo', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

// Funcion para cancelar recordatorio de la licencia de enturne del vehiculo
	public function cancel_recordatorio_lice($id) {
		$data = array(
			'rvlien' => 1
		);
		$this->db->where('user_id', $id);
		$this->db->update('sf_vehiculo', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}
