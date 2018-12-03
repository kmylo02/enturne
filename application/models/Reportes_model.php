<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes_model extends CI_Model {

    public function enCargue($idEmpresa, $idUsuario, $conductor, $idCarga, $ubicacion) {
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => 'En el sitio de cargue',
            'ubicacion' => $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
        $fecha = date('Y-m-d H:i:s');

        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }
        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }

        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => 'En el sitio de cargue'
            );

            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function enDescargue($idEmpresa, $idUsuario, $conductor, $idCarga, $ubicacion) {
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => 'En el sitio de descargue',
            'ubicacion' => $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
        $fecha = date('Y-m-d H:i:s');

        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }


        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }

        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad  JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {

            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => 'En el sitio de descargue'
            );
            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function enRuta($idEmpresa, $idUsuario, $conductor, $idCarga, $ubicacion) {
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => 'En ruta',
            'ubicacion' => $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
        $fecha = date('Y-m-d H:i:s');

        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }


        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }

        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad  JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {

            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => 'En ruta'
            );
            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Mensaje');
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function cargado($idEmpresa, $idUsuario, $conductor, $idCarga, $ubicacion) {
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => 'Cargado',
            'ubicacion' => $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
        $fecha = date('Y-m-d H:i:s');

        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }


        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }

        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad  JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {

            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => 'Cargado'
            );
            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function descargado($idEmpresa, $idUsuario, $conductor, $idCarga, $ubicacion) {
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => 'Descargado',
            'ubicacion' => $ubicacion,
            'created_at' => date('Y-m-d H:i:s')
        ));
        $fecha = date('Y-m-d H:i:s');

        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }


        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }
        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad  JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {

            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => 'Descargado'
            );
            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function mensaje($idEmpresa, $idUsuario, $conductor, $mens, $idCarga, $ubicacion) {
        $fecha = date('Y-m-d H:i:s');
        $this->db->trans_start();
        $this->db->insert('Reportes', array(
            //'id_empresa' => $idEmpresa,
            'id_usuario' => $idUsuario,
            'id_carga' => $idCarga,
            'conductor' => $conductor,
            'mensaje' => $mens,
            'ubicacion' => $ubicacion,
            'created_at' => $fecha
        ));
        $q = $this->db->get_where('Users', array('usuario' => $conductor));
        if ($q->num_rows() != 0) {
            foreach ($q->result() as $row) {
                $nombre = $row->nombre . ' ' . $row->apellidos;
                $celular = $row->celular;
                $emailConductor = $row->email;
                $propietario = $row->Assign_idUser;
            }
        }
        $q1 = $this->db->get_where('Users', array('idUser' => $propietario));
        if ($q1->num_rows() != 0) {
            foreach ($q1->result() as $row) {
                //$emailEmpresa = $row->email;
            }
        }
        $query1 = $this->db->get_where('Users', array('idUser' => $idUsuario));
        if ($query1->num_rows() != 0) {
            foreach ($query1->result() as $row) {
                $mailSubusuario = $row->email;
                $idEmpresa = $row->idEmpresa;
            }
        }


        $query = $this->db->get_where('Empresas', array('idEmpresa' => $idEmpresa));
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $emailEmpresa = $row->email;
            }
        }
        $query_carga = "SELECT t1.*,t2.nombre_ciudad as origen,t3.nombre_ciudad as destino FROM OfertasCarga t1 JOIN
  Ciudades t2 ON t1.origen_id=t2.idCiudad  JOIN Ciudades t3 ON t1.destino_id=t3.idCiudad WHERE t1.idOfertaCarga = '$idCarga'";
        $cons = $this->db->query($query_carga);
        if ($cons->num_rows() > 0) {
            foreach ($cons->result() as $row) {
                $trayecto = $row->origen . '-' . $row->destino;
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {

            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['mail_host'] = 'mail.enturne.co';
            $config['mail_port'] = '465';
            $config['mail_user'] = 'soporte@enturne.co';
            $config['mail_pass'] = 'ENTURNE260413';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('soporte@enturne.co', 'Enturne En Linea');
            $data = array(
                'conductor' => $conductor,
                'nombre' => $nombre,
                'celular' => $celular,
                'trayecto' => $trayecto,
                'fecha' => $fecha,
                'ubicacion' => $ubicacion,
                'reporte' => $mens
            );
            $this->email->to($mailSubusuario);
            $this->email->cc($emailEmpresa);
            $this->email->bcc($emailConductor);
            $this->email->subject('Reportándome desde la App Enturne');
            $body = $this->load->view('emails.php', $data, TRUE);
            $this->email->message($body);
            $this->email->send();
        } else {
            return false;
        }
    }

    public function get_reportes($idUsuario) {
        $consulta = "SELECT t1.*, t2.idUser as idConductor,t2.nombre, t2.apellidos, t2.celular,"
                . " t2.vehiculo_asignado, t2.foto_ruta, t3.idOfertaCarga, t3.ocupado,"
                . "t4.origen_id,t4.destino_id, t5.nombre_ciudad as origen,"
                . "t6.nombre_ciudad as destino "
                . "FROM Reportes t1 "
                . "JOIN Users t2 ON t1.conductor=t2.usuario "
                . "JOIN OfertasCargaVehiculos t3 ON t1.id_carga=t3.idOfertaCarga "
                . "JOIN OfertasCarga t4 ON t1.id_carga=t4.idOfertaCarga "
                . "JOIN Ciudades t5 ON t4.origen_id=t5.idCiudad "
                . "JOIN Ciudades t6 ON t4.destino_id=t6.idCiudad "
                . "WHERE t1.id_usuario='$idUsuario' "
                . "AND t1.visto=0 "
                . "AND t3.ocupado='1' "
                . "GROUP BY t2.vehiculo_asignado "
                . "ORDER BY t4.origen_id";
        $query = $this->db->query($consulta);

//		echo $this->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_reportes_x_idUsuario($idUsuario) {
        $consulta = "SELECT t1.*, t2.idUser as idConductor,t2.nombre, t2.apellidos, t2.celular,"
                . " t2.vehiculo_asignado, t2.foto_ruta, t3.idOfertaCarga, t3.ocupado,"
                . "t4.origen_id,t4.destino_id, t5.nombre_ciudad as origen,"
                . "t6.nombre_ciudad as destino "
                . "FROM Reportes t1 "
                . "JOIN Users t2 ON t1.conductor=t2.usuario "
                . "JOIN OfertasCargaVehiculos t3 ON t1.id_carga=t3.idOfertaCarga "
                . "JOIN OfertasCarga t4 ON t1.id_carga=t4.idOfertaCarga "
                . "JOIN Ciudades t5 ON t4.origen_id=t5.idCiudad "
                . "JOIN Ciudades t6 ON t4.destino_id=t6.idCiudad "
                . " WHERE t1.id_usuario='$idUsuario' "
                . "AND t1.visto=0 "
                . "AND t3.ocupado='1' "
                . "GROUP BY t2.vehiculo_asignado "
                . "ORDER BY t4.origen_id";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_contrepo_x_empresa($idUsuario) {
        $consulta = "SELECT * FROM Reportes WHERE id_usuario=$idUsuario AND visto = 0";
        $query = $this->db->query($consulta);
        return $query->num_rows();
    }

    public function get_contrepo_x_idusuario($id) {
        $consulta = "SELECT * FROM Reportes WHERE id_usuario='$id' AND visto = 0";
        $query = $this->db->query($consulta);
        return $query->num_rows();
    }

    public function get_reportes_app($idUsuario) {
        $consulta = "SELECT t1.*, t2.idUser as idConductor,t2.nombre, t2.apellidos,"
                . "t2.celular, t2.vehiculo_asignado, t2.foto_ruta,t3.ocupado,"
                . "t4.origen_id,t4.destino_id,t5.nombre_ciudad as origen,"
                . "t6.nombre_ciudad as destino FROM Reportes t1 JOIN Users t2"
                . " ON t1.conductor=t2.usuario JOIN OfertasCargaVehiculos t3 ON"
                . " t1.id_carga=t3.idOfertaCarga JOIN OfertasCarga t4 ON"
                . " t1.id_carga=t4.idOfertaCarga JOIN Ciudades t5 ON t4.origen_id=t5.idCiudad"
                . " JOIN Ciudades t6 ON t4.destino_id=t6.idCiudad WHERE"
                . " t1.id_usuario='$idUsuario' AND t3.ocupado='1'"
                . " GROUP BY t2.vehiculo_asignado ORDER BY t4.origen_id";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_detalle_reporte($conductor, $idCarga) {
        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen, t3.origen_id,"
                . " t3.destino_id, t4.nombre_ciudad as destino,t5.idUser as idConductor,"
                . " t5.vehiculo_asignado,"
                . " t5.nombre, t5.apellidos, t5.celular FROM Reportes t1 JOIN"
                . " OfertasCarga t3 ON t3.idOfertaCarga=$idCarga JOIN Ciudades t2 ON"
                . " t2.idCiudad=t3.origen_id JOIN Ciudades t4 ON t4.idCiudad=t3.destino_id"
                . " JOIN Users t5 ON t5.usuario=$conductor WHERE"
                . " t1.id_carga=$idCarga AND t1.conductor=$conductor"
                . " AND t1.visto!='1' ORDER BY t1.created_at DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_cont_detalle_reporte($conductor, $idCarga) {
        $consulta = "SELECT t1.*,t2.nombre_ciudad as origen, t3.origen_id, t3.destino_id, t4.nombre_ciudad as destino, t5.vehiculo_asignado FROM Reportes t1 JOIN OfertasCarga t3 ON t3.id='$idCarga' JOIN Ciudades t2 ON t2.id=t3.origen_id JOIN Ciudades t4 ON t4.id=t3.destino_id JOIN Users t5 ON t5.usuario='$conductor' WHERE t1.id_carga='$idCarga' AND t1.conductor='$conductor' AND t1.visto!='1'";
        $query = $this->db->query($consulta);
        /* if ($query->num_rows() > 0) { */
        return $query->num_rows();
        /* } */
    }

    public function getRepoEnviados($conductor, $idCarga) {
        $consulta = "SELECT * FROM Reportes WHERE conductor='$conductor' AND id_carga='$idCarga' AND visto='0' ORDER BY created_at DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function repoEnviados($conductor) {
        $consulta = "SELECT t1.*,t2.nombre_empresa,t3.origen_id,t3.destino_id,"
                . "t4.nombre_ciudad as origen,t5.nombre_ciudad as destino "
                . "FROM Reportes t1 "
                . "JOIN Empresas t2 ON t2.idEmpresa=t1.id_empresa "
                . "JOIN OfertasCarga t3 ON t3.idOfertaCarga=t1.id_carga "
                . "JOIN Ciudades t4 ON t4.idCiudad=t3.origen_id "
                . "JOIN Ciudades t5 ON t5.idCiudad=t3.destino_id "
                . "WHERE t1.conductor='$conductor' AND t1.visto='0' "
                . "ORDER BY created_at DESC";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getDetalleRepo($idCarga) {
        $consulta = "SELECT t1.*,t0.idEmpresa,"
                . "t2.nombre_empresa,t3.nombre_ciudad as"
                . " origen,t4.nombre_ciudad as destino FROM"
                . " OfertasCarga t1 JOIN Users t0 ON t0.idUser"
                . " = t1.idUser JOIN Empresas t2 ON"
                . " t2.idEmpresa=t0.idEmpresa JOIN Ciudades t3 ON"
                . " t3.idCiudad=t1.origen_id JOIN Ciudades t4 ON"
                . " t4.idCiudad=t1.destino_id WHERE t1.idOfertaCarga='$idCarga'";
        $query = $this->db->query($consulta);
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function reporte_visto($id) {
        $data = array(
            'visto' => '1',
        );
        $this->db->where('idReporte', $id);
        $this->db->update('Reportes', $data);
    }

    public function mensajes_conductores($usuario) {
        $query = $this->db->get_where('Alertas', array('conductor' != $usuario));
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function mensajes_enviados($usuario) {
        $query = $this->db->get_where('Alertas', array('conductor' => $usuario));
        if ($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function enviar_mensaje_web($data) {
        $this->db->insert('Alertas', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
