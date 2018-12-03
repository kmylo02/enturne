<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gps extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter 
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model','Mapa_model','Gps_model','Paises_model','Vehiculos_model'));
    }

    public function index() {
	$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['totalEmpresas'] = $this->Users_model->totalEmpresas();
	$arr['totalTransp'] = $this->Users_model->totalTransp();
	$arr['totalVehiculos'] = $this->Users_model->totalVehiculos();
        $arr['totalGps'] = $this->Users_model->totalGps();
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['vehiculos'] = $this->Vehiculos_model->get_vehiculos_satelital();
        $this->load->view('admin/vwGps', $arr);
    }
    public function get_datos_satelital() {
        $idv = $this->input->get("idv");
        $arr['vehiculo'] = $this->Gps_model->get_datos_satelital($idv);
        ;
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    public function get_ultimo_movimiento() {
        $idv = $this->input->get("idv");
        $arr['mov'] = $this->Gps_model->get_ultimo_movimiento($idv);
        ;
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    public function get_users_gps() {
		$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['mensaje'] = 'Aun no se ha registrado usuarios de solo GPS';
        $arr['datos'] = $this->Gps_model->get_users_gps();
        $arr['edad'] = $this->Users_model->get_edad($usuario);
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwGpsUsers', $arr);
    }

    public function get_user_gps_xid($id) {
		$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        if (!$id) {
            show_404();
        }
        $arr['mensaje'] = '';
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['conxid'] = $this->Gps_model->get_user_gps_xid($id);
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwFormUserGps', $arr);
    }

    public function edit_user_gps() {
		$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;

        if ($this->input->post('update_user')) {
            $id=$this->input->post('id');
            $this->form_validation->set_rules('tipo_doc', 'Tipo Documento', 'required');
            $this->form_validation->set_rules('cc', 'Documento', 'required');
            $this->form_validation->set_rules('theDate', 'Fecha Nacimiento', 'required');
            $this->form_validation->set_rules('est_civil', 'Estado Civil', 'required');
            $this->form_validation->set_rules('gender', 'Sexo', 'required');
            $this->form_validation->set_rules('lastName', 'Apellidos', 'required');
            $this->form_validation->set_rules('firstName', 'Nombre', 'required');
            $this->form_validation->set_rules('provincia', 'Dpto', 'required');
            $this->form_validation->set_rules('localidad', 'Ciudad', 'required');
            $this->form_validation->set_rules('address', 'Dirección', 'required');
            $this->form_validation->set_rules('tipo_vivienda', 'Tipo de vivienda', 'required');
            $this->form_validation->set_rules('meses_vivienda', 'Meses en vivienda', 'required|integer');
            $this->form_validation->set_rules('phone', 'Teléfono', 'required|integer');
            $this->form_validation->set_rules('celphone', 'Celular', 'required|integer');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('licencia_conduccion', 'No licencia conducción', 'required');
            $this->form_validation->set_rules('categoria_lic', 'Categoria', 'required');
            $this->form_validation->set_rules('theDatev', 'Fehca Vencimiento Licencia', 'required');           

            if ($this->form_validation->run() == FALSE) {
                $arr['mensaje'] = '';
                $arr['conxid'] = $this->Gps_model->get_user_gps_xid($id);
                $arr['paises'] = $this->Paises_model->get_pais();
                $this->load->view('admin/vwFormUserGps', $arr);
            } else {

                $this->Gps_model->update_perfil();
                $arr['conxid'] = $this->Gps_model->get_user_gps_xid($id);
                $arr['paises'] = $this->Paises_model->get_pais();
                $arr['mensaje'] = 'Datos actualizados correctamente';
                $this->load->view('admin/vwFormUserGps', $arr);
            }
        } else {
            $arr['conxid'] = $this->Gps_model->get_user_gps_xid($id);
            $arr['paises'] = $this->Paises_model->get_pais();
            $arr['mensaje'] = 'No se realizo actualización';
            $arr['count'] = $this->Users_model->obtenerUsersNuevos();
            $this->load->view('admin/vwFormUserGps', $arr);
        }
    }

}
