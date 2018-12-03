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
            <h1>Datos <small> Vehiculo</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'conductor/Perfil/get_vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="icon-file-alt"></i> Datos Vehiculo</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



    <form method="post" action="<?= base_url() . 'conductor/Perfil/update_vehiculo' ?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-3 control-label">Placa</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="placa" placeholder="Placa" value="<?= $placa; ?>" disabled=""/>
            </div>
        </div>

        <input type="hidden" name="id" value="<?= $idv?>"/>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Ciudad Matricula</label>
            <div class = "col-xs-4">
                <input type="text" class="form-control" value="<?= $nombre_ciudad?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Tipo de Vehiculo</label>
            <div class = "col-xs-4">
                <input type="text" class="form-control" value="<?= $nombre_tv?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Carroceria</label>
            <div class = "col-xs-4">
                <input type="text" class="form-control" value="<?= $nombre_carr?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?= $trailer?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?= $trailermarca?>" disabled=""/>
            </div>
        </div>
      
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Modelo Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?= $modelo_trailer?>" disabled=""/>
            </div>
        </div>
      
        <div class = "form-group">
            <label class = "col-xs-3 control-label">Peso Vacio Trailer</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?= $peso_vacio_trailer?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "satelite" value="<?= $satelite?> " disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Usuario Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteusuario" value="<?= $sateliteusuario?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Clave Satelite</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "sateliteclave" value="<?= $sateliteclave?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Repotenciación</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "repotenciacion" value="<?= $repotenciacion?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Modelo</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "modelo" value="<?= $modelo?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Marca</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "marca" value="<?= $marca?>" disabled=""/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Capacidad de carga</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "capacidad_carga" value="<?= $capacidad_carga?>" onKeyPress="return validar(event)" maxlength="10"/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento SOAT</label>
            <div class = "col-xs-4">
                <input type = "text" class="form-control" readonly name = "vence_soat" value="<?= $vence_soat; ?>" disabled/>
          </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Fecha de vencimiento TM</label>
            <div class = "col-xs-4">
                <input type = "text" class="form-control" readonly name = "vence_rtecnomecanica" value="<?= $vence_rtecnomecanica; ?>" disabled/>
            </div>
        </div>
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary">Actualizar</button>
            </div>
        </div>

    </form>

    <div class="row">
        <div class="col-lg-12">
            <h1>Documentación </h1><h4>* (Las imagenes deben tener máximo 1mb de tamaño y los nombres de los archivos a enviar no deben tener tíldes).</h4>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

    <div>
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> SOAT</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmSoat" action="javascript:subirSoatTemp();">
            <div align="center"><img id="foto_soat" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $soat?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>">
                <label>Seleccione examinar si desea cambiar su doc SOAT y click en actualizar</label>
                <input type="file"  name="userfile" class="soattemp" accept="image/*" size="1024"> 
                <input type="submit" value="Enviar">
            </div>
        </form>
        <?php if(isset($soattemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $soattemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Revisión Tecnomecanica</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmRtm" action="javascript:subirRtmTemp();">
            <div align="center"><img id="foto_rtm" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $rtecnomecanica
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar su documento de RTM y click en actualizar</label>
                <input type="file"  name="userfile" class="rtmtemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($rtecnotemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $rtecnotemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv1?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Licencia de transito</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmLict" action="javascript:subirLictTemp();">
            <div align="center"><img id="foto_lict" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $licenciatransito
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar su documento licencia de transito y click en actualizar</label>
                <input type="file"  name="userfile" class="licttemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($lictemp)){?>
        <div align="left"><img id="foto_lict" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $lictemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv2?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Cedula del Propietario</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmCedp" action="javascript:subirCedpTemp();">
            <div align="center"><img id="foto_cedp" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?php
    echo $cedulapropietario;
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar el documento cedula del propietario y click en actualizar</label>
                <input type="file"  name="userfile" class="cedptemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($cedptemp)){?>
        <div align="left"><img id="foto_cedp" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $cedptemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv3?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> RUT del propietario</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmRutp" action="javascript:subirRutpTemp();">
            <div align="center"><img id="foto_rutp" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $rutpropietario
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar el documento RUT del propietario y click en actualizar</label>
                <input type="file"  name="userfile" class="rutptemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($rutptemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $rutptemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv4?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Foto frontal</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmFrontal" action="javascript:subirFrontalTemp();">
            <div align="center"><img id="foto_frontal" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $foto_frontal
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar foto frontal y click en actualizar</label>
                <input type="file"  name="userfile" class="frontaltemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($frontaltemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $frontaltemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv5?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Foto lateral</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmLateral" action="javascript:subirLateralTemp();">
            <div align="center"><img id="foto_latder" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $foto_latder
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar foto lateral derecha y click en actualizar</label>
                <input type="file"  name="userfile" class="lateraltemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar">
            </div>
        </form>
        <?php if(isset($latdertemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $latdertemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv6?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Foto trasera</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmTrasera" action="javascript:subirTraseraTemp();">
            <div align="center"><img id="foto_latizq" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $foto_latizq
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar foto trasera y click en actualizar</label>
                <input type="file"  name="userfile" class="traseratemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($traseratemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $traseratemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv7?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Foto remolque</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmRemolque" action="javascript:subirRemolqueTemp();">
            <div align="center"><img id="foto_remol" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $remolque
                ?>" alt="Sin documento"/></div>
            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar foto del remolque y click en actualizar</label>
                <input type="file"  name="userfile" class="remolquetemp" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($remolquetemp)){?>
        <div align="left"><img id="foto_rut" src="<?= base_url() ?>uploads/vehiculos/<?= $idv?>/<?= $remolquetemp?>" alt="Sin pendiente" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv8?></div>
        <?php } ?>
    </div>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">

                    <li class="active"><i class="icon-file-alt"></i> Adjuntar Otros Documentos:</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmPdf" action="javascript:subirPdfTemp();">
            <div align="center"><h4>Documento actual: <a href="<?= base_url() . 'uploads/vehiculos/'. $idv . '/' . $pdf ?>" target="_blank"><?php
    echo $pdf;
                ?></a></h4></div>

            <div align="center">
                <input type="hidden" name="idv" value="<?= $idv ?>"/>
                <label>Seleccione examinar si desea cambiar y click en enviar</label>
                <input type="file"  name="userfile" class="pdftemp" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" size="2048">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($pdftemp)){?>
        <div align="left"><a href="<?= base_url() . 'uploads/vehiculos/'. $idv . '/' . $pdftemp ?>" target="_blank"> <?= $pdftemp?></a></div>
        <div align="left"><?= $obsv10?></div>
        <?php } ?>
    </div>
    <div><a href="<?= base_url() . 'conductor/Perfil/get_vehiculos' ?>"><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-right fa-2x"></i></a></div>
</div><!--/#page-wrapper -->
<?php
    $this->load->view('conductor/vwFooter');
?>
