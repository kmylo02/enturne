<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gps extends CI_Controller {
    /**
 * ark Admin Panel for Codeigniter 
 * Author: Jhon Jairo Valdés Aristizabal
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Vehiculos_model','Paises_model','Gps_model'));

    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $id = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $nombre;
        $data['apellidos'] = $apellidos;
        $data['estado'] = $session_data['activo'];
        $data['tipo'] = $session_data['tipo'];
        $data['vehiculos'] = $this->Vehiculos_model->get_vehiculos_x_propietario_satelital($id);
        $data['paises'] = $this->Paises_model->get_pais();
        $data['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $data['titulo'] = 'Seguimiento vehicular satelital';
        $this->load->view('conductor/vwGps', $data); 
    }
    public function get_datos_satelital() {
        $idv = $this->input->get("idv");
        $arr['vehiculo'] = $this->Gps_model->get_datos_satelital($idv);
        ;
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    public function get_ultimo_movimiento() {
        $idv = $this->input->get("idv");
        $arr['mov'] = $this->Gps_model->get_ultimo_movimiento($idv);
        ;
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */