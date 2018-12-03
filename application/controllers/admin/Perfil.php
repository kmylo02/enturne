<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Users_model', 'Paises_model', 'Empresas_model', 'Registros_model', 'Conductores_model', 'Referencias_model', 'Vehiculos_model'));
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
		$arr['edad'] = $this->Users_model->get_edad($usuario);
		$arr['empresa'] = $this->Empresas_model->get_empresa($usuario);
		$paises = $this->Paises_model->get_pais();
		$perfil = $this->Users_model->get_perfil($usuario);
		$arr['nombre'] = $perfil->nombre;
		$arr['apellidos'] = $perfil->apellidos;
		$tipo_doc = $perfil->tipo_doc;
		if ($tipo_doc == "1") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "2") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>Pasaporte</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '3'>Libreta Militar</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "3") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>Libreta Militar</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "4") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>NIT</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		$arr['cedula'] = $perfil->cedula;
		$arr['fecha_nac'] = $perfil->fecha_nac;
		$estado_civil = $perfil->estado_civil;
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
		if ($sexo == "Masculino") {
			$arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' name = 'gender' value = '" . $sexo . "' checked>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Femenino'> Femenino
                    </label>
                </div>";
		}
		if ($sexo == "Femenino") {
			$arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' name = 'gender' value = '" . $sexo . "' checked>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Masculino'> Masculino
                    </label>
                </div>";
		}
		$arr['cedula'] = $perfil->cedula;
		$dpto = $perfil->nombre_dpto;
		$optdpto = "";
		foreach ($paises as $fila) {
			$valdpto = $fila->idDepartamento;
			/* var_dump($valdpto," ",$dpto);
			  die(); */
			if ($valdpto === $dpto) {
				$optdpto .= "<option value='" . $valdpto . "' selected = 'selected'>" . $fila->nombre_dpto . "</option>";
			} else {
				$optdpto .= "<option value='" . $valdpto . "'>" . $fila->nombre_dpto . "</option>";
			}
		}
		$arr['optdpto'] = $optdpto;
		$arr['optciudad'] = "<option value='" . $perfil->nombre_ciudad . "'>" . $perfil->nombre_ciudad . "</option>";
		$arr['telefono'] = $perfil->telefono;
		$arr['celular'] = $perfil->celular;
		$arr['direccion'] = $perfil->direccion;
		$arr['email'] = $perfil->email;
		$tipo_vivienda = $perfil->tipo_vivienda;
		if ($tipo_vivienda == NULL) {
			$arr['optvivienda'] = "<option value='Arrendada'>Arrendada</option>
                        <option value='Propia'>Propia</option>";
		}
		if ($tipo_vivienda == "Arrendada") {
			$arr['optvivienda'] = "<option value='" . $tipo_vivienda . "'>" . $tipo_vivienda . "</option>
                        <option value='Propia'>Propia</option>";
		}
		if ($tipo_vivienda == "Propia") {
			$arr['optvivienda'] = "<option value='" . $tipo_vivienda . "'>" . $tipo_vivienda . "</option>
                        <option value='Arrendada'>Arrendada</option>";
		}
		$arr['mesvivienda'] = $perfil->meses_vivienda;
		$arr['numlicencia'] = $perfil->licencia_conduccion;
		$catlic = $perfil->categoria_lic;
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
		$arr['fecha_ven_licencia'] = $perfil->fecha_ven_licencia;


		$this->load->view('admin/vwFormPerfil', $arr);
	}

	public function get_perfil() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['idempresa'] = $session_data['idempresa'];
		$arr['usuario'] = $usuario;
		$arr['page'] = 'dash';
		$arr['edad'] = $this->Users_model->get_edad($usuario);
		$arr['perfil'] = $this->Users_model->get_perfil($usuario);
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['empresa'] = $this->Empresas_model->get_empresa($usuario);
		$this->load->view('admin/vwPerfil', $arr);
	}

	public function get_empresa() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['empresa'] = $this->Empresas_model->get_empresa_empleado($usuario);
		$this->load->view('admin/vwEmpresa', $arr);
	}

	public function get_perxid($idempleado) {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$arr['usuario'] = $session_data['usuario'];
		$arr['nombre'] = $session_data['nombre'];
		$arr['apellidos'] = $session_data['ape'];
		$arr['mensaje'] = '';
		$arr['idempleado'] = $idempleado;
		$paises = $this->Paises_model->get_pais();
		$perfil = $this->Users_model->get_perfilxid($idempleado);
		$arr['nombre'] = $perfil->nombre;
		$arr['apellidos'] = $perfil->apellidos;
		$tipo_doc = $perfil->tipo_doc;
		if ($tipo_doc == "1") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "2") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>Pasaporte</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '3'>Libreta Militar</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "3") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>Libreta Militar</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '4'>NIT</option>";
		}
		if ($tipo_doc == "4") {
			$arr['optiondoc'] = "<option value = '$tipo_doc'>NIT</option>" .
							"<option value = '1'>CC</option>" .
							"<option value = '2'>Pasaporte</option>" .
							"<option value = '3'>Libreta Militar</option>";
		}
		$arr['cedula'] = $perfil->cedula;
		$sexo = $perfil->sexo;
		if ($sexo == "No presenta") {
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
                        <input type = 'radio' name = 'gender' value = '" . $sexo . "' checked>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Femenino'> Femenino
                    </label>
                </div>";
		}
		if ($sexo == "Femenino") {
			$arr['radio'] = "<div class = 'radio'><label>
                        <input type = 'radio' name = 'gender' value = '" . $sexo . "' checked>" . $sexo . "</label></div>
                <div class = 'radio'>
                    <label>
                        <input type = 'radio' name = 'gender' value = 'Masculino'> Masculino
                    </label>
                </div>";
		}
		$arr['cedula'] = $perfil->cedula;
		$dpto = $perfil->nombre_dpto;
		$optdpto = "";
		foreach ($paises as $fila) {
			$valdpto = $fila->idDepartamento;
			/* var_dump($valdpto," ",$dpto);
			  die(); */
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

		$this->load->view('admin/vwPerfilxid', $arr);
	}

	public function get_personal() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$idempresa = $session_data['idempresa'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		$arr['aviso'] = '';
		$arr['empresa'] = $this->Empresas_model->get_empresa($usuario);
		$arr['paises'] = $this->Paises_model->get_pais();
		$arr['mensaje'] = 'Aun no has registrado empleados';
		$arr['personal'] = $this->Empresas_model->get_personal($idempresa);
		$this->load->view('admin/vwPersonal', $arr);
	}

	public function guardar_personal() {
		$session_data = $this->session->userdata('datos_usuario');
		$idempresa = $session_data['idempresa'];
		$nombre = $this->input->post("name");
		$apellidos = $this->input->post("sname");
		$tipo_doc = $this->input->post("tipo_doc");
		$cedula = $this->input->post("cedula");
		$email = $this->input->post("email");
		$telefono = $this->input->post("telefono");
		$dpto = $this->input->post("provincia");
		$ciudad = $this->input->post("localidad");
		$direccion = $this->input->post("direccion");
		$nivel = $this->input->post("nivel");
		$usuarioemp = $this->input->post("username");
		$pass = md5($this->input->post("password"));
		$permisos = $this->input->post("permisos");

		$res = $this->Registros_model->add_user_empresa($nombre, $apellidos, $tipo_doc, $cedula, $email, $telefono, $dpto, $ciudad, $direccion, $nivel, $usuarioemp, $pass, $idempresa, $permisos);
		if ($res === 0) {
			echo "existe";
		}
		if ($res === false) {
			echo "error";
		}
		if ($res === true) {

			$code = $this->input->post('code', TRUE);
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

			$this->email->from('soporte@enturne.co', 'Enturne SAS');
			$this->email->to($this->input->post('email', TRUE));
			$this->email->subject('Confirme cuenta de usuario APP Enturne');
			$this->email->message('<h1>Bienvenido: ' . $this->input->post('nombre', TRUE) . ' ' . $this->input->post('apellidos', TRUE) . '<p>'
							. 'Para confirmar su registro ingrese a la siguiente url '
							. anchor(base_url() . 'Registros/confirmar/' . $code) . ' <br><b>Gracias por su registro</b>'
							. '</p>');
			$this->email->send();
			echo "ok";
		}
	}

	public function edit_user() {
		$session_data = $this->session->userdata('datos_usuario');
		$usuario = $session_data['usuario'];
		$data = array(
			'nombre' => $this->input->post('firstName'),
			'apellidos' => $this->input->post('lastName'),
			'tipo_doc' => $this->input->post('tipo_doc'),
			'cedula' => $this->input->post('cc'),
			'fecha_nac' => $this->input->post('theDate'),
			'estado_civil' => $this->input->post('est_civil'),
			'nombre_conyuge' => $this->input->post('nombre_conyuge'),
			'apellido_conyuge' => $this->input->post('apellido_conyuge'),
			'tipo_docc' => $this->input->post('tipo_docc'),
			'cedulac' => $this->input->post('ccc'),
			'tel_conyuge' => $this->input->post('tel_conyuge'),
			'sexo' => $this->input->post('gender'),
			'pais' => 1,
			'dpto' => $this->input->post('provincia'),
			'ciudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email'),
			'tipo_vivienda' => $this->input->post('tipo_vivienda'),
			'meses_vivienda' => $this->input->post('meses_vivienda'),
			'licencia_conduccion' => $this->input->post('licencia_conduccion'),
			'categoria_lic' => $this->input->post('categoria_lic'),
			'fecha_ven_licencia' => $this->input->post('theDatev')
		);
		$res = $this->Users_model->update_perfil($data, $usuario);
		if ($res == true) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function edit_userxid() {
		$idempleado = $this->input->post('idempleado');
		$data = array(
			'nombre' => $this->input->post('firstName'),
			'apellidos' => $this->input->post('lastName'),
			'tipo_doc' => $this->input->post('tipo_doc'),
			'cedula' => $this->input->post('cc'),
			'sexo' => $this->input->post('gender'),
			'idPais' => 1,
			'idDepartamento' => $this->input->post('provincia'),
			'idCiudad' => $this->input->post('localidad'),
			'direccion' => $this->input->post('address'),
			'telefono' => $this->input->post('phone'),
			'celular' => $this->input->post('celphone'),
			'email' => $this->input->post('email')
		);
		$res = $this->Users_model->update_perfilxid($data, $idempleado);
		if ($res == true) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function edit_foto_user() {
		$session_data = $this->session->userdata('datos_usuario');
		if (!$session_data) {
			redirect('Login');
		}
		$id = $session_data['id'];
		$usuario = $session_data['usuario'];
		$nombre = $session_data['nombre'];
		$apellidos = $session_data['ape'];
		$arr['usuario'] = $usuario;
		$arr['nombre'] = $nombre;
		$arr['apellidos'] = $apellidos;
		if ($this->input->post('update_foto')) {

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '50000';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload()) {

				redirect(base_url() . 'admin/Perfil/get_perfil');
			} else {
				//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS
				//ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA

				$arr = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$subir = $this->Users_model->update_foto_perfil($id, $imagen);
				redirect(base_url() . 'admin/Perfil/get_perfil');
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
