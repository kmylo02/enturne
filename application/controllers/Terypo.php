<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Terypo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
        
    }
    
    public function term() {
        $data['mensaje'] = '';
        $this->load->view('terminos', $data);
    }
    
    public function pol() {
        $data['mensaje'] = '';
        $this->load->view('politicas', $data);
    }
}
