<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Enturne extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Conductores_model', 'Vehiculos_model', 'Paises_model', 'Enturne_model', 'Ofertas_model'));
	}

	public function index() {
		$session_data = $this->session->userdata('datos_usuario');
		$idusuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['estado'] = $session_data['activo'];
		$arr['tipo'] = $session_data['tipo'];
		$paises = $this->Paises_model->get_pais();
		$optdpto = "";
		foreach ($paises as $line) {
			$optdpto .= "<option value='" . $line->idDepartamento . "'>" . $line->nombre_dpto . "</option>";
		}
		$asignado = $this->Conductores_model->get_vehiculo_asignado();
		if ($asignado !== FALSE) {
			$vehiculo = $this->Vehiculos_model->get_vehiculo_xenturne($idusuario);
			$arr['placa'] = $vehiculo->placa;
			$carr = $vehiculo->idCamionesCarroceria;
			$carr2 = $vehiculo->idCamionesCarroceria2;
			$origen = $vehiculo->nombre_ciudad;
			$id_origen = $vehiculo->origen_id;
			$codenturne = $vehiculo->enturne;
			if ($codenturne === '0') {
				$enturne = 'Disponible';
				$img = "<img src='" . base_url('assets/img/Disponible.png') . "'>";
			}
			if ($codenturne === '1') {
				$enturne = 'Disponible Consolidando';
				$img = "<img src='" . base_url('assets/img/Disponible.png') . "'>";
			}
			if ($codenturne === '2') {
				$enturne = 'No Disponible';
				$img = "<img src='" . base_url('assets/img/Nodisponible.png') . "'>";
			}
			$idv = $vehiculo->idVehiculo;
			$estado = $vehiculo->estado;
			$carrocerias = $this->Vehiculos_model->get_carr_vehiculo();
			$optcarr = "";
			foreach ($carrocerias as $car) {
				$valcarr = $car->idCamionesCarroceria;
				if ($valcarr === $carr) {
					$optcarr .= "<option value='" . $valcarr . "' selected = 'selected'>" . $car->nombre_carr . "</option>";
				} else {
					$optcarr .= "<option value='" . $valcarr . "'>" . $car->nombre_carr . "</option>";
				}
			}
			$optcarr2 = "";
			foreach ($carrocerias as $car) {
				$valcarr = $car->idCamionesCarroceria;
				if ($valcarr === $carr2) {
					$optcarr2 .= "<option value='" . $valcarr . "' selected = 'selected'>" . $car->nombre_carr . "</option>";
				} else {
					$optcarr2 .= "<option value='" . $valcarr . "'>" . $car->nombre_carr . "</option>";
				}
			}
			$optdpto = "<option>Seleccione para cambiar ciudad</option><option value='" . $optdpto . "'>" . $optdpto . "</option>";
			$carr = $optcarr;
			$carr2 = $optcarr2;
			$selenturne = "<option value='" . $enturne . "'>" . $enturne . "</option>";
			$optciudad = "<option value='" . $id_origen . "'>" . $origen . "</option>";
			$arr['body'] = '<div class="panel-group">
            <div class="panel panel-primary col-lg-5">
            <div class="panel-heading">Enturne actual</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class = "form-group">
                        <div class = "col-xs-4"></div>
                        <div class = "col-xs-4">' . $img . '
                        </div>
                        <div class = "col-xs-4"></div>
                    </div>
                    <div class = "form-group">
                        <label class = "col-xs-3 control-label">Ciudad Origen</label>
                        <div class = "col-xs-8">
                            <select class="form-control" disabled>' . $optciudad . '
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Estado Vehiculo</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="enturne" disabled>' . $selenturne . '</select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Carrocerias</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="carroceria" disabled>' . $carr . '</select>
                            <select class="form-control" name="carroceria" disabled>' . $carr2 . '</select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="panel panel-primary col-lg-5">
            <div class="panel-heading">Cambiar mi enturne</div>
            <div class="panel-body">
                <form method="post" action="' . base_url("conductor/Enturne/update_enturne") . '" id="basicBootstrapForm" class="form-horizontal">
                    <input type="hidden" name="idv" value="' . $idv . '">
                        <input type="hidden" name="estado" value="' . $estado . '">
                    <div class = "form-group">
                        <label class = "col-xs-3 control-label">Departamento Origen</label>
                        <div class = "col-xs-8">
                            <select name="provincia" id="provincia" class="form-control">' . $optdpto . '
                            </select>
                        </div>
                    </div>

                    <div class = "form-group">
                        <label class = "col-xs-3 control-label">Ciudad Origen</label>
                        <div class = "col-xs-8">
                            <select name="localidad" id="localidad" class="form-control">' . $optciudad . '</select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Estado Vehiculo</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="enturne">
                                <option value="0">Disponible</option>
                                <option value="1">Disponible Consolidando</option>
                                <option value="2">No Disponible</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Carroceria 1</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="carroceria">' . $carr . '
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Carroceria 2</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="carroceria2">' . $carr2 . '</select>
                        </div>
                    </div>
                    <div class = "form-group">
                        <div class = "col-xs-9 col-xs-offset-3">
                            <button type = "submit" class = "btn btn-primary">Actualizar Enturne</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>';
		} else {
			$arr['placa'] = '';
			$arr['body'] = '<h2>Sr Conductor, aún no tiene asignado, para aplicar a las vacantes, por favor de click en el siguiente enlace:'
                                . ' <a href='.base_url('conductor/Empleo/vacantes_Empleo').'>Aplicar Empleo</a></h2>';
		}
		$this->load->view('conductor/vwEnturne', $arr);
	}

	public function conductores() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUsuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['estado'] = $session_data['activo'];
		$arr['tipo'] = $session_data['tipo'];
		$paises = $this->Paises_model->get_pais();
		$optdpto = "";
		foreach ($paises as $line) {
			$optdpto .= "<option value='" . $line->idDepartamento . "'>" . $line->nombre_dpto . "</option>";
		}
		$vehiculos = $this->Vehiculos_model->get_vehiculos_x_propietario($idUsuario);
		$filas = "";
		if ($vehiculos) {
			foreach ($vehiculos as $vehiculo) {
				$estado = $vehiculo->enturne;
				if ($estado == 0) {
					$estado = '<img src="' . base_url("assets/img/Disponible.png") . '" width="50%" heigth="50%">';
				}
				if ($estado == 1) {
					$estado = '<img src="' . base_url("assets/img/Nodisponible.png") . '" width="50%" heigth="50%">';
				}
				if ($estado == 2) {
					$estado = '<img src="' . base_url("assets/img/Nodisponible.png") . '" width="50%" heigth="50%">';
				}
				$placa = $vehiculo->placa;
				$conf = $vehiculo->nombre_tv . ' - ' . $vehiculo->carr;
				$filas .= '<tr><td style="text-align:left">' . $vehiculo->nombre_ciudad . '</td><td WIDTH="70" style="text-align:left">' . $estado . '</td><td style="text-align:left">' . $placa . '</td></td><td style="text-align:left">' . $conf . '</td></tr>';
			}
			$arr['body'] = '<div class="table-responsive">
                <table id="dataTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr style="background-color:#FFE000">
                          <th>Ciudad</th>
                          <th>Estado</th>
                          <th>Placa</th>
                          <th>Configuración Actual</th>
                        </tr>
                    </thead>
                    <tbody>' . $filas . '</tbody>
                </table>
            </div>';
			$arr['placa'] = '';
			$this->load->view('conductor/vwEnturne', $arr);
		} else {
			$arr['placa'] = '';
			$arr['body'] = '<h2>Aun no has registrado vehiculos</h2>';
			$this->load->view('conductor/vwEnturne', $arr);
		}
	}

	public function update_enturne() {
		if ($this->input->post('estado') == 0) {
			$idv = $this->input->post('idv');
			$origen = $this->input->post('localidad');
			$carroceria = $this->input->post('carroceria');
			$carroceria2 = $this->input->post('carroceria2');
			$enturne = $this->input->post('enturne');
			$data = array(
				'carroceria_id' => $carroceria,
				'carroceria_id2' => $carroceria2,
				'enturne' => $enturne,
				'origen_id' => $origen
			);
			$this->Enturne_model->update_enturne($idv, $data);
			redirect(base_url() . 'conductor/Enturne');
		} else {
			redirect(base_url() . 'conductor/Ofertas/listado_ofertas');
		}
	}

	public function update_enturne_app() {
		$id = $this->input->post('idv');
		$data = array(
			'carroceria_id' => $this->input->post('carroceria'),
			'carroceria_id2' => $this->input->post('carroceria2'),
			'enturne' => $this->input->post('enturne'),
			'origen_id' => $this->input->post('ciudad')
		);
		$res = $this->Enturne_model->update_enturne_app($id, $data);
		if ($res == true) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function update_ciudad_enturne_app() {
		$id = $this->input->post('idVehiculo');
		$ciudad = $this->input->post('ciudad');
		$this->Enturne_model->update_enturne_ciudad_app($id, $ciudad);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
