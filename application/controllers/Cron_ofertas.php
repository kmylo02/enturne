<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cron_ofertas
 *
 * @author jj
 */
class Cron_ofertas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ofertas_model');
    }

    public function cerrar() {
        //$mailEnturne = 'registro@enturne.co';
        //$mailSistemas = 'soporte@enturne.co';
        $res = $this->Ofertas_model->get_ofertas();
        if (isset($res)) {
            foreach ($res as $value) {
                $fecha = $value->fecha;
                //$trayecto = $value->origen."-".$value->destino;
                //$mailEmp = $value->email;
                //$noperador = $value->nombre." ".$value->apellidos;
                $ff = date('Y-m-d');
                $df = $this->dias_transcurridos($ff, $fecha);
                if ($df > 2) {
                    $this->Ofertas_model->cerrar_oferta($value->id);
                    /* $config['charset'] = 'utf-8';
                      $config['newline'] = "\r\n";
                      $config['mailtype'] = 'html';
                      $config['protocol'] = 'mail';
                      $config['smtp_host'] = 'mail.enturne.co';
                      $config['smtp_port'] = '465';
                      $config['smtp_user'] = 'soporte@enturne.co';
                      $config['smtp_pass'] = 'ENTURNE260413';
                      $config['validation'] = TRUE;
                      $this->email->initialize($config);
                      $this->email->clear();
                      $this->email->from('soporte@enturne.co', 'Enturne En Linea');
                      $data = array(
                      'nombre'=> $nombre,
                      'doc'=> 'Licencia de conducción',
                      'fecha'=> $fecha
                      );
                      $this->email->to($mail);
                      $this->email->cc($mailEnturne);
                      $this->email->bcc($mailSistemas);
                      $this->email->subject('Se documento esta proximo a vencer');
                      $body = $this->load->view('vencimiento_docs.php',$data,TRUE);
                      $this->email->message($body);
                      $this->email->send(); */
                }
                echo "oferta: ".$value->id." dias: ".$df."<br>";
            }
        }
    }

    function dias_transcurridos($fecha_i, $fecha_f) {
        $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }

}
