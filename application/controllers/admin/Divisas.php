<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Divisas extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter 
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model','Divisas_model'));
    }

    public function index() {  
		$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['datos'] = $this->Divisas_model->get_divisa();
        $this->load->view('admin/vwDivisas', $arr);
    }

    public function add_idioma() {
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
        $arr['page'] = 'idioma';
        $this->load->view('admin/vwIdioma', $arr);
    }

    public function edit_pais() {
		$session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
            redirect('Login');
        } 
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page'] = 'paises';
        $this->load->view('admin/vwIdioma', $arr);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


