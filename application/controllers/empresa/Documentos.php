<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documentos extends CI_Controller {

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
        
    }

    public function cambio_docs() {
        
        $this->load->library("email");
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.enturne.co',
            'smtp_port' => 465,
            'smtp_user' => 'soporte@enturne.co',
            'smtp_pass' => 'ENTURNE26043',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );
        $this->email->initialize($config);
        $this->email->from('Plataforma Enturne');
        $this->email->to('administrativo@enturne.co');

        $this->email->subject($_SESSION['usuario']);
        $this->email->message($this->input->post('mensaje'));
        $this->email->send();
        redirect(base_url() . 'empresa/Perfil/get_empresa');
    }

}
