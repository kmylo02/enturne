<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Opciones extends CI_Controller {
/**
 * ark Admin Panel for Codeigniter 
 * Author: Jhon Jairo Valdés Aristizabal
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
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
        $arr['page']='dash';  
        $this->load->view('admin/vwOpciones',$arr);
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */