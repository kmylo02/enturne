<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alertas extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model','Alertas_model'));
    }

    public function index() {
      
    }

    public function get_soss() {
      $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
		$arr['totalPendDocs'] = $this->Users_model->obtenerPendDocs();
		$arr['totalCompletos'] = $this->Users_model->obtenerCompletos();
		$arr['inactivos'] = $this->Users_model->obtenerUsersInactivos();
		$arr['activos'] = $this->Users_model->obtenerUsersActivos();
		$arr['pendEmail'] = $this->Users_model->obtenerUsersActivos();
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page']='dash';
        $sos = $this->Alertas_model->get_soss();
        $body = "";
        if($sos){
            foreach($sos as $row){
                $body .= "<tr><td>".$row->nombre." ".$row->apellidos."</td><td>".$row->created_at . "</td><td style='color:red'>" . $row->comentario."</td><td>".$row->vehiculo_asignado."</td><td>".$row->ubicacion."</td><td><input type='button' class='btn btn-warning' value='Marcar Resuelta' onclick='elimSos(".$row->id.")'></td></tr>";
            }
            $arr['body'] = $body;
        } else {
            $arr['body'] = "";
        }
      $this->load->view('admin/vwSos',$arr);
    } 
    
    public function get_contsos() {
		$contsos = $this->Alertas_model->get_contsos();
		echo $contsos;		
    }
    public function cerrar_sos() {
        $id = $this->input->post("id");
		$sos = $this->Alertas_model->cerrar_sos_admin($id);
		if($sos==true){
            echo "ok";
        } else {
            echo "ko";
        }
    }
    
}