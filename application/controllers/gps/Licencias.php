<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Licencias extends CI_Controller {
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
        $arr['mensaje']='No hay licencias disponibles en el momento';
        $arr['licencias'] = $this->Productos_model->get_productos_conductor();        
        $this->load->view('gps/vwLicencias',$arr);
    }
    
    public function get_licencia_xid($id) {       
        $arr['licencia'] = $this->Productos_model->get_producto_xid($id);        
        $this->load->view('gps/vwFormLicencia',$arr);
    }
    
    public function adquirir_licencia() { 
        if($this->input->post('reg_lic')){ 
            $res = $this->Vehiculos_model->adquirir_licencia();
            if ($res==FALSE) {
                $arr['mensaje'] = 'Usted ya ha hecho uso de su licencia gratuita, por favor adquiera una licencia de mesualidad o pago anual.';
                $this->load->view('gps/vwMensajePago', $arr);
            } else {
            $this->Vehiculos_model->adquirir_licencia();
            $arr['mensaje']='Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y tendra en su panel el vehiculo registrado.';
            $this->load->view('gps/vwMensajePago',$arr);
            }
        }
    }

    public function activar_licencia() {    
    $this->Vehiculos_model->activar_licencia();
    }
}