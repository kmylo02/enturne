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
        $this->load->model("Gps_model");
    }

    public function index() {
        //$this->getResponse()->setHttpHeader('Content-type','application/json');
        //header('Content-Type: application/json');
        $array = array("RespServ" => array());
        $mensaje = "";
        if($this->input->get('mensaje')){
            $data = array(
                "codigo" => $this->input->get('nombreequipo'),
                "mensaje" => $this->input->get('mensaje'),
                "created_at" => date('Y-m-d H:i:s')
                );
            $res = $this->Gps_model->add_mensaje_completo($data);
            if($res == true){
                $gps = $this->Gps_model->get_imei($this->input->get('nombreequipo'));
                if($gps){
                    foreach($gps as $row){
                        $idv = $row->vehiculo_id;
                    }
                $data = array(
                "vehiculo_id" => $idv,
                "nombreevento" => $this->input->get('nombreevento'),
                "nombreequipo" => $this->input->get('nombreequipo'),
                "altitud" => $this->input->get('altitud'),
                "latitud" => $this->input->get('latitud'),
                "longitud" => $this->input->get('longitud'),
                "velocidad" => $this->input->get('velocidad'),
                "bateria" => $this->input->get('bateria'),
                "encendido" => $this->input->get('encendido'),
                "sos" => $this->input->get('sos'),
                "horagps" => $this->input->get('horagps'),
                "horamsj" => $this->input->get('horamsj'),
                "odometro" => $this->input->get('odometro'),
                "input1" => $this->input->get('input1'),
                "input2" => $this->input->get('input2'),
                "created_at" => date('Y-m-d H:i:s')
                );
                $res = $this->Gps_model->add_movimiento($data);
                    if($res == true){
                        $mensaje = "Se ingreso el movimiento correctamente.";
                    } else { 
                        $mensaje = "No Se ingreso el movimiento.";
                    }
                } else { 
                    $mensaje = "El imei del dispositivo no se encuentra registrado";
                }
            }else{ $mensaje = "No envio correctamente la traza."; }
             array_push($array["RespServ"], array("mensaje" => $mensaje));
                echo json_encode($array);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */