<?php
class Cron_licc extends CI_Controller {

  public function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
  }
  
  public function vence() {
      $mailEnturne = 'registro@enturne.co';
      $mailSistemas = 'soporte@enturne.co';
      $res = $this->Users_model->get_users();
      if(isset($res)){
          foreach ($res as $value) {
            $nombre = $value->nombre.' '.$value->apellidos;
            $fecha = $value->fecha_ven_licencia;
            $mail = $value->email;
            $ff = date('Y-m-d');
            $df = $this->dias_transcurridos($ff,$fecha);
            if($df > 0 && $df <= 5) {
                $config['charset'] = 'utf-8';
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
                $this->email->send();  
            }  
          }
      } 
  }
  function dias_transcurridos($fecha_i,$fecha_f) {
	$dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias = abs($dias);
        $dias = floor($dias);		
	return $dias;
   }

}

