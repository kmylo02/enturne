<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paises extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Paises_model');
    }

    public function index() {
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
        $arr['page'] = 'dash';
        $arr['datos'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwPaises', $arr);
    }

    public function ciudades() {
        $id = $this->input->get('idDpto');
        $arr['datos'] = $this->Paises_model->get_ciudades_app($id);
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_ciudad() {
        $name = $this->input->get('ciudad');
        $arr['ciudad'] = $this->Paises_model->get_ciudad($name);
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function dptos() {
        $arr['datos'] = $this->Paises_model->get_dptos_app();
        $resultadosJson = json_encode($arr);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function llena_provincias() {
        $options = "";
        if ($this->input->post('pais')) {
            $pais = $this->input->post('pais');
            $provincias = $this->Paises_model->provincias($pais);
            foreach ($provincias as $fila) {
                $options .= '<option value="' . $fila->idDepartamento . '">' . $fila->nombre_dpto . '</option>';
            }
            echo $options;
        }
    }

    public function llena_localidades() {
        $options = "";
        if ($this->input->post('provincia')) {
            $provincia = $this->input->post('provincia');
            $localidades = $this->Paises_model->localidades($provincia);
            foreach ($localidades as $fila) {
                $options .= '<option value="' . $fila->idCiudad . '">' . $fila->nombre_ciudad . '</option>';
            }
            echo $options;
        }
    }

    public function llena_localidadesEmpresa() {
        $options = "";
        if ($this->input->post('provinciaEmpresa')) {
            $provincia = $this->input->post('provinciaEmpresa');
            $localidades = $this->Paises_model->localidades($provincia);
            foreach ($localidades as $fila) {
                $options .= '<option value="' . $fila->idCiudad . '">' . $fila->nombre_ciudad . '</option>';
            }
            echo $options;
        }
    }

    public function add_pais() {
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
        $arr['page'] = 'dash';
        $arr['page'] = 'paises';
        $this->load->view('admin/vwPaises', $arr);
    }

    public function edit_pais() {
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
        $arr['page'] = 'dash';
        $arr['page'] = 'paises';
        $this->load->view('admin/vwPaises', $arr);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
