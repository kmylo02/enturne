<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Reportes_model');
    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['tipo'] = $session_data['tipo'];
        $data['estado'] = $session_data['activo'];
        $this->load->view('conductor/vwReportes',$data);
    }

    public function programo_mi_viaje() {
        $session_data = $this->session->userdata('datos_usuario');
      if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['tipo'] = $session_data['tipo'];
        $data['estado'] = $session_data['activo'];
        $this->load->view('conductor/vwProgViaje',$data);
    }

    public function enCargue() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->enCargue($idEmpresa,$idUsuario,$conductor,$idCarga,$ubicacion);
    }

    public function enDescargue() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->enDescargue($idEmpresa,$idUsuario,$conductor,$idCarga,$ubicacion);
    }

    public function enRuta() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->enRuta($idEmpresa,$idUsuario,$conductor,$idCarga,$ubicacion);

    }

    public function cargado() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->cargado($idEmpresa,$idUsuario,$conductor,$idCarga,$ubicacion);

    }

    public function descargado() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->descargado($idEmpresa,$idUsuario,$conductor,$idCarga,$ubicacion);

    }

    public function mensaje() {
        $idEmpresa=$this->input->post('idEmpresa');
        $idUsuario=$this->input->post('idUsuario');
        $conductor=$this->input->post('conductor');
        $mens=$this->input->post('mensj');
        $idCarga=$this->input->post('idCarga');
        $ubicacion=$this->input->post('ubicacion');
        $this->Reportes_model->mensaje($idEmpresa,$idUsuario,$conductor,$mens,$idCarga,$ubicacion);
    }
  
    public function enviar_mensaje_web() {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $msn = $this->input->post('msn');
        $data = array('conductor' => $usuario,
                     'comentario' => $msn,
                     'created_at' => date('Y-m-d H:i:s'));
        $res = $this->Reportes_model->enviar_mensaje_web($data);
      if($res == TRUE){
        echo 'ok';
      } else {
        echo 'error';
      }
    }

    public function getRepoEnviados() {
        $conductor=$this->input->get('conductor');
        $idCarga=$this->input->get('idCarga');
        $res = $this->Reportes_model->getRepoEnviados($conductor,$idCarga);
        if($res === false){
            $data['validacion'] = 'Error';
            $data["respuesta"] = "Sin datos";
            $resultadosJson = json_encode($data);
        } else {
            $data['validacion'] = 'Ok';
            $data["respuesta"] = "Exito";
            $data['repo']=$this->Reportes_model->getRepoEnviados($conductor,$idCarga);
            $resultadosJson = json_encode($data);
        } 
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function repoEnviados() {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['tipo'] = $session_data['tipo'];
        $data['estado'] = $session_data['activo'];
            $res = $this->Reportes_model->repoEnviados($usuario);
            $body="";
            if($res!=false){
                foreach($res as $row){
                    $body .= '<tr><td>'.$row->origen.'-'.$row->destino.'</td><td>'.$row->nombre_empresa.'</td><td>'.$row->mensaje.'</td><td>'.$row->created_at.'</td></tr>';
                }
                $data['body'] = $body;
            } else {                
                $data['body'] = "<tr><td><h3 style='color:red'>No has enviado reportes aún</h3><td><tr>";            
            }
            $this->load->view('conductor/vwListaReportes',$data);
    }

    public function getDetalleRepo() {

        $idCarga=$this->input->get('idCarga');
        $res = $this->Reportes_model->getDetalleRepo($idCarga);
        if($res === false){
            $data['validacion'] = 'Error';
            $data["respuesta"] = "Sin datos";
            $resultadosJson = json_encode($data);
        } else {
            $data['validacion'] = 'Ok';
            $data["respuesta"] = "Exito";
            $data['carga']=$this->Reportes_model->getDetalleRepo($idCarga);
            $resultadosJson = json_encode($data);
        } 
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function lista_mensajes() {
        $session_data = $this->session->userdata('datos_usuario');
      if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['tipo'] = $session_data['tipo'];
        $data['estado'] = $session_data['activo'];
        $res = $this->Reportes_model->mensajes_conductores($usuario);
            if($res!=false){
                foreach($res as $row){
                    $body .= '<tr><td>'.$row->user.'-'.$row->comentario.'</td><td>'.$row->ubicacion.'</td><td>'.$row->created_at.'</td></tr>';
                }
                $data['body'] = $body;
            } else {                
                $data['body'] = "<tr><td><h3 style='color:red'>Sin mensajes</h3><td><tr>";            
            }
            $this->load->view('conductor/vwListaMensajes',$data);
    }
    
    public function lista_enviados() {
        $session_data = $this->session->userdata('datos_usuario');
        if(!$session_data){
          redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['tipo'] = $session_data['tipo'];
        $data['estado'] = $session_data['activo'];
        $body = ''; 
            $res = $this->Reportes_model->mensajes_enviados($usuario);
            if($res!=false){
                foreach($res as $row){
                    $body .= '<tr><td>'.$row->comentario.'</td><td>'.$row->ubicacion.'</td><td>'.$row->created_at.'</td></tr>';
                }
                $data['body'] = $body;
            } else {                
                $data['body'] = "<tr><td><h3 style='color:red'>Sin mensajes</h3><td><tr>";            
            }
            $this->load->view('conductor/vwListaEnviados',$data);
    }

}
