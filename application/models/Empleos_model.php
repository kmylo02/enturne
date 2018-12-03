<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleos_model extends CI_Model {

    public function get_ofertas_empresas() {

        $consulta = "SELECT t1.idOfertaEmpleo,t1.id_empresa,t1.descripcion,"
                . "t1.created_at,t3.nombre_empresa,t3.web,t3.direccion,"
                . "t3.telefono FROM OfertasEmpleo t1, Empresas t3"
                . " WHERE t1.id_empresa=t3.id AND t1.estado='Abierta'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_vacantes_x_lic($catlic) {

        $consulta = "SELECT t1.*,t2.nombre_ciudad,t3.nombre,t3.apellidos,"
                . "t3.vehiculo_asignado,t5.nombre_tv "
                . "FROM OfertasEmpleo t1 "
                . "JOIN TipoVehiculos t5 ON t5.idTipoVehiculo=t1.idTipoVehiculo "
                . "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
                . "JOIN Users t3 ON t3.idUser=t1.idUser "
                . "WHERE CURDATE() <= t1.fecha_fin "
                . "AND t1.cat_licencia='$catlic' "
                . "AND t1.estado = 0";
        $query = $this->db->query($consulta);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_vacante_x_id($id) {

        $consulta = "SELECT * FROM OfertasEmpleo WHERE idOfertaEmpleo='$id'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function detalle($id) {

        $consulta = "SELECT * FROM OfertasEmpleo WHERE idOfertaEmpleo='$id'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            $detalles = $query->result();
            foreach ($detalles as $value) {
                $detalle = $value->descripcion;
            }
            return $detalle;
        } else {
            return false;
        }
    }

    public function cerrar_vacante_x_id($id, $data) {
        $this->db->where('idOfertaEmpleo', $id);
        $this->db->update('OfertasEmpleo', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_vacante_x_id($id, $data) {
        $this->db->where('idOfertaEmpleo', $id);
        $this->db->update('OfertasEmpleo', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_ofertas_empresas_cerradas() {

        $consulta = "SELECT t1.idOfertaEmpleo,t1.id_empresa,t1.descripcion,t1.created_at,t3.nombre_empresa,t3.web,t3.direccion,t3.telefono FROM OfertasEmpleo t1 JOIN Empresas t3 ON t1.id_empresa=t3.id WHERE t1.estado='Cerrada'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertas_transportistas_cerradas() {

        $consulta = "SELECT t1.idOfertaEmpleo,t1.id_propietario_vehiculo,t1.descripcion,t1.created_at,t3.nombre,t3.apellidos,t3.direccion,t3.telefono,t3.celular FROM OfertasEmpleo t1 JOIN users t3 ON t1.id_propietario_vehiculo=t3.id WHERE t1.estado='Cerrada'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertas_empleo() {

        $consulta = "SELECT t1.*,t2.nombre_ciudad,t3.nombre_tv,t4.nombre,t4.apellidos,t4.cedula "
                . "FROM OfertasEmpleo t1 "
                . "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
                . "JOIN TipoVehiculos t3 ON t1.idTipoVehiculo=t3.idTipoVehiculo "
                . "JOIN Users t4 ON t1.idUser=t4.idUser "
                . "WHERE t1.estado != '2'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_ofertasxpropietario($idUsuario) {

        $consulta = "SELECT t1.*,t2.nombre_ciudad,t3.nombre_tv "
                . "FROM OfertasEmpleo t1 "
                . "JOIN Ciudades t2 ON t1.idCiudad=t2.idCiudad "
                . "JOIN TipoVehiculos t3 ON t1.idTipoVehiculo=t3.idTipoVehiculo "
                . "WHERE t1.idUser	='$idUsuario'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_aplicaciones() {

        $consulta = "SELECT * FROM AplicacionesEmpleo";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_aplicando_empleo($id) {

        $query = $this->db->get_where('AplicacionesEmpleo', array('idOfertaEmpleo_empleo' => $id));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_conf_vehiculo($idOferta) {
        $consulta = "SELECT t1.idTipoVehiculo,t2.nombre_tv "
                . "FROM OfertasEmpleo t1 "
                . "JOIN TipoVehiculos t2 ON t2.idTipoVehiculo=t1.idTipoVehiculo "
                . "WHERE t1.idOfertaEmpleo = '$idOferta'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_conductores_aplicando($id) {

        $consulta = "SELECT t1.*,t2.idUser as idconductor,t2.nombre,t2.apellidos,t2.idCiudad,"
                . "t2.direccion,t2.telefono,t2.celular,t2.foto_ruta,t2.categoria_lic,"
                . "t2.licencia_conduccion,t2.ranking,t2.vehiculo_asignado,t2.activo,"
                . "t3.nombre_ciudad,t4.* "
                . "FROM AplicacionesEmpleo t1 "
                . "JOIN Users t2 ON t2.idUser=t1.idUser "
                . "JOIN Ciudades t3 ON t3.idCiudad=t2.idCiudad "
                . "JOIN OfertasEmpleo t4 ON t4.idOfertaEmpleo=t1.idOfertaEmpleo "
                . "WHERE t1.idOfertaEmpleo='$id' AND t1.estado='0'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_conductores_contratados($id) {
        $consulta = "SELECT t1.*,t2.idUser as idconductor,t2.nombre as nc,t2.apellidos ac,"
                . "t2.idCiudad,t2.direccion,t2.telefono,t2.celular,t2.foto_ruta,"
                . "t2.categoria_lic,t2.licencia_conduccion,t2.ranking,t2.vehiculo_asignado,"
                . "t2.activo,t3.nombre_ciudad,t4.created_at,t5.nombre as np,"
                . "t5.apellidos as ap "
                . "FROM AplicacionesEmpleo t1 "
                . "JOIN Users t2 ON t1.idUser=t2.idUser "
                . "JOIN Ciudades t3 ON t2.idCiudad=t3.idCiudad "
                . "JOIN OfertasEmpleo t4 ON t4.idOfertaEmpleo=t1.idOfertaEmpleo "
                . "JOIN Users t5 ON t5.idUser=t4.idUser "
                . "WHERE "
                . "t1.idOfertaEmpleo='$id' "
                . "AND t1.estado=1";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_conductores_contratados($id) {
        $consulta = "SELECT t1.*,t2.*,t3.idUser as idconductor,t3.nombre,t3.apellidos,"
                . "t3.idCiudad,t3.direccion,t3.telefono,t3.celular,t3.foto_ruta,"
                . "t3.categoria_lic,t3.licencia_conduccion,t3.ranking,"
                . "t3.vehiculo_asignado,t3.activo,t4.nombre_ciudad "
                . "FROM OfertasEmpleo t1 "
                . "JOIN AplicacionesEmpleo t2 ON t1.idOfertaEmpleo=t2.idOfertaEmpleo "
                . "JOIN Users t3 ON t3.idUser=t2.idUser "
                . "JOIN Ciudades t4 ON t4.idCiudad=t3.idCiudad "
                . "WHERE t1.idUser='$id' "
                . "AND t2.estado=1";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function aplicar_vacante($idVacante, $data, $data2) {
        $this->db->trans_start();
        $this->db->insert('AplicacionesEmpleo', $data);
        $this->db->where('idOfertaEmpleo', $idVacante);
        $this->db->update('OfertasEmpleo', $data2);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function contratar_conductor($idConductor, $placa, $idVacante, $data, $data2, $data3, $data4) {
        $this->db->trans_start();
        $this->db->where('idUser', $idConductor);
        $this->db->update('Users', $data);
        $this->db->where('placa', $placa);
        $this->db->update('Vehiculos', $data2);
        $this->db->where('idOfertaEmpleo', $idVacante);
        $this->db->where('idUser', $idConductor);
        $this->db->update('AplicacionesEmpleo', $data3);
        $this->db->where('idOfertaEmpleo', $idVacante);
        $this->db->update('OfertasEmpleo', $data4);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function finalizar_contrato_conductor($idOferta, $idConductor, $data, $data2, $data3) {
        $this->db->trans_start();
        $q = $this->db->get_where('OfertasEmpleo', array('idOfertaEmpleo' => $idOferta))->row();
        $cont = $q->contratados;
        if ($cont > 0) {
            $cont = $cont - 1;
        }
        $this->db->where('idOfertaEmpleo', $idOferta);
        $this->db->update('OfertasEmpleo', array('contratados' => $cont));
        $this->db->where('idOfertaEmpleo_empleo', $idOferta);
        $this->db->where('id_user', $idConductor);
        $this->db->update('AplicacionesEmpleo', $data);
        $this->db->where('id', $idConductor);
        $this->db->update('users', $data2);
        $this->db->where('conductor_id', $idConductor);
        $this->db->update('sf_vehiculo', $data3);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_contrato_conductor($id) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t3.nombre_ciudad,"
                . "t4.idOfertaEmpleo,t4.created_at,t4.zona,t4.salario,t4.cantidad,"
                . "t5.nombre_tv,t6.vehiculo_asignado "
                . "FROM AplicacionesEmpleo t1 "
                . "JOIN OfertasEmpleo t4 ON t4.idOfertaEmpleo=t1.idOfertaEmpleo "
                . "JOIN Users t2 ON t4.idUser=t2.idUser "
                . "JOIN Ciudades t3 ON t4.idCiudad=t3.idCiudad "
                . "JOIN TipoVehiculos t5 ON t5.idTipoVehiculo=t4.idTipoVehiculo "
                . "JOIN Users t6 ON t6.idUser='$id' "
                . "WHERE t1.idUser='$id' "
                . "AND t1.estado=1";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_postulaciones($idOferta, $idUsuario) {

        $query = $this->db->get_where('AplicacionesEmpleo', array('idOfertaEmpleo' => $idOferta, 'idUser' => $idUsuario));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_ofertas_emp() {

        $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $id_emp = $row->id_empresa;
            }
        }

        $consulta = "SELECT t1.id,t1.origen_id,t1.destino_id,t1.contratados,t1.tipo_vehiculo_id,t1.carroceria_id,t1.cantidad,t1.fecha,t2.nombre_ciudad as origen,t3.nombre_tv,t4.nombre_carr,t5.nombre_ciudad as destino FROM sf_carga t1 JOIN df_ciudades t2 ON t2.id=t1.origen_id JOIN df_ciudades t5 ON t5.id=t1.destino_id JOIN df_camiones_configuracion t3 ON t3.id=t1.tipo_vehiculo_id JOIN df_camiones_carroceria t4 ON t4.id=t1.carroceria_id WHERE empresa_id='$id_emp'";
        $query1 = $this->db->query($consulta);
        if ($query1->num_rows() > 0) {
            return $query1->result();
        } else {
            return false;
        }
    }

    public function guardar_oferta_empresa($idempresa) {

        $this->db->insert("OfertasEmpleo", array(
            'id_empresa' => $idempresa,
            'descripcion' => $this->input->post("descripcion"),
            'created_at' => date('Y-m-d H:i:s')
        ));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function guardar_oferta_propietario($data) {

        $this->db->insert("OfertasEmpleo", $data);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_ofertat_xid($id) {

        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.telefono,t2.celular,t3.nombre_ciudad FROM OfertasEmpleo t1, Users t2, Ciudades t3 WHERE t1.idOfertaEmpleo='$id' AND t1.idUser=t2.idUser AND t2.idCiudad=t3.idCiudad";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function descartar_oferta_xid($id) {
        $this->db->delete('AplicacionesEmpleo', array('id' => $id));
    }

    public function delete_oferta($id) {
        $this->db->delete('OfertasEmpleo', array('idOfertaEmpleo' => $id));
    }

    public function update_oferta($id, $data) {
        $this->db->where('idOfertaEmpleo', $id);
        $this->db->update('OfertasEmpleo', $data);
    }

}
