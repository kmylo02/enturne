<?php

/**
 * ark Admin Panel for Codeigniter
 * Author: Jhon Jairo Valdés Aristizabal
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Docs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Users_model', 'Docs_model', 'Vehiculos_model', 'Conductores_model', 'Empresas_model'));
	}

	public function get_docs_sin_aprobar() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$arr['docsxAprobarEmp'] = $this->Docs_model->docs_x_aprobar_emp();
		$arr['docsxAprobarVehi'] = $this->Docs_model->docs_x_aprobar_vehi();
		$arr['docsxAprobarCond'] = $this->Docs_model->docs_x_aprobar_cond();
		$this->load->view('admin/vwDocsxAprobar', $arr);
	}

	public function lista_pend_empresas_xid($idemp) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'dash';
		$lista = $this->Docs_model->lista_docs_x_aprobar_emp_xid($idemp);
		if ($lista) {
			foreach ($lista as $row) {
				$codigo = $row->codigo;
				$estado = $row->estado;
				$arr["nombreEmpresa"] = $row->nombre_empresa;
				if ($codigo == 0) {
					if ($estado == 0)
						$acciones = '<form id="frmLogo" method="post"  action="javascript:confirmAprobarLogo()">
						<input type="hidden" value="' . $row->nombre . '" name="logo">
						<input type="hidden" value="' . $row->obsv . '" name="obs" id="obs">
						<input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa">
						<button type="submit" class="btn btn-success" style="border-radius: 50%;">
						<span class="glyphicon glyphicon-ok"></span></button></form>
						<form action="javascript:reprobarDoc()">
						<input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc">
						<input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa">
						<button type="submit" class="btn btn-danger" style="border-radius: 50%;">
						<span class="glyphicon glyphicon-remove"></span></button></form>';				
					if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';					
					if ($estado == 2) 
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';					
					$arr["fechalogo"] = $row->created_at;
					$arr["linkLogo"] = anchor(base_url("uploads/empresas") . "/" . $idemp . '/' . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnLogo"] = $acciones;
				}
				if ($codigo == 1) {
					if ($estado == 0)
						$acciones = '<form id="frmRut" method="post"  action="javascript:confirmAprobarRut()"><input type="hidden" value="' . $row->nombre . '" name="rut"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDoc()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';					
					if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';					
					if ($estado == 2) 
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';					
					$arr["fecharut"] = $row->created_at;
					$arr["linkRut"] = anchor(base_url("uploads/empresas") . "/" . $idemp . '/' . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnRut"] = $acciones;
				}
				if ($codigo == 2) {
					if ($estado == 0) 
						$acciones = '<form id="frmCamara" method="post"  action="javascript:confirmAprobarCamara()">
						<input type="hidden" value="' . $row->nombre . '" name="camara">
						<input type="hidden" value="' . $row->obsv . '" name="obs" id="obs">
						<input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa">
						<button type="submit" class="btn btn-success" style="border-radius: 50%;">
						<span class="glyphicon glyphicon-ok"></span></button></form>
						<form action="javascript:reprobarDoc()">
						<input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc">
						<input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa">
						<button type="submit" class="btn btn-danger" style="border-radius: 50%;">
						<span class="glyphicon glyphicon-remove"></span></button></form>';
						if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';					
					if ($estado == 2) 
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';					
					$arr["fechacam"] = $row->created_at;
					$arr["linkCamara"] = anchor(base_url("uploads/empresas") . "/" . $idemp . '/' . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnCamara"] = $acciones;
				}
				if ($codigo == 3) {
					if ($estado == 0)
						$acciones = '<form id="frmPdf" method="post" action="javascript:confirmAprobarPdf()">
						<input type="hidden" value="' . $row->nombre . '" name="pdf">
						<input type="hidden" value="' . $row->obsv . '" name="obs" id="obs">
						<input type="hidden" value="' . $idemp .
						 '" name="id_empresa" id="id_empresa">
						 <button type="submit" class="btn btn-success" style="border-radius: 50%;">
						 <span class="glyphicon glyphicon-ok"></span></button></form>
						 <form action="javascript:reprobarDoc()">
						 <input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc">
						 <input type="hidden" value="' . $idemp . '" name="id_empresa" id="id_empresa">
						 <button type="submit" class="btn btn-danger" style="border-radius: 50%;">
						 <span class="glyphicon glyphicon-remove"></span></button></form>';
					if ($estado == 1)
					$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';					
				if ($estado == 2) 
					$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';					
					$arr["fechapdf"] = $row->created_at;
					$arr["linkPdf"] = anchor(base_url("uploads/empresas") . "/" . $idemp . '/' . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnPdf"] = $acciones;
				}
			}
		}
		$this->load->view('admin/vwListaDocsxAprobarEmp', $arr);
	}

	public function lista_pend_conductores_xid($idConductor) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$lista = $this->Docs_model->lista_docs_x_aprobar_cond_xid($idConductor);
		if ($lista) {
			foreach ($lista as $row) {
				$codigo = $row->codigo;
				$estado = $row->estado;
				$arr["nombre"] = $row->name . ' ' . $row->apellidos;
				if ($codigo == 0) {
					if ($estado == 0)
						$acciones = '<form id="frmCedula" method="post"  action="javascript:confirmAprobarCedula()"><input type="hidden" value="' . $row->nombre . '" name="cedula"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
						if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
						if ($estado == 2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechacedula"] = $row->created_at;
					$arr["linkCedula"] = anchor(base_url("uploads") . "/" . $idConductor . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnCedula"] = $acciones;
				}
				if ($codigo == 1) {
					if ($estado == 0) 
						$acciones = '<form id="frmLic" method="post"  action="javascript:confirmAprobarLic()"><input type="hidden" value="' . $row->nombre . '" name="licencia" id="licencia"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
						if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
						if ($estado == 2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechaLic"] = $row->created_at;
					$arr["linkLic"] = anchor(base_url("uploads") . "/" . $idConductor . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnLic"] = $acciones;
				}
				if ($codigo == 2) {
					if ($estado == 0)
						$acciones = '<form id="frmPdf" method="post"  action="javascript:confirmAprobarPdfUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="pdf" id="pdf"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
						if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
						if ($estado == 2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechapdf"] = $row->created_at;
					$arr["linkPdf"] = anchor(base_url("uploads") . "/" . $idConductor . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnPdf"] = $acciones;
				}
				if ($codigo == 3) {
					if ($estado == 0)
						$acciones = '<form id="frmFotoPerfil" method="post"  action="javascript:confirmAprobarPerfilUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="perfil"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocUsuarios()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $idConductor . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
						if ($estado == 1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
						if ($estado == 2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechaperfil"] = $row->created_at;
					$arr["linkPerfil"] = anchor(base_url("uploads") . "/" . $idConductor . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnPerfil"] = $acciones;
				}
			}
		}
		$this->load->view('admin/vwListaDocsxAprobarCond', $arr);
	}

	public function lista_pend_vehiculos_xid($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			blueirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$lista = $this->Docs_model->lista_docs_x_aprobar_vehi_xid($id);
		if ($lista) {
			foreach ($lista as $row) {
				$codigo = $row->codigo;
				$estado = $row->estado;
				$arr['placa'] = $row->placa;
				if ($codigo == 5) {
					if ($estado == 0) 
						$acciones = '<form id="frmFrontal" method="post"
						 action="javascript:confirmAprobarFrontal()">
						 <input type="hidden" value="' . $row->nombre .
						  '" name="frontal" id="frontal">
						  <input type="hidden" value="' . $row->obsv .
						   '" name="obs" id="obs"><input type="hidden"
							value="' . $row->idVehiculo .
							 '" name="id_vehiculo" id="id_vehiculo">
							 <button type="submit" class="btn btn-success"
							  style="border-radius: 50%;">
							  <span class="glyphicon glyphicon-ok">
							  </span></button></form>
							  <form action="javascript:reprobarDocVehiculo()">
							  <input type="hidden" value="' . $row->nombre .
							   '" name="ndoc" id="ndoc"><input type="hidden" value="' .
								$row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo">
								<button type="submit" class="btn btn-danger" style="border-radius: 50%;">
								<span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechafrontal"] = $row->created_at;
					$arr["linkFrontal"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnFrontal"] = $acciones;
				}
				if ($codigo == 6) {
					if ($estado == 0) 
						$acciones = '<form id="frmLateral" method="post"  action="javascript:confirmAprobarLateral()"><input type="hidden" value="' . $row->nombre . '" name="lateral" id="lateral"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechaLateral"] = $row->created_at;
					$arr["linkLateral"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnLateral"] = $acciones;
				}
				if ($codigo == 7) {
					if ($estado == 0) 
						$acciones = '<form id="frmTrasera" method="post"  action="javascript:confirmAprobarTrasera()"><input type="hidden" value="' . $row->nombre . '" name="trasera" id="trasera"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechatrasera"] = $row->created_at;
					$arr["linkTrasera"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnTrasera"] = $acciones;
				}
				if ($row->codigo == 2) {
					if ($estado == 0)
						$acciones = '<form id="frmLict" method="post"  action="javascript:confirmAprobarLict()"><input type="hidden" value="' . $row->nombre . '" name="lict" id="lict"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechalict"] = $row->created_at;
					$arr["linkLict"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnLict"] = $acciones;
				}
				if ($codigo == 0) {
					if ($estado == 0)
						$acciones = '<form id="frmSoat" method="post"  action="javascript:confirmAprobarSoat()"><input type="hidden" value="' . $row->nombre . '" name="soat" id="soat"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechasoat"] = $row->created_at;
					$arr["linkSoat"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnSoat"] = $acciones;
				}
				if ($codigo == 1) {
					if ($estado == 0)
						$acciones = '<form id="frmRtm" method="post"  action="javascript:confirmAprobarRtm()"><input type="hidden" value="' . $row->nombre . '" name="rtm" id="rtm"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechartm"] = $row->created_at;
					$arr["linkRtm"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnRtm"] = $acciones;
				}
				if ($codigo == 8) {
					if ($estado == 0)
						$acciones = '<form id="frmRegRemolque" method="post"  action="javascript:confirmAprobarRegRemolque()"><input type="hidden" value="' . $row->nombre . '" name="regr" id="regr"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fecharegremolque"] = $row->created_at;
					$arr["linkRegremolque"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnRegremolque"] = $acciones;
				}
				if ($codigo == 3) {
					if ($estado == 0)
						$acciones = '<form id="frmCedP" method="post"  action="javascript:confirmAprobarCedP()"><input type="hidden" value="' . $row->nombre . '" name="cedp" id="cedp"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechacedprop"] = $row->created_at;
					$arr["linkCedprop"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnCedprop"] = $acciones;
				}
				if ($codigo == 4) {
					if ($estado == 0)
						$acciones = '<form id="frmRutP" method="post"  action="javascript:confirmAprobarRutP()"><input type="hidden" value="' . $row->nombre . '" name="rutp" id="rutp"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';
					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fecharutprop"] = $row->created_at;
					$arr["linkRutprop"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnRutprop"] = $acciones;
				}
				if ($codigo == 10) {
					if ($estado == 0)
						$acciones = '<form id="frmPdf" method="post"  action="javascript:confirmAprobarPdfVehiculos()"><input type="hidden" value="' . $row->nombre . '" name="pdf" id="pdf"><input type="hidden" value="' . $row->obsv . '" name="obs" id="obs"><input type="hidden" value="' . $row->idVehiculo . '" name="id_vehiculo" id="id_vehiculo"><button type="submit" class="btn btn-success" style="border-radius: 50%;"><span class="glyphicon glyphicon-ok"></span></button></form><form action="javascript:reprobarDocVehiculo()"><input type="hidden" value="' . $row->nombre . '" name="ndoc" id="ndoc"><input type="hidden" value="' . $row->idVehiculo . '" name="id_conductor" id="id_conductor"><button type="submit" class="btn btn-danger" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove"></span></button></form>';					
					if($estado==1)
						$acciones = '<button type="button" class="btn btn-success" disabled>Aprobado</button>';
					if($estado==2)
						$acciones = '<button type="button" class="btn btn-danger" disabled>Rechazado</button>';
					$arr["fechadocu"] = $row->created_at;
					$arr["linkDocu"] = anchor(base_url("uploads/vehiculos") . "/" . $id . "/" . $row->nombre, '<span class="glyphicon glyphicon-paperclip" style="color:blue;"></span>', 'target="_blank"');
					$arr["btnDocu"] = $acciones;
				}
			}
		}
		$this->load->view('admin/vwListaDocsxAprobarVehi', $arr);
	}

	public function aprobar_logo() {
		$idempresa = $this->input->post("id_empresa");
		$datos = $this->Empresas_model->get_empxid($idempresa);
		$nombre = $datos->nombre_empresa;
		$mail = $datos->email;
		$logo = $this->input->post("logo");
		$res = $this->Empresas_model->update_logo($idempresa, $logo);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('registro@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Logo'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados de la empresa');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_rut() {
		$idempresa = $this->input->post("id_empresa");
		$datos = $this->Empresas_model->get_empxid($idempresa);
		$nombre = $datos->nombre_empresa;
		$mail = $datos->email;
		$rut = $this->input->post("rut");
		$res = $this->Empresas_model->update_rut($idempresa, $rut);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('registro@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'RUT'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados de la empresa');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_camara() {
		$idempresa = $this->input->post("id_empresa");
		$datos = $this->Empresas_model->get_empxid($idempresa);
		$nombre = $datos->nombre_empresa;
		$mail = $datos->email;
		$camara = $this->input->post("camara");
		$res = $this->Empresas_model->update_camara($idempresa, $camara);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('registro@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Cámara de comercio'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados de la empresa');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_pdf() {
		$idempresa = $this->input->post("id_empresa");
		$datos = $this->Empresas_model->get_empxid($idempresa);
		$nombre = $datos->nombre_empresa;
		$mail = $datos->email;
		$pdf = $this->input->post("pdf");
		$res = $this->Empresas_model->update_pdf($idempresa, $pdf);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('registro@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Otros Adjuntos'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados de la empresa');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_cedula() {
		$idConductor = $this->input->post("id_conductor");
		$cedula = $this->input->post("cedula");
		$datos = $this->Users_model->get_perfilxid($idConductor);
		$nombre = $datos->nombre . ' ' . $datos->apellidos;
		$mail = $datos->email;
		$res = $this->Conductores_model->aprobar_cedula($idConductor, $cedula);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Cédula'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del conductor');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_foto_perfil_usuarios() {
		$idConductor = $this->input->post("id_conductor");
		$perfil = $this->input->post("perfil");
		$datos = $this->Users_model->get_perfilxid($idConductor);
		$nombre = $datos->nombre . ' ' . $datos->apellidos;
		$mail = $datos->email;
		$res = $this->Conductores_model->aprobar_foto_perfil($idConductor, $perfil);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Foto Perfil'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del conductor');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_lic() {
		$idConductor = $this->input->post("id_conductor");
		$lic = $this->input->post("licencia");
		$datos = $this->Users_model->get_perfilxid($idConductor);
		$nombre = $datos->nombre . ' ' . $datos->apellidos;
		$mail = $datos->email;
		$res = $this->Conductores_model->aprobar_lic($idConductor, $lic);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Licencia de conducción'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del conductor');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_pdf_usuarios() {
		$idConductor = $this->input->post("id_conductor");
		$pdf = $this->input->post("pdf");
		$datos = $this->Users_model->get_perfilxid($idConductor);
		$nombre = $datos->nombre . ' ' . $datos->apellidos;
		$mail = $datos->email;
		$res = $this->Conductores_model->aprobar_pdf($idConductor, $pdf);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'tipo' => 'Documentos en pdf'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del conductor');
			$body = $this->load->view('apro_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function reprobar_doc() {
		$idempresa = $this->input->post("idEmp");
		$infoempresa = $this->Empresas_model->get_empxid($idempresa);
		$nombre_empresa = $infoempresa->nombre_empresa;
		$mailEmpresa = $infoempresa->email;
		$ndoc = $this->input->post("ndoc");
		$obs = $this->input->post("result");
		$res = $this->Empresas_model->reprobar_doc($idempresa, $ndoc);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre_empresa' => $nombre_empresa,
				'ndoc' => $ndoc,
				'obsv' => $obs
			);
			$this->email->to($mailEmpresa);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Se rechaza documento');
			$body = $this->load->view('rechazo_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			//unlink('uploads/empresas/' . $idempresa . '/' . $ndoc);
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function reprobar_doc_usuarios() {
		$idUsuario = $this->input->post("idUsuario");
		$datos = $this->Users_model->get_perfilxid($idUsuario);
		$nombre = $datos->nombre . ' ' . $datos->apellidos;
		$mail = $datos->email;
		$ndoc = $this->input->post("ndoc");
		$obs = $this->input->post("result");
		$res = $this->Conductores_model->reprobar_doc($idUsuario, $ndoc);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre_empresa' => $nombre,
				'ndoc' => $ndoc,
				'obsv' => $obs
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Se rechaza documento');
			$body = $this->load->view('rechazo_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			//unlink('uploads/' . $idUsuario . '/' . $ndoc);
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function reprobar_doc_vehiculo() {
		$idv = $this->input->post("idv");
		$infoprop = $this->Vehiculos_model->get_vehiculo_xid($idv);
		$nombre = $infoprop->nomprop . ' ' . $infoprop->apeprop;
		$mail = $infoprop->mailp;
		$placa = $infoprop->placa;
		$ndoc = $this->input->post("ndoc");
		$obs = $this->input->post("result");
		$res = $this->Vehiculos_model->reprobar_doc_vehiculo($idv, $ndoc);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre_empresa' => $nombre,
				'ndoc' => $ndoc,
				'placa' => $placa,
				'obsv' => $obs
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Se rechaza documento');
			$body = $this->load->view('rechazo_docs.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_frontal_vehiculo() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$frontal = $this->input->post("frontal");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_frontal($idvehiculo, $frontal);
		if ($res === true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto Frontal'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_lateral_vehiculo() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$lateral = $this->input->post("lateral");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_lateral($idvehiculo, $lateral);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto Lateral'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_trasera_vehiculo() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$trasera = $this->input->post("trasera");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_trasera($idvehiculo, $trasera);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto Trasera'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_soat() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$soat = $this->input->post("soat");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_soat($idvehiculo, $soat);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto SOAT'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_rtecno() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$rtm = $this->input->post("rtm");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_rtecno($idvehiculo, $rtm);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto revisión tecnomecanica'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_lic_vehiculo() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$lict = $this->input->post("lict");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_lic_vehiculo($idvehiculo, $lict);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto licencia de transito'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_cedp() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$cedp = $this->input->post("cedp");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_cedp($idvehiculo, $cedp);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto Cedula Propietario'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_rutp() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$rutp = $this->input->post("rutp");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_rutp($idvehiculo, $rutp);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto RUT Propietario'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_remolque() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$regr = $this->input->post("regr");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_remolque($idvehiculo, $regr);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Foto Remolque'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function aprobar_pdf_vehiculo() {
		$idvehiculo = $this->input->post("id_vehiculo");
		$pdf = $this->input->post("pdf");
		$datosPropietario = $this->Vehiculos_model->get_datos_propietario($idvehiculo);
		$nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
		$mail = $datosPropietario->email;
		$placa = $datosPropietario->placa;
		$res = $this->Vehiculos_model->aprobar_pdf_vehiculo($idvehiculo, $pdf);
		if ($res == true) {
			$config['charset'] = 'utf-8';
			$config['newline'] = "\r\n";
			$config['mailtype'] = 'html';
			$config['protocol'] = 'mail';
			$config['smtp_host'] = 'mail.enturne.co';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'soporte@enturne.co';
			$config['smtp_pass'] = 'ENTURNE260413';
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->clear();
			$this->email->from('soporte@enturne.co', 'Enturne En Linea');
			$data = array(
				'nombre' => $nombre,
				'placa' => $placa,
				'tipo' => 'Documentos en pdf'
			);
			$this->email->to($mail);
			$this->email->cc($this->config->item('mailEnturne'));
			$this->email->bcc($this->config->item('mailSistemas'));
			$this->email->subject('Documentos aprobados del vehiculo');
			$body = $this->load->view('apro_docs_vehiculos.php', $data, TRUE);
			$this->email->message($body);
			$this->email->send();
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function docs_x_vencer_conductor() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			blueirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$body = "";
		$vencen = $this->Docs_model->vence_licencia();
		if ($vencen) {
			foreach ($vencen as $vence) {
				$body .= '<tr><td>' . $vence->nombre . ' ' . $vence->apellidos . '</td><td>' . $vence->telefono . '-' . $vence->celular . '</td><td>' . $vence->fecha_ven_licencia . '</td></tr>';
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = '';
		}
		$arr['titulos'] = '<th>Nombre</th><th>Telefonos</th><th>Licencia Conducción</th>';
		$this->load->view('admin/vwDocsxVencer', $arr);
	}

	public function docs_x_vencer_vehiculo() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			blueirect('Login');
		}
		$id = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$body = "";
		$vencen = $this->Docs_model->vence_docs();
		if ($vencen) {
			foreach ($vencen as $vence) {
				$body .= '<tr><td>' . $vence->placa . '</td><td>' . $vence->telefono . '-' . $vence->celular . '</td><td>' . $vence->vence_soat . '</td><td>' . $vence->vence_rtecnomecanica . '</td></tr>';
			}
			$arr['body'] = $body;
		} else {
			$arr['body'] = '';
		}
		$arr['titulos'] = '<th>Placa</th><th>Telefonos</th><th>SOAT</th><th>TECNOMECANICA</th>';
		$this->load->view('admin/vwDocsxVencer', $arr);
	}

}
