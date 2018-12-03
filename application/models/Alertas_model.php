<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alertas_model extends CI_Model {

    public function alerta($nombre,$comentario,$ubicacion) {
        $this->db->insert('Alertas', array(
            'conductor' => $nombre,
            'comentario'=> $comentario,
            'ubicacion'=> $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
    }

    public function sos($nombre,$ubicacion,$idEmpresa,$idUsuario,$propietario) {
        $fecha_actual=date('Y-m-d H:i:s');
        $que=$this->db->get_where('Empresas', array('idEmpresa'=>$idEmpresa));
        if ($que->num_rows() != 0) {
            foreach ($que->result() as $row) {
                $mailEmpresa  = $row->email;
            }
        }
        $query=$this->db->get_where('Users', array('usuario'=>$nombre));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $vehiculo = $row->vehiculo_asignado;
                $conductor = $row->nombre .' '. $row->apellidos;
                $celular = $row->celular;
            }
        }
        $query1=$this->db->get_where('Users', array('idUser'=>$idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
            }
        }
        $q=$this->db->get_where('Vehiculos', array('placa'=>$vehiculo));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $idPropietario = $row->user_id;
                $placa = $row->placa;
            }
        }
        $qu=$this->db->get_where('Users', array('idUser'=>$idPropietario));
        if ($qu->num_rows() != 0) {
            foreach ($qu->result() as $row) {
                $mailPropietario = $row->email;
            }
        }
        $this->db->insert('Alertas', array(
            'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'propietario' => $propietario,
            'conductor' => $nombre,
            'comentario'=> 'SOS',
            'ubicacion'=> $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));

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
            'nombre'=> $nombre,
            'conductor'=> $conductor,
            'placa'=> $placa,
            'celular'=> $celular,
            'fecha_actual'=> $fecha_actual,
            'ubicacion'=> $ubicacion,
            'mensaje'=> 'Fue activado el botón de pánico desde su celular.<br>Favor tomar las medidas necesarias acordadas con el conductor, para que le puedan brindar atención inmediata. Recuerde que la vida, el camión y la mercancía pueden estar en peligro.
