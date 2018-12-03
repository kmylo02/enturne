<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ofertas_model extends CI_Model {

    public function get_ofertas() {

        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_tv,
								t4.nombre_carr,t5.nombre_ciudad as destino, t6.nombre, t6.apellidos,
								t7.idEmpresa as id_empresa, t7.nombre_empresa,t7.nit,t7.email
								FROM OfertasCarga t1 JOIN
								Ciudades t2 ON t2.idCiudad=t1.origen_id JOIN Ciudades t5 ON
								t5.idCiudad=t1.destino_id JOIN TipoVehiculos t3
								ON t3.idTipoVehiculo=t1.idTipoVehiculo JOIN CamionesCarrocerias t4
								ON t4.idCamionesCarroceria=t1.idCamionesCarroceria
								JOIN Users t6 ON t1.idUser=t6.idUser
								JOIN Empresas t7 ON t6.idEmpresa=t7.idEmpresa";
        $query = $this->db->query($consulta);

        //echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertas_aplicando($user) {
        $this->db->trans_start();
        $query = $this->db->get_where('users', array('usuario' => $user));

        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $id_con = $row->id;
            }
        }
        $v = "SELECT * FROM Vehiculos WHERE conductor_id='$id_con'";
        $consulta1 = $this->db->query($v);
        if ($consulta1->num_rows() != 0) {
            foreach ($consulta1->result() as $row) {
                $idVehiculos = $row->idv;
            }
        }

        $consulta = "SELECT t1.*,t2.contratado,t2.idOfertaCarga,t2.idVehiculos,t3.nombre_empresa,t3.siglas,t3.telefono,t3.celular,t3.ranking,t4.nombre_ciudad as origen,
      t5.nombre_ciudad as destino, t6.nombre,t6.apellidos from OfertasCargaVehiculos t2,OfertasCarga t1 JOIN Empresas t3
       ON t1.idEmpresa=t3.id JOIN Ciudades t4 ON t1.origen_id=t4.id JOIN Ciudades t5
        ON t1.destino_id=t5.id JOIN users t6 ON t1.usuario_id = t6.id where t1.id=t2.idOfertaCarga AND t2.idVehiculos='$idVehiculos'
         and t2.aplicando=1 ORDER BY t1.id DESC";
        $query3 = $this->db->query($consulta);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return $query3->result();
        } else {
            return false;
        }
    }

    public function get_vehiculos_aplicando_x_propietario($idusuario) {
        $consulta = "SELECT t1.idOfertasCargaVehiculos as idContrato,t1.idOfertaCarga,t6.idEmpresa,t0.idUser,t1.idVehiculo,
								t1.contratado,t1.aplicando,t1.ocupado,t1.pdf,t2.idVehiculo,t2.placa,t0.*,
								t3.nombre_empresa,t3.siglas, t3.ranking,t3.telefono,t3.celular,
								t4.nombre_ciudad as origen, t5.nombre_ciudad as destino
								from OfertasCargaVehiculos t1
								JOIN Vehiculos t2 ON t2.idUser='$idusuario'
								JOIN OfertasCarga t0 ON t0.idOfertaCarga=t1.idOfertaCarga
								JOIN Ciudades t4 ON t0.origen_id=t4.idCiudad
								JOIN Ciudades t5 ON t0.destino_id=t5.idCiudad
								JOIN Users t6 ON t6.idUser=t0.idUser
								JOIN Empresas t3 ON t6.idEmpresa=t3.idEmpresa
								where t1.idVehiculo=t2.idVehiculo
								ORDER BY t1.idOfertasCargaVehiculos DESC";
        $query = $this->db->query($consulta);

//		echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function confirmacion_aplicando($idOferta, $idVehiculo) {
        $consulta = "SELECT * FROM OfertasCargaVehiculos WHERE idOfertaCarga='$idOferta' AND idVehiculos='$idVehiculo' AND aplicando = '1'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertas_xorigen($id) {
        $this->db->trans_start();
        $v = "SELECT * FROM Vehiculos WHERE conductor_id='$id' AND enturne!='2'";
        $vehiculo = $this->db->query($v)->row();
        if ($vehiculo) {
            $tipov = $vehiculo->idTipoVehiculo;
            $carroceria = $vehiculo->idCamionesCarroceria;
            $carroceria2 = $vehiculo->idCamionesCarroceria2;
            $origen = $vehiculo->origen_id;
            $peso = $vehiculo->capacidad_carga;
            $consulta2 = "SELECT t1.*,t2.nombre_ciudad as origen,
                t3.nombre_tv,t4.nombre_carr as carr,t5.nombre_ciudad as destino,
                t5.Latitud,t5.Longitud,t7.nombre,t7.apellidos,t7.telefono,t7.celular FROM OfertasCarga t1
                JOIN Ciudades t2 ON t2.idCiudad=t1.origen_id JOIN Ciudades t5
                ON t5.idCiudad=t1.destino_id JOIN TipoVehiculos t3
                ON t3.idTipoVehiculo=t1.idTipoVehiculo JOIN CamionesCarrocerias t4
                ON t4.idCamionesCarroceria=t1.idCamionesCarroceria JOIN Users t7
                ON t1.idUser=t7.idUser WHERE t1.peso <= $peso AND t1.estado='Abierta'"
                    . " AND t1.origen_id=$origen AND t1.idTipoVehiculo=$tipov"
                    . " AND (t1.idCamionesCarroceria=$carroceria OR"
                    . " t1.idCamionesCarroceria=$carroceria2)";

            $query1 = $this->db->query($consulta2);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return $query1->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_cargas_app_empresa($idUsuario) {
        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen,"
                . "t3.nombre_tv,t4.nombre_carr,t5.Latitud,"
                . "t5.Longitud,t5.nombre_ciudad as destino"
                . " FROM OfertasCarga t1 JOIN Ciudades t2 ON"
                . " t2.idCiudad=t1.origen_id JOIN Ciudades t5"
                . " ON t5.idCiudad=t1.destino_id JOIN"
                . " TipoVehiculos t3 ON"
                . " t3.idTipoVehiculo=t1.idTipoVehiculo JOIN"
                . " CamionesCarrocerias t4 ON"
                . " t4.idCamionesCarroceria=t1.idCamionesCarroceria"
                . " WHERE t1.estado != 'Cerrada' AND"
                . " t1.idUser = $idUsuario ORDER BY"
                . " t1.idOfertaCarga DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_count_aplicando($id) {
        $consulta = "select count(idOfertasCargaVehiculos) aplicando from OfertasCargaVehiculos where"
                . " idOfertaCarga = $id AND aplicando = 1";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_count_contratados($id) {
        $consulta = "select count(idOfertasCargaVehiculos) contratados from OfertasCargaVehiculos where"
                . " idOfertaCarga=$id AND contratado = 2 AND ocupado = 1";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_ofertas_xidvehiculo_app($id) {
        $consulta = "SELECT DISTINCT * FROM OfertasCargaVehiculos WHERE idVehiculo='$id'"
                . " AND contratado='2' AND aplicando='0' AND ocupado='0' ORDER BY id DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertas_xidv($id) {
        $consulta = "SELECT t1.*,t2.origen_id,t2.destino_id,t2.fecha,t2.peso,"
                . "t2.cantidad,t2.dimensiones,t2.vrflete,t3.placa,t4.nombre_empresa,"
                . "t4.telefono,t4.celular,t5.nombre_ciudad origen,t6.nombre_ciudad destino "
                . "FROM OfertasCargaVehiculos t1 "
                . "JOIN OfertasCarga t2 ON t1.idOfertaCarga=t2.idOfertaCarga "
                . "JOIN Vehiculos t3 ON t3.idVehiculo=t1.idVehiculo "
                . "JOIN Users t7 ON t2.idUser=t7.idUser "
                . "JOIN Empresas t4 ON t7.idEmpresa=t4.idEmpresa "
                . "JOIN Ciudades t5 ON t2.origen_id=t5.idCiudad "
                . "JOIN Ciudades t6 ON t2.destino_id=t6.idCiudad "
                . "WHERE t1.idVehiculo='$id' "
                . "ORDER BY t1.idOfertasCargaVehiculos DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function verifica_contratados($id) {
        $consulta = "SELECT t1.*,t2.origen_id,t2.destino_id,t2.estado,t3.placa,t4.nombre,"
                . "t4.apellidos,t4.telefono,t4.celular,t5.nombre_ciudad origen,"
                . "t6.nombre_ciudad destino FROM OfertasCargaVehiculos t1 JOIN"
                . " OfertasCarga t2 ON t1.idOfertaCarga=t2.id JOIN Vehiculos t3 ON"
                . " t1.idVehiculos=t3.idv JOIN users t4 ON t3.conductor_id=t4.id"
                . " JOIN Ciudades t5 ON t5.id=t2.origen_id JOIN Ciudades t6"
                . " ON t6.id=t2.destino_id WHERE t1.usuario_id='$id' AND t1.contratado='2' AND t1.ocupado='1'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function verifica_rechazos($id) {
        $consulta = "SELECT t1.*,t2.origen_id,t2.destino_id,t2.estado,t3.placa,t4.nombre,"
                . "t4.apellidos,t4.telefono,t4.celular,t5.nombre_ciudad origen,"
                . "t6.nombre_ciudad destino FROM OfertasCargaVehiculos t1 JOIN"
                . " OfertasCarga t2 ON t1.idOfertaCarga=t2.id JOIN Vehiculos t3 ON"
                . " t1.idVehiculos=t3.idv JOIN users t4 ON t3.conductor_id=t4.id"
                . " JOIN Ciudades t5 ON t5.id=t2.origen_id JOIN Ciudades t6"
                . " ON t6.id=t2.destino_id WHERE t1.usuario_id='$id' AND t1.contratado='3' AND t2.estado='Abierta'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function historico($idusuario) {
        $consulta = "SELECT t1.*,t2.vehiculo_asignado,t3.idVehiculo,t3.placa,t3.idTipoVehiculo,t4.nombre_empresa,"
                . "t5.dimensiones,t5.vrflete,t5.origen_id,t5.destino_id,t6.nombre_ciudad as origen,"
                . "t7.nombre_ciudad as destino, t8.nombre,t8.apellidos,t8.celular,t9.nombre_tv "
                . "FROM OfertasCargaVehiculos t1 "
                . "JOIN Users t2 ON t2.idUser=$idusuario "
                . "JOIN Vehiculos t3 ON t3.placa=t2.vehiculo_asignado "
                . "JOIN Empresas t4 ON t2.idEmpresa=t4.idEmpresa "
                . "JOIN OfertasCarga t5 ON t1.idOfertaCarga=t5.idOfertaCarga "
                . "JOIN Ciudades t6 ON t5.origen_id=t6.idCiudad "
                . "JOIN Ciudades t7 ON t5.destino_id=t7.idCiudad "
                . "JOIN Users t8 ON t8.idUser=$idusuario "
                . "JOIN TipoVehiculos t9 ON t3.idTipoVehiculo=t9.idTipoVehiculo "
                . "WHERE t1.idVehiculo=t3.idVehiculo "
                . "AND t1.contratado='2' "
                . "AND t1.aplicando='0' "
                . "AND t1.ocupado='0' "
                . "ORDER BY t1.idOfertasCargaVehiculos DESC ";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function estados_aplicaciones_conductor($id) {

        $session_data = $this->session->userdata('datos_usuario');
        $idc = $session_data['id'];

        $v = "SELECT idVehiculo FROM Vehiculos WHERE conductor_id='$idc'";
        $consulta1 = $this->db->query($v)->row();
        $idv = $consulta1->idVehiculo;

        $estado = "SELECT contratado,aplicando,ocupado "
                . "FROM OfertasCargaVehiculos "
                . "WHERE idOfertaCarga = '$id' "
                . "AND  idVehiculo='$idv'";
        $consulta2 = $this->db->query($estado);
        if ($consulta2->num_rows() > 0) {
            return $consulta2->result();
        } else {
            return false;
        }
    }

    public function aplicar_oferta() {
        $session_data = $this->session->userdata('datos_usuario');
        $id = $session_data['id'];
        $v = "SELECT * FROM Vehiculos WHERE conductor_id='$id' AND enturne='0'";
        $consulta1 = $this->db->query($v)->row();
        if ($consulta1->num_rows() != 0) {
            $idv = $consulta1->idv;
            $tipov = $consulta1->idTipoVehiculo;
            $carroceria = $consulta1->idCamionesCarroceria;
            $origen = $consulta1->origen_id;
        }

        $consulta2 = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_tv,t4.nombre_carr,t5.nombre_ciudad as destino,t6.nombre_empresa,t6.telefono,t6.fax FROM OfertasCarga t1 JOIN Ciudades t2 ON t2.id=t1.origen_id JOIN Ciudades t5 ON t5.id=t1.destino_id JOIN df_camiones_configuracion t3 ON t3.id=t1.idTipoVehiculo JOIN df_camiones_carroceria t4 ON t4.id=t1.idCamionesCarroceria JOIN Empresas t6 ON t6.id=t1.idEmpresa WHERE t1.origen_id='$origen' AND t1.idTipoVehiculo='$tipov' AND t1.idCamionesCarroceria='$carroceria'";
        $query1 = $this->db->query($consulta2)->row();
        if ($query1->num_rows() > 0) {
            $id_carga = $query1->id;
            $id_empresa = $query1->idEmpresa;
        }
        $query3 = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $id_carga, 'idVehiculos' => $idv))->row();
        if ($query3->num_rows() > 0) {
            return FALSE;
        } else {
            $data = array(
                'idOfertaCarga' => $id_carga,
                'idVehiculos' => $idv,
                'idEmpresa' => $id_empresa,
                'aplicando' => 1,
                'fecha_aplicacion' => date('Y-m-d H:i:s')
            );

            $this->db->insert('OfertasCargaVehiculos', $data);

            $data1 = array(
                'enturne' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->db->where('idv', $idv);
            $this->db->update('Vehiculos', $data1);

            return TRUE;
        }
    }

    public function aplicar_oferta_app($idCarga, $idVehiculo) {
        $this->db->trans_start();
        $query = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $idCarga, 'idVehiculo' => $idVehiculo, 'contratado' => 0, 'aplicando' => 1, 'ocupado' => 0));
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $data = array(
                'idOfertaCarga' => $idCarga,
                'idVehiculo' => $idVehiculo,
                'aplicando' => 1,
                'fecha_aplicacion' => date('Y-m-d H:i:s')
            );

            $this->db->insert('OfertasCargaVehiculos', $data);

            $data1 = array(
                'enturne' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->db->where('idVehiculo', $idVehiculo);
            $this->db->update('Vehiculos', $data1);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_ofertas_emp($id_emp) {
        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_tv,
								t4.nombre_carr,t5.nombre_ciudad as destino, t6.nombre, t6.apellidos
								FROM OfertasCarga t1
								JOIN Ciudades t2 ON t2.idCiudad=t1.origen_id
								JOIN Ciudades t5 ON t5.idCiudad=t1.destino_id
								JOIN TipoVehiculos t3	ON t3.idTipoVehiculo=t1.idTipoVehiculo
								JOIN CamionesCarrocerias t4 ON t4.idCamionesCarroceria=t1.idCamionesCarroceria
								JOIN Users t6 ON t1.idUser=t6.idUser
								WHERE t6.idEmpresa='$id_emp'";
        $query1 = $this->db->query($consulta);
        //echo $this->db->last_query();
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function guardar_oferta_empresa($data) {
        $this->db->insert("OfertasCarga", $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_oferta_xid($id) {
        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen,
            t3.nombre_tv,t4.nombre_carr,
            t5.nombre_ciudad as destino,
            t6.nombre_dpto as dpto_origen,
            t7.nombre_dpto as dpto_destino,
            t8.nombre_empresa,t8.telefono,t8.celular,
            t9.nombre,t9.apellidos,t9.idEmpresa FROM OfertasCarga t1
            JOIN Ciudades t2 ON t2.idCiudad=t1.origen_id
            JOIN Ciudades t5 ON t5.idCiudad=t1.destino_id
            JOIN TipoVehiculos t3 ON
            t3.idTipoVehiculo=t1.idTipoVehiculo JOIN
            Departamentos t6 ON t6.idDepartamento=t1.dpto_origen_id
            JOIN Departamentos t7 ON
            t7.idDepartamento=t1.dpto_destino_id
            JOIN CamionesCarrocerias t4 ON
            t4.idCamionesCarroceria=t1.idCamionesCarroceria
            JOIN Users t9 ON t9.idUser=t1.idUser
            JOIN Empresas t8 ON t8.idEmpresa=t9.idEmpresa
            WHERE t1.idOfertaCarga='$id'";
        $query = $this->db->query($consulta);


        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_enturnados() {

        $sql = "SELECT t1.*,t2.* FROM Vehiculos t1 JOIN users t2 ON"
                . " t1.conductor_id = t2.id WHERE t1.enturne = '0'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function aplicando_x_oferta($idCarga) {

        $sql = "SELECT t1.fecha_aplicacion,t1.contratado,t2.idVehiculo,t2.placa,"
                . "t2.enturne,t2.conductor_id,t3.nombre,t3.apellidos,t3.celular,"
                . "t3.foto_ruta,t3.ranking,t4.peso,t4.created_at as"
                . " fecha_creacion_oferta,t4.dimensiones,t4.vrflete"
                . " FROM OfertasCargaVehiculos t1 JOIN Vehiculos t2"
                . " ON t2.idVehiculo=t1.idVehiculo JOIN Users t3"
                . " ON t3.idUser=t2.conductor_id JOIN OfertasCarga t4"
                . " ON t4.idOfertaCarga=t1.idOfertaCarga WHERE"
                . " t1.idOfertaCarga=$idCarga AND t1.aplicando=1";


        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    public function aplicando_x_usuario($idUsuario) {

        $consulta1 = "SELECT t1.*,t2.*,t3.nombre,t3.apellidos,t3.celular,t3.foto_ruta,"
                . "t3.ranking,t4.origen_id,t4.destino_id,t4.idTipoVehiculo,"
                . "t4.idCamionesCarroceria,t4.peso,t4.created_at as fecha_creacion_oferta,"
                . "t5.nombre_ciudad as origen,t6.nombre_ciudad as destino "
                . "FROM OfertasCargaVehiculos t1 "
                . "JOIN Vehiculos t2 ON t2.idVehiculo=t1.idVehiculo "
                . "JOIN Users t3 ON t3.idUser=t2.conductor_id "
                . "JOIN OfertasCarga t4 ON t4.idOfertaCarga=t1.idOfertaCarga "
                . "JOIN Ciudades t5 ON t5.idCiudad=t4.origen_id "
                . "JOIN Ciudades t6 ON t6.idCiudad=t4.destino_id "
                . "where t3.idUser = '$idUsuario' "
                . "AND t1.aplicando=1";
        $query1 = $this->db->query($consulta1);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function contratado_x_usuario($idUsuario) {

        $consulta1 = "SELECT t1.*,t2.*,t3.nombre,t3.apellidos,t3.celular,t3.foto_ruta,"
                . "t3.ranking,t4.origen_id,t4.destino_id,t4.idTipoVehiculo,t4.idCamionesCarroceria,"
                . "t4.peso,t4.dimensiones,t4.vrflete,t4.created_at as fecha_creacion_oferta,"
                . "t5.nombre_ciudad as origen,"
                . "t6.nombre_ciudad as destino FROM OfertasCargaVehiculos t1 JOIN Vehiculos t2"
                . " ON t2.idVehiculo=t1.idVehiculo JOIN Users t3 ON t3.idUser=t2.conductor_id JOIN"
                . " OfertasCarga t4 ON t4.idOfertaCarga=t1.idOfertaCarga JOIN Ciudades t5 ON t5.idCiudad=t4.origen_id"
                . " JOIN Ciudades t6 ON t6.idCiudad=t4.destino_id where (t4.idUser='$idUsuario'"
                . " and t1.contratado=2) group by t1.idVehiculo";
        $query1 = $this->db->query($consulta1);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function get_contratados($idCarga) {

        $consulta = "SELECT t1.idOfertasCargaVehiculos as idContrato,t1.idOfertaCarga,t3.idEmpresa,"
                . "t4.idUser,t1.idVehiculo,t1.contratado,t1.aplicando,"
                . "t1.ocupado,t1.fecha_aplicacion,t1.fecha_contratado,t1.pdf as manifest,t2.*,"
                . "t3.idUser as idConductor,t3.nombre,t3.apellidos,"
                . "t3.celular,t3.foto_ruta,t3.ranking,t4.origen_id,t4.destino_id,"
                . "t4.dimensiones,t4.vrflete,t4.idTipoVehiculo,t4.idCamionesCarroceria,"
                . "t4.peso,t4.created_at as fecha_creacion_oferta,t5.idCiudad,"
                . "t5.nombre_ciudad as origen,t6.idCiudad,t6.nombre_ciudad as destino"
                . " FROM OfertasCargaVehiculos t1,Vehiculos t2, Users t3,"
                . " OfertasCarga t4, Ciudades t5, Ciudades t6"
                . " where t1.idOfertaCarga = '$idCarga' and t2.idVehiculo=t1.idVehiculo and"
                . " t3.idUser=t2.conductor_id and t4.idOfertaCarga='$idCarga' AND"
                . " t5.idCiudad=t4.origen_id AND t6.idCiudad=t4.destino_id AND t1.ocupado = '1'"
                . " AND t1.contratado = '2' AND t1.aplicando = '0'";

        $query = $this->db->query($consulta);

//		echo $this->db->last_queryery();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_cantaplicando_xid($id) {

        $consulta1 = "SELECT *,COUNT(*) aplicando from OfertasCargaVehiculos where idOfertaCarga = '$id' and aplicando = '1'";
        $query1 = $this->db->query($consulta1);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function get_contratados_xid($id) {

        $consulta1 = "SELECT *,COUNT(*) contratado from OfertasCargaVehiculos where idOfertaCarga = '$id' AND contratado = '2' AND ocupado = '1'";
        $query1 = $this->db->query($consulta1);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function aplicando($id) {
        $query = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $id, 'aplicando' => 1));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function convenir_oferta($id, $idCarga) {
        $data = array(
            'contratado' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idOfertaCarga', $idCarga);
        $this->db->where('idVehiculo', $id);
        $this->db->update('OfertasCargaVehiculos', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function aceptar_oferta($id, $idCarga) {
        $contratados = $this->cantcontratados($idCarga);
        $cantidad = $this->cantOferta($idCarga);
        if ($contratados < $cantidad) {
            $this->db->trans_start();
            $data = array(
                'contratado' => 2,
                'aplicando' => 0,
                'ocupado' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'fecha_contratado' => date('Y-m-d H:i:s')
            );
            $this->db->where('idOfertaCarga', $idCarga);
            $this->db->where('idVehiculo', $id);
            $this->db->update('OfertasCargaVehiculos', $data);

            $data2 = array(
                'enturne' => 2,
                'estado' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('idVehiculo', $id);
            $this->db->update('Vehiculos', $data2);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $contratados = $this->cantcontratados($idCarga);
                $cantidad = $this->cantOferta($idCarga);
                $this->cerrarOferta($idCarga, $contratados, $cantidad);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update_carga_vehiculo($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('OfertasCargaVehiculos', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cerrarOferta($idCarga, $cont, $cant) {
        if ($cont === $cant) {
            $data3 = array(
                'estado' => 'Cupos Llenos',
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('id', $idCarga);
            $this->db->update('OfertasCarga', $data3);
        }
    }

    public function rechazar_oferta($id, $idCarga) {
        $this->db->trans_start();

        $data = array(
            'contratado' => 3,
            'aplicando' => 0,
            'ocupado' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idOfertaCarga', $idCarga);
        $this->db->where('idVehiculos', $id);
        $this->db->update('OfertasCargaVehiculos', $data);

        $data2 = array(
            'enturne' => 0,
            'estado' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idv', $id);
        $this->db->update('Vehiculos', $data2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function contratado($vehiculo) {
        $query = "SELECT t1.*,t2.Latitud,t2.Longitud,t2.nombre_ciudad destino,"
                . "t4.nombre_ciudad origen,t3.idEmpresa,t3.nombre_empresa,t3.telefono,t3.fax,"
                . "t3.celular,t5.idOfertasCargaVehiculos as contrato_id,t5.pdf"
                . " as manifiesto FROM OfertasCarga t1 JOIN Ciudades t2 ON"
                . " t1.destino_id=t2.idCiudad JOIN Ciudades t4 ON"
                . " t1.origen_id=t4.idCiudad JOIN Users t6 ON"
                . " t1.idUser=t6.idUser JOIN Empresas t3 ON"
                . " t3.idEmpresa=t6.idEmpresa JOIN OfertasCargaVehiculos t5"
                . " ON t5.idOfertasCargaVehiculos=(select idOfertasCargaVehiculos"
                . " from OfertasCargaVehiculos where idVehiculo = $vehiculo and"
                . " contratado = 2 and aplicando = 0 and ocupado = 1)"
                . " WHERE t1.idOfertaCarga = (select idOfertaCarga from"
                . " OfertasCargaVehiculos where idVehiculo = $vehiculo and"
                . " contratado = 2 and aplicando = 0 and ocupado = 1)";
        $sql = $this->db->query($query);
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

    public function getManifiesto($id) {
        $query = $this->db->get_where('OfertasCargaVehiculos', array('idOfertasCargaVehiculos' => $id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function get_contratado_xid_vehiculo($id) {
        $query = $this->db->get_where('OfertasCargaVehiculos', array('idVehiculo' => $id, 'contratado' => '2', 'aplicando' => '0', 'ocupado' => '1'));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function solicitud_contrato($vehiculo) {
        $this->db->trans_start();
        $query2 = $this->db->get_where('OfertasCargaVehiculos', array('idVehiculo' => $vehiculo, 'contratado' => '1'));
        if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $key) {
                $idCarga = $key->idOfertaCarga;
            }
        }
        $consulta = "SELECT t1.*,t2.Latitud,t2.Longitud,t2.nombre_ciudad destino,t4.nombre_ciudad origen,"
                . "t3.nombre,t3.apellidos,t3.telefono,t3.celular,t6.enturne FROM OfertasCarga t1 JOIN Ciudades t2 ON"
                . " t1.destino_id=t2.idCiudad JOIN Ciudades t4 ON t1.origen_id=t4.idCiudad JOIN Users t3 ON"
                . " t1.idUser=t3.idUser JOIN Vehiculos t6 ON t6.idVehiculo = $vehiculo WHERE t1.idOfertaCarga = $idCarga ";
        $query3 = $this->db->query($consulta);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return $query3->result();
        } else {
            return false;
        }
    }

    public function terminarContrato($idVehiculo, $idOferta, $idConductor, $ranking, $obsv) {
        $q = $this->db->get_where('users', array('id' => $idConductor))->row();
        $nombre_usuario = $q->nombre;
        $apellidos_usuario = $q->apellidos;
        $ranking_recibido = $q->ranking;
        $mail_recibido = $q->email;
        $placa = $q->vehiculo_asignado;
        $propietario = $q->Assign_idUser;
        $qProp = $this->db->get_where('users', array('usuario' => $propietario))->row();
        $mailPropietario = $qProp->email;
        $q1 = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN Ciudades t2 ON t2.id=t1.origen_id JOIN Ciudades t3 ON t3.id=t1.destino_id WHERE t1.id='$idOferta'";
        $sql = $this->db->query($q1)->row();
        $trayecto = $sql->origen . ' - ' . $sql->destino;
        $q2 = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $idOferta, 'idVehiculos' => $idVehiculo))->row();

        $inicio = $q2->fecha_contratado;
        $final = date('Y-m-d H:i:s');
        $query = $this->db->get_where('OfertasCarga', array('id' => $idOferta))->row();
        $idEmpresa = $query->idEmpresa;
        $consulta_empresa = $this->db->get_where('Empresas', array('id' => $idEmpresa))->row();
        $nombre_empresa = $consulta_empresa->nombre_empresa;
        $datos = array(
            'ocupado' => 0,
            'date_end' => date('Y-m-d H:i:s'),
            'resultado' => 'FINALIZADO POR LA EMPRESA',
            'calificacion_conductor' => $ranking,
            'observaciones' => $obsv
        );
        $this->db->where('idVehiculos', $idVehiculo);
        $this->db->where('idOfertaCarga', $idOferta);
        $this->db->update('OfertasCargaVehiculos', $datos);
        $data = array(
            'enturne' => 0,
            'estado' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idv', $idVehiculo);
        $this->db->update('Vehiculos', $data);
        $data1 = array(
            'ranking' => ($ranking_recibido + $ranking) / 2,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $idConductor);
        $this->db->update('users', $data1);
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
        $data3 = array(
            'nombre_usuario' => $nombre_usuario,
            'apellidos_usuario' => $apellidos_usuario,
            'nombre_empresa' => $nombre_empresa,
            'placa' => $placa,
            'trayecto' => $trayecto,
            'inicio' => $inicio,
            'final' => $final,
            'ranking' => $ranking,
            'obsv' => $obsv
        );
        $this->email->to($mail_recibido);
        $this->email->cc($mailPropietario);
        $this->email->subject('Calificación desde app 1');
        $body = $this->load->view('calificacion_conductor.php', $data3, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

    public function cancelarContrato($idVehiculo, $idOferta, $idEmpresa, $ranking, $obsv) {
        $empresa = $this->db->get_where('Empresas', array('id' => $idEmpresa))->row();
        $nombre_empresa = $empresa->nombre_empresa;
        $mail_empresa = $empresa->email;
        $ranking_recibido = $empresa->ranking;
        $vehiculo = $this->db->get_where('Vehiculos', array('idv' => $idVehiculo))->row();
        $idConductor = $vehiculo->conductor_id;
        $placa = $vehiculo->placa;
        $conductor = $this->db->get_where('users', array('id' => $idConductor))->row();
        $nombre = $conductor->nombre . " " . $conductor->apellidos;
        $q1 = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN Ciudades t2 ON t2.id=t1.origen_id JOIN Ciudades t3 ON t3.id=t1.destino_id WHERE t1.id='$idOferta'";
        $sql = $this->db->query($q1)->row();
        $trayecto = $sql->origen . ' - ' . $sql->destino;
        $q2 = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $idOferta, 'idVehiculos' => $idVehiculo))->row();
        $inicio = $q2->fecha_contratado;
        $final = $q2->date_end;
        $datos = array(
            'ocupado' => 0,
            'date_end' => date('Y-m-d H:i:s'),
            'resultado' => 'FINALIZADO POR EL CONDUCTOR',
            'calificacion_empresa' => $ranking,
            'observaciones' => $obsv
        );
        $this->db->where('idVehiculos', $idVehiculo);
        $this->db->where('idOfertaCarga', $idOferta);
        $this->db->update('OfertasCargaVehiculos', $datos);
        $data = array(
            'enturne' => 0,
            'estado' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idv', $idVehiculo);
        $this->db->update('Vehiculos', $data);

        $data1 = array(
            'ranking' => ($ranking_recibido + $ranking) / 2,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $idEmpresa);
        $this->db->update('Empresas', $data1);
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
        $data2 = array(
            'nombre_usuario' => $nombre,
            'nombre_empresa' => $nombre_empresa,
            'placa' => $placa,
            'trayecto' => $trayecto,
            'inicio' => $inicio,
            'final' => $final,
            'ranking' => $ranking,
            'obsv' => $obsv
        );
        $this->email->to($mail_empresa);
        $this->email->subject('Calificación desde App Conductor');
        $body = $this->load->view('calificacion_empresa.php', $data2, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

    public function contratados($id) {
        $query = $this->db->get_where('OfertasCargaVehiculos', array('idOfertaCarga' => $id, 'contratado' => 1, 'ocupado' => 1));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function delete_oferta($id) {
        $this->db->delete('OfertasCarga', array('idOfertaCarga' => $id));
        $this->db->delete('OfertasCargaVehiculos', array('idOfertaCarga' => $id));
        $this->db->delete('Reportes', array('idOfertaCarga' => $id));
    }

    public function update_oferta($id, $data) {
        $this->db->where('idOfertaCarga', $id);
        $this->db->update('OfertasCarga', $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_oferta_xid_app($id, $peso, $cantidad, $fecha) {
        $data = array(
            'peso' => $peso,
            'cantidad' => $cantidad,
            'fecha' => $fecha
        );
        $this->db->where('idOfertaCarga', $id);
        $this->db->update('OfertasCarga', $data);
    }

    public function cerrar_oferta($id) {
        $data = array(
            'estado' => 'Cerrada',
            'finalizado' => date('Y-m-d H:i:s')
        );
        $this->db->where('idOfertaCarga', $id);
        $this->db->update('OfertasCarga', $data);

        $data1 = array(
            'ocupado' => 0,
            'date_end' => date('Y-m-d H:i:s')
        );
        $this->db->where('idOfertaCarga', $id);
        $this->db->where('contratado', 1);
        $this->db->update('OfertasCargaVehiculos', $data1);
    }

    public function get_contratados_empresa($idEmpresa) {
        $consulta = "SELECT t1.*,t2.*,t3.*,t4.nombre_ciudad as origen,
            t5.nombre_ciudad as destino,t6.*,t7.nombre_tv FROM OfertasCargaVehiculos t1
            JOIN Vehiculos t2 ON t1.idVehiculos=t2.idv JOIN users t3
            ON t2.conductor_id=t3.id JOIN OfertasCarga t6 ON t1.idOfertaCarga=t6.id JOIN Ciudades t4
            ON t6.origen_id=t4.id JOIN Ciudades t5 ON t6.destino_id=t5.id
            JOIN df_camiones_configuracion t7 ON t2.idTipoVehiculo=t7.id WHERE
            t1.idEmpresa = '$idEmpresa' AND t1.contratado = '1' AND t1.ocupado = '1'"
                . " AND t1.aplicando='0' ";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_historico_contratados_empresa($idEmpresa) {
        $consulta = "SELECT t1.idOfertasCargaVehiculos as idContrato,t1.idVehiculo,
								t1.contratado,t1.aplicando,t1.ocupado,t1.calificacion_empresa,
								t1.calificacion_conductor,t1.fecha_contratado,t1.date_end,
								t1.observaciones,t1.pdf as manifest,t2.*,t3.*,t4.nombre_ciudad as origen,
								t5.nombre_ciudad as destino,t6.*,t7.nombre_tv,
								t8.nombre as ncreador,t8.apellidos as acreador
								FROM OfertasCargaVehiculos t1
								JOIN Vehiculos t2 ON t1.idVehiculo=t2.idVehiculo
								JOIN Users t3 ON t2.conductor_id=t3.idUser
								JOIN OfertasCarga t6 ON t1.idOfertaCarga=t6.idOfertaCarga
								JOIN Ciudades t4 ON t6.origen_id=t4.idCiudad
								JOIN Ciudades t5 ON t6.destino_id=t5.idCiudad
								JOIN TipoVehiculos t7	ON t2.idTipoVehiculo=t7.idTipoVehiculo
								JOIN Users t8 ON t6.idUser = t8.idUser
								WHERE t3.idEmpresa = '$idEmpresa' "
                . "AND t1.contratado = '2' "
                . "AND t1.ocupado = '0' "
                . "AND t1.aplicando='0' "
                . "ORDER BY t1.idOfertasCargaVehiculos DESC";
        $query = $this->db->query($consulta);
//		echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_historico_contratados_subusuario($idEmpresa, $idUsuario) {
        $consulta = "SELECT t1.id as idContrato,t1.idEmpresa,t1.idVehiculos,
            t1.contratado,t1.aplicando,t1.ocupado,t1.calificacion_empresa,
            t1.calificacion_conductor,t1.fecha_contratado,t1.date_end,
            t1.observaciones,t1.pdf as manifest,t2.*,t3.*,t4.nombre_ciudad as origen,t5.nombre_ciudad as destino,
      t6.*,t7.nombre_tv FROM OfertasCargaVehiculos t1 JOIN Vehiculos t2 ON t1.idVehiculos=t2.idv
       JOIN users t3 ON t2.conductor_id=t3.id JOIN OfertasCarga t6 ON t1.idOfertaCarga=t6.id
        JOIN Ciudades t4 ON t6.origen_id=t4.id JOIN Ciudades t5 ON t6.destino_id=t5.id
         JOIN df_camiones_configuracion t7 ON t2.idTipoVehiculo=t7.id
          WHERE t1.idEmpresa = '$idEmpresa' AND t1.usuario_id = '$idUsuario'"
                . " AND t1.contratado = '2' AND t1.ocupado = '0'"
                . " AND t1.aplicando='0' ORDER BY t1.id DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function cantOferta($idCarga) {
        $sql = "select cantidad from OfertasCarga where idOfertaCarga=$idCarga";
        $res = $this->db->query($sql)->row();
        return $res->cantidad;
    }

    public function cantcontratados($idCarga) {
        $sql = "select count(idOfertasCargaVehiculos) as contratados from"
                . " OfertasCargaVehiculos where idOfertaCarga=$idCarga and"
                . " contratado=2 and ocupado=1";
        $res = $this->db->query($sql)->row();
        return $res->contratados;
    }

    public function solicitud_calificacion_empresa($idv) {
        $sql = "select * from OfertasCargaVehiculos where idVehiculos = $idv"
                . " and contratado = 2 and ocupado = 0 and calificacion_empresa = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function solicitud_calificacion_conductor($id) {
        $sql = "select * from OfertasCargaVehiculos where usuario_id = $id"
                . " and contratado = 2 and ocupado = 0 and calificacion_conductor = 0";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}
