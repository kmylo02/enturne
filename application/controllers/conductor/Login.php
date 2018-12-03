<?php

class Login extends CI_Controller {

    public function __construct() {
        header('content-type: application/json; charset=utf-8');
//en caso de json en vez de jsonp habría que habilitar CORS:
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model(array('Login_model', 'Registros_model'));
    }

    public function index() {
        $this->load->view("login");
    }

    //logueamos usuarios con codeigniter y angularjs
    public function loginUser() {
        $username = $this->input->get('usuario');
        $password = $this->input->get('password');

        $loginUser = $this->Login_model->very_sesion_conductor($username, $password);
        $resultados = array();
        $resultados["hora"] = date("F j, Y, g:i a");
        $resultados["generador"] = "Enviado desde app.enturne.co";
        if ($loginUser == true) {

            $estado = $this->Registros_model->very_estado_conductor($username, $password);
            if ($estado == TRUE) {
                $resultados["respuesta"] = "Validacion Correcta";
                $resultados["validacion"] = "ok";
                $resultados["usuario"] = $username;
                $resultadosJson = json_encode($resultados);
            } else {
                $resultados["respuesta"] = "Su usuario no ha sido aprobado por Enturne,  contactese con nosotros 0314968958 – 031 Cel 3175759304 – 3144713008. Cra 96G 19ª-18 Fontibon – Bogotá";
                $resultados["validacion"] = "error1";
                $resultadosJson = json_encode($resultados);
            }
        } else {
            $resultados["respuesta"] = "Usuario y password incorrectos";
            $resultados["validacion"] = "error2";
            $resultadosJson = json_encode($resultados);
        }

        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function logoutUser() {
        $this->session->sess_destroy();
    }

}