<br><br>Nota: Enturne En Línea, es una aplicación informativa para este Servicio de SOS, es responsabilidad de la 1 de Transporte que lo contrate, el Propietario ó Administrador del vehículo, de tomar las medidas pertinentes  (Protocolos de Seguridad, acordados con el conductor) a este evento notificado por los usuarios a través de nuestra Plataforma.
<br><br>'
        );
        $this->email->to($mailPropietario);
        $this->email->cc('administrativo@enturne.co');
        $this->email->bcc($mailEmpresa);
        $this->email->subject('SOS desde la App Enturne');
        $body = $this->load->view('emails_alertas.php',$data,TRUE);
        $this->email->message($body);
        $this->email->send();

    }
    
    public function get_contsos() {
        $consulta = "SELECT * FROM Alertas WHERE visto='0' AND comentario='SOS' ORDER BY idAlerta DESC";
        $query = $this->db->query($consulta);
        /*if ($query->num_rows() > 0) {*/
            return $query->num_rows();
        /*}*/
    }
  
    public function get_contsos_x_empresa($idEmpresa) {
        $consulta = "SELECT * FROM Alertas WHERE id_empresa='$idEmpresa' AND visto='0' AND comentario='SOS'";
        $query = $this->db->query($consulta);
        return $query->num_rows();
    }
    public function get_contsos_x_idusuario($id) {
        $consulta = "SELECT * FROM Alertas WHERE id_usuario = '$id' AND visto='0' AND comentario='SOS'";
        $query = $this->db->query($consulta);
        return $query->num_rows();
    }
    public function get_contsos_x_propietario($usuario) {
        $consulta = "SELECT * FROM Alertas WHERE propietario = '$usuario' AND visto='0' AND comentario='SOS'";
        $query = $this->db->query($consulta);
        return $query->num_rows();
    }
    public function get_alertas($usuario) {
        $consulta = "SELECT t1.id,t1.conductor,t1.created_at,t1.comentario,"
                . "t1.ubicacion,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado FROM Alertas t1 JOIN Users t2 ON"
                . " t2.usuario=t1.conductor WHERE t1.conductor!='$usuario' AND"
                . " t1.comentario!='SOS' AND DATEDIFF( CURDATE( ) , t1.created_at )"
                . " <= 1 ORDER BY t1.id DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_sos($usuario) {
        $consulta = "SELECT t1.idAlerta,t1.conductor,t1.created_at,t1.comentario,"
                . "t1.ubicacion,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado FROM Alertas t1 JOIN Users t2 ON"
                . " t2.usuario=t1.conductor WHERE t1.conductor!='$usuario' AND"
                . " t1.comentario='SOS' ORDER BY t1.idAlerta DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_soss() {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado FROM Alertas t1 JOIN Users t2"
                . " ON t2.usuario=t1.conductor WHERE t1.comentario='SOS' AND"
                . " t1.visto='0' ORDER BY t1.idAlerta DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    public function get_sos_x_idempresa($idEmpresa,$idUsuario) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado,t3.nombre as nsub,t3.apellidos as asub"
                . " FROM Alertas t1 JOIN Users t2 ON t2.usuario=t1.conductor JOIN"
                . " Users t3 ON t3.id=t1.id_usuario WHERE"
                . " t1.id_empresa='$idEmpresa' AND t1.comentario='SOS'"
                . " AND t1.visto=0 AND t1.app=0";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_sos_x_idusuario($idUsuario) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado,t3.nombre as nsub,t3.apellidos as asub"
                . " FROM Alertas t1 JOIN Users t2 ON t2.usuario=t1.conductor"
                . " JOIN Users t3 ON t3.idUser='$idUsuario' WHERE"
                . " t1.id_usuario='$idUsuario' AND t1.comentario='SOS' AND"
                . " t1.visto=0 AND t1.app=0";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    public function get_sos_x_propietario($usuario) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado FROM Alertas t1 JOIN Users t2"
                . " ON t2.usuario=t1.conductor WHERE t1.propietario='$usuario'"
                . " AND t1.comentario='SOS' AND t1.visto=0";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
  
    public function get_sos_x_idempresa_web($idEmpresa) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado,t3.nombre as nsub,t3.apellidos as asub"
                . " FROM Alertas t1 JOIN Users t2 ON t2.usuario=t1.conductor"
                . " JOIN Users t3 ON t3.idUser=t1.id_usuario WHERE"
                . " t1.id_empresa='$idEmpresa' AND t1.comentario='SOS' AND"
                . " t1.visto=0";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_sos_x_idusuario_web($idUsuario) {
        $consulta = "SELECT t1.*,t2.nombre,t2.apellidos,t2.celular,"
                . "t2.vehiculo_asignado,t3.nombre as nsub,t3.apellidos as asub"
                . " FROM Alertas t1 JOIN Users t2 ON t2.usuario=t1.conductor"
                . " JOIN Users t3 ON t3.idUser='$idUsuario' WHERE"
                . " t1.id_usuario='$idUsuario' AND t1.comentario='SOS' AND"
                . " t1.visto=0";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function cerrar_sos($id) {
        $data = array(
            'app' => 1
        );
        $this->db->where('idAlerta',$id);
        $this->db->update('Alertas',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }
  
    public function cerrar_sos_admin($id) {
        $data = array(
            'visto' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('idAlerta',$id);
        $this->db->update('Alertas',$data);
        if($this->db->affected_rows()>0){
            return true;
        } else {
            return false;
        }
    }

    public function get_alerta($id) {
        $consulta = "SELECT * FROM Alertas WHERE idAlerta='$id' ORDER BY id DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_alertas_enviadas($user) {
        $consulta = "SELECT * FROM Alertas WHERE conductor='$user' AND"
                . " comentario != 'SOS' AND DATEDIFF( CURDATE( ) , created_at ) <= 1"
                . " ORDER BY idAlerta DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
