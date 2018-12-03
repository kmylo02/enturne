<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perfil extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Conductores_model', 'Referencias_model', 'Empresas_model', 'Paises_model', 'Users_model', 'Vehiculos_model', 'Aseguradoras_model', 'Registros_model'));
    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['conductor'] = '';
        $arr['mensaje'] = '';
        $arr['created_at'] = '';
        $arr['id'] = $session_data['id'];
        $usuario = $session_data['usuario'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['mensaje'] = '';
        $arr['empresa'] = $this->Empresas_model->get_empresa($usuario);
        $paises = $this->Paises_model->get_pais();
        $perfil = $this->Users_model->get_perfil($usuario);
        $arr['nombre'] = $perfil->nombre;
        $arr['apellidos'] = $perfil->apellidos;
        $tipo_doc = $perfil->tipo_doc;
        if ($tipo_doc == 1) {
            $arr['optiondoc'] = "<option value = " . $tipo_doc . ">Cédula</option>" .
                    "<option value = '2'>Pasaporte</option>" .
                    "<option value = '3'>Libreta Militar</option>" .
                    "<option value = '4'>NIT</option>";
        }
        if ($tipo_doc == 2) {
            $arr['optiondoc'] = "<option value = " . $tipo_doc . ">Pasaporte</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '3'>Libreta Militar</option>" .
                    "<option value = '4'>NIT</option>";
        }
        if ($tipo_doc == 3) {
            $arr['optiondoc'] = "<option value = " . $tipo_doc . ">Libreta Militar</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '2'>Pasaporte</option>" .
                    "<option value = '4'>NIT</option>";
        }
        if ($tipo_doc == 4) {
            $arr['optiondoc'] = "<option value = " . $tipo_doc . ">NIT</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '2'>Pasaporte</option>" .
                    "<option value = '3'>Libreta Militar</option>";
        }
        $arr['cedula'] = $perfil->cedula;
        $arr['fecha_nac'] = $perfil->fecha_nac;
        $sexo = $perfil->sexo;
        if ($sexo === null) {
            $arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' name = 'gender' value = 'Masculino'>Masculino</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Femenino'> Femenino
                    </label>
                </div>";
        }
        if ($sexo == "Masculino") {
            $arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' value = '" . $sexo . "' checked disabled><input type = 'hidden' name = 'gender' value = '" . $sexo . "'>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Femenino' disabled> Femenino
                    </label>
                </div>";
        }
        if ($sexo == "Femenino") {
            $arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' value = '" . $sexo . "' checked disabled><input type = 'hidden' name = 'gender' value = '" . $sexo . "'>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Masculino' disabled> Masculino
                    </label>
                </div>";
        }
        $arr['cedula'] = $perfil->cedula;
        $dpto = $perfil->idDepartamento;
        $optdpto = "";
        foreach ($paises as $fila) {
            $valdpto = $fila->idDepartamento;
            if ($valdpto === $dpto) {
                $optdpto .= "<option value='" . $valdpto . "' selected = 'selected'>" . $fila->nombre_dpto . "</option>";
            } else {
                $optdpto .= "<option value='" . $valdpto . "'>" . $fila->nombre_dpto . "</option>";
            }
        }
        $arr['optdpto'] = $optdpto;
        $arr['optciudad'] = "<option value='" . $perfil->idCiudad . "'>" . $perfil->nombre_ciudad . "</option>";
        $arr['telefono'] = $perfil->telefono;
        $arr['celular'] = $perfil->celular;
        $arr['direccion'] = $perfil->direccion;
        $arr['email'] = $perfil->email;

        $this->load->view('empresa/vwFormPerfil', $arr);
    }

    public function get_perfil() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' === 3, 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['conductor'] = '';
        $arr['mensaje'] = '';
        $arr['created_at'] = '';
        $arr['id'] = $session_data['id'];
        $usuario = $session_data['usuario'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['mensaje'] = 'Tu perfil aun no esta completo, comunicarse con enturne para cargar información faltante.';
        $arr['perfil'] = $this->Users_model->get_perfil($usuario);
        $arr['edad'] = $this->Users_model->get_edad($usuario);
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('empresa/vwPerfil', $arr);
    }

    public function get_perfil_app() {
        $user = $this->input->get('usuario');
        $perfil = $this->Users_model->get_perfil_app($user);
        $resultados = array();
        $resultados["hora"] = date("F j, Y, g:i a");
        $resultados["generador"] = "Enviado desde app.enturne.co";
        if (!$perfil) {
            $resultados["respuesta"] = "Su usuario no ha sido aprobado por Enturne,  contactese con nosotros 0314968958 – 031 Cel 3175759304 – 3144713008. Cra 96G 19ª-18 Fontibon – Bogotá";
            $resultados["validacion"] = "error";
            $resultadosJson = json_encode($resultados);
        } else {
            $resultados["respuesta"] = "Validacion Correcta";
            $resultados["validacion"] = "ok";
            $resultados["perfil"] = $this->Users_model->get_perfil_app($user);
            $resultadosJson = json_encode($resultados);
        }
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_logo() {
        $id = $this->input->get('user');
        $empresa["logo"] = $this->Empresas_model->get_empxid_app($id);
        $resultadosJson = json_encode($empresa);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_perxid($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['mensaje'] = '';
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['perxid'] = $this->Registros_model->get_perxid($id);
        $this->load->view('empresa/vwFormEditPer', $arr);
    }

    public function get_empresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == '3', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['id'] = $session_data['id'];
        $usuario = $session_data['usuario'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['error'] = '';
        $arr['perfil'] = $this->Users_model->get_perfil($usuario);
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['mensaje'] = '';
        $arr['empresa'] = $this->Empresas_model->get_empresa($usuario);
        $this->load->view('empresa/vwEmpresa', $arr);
    }

    public function ver_completar() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == '3', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['id'] = $session_data['id'];
        $usuario = $session_data['usuario'];
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $this->load->view('empresa/vwCompletarPasos', $arr);
    }

    public function get_personal() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == '3', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['idempresa'] = $idempresa;
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['aviso'] = '';
        $arr['mensaje'] = 'Aun no has registrado empleados';
        $arr['personal'] = $this->Empresas_model->get_personal($idempresa);
        $this->load->view('empresa/vwPersonal', $arr);
    }

    public function add_emp() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['mensaje'] = '';
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('empresa/vwAddEmpresa', $arr);
    }

    public function guardar_empresa() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];

        if ($this->input->post('reg_empresa')) {

            $this->form_validation->set_rules('name', 'Nombre Empresa', 'required');
            $this->form_validation->set_rules('nit', 'Nit', 'required');
            $this->form_validation->set_rules('localidad', 'Ciudad', 'required');
            $this->form_validation->set_rules('direccion', 'Dirección', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required|integer');
            $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
            $this->form_validation->set_rules('tipo_carga', 'Tipo de carga', 'required');

            if ($this->form_validation->run() == FALSE) {
                $arr['mensaje'] = '0';
                $arr['paises'] = $this->Paises_model->get_pais();
                $arr['empresa'] = $this->Empresas_model->get_empresa();
                $this->load->view('empresa/vwAddEmpresa', $arr);
            } else {
                $this->Empresas_model->add_empresa();
                $arr['mensaje'] = '1';
                $arr['paises'] = $this->Paises_model->get_pais();
                $arr['empresa'] = $this->Empresas_model->get_empresa();
                $this->load->view('empresa/vwAddEmpresa', $arr);
            }
        } else {
            $arr['mensaje'] = 'Aun no has registrado empresa';
            $arr['empresa'] = $this->Empresas_model->get_empresa();
            $arr['error'] = 'Registro incorrecto comuniquese con enturne';
            $this->load->view('empresa/vwEmpresa', $arr);
        }
    }

    public function update_empresaxemp() {
        $session_data = $this->session->userdata('datos_usuario');
        $idempresa = $session_data['idempresa'];
        $data = array(
            'siglas' => $this->input->post("siglas", TRUE),
            'departamentos_id' => $this->input->post("provincia", TRUE),
            'idCiudad' => $this->input->post("localidad", TRUE),
            'direccion' => $this->input->post("direccion", TRUE),
            'telefono' => $this->input->post("telefono", TRUE),
            'fax' => $this->input->post("fax", TRUE),
            'celular' => $this->input->post("cel", TRUE),
            'email' => $this->input->post("email", TRUE),
            'web' => $this->input->post("web", TRUE),
            'tipo_carga' => $this->input->post("tipo_carga", TRUE),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $res = $this->Empresas_model->update_empresaxemp($data, $idempresa);
        if ($res == true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function subir_foto_logo() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$file = "Logo";
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/empresas/" . $id)) {
                mkdir("./uploads/empresas/" . $id, 0777);
            }
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/empresas/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Empresas_model->upload_logo($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_foto_rut() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$file = "RUT";
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/empresas/" . $id))
                mkdir("./uploads/empresas/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/empresas/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Empresas_model->upload_rut($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_foto_camara() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$file = "Camara de Comercio";
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/empresas/" . $id))
                mkdir("./uploads/empresas/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/empresas/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Empresas_model->upload_camara($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_empresa_pdf() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = $this->input->post('id');
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$file = "Documentación completa PDF";
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/empresas/" . $id))
                mkdir("./uploads/empresas/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/empresas/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Empresas_model->upload_empresa_pdf($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function guardar_personal() {
        $session_data = $this->session->userdata('datos_usuario');
        $idempresa = $session_data['idempresa'];
        $usuarioemp = $this->input->post("username");
        $nombre = $this->input->post("name");
        $email = $this->input->post("email");
        $code = rand(1000, 99999);
        $pass = $this->input->post("password");
        $passconf = $this->input->post("passconf");
        if ($pass != $passconf) {
            echo "errorpass";
        } else {
            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('sname', 'Apellidos', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            $this->form_validation->set_rules('nivel', 'nivel', 'required');
            $this->form_validation->set_rules('username', 'Usuario', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('registro');
            } else {
                $data = array(
                    'nombre' => $nombre,
                    'apellidos' => $this->input->post("sname"),
                    'tipo_doc' => $this->input->post("tipo_doc"),
                    'cedula' => $this->input->post("cedula"),
                    'email' => $email,
                    'telefono' => $this->input->post("telefono"),
                    'idDepartamento' => $this->input->post("provincia"),
                    'idCiudad' => $this->input->post("localidad"),
                    'direccion' => $this->input->post("direccion"),
                    'idNivel' => $this->input->post("nivel"),
                    'usuario' => $usuarioemp,
                    'pass' => md5($this->input->post("password")),
                    'idEmpresa' => $idempresa,
                    'permisos' => $this->input->post("permisos"),
                    'codigo' => $code,
                    'estado' => '0',
                    'fecha_creacion' => date('Y-m-d H:i:s')
                );
                $res = $this->Registros_model->add_user_empresa($usuarioemp, $data);
                if ($res === 0) {
                    echo "error";
                }
                if ($res == true) {
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
                    $datos = array(
                        'code' => $code,
                        'nombre' => $nombre,
                        'usuario' => $usuarioemp);
                    $this->email->to($email);
                    $this->email->subject('Bienvenido a Enturne');
                    $body = $this->load->view('email_registro_empresa.php', $datos, TRUE);
                    $this->email->message($body);
                    $this->email->send();
                    echo "ok";
                } else {
                    echo "ko";
                }
            }
        }
    }

    public function get_empxid($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['idusuario'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $idEmp = $session_data['idempresa'];
        $paises = $this->Paises_model->get_pais();
        $key = $this->Empresas_model->get_empxid($idEmp);
        $arr['datosAdmin'] = $this->Empresas_model->get_administrador($idEmp);
        $arr['nombre_empresa'] = $key->nombre_empresa;
        $arr['id'] = $key->idEmpresa;
        $arr['logo'] = $key->logo;
        $arr['siglas'] = $key->siglas;
        $arr['nit'] = $key->nit;
        $dptoemp = $key->departamentos_id;
        $arr['optciudad'] = "<option value='" . $key->idCiudad . "'>" . $key->nombre_ciudad . "</option>";
        $arr['direccion'] = $key->direccion;
        $arr['telefono'] = $key->telefono;
        $arr['fax'] = $key->fax;
        $arr['celular'] = $key->celular;
        $arr['email'] = $key->email;
        $arr['web'] = $key->web;
        $carga = $key->tipo_carga;
        $optdpto = "";
        foreach ($paises as $fila) {
            $dpto = $fila->idDepartamento;
            if ($dpto == $dptoemp) {
                $optdpto .= "<option value='" . $dptoemp . "' selected='selected'>" . $fila->nombre_dpto . "</option>";
            } else {
                $optdpto .= "<option value='" . $dpto . "'>" . $fila->nombre_dpto . "</option>";
            }
        }
        $arr['optdpto'] = $optdpto;
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
        if ($lic === 0) {
            $arr['optlic'] = "<option value='0'>Sin compra de licencia</option><option value='0'>Desactivar</option>
                    <option value='2'>Activar</option>";
        }
        if ($lic === 1) {
            $arr['optlic'] = "<option value='1'>Compro licencia, verificar Pago</option><option value='2'>Activar</option>";
        }
        if ($lic === 2) {
            $arr['optlic'] = "<option value='2'>Licencia Activa</option><option value='0'>Desactivar</option>";
        }
        $this->load->view('empresa/vwFormEditEmpresa', $arr);
    }

    public function get_docsempxid($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $id));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['conductor'] = '';
        $arr['mensaje'] = '';
        $arr['created_at'] = '';
        $arr['idusuario'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $id;
        $arr['paises'] = $this->Paises_model->get_pais();
        $doc = $this->Empresas_model->get_empxid($id);
        $arr['logo'] = $doc->logo;
        $arr['rut'] = $doc->rut;
        $arr['camara'] = $doc->camaracomercio;
        $arr['pdf'] = $doc->pdf;
        $docstemp = $this->Empresas_model->get_docs_temp($id);
        if ($docstemp) {
            foreach ($docstemp as $value) {
                if ($value->codigo == 0) {
                    $arr['logotemp'] = $value->nombre;
                    $arr["obsv"] = "Pendiente por aprobación";
                }
                if ($value->codigo == 1) {
                    $arr['ruttemp'] = $value->nombre;
                    $arr["obsv"] = "Pendiente por aprobación";
                }
                if ($value->codigo == 2) {
                    $arr['camaratemp'] = $value->nombre;
                    $arr["obsv"] = "Pendiente por aprobación";
                }
                if ($value->codigo == 3) {
                    $arr['pdftemp'] = $value->nombre;
                    $arr["obsv"] = "Pendiente por aprobación";
                }
            }
        } else {
            $arr["obsv"] = "";
        }
        $this->load->view('empresa/vwFormEditDocsEmpresa', $arr);
    }

    public function update_perfil() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $data = array(
            'nombre' => $this->input->post('firstName'),
            'apellidos' => $this->input->post('lastName'),
            'tipo_doc' => $this->input->post('tipo_doc'),
            'cedula' => $this->input->post('cc'),
            'fecha_nac' => $this->input->post('theDate'),
            'sexo' => $this->input->post('gender'),
            'idPais' => 1,
            'idDepartamento' => $this->input->post('provincia'),
            'idCiudad' => $this->input->post('localidad'),
            'direccion' => $this->input->post('address'),
            'telefono' => $this->input->post('phone'),
            'celular' => $this->input->post('celphone'),
            'email' => $this->input->post('email')
        );
        $res = $this->Users_model->update_perfil($data, $usuario);
        if ($res == true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function update_personal($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
//		$usuario = $session_data['usuario'];
        $usuario = $id;
        $data = array(
//			'nombre' => $this->input->post('firstName'),
//			'apellidos' => $this->input->post('lastName'),
//			'tipo_doc' => $this->input->post('tipo_doc'),
//			'cedula' => $this->input->post('cc'),
//			'fecha_nac' => $this->input->post('theDate'),
//			'sexo' => $this->input->post('gender'),
//			'idPais' => 1,
//			'idDepartamento' => $this->input->post('provincia'),
//			'idCiudad' => $this->input->post('localidad'),
//			'direccion' => $this->input->post('address'),
            'telefono' => $this->input->post('telefono'),
//			'celular' => $this->input->post('celphone'),
            'email' => $this->input->post('email')
        );
        $res = $this->Users_model->update_personalxempresa($data, $usuario);
        if ($res == true) {
            $this->get_personal();
        } else {
            echo "<script>alert(''error mensaje');</script>";
            $this->get_perxid($id);
        }
    }

    public function subir_foto_user_ajax() {
        $session_data = $this->session->userdata('datos_usuario');
        $id = $session_data['id'];
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$file = "Foto Perfil";
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/" . $id))
                mkdir("./uploads/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Empresas_model->edit_foto_perfil($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function edit_user_pdf() {
        if ($this->input->post('update_pdf')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
            $config['max_size'] = '5048';

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
                //$imagen = $file_info['file_name'];
                $imagen = "Documentación Completa PDF";
                $subir = $this->Users_model->update_user_pdf($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_doc() {
        if ($this->input->post('update_doc')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Users_model->update_foto_doc($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
        //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    }

    public function edit_foto_lic() {
        if ($this->input->post('update_lic')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf';
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
                $subir = $this->Users_model->update_foto_lic($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
        //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    }

    public function get_vehiculos() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $idUsuario = $session_data['id'];
        $arr['id'] = $idUsuario;
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['mensaje'] = 'Aun no has registrado vehiculos';
        $arr['vehiculo'] = $this->Vehiculos_model->get_vehiculos_x_propietario($idUsuario);
        $arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
        $arr['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
        $arr['trailers'] = $this->Vehiculos_model->get_trailers();
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['aseg'] = $this->Aseguradoras_model->get_aseguradoras();
        $this->load->view('empresa/vwVehiculos', $arr);
    }

    public function get_vehiculo_xid($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['iduser'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['idv'] = $id;
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
        $arr['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
        $vehiculo = $this->Vehiculos_model->get_vehiculo_xid($id);
        $arr['vehiculo'] = $vehiculo;
        $arr['soat'] = $vehiculo->soat;
        $arr['rtecnomecanica'] = $vehiculo->rtecnomecanica;
        $arr['vence_rtecnomecanica'] = $vehiculo->vence_rtecnomecanica;
        $arr['licenciatransito'] = $vehiculo->licenciatransito;
        $arr['rutpropietario'] = $vehiculo->rutpropietario;
        $arr['foto_frontal'] = $vehiculo->foto_frontal;
        $arr['foto_latder'] = $vehiculo->foto_latder;
        $arr['foto_latizq'] = $vehiculo->foto_latizq;
        $arr['carnetafiliacion'] = $vehiculo->carnetafiliacion;
        $arr['pdf'] = $vehiculo->pdf;
        $arr['cedulapropietario'] = $vehiculo->cedulapropietario;
        $arr['remolque'] = $vehiculo->remolque;

        $sql = $this->Vehiculos_model->get_docs_temp_vehiculo($id);
        if ($sql != FALSE) {
            foreach ($sql as $fila) {
                $codigo = $fila->codigo;
                $estado = $fila->estado;
                if ($codigo == 0 && $estado == 0) {
                    $arr['soattemp'] = $fila->nombre;
                    $arr["obsv"] = "Pendiente por aprobación";
                }
                if ($codigo == 1 && $estado == 0) {
                    $arr['rtecnotemp'] = $fila->nombre;
                    $arr["obsv1"] = "Pendiente por aprobación";
                }
                if ($codigo == 2 && $estado == 0) {
                    $arr['lictemp'] = $fila->nombre;
                    $arr["obsv2"] = "Pendiente por aprobación";
                }
                if ($codigo == 3 && $estado == 0) {
                    $arr['cedptemp'] = $fila->nombre;
                    $arr["obsv3"] = "Pendiente por aprobación";
                }
                if ($codigo == 4 && $estado == 0) {
                    $arr['rutptemp'] = $fila->nombre;
                    $arr["obsv4"] = "Pendiente por aprobación";
                }
                if ($codigo == 5 && $estado == 0) {
                    $arr['frontaltemp'] = $fila->nombre;
                    $arr["obsv5"] = "Pendiente por aprobación";
                }
                if ($codigo == 6 && $estado == 0) {
                    $arr['latdertemp'] = $fila->nombre;
                    $arr["obsv6"] = "Pendiente por aprobación";
                }
                if ($codigo == 7 && $estado == 0) {
                    $arr['traseratemp'] = $fila->nombre;
                    $arr["obsv7"] = "Pendiente por aprobación";
                }
                if ($codigo == 8 && $estado == 0) {
                    $arr['remolquetemp'] = $fila->nombre;
                    $arr["obsv8"] = "Pendiente por aprobación";
                }
                if ($codigo == 9 && $estado == 0) {
                    $arr['carnettemp'] = $fila->nombre;
                    $arr['obsv9'] = "Pendiente por aprobación";
                }
                if ($codigo == 10 && $estado == 0) {
                    $arr['pdftemp'] = $fila->nombre;
                    $arr['obsv10'] = "Pendiente por aprobación";
                }
            }
        }
        $this->load->view('empresa/vwFormEditVehiculo', $arr);
    }

    public function add_vehiculo() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['vehiculo'] = $this->Vehiculos_model->get_vehiculos();
        $arr['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
        $arr['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $arr['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('empresa/vwFormAddVehiculo', $arr);
    }

    public function guardar_vehiculo() {
        $session_data = $this->session->userdata('datos_usuario');
        $idUsuario = $session_data['id'];
        $data = array(
            'idUser' => $idUsuario,
            'placa' => $this->input->post('placa'),
            'idCiudad' => $this->input->post('localidad'),
            'idTipoVehiculo' => $this->input->post('tipo_vehiculo_id'),
            'idCamionesCarroceria' => $this->input->post('carroceria_id'),
            'trailer' => $this->input->post('trailer'),
            'trailermarca' => $this->input->post('marcatrailer'),
            'modelo_trailer' => $this->input->post('trailermodelo'),
            'peso_vacio_trailer' => $this->input->post('pesovtrailer'),
            'satelite' => $this->input->post('satelite'),
            'sateliteusuario' => $this->input->post('sateliteusuario'),
            'sateliteclave' => $this->input->post('sateliteclave'),
            'repotenciacion' => $this->input->post('repotenciacion'),
            'modelo' => $this->input->post('modelo'),
            'idMarca' => $this->input->post('marca'),
            'peso_vacio' => $this->input->post('pesov'),
            'capacidad_carga' => $this->input->post('capacidad_carga'),
            'vence_soat' => $this->input->post('vence_soat'),
            'numsoat' => $this->input->post('num_soat'),
            'idAseguradora' => $this->input->post('compania'),
            'vence_rtecnomecanica' => $this->input->post('vence_rtecno'),
            'activo' => 0,
            'created_at' => date('Y-m-d H:i:s')
        );
        $res = $this->Vehiculos_model->add_vehiculo($data);
        if ($res == TRUE) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function update_vehiculo() {

        if ($this->input->post('update_reg')) {

            $this->Vehiculos_model->update_vehiculo();
            $arr = array('mensaje' => 'Datos actualizados');
            redirect(base_url() . 'empresa/Perfil/get_vehiculos', $arr);
        } else {
            $arr = array('mensaje' => 'No se realizo actualización');
            redirect(base_url() . 'empresa/Perfil/get_vehiculos', $arr);
        }
    }

    public function subir_docs_vehiculo() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['id'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['vehiculo'] = $this->Vehiculos_model->get_vehiculos();
        $this->load->view('empresa/vwSubirDocsVeh', $arr);
    }

    public function edit_foto_frontal() {

        if ($this->input->post('update_frontal')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '800';
            $config['max_height'] = '800';

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
                $subir = $this->Vehiculos_model->update_frontal($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_latizq() {
        if ($this->input->post('update_latizq')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_latizq($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_latder() {
        if ($this->input->post('update_latder')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_latder($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_soat() {
        if ($this->input->post('update_soat')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_soat($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_rtecno() {
        if ($this->input->post('update_rtm')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_rtecno($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_lict() {
        if ($this->input->post('update_lict')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_lict($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_cedp() {
        if ($this->input->post('update_cedp')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_cedp($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_rutp() {
        if ($this->input->post('update_rutp')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_rutp($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_remolque() {
        if ($this->input->post('update_remol')) {

            $config['upload_path'] = './uploads/';
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
                $subir = $this->Vehiculos_model->update_remol($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_vehiculo_pdf() {
        if ($this->input->post('update_pdf')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
            $config['max_size'] = '5048';

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
                $subir = $this->Vehiculos_model->update_pdf($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function get_hv_empresa($id) {
        //datos que queremos enviar a la vista, lo mismo de siempre
        $data = array(
            'title' => 'Hoja de vida empresa',
            'empresa' => $this->Empresas_model->get_empxid($id),
            'admin' => $this->Empresas_model->get_administrador($id),
            'personal' => $this->Empresas_model->get_personal_noadmin($id)
        );
        $html = $this->load->view('pdf_empresa', $data, true);
        $this->generate_pdf($html);
    }

    public function generar_hv_vehiculo($idv) {
        $data = array(
            'title' => 'Hoja de vida',
            'vehiculos' => $this->Vehiculos_model->get_vehiculo_xid($idv),
        );
        $html = $this->load->view('pdf_vehiculo', $data, true);
        $this->generate_pdf($html);
    }

    public function generar_hv_conductor($id) {
        $data = array(
            'title' => 'Hoja de vida',
            'perfil' => $this->Conductores_model->get_conductor_xid($id),
            'refPer' => $this->Referencias_model->get_ref_perxid($id),
            'refEmp' => $this->Referencias_model->get_ref_empxid($id)
        );
        $html = $this->load->view('pdf_conductor', $data, true);
        $this->generate_pdf($html);
    }

    public function generar_hv_completa($id) {
        $data = array(
            'title' => 'Hoja de vida',
            'vehiculos' => $this->Vehiculos_model->get_vehiculo_xidconductor($id),
            'perfil' => $this->Conductores_model->get_conductor_xid($id),
            'refPer' => $this->Referencias_model->get_ref_perxid($id),
            'refEmp' => $this->Referencias_model->get_ref_empxid($id)
        );
        $html = $this->load->view('pdf', $data, true);
        $this->generate_pdf($html);
    }

    public function send_hv_completa() {
        $id = $this->input->get('idConductor');
        $qu = $this->db->get_where('Users', array('id' => $id));
        if ($qu->num_rows() != 0) {
            foreach ($qu->result() as $row) {
                $mail = $row->email;
            }
        }
        $data = array(
            'title' => 'Hoja de vida',
            'vehiculos' => $this->Vehiculos_model->get_vehiculo_xidconductor($id),
            'perfil' => $this->Conductores_model->get_conductor_xid($id),
            'refPer' => $this->Referencias_model->get_ref_perxid($id),
            'refEmp' => $this->Referencias_model->get_ref_empxid($id)
        );
        $html = $this->load->view('pdf', $data, true);
        $pdf = $this->generate_pdf($html);

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
        $this->email->to($mail);
        $this->email->cc('administrativo@enturne.co');
        $this->email->subject('Hoja de vida conductor Enturne');
        $this->email->attach($pdf);
        $this->email->message('Estimado usuario, de acuerdo a su petición enviamos adjunto en pdf su hoja de vida en Enturne');
        $this->email->send();
        if ($pdf) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    //funcion que ejecuta la descarga del pdf
    public function downloadPdf() {
        //si existe el directorio
        if (is_dir("./files/pdfs")) {
            //ruta completa al archivo
            $route = base_url("files/pdfs/hv.pdf");
            //nombre del archivo
            $filename = "test.pdf";
            //si existe el archivo empezamos la descarga del pdf
            if (file_exists("./files/pdfs/" . $filename)) {
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header('Content-disposition: attachment; filename=' . basename($route));
                header("Content-Type: .xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length: ' . filesize($route));
                readfile($route);
            }
        }
    }

    //esta función muestra el pdf en el navegador siempre que existan
    //tanto la carpeta como el archivo pdf
    public function show() {
        if (is_dir("./files/pdfs")) {
            $filename = "hv.pdf";
            $route = base_url("files/pdfs/hv.pdf");
            if (file_exists("./files/pdfs/" . $filename)) {
                header('Content-type: .xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf');
                readfile($route);
            }
        }
    }

    public function generate_pdf($html) {
        $this->load->library('pdfgenerator');
        $filename = 'report_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function ver_conductor_xid($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $consulta = $this->db->get_where('Users', array('usuario' => $session_data['usuario']));
        if ($consulta->num_rows() != 0) {
            foreach ($consulta->result() as $row) {
                $permiso = $row->permisos;
            }
        }
        $consulta1 = $this->db->get_where('Empresas', array('idEmpresa' => $session_data['idempresa']));
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $val) {
                $activo = $val->activo;
            }
        } else {
            $activo = 0;
        }

        $conductores = $this->db->get_where('Users', array('idNivel' == 'Conductor', 'Assign_idUser' => $session_data['usuario'])); // get query result
        $vehiculos = $this->db->get_where('Vehiculos', array('idUser' => $session_data['id'])); // get query result
        $consulta2 = $this->db->get_where('Reportes', array('id_usuario' => $session_data['id']));
        if ($consulta2->num_rows() != 0) {
            foreach ($consulta2->result() as $row) {
                $arr['conductor'] = $row->conductor;
                $arr['mensaje'] = $row->mensaje;
                $arr['created_at'] = $row->created_at;
            }
        }
        $arr['count1'] = $conductores->num_rows(); //get current query record.
        $arr['count2'] = $vehiculos->num_rows(); //get current query record.
        $arr['permiso'] = $permiso;
        $arr['activo'] = $activo;
        $arr['iduser'] = $session_data['id'];
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['conxid'] = $this->Conductores_model->get_conductor_xid($id);
        $this->load->view('empresa/vwVerConductor', $arr);
    }

    public function edit_pdf() {
        if ($this->input->post('update_pdf')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'zip|rar|pdf|docx|txt';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '5048';

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
                $subir = $this->Vehiculos_model->update_pdf($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
