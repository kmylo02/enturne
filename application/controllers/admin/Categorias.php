<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter 
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model','Categorias_model'));
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
        $arr['mensaje'] = 'No hay categorias creadas';
        $arr['cat'] = $this->Categorias_model->get_categorias();
        $this->load->view('admin/vwCategorias', $arr);
    }

    public function add_categoria() {
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
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwAddCategoria',$arr);
    }

    public function guardar_categoria() {
        if ($this->input->post('reg_cat')) {
            $this->Categorias_model->add_categoria();
            redirect(base_url() . 'admin/Categorias');
        }
    }

    public function get_categoria_xid($id) {
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
        $arr['cat'] = $this->Categorias_model->get_categoria_xid($id);
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwEditCategoria', $arr);
    }

    public function edit_categoria() {
        if ($this->input->post('update_cat')) {
            $this->Categorias_model->edit_categoria();
            redirect(base_url() . 'admin/Categorias');
        }
    }

    public function block_categoria() {
        // Code goes here
    }

    public function delete_categoria() {
        // Code goes here
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

