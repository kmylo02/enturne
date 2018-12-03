<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empresas extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Empresas_model', 'Paises_model', 'Docs_model'));
    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['aviso'] = '';
        $datosEmpresa = $this->Empresas_model->get_empresas_inactivas();
        if ($datosEmpresa) {
            $n = 0;
            foreach ($datosEmpresa as $value) {
                $idempresa = $value->idEmpresa;
                $datosEmpresa[$n]->verificarDocs = $this->verificarDocs($idempresa);
                $n++;
            }
            $arr['datos'] = $datosEmpresa;
        }
        $this->load->view('admin/vwManagerEmpresa', $arr);
    }

    public function activosEmpresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['aviso'] = '';
        $datosEmpresa = $this->Empresas_model->get_empresas_activas();
        if ($datosEmpresa != false) {
            $n = 0;
            foreach ($datosEmpresa as $value) {
                $idempresa = $value->idEmpresa;
                $datosEmpresa[$n]->verificarDocs = $this->verificarDocs($idempresa);
                $n++;
            }

            $arr['datos'] = $datosEmpresa;
        } else {
            $arr['datos'] = '';
            $arr['mensaje'] = 'Sin registros';
        }
//		echo "<pre>";
//		print_r($arr);
        $this->load->view('admin/vwActivosEmpresa', $arr);
    }

    

    function verificarDocs($id) {
        $boton = "<a href='".base_url() .
        'admin/Docs/lista_pend_empresas_xid/' .
        $id."' title='Sin Documentación'><i class='fa fa-folder fa-2x'></i></a>";
        $sinaprobar = $this->Docs_model->very_docs_x_aprobar_emp_xid($id);
        $aprobados = $this->Docs_model->very_docs_aprobados_emp_xid($id);
        $rechazados = $this->Docs_model->very_docs_rechazados_emp_xid($id);
        if ($sinaprobar->num > 2) {
            $boton = "<a href='".base_url() .
        'admin/Docs/lista_pend_empresas_xid/' .
        $id."' title='Documentación pendiente por aprobar'><i class='fa fa-folder-open fa-2x'></i></a>";            
        } else 
        if ($aprobados->num > 2){
            $boton = "<a href='".base_url() .
                    'admin/Docs/lista_pend_empresas_xid/' .
                    $id."' title='Sin Pendientes"
                    . " documentos aprobados'><img src=" .
                    base_url('assets/img/docsaprobados.png') .
                    " alt='sin imagen'/></a>";
        } else 
        if ($rechazados->num > 0){
            $boton = "<a href='".base_url() .
                    'admin/Docs/lista_pend_empresas_xid/' .
                    $id."' title='Con documentos rechazados'><img src=" .
                    base_url('assets/img/DocsRechazados.png') .
                    " alt='sin imagen'/></a>";
        }
        return $boton;
    }

    public function edit_empresaxid($idEmpLista) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['mensaje'] = '';
        $paises = $this->Paises_model->get_pais();
        $key = $this->Empresas_model->get_empxid($idEmpLista);
        $arr['nombre_empresa'] = $key->nombre_empresa;
        $arr['id'] = $key->idEmpresa;
        $arr['logo'] = $key->logo;
        $arr['siglas'] = $key->siglas;
        $arr['nit'] = $key->nit;
        $dptoemp = $key->departamentos_id;
        $optdpto = "";
        foreach ($paises as $fila) {
            $dpto = $fila->idDepartamento;
            if ($dpto == $dptoemp) {
                $optdpto .= "<option value='" . $dpto . "' selected='selected'>" . $fila->nombre_dpto . "</option>";
            } else {
                $optdpto .= "<option value='" . $dpto . "'>" . $fila->nombre_dpto . "</option>";
            }
        }
        $arr['optdpto'] = $optdpto;
        $arr['optciudad'] = "<option value='" . $key->idCiudad . "'>" . $key->nombre_ciudad . "</option>";
        $arr['direccion'] = $key->direccion;
        $arr['telefono'] = $key->telefono;
        $arr['fax'] = $key->fax;
        $arr['celular'] = $key->celular;
        $arr['email'] = $key->email;
        $arr['web'] = $key->web;
        $carga = $key->tipo_carga;
        if ($carga == "") {
            $arr['optcarga'] = "<option value='Paqueteo'>Paqueteo</option>
                    <option value='Carga Masiva'>Carga Masiva</option>
                    <option value='Paqueteo y Carga Masiva'>Paqueteo y Carga Masiva</option>";
        }
        if ($carga == "Paqueteo") {
            $arr['optcarga'] = "<option value='Paqueteo' selected = 'selected'>Paqueteo</option>
                    <option value='Carga Masiva'>Carga Masiva</option>
                    <option value='Paqueteo y Carga Masiva'>Paqueteo y Carga Masiva</option>";
        }
        if ($carga == "Carga Masiva") {
            $arr['optcarga'] = "<option value='Paqueteo'>Paqueteo</option>
                    <option value='Carga Masiva' selected = 'selected'>Carga Masiva</option>
                    <option value='Paqueteo y Carga Masiva'>Paqueteo y Carga Masiva</option>";
        }
        if ($carga == "Paqueteo y Carga Masiva") {
            $arr['optcarga'] = "<option value='Paqueteo'>Paqueteo</option>
                    <option value='Carga Masiva' selected = 'selected'>Carga Masiva</option>
                    <option value='Paqueteo y Carga Masiva' selected = 'selected'>Paqueteo y Carga Masiva</option>";
        }
        $lic = $key->activo;
        if ($lic == 0) {
            $arr['optlic'] = "<option value='0'>Sin compra de licencia</option><option value='0'>Desactivar</option>
                    <option value='2'>Activar</option>";
        }
        if ($lic == 1) {
            $arr['optlic'] = "<option value='1'>Compro licencia, verificar Pago</option><option value='2'>Activar</option>";
        }
        if ($lic == 2) {
            $arr['optlic'] = "<option value='2'>Licencia Activa</option><option value='0'>Desactivar</option>";
        }
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwFormEmpresa', $arr);
    }

    public function edit_docsempresaxid($idEmpLista) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['mensaje'] = '';
        $arr['error'] = '';
        $arr['row'] = $this->Empresas_model->get_empxid($idEmpLista);
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $this->load->view('admin/vwFormEditDocsEmpresa', $arr);
    }

    public function subir_foto_logo() {
        if ($this->input->post('update_logo')) {
            $idEmp = $this->input->post('id');
            $config['upload_path'] = './uploads/empresas/' . $idEmp;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
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
                $subir = $this->Empresas_model->update_logo($idEmp, $imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function subir_foto_rut() {
        if ($this->input->post('update_rut')) {
            $idEmp = $this->input->post('id');
            $config['upload_path'] = './uploads/empresas/' . $idEmp;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
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
                $subir = $this->Empresas_model->update_rut($idEmp, $imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function subir_foto_camara() {
        if ($this->input->post('update_camara')) {
            $idEmp = $this->input->post('id');
            $config['upload_path'] = './uploads/empresas/' . $idEmp;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
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
                $subir = $this->Empresas_model->update_camara($idEmp, $imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function subir_pdf() {
        if ($this->input->post('update_pdf')) {
            $idEmp = $this->input->post('id');
            $config['upload_path'] = './uploads/empresas/' . $idEmp;
            $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
            $config['max_size'] = '5000';

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
                $subir = $this->Empresas_model->update_pdf($idEmp, $imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function add_empresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
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
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwFormAddEmpresa', $arr);
    }

    public function guardar_empresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
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
        if ($this->input->post('reg_empresa')) {

            $this->form_validation->set_rules('username', 'Usuario', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|integer');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('nivel', 'Tipo Usuario', 'trim|required');
            $this->form_validation->set_rules('terminos', 'Terminos y politicas de privacidad', 'required');

            if ($this->form_validation->run() == FALSE) {
                $arr['mensaje'] = '';
                $this->load->view('admin/vwAddEmpresa', $arr);
            } else {

                $this->Empresas_model->add_empresaxadmin();
                $arr['paises'] = $this->Paises_model->get_pais();
                $this->load->view('admin/vwAsignarUserEmp', $arr);
            }
        } else {
            $arr = array('mensaje' => 'Error al guardar, intentelo de nuevo');
            redirect(base_url() . 'admin/Empresas', $arr);
        }
    }

    public function guardar_usuario_empresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
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
        if ($this->input->post('reg_usuario_emp')) {

            $this->Empresas_model->add_userempresaxadmin();
            $arr = array('mensaje' => 'Empresa Agregada correctamente');
            redirect(base_url() . 'admin/Empresas', $arr);
        } else {
            $arr = array('mensaje' => 'Error al guardar, intentelo de nuevo');
            redirect(base_url() . 'admin/Empresas', $arr);
        }
    }

    public function crear_personal_empresas($idEmp) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['empresa'] = $this->Empresas_model->get_empxid($idEmp);
        $this->load->view('admin/vwFormPersonalEmpresa', $arr);
    }

    public function guardar_personal() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
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
        if ($this->input->post('reg_user')) {
            $res = $this->Empresas_model->add_personalempresaxadmin();
            if ($res == FALSE) {
                $arr['mensaje'] = 'Usted, ya se encuentra registrado en nuestra plataforma.' . anchor(base_url() . 'Registros/forget_pass', ' Recordar contraseña');
                redirect(base_url() . 'admin/Empresas', $arr);
            } else {
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

                $this->email->from('soporte@enturne.co', 'Enturne En Línea');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Bienvenido a Enturne');
                $this->email->message('<h3>Estimado usuario: ' . $this->input->post('username') . '<br>' . ' Sr(a): ' . $this->input->post('name') . ' ' . $this->input->post('sname') . '</h3>' . '<br>'
                        . 'Para confirmar su registro ingrese a la siguiente url '
                        . anchor(base_url() . 'Registros/confirmar/' . $this->input->post('code')) . ' y complete la información, para poderle activar todas las funciones que le brinda ENTURNE.'
                        . '<br><br>Equipo Enturne.<br><br>Si tiene cualquier duda, contactanos a las líneas (571) 4968958  http://www.enturne.co/index.php/contactenos');
                $this->email->send();
                $arr['mensaje'] = '“Registro correcto, le fue generado un email, favor revisar su bandeja de no deseados o spam ya que su servidor de correo puede enviarlo alli, favor confirmar para continuar su registro"';
                redirect(base_url() . 'admin/Empresas', $arr);
            }
        } else {
            $arr = array('mensaje' => 'Error al guardar, intentelo de nuevo');
            redirect(base_url() . 'admin/Empresas', $arr);
        }
    }

    public function get_personal_empxid($idEmp) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['mensaje'] = '';
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['personal'] = $this->Empresas_model->get_personal_empxid($idEmp);
        $this->load->view('admin/vwPersonalEmpresa', $arr);
    }

    public function update_empresa() {
        $idEmp = $this->input->post('id');
        $data = array(
            'nombre_empresa' => $this->input->post("nombre"),
            'siglas' => $this->input->post("siglas"),
            'nit' => $this->input->post("nit"),
            'departamentos_id' => $this->input->post("provincia"),
            'idCiudad' => $this->input->post("localidad"),
            'direccion' => $this->input->post("direccion"),
            'telefono' => $this->input->post("telefono"),
            'celular' => $this->input->post("celular"),
            'fax' => $this->input->post("fax"),
            'email' => $this->input->post("email"),
            'web' => $this->input->post("web"),
            /* 'rlegal' => $this->input->post("replegal", TRUE), */
            'activo' => $this->input->post("activo"),
            'tipo_carga' => $this->input->post("tipo_carga"),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $res = $this->Empresas_model->update_empresa($data, $idEmp);
        if ($res == true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function activar_licencia() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
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
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        if ($this->input->post('update_reg')) {
            $this->Empresas_model->activar_licencia();
            $arr['aviso'] = 'Licencia para Empresa activada correctamente';
            $arr['paises'] = $this->Paises_model->get_pais();
            $arr['datos'] = $this->Empresas_model->get_empresas();
            $this->load->view('admin/vwEmpresas', $arr);
        }
    }

    public function apto_licencia() {
        $id = $this->input->post('id');
        $datosEmpresa = $this->Empresas_model->get_empxid($id);
        $res = $this->Empresas_model->apto_licencia($id);
        if ($res === true) {
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
                'nombre' => $datosEmpresa->nombre_empresa);
            $this->email->to($datosEmpresa->email);
            $this->email->cc('administrativo@enturne.co');
            $this->email->subject('Aviso de autorización usuario desde la App Enturne');
            $body = $this->load->view('emails_valida_usuario.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function bloquear() {
        $id = $this->input->post('id');
        $res = $this->Empresas_model->bloquear($id);
        if ($res === true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function desbloquear() {
        $id = $this->input->post('id');
        $res = $this->Empresas_model->desbloquear($id);
        if ($res === true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function bloquear_usuario() {
        $id = $this->input->post('id');
        $res = $this->Empresas_model->bloquear_usuario($id);
        if ($res === true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function activar_subusuario() {
        $id = $this->input->post('id');
        $datosUsuario = $this->Users_model->get_perfilxid($id);
        $res = $this->Empresas_model->activar_usuario($id);
        if ($res === true) {
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
                'nombre' => $datosUsuario->nombre . ' ' . $datosUsuario->apellidos);
            $this->email->to($datosUsuario->email);
            $this->email->cc('administrativo@enturne.co');
            $this->email->subject('Aviso de autorización usuario desde la App Enturne');
            $body = $this->load->view('emails_valida_usuario.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo "ok";
        } else {
            echo "error";
        }
    }

}
