<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Paises_model', 'Users_model', 'Referencias_model', 'Conductores_model', 'Vehiculos_model', 'Registros_model', 'Aseguradoras_model'));
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
		$arr['estado'] = $session_data['activo'];
		$arr['tipo'] = $session_data['tipo'];
		$arr['mensaje'] = '';
		$paises = $this->Paises_model->get_pais();
		$perfil = $this->Users_model->get_perfil($usuario);
		$arr['nombre'] = $perfil->nombre;
		$arr['apellidos'] = $perfil->apellidos;
		$arr['conyuge'] = $perfil->nombre_conyuge;
		$arr['apeconyuge'] = $perfil->apellido_conyuge;
		$tipo_doc = $perfil->tipo_doc;
		$tipo_docc = $perfil->tipo_docc;
		if ($tipo_doc === '1') {
			$arr['optiondoc'] = "<option value = " . $tipo_doc . " selected>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		if ($tipo_doc === '2') {
			$arr['optiondoc'] = "<option value = " . $tipo_doc . " selected>Pasaporte</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		if ($tipo_doc === '3') {
			$arr['optiondoc'] = "<option value = " . $tipo_doc . " selected>Libreta Militar</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>";
		}
		if ($tipo_docc === '1') {
			$arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		if ($tipo_docc === '2') {
			$arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>Pasaporte</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		if ($tipo_docc === '3') {
			$arr['optiondocc'] = "<option value = " . $tipo_docc . " selected>Libreta Militar</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>";
		}
		$arr['cedula'] = $perfil->cedula;
		$arr['cedulac'] = $perfil->cedulac;
		$fecha_nac = $perfil->fecha_nac;
		if ($fecha_nac != NULL) {
			$arr["fecha_nac"] = '<input type="text" class="form-control" value="' . $fecha_nac . '" disabled><input type="hidden" value="' . $fecha_nac . '" name="fechanac" id="fechanac">';
		} else {
			$arr["fecha_nac"] = '<input type="text" class="form-control" name="fechanac" id="fechanac" placeholder="AAAAMMDD" required>';
		}
		$estado_civil = $perfil->estado_civil;
		$arr['tel_conyuge'] = $perfil->tel_conyuge;
		if ($estado_civil == NULL) {
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
		$arr['cedula'] = '<input type="number" class = "form-control" value="' . $perfil->cedula . '" disabled>';
		$dpto = $perfil->idDepartamento;
		$optdpto = "";
		foreach ($paises as $fila) {
			$valdpto = $fila->idDepartamento;
			if ($valdpto === $dpto) {
				$optdpto .= "<option value='" . $valdpto . "' selected = 'selected'>" . $fila->nombre_dpto . "</option>";
			} else {
				$optdpto .= "<option value='" . $valdpto . "'>" . $fila->nombre_dpto . "</option>";
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
		}
		$arr['optdpto'] = $optdpto;
		$arr['optciudad'] = "<option value='" . $perfil->idCiudad . "'>" . $perfil->nombre_ciudad . "</option>";
		$arr['direccion'] = $perfil->direccion;
		$arr['numlicencia'] = $perfil->licencia_conduccion;
		$catlic = $perfil->categoria_lic;
		$arr['fecha_ven_licencia'] = $perfil->fecha_ven_licencia;
		if ($catlic == NULL) {
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

		$this->load->view('conductor/vwFormPerfil', $arr);
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

	public function get_perfil_app_xid() {
		$id = $this->input->get('idConductor');

		$resultados["perfil"] = $this->Users_model->get_perfilxid($id);
		$resultadosJson = json_encode($resultados);

		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function get_perfil() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
                $data['id'] = $id;
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['mensaje'] = 'Tu perfil no esta completo, para validar tu enturne debes completar tus datos desde el panel principal.';
		$data['paises'] = $this->Paises_model->get_pais();
		$data['perfil'] = $this->Users_model->get_perfil_completo($usuario);
		$data['edad'] = $this->Users_model->get_edad($usuario);
		$data['vehiculo'] = $this->Vehiculos_model->get_vehiculo_xidconductor($id);
		$this->load->view('conductor/vwPerfil', $data);
	}

	public function add_user() {
		$arr['page'] = 'user';
		$this->load->view('conductor/vwAddUser', $arr);
	}

	public function edit_user() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$data = array(
			'tipo_doc' => $this->input->post('tipo_doc'),
			'fecha_nac' => $this->input->post('fechanac'),
			'estado_civil' => $this->input->post('est_civil'),
			'nombre_conyuge' => $this->input->post('nombre_conyuge'),
			'apellido_conyuge' => $this->input->post('apellido_conyuge'),
			'tipo_docc' => $this->input->post('tipo_docc'),
			'cedulac' => $this->input->post('ccc'),
			'tel_conyuge' => $this->input->post('tel_conyuge'),
			'sexo' => $this->input->post('gender'),
			'idPais' => 1,
			'idDepartamento' => $this->input->post('provincia'),
			'idCiudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'tipo_vivienda' => $this->input->post('tipo_vivienda'),
			'meses_vivienda' => $this->input->post('meses_vivienda'),
			'licencia_conduccion' => $this->input->post('licencia_conduccion'),
			'categoria_lic' => $this->input->post('categoria_lic'),
			'fecha_ven_licencia' => $this->input->post('fechavenlic')
		);
		$res = $this->Users_model->update_perfil($data, $usuario);
		if ($res === true) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function subir_foto_user_ajax() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/" . $id)) {
				echo __DIR__ . "./uploads/" . $id . "/";
				mkdir("./uploads/" . $id, 0777, true);
			}

			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Conductores_model->edit_foto_perfil($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_cedula_ajax() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/" . $id))
				mkdir("./uploads/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Conductores_model->edit_foto_cedula($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_lic_ajax() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/" . $id))
				mkdir("./uploads/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Conductores_model->edit_foto_lic($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_pdf_user_ajax() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/" . $id))
				mkdir("./uploads/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Conductores_model->edit_pdf($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function adj_doc() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['id'] = $id;
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['perfil'] = $this->Users_model->get_perfil_completo($usuario);
		$data['doc'] = $this->Users_model->get_doc();
		$data['lic'] = $this->Users_model->get_lic();
		$docstemp = $this->Conductores_model->get_docs_temp($id);
		if ($docstemp) {
			foreach ($docstemp as $value) {
				$codigo = $value->codigo;
				if ($codigo == 0) {
					$data['cedulatemp'] = $value->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
				if ($codigo == 1) {
					$data['lictemp'] = $value->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
				if ($codigo == 2) {
					$data['pdftemp'] = $value->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
				if ($codigo == 3) {
					$data['perfiltemp'] = $value->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
			}
		}
		$this->load->view('conductor/vwSubirDocs', $data);
	}

	public function subir_soat_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "SOAT";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . "/" . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_soat($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_lict_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Licencia de transito";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_lict($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_cedp_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Cédula Propietario";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_cedp($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_rtm_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Revisión Tecnomecanica";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_rtecno($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_rutp_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Rut propietario";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_rutp($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_frontal_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Foto Frontal";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_frontal($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_lateral_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Foto Lateral";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_lateral($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_trasera_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Foto Trasera";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_trasera($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_remolque_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Foto Remolque";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_foto_remolque($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function subir_pdf_ajax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$id = $this->input->post('idv');
			//obtenemos el archivo a subir
			$file = $_FILES['userfile']['name'];
			//$file = "Documentación completa PDF";
			//comprobamos si existe un directorio para subir el archivo
			//si no es así, lo creamos
			if (!is_dir("./uploads/vehiculos/" . $id))
				mkdir("./uploads/vehiculos/" . $id, 0777, true);
			//comprobamos si el archivo ha subido
			if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/vehiculos/" . $id . '/' . $file)) {
				sleep(3); //retrasamos la petición 3 segundos
				$this->Vehiculos_model->edit_pdf($id, $file);
				echo $file; //devolvemos el nombre del archivo para pintar la imagen
			}
		} else {
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function comp_info() {
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
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['perfil'] = $this->Users_model->get_perfil();
		$data['paises'] = $this->Paises_model->get_pais();
		$this->load->view('conductor/vwTipo', $data);
	}

	public function tipo() {
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
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['perfil'] = $this->Users_model->get_perfil();
		$this->load->view('conductor/vwFormTipo', $data);
	}

	public function update_tipo() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$tipo = $this->input->post("tipo");
		$res = $this->Users_model->update_tipo($id, $tipo);
		if ($res == TRUE) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function completar_conductor() {
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
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['perfil'] = $this->Users_model->get_perfil($usuario);
		$data['paises'] = $this->Paises_model->get_pais();
		$this->load->view('conductor/vwCompletarPasos', $data);
	}

	public function get_ref_per() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['idUsuario'] = $id;
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['mensaje'] = 'Aun no has registrado referencias personales';
		$data['paises'] = $this->Paises_model->get_pais();
		$data['cont'] = $this->Referencias_model->contar_refper();
		$data['refPer'] = $this->Referencias_model->get_ref_per();
		$this->load->view('conductor/vwRefPer', $data);
	}

	public function get_ref_perxid($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUsuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['idUsuario'] = $idUsuario;
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['paises'] = $this->Paises_model->get_pais();
		$data['ref'] = $this->Referencias_model->get_ref_perxid_conductor($id);
		$this->load->view('conductor/vwFormEditRefPer', $data);
	}

	public function get_ref_perxid_app() {
		$id = $this->input->get("idConductor");
		$data['ref'] = $this->Referencias_model->get_ref_perxid_conductor($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function guardar_refp() {
		$session_data = $this->session->userdata('datos_usuario');
		$id = $session_data['id'];
		$data = array(
			'idUser' => $id,
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

	public function edit_ref_per() {

		if ($this->input->post('update_reg')) {

			$this->Referencias_model->update_ref_per();
			redirect(base_url() . 'conductor/Perfil/get_ref_per');
		} else {
			redirect(base_url() . 'conductor/Perfil/get_ref_per');
		}
	}

	public function get_ref_emp() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUsuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['idUsuario'] = $idUsuario;
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['mensaje'] = 'Aun no has registrado referencias empresariales';
		$data['paises'] = $this->Paises_model->get_pais();
		$data['cont'] = $this->Referencias_model->contar_refemp();
		$data['refEmp'] = $this->Referencias_model->get_ref_emp();
		$this->load->view('conductor/vwRefEmp', $data);
	}

	public function get_ref_empxid($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUsuario = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$data['idUsuario'] = $idUsuario;
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$data['paises'] = $this->Paises_model->get_pais();
		$data['ref'] = $this->Referencias_model->get_ref_empxid_conductor($id);
		$this->load->view('conductor/vwFormEditRefEmp', $data);
	}

	public function get_ref_empxid_app() {
		$id = $this->input->get("idConductor");
		$data['refEmp'] = $this->Referencias_model->get_ref_empxid_conductor($id);
		$resultadosJson = json_encode($data);
		echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
	}

	public function guardar_ref_emp() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$data = array(
			'idUser' => $id,
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
		if ($res == true) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function edit_ref_emp() {

		if ($this->input->post('update_reg')) {

			$this->Referencias_model->update_ref_emp();
			$data = array('mensaje' => 'Datos actualizados');
			redirect(base_url() . 'conductor/Perfil/get_ref_emp', $data);
		} else {
			$data = array('mensaje' => 'No se realizo actualización');
			redirect(base_url() . 'conductor/Perfil/get_ref_emp', $data);
		}
	}

	public function get_vehiculos() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$idUsuario = $session_data['id'];
		$data['idusuario'] = $idUsuario;
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['tipo'] = $session_data['tipo'];
		$data['estado'] = $session_data['activo'];
		$data['mensaje'] = "No tiene vehiculos afiliados";
		$data['vehiculo'] = $this->Vehiculos_model->get_vehiculos_x_propietario($idUsuario);
		$data['marca'] = $this->Vehiculos_model->get_marca_vehiculo();
		$data['trailers'] = $this->Vehiculos_model->get_trailers();
		$data['tipov'] = $this->Vehiculos_model->get_tipo_vehiculo();
		$data['carr'] = $this->Vehiculos_model->get_carr_vehiculo();
		$data['paises'] = $this->Paises_model->get_pais();
		$data['aseg'] = $this->Aseguradoras_model->get_aseguradoras();
		$this->load->view('conductor/vwVehiculos', $data);
	}

	public function get_vehiculo_xid($id) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$data['idusuario'] = $session_data['id'];
		$usuario = $session_data['usuario'];
		$data['usuario'] = $usuario;
		$data['nombre'] = $session_data['nombre'];
		$data['apellidos'] = $session_data['ape'];
		$data['estado'] = $session_data['activo'];
		$data['tipo'] = $session_data['tipo'];
		$vehiculo = $this->Vehiculos_model->get_vehiculo_xid($id);
		if ($vehiculo != FALSE) {
			$data['idv'] = $vehiculo->idVehiculo;
			$data['placa'] = $vehiculo->placa;
			$data['nombre_ciudad'] = $vehiculo->nombre_ciudad;
			$data['nombre_tv'] = $vehiculo->nombre_tv;
			$data['nombre_ciudad'] = $vehiculo->nombre_ciudad;
			$data['nombre_carr'] = $vehiculo->nombre_carr;
			$data['trailer'] = $vehiculo->trailer;
			$data['trailermarca'] = $vehiculo->trailermarca;
			$data['modelo_trailer'] = $vehiculo->modelo_trailer;
			$data['peso_vacio_trailer'] = $vehiculo->peso_vacio_trailer;
			$data['satelite'] = $vehiculo->satelite;
			$data['sateliteusuario'] = $vehiculo->sateliteusuario;
			$data['sateliteclave'] = $vehiculo->sateliteclave;
			$data['repotenciacion'] = $vehiculo->repotenciacion;
			$data['modelo'] = $vehiculo->modelo;
			$data['marca'] = $vehiculo->marcav;
			$data['capacidad_carga'] = $vehiculo->capacidad_carga;
			$data['vence_soat'] = $vehiculo->vence_soat;
			$data['soat'] = $vehiculo->soat;
			$data['rtecnomecanica'] = $vehiculo->rtecnomecanica;
			$data['vence_rtecnomecanica'] = $vehiculo->vence_rtecnomecanica;
			$data['licenciatransito'] = $vehiculo->licenciatransito;
			$data['rutpropietario'] = $vehiculo->rutpropietario;
			$data['foto_frontal'] = $vehiculo->foto_frontal;
			$data['foto_latder'] = $vehiculo->foto_latder;
			$data['foto_latizq'] = $vehiculo->foto_latizq;
			$data['carnetafiliacion'] = $vehiculo->carnetafiliacion;
			$data['pdf'] = $vehiculo->pdf;
			$data['cedulapropietario'] = $vehiculo->cedulapropietario;
			$data['remolque'] = $vehiculo->remolque;
		}
		$sql = $this->Vehiculos_model->get_docs_temp_vehiculo($id);
		if ($sql != FALSE) {
			foreach ($sql as $fila) {
				$codigo = $fila->codigo;
				$estado = $fila->estado;
				if ($codigo == 0 && $estado == 0) {
					$data['soattemp'] = $fila->nombre;
					$data["obsv"] = "Pendiente por aprobación";
				}
				if ($codigo == 1 && $estado == 0) {
					$data['rtecnotemp'] = $fila->nombre;
					$data["obsv1"] = "Pendiente por aprobación";
				}
				if ($codigo == 2 && $estado == 0) {
					$data['lictemp'] = $fila->nombre;
					$data["obsv2"] = "Pendiente por aprobación";
				}
				if ($codigo == 3 && $estado == 0) {
					$data['cedptemp'] = $fila->nombre;
					$data["obsv3"] = "Pendiente por aprobación";
				}
				if ($codigo == 4 && $estado == 0) {
					$data['rutptemp'] = $fila->nombre;
					$data["obsv4"] = "Pendiente por aprobación";
				}
				if ($codigo == 5 && $estado == 0) {
					$data['frontaltemp'] = $fila->nombre;
					$data["obsv5"] = "Pendiente por aprobación";
				}
				if ($codigo == 6 && $estado == 0) {
					$data['latdertemp'] = $fila->nombre;
					$data["obsv6"] = "Pendiente por aprobación";
				}
				if ($codigo == 7 && $estado == 0) {
					$data['traseratemp'] = $fila->nombre;
					$data["obsv7"] = "Pendiente por aprobación";
				}
				if ($codigo == 8 && $estado == 0) {
					$data['remolquetemp'] = $fila->nombre;
					$data["obsv8"] = "Pendiente por aprobación";
				}
				if ($codigo == 9 && $estado == 0) {
					$data['carnettemp'] = $fila->nombre;
					$data['obsv9'] = "Pendiente por aprobación";
				}
				if ($codigo == 10 && $estado == 0) {
					$data['pdftemp'] = $fila->nombre;
					$data['obsv10'] = "Pendiente por aprobación";
				}
			}
		}
		$data['paises'] = $this->Paises_model->get_pais();
		$this->load->view('conductor/vwFormEditVehiculo', $data);
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
			'activo' => 0
		);
		$res = $this->Vehiculos_model->add_vehiculo($data);
		if ($res === TRUE) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function update_vehiculo() {

		if ($this->input->post('update_reg')) {

			$this->Vehiculos_model->update_vehiculo();
			$data = array('mensaje' => 'Datos actualizados');
			redirect(base_url() . 'conductor/Perfil/get_vehiculos', $data);
		} else {
			$data = array('mensaje' => 'No se realizo actualización');
			redirect(base_url() . 'conductor/Perfil/get_vehiculos', $data);
		}
	}

	public function get_conductores() {

		$data['mensaje'] = 'No hay conductores buscando empleo';
		$data['conductor'] = $this->Conductores_model->get_conductores();
		$this->load->view('conductor/vwConductores', $data);
	}

	public function finalizar_contrato_conductor() {

		$data['mensaje'] = 'Aun no has registrado conductores';
		$data['conductor'] = $this->Conductores_model->finalizar_contrato_conductor();
		redirect(base_url() . 'conductor/Perfil/get_conductores_contratados');
	}

	public function get_conductor_xid($id) {

		if (!$id) {
			show_404();
		}
		$data['paises'] = $this->Paises_model->get_pais();
		$data['conxid'] = $this->Conductores_model->get_conductor_xid($id);
		$this->load->view('conductor/vwFormContratarConductor', $data);
	}

	public function ver_conductor_xid($id) {

		if (!$id) {
			show_404();
		}
		$data['paises'] = $this->Paises_model->get_pais();
		$data['conxid'] = $this->Conductores_model->get_conductor_xid($id);
		$this->load->view('conductor/vwVerConductor', $data);
	}

	public function add_conductor() {
		$data['paises'] = $this->Paises_model->get_pais();
		$this->load->view('conductor/vwFormAddConductor', $data);
	}

	public function guardar_conductor() {

		if ($this->input->post('submit_reg')) {

			$this->form_validation->set_rules('username', 'Usuario', 'required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('password', 'Contraseña', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Teléfono', 'required|integer');
			$this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('terminos', 'Terminos y politicas de privacidad', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data['mensaje'] = '';
				$this->load->view('registro', $data);
			} else {

				$this->Conductores_model->add_conductor();
				redirect(base_url() . 'conductor/Perfil/get_conductores');
			}
		} else {
			$data = array('mensaje' => 'No se realizo el registro');
			redirect(base_url() . 'conductor/Perfil/add_conductor', $data);
		}
	}

	public function update_conductor() {

		if ($this->input->post('update_reg')) {

			$this->Conductores_model->update_conductor();
			$data = array('mensaje' => 'Datos actualizados');
			redirect(base_url() . 'conductor/Perfil/get_conductores', $data);
		} else {
			$data = array('mensaje' => 'No se realizo actualización');
			redirect(base_url() . 'conductor/Perfil/get_conductores', $data);
		}
	}

	public function edit_foto_cccond() {
		if ($this->input->post('update_cc')) {

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '50000';
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

				$data = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Condcutores_model->update_cc($imagen);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function edit_foto_liccon() {
		if ($this->input->post('update_liccond')) {

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '50000';
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

				$data = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Condcutores_model->update_lict($imagen);
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function subir_docs_vehiculo() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$consulta = $this->db->get_where('users', array('usuario' => $usuario));
		if ($consulta->num_rows() != 0) {
			foreach ($consulta->result() as $row) {
				$tipo = $row->tipo;
				$cont = $row->id;
				$conductores = $this->db->get_where('users', array('nivel' == 'Conductor', 'Assign_idUser' => $usuario)); // get query result
				$vehiculos = $this->db->get_where('sf_vehiculo', array('user_id' => $cont)); // get query result
				$count1 = $conductores->num_rows(); //get current query record.
				$count2 = $vehiculos->num_rows(); //get current query record.
				$refper = $this->db->get_where('sf_guard_user_profile_rp', array('userhv_id' => $cont)); // get query result
				$contador = $refper->num_rows(); //get current query record.
				$refemp = $this->db->get_where('sf_guard_user_profile_re', array('userhv_id' => $cont)); // get query result
				$contador1 = $refemp->num_rows(); //get current query record.
				$estado = $row->activo;
			}
		}
		$data['usuario'] = $usuario;
		$data['nombre'] = $nombre;
		$data['apellidos'] = $apellidos;
		$data['count1'] = $count1;
		$data['count2'] = $count2;
		$data['estado'] = $estado;
		$data['tipo'] = $tipo;
		$this->load->view("conductor/vwSubirDocsVeh", $data);
	}

	public function reg_Propietario() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$res = $this->Registros_model->tipoPropietario($id);
		if ($res == TRUE) {
			echo "ok";
		} else {
			echo "error";
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
