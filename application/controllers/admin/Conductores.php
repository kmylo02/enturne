<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conductores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model', 'Conductores_model', 'Registros_model', 'Paises_model', 'Referencias_model', 'Vehiculos_model', 'Docs_model'));
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
        $arr['page'] = 'dash';
        $arr['mensaje'] = 'Aun no se han registrado conductores';
        //$datos = $this->db->query("CALL SelectConductores()")->result();
        $datos = $this->Conductores_model->get_trans_conductores();
        $arr['titulos'] = '<th>Estado</th><th>Fecha de creación</th><th>Nombre</th><th>Tipo de identificación</th><th>Validar email</th><th>Documentos</th><th>Vehiculo</th><th>Licencia</th><th>Vencimiento de licencia de conduccion</th><th>Telefonos</th><th>Acciones</th><th>Ranking</th><th>HV</th><th>Autorizado</th>';
        $body = "";
        $r = "";
        $acciones = "";
        if ($datos) {
            foreach ($datos as $row) {
                $vehiculo = $row->vehiculo_asignado;
                $botonDocs = $this->verificarDocs($row->idUser);

                if ($vehiculo == null) {
                    $vehiculo = 'No Asignado';
                } else {
                    $vehiculo = "<a href='" . base_url('admin/Vehiculos/get_vehiculo_xidconductor') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-truck fa-2x'></i></a>";
                }
                $estado = $row->activo;
                $checkMail = $row->estado;
                if ($estado == 0) {
                    $hv = "";
                    $res = 'Inactivo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 1) {
                    if ($row->vehiculo_asignado == NULL) {
                        $hv = "<a href='" . base_url('empresa/perfil/generar_hv_conductor') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-file-pdf-o fa-2x'></i></a></td>";
                    } else {
                        $hv = "<a href='" . base_url('empresa/perfil/generar_hv_completa') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-file-pdf-o fa-2x'></i></a></td>";
                    }
                    $res = 'Activo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-success' disabled>Activo</button>";
                }
                if ($estado == 2) {
                    $hv = "";
                    $res = 'Sin validación por enturne';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 3) {
                    $hv = "";
                    $res = 'Usuario bloqueado';
                    $boton = '<a href="#"  onclick="activar_subusuario(' . $row->idUser . ')" title="Activar Transportador"><i class="fa fa-check fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($checkMail == 0) {
                    $checkMail = '<a href="#" title = "Email no validado" onclick="validarEmail(' . $row->idUser . ');"><img src="' . base_url('assets/img/mail_invalido.png') . '"></a>' . '</td>';
                }
                if ($checkMail == 1) {
                    $checkMail = '<a href="#" title = "Email validado"><img src="' . base_url('assets/img/mail_valido.png') . '"></a>' . '</td>';
                }
                if ($row->ranking >= 0 && $row->ranking < 0.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 0.5 && $row->ranking < 1) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 1 && $row->ranking < 1.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 1.5 && $row->ranking < 2) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 2 && $row->ranking < 2.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 2.5 && $row->ranking < 3) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 3 && $row->ranking < 3.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 3.5 && $row->ranking < 4) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 4 && $row->ranking < 4.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 4.5 && $row->ranking < 5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i>
                            </td>";
                }
                if ($row->ranking == 5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
                            </td>";
                }
                if ($row->tipo_doc == 1) {
                    $tipodoc = "CC";
                }
                if ($row->tipo_doc == 2) {
                    $tipodoc = "Pasaporte";
                }
                if ($row->tipo_doc == 3) {
                    $tipodoc = "Libreta Militar";
                }
                $acciones = anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Conductor')) . "&nbsp" . $boton;

                $body .= "<tr><td>" . $res . "</td><td>" . $row->fecha_creacion . "</td><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $tipodoc . " " . $row->cedula . "</td><td>" . $checkMail . "</td><td>" . $botonDocs . "</td><td>" . $vehiculo . "</td><td>" . $row->licencia_conduccion . "</td><td>" . $row->fecha_ven_licencia . "</td><td>" . $row->telefono . "<br>" . $row->celular . "</td><td>" . $acciones . "</td>" . $r . "</td><td>" . $hv . "<td>" . $autorizado . "</td></tr>";
            }
        }
        $arr['body'] = $body;
        $this->load->view('admin/vwConductores', $arr);
    }

    function verificarDocs($id) {
        $boton = "<a href='" . base_url() .
                'admin/Docs/lista_pend_conductores_xid/' .
                $id . "' title='Documentación pendiente'><i class='fa fa-folder fa-2x'></i></a>";
        $sinaprobar = $this->Docs_model->very_docs_x_aprobar_cond_xid($id);
        $aprobados = $this->Docs_model->very_docs_aprobados_cond_xid($id);
        $rechazados = $this->Docs_model->very_docs_rechazados_cond_xid($id);
        if ($sinaprobar->num > 0) {
            $boton = "<a href='" . base_url() .
                    'admin/Docs/lista_pend_conductores_xid/' .
                    $id . "' title='Documentación pendiente por aprobar'><i class='fa fa-folder-open fa-2x'></i></a>";
        } else
        if ($aprobados->num > 2) {
            $boton = "<a href='" . base_url() .
                    'admin/Docs/lista_pend_conductores_xid/' .
                    $id . "' title='Sin Pendientes"
                    . " documentos aprobados'><img src=" .
                    base_url('assets/img/docsaprobados.png') .
                    " alt='sin imagen'/></a>";
        } else
        if ($rechazados->num > 1) {
            $boton = "<a href='" . base_url() .
                    'admin/Docs/lista_pend_conductores_xid/' .
                    $id . "' title='Con documentos rechazados'><img src=" .
                    base_url('assets/img/DocsRechazados.png') .
                    " alt='sin imagen'/></a>";
        }
        return $boton;
    }

    public function propietario() {
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
        $arr['page'] = 'dash';
        $datos = $this->Conductores_model->get_trans_propietarios();
        $arr['titulos'] = '<th>Estado</th><th>Fecha de creación</th><th>Nombre</th><th>Tipo de identificación</th><th>Vehiculos</th><th>Validar email</th><th>Telefonos</th><th>Acciones</th><th>Autorizado</th>';
        $body = "";
        $acciones = "";
        if ($datos) {
            foreach ($datos as $row) {
                $estado = $row->activo;
                $checkMail = $row->estado;
                $vehiculos = $this->Vehiculos_model->get_vehiculos_x_propietario($row->idUser);
                if ($estado == 0) {
                    $res = 'Inactivo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 1) {
                    $res = 'Activo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-success' disabled>Activo</button>";
                }
                if ($estado == 2) {
                    $res = 'Sin validación por enturne';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 3) {
                    $res = 'Usuario bloqueado';
                    $boton = '<a href="#"  onclick="activar_subusuario(' . $row->idUser . ')" title="Activar Transportador"><i class="fa fa-check fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($checkMail == 0) {
                    $checkMail = '<a href="#" title = "Email no validado" onclick="validarEmail(' . $row->idUser . ');"><img src="' . base_url('assets/img/mail_invalido.png') . '"></a>' . '</td>';
                }
                if ($checkMail == 1) {
                    $checkMail = '<a href="#" title = "Email validado"><img src="' . base_url('assets/img/mail_valido.png') . '"></a>' . '</td>';
                }
                if ($row->tipo_doc == 1) {
                    $tipodoc = "CC";
                }
                if ($row->tipo_doc == 2) {
                    $tipodoc = "Pasaporte";
                }
                if ($row->tipo_doc == 3) {
                    $tipodoc = "Libreta Militar";
                }
                if ($row->tipo_doc == 4) {
                    $tipodoc = "Cédula de extranjeria";
                }
                if ($vehiculos) {
                    $linkVehiculo = anchor(base_url() . 'admin/Vehiculos/get_vehiculos_x_propietario/' . $row->idUser, '<i class="fa fa-truck fa-2x"></i>', array('title' => 'Vehiculos Propietario'));
                } else {
                    $linkVehiculo = 'Sin vehiculos';
                }
                $acciones = anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Conductor')) . $boton;

                $body .= "<tr><td>" . $res . "</td><td>" . $row->fecha_creacion . "</td><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $tipodoc . " " . $row->cedula . "</td><td>" . $linkVehiculo . "</td><td>" . $checkMail . "</td><td>" . $row->telefono . "<br>" . $row->celular . "</td><td>" . $acciones . "</td><td>" . $autorizado . "</td></tr>";
            }
        }
        $arr['body'] = $body;
        $this->load->view('admin/vwConductores', $arr);
    }

    public function propietario_conductor() {
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
        $arr['page'] = 'dash';
        $datos = $this->Conductores_model->get_trans_propconductores();
        $arr['titulos'] = '<th>Estado</th><th>Fecha de creación</th><th>Nombre</th><th>Tipo de identificación</th><th>Validar email</th><th>Documentos</th><th>Vehiculo</th><th>Licencia</th><th>Vencimiento de licencia de conduccion</th><th>Telefonos</th><th>Acciones</th><th>Ranking</th><th>HV</th><th>Autorizado</th>';
        $body = "";
        $acciones = "";
        if ($datos) {
            foreach ($datos as $row) {
                $vehiculo = $row->vehiculo_asignado;
                $botonDocs = $this->verificarDocs($row->idUser);
                if ($vehiculo == null) {
                    $vehiculo = 'No Asignado';
                } else {
                    $vehiculo = "<a href='" . base_url('admin/Vehiculos/get_vehiculo_xidconductor') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-truck fa-2x'></i></a>";
                }
                $estado = $row->activo;
                $checkMail = $row->estado;
                if ($estado == 0) {
                    $hv = "";
                    $res = 'Inactivo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 1) {
                    if ($row->vehiculo_asignado == NULL) {
                        $hv = "<a href='" . base_url('empresa/perfil/generar_hv_conductor') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-file-pdf-o fa-2x'></i></a></td>";
                    } else {
                        $hv = "<a href='" . base_url('empresa/perfil/generar_hv_completa') . "/" . $row->idUser . "' target='_blank'><i class='fa fa-file-pdf-o fa-2x'></i></a></td>";
                    }
                    $res = 'Activo';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-success' disabled>Activo</button>";
                }
                if ($estado == 2) {
                    $hv = "";
                    $res = 'Sin validación por enturne';
                    $boton = '<a href="#"  onclick="bloquear_subusuario(' . $row->idUser . ')" title="Bloquear Transportador"><i class="fa fa-ban fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($estado == 3) {
                    $hv = "";
                    $res = 'Usuario bloqueado';
                    $boton = '<a href="#"  onclick="activar_subusuario(' . $row->idUser . ')" title="Activar Transportador"><i class="fa fa-check fa-2x"></i></a>';
                    $autorizado = "<button type='button' class='btn btn-primary' onclick='transportista_apto_licencia(" . $row->idUser . ")'>Autorizado</button>";
                }
                if ($checkMail == 0) {
                    $checkMail = '<a href="#" title = "Email no validado" onclick="validarEmail(' . $row->idUser . ');"><img src="' . base_url('assets/img/mail_invalido.png') . '"></a>' . '</td>';
                }
                if ($checkMail == 1) {
                    $checkMail = '<a href="#" title = "Email validado"><img src="' . base_url('assets/img/mail_valido.png') . '"></a>' . '</td>';
                }

                if ($row->ranking >= 0 && $row->ranking < 0.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 0.5 && $row->ranking < 1) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 1 && $row->ranking < 1.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 1.5 && $row->ranking < 2) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 2 && $row->ranking < 2.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 2.5 && $row->ranking < 3) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 3 && $row->ranking < 3.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 3.5 && $row->ranking < 4) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i><i class='fa fa-star-o'></i>
                            </td>";
                }

                if ($row->ranking >= 4 && $row->ranking < 4.5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-o'></i>
                            </td>";
                }
                if ($row->ranking >= 4.5 && $row->ranking < 5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-o'></i>
                            </td>";
                }

                if ($row->ranking == 5) {
                    $r = "<td style='color:#D4AF37'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i>
                            </td>";
                }
                if ($row->tipo_doc == 1) {
                    $tipodoc = "CC";
                }
                if ($row->tipo_doc == 2) {
                    $tipodoc = "Pasaporte";
                }
                if ($row->tipo_doc == 3) {
                    $tipodoc = "Libreta Militar";
                }
                if ($row->tipo_doc == 4) {
                    $tipodoc = "NIT";
                }
                $acciones = anchor(base_url() . 'admin/Conductores/get_conductor_xid/' . $row->idUser, '<i class="fa fa-edit fa-2x"></i>', array('title' => 'Editar Conductor')) . "&nbsp" . $boton;

                $body .= "<tr><td>" . $res . "</td><td>" . $row->fecha_creacion . "</td><td>" . $row->nombre . " " . $row->apellidos . "</td><td>" . $tipodoc . " " . $row->cedula . "</td><td>" . $checkMail . "</td><td>" . $botonDocs . "</td><td>" . $vehiculo . "</td><td>" . $row->licencia_conduccion . "</td><td>" . $row->fecha_ven_licencia . "</td><td>" . $row->telefono . "<br>" . $row->celular . "</td><td>" . $acciones . "</td>" . $r . "</td><td>" . $hv . "</td><td>" . $autorizado . "</td></tr>";
            }
        }
        $arr['body'] = $body;
        $this->load->view('admin/vwConductores', $arr);
    }

    public function buscar_pendocs() {
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
        $arr['page'] = 'dash';
        if ($this->input->post('submit_buscar')) {
            $cc = $this->input->post('buscar');
            $res = $this->Conductores_model->pend_docs_conductor($cc);
            if (!$res) {
                $arr['mensaje'] = 'Conductor sin documentación pendiente o no existente';
                $this->load->view('admin/vwPenDocsConductores', $arr);
            } else {
                $arr['mensaje'] = 'Conductor con documentación pendiente';
                $arr['registros'] = $this->Conductores_model->pend_docs_conductor($cc);
                $this->load->view('admin/vwPenDocsConductor', $arr);
            }
        } else {
            $arr['mensaje'] = 'No hay registros pendientes de documentación';
            $arr['registros'] = $this->Registros_model->pend_docs_conductores();
            $this->load->view('admin/vwPenDocsConductores', $arr);
        }
    }

    public function get_conductor_xid($idconductor) {
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
        $arr['page'] = 'dash';
        $arr['mensaje'] = '';
        $arr['id'] = $idconductor;
        $paises = $this->Paises_model->get_pais();
        $perfil = $this->db->query("CALL SelectUserPorId($idconductor)")->row();
        $arr['perfil'] = $perfil;
        $arr['nombre'] = $perfil->nombre;
        $arr['apellidos'] = $perfil->apellidos;
        $arr['conyuge'] = $perfil->nombre_conyuge;
        $arr['apeconyuge'] = $perfil->apellido_conyuge;
        $arr['tipo'] = $perfil->tipo;
        $tipo_doc = $perfil->tipo_doc;
        $tipo_docc = $perfil->tipo_docc;
        if ($tipo_doc == '1') {
            $arr['optiondoc'] = "<select name='tipo_doc' class='form-control'><option value = " . $tipo_doc . " selected>CC</option>" .
                    "<option value = '2'>Pasaporte</option>" .
                    "<option value = '3'>Libreta Militar</option></select>";
        }
        if ($tipo_doc == '2') {
            $arr['optiondoc'] = "<select name='tipo_doc' class='form-control'><option value = " . $tipo_doc . " selected>Pasaporte</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '3'>Libreta Militar</option></select>";
        }
        if ($tipo_doc == '3') {
            $arr['optiondoc'] = "<select name='tipo_doc' class='form-control'><option value = " . $tipo_doc . " selected>Libreta Militar</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '2'>Pasaporte</option></select>";
        }
        if ($tipo_docc == 1) {
            $arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>CC</option>" .
                    "<option value = '2'>Pasaporte</option>" .
                    "<option value = '3'>Libreta Militar</option>";
        }
        if ($tipo_docc == 2) {
            $arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>Pasaporte</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '3'>Libreta Militar</option>";
        }
        if ($tipo_docc == 3) {
            $arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>Libreta Militar</option>" .
                    "<option value = '1'>CC</option>" .
                    "<option value = '2'>Pasaporte</option>";
        }
        $arr['cedula'] = $perfil->cedula;
        $arr['cedulac'] = $perfil->cedulac;
        $arr['fecha_nac'] = $perfil->fecha_nac;
        $estado_civil = $perfil->estado_civil;
        $arr['tel_conyuge'] = $perfil->tel_conyuge;
        if ($estado_civil == "") {
            $arr['optionestac'] = "<option value = 'Soltero'>Soltero</option>" .
                    "<option value = 'Casado'>Casado</option>" .
                    "<option value = 'Unión Libre'>Unión Libre</option>" .
                    "<option value = 'Separado'>Separado</option>" .
                    "<option value = 'Viudo'>Viudo</option>";
        }
        if ($estado_civil == "Soltero") {
            $arr['optionestac'] = "<option value = 'Soltero'>" . $estado_civil . "</option>" .
                    "<option value = 'Casado'>Casado</option>" .
                    "<option value = 'Unión Libre'>Unión Libre</option>" .
                    "<option value = 'Separado'>Separado</option>" .
                    "<option value = 'Viudo'>Viudo</option>";
        }
        if ($estado_civil == "Casado") {
            $arr['optionestac'] = "<option value = 'Casado'>" . $estado_civil . "</option>" .
                    "<option value = 'Soltero'>Soltero</option>" .
                    "<option value = 'Unión Libre'>Unión Libre</option>" .
                    "<option value = 'Separado'>Separado</option>" .
                    "<option value = 'Viudo'>Viudo</option>";
        }
        if ($estado_civil == "Unión Libre") {
            $arr['optionestac'] = "<option value = 'Unión Libre'>" . $estado_civil . "</option>" .
                    "<option value = 'Soltero'>Casado</option>" .
                    "<option value = 'Casado'>Casado</option>" .
                    "<option value = 'Separado'>Separado</option>" .
                    "<option value = 'Viudo'>Viudo</option>";
        }
        if ($estado_civil == "Separado") {
            $arr['optionestac'] = "<option value = 'Separado'>" . $estado_civil . "</option>" .
                    "<option value = 'Soltero'>Casado</option>" .
                    "<option value = 'Casado'>Casado</option>" .
                    "<option value = 'Unión Libre'>Unión Libre</option>" .
                    "<option value = 'Viudo'>Viudo</option>";
        }
        if ($estado_civil == "Viudo") {
            $arr['optionestac'] = "<option value = 'Viudo'>" . $estado_civil . "</option>" .
                    "<option value = 'Soltero'>Casado</option>" .
                    "<option value = 'Casado'>Casado</option>" .
                    "<option value = 'Unión Libre'>Unión Libre</option>" .
                    "<option value = 'Separado'>Separado</option>";
        }
        $sexo = $perfil->sexo;
        if ($sexo == NULL) {
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
                <input type = 'radio' checked disabled>" . $sexo . "<input type = 'hidden' name = 'gender' value = '" . $sexo . "'></label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' disabled> Femenino
                    </label>
                </div>";
        }
        if ($sexo == "Femenino") {
            $arr['radio'] = "<div class = 'radio'><label>
                <input type = 'radio' checked disabled>" . $sexo . "<input type = 'hidden' name = 'gender' value = '" . $sexo . "'></label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' disabled> Masculino
                    </label>
                </div>";
        }
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
        $tipo_vivienda = $perfil->tipo_vivienda;
        if ($tipo_vivienda == NULL) {
            $arr['optvivienda'] = "<option value='Arrendada'>Arrendada</option><option value='Propia'>Propia</option><option value='Familiar'>Familiar</option>";
        }
        if ($tipo_vivienda == "Arrendada") {
            $arr['optvivienda'] = "<option value='" . $tipo_vivienda . "'>" . $tipo_vivienda . "</option>
                        <option value='Propia'>Propia</option><option value='Familiar'>Familiar</option>";
        }
        if ($tipo_vivienda == "Propia") {
            $arr['optvivienda'] = "<option value='" . $tipo_vivienda . "'>" . $tipo_vivienda . "</option>
                        <option value='Arrendada'>Arrendada</option><option value='Familiar'>Familiar</option>";
        }
        if ($tipo_vivienda == "Familiar") {
            $arr['optvivienda'] = "<option value='" . $tipo_vivienda . "'>" . $tipo_vivienda . "</option>
                        <option value='Arrendada'>Arrendada</option><option value='Propia'>Propia</option>";
        }
        $arr['mesvivienda'] = $perfil->meses_vivienda;
        $arr['telefono'] = $perfil->telefono;
        $arr['celular'] = $perfil->celular;
        $arr['email'] = $perfil->email;
        $arr['licencia_conduccion'] = $perfil->licencia_conduccion;

        $arr['optdpto'] = $optdpto;
        $arr['optciudad'] = "<option value='" . $perfil->idCiudad . "'>" . $perfil->nombre_ciudad . "</option>";
        $arr['direccion'] = $perfil->direccion;
        $arr['numlicencia'] = $perfil->licencia_conduccion;
        $catlic = $perfil->categoria_lic;
        $arr['fecha_ven_licencia'] = $perfil->fecha_ven_licencia;
        if ($catlic == "") {
            $arr['optcatlic'] = "<option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "A1") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "A2") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "B1") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "B2") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "B3") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "C1") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C2'>C2</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "C2") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C3'>C3</option>";
        }
        if ($catlic == "C3") {
            $arr['optcatlic'] = "<option value='" . $catlic . "'>" . $catlic . "</option>
                        <option value='A1'>A1</option>
                        <option value='A2'>A2</option>
                        <option value='B1'>B1</option>
                        <option value='B2'>B2</option>
                        <option value='B3'>B3</option>
                        <option value='C1'>C1</option>
                        <option value='C2'>C2</option>                        ";
        }

        $this->load->view('admin/vwFormConductor', $arr);
    }

    public function delete_conductor_xid($id) {
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
        $arr['page'] = 'dash';
        $this->Conductores_model->delete_conductor_xid($id);
        $arr['mensaje'] = 'Aun no se han registrado conductores';
        $arr['edad'] = $this->Conductores_model->get_edad();
        $arr['datos'] = $this->Conductores_model->get_all_conductores();
        $this->load->view('admin/vwConductores', $arr);
    }

    public function get_ref_per($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['idUser'] = $id;
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page'] = 'dash';
        $arr['mensaje'] = 'Este conductor aun no ha registrado referencias personales';
        $arr['refPer'] = $this->Referencias_model->get_ref_perxid($id);
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwRefPerConductor', $arr);
    }

    public function get_ref_emp($id) {
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $arr['count'] = $this->Users_model->obtenerUsersNuevos();
        $usuario = $session_data['usuario'];
        $nombre = $session_data['nombre'];
        $apellidos = $session_data['ape'];
        $arr['idUsusario'] = $id;
        $arr['usuario'] = $usuario;
        $arr['nombre'] = $nombre;
        $arr['apellidos'] = $apellidos;
        $arr['page'] = 'dash';
        $arr['mensaje'] = 'Este conductor aun no ha registrado referencias empresariales';
        $arr['refEmp'] = $this->Referencias_model->get_ref_empxid($id);
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwRefEmpConductor', $arr);
    }

    public function guardar_ref_emp() {
        $data = array(
            'userhv_id' => $this->input->post('idUsuario'),
            'razonsocial' => $this->input->post('razonsocial'),
            'nit' => $this->input->post('nit'),
            'dpto' => $this->input->post('provincia'),
            'ciudad' => $this->input->post('localidad'),
            'direccion' => $this->input->post('address'),
            'telefono' => $this->input->post('phone'),
            'celular' => $this->input->post('celphone'),
            'contacto' => $this->input->post('contacto'),
            'telcontacto' => $this->input->post('telcontacto'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $res = $this->Referencias_model->add_ref_emp($data);
        if ($res === true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function get_ref_perxid($id) {
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
        $arr['page'] = 'dash';
        $arr['refPer'] = $this->Referencias_model->get_ref_perxid_admin($id);
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwFormRefPerConductor', $arr);
    }

    public function get_ref_empxid($id) {
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
        $arr['page'] = 'dash';
        $arr['refEmp'] = $this->Referencias_model->get_ref_empxid_admin($id);
        $arr['paises'] = $this->Paises_model->get_pais();
        $this->load->view('admin/vwFormRefEmpConductor', $arr);
    }

    public function guardar_refp() {
        $data = array(
            'idUser' => $this->input->post('id'),
            'nombre' => $this->input->post('firstName'),
            'apellido' => $this->input->post('lastName'),
            'tipo_documento' => $this->input->post('tipo_doc'),
            'identificacion' => $this->input->post('cc'),
            'parentesco' => $this->input->post('parentesco'),
            'dpto' => $this->input->post('provincia'),
            'ciudad' => $this->input->post('localidad'),
            'direccion' => $this->input->post('address'),
            'casa' => $this->input->post('vivienda'),
            'tiemporesidencia' => $this->input->post('meses_vivienda'),
            'telefono' => $this->input->post('phone'),
            'celular' => $this->input->post('celphone'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $res = $this->Referencias_model->add_ref_per($data);
        if ($res == true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function edit_ref_emp() {
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

        if ($this->input->post('update_refemp')) {

            $this->Referencias_model->update_ref_emp();
            $arr = array('mensaje' => 'Datos actualizados');
            redirect(base_url() . 'admin/Conductores', $arr);
        } else {
            $arr = array('mensaje' => 'No se realizo actualización');
            redirect(base_url() . 'admin/Conductores', $arr);
        }
    }

    public function edit_ref_per() {
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


        if ($this->input->post('update_refper')) {
            $this->Referencias_model->update_ref_per();
            $arr = array('mensaje' => 'Datos actualizados');
            redirect(base_url() . 'admin/Conductores', $arr);
        } else {
            $arr = array('mensaje' => 'No se realizo actualización');
            redirect(base_url() . 'admin/Conductores', $arr);
        }
    }

    public function updateConductor() {
        $id = $this->input->post('id');
        $data = array(
            'nombre' => $this->input->post("firstName"),
            'apellidos' => $this->input->post("lastName"),
            'tipo_doc' => $this->input->post("tipo_doc"),
            'cedula' => $this->input->post("cc"),
            'fecha_nac' => $this->input->post("fechanac"),
            'estado_civil' => $this->input->post("est_civil"),
            'nombre_conyuge' => $this->input->post("nombre_conyuge"),
            'apellido_conyuge' => $this->input->post("apellido_conyuge"),
            'tipo_docc' => $this->input->post("tipo_docc"),
            'cedulac' => $this->input->post("ccc"),
            'tel_conyuge' => $this->input->post("tel_conyuge"),
            'sexo' => $this->input->post("gender"),
            'idPais' => 1,
            'idDepartamento' => $this->input->post("provincia"),
            'idCiudad' => $this->input->post("localidad"),
            'direccion' => $this->input->post("address"),
            'tipo_vivienda' => $this->input->post("tipo_vivienda"),
            'meses_vivienda' => $this->input->post("meses_vivienda"),
            'telefono' => $this->input->post("phone"),
            'celular' => $this->input->post("celphone"),
            'email' => $this->input->post("email"),
            'licencia_conduccion' => $this->input->post("licencia_conduccion"),
            'categoria_lic' => $this->input->post("categoria_lic"),
            'fecha_ven_licencia' => $this->input->post("fechavenlic"),
            'updated_at' => date('Y-m-d H:m:s'),
        );
        $res = $this->Conductores_model->update_conductor($data, $id);
        if ($res == true) {
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function subir_foto_user_ajax() {
        $id = $this->input->post(id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/" . $id))
                mkdir("./uploads/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Conductores_model->update_foto_perfil($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_cedula_ajax() {
        $id = $this->input->post(id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/" . $id))
                mkdir("./uploads/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Conductores_model->update_foto_cedula($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_lic_ajax() {
        $id = $this->input->post(id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/" . $id))
                mkdir("./uploads/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Conductores_model->update_foto_lic($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function subir_pdf_user_ajax() {
        $id = $this->input->post(id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/" . $id))
                mkdir("./uploads/" . $id, 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
                sleep(3); //retrasamos la petición 3 segundos
                $this->Conductores_model->update_pdf($id, $file);
                echo $file; //devolvemos el nombre del archivo para pintar la imagen
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function apto_licencia() {
        $id = $this->input->post('id');
        $datosUsuario = $this->Users_model->get_perfilxid($id);
        $res = $this->Conductores_model->apto_licencia($id);
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
