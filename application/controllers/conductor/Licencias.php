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
        $this->load->model(array('Productos_model','Vehiculos_model'));

    }

    public function index($idv) {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $nombre;
        $data['apellidos'] = $apellidos;
        $data['estado'] = $session_data['activo'];
        $data['tipo'] = $session_data['tipo'];
        $data['idv'] = $idv;
        $data['mensaje']='No hay licencias disponibles en el momento';
        $data['licencias'] = $this->Productos_model->get_productos_conductor();        
        $this->load->view('conductor/vwLicencias',$data);
    }
    
    public function get_licencia_xid($id,$idv) { 
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $idUsuario = $session_data['id'];
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $nombre;
        $data['apellidos'] = $apellidos;
        $data['estado'] = $session_data['activo'];
        $data['tipo'] = $session_data['tipo'];
        $data['idv'] = $idv;
        $data['licencia'] = $this->Productos_model->get_producto_xid($id);        
        $this->load->view('conductor/vwFormLicencia',$data);
    }
    
    public function adquirir_licencia() {
      $idlic = $this->input->post('idlic');
      $codLic = $this->input->post('codigo');
      $idv = $this->input->post('idv');
      $precio = $this->input->post('precio');
      $days = '';
      $very = $this->Vehiculos_model->verificar_licencia($codLic,$idv);
      if($very === TRUE){
        echo 'ko';
      } else {
        if ($idlic == 4){
        $days = '93 days';
        }
        if ($idlic == 5) {
        $days = '31 days';
        }
        if ($idlic == 6) {
        $days = '365 days';
        }
        $fecha = date_create(date('Y-m-d'));
        date_add($fecha, date_interval_create_from_date_string($days));
        $vence = date_format($fecha, 'Y-m-d');
        $data = array(
                    'activo' => 4,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'vencelic' => $vence
                );
        $arr = array(
                'or_id_vehiculo' => $idv,
                'or_codigo_lic' => $codLic,
                'or_precio_lic' => $precio,
                'created_at' => date('Y-m-d H:i:s')
            );
        $res = $this->Vehiculos_model->adquirir_licencia($idv,$data,$arr);
            if ($res==TRUE) {
              echo 'ok';
            } else {
              echo 'error';
            } 
      }      
    }
}