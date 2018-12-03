<?php
$this->load->view('empresa/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Añadir <small> Conductor</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Perfil/get_conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <form method="post" action="<?php echo base_url() . 'empresa/Perfil/guardar_conductor' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <input type="hidden" name="user_id" value="<?php
            $query = $this->db->get_where('users', array('usuario' => $_SESSION['usuario']));
            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row) {
                    echo $row->id;
                }
            }
            ?> "/>
            <label class="col-xs-3 control-label">Nombre</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="" ></input>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Apellidos</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value=""></input>
            </div>
        </div>

        <!--<div class = "form-group">
            <label class = "col-xs-3 control-label">País Matriula</label>
            <div class = "col-xs-4">
                <select name="pais" id="pais" class="form-control">
                    <option value="">País</option>
                    <?php
                    foreach ($paises as $fila) {
                        ?>
                        <option value="<?php echo $fila->id ?>"><?php echo $fila->nombre_pais ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Departamento Matricula</label>
            <div class = "col-xs-4">
                <select name="provincia" id="provincia" class="form-control">
                    <option value="">Selecciona tu pais</option>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad Matricula</label>
            <div class = "col-xs-4">
                <select name="localidad" id="localidad" class="form-control">
                    <option value="">Selecciona tu departamento</option>
                </select>
            </div>
        </div>

        -->

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" placeholder = "Correo Electronico" />
            </div>
        </div>

        <!--<div class = "form-group">
            <label class = "col-xs-3 control-label">Marca Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "trailermarca" placeholder = "Trailer Marca" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "satelite" placeholder = "Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Usuario Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteusuario" placeholder = "Usuario Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Clave Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteclave" placeholder = "Clave Satelite" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Repotenciación</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "repotenciación" placeholder = "Repotenciación" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Modelo</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "modelo" placeholder = "Modelo" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca</label>
            <div class = "col-xs-4">
                <select class = "form-control" name = "marca">
                    <option value="">Selecciona</option>
                    <?php
                    /*foreach ($marca as $val) {
                        ?>
                        <option value="<?php echo $val->nombre ?>"><?php echo $val->nombre ?></option>
                        <?php
                    }*/
                    ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Capacidad de carga</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "capacidad_carga" placeholder = "Capacidad de carga" />
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento SOAT</label>
            <div class = "col-xs-4">
                <input type = "text" readonly name = "vence_soat">
                <input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_soat, 'yyyy/mm/dd', this)">
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento TM</label>
            <div class = "col-xs-4">
                <input type = "text" readonly name = "vence_rtecnomecanica">
                <input type = "button" value = "Calendario" onclick = "displayCalendar(document.forms[0].vence_rtecnomecanica, 'yyyy/mm/dd', this)">
            </div>
        </div>-->

        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Agregar</button>
            </div>
        </div>
    </form>

    <div><?php $mensaje ?></div>
</div><!--/#page-wrapper -->


<?php
$this->load->view('empresa/vwFooter');
?>
