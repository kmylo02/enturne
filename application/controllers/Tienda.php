<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Tienda
 *
 * @author jj
 */
class Tienda extends CI_Controller
{

    public function index() 
    {
        $data['title'] = 'Tienda Prueba Place to Pay';
        $this->load->view('placetopay/index',$data);
    }

}
