<?php
$this->load->view('conductor/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Ver / Completar <small>Perfil</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'conductor/Perfil/completar_conductor' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Personales</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
    <form id="frmPerfil" action="javascript:updatePerfil()" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Nombre Completo(*):</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" value="<?= $nombre ?>" disabled="">   
            </div>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?= $apellidos ?>" disabled="">
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
            <div class = "col-xs-3">
                <select name="tipo_doc" class="form-control">
                    <?= $optiondoc ?>
                </select>
            </div>
            <label class = "col-xs-1 control-label">No(*):</label>
            <div class = "col-xs-3">
                <?= $cedula ?>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de nacimiento(*):</label>
            <div class="col-xs-2"><?= $fecha_nac ?></div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Sexo(*):</label>
            <div class = "col-xs-4">
                <?= $radio ?>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Estado Civil(*):</label>
            <div class = "col-xs-4">
                <select class="form-control" name="est_civil" id="combito" required>
                    <?= $optionestac ?>
                </select>
            </div>
        </div>

        <div id="div_Casado" class="subida">
            <div class="form-group">
                <label class="col-xs-3 control-label">Nombre Conyuge(*):</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control" name="nombre_conyuge"  value="<?= $conyuge ?>" placeholder="Nombres"/>
                </div>
                <div class = "col-xs-4">
                    <input type = "text" class = "form-control" name = "apellido_conyuge" value="<?= $apeconyuge ?>" placeholder="Apellidos"/>
                </div>
            </div>

            <div class = "form-group">
                <label class = "col-xs-3 control-label disabled">Tipo de documento(*):</label>
                <div class = "col-xs-3">
                    <select name="tipo_docc" class="form-control">
                        <?= $optiondocc ?>
                    </select>
                </div>
                <label class = "col-xs-1 control-label">No(*):</label>
                <div class = "col-xs-3">
                    <input type="number" class = "form-control" name = "ccc" value = "<?= $cedulac ?>"/>
                </div>
            </div>

            <div class = "form-group">
                <label class = "col-xs-3 control-label">Telefono Conyuge(*):</label>
                <div class = "col-xs-4">
                    <input type = "number" class = "form-control" name = "tel_conyuge" value="<?= $tel_conyuge ?>" placeholder="Teléfono" onKeyPress="return validar(event)" maxlength="10"/>
                </div>
            </div>
        </div>

        <div>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i></li>
                <li class="active"><i class="icon-file-alt"></i> Información Residencial</li>
                <div style="clear: both;"></div>
            </ol>
        </div>
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Departamento(*):</label>
            <div class = "col-xs-4">
                <select name="provincia" id="provincia" class="form-control" required>
                    <?= $optdpto ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad(*):</label>
            <div class = "col-xs-4">
                <select name="localidad" id="localidad" class="form-control" required>
                    <?= $optciudad ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Dirección(*):</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "address" value="<?= $direccion ?>" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tipo de vivienda(*):</label>
            <div class = "col-xs-4">
                <select class="form-control" name="tipo_vivienda" required>
                    <?= $optvivienda ?>
                </select>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tiempo en meses(*):</label>
            <div class = "col-xs-4">
                <input type = "number" class = "form-control" name = "meses_vivienda" value="<?= $mesvivienda ?>" onKeyPress="return validar(event)" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Teléfono:</label>
            <div class = "col-xs-4">
                <input type = "number" class = "form-control" name = "phone" value="<?= $telefono ?>" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Celular(*):</label>
            <div class = "col-xs-4">
                <input type = "number" class = "form-control" name = "celphone" value="<?= $celular ?>" onKeyPress="return validar(event)" maxlength="10" required>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email(*)</label>
            <div class = "col-xs-4">
                <input type = "mail" class = "form-control" name = "email" value="<?= $email ?>" required>
            </div>
        </div>
        <?php if ($tipo != 3) { ?> 
            <div>
                <ol class="breadcrumb">
                    <li><i class="fa fa-photo"></i></li>
                    <li class="active"><i class="icon-file-alt"></i> Licencia de conducción</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>

            <div class = "form-group">
                <label class = "col-xs-3 control-label">Nº licencia de conducción(*)</label>
                <div class = "col-xs-4">
                    <input type = "number" class = "form-control" name = "licencia_conduccion" value="<?= $licencia_conduccion ?>" required>
                </div>
            </div>

            <div class = "form-group">
                <label class = "col-xs-3 control-label">Categoria(*):</label>
                <div class = "col-xs-4">
                    <select class="form-control" name="categoria_lic" required>
                        <?= $optcatlic ?>
                    </select>
                </div>

            </div>

            <div class = "form-group">
                <label class = "col-xs-3 control-label">Vence(*)</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control" name="fechavenlic" id="fechavenlic" value="<?= $fecha_ven_licencia ?>" placeholder="AAAAMMDD" required>
                </div>
            </div>
        <?php } ?>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <input type = "submit" class = "btn btn-primary" name = "update_user" value = "Actualizar" />
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('conductor/vwFooter');
?>
