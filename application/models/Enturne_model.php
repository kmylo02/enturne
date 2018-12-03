<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Enturne_model extends CI_Model {

	public function update_enturne($idv, $data) {
		$this->db->where('idv', $idv);
		$this->db->update('sf_vehiculo', $data);
	}

	public function update_enturne_app($id, $data) {
		$this->db->where('idVehiculo', $id);
		$this->db->update('Vehiculos', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_enturne_ciudad_app($id, $ciudad) {
		$query = $this->db->get_where('Ciudades', array('nombre_ciudad' => $ciudad));
		if ($query->num_rows() != 0) {
			foreach ($query->result() as $row) {
				$idCiudad = $row->id;
			}
			$data = array(
				'origen_id' => $idCiudad
			);
			$this->db->where('idVehiculo', $id);
			$this->db->update('Vehiculos', $data);
		} else {
			return false;
		}
	}

}
