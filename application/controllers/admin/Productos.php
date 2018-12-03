<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Productos extends CI_Controller {
	/**
 * ark Admin Panel for Codeigniter 
 * Author: Jhon Jairo Valdés Aristizabal
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model','Productos_model','Idioma_model','Impuestos_model','Monedas_model','Categorias_model'));
    }

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		if(!$session_data){
			redirect('Login');
		} 
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['mensaje']='No existen productos aun';
		$arr['product'] = $this->Productos_model->get_productos();
		$this->load->view('admin/vwProductos',$arr);
	}

	public function add_producto() {
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
		$arr['idioma']=  $this->Idioma_model->get_idioma();
		$arr['tax']=$this->Impuestos_model->get_impuesto();
		$arr['moneda']=$this->Monedas_model->get_moneda();
		$arr['cat'] = $this->Categorias_model->get_categorias();
		$this->load->view('admin/vwAddProducto',$arr);
	}

	public function edit_producto() {
		$session_data = $this->session->userdata('datos_usuario');
		if(!$session_data){
			redirect('Login');
		} 
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['page'] = 'products';
		$this->load->view('admin/vwEditUser',$arr);
	}

	public function activar($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if(!$session_data){
			redirect('Login');
		} 
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$this->Productos_model->activar($id);
		redirect(base_url().'admin/Productos');
	}

	public function desactivar($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if(!$session_data){
			redirect('Login');
		} 
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$this->Productos_model->desactivar($id);
		redirect(base_url().'admin/Productos');
	}





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


