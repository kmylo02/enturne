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
        $this->load->model('Paises_model');
        $this->load->model('Users_model');
        
    }

    public function index() {
        $data['perfil'] = $this->Users_model->get_perfil();
        $data['paises'] = $this->Paises_model->get_pais();
        $this->load->view('gps/vwFormPerfil', $data);
    }
    
    public function get_perfil() {
        $data['edad'] = $this->Users_model->get_edad();
        $data['perfil'] = $this->Users_model->get_perfil();
        $this->load->view('gps/vwPerfil',$data);
    }

    public function add_user() {
        $arr['page'] = 'user';
        $this->load->view('gps/vwAddUser', $arr);
    }

    public function edit_user() {
        
        if ($this->input->post('update_user')) {

            $this->Users_model->update_perfil();
            $data=array('mensaje'=>'Datos actualizados');
            redirect(base_url().'gps/Perfil/get_perfil',$data);
        } else {
            $data=array('mensaje'=>'No se realizo actualización');
            redirect(base_url().'gps/Perfil',$data);
        }
    }
    
    public function edit_foto_user() {
        if ($this->input->post('update_foto')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_perfil');
            } else {
                //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
                //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
                $file_info = $this->upload->data();
                //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
                //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

                $data = array('upload_data' => $this->upload->data());
                $imagen = $file_info['file_name'];
                $subir = $this->Users_model->update_foto_perfil($imagen);
                redirect(base_url() . 'gps/Perfil/get_perfil');
            }
        }
//FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    }
    
    public function get_vehiculos() {

        $data['mensaje'] = 'si tienes un número de vehiculos en tu panel principal y aun no aparece en la lista tu licencia esta pendiente de activación de lo contrario no has registrado vehiculos';
        $data['vehiculo'] = $this->Vehiculos_model->get_vehiculos();
        $this->load->view('gps/vwVehiculos', $data);
    }

    public function get_vehiculo_xid($id) {

        if (!$id) {
            show_404();
        }
        $data['paises'] = $this->Paises_model->get_pais();
        $data['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
        $data['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $data['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
        $data['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xid($id);
        $this->load->view('gps/vwFormEditVehiculo', $data);
    }

    public function add_vehiculo() {
        $data['vehiculo'] = $this->Vehiculos_model->get_vehiculos();
        $data['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
        $data['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $data['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
        $data['paises'] = $this->Paises_model->get_pais();
        $this->load->view('gps/vwFormAddVehiculo', $data);
    }

    public function guardar_vehiculo() {

        if ($this->input->post('submit_reg')) {

            $this->form_validation->set_rules('placa', 'Placa', 'required');
            $this->form_validation->set_rules('provincia', 'Departamento', 'required');
            $this->form_validation->set_rules('localidad', 'Ciudad', 'required');
            $this->form_validation->set_rules('tipo_vehiculo_id', 'Tipo de vehiculo', 'required');
            $this->form_validation->set_rules('carroceria_id', 'Carroceria', 'required');
            $this->form_validation->set_rules('modelo', 'Modelo', 'required');
            $this->form_validation->set_rules('marca', 'Marca', 'required');
            $this->form_validation->set_rules('capacidad_carga', 'Capacidad de carga', 'required');
            $this->form_validation->set_rules('vence_soat', 'Fecha vencimiento SOAT', 'required');
            $this->form_validation->set_rules('vence_rtecnomecanica', 'Fecha vencimiento R.Tecnomecanica', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['mensaje'] = '';
                $data['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
                $data['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
                $data['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
                $data['paises'] = $this->Paises_model->get_pais();
                $this->load->view('gps/vwFormAddVehiculo', $data);
            } else {
                $this->Vehiculos_model->add_vehiculo();
                redirect(base_url() . 'gps/Perfil/subir_docs_vehiculo');
            }
        } else {
            $data = array('mensaje' => 'No se realizo el registro');
            redirect(base_url() . 'gps/Perfil/add_vehiculo', $data);
        }
    }

    public function update_vehiculo() {

        if ($this->input->post('update_reg')) {

            $this->Vehiculos_model->update_vehiculo();
            $data = array('mensaje' => 'Datos actualizados');
            redirect(base_url() . 'conductor/Perfil/get_vehiculos', $data);
        } else {
            $data = array('mensaje' => 'No se realizo actualización');
            redirect(base_url() . 'gps/Perfil/get_vehiculos', $data);
        }
    }

    public function subir_docs_vehiculo() {
        $data['vehiculo'] = $this->Vehiculos_model->get_vehiculos();
        $this->load->view('gps/vwSubirDocsVeh', $data);
    }

    public function edit_foto_soat() {
        if ($this->input->post('update_soat')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
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
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
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
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
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
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
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
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
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
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
                $imagen = $file_info['file_name'];
                $subir = $this->Vehiculos_model->update_remol($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function edit_foto_carnet() {
        if ($this->input->post('update_carnet')) {

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '50000';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {

                redirect(base_url() . 'gps/Perfil/get_vehiculos');
            } else {

                $file_info = $this->upload->data();

                $data = array('upload_data' => $this->upload->data());
                $imagen = $file_info['file_name'];
                $subir = $this->Vehiculos_model->update_carnet($imagen);
                header("Location:" . $_SERVER['HTTP_REFERER']);
            }
        }
    }

}


