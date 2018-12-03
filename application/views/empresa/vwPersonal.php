<?php
$this->load->view('empresa/vwHeader');
echo "<h4 style='color:red'>" . $aviso . "</h4>";
?>
<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Personal Empresa <small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'empresa/Dashboard' ?>"><i class="fa fa-home fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Lista de Personal</li>
                <button class="btn btn-primary" type="button" style="float:right;" data-toggle="modal" data-target="#form-personal">Crear Personal</button>
            </ol>
        </div>
    </div><!-- /.row -->

    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Nombre <i class="fa fa-sort"></i></th>
                    <th class="header">Identificación <i class="fa fa-sort"></i></th>
                    <th class="header">Ciudad<i class="fa fa-sort"></i></th>
                    <th class="header">Teléfono<i class="fa fa-sort"></i></th>
                    <th class="header">Email<i class="fa fa-sort"></i></th>
                    <th class="header">Usuario<i class="fa fa-sort"></i></th>
                    <th class="header">Tipo<i class="fa fa-sort"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$personal) {
                    echo "<tr>";
                    echo "<td>" . $mensaje . "</td>";
                    echo "</tr>";
                } else {
                    foreach ($personal as $row) {
                        if ($row->activo == 1) {
                            $boton = '<a href="#"  onclick="bloquear(' . $row->idUser . ')" title="Bloquear usuario"><i class="fa fa-check fa-2x"></i></a>';
                        } else {
                            $boton = '<a href="#"  onclick="desbloquear(' . $row->idUser . ')" title="Desbloquear usuario"><i class="fa fa-ban fa-2x"></i></a>';
                        }
                        if ($row->tipo_doc === '1') {
                            $tipodoc = 'CC';
                        }
                        if ($row->tipo_doc === '2') {
                            $tipodoc = 'Pasaporte';
                        }
                        if ($row->tipo_doc === '3') {
                            $tipodoc = 'Libreta Militar';
                        }
                        if ($row->tipo_doc === '4') {
                            $tipodoc = 'Cédula de extranjeria';
                        }
                        echo "<tr>";
                        echo"<td>" . $row->nombre . " " . $row->apellidos . "</td>";
                        echo"<td>" . $tipodoc . " " . $row->cedula . "</td>";
                        echo"<td>" . $row->nombre_ciudad . "</td>";
                        echo"<td>" . $row->telefono . "</td>";
                        echo"<td>" . $row->email . "</td>";
                        echo"<td>" . $row->usuario . "</td>";
                        if ($row->permisos == 1) {
                            echo"<td>Solo Ofertas</td>";
                        }
                        echo"<td>" . anchor(base_url() . 'empresa/Perfil/get_perxid/' . $row->idUser, '<i class="fa fa-pencil fa-2x"></i>', array('title' => 'Ver/Editar')) . "&nbsp" . $boton . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <!--modal-->
    <div class="modal fade" id="form-personal" tabindex="-1" role="dialog" aria-labelledby="formPersonal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="myModalLabel">Añadir Empleado</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="javascript:addPersonalEmpresa()" id="addPersonalForm" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Nombre Completo(*):</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" name="name"  placeholder="Nombre" required>
                            </div>
                            <div class = "col-xs-4">
                                <input type = "text" class = "form-control" name = "sname" placeholder = "Apellidos" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">Tipo documento(*):</label>
                            <div class="col-xs-4">
                                <select name="tipo_doc" class="form-control" required>
                                    <option value="">Seleccione:</option>
                                    <option value="1">Cédula</option>
                                    <option value="2">Pasaporte</option>
                                    <option value="3">Libreta Militar</option>
                                    <option value="4">Cédula de extranjeria</option>
                                </select>
                            </div>
                            <div class = "col-xs-4">
                                <input type = "text" class = "form-control" id="cedula_subusu" name = "cedula" placeholder = "No de Cédula" required>
                            </div>
                        </div>

                        <div>
                            <ol class="breadcrumb">
                                <li><a href=""><i class="icon-dashboard"></i> Datos De Contacto</a></li>
                                <li class="active"><i class="icon-file-alt"></i> Datos De Contacto</li>
                            </ol>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Departamento(*):</label>
                            <div class = "col-xs-4">
                                <select id="provincia" name="provincia" class="form-control" required>
                                    <option value="">Selecciona:</option>
                                    <?php
                                    foreach ($paises as $fila) {
                                        ?>
                                        <option value="<?php echo $fila->idDepartamento ?>"><?php echo $fila->nombre_dpto ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Ciudad(*):</label>
                            <div class = "col-xs-4">
                                <select id="localidad" name="localidad" class="form-control" required>
                                    <option value="">Selecciona tu departamento</option>
                                </select>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Dirección:</label>
                            <div class = "col-xs-4">
                                <input type = "text" class = "form-control" name = "direccion" placeholder = "Dirección">
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Email(*):</label>
                            <div class = "col-xs-4">
                                <input type = "text" class = "form-control" name = "email" placeholder="Correo electronico" required>
                            </div>
                        </div>
                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Teléfono(*):</label>
                            <div class = "col-xs-4">
                                <input type = "text" class = "form-control" name = "telefono" placeholder="telefono" onKeyPress="return validar(event)" maxlength="10" required>
                            </div>
                        </div>

                        <div>
                            <ol class="breadcrumb">
                                <li><a href=""><i class="icon-dashboard"></i> Crear Usuario</a></li>
                                <li class="active"><i class="icon-file-alt"></i> Datos Usuario</li>
                            </ol>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Tipo de usuario:</label>
                            <div class = "col-xs-4">
                                <input type = "hidden" name = "nivel" value="2"/>
                                <input type = "text" class = "form-control" disabled="" value="Empresa"/>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Usuario(*):</label>
                            <div class = "col-xs-4">
                                <input type = "number" class = "form-control" id="usuario_subusu" name = "username" placeholder="Cedula No" required>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Contraseña(*):</label>
                            <div class = "col-xs-4">
                                <input type = "password" class = "form-control" name = "password" placeholder="Contraseña" required>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Confirmar Contraseña(*):</label>
                            <div class = "col-xs-4">
                                <input type = "password" class = "form-control" name = "passconf" placeholder="Repita contraseña" required>
                            </div>
                        </div>

                        <div class = "form-group">
                            <label class = "col-xs-3 control-label">Permisos(*):</label>
                            <div class = "col-xs-4">
                                <input type = "hidden" name = "permisos" value="1"/>
                                <input type = "text" class = "form-control" disabled="" value="Solo Ofertas">
                            </div>
                        </div>

                        <div class = "form-group">
                            <div class = "col-xs-9 col-xs-offset-3">
                                <button type = "submit" class = "btn btn-primary" name = "reg_user" value = "Sign up">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--fin modal-->


</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
