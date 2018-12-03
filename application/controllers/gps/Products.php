<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller {
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
        $arr['page'] = 'products';
        $this->load->view('gps/vwManageProduct',$arr);
    }

    public function add_user() {
        $arr['page'] = 'products';
        $this->load->view('gps/vwAddUser',$arr);
    }

     public function edit_user() {
        $arr['page'] = 'products';
        $this->load->view('gps/vwEditUser',$arr);
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