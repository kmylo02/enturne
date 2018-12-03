<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Contact extends CI_Controller {

    public function index() {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $mensj = $this->input->post('mensj');
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
                'nombre' => $name,
                'email' => $email,
                'mensaje' => $mensj
            );
            $this->email->to('contacto@enturne.co');
            $this->email->cc('neoxyx@gmail.com');
            $this->email->subject($subject);
            $body = $this->load->view('email_contact.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo 'ok';
    }

}
