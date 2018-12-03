<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Registros extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model(array('Registros_model','Users_model'));
  }

  public function index() {
    $arr['mensaje'] = '';
    $this->load->view('registro', $arr);
  }

  public function validar_email() {
    $id = $this->input->post('id');
    $res = $this->Registros_model->validar_email($id);
    if ($res === TRUE) {
      echo "ok";
    } else {
      echo "error";
    }
  }

  public function eliminar($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    if($id){
      $this->Registros_model->eliminar_usuario($id);
      redirect(base_url() .'Registros/get_registros_sin_vermail');
    }
  }

  public function guardar() {
    $user = $this->input->post("username");
    $mail = $this->input->post("email");
    $pass = $this->input->post("password");
    $passconf = $this->input->post("passconf");
    if($pass!=$passconf){
      echo "errorpass";
    } else {
      $this->form_validation->set_rules('nombre', 'Nombre', 'required');
      $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');    
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('telefono', 'Telefono', 'required');
      $this->form_validation->set_rules('nivel', 'Nivel', 'required');
      $this->form_validation->set_rules('nivel', 'Nivel', 'required');
      $this->form_validation->set_rules('username', 'Usuario', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == FALSE)
      {
        $this->load->view('registro');
      }
      else
      {
        $data = array(
          'nombre' => $this->input->post("nombre", TRUE),
          'apellidos' => $this->input->post("apellidos", TRUE),
          'cedula' => $user,
          'email' => $mail,
          'telefono' => $this->input->post("telefono", TRUE),
          'idNivel' => $this->input->post("nivel", TRUE),
          'usuario' => $user,
          'pass' => md5($this->input->post("password", TRUE)),
          'codigo' => $this->input->post("code", TRUE),
          'estado' => 0,
          'permisos' => 0,
          'tipo' => $this->input->post("tipo", TRUE),
          'fecha_creacion' => date('Y-m-d H:i:s')
        );
        $res = $this->Registros_model->add_user($user,$data);
        if ($res === 0) {
          echo "error";
        }
        if ($res == TRUE) {
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
          'code'=> $this->input->post("code", TRUE),
          'nombre'=> $this->input->post("nombre", TRUE)." ".$this->input->post("apellidos", TRUE),
          'usuario'=> $user);
        $this->email->to($mail);
        $this->email->subject('Bienvenido a Enturne');
        $body = $this->load->view('email_registro_empresa.php',$data,TRUE);
        $this->email->message($body);
        $this->email->send();
          echo "ok";
        } else {
          echo "ko";
        } 
      }
    }
  }

  public function conductor_app() {
    $code = rand(1000, 99999);
    $nombre = $this->input->post("nombre");
    $apellidos = $this->input->post("apellidos");
    $telefono = $this->input->post("telefono");
    $email = $this->input->post("email");
    $usuario = $this->input->post("usuario");
    $pass = $this->input->post("pass");

    $this->Registros_model->add_conductor_app($nombre,$apellidos,$telefono,$email,$usuario,$pass,$code);

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
    $this->email->to($this->input->post('email', TRUE));
    $this->email->subject('Bienvenido a Enturne');
    $this->email->message('<h3>Estimado usuario: '.$usuario.'<br>'.' Sr(a): ' . $nombre . ' ' . $apellidos .'</h3>'. '<br>'
                          . 'Para confirmar su registro ingrese a la siguiente url '
                          . anchor(base_url() . 'Registros/confirmar/' . $code) . ' y complete la información, para poderle activar todas las funciones que le brinda ENTURNE.'
                          . '<br><br>Equipo Enturne.<br><br>Si tiene cualquier duda, contactanos a las líneas (571) 4968958  http://www.enturne.co/index.php/contactenos');
    $this->email->send();
  }

  public function empresa_app() {
    $code = rand(1000, 99999);
    $empresa = $this->input->post("empresa");
    $siglas = $this->input->post("siglas");
    $telefono = $this->input->post("telefono");
    $email = $this->input->post("email");
    $usuario = $this->input->post("usuario");
    $pass = $this->input->post("pass");

    $res = $this->Registros_model->add_empresa_app($empresa,$siglas,$telefono,$email,$usuario,$pass,$code);

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
    $this->email->to($this->input->post('email', TRUE));
    $this->email->subject('Bienvenido a Enturne');
    $this->email->message('<h3>Estimado usuario: '.$usuario.'<br>'.' Sr(a): ' . $empresa . ' ' . $siglas .'</h3>'. '<br>'
                          . 'Para confirmar su registro ingrese a la siguiente url '
                          . anchor(base_url() . 'Registros/confirmar/' . $code) . ' y complete la información, para poderle activar todas las funciones que le brinda ENTURNE.'
                          . '<br><br>Equipo Enturne.<br><br>Si tiene cualquier duda, contactanos a las líneas (571) 4968958  http://www.enturne.co/index.php/contactenos');
    $this->email->send();
  }

  public function guardaremp() {
    $this->db->select_max('idEmpresa');
    $consult = $this->db->get('Empresas');
    if ($consult->num_rows() > 0) {
      foreach ($consult->result() as $row) {
        $id_emp = $row->idEmpresa + 1;
      }
    }
    $nombre = $this->input->post("nombre", TRUE);
    $mail = $this->input->post('email', TRUE);
    $nit = $this->input->post("username", TRUE);
    $code = $this->input->post("code", TRUE);
    $dataEmp = array(
      'nombre_empresa' => $nombre,
      'siglas' => $this->input->post("siglas", TRUE),
      'nit' => $nit,
      'email' => $mail,
      'telefono' => $this->input->post("telefono", TRUE),
      'created_at' => date('Y-m-d H:i:s')
    );
    $dataUser = array(
      'email' => $mail,
      'telefono' => $this->input->post("telefono", TRUE),
      'idNivel' => $this->input->post("nivel", TRUE),
      'usuario' => $this->input->post("username", TRUE),
      'pass' => md5($this->input->post("password", TRUE)),
      'codigo' => $this->input->post("code", TRUE),
      'estado' => 0,
      'idEmpresa' => $id_emp,
      'permisos' => 0,
      'fecha_creacion' => date('Y-m-d H:i:s')
    );

    $res = $this->Registros_model->add_reg_emp($nit,$dataEmp,$dataUser);
    if ($res === false) {
      echo "ko";
    } else if($res === true){
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
        'code'=> $code,
        'nombre'=> $nombre,
        'usuario'=> $nit);
      $this->email->to($mail);
      $this->email->subject('Bienvenido a Enturne');
      $body = $this->load->view('email_registro_empresa.php',$data,TRUE);
      $this->email->message($body);
      $this->email->send();
      echo "ok";
    } else if($res === 0){
      echo "error";
    }
  }

  public function forget_pass() {
    $arr['mensaje'] = '';
    $this->load->view('forget_pass', $arr);
  }

  public function re_password() {

    $this->form_validation->set_rules('username', 'Usuario', 'trim|required|min_length[3]|max_length[12]');

    if ($this->form_validation->run() == FALSE) {
      $arr['mensaje'] = '';
      $this->load->view('forget_pass', $arr);
    } else {
      $res = $this->Registros_model->re_password();
      if ($res == FALSE) {
        $arr['mensaje'] = '* El usuario no existe.';
        $this->load->view('forget_pass', $arr);
      } else {
        foreach ($res as $value) {
          $nombre = $value->nombre . " " . $value->apellidos;
          $email = $value->email;
          $id = $value->idUser;
        }
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
        $this->email->to($email);
        $this->email->subject('Recordar Contraseña');
        $this->email->message('<h3>Estimado usuario: ' . $nombre . '</h3>'.'<br>'
                              . 'Usted solicito recordar contraseña, por favor dirijase a la siguiente URL y confirme su nueva contraseña:'
                              . anchor(base_url() . 'Registros/enter_new_pass/' . $id)
                              . '<br><br>Equipo Enturne.<br><br>Si tiene cualquier duda, contactanos a las líneas (571) 4968951<p><img style=border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 559px" src="'.base_url('assets/img/firmaemail.png').'" alt="Firma" width="559" height="165"><br><h5>AVISO LEGAL: La información transmitida a través de este correo electrónico es confidencial y dirigida única y exclusivamente para uso de su(s) destinatario(s). Su reproducción, lectura o uso está prohibido a cualquier persona o entidad diferente, sin autorización previa por escrito. Si usted lo ha recibido por error, por favor notifíquelo inmediatamente al remitente y elimínelo de su sistema. Cualquier uso, divulgación, copia, distribución, impresión o acto derivado del conocimiento total o parcial de este mensaje sin autorización del remitente será sancionado de acuerdo con las normas legales vigentes.  El presente mensaje y sus archivos anexos se encuentran libre de virus y defectos que puedan llegar a afectar los computadores o sistemas que lo reciban, no se hace responsable por la eventual transmisión de virus o programas dañinos por este conducto, y por lo tanto es responsabilidad del destinatario confirmar la existencia de este tipo de elementos al momento de recibirlo y abrirlo.<p>');
        $this->email->send();
        $arr['mensaje'] = 'Un mail ha sido enviado a su cuenta para validar su nueva contraseña.';
        $this->load->view('forget_pass', $arr);
      }
    }
  }

  public function enter_new_pass($id) {
    $arr['mensaje'] = '';
    $arr['datos'] = $this->Users_model->get_perfilxid($id);
    $this->load->view('re_password', $arr);
  }

  public function new_password() {
    $id=  $this->input->post('id');
    $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|matches[passconf]');
    $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'required');

    if ($this->form_validation->run() == FALSE) {
      $arr['mensaje'] = '';
      $arr['datos'] = $this->Users_model->get_perfilxid($id);
      $this->load->view('re_password', $arr);
    } else {
      $this->Registros_model->new_password();
      $arr['datos'] = $this->Users_model->get_perfilxid($id);
      $arr['mensaje'] = 'Nueva contraseña registrada correctamente, ya puede volver al login y loguearse con su usuario y nueva contraseña.';
      $this->load->view('re_password', $arr);
    }
  }

  public function very_estado() {
    $consulta = $this->db->get_where('users', array('usuario' => $this->input->post('username', TRUE),
                                                    'pass' => md5($this->input->post('password', TRUE)), 'estado' => '1'));

    if ($consulta->num_rows() == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function confirmar($code) {
    $res = $this->Registros_model->very($code, 'codigo');
    if ($res == FALSE) {
      $arr['mensaje'] = 'Este usuario no existe';
      $this->load->view('login', $arr);
    } else {
      $this->Registros_model->update_user($code);
      $arr['mensaje'] = 'Usuario confirmado con exito, inicie sesion';
      $this->load->view('login', $arr);
    }
  }

  public function get_registros_sin_val() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros para validar';
    $arr['registros'] = $this->Registros_model->registros_sin_val();
    $this->load->view('admin/vwRegistrosNactivos', $arr);
  }

  public function get_registros_val() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $id = $session_data['id'];
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $idempresa = $session_data['idempresa'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros validados';
    $arr['registros'] = $this->Registros_model->registros_val();
    $this->load->view('admin/vwRegistrosActivos', $arr);
  }

  public function get_registros_sin_vermail() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros pendientes de verificar email';
    $arr['registros'] = $this->Registros_model->registros_sin_vermail();
    $this->load->view('admin/vwRegistrosSinVerMail', $arr);
  }

  public function get_registros_ult_sem() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = '0 registros nuevos sin activar en los ultimos 7 días';
    $arr['registros'] = $this->Registros_model->registros_ult_sem();
    $this->load->view('admin/vwRegistrosUltSem', $arr);
  }

  public function get_registrosxid_ult_sem($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    if (!$id) {
      show_404();
    }
    $arr['registro'] = $this->Registros_model->get_registroxid_ult_sem($id);
    $this->load->view('admin/vwActivarRegistro', $arr);
  }
  public function activar_registro_emp() {
    $idemp = $this->input->post('id');
    $res = $this->Registros_model->activar_registro_emp($idemp);
    if($res == TRUE){
      echo 'ok';
    } else {
      echo 'error';
    }    
  }

  public function activar_registro() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;

    $this->Registros_model->activar_registro();
    redirect(base_url() . 'Registros/get_registros_ult_sem');
  }

  public function registros_pen_docs_total() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $this->load->view('admin/vwPenDocsxCat',$arr);
  }

  public function pen_docs_empresa() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros pendientes de documentación';
    $arr['registros'] = $this->Registros_model->pen_docs_empresa();
    $this->load->view('admin/vwPenDocsEmpresas', $arr);
  }

  public function pend_docs_vehiculos() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros pendientes de documentación';
    $arr['registros'] = $this->Registros_model->pend_docs_vehiculos();
    $this->load->view('admin/vwPenDocsVehiculos', $arr);
  }

  public function pend_docs_conductores() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros pendientes de documentación';
    $arr['registros'] = $this->Registros_model->pend_docs_conductores();
    $this->load->view('admin/vwPenDocsConductores', $arr);
  }

  public function get_pendocs_vehiculoxid($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    if (!$id) {
      show_404();
    }
    $arr['mens'] = '';
    $arr['registro'] = $this->Registros_model->get_pendocs_vehiculoxid($id);
    $this->load->view('admin/vwSubirDocsVehiculo', $arr);
  }

  public function get_pendocsxid($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    if (!$id) {
      show_404();
    }
    $arr['mens'] = '';
    $arr['registro'] = $this->Registros_model->get_pendocsxid($id);
    $this->load->view('admin/vwSubirDocsUser', $arr);
  }

  public function get_pendocs_emp_xid($id) {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    if (!$id) {
      show_404();
    }
    $arr['mens'] = '';
    $arr['registro'] = $this->Registros_model->get_pendocs_emp_xid($id);
    $this->load->view('admin/vwSubirDocsEmp', $arr);
  }

  public function registros_completos() {
    $session_data = $this->session->userdata('datos_usuario');
    if(!$session_data){
      redirect('Login');
    } 
    $usuario = $session_data['usuario'];
    $nombre = $session_data['nombre'];
    $apellidos = $session_data['ape'];
    $arr['usuario'] = $usuario;
    $arr['nombre'] = $nombre;
    $arr['apellidos'] = $apellidos;
    $arr['mensaje'] = 'No hay registros completos';
    $arr['registros'] = $this->Registros_model->registros_completos();
    $this->load->view('admin/vwRegistroscompletos', $arr);
  }

  public function subir_pdf_user() {
    if ($this->input->post('update_pdf')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
      $config['max_size'] = '2048';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        $arr['mens'] = 'Fallo al subir el doc, revise e intentelo de nuevo';
        redirect(base_url() . 'admin/vwSubirDocsUser', $arr);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, Y
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_pdf_user($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_foto_cc_user() {
    if ($this->input->post('update_doc')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {

        redirect(base_url() . 'admin/Dashboard');
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_foto_cc_user($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_foto_lic_user() {
    if ($this->input->post('update_lic')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {

        redirect(base_url() . 'admin/Dashboard');
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_foto_lic_user($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_logo() {
    if ($this->input->post('update_logo')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '5096';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_logo($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_rut() {
    if ($this->input->post('update_rut')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_rut($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_camaracomercio() {
    if ($this->input->post('update_camara')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_camaracomercio($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_pdf_emp() {
    if ($this->input->post('update_pdf')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
      $config['max_size'] = '2048';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, Y
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_pdf_emp($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_soat() {
    if ($this->input->post('update_soat')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_soat($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
  }

  public function subir_rtecno() {
    if ($this->input->post('update_rtecno')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_rtecno($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_ltransito() {
    if ($this->input->post('update_ltransito')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_ltransito($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_ccprop() {
    if ($this->input->post('update_ccprop')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_ccprop($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_rutprop() {
    if ($this->input->post('update_rutprop')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_rutprop($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_carnet() {
    if ($this->input->post('update_carnet')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '50000';
      $config['max_width'] = '2000';
      $config['max_height'] = '2000';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_carnet($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

  public function subir_pdf_vehiculo() {
    if ($this->input->post('update_pdfv')) {

      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
      $config['max_size'] = '2048';

      $this->load->library('upload', $config);
      if (!$this->upload->do_upload()) {
        header("Location:" . $_SERVER['HTTP_REFERER']);
      } else {
        //EN OTRO CASO SUBIMOS LA IMAGEN, Y
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
        $file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

        $arr = array('upload_data' => $this->upload->data());
        $imagen = $file_info['file_name'];
        $subir = $this->Registros_model->subir_pdf_vehiculo($imagen);
        header("Location:" . $_SERVER['HTTP_REFERER']);
      }
    }
  }

}
