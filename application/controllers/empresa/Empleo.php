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
        $this->load->model(array('Empleos_model', 'Vehiculos_model',
            'Paises_model', 'Conductores_model', 'Users_model'));
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
        $id = $session_data['id'];
        $arr['id'] = $id;
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['idempresa'] = $idempresa;
        $arr['vehiculos'] = $this->Vehiculos_model->get_vehiculos_activos_x_propietario($id);
        $arr['paises'] = $this->Paises_model->get_pais();
        $arr['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
        $arr['titulo'] = 'Ver / Crear - Vacantes conductores';
        $this->load->view('empresa/vwOfertas_empleo', $arr);
    }

    public function Ofertas_Empleo() {
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
        $id = $session_data['id'];
        $arr['id'] = $id;
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $idempresa = $session_data['idempresa'];
        $arr['idempresa'] = $idempresa;
        $res = $this->Empleos_model->get_ofertasxpropietario($id);
        $body = "";
        if ($res) {
            $acciones = "";
            foreach ($res as $fila) {
                if ($fila->estado == '0') {
                    $acciones = '<a href="#" onclick="cerrarVacante(' . $fila->idOfertaEmpleo . ')" title="Cerrar Vacante">' .
                            '<i class="fa fa-ban fa-2x"></i></a>&nbsp' .
                            '<a href="#" onclick="eliminarVacante(' . $fila->idOfertaEmpleo . ')" title="Eliminar Vacante">' .
                            '<i class="fa fa-trash fa-2x"></i></a>&nbsp' .
                            '<a href="#" onclick="detalleVacante(' . $fila->idOfertaEmpleo . ')" title="Detalle Vacante">' .
                            '<i class="fa fa-eye fa-2x"></i></a>';
                    $aplicando = '<a href="' . base_url('empresa/Empleo/get_conductores_aplicando') .
                            '/' . $fila->idOfertaEmpleo . '"><img src="' . base_url('assets/img/vacante_aplicando.png') .
                            '" width="30%" heigth="30%">' . $fila->aplicando . '</a>';
                    $contratados = '<a href="' . base_url('empresa/Empleo/get_conductores_contratados') .
                            '/' . $fila->idOfertaEmpleo . '"><img src="' . base_url('assets/img/vacante_contratado.png') .
                            '" width="20%" heigth="20%">' . $fila->contratados . '</a>';
                }
                if ($fila->estado === '1') {
                    $acciones = '<a href="#" onclick="cerrarVacante(' . $fila->idOfertaEmpleo . ')" title="Cerrar Vacante">' .
                            '<i class="fa fa-ban fa-2x" alt="Cerrar Vacante"></i></a>&nbsp' .
                            '<a href="#" onclick="eliminarVacante(' . $fila->idOfertaEmpleo . ')" title="Eliminar Vacante">' .
                            '<i class="fa fa-trash fa-2x"></i></a>&nbsp' .
                            '<a href="#" onclick="detalleVacante(' . $fila->idOfertaEmpleo . ')" title="Detalle Vacante">' .
                            '<i class="fa fa-eye fa-2x"></i></a><input type="button" class="btn btn-danger" value="Cupos Llenos" disabled>';
                    $aplicando = '';
                    $contratados = '<a href="' . base_url('empresa/Empleo/get_conductores_contratados') .
                            '/' . $fila->idOfertaEmpleo . '"><img src="' . base_url('assets/img/vacante_contratado.png') .
                            '" width="20%" heigth="20%">' . $fila->contratados . '</a>';
                }
                if ($fila->estado === '2') {
                    $acciones = '<a href="#" onclick="detalleVacante(' .
                            $fila->idOfertaEmpleo . ')" title="Detalle Vacante">'
                            . '<i class="fa fa-eye fa-2x"></i></a><br>'
                            . '<input type="button" class="btn btn-danger"'
                            . ' value="Cerrada" disabled>';
                    $aplicando = '';
                    $contratados = '<a href="' . base_url('empresa/Empleo/get_conductores_contratados') .
                            '/' . $fila->idOfertaEmpleo . '"><img src="' . base_url('assets/img/vacante_contratado.png') .
                            '" width="20%" heigth="20%">' . $fila->contratados . '</a>';
                }
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->created_at . '</td><td>' .
                        $fila->fecha_fin . '</td><td>' . $fila->cat_licencia . '</td><td>' .
                        $fila->salario . '</td><td>' . $fila->cantidad . '</td><td>' . $fila->nombre_tv . '</td><td>' .
                        $fila->nombre_ciudad . '</td><td>' . $aplicando . '</td><td>' . $contratados .
                        '</td><td>' . $acciones . '</td></tr>';
            }
            $arr['body'] = $body;
        } else {
            $arr['body'] = "";
        }
        $this->load->view('empresa/vwVacantesCreadas', $arr);
    }

    public function crear_vacante() {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $idUsuario = $session_data['id'];
        $data = array('idUser' => $idUsuario,
            'descripcion' => $this->input->post('detalle'),
            'cantidad' => $this->input->post('cant'),
            'cat_licencia' => $this->input->post('categorialic'),
            'idTipoVehiculo' => $this->input->post('tipo_vehiculo_id'),
            'idDepartamento' => $this->input->post('provincia'),
            'idCiudad' => $this->input->post('localidad'),
            'zona' => $this->input->post('zona'),
            'salario' => $this->input->post('salario'),
            'created_at' => date('Y-m-d'),
            'fecha_fin' => $this->input->post('fechavenlic'));
        $res = $this->Empleos_model->guardar_oferta_propietario($data);
        if ($res == TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function detalle_vacante() {
        $id = $this->input->post('idVacante');
        $res = $this->Empleos_model->detalle($id);
        if ($res == true) {
            echo $res;
        } else {
            echo 'error';
        }
    }

    public function cerrar_vacante() {
        $idVacante = $this->input->post('id');
        $data = array('estado' => '1',
            'update_at' => date('Y-m-d'));
        $res = $this->Empleos_model->cerrar_vacante_x_id($idVacante, $data);
        if ($res == TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function eliminar_vacante() {
        $idVacante = $this->input->post('id');
        $data = array('estado' => '2',
            'update_at' => date('Y-m-d'));
        $res = $this->Empleos_model->delete_vacante_x_id($idVacante, $data);
        if ($res == TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_conductores_aplicando($idOferta) {
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
        $arr['idempresa'] = $session_data['idempresa'];
        $sqlConfVehiculo = $this->Empleos_model->get_conf_vehiculo($idOferta);
        foreach ($sqlConfVehiculo as $dato) {
            $confVehiculo = $dato->nombre_tv;
        }
        $res = $this->Empleos_model->get_conductores_aplicando($idOferta);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                if ($fila->ranking >= 0 && $fila->ranking < 0.5) {
                    $ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 0.5 && $fila->ranking < 1) {
                    $ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }

                if ($fila->ranking >= 1 && $fila->ranking < 1.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 1.5 && $fila->ranking < 2) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2 && $fila->ranking < 2.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2.5 && $fila->ranking < 3) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3 && $fila->ranking < 3.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3.5 && $fila->ranking < 4) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4 && $fila->ranking < 4.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4.5 && $fila->ranking < 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
                }
                if ($fila->ranking == 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                }
                $ocupado = $fila->vehiculo_asignado;
                if ($ocupado != NULL) {
                    $boton = '<button type="button" class="btn btn-danger" disabled>Ocupado</button>';
                } else {
                    $boton = '<a href="' . base_url('empresa/Empleo/asignar_vehiculo') . '/' . $fila->idconductor . '/' . $idOferta . '">' . '<button type="button" class="btn btn-success">Contratar</button><a>';
                }
                $activo = $fila->activo;
                if ($activo != 1) {
                    $hv = '<a href="#" target="_blank" title="Hoja de vida no disponible"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                } else {
                    $hv = '<a href="' . base_url('empresa/perfil/generar_hv_conductor') . "/" . $fila->idconductor . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                }
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_postulacion . '</td><td>' . $fila->nombre . ' ' . $fila->apellidos . '</td><td>' . $fila->categoria_lic . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . $fila->celular . '</td><td><img src="' . base_url("uploads") . "/" . $fila->idconductor . '/' . $fila->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td style="color:#E7AE18">' . $ranking . '</td><td>' . $hv . '</td><td>' . $boton . '</td></tr>';
            }
            $arr['body'] = $body;
        } else {
            $arr['body'] = "";
        }
        $arr['confVehiculo'] = $confVehiculo;
        $this->load->view('empresa/vwConductoresaplicando', $arr);
    }

    public function asignar_vehiculo($idConductor, $idOferta) {
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
        $id = $session_data['id'];
        $arr['id'] = $id;
        $arr['usuario'] = $session_data['usuario'];
        $arr['nombre'] = $session_data['nombre'];
        $arr['apellidos'] = $session_data['ape'];
        $arr['idempresa'] = $session_data['idempresa'];
        $arr['id_conductor'] = $idConductor;
        $arr['idOfertaEmpleo'] = $idOferta;
        $res = $this->Vehiculos_model->get_vehiculos_x_propietario_disponibles($id);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                $body .= '<option value=' . $fila->placa . '>' . $fila->placa . '</option>';
            }
            $arr['body'] = $body;
        } else {
            $arr['body'] = "";
        }
        $this->load->view('empresa/vwAsignarVehiculo', $arr);
    }

    public function contratar_conductor() {
        $idVacante = $this->input->post('idOfertaEmpleo');
        $sql = $this->Empleos_model->get_vacante_x_id($idVacante);
        if ($sql) {
            $aplicar = $sql->aplicando - 1;
            $contratar = $sql->contratados + 1;
        }
        $idConductor = $this->input->post('id_conductor');
        $placa = $this->input->post('placa');
        $datosconductor = $this->Users_model->get_perfilxid($idConductor);
        $nombre = $datosconductor->nombre . ' ' . $datosconductor->apellidos;
        $email = $datosconductor->email;
        $datoscontratante = $this->Empleos_model->get_ofertat_xid($idVacante);
        foreach ($datoscontratante as $row) {
            $nomc = $row->nombre . ' ' . $row->apellidos;
            $tel = $row->telefono;
            $cel = $row->celular;
        }
        $data = array('vehiculo_asignado' => $placa
        );
        $data2 = array('conductor_id' => $idConductor,
            'estado' => '1'
        );
        $data3 = array('estado' => '1',
            'fecha_contratado' => date('Y-m-d'));
        $data4 = array('aplicando' => $aplicar,
            'contratados' => $contratar);
        $res = $this->Empleos_model->contratar_conductor($idConductor, $placa, $idVacante, $data, $data2, $data3, $data4);
        if ($res == TRUE) {
            $q = $this->Empleos_model->get_vacante_x_id($idVacante);
            if ($q->contratados === $q->cantidad) {
                $dat = array('estado' => 1);
                $this->Empleos_model->update_oferta($idVacante, $dat);
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
            $this->email->from($this->config->item('mailSistemas'), 'Enturne En Linea');
            $data = array(
                'nombre' => $nombre,
                'placa' => $placa,
                'contratante' => $nomc,
                'telefono' => $tel,
                'celular' => $cel
            );
            $this->email->to($email);
            $this->email->cc($this->config->item('mailEnturne'));
            $this->email->bcc($this->config->item('mailSistemas'));
            $this->email->subject('Oferta de empleo');
            $body = $this->load->view('contrato_empleo.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_conductores_contratados($idOferta) {
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
        $arr['idempresa'] = $session_data['idempresa'];
        $res = $this->Empleos_model->get_conductores_contratados($idOferta);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                if ($fila->ranking >= 0 && $fila->ranking < 0.5) {
                    $ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 0.5 && $fila->ranking < 1) {
                    $ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }

                if ($fila->ranking >= 1 && $fila->ranking < 1.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 1.5 && $fila->ranking < 2) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2 && $fila->ranking < 2.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2.5 && $fila->ranking < 3) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3 && $fila->ranking < 3.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3.5 && $fila->ranking < 4) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4 && $fila->ranking < 4.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4.5 && $fila->ranking < 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
                }
                if ($fila->ranking == 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                }
                $estado = $fila->estado;
                if ($estado === '2') {
                    $boton = '<button type="button" class="btn btn-danger" disabled>Contrato Finalizado el ' . $fila->fecha_fin . ' </button>';
                } else {
                    $boton = '<a href="#" onclick=finalizarContrato(' . $fila->idOfertaEmpleo . ',' . $fila->idconductor . ')><i class="fa fa-ban fa-2x"></i></a>';
                }
                $activo = $fila->activo;
                if ($activo !== '1') {
                    $hv = '<a href="#" target="_blank" title="Hoja de vida no disponible"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                } else {
                    $hv = '<a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $fila->idconductor . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                }
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_contratado . '</td><td>' . $fila->nc . ' ' . $fila->ac . '</td><td>' . $fila->categoria_lic . '</td><td>' . $fila->vehiculo_asignado . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . $fila->celular . '</td><td><img src="' . base_url("uploads") . "/" . $fila->idconductor . "/" . $fila->foto_ruta . '" alt="sin foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td style="color:#E7AE18">' . $ranking . '</td><td>' . $hv . '&nbsp' . $boton . '</td></tr>';
            }
            $arr['body'] = $body;
        } else {
            $arr['body'] = "";
        }
        $this->load->view('empresa/vwConductorescont', $arr);
    }

    public function get_all_conductores_contratados() {
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
                $data['conductor'] = $row->conductor;
                $data['mensaje'] = $row->mensaje;
                $data['created_at'] = $row->created_at;
            }
        }
        $data['count1'] = $conductores->num_rows(); //get current query record.
        $data['count2'] = $vehiculos->num_rows(); //get current query record.
        $data['permiso'] = $permiso;
        $data['activo'] = $activo;
        $id = $session_data['id'];
        $data['id'] = $id;
        $data['usuario'] = $session_data['usuario'];
        $data['nombre'] = $session_data['nombre'];
        $data['apellidos'] = $session_data['ape'];
        $data['idempresa'] = $session_data['idempresa'];
        $data['li'] = "<li><a href=" . base_url('conductor/Empleo') . "><i class='fa fa-level-up fa-2x'></i></a></li>
                <li class='active'><i class='icon-file-alt'></i> Mis Conductores Actuales</li>";
        $res = $this->Empleos_model->get_all_conductores_contratados($id);
        $body = "";
        if ($res) {
            foreach ($res as $fila) {
                if ($fila->ranking >= 0 && $fila->ranking < 0.5) {
                    $ranking = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 0.5 && $fila->ranking < 1) {
                    $ranking = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }

                if ($fila->ranking >= 1 && $fila->ranking < 1.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 1.5 && $fila->ranking < 2) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2 && $fila->ranking < 2.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 2.5 && $fila->ranking < 3) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3 && $fila->ranking < 3.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 3.5 && $fila->ranking < 4) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4 && $fila->ranking < 4.5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
                }
                if ($fila->ranking >= 4.5 && $fila->ranking < 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
                }
                if ($fila->ranking == 5) {
                    $ranking = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                }
                $estado = $fila->estado;
                if ($estado === 2) {
                    $boton = '<button type="button" class="btn btn-danger" disabled>Contrato Finalizado el ' . $fila->fecha_fin . ' </button>';
                } else {
                    $boton = '<a href="#"  onclick=finalizarContrato(' . $fila->idOfertaEmpleo . ',' . $fila->idconductor . ')><i class="fa fa-ban fa-2x"></i></a>';
                }
                $activo = $fila->activo;
                if ($activo != 1) {
                    $hv = '<a href="#" target="_blank" title="Hoja de vida no disponible"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                } else {
                    $hv = '<a href="' . base_url('empresa/perfil/generar_hv_completa') . "/" . $fila->idconductor . '" target="_blank" title="Hoja de vida"><i class="fa fa-file-pdf-o fa-2x"></i></a>';
                }
                $body .= '<tr><td>' . $fila->idOfertaEmpleo . '</td><td>' . $fila->created_at . '</td><td>' . $fila->fecha_contratado . '</td><td>' . $fila->nombre . ' ' . $fila->apellidos . '</td><td>' . $fila->categoria_lic . '</td><td>' . $fila->vehiculo_asignado . '</td><td>' . $fila->nombre_ciudad . '</td><td>' . $fila->celular . '</td><td><img src="' . base_url("uploads") . "/" . $fila->idconductor . "/" . $fila->foto_ruta . '" alt="foto perfil" onmouseover="this.width=80;this.height=90"
                onmouseout="this.width=20;this.height=25" width="20" height="25" style="border-radius: 50%;"></td><td style="color:#E7AE18">' . $ranking . '</td><td>' . $hv . '&nbsp' . $boton . '</td></tr>';
            }
            $data['body'] = $body;
        } else {
            $data['body'] = "";
        }
        $this->load->view('empresa/vwConductorescont', $data);
    }

    public function finalizar_contrato_empleo() {
        $idOferta = $this->input->post('idOferta');
        $idConductor = $this->input->post('idConductor');
        $data = array('fecha_fin' => date('Y-m-d'),
            'estado' => 2);
        $data2 = array('vehiculo_asignado' => null);
        $data3 = array('conductor_id' => null);
        $res = $this->Empleos_model->finalizar_contrato_conductor($idOferta, $idConductor, $data, $data2, $data3);
        if ($res === true) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
