<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Vehiculos extends CI_Controller {

  /**
  * ark Admin Panel for Codeigniter
  * Author: Jhon Jairo Valdés Aristizabal
  * downloaded from http://devzone.co.in
  *
  */
  public function __construct() {
    parent::__construct();
    $this->load->model('Vehiculos_model');
  }

  public function index() {


  }

  public function vehiculo_app() {
          $id=$this->input->get("idConductor");
          $data['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xidconductor($id);
          $resultadosJson = json_encode($data);
          echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
  }

  public function tipov() {
    $data['tipo'] = $this->Vehiculos_model->get_tipo_vehiculo();
    $resultadosJson = json_encode($data);
    echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
  }

  public function carrocerias() {
    $data['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
    $resultadosJson = json_encode($data);
    echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
  }

}
