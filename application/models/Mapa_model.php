<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mapa_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_markers_all()
    {
        $consulta = "SELECT t1.*,t2.Latitud,t2.Longitud FROM sf_carga_vehiculos t1 JOIN sf_vehiculo t2 ON t2.idv=t1.vehiculo_id WHERE t1.aplicando = '1' ";
        $markers = $this->db->query($consulta);
        if($markers->num_rows()>0)
        {
            return $markers->result();
        } else {
            return false;
        }
    }
    
    public function get_markers($id)
    {
        $consulta = "SELECT * FROM sf_carga WHERE id = '$id'";
        $query = $this->db->query($consulta);
        if($query->num_rows()>0){
            foreach ($query->result() as $key) {
                $origen = $key->origen_id;
            }
        }
        $consulta1 = "SELECT t1.*,t2.nombre_ciudad,t2.Latitud,t2.Longitud,t3.placa,t4.nombre,t4.apellidos,t4.celular,t4.foto_ruta,t4.ranking FROM sf_carga_vehiculos t1 JOIN df_ciudades t2 ON t2.id='$origen' JOIN sf_vehiculo t3 ON t3.idv=t1.vehiculo_id JOIN users t4 ON t4.vehiculo_asignado=t3.placa WHERE t1.carga_id='$id' AND t1.aplicando = '1' ";
        $markers = $this->db->query($consulta1);
        if($markers->num_rows()>0)
        {
            return $markers->result();
        } else {
            return false;
        }
    }

    public function get_markers_misvehiculos_aplicando($idempresa)
    {
        $sql = "SELECT t1.*,t2.idv,t2.placa,t2.Latitud,t2.Longitud FROM sf_carga_vehiculos t1 JOIN sf_vehiculo t2 ON t2.idv=t1.vehiculo_id WHERE empresa_id = '$idempresa' AND aplicando=1";
        $markers = $this->db->query($sql);
        if($markers->num_rows()>0)
        {
            return $markers->result();
        } else {
            return false;
        }
    }
  
    public function get_markers_misvehiculos_contratados($idempresa)
    {
        $sql = "SELECT t1.*,t2.idv,t2.placa,t2.Latitud,t2.Longitud FROM sf_carga_vehiculos t1 JOIN sf_vehiculo t2 ON t2.idv=t1.vehiculo_id WHERE empresa_id = '$idempresa' AND contratado=1";
        $markers = $this->db->query($sql);
        if($markers->num_rows()>0)
        {
            return $markers->result();
        } else {
            return false;
        }
    }

    public function get_marker_carga($id)
    {
        $consulta = "SELECT t1.*,t2.Latitud,t2.Longitud FROM sf_carga t1 JOIN df_ciudades t2 ON t1.destino_id=t2.id WHERE t1.id='$id'";
        $marker = $this->db->query($consulta);
        if($marker->num_rows()>0)
        {
            return $marker->result();
        } else {
            return false;
        }
    }

    public function get_markers_contratados($id)
    {
        $consulta = "SELECT * FROM sf_carga WHERE id = '$id'";
        $query = $this->db->query($consulta);
        if($query->num_rows()>0){
            foreach ($query->result() as $key) {
                $origen = $key->origen_id;
            }
        }
        $consulta1 = "SELECT t1.*,t2.nombre_ciudad,t2.Latitud,t2.Longitud,t3.placa,t4.nombre,t4.apellidos,t4.celular,t4.foto_ruta,t4.ranking FROM sf_carga_vehiculos t1 JOIN df_ciudades t2 ON $origen=t2.id JOIN sf_vehiculo t3 ON t3.idv=t1.vehiculo_id JOIN users t4 ON t4.vehiculo_asignado=t3.placa WHERE t1.carga_id='$id' AND t1.contratado = '1' AND t1.ocupado = '1' ";
        $marker = $this->db->query($consulta1);
        if($marker->num_rows()>0)
        {
            return $marker->result();
        } else {
            return false;
        }
    }

    public function get_markers_enturnados()
    {
        $consulta = "SELECT t1.*,t2.Latitud,t2.Longitud FROM sf_vehiculo t1 JOIN df_ciudades t2 ON t1.origen_id=t2.id WHERE t1.enturne = 'Disponible' ";
        $marker = $this->db->query($consulta);
        if($marker->num_rows()>0)
        {
            return $marker->result();
        } else {
            return false;
        }
    }

    public function get_markers_contratados_empresa($idEmpresa,$idUsuario) {
        $consulta = "SELECT t1.*,t2.* FROM sf_carga_vehiculos t1 JOIN sf_vehiculo t2 ON t1.vehiculo_id=t2.idv WHERE t1.empresa_id = '$idEmpresa' and t1.usuario_id = '$idUsuario' and t1.contratado = '2' and t1.aplicando = '0' and t1.ocupado = '1'";
        $query = $this->db->query($consulta);
        if($query->num_rows()>0)
        {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_markers_aplicando_empresa($idEmpresa,$idUsuario) {
        $consulta = "SELECT t1.*,t2.* FROM sf_carga_vehiculos t1 JOIN sf_vehiculo"
                . " t2 ON t1.vehiculo_id=t2.idv WHERE t1.empresa_id = '$idEmpresa'"
                . " and t1.usuario_id = '$idUsuario' and t1.aplicando = '1'"
                . " and t1.contratado = '0' and t1.ocupado = '0'";
        $query = $this->db->query($consulta);
        if($query->num_rows()>0)
        {
            return $query->result();
        } else {
            return false;
        }
    }

    public function enviarPosicion($idVehiculo,$Latitud,$Longitud) {
        $data = array(
            'Latitud' => $Latitud,
            'Longitud' => $Longitud,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idv', $idVehiculo);
        $this->db->update('sf_vehiculo', $data);
    }
}
