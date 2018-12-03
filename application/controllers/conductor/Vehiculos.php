<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Vehiculos extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('Vehiculos_model'));
	}

	public function GetCuentaVehiculo($idVehiculo = "") {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUser = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr["vehiculo"] = $idVehiculo;
		$datos = $this->Vehiculos_model->getCuentasVehiculo($idVehiculo, $idUser, "CONDUCTORPRO");
		$body = "";
		$acciones = "";
		if ($datos != false) {
			foreach ($datos as $value) {
				$arr['placa'] = $value->placa;
				$TotalGratis = (int) $value->ViajesGratis + $value->ViajesReferidos;
				$TotalPromocion = (int) $TotalGratis * $value->tarifa_enturne;
				$PagosRecibidos = (int) $value->ViajesPendientes * $value->tarifa_enturne;
				$TotalAbonos = (int) $TotalPromocion + $PagosRecibidos;
				$ViajesRealizados = (int) $value->ViajesRealizados * $value->tarifa_enturne;
				$SaldoDisponible = (int) $TotalAbonos - $ViajesRealizados - $value->ValorPago;
				$color = ($SaldoDisponible >= 0) ? "green" : "red";
				$readonly = ($SaldoDisponible >= 0) ? "readonly" : "red";

				$body .= "<tr>";
				($idVehiculo == "1") ? $body .= "<td style='display:none'>" . $value->idVehiculo . "</td><td>" . $value->placa . "</td>" : "";
				$body .= "<td>" . $value->ViajesGratis . "</td>";
				$body .= "<td>" . $value->ViajesReferidos . "</td>";
				$body .= "<td>" . $TotalGratis . "</td>";
				$body .= "<td>" . $value->tarifa_enturne . "</td>";
				$body .= "<td>" . $TotalPromocion . "</td>";
				$body .= "<td>" . $PagosRecibidos . "</td>";
				$body .= "<td>" . $TotalAbonos . "</td>";
				$body .= "<td>" . $ViajesRealizados . "</td>";
				$body .= "<td style='color:" . $color . "'>" . $SaldoDisponible . "</td>";
				$body .= "<td><input type='number' class='form-control vlrPago' ></td>";
				$body .= "</tr>";
			}
		}
		$arr['body'] = $body;
		$this->load->view('conductor/vwCuentaVehiculo', $arr);
	}

	public function DetailAccountV($idVehiculo) {
		try {

			$jsondata['success'] = true;
			$jsondata["data"] = $this->Vehiculos_model->GetDetailAccount($idVehiculo);
		} catch (Exception $ex) {
			$jsondata['success'] = false;
			$jsondata['message'] = 'Erro, ' . $ex;
		}

		echo json_encode($jsondata);
	}

}
