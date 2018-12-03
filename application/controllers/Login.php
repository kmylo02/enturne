<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Login_model', 'Registros_model', 'Alertas_model', 'Reportes_model', 'Users_model', 'Gps_model'));
    }

    public function index() {
        $data['mensaje'] = '';
        $this->load->view('login', $data);
    }

    public function very_sesion() {
        $usuario = $this->input->post('usuario');
        $passw = $this->input->post('passw');
        $this->form_validation->set_rules('usuario', 'Usuario', 'required');
        $this->form_validation->set_rules('passw', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $variable = $this->Login_model->very_sesion_admin($usuario, $passw);
            $variable1 = $this->Login_model->very_sesion_empresa($usuario, $passw);
            $variable2 = $this->Login_model->very_sesion_conductor($usuario, $passw);
            $variable3 = $this->Login_model->very_sesion_gps($usuario, $passw);

            if ($variable == TRUE) {
                $estado = $this->Registros_model->very_estado_admin($usuario, $passw);
                if ($estado == TRUE) {
                    $sos = $this->Alertas_model->get_contsos();
                    $usuario = $this->Users_model->get_user_xusu($usuario);
                    if ($usuario) {
                        $usuario_data = array(
                            'id' => $usuario->idUser,
                            'idempresa' => $usuario->idEmpresa,
                            'usuario' => $usuario->usuario,
                            'nombre' => $usuario->nombre,
                            'ape' => $usuario->apellidos,
                            'permisos' => $usuario->permisos
                        );
                    }
                    $this->session->set_userdata('datos_usuario', $usuario_data);
                    if ($sos) {
                        $sos_data = array(
                            'contsos' => $sos
                        );
                    } else {
                        $sos_data = array(
                            'contsos' => "0"
                        );
                    }
                    $this->session->set_userdata('datos_sos', $sos_data);
                    $data = 0;
                    $resultadosJson = json_encode($data);
                } else {
                    $this->session->unset_userdata('datos_usuario');
                    $this->session->unset_userdata('datos_sos');
                    $data = 5;
                    $resultadosJson = json_encode($data);
                }
                echo $resultadosJson;
            }
            if ($variable1 == TRUE) {
                $estado1 = $this->Registros_model->very_estado_empresa($usuario, $passw);
                if ($estado1 === TRUE) {
                    $usuario = $this->Users_model->get_user_xusu($usuario);
                    if ($usuario)
                        $usuario_data = array(
                            'id' => $usuario->idUser,
                            'idempresa' => $usuario->idEmpresa,
                            'usuario' => $usuario->usuario,
                            'nombre' => $usuario->nombre,
                            'ape' => $usuario->apellidos,
                            'permisos' => $usuario->permisos
                        );
                    $this->session->set_userdata('datos_usuario', $usuario_data);
                    if ($usuario->permisos === '0') {
                        $sos = $this->Alertas_model->get_contsos_x_empresa($usuario->idEmpresa);
                        $contrep = $this->Reportes_model->get_contrepo_x_empresa($usuario->idUser);
                    } else {
                        $sos = $this->Alertas_model->get_contsos_x_idusuario($usuario->idUser);
                        $contrep = $this->Reportes_model->get_contrepo_x_idusuario($usuario->idUser);
                    }
                    if ($sos) {
                        $sos_data = array(
                            'contsos' => $sos
                        );
                    } else {
                        $sos_data = array(
                            'contsos' => 0
                        );
                    }
                    if ($contrep) {
                        $repo_data = array(
                            'contrep' => $contrep
                        );
                    } else {
                        $repo_data = array(
                            'contrep' => 0
                        );
                    }
                    $this->session->set_userdata('datos_sos', $sos_data);
                    $this->session->set_userdata('datos_repo', $repo_data);
                    $data = 1;
                    $resultadosJson = json_encode($data);
                } else {
                    $this->session->unset_userdata('datos_usuario');
                    $this->session->unset_userdata('datos_sos');
                    $this->session->unset_userdata('datos_repo');
                    $data = 5;
                    $resultadosJson = json_encode($data);
                }
                echo $resultadosJson;
            }

            if ($variable2 == TRUE) {
                $estado2 = $this->Registros_model->very_estado_conductor($usuario, $passw);
                $ubicacion = $this->Gps_model->get_ubicacion($usuario);
                if ($estado2 === TRUE) {
                    $usuario = $this->Users_model->get_user_xusu($usuario);
                    if ($usuario)
                        $usuario_data = array(
                            'id' => $usuario->idUser,
                            'idempresa' => $usuario->idEmpresa,
                            'usuario' => $usuario->usuario,
                            'nombre' => $usuario->nombre,
                            'ape' => $usuario->apellidos,
                            'foto' => $usuario->foto_ruta,
                            'propietario' => $usuario->Assign_idUser,
                            'estado' => $usuario->estado,
                            'tipo' => $usuario->tipo,
                            'activo' => $usuario->activo
                        );
                    $this->session->set_userdata('datos_usuario', $usuario_data);
                    $sos = $this->Alertas_model->get_contsos_x_propietario($usuario->Assign_idUser);
                    if ($sos!='0') {
                        $sos_data = array(
                            'contsos' => $sos
                        );
                    } else {
                        $sos_data = array(
                            'contsos' => '0'
                        );
                    }
                    $this->session->set_userdata('datos_sos', $sos_data);
                    if ($ubicacion != false) {
                        foreach ($ubicacion as $row) {
                            $lat = $row->Latitud;
                            $long = $row->Longitud;
                        }
                        $ubicacion_data = array(
                            'latitud' => $lat,
                            'longitud' => $long
                        );
                    } else {
                        $ubicacion_data = array(
                            'latitud' => "",
                            'longitud' => ""
                        );
                    }
                    $this->session->set_userdata('datos_ubicacion', $ubicacion_data);
                    $data = 2;
                    $resultadosJson = json_encode($data);
                } else {
                    $this->session->unset_userdata('datos_usuario');
                    $data = 5;
                    $resultadosJson = json_encode($data);
                }
                echo $resultadosJson;
            }
            if ($variable3 === TRUE) {
                $estado3 = $this->Registros_model->very_estado_gps($usuario, $passw);
                if ($estado3 === TRUE) {
                    $usuario = $this->Users_model->get_user_xusu($usuario);
                    if ($usuario)
                        $usuario_data = array(
                            'id' => $usuario->idUser,
                            'idempresa' => $usuario->idEmpresa,
                            'usuario' => $usuario->usuario,
                            'nombre' => $usuario->nombre,
                            'ape' => $usuario->apellidos
                        );
                    $this->session->set_userdata('datos_usuario', $usuario_data);
                    $data = 3;
                    $resultadosJson = json_encode($data);
                } else {
                    $this->session->unset_userdata('datos_usuario');
                    $data = 5;
                    $resultadosJson = json_encode($data);
                }
                echo $resultadosJson;
            }
            if ($variable == FALSE && $variable1 == FALSE && $variable2 == FALSE) {
                $data = 4;
                $resultadosJson = json_encode($data);
                echo $resultadosJson;
            }
        }
    }

    public function token() {
        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function get_perfil_admin() {

        $this->load->view('admin/vwPerfil');
    }

    public function get_perfil_empresa() {

        $this->load->view('empresa/vwPerfil');
    }

    public function get_perfil_conductor() {

        $this->load->view('conductor/vwPerfil');
    }

    public function get_perfil_gps() {

        $this->load->view('gps/vwPerfil');
    }

}
