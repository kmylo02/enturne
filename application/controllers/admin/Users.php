<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Paises_model'));
    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page'] = 'user';
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwManageUser', $arr);
    }

    public function add_user() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwAddUser', $arr);
    }

    public function guardar_user() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        if ($this->input->post('guardar_user')) {

            $this->Users_model->add_user();
            $arr = array('mensaje' => 'Usuario agregado corectamente');
            redirect(base_url() . 'admin/Vehiculos', $arr);
        } else {
            $arr = array('mensaje' => 'No se realizo registro');
            redirect(base_url() . 'admin/Vehiculos', $arr);
        }
    }

    public function edit_user() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page'] = 'user';
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwEditUser', $arr);
    }

    public function block_user() {
        // Code goes here
    }

    public function delete_user() {
        // Code goes here
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
