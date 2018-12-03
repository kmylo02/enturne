<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleo extends CI_Controller {

    /**
     * ark Admin Panel for Codeigniter
     * Author: Jhon Jairo Valdés Aristizabal
     * downloaded from http://devzone.co.in
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Empleos_model'));
    }

    public function index() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $data['usuario'] = $session_data['usuario'];
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $res = $this->Empleos_model->get_ofertas_empleo();
        $body = "";
        if ($res) {
            $acciones = "";
            foreach ($res as $fila) {
                if ($fila->estado == 0) {
                    $acciones = '<a href="#" onclick="cerrarVacante(' . $fila->idOfertaEmpleo . ')"><i class="fa fa-ban fa-2x"></i></a>&nbsp<a href="#" onclick="eliminarVacante(' . $fila->idOfertaEmpleo . ')"><i class="fa fa-trash fa-2x"></i></a>&nbsp' . '<a href="#" onclick="verDetalleVacante(' . $fila->idOfertaEmpleo . ')"><i class="fa fa-eye fa-2x"></i></a>';
                }
                if ($fila->estado == 1) {
                    $acciones = '<input type="button" class="btn btn-danger" value="Cupos Llenos" disabled>';
                }
                if ($fila->estado == 2) {
                    $acciones = '<input type="button" class="btn btn-danger" value="Cerrada" disabled>';
                }
                $body .= '<tr><td></td><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->nombre . '' . $fila->apellidos . ' / ' . $fila->cedula . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_fin . '</td><td>' . $fila->cat_licencia . '</td><td>' . $fila->salario . '</td><td>' . $fila->cantidad . '</td><td>' . $fila->nombre_tv . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . '<a href="' . base_url('admin/Empleo/get_conductores_aplicando') . '/' . $fila->idOfertaEmpleo . '/' . $fila->idUser . '"><img src="' . base_url('assets/img/vacante_aplicando.png') . '" width="30%" heigth="30%">' . $fila->aplicando . '</a></td><td>' . '<a href="' . base_url('admin/Empleo/get_conductores_contratados/') . $fila->idOfertaEmpleo . '"><img src="' . base_url('assets/img/vacante_contratado.png') . '" width="20%" heigth="20%">' . $fila->contratados . '</a></td><td>' . $acciones . '</td></tr>';
            }
            $data['body'] = $body;
        } else {
            $data['body'] = "";
        }
        $this->load->view('admin/vwEmpleos', $data);
    }

    public function get_conductores_aplicando($idOferta, $idPropietario) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $datosPropietario = $this->Users_model->get_perfilxid($idPropietario);
        $nombre = $datosPropietario->nombre . " " . $datosPropietario->apellidos;
        $cedula = $datosPropietario->cedula;
        $data['usuario'] = $session_data['usuario'];
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $res = $this->Empleos_model->get_conductores_aplicando($idOferta);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                $activo = $fila->activo;
                if ($activo != 1) {
                    $hv = '<a href="#" target="_blank" title="Hoja de vida no disponible"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                } else {
                    $hv = '<a href="' . base_url('empresa/perfil/generar_hv_conductor') . "/" . $fila->idconductor . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                }
                $foto = '<img src="' . base_url("uploads") . '/' . $fila->idconductor . "/" . $fila->foto_ruta . '" heigth="30px" width="25spx" onmouseover="this.width=80;this.height=90" onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%">';
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $nombre . "/" . $cedula . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_postulacion . '</td><td>' . $fila->nombre . ' ' . $fila->apellidos . '</td><td>' . $fila->categoria_lic . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . $fila->celular . '</td><td>' . $foto . '</td><td>' . $fila->ranking . '</td><td>' . $hv . '</td></tr>';
            }
            $data['body'] = $body;
        } else {
            $data['body'] = "";
        }
        $this->load->view('admin/vwConductoresaplicando', $data);
    }

    public function get_conductores_contratados($idOferta) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $data['usuario'] = $session_data['usuario'];
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $res = $this->Empleos_model->get_conductores_contratados($idOferta);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                $activo = $fila->estado;
                if ($activo != 1) {
                    $hv = '<a href="#" target="_blank" title="Hoja de vida no disponible"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                } else {
                    $hv = '<a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $fila->idconductor . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                }
                $foto = '<img src="' . base_url("uploads") . '/' . $fila->idconductor . "/" . $fila->foto_ruta . '" heigth="30px" width="25spx" onmouseover="this.width=80;this.height=90" onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;">';
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_contratado . '</td><td>' . $fila->np . ' ' . $fila->ap . '</td><td>' . $fila->nc . ' ' . $fila->ac . '</td><td>' . $fila->categoria_lic . '</td><td>' . $fila->vehiculo_asignado . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . $fila->celular . '</td><td>' . $foto . '</td><td>' . $fila->ranking . '</td><td>' . $hv . '&nbsp' . '<a href="#"><i class="fa fa-ban fa-2x"></i></a>' . '</td></tr>';
            }
            $data['body'] = $body;
        } else {
            $data['body'] = "";
        }
        $this->load->view('admin/vwConductorescont', $data);
    }

    public function asignar_vehiculo($idConductor, $idOferta, $idPropietario) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $data['usuario'] = $usuario;
        $data['nombre'] = $nombre;
        $data['apellidos'] = $apellidos;
        $data['id_conductor'] = $idConductor;
        $data['idOfertaEmpleo'] = $idOferta;
        $res = $this->Vehiculos_model->get_vehiculos_x_propietario($idPropietario);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                $body .= '<option>' . $fila->placa . '</option>';
            }
            $data['body'] = $body;
        } else {
            $data['body'] = "";
        }
        $this->load->view('admin/vwAsignarVehiculo', $data);
    }

    public function historial() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $data['usuario'] = $session_data['usuario'];
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $arr['ofertase'] = $this->Empleos_model->get_ofertas_empresas_cerradas();
        $arr['ofertast'] = $this->Empleos_model->get_ofertas_transportistas_cerradas();
        $this->load->view('admin/vwHistorialEmpleos', $arr);
    }

}
