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
        $this->load->model(array('Productos_model','Vehiculos_model','Empresas_model'));
    }

  public function index() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];

    $arr['mensaje'] = 'No hay licencias disponibles en el momento';
    $arr['licencias'] = $this->Productos_model->get_productos_empresa();
    $this->load->view('empresa/vwLicencias', $arr);
  }

  public function lic_vehiculos() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];
    $arr['mensaje'] = 'No hay licencias disponibles en el momento';
    $arr['licencias'] = $this->Productos_model->get_productos_conductor();
    $this->load->view('empresa/vwLicenciasVehiculo', $arr);
  }

  public function get_licencia_xid($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];
    $arr['licencia'] = $this->Productos_model->get_producto_xid($id);
    $this->load->view('empresa/vwFormLicencia', $arr);
  }

  public function adquirir_licencia_empresa() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];
    if ($this->input->post('reg_lic')) {
      $res = $this->Empresas_model->adquirir_licencia();
      if ($res===FALSE) {
        $arr['mensaje'] = 'Usted ya ha hecho uso de su licencia gratuita, por favor adquiera una licencia de mesualidad o pago anual.';
        $this->load->view('empresa/vwMensajePago', $arr);
      } else {
        $this->Empresas_model->adquirir_licencia();
        $arr['mensaje'] = 'Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y tendra su panel completamente desbloqueado.';
        $this->load->view('empresa/vwMensajePago', $arr);
      }
    }
  }

  public function get_licencia_vehiculos_xid($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];
    $arr['licencia'] = $this->Productos_model->get_producto_xid($id);
    $this->load->view('empresa/vwFormLicenciaVehiculo', $arr);
  }

  public function adquirir_licencia_vehiculo() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    }  
    $consulta = $this->db->get_where('users', array('usuario' => $session_data['usuario']));
    if ($consulta->num_rows() != 0) {
      foreach ($consulta->result() as $row) {
        $permiso = $row->permisos;
      }
    }
    $consulta1 = $this->db->get_where('Empresas', array('id' => $session_data['idempresa']));
    if ($consulta1->num_rows() != 0) {
      foreach ($consulta1->result() as $val) {
        $activo=$val->activo;
      }
    }else{
      $activo=0;
    }

    $conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
    $vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $session_data['id'])); // get query result
    $consulta2 = $this->db->get_where('ci_reportes', array('id_empresa' => $session_data['idempresa']));
    if ($consulta2->num_rows() != 0) {
      foreach ($consulta2->result() as $row) {
        $arr['conductor']=$row->conductor;
        $arr['mensaje']=$row->mensaje;
        $arr['created_at']=$row->created_at;
      }
    }
    $arr['count1'] = $conductores->num_rows(); //get current query record.
    $arr['count2'] = $vehiculos->num_rows(); //get current query record.
    $arr['permiso'] = $permiso;
    $arr['activo'] = $activo;
    $arr['conductor'] = '';
    $arr['mensaje'] = '';
    $arr['created_at'] = '';
    $arr['id'] = $session_data['id'];
    $usuario = $session_data['usuario'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $session_data['nombre'];
    $arr['apellidos'] = $session_data['ape'];
    $arr['idempresa'] = $session_data['idempresa'];
    if ($this->input->post('reg_lic')) {
      $this->Vehiculos_model->adquirir_licencia();
      $arr['mensaje'] = 'Gracias por su adquisión, en cuanto el pago sea acreditado se le enviara un mensaje de confirmación y tendra en su panel el vehiculo registrado.';
      $this->load->view('empresa/vwMensajePago', $arr);
    }
  }

  public function activar_licencia_vehiculo() {
    $this->Vehiculos_model->activar_licencia();
  }

}
