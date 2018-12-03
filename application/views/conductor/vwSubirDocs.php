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
            <h1>Mi Documentación<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'conductor/Perfil/completar_conductor' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li>Los nombres de los archivos a enviar no deben tener tíldes.</li>
                <div style="clear: both;"></div>
            </ol>

        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
      <div class="row">
          <div class="col-lg-12">
              <h1> <small></small></h1>
              <ol class="breadcrumb">
                  <li class="active"><i class="icon-file-alt"></i> Foto Perfil. Foto medio cuerpo, sin gafas, bufandas, gorras o cualquier elemento que impida su reconocimiento facial.</li>
                  <li class="active">.jpg .png .gif de max 2MB.</li>
                  <div style="clear: both;"></div>
              </ol>
          </div>
      </div><!-- /.row -->
      <form enctype="multipart/form-data" id="frmfoto" action="javascript:subirFotoUser();">
      <?php if($perfil->foto_ruta != NULL){ $src = base_url() .'uploads/'. $id.'/'. $perfil->foto_ruta;} else { $src = base_url().'assets/images_login/avatar.png';}?>
          <div align="center"><img id="foto_perfil" src="<?= $src; ?>" /></div>
          <div align="center">
              <input type="file" name="userfile" class="fotouser" accept="image/*" size="1024">
              <input type="submit" value="Enviar"/>
          </div>
      </form>
      <?php if(isset($perfiltemp)){?>
        <div align="left"><img src="<?= base_url() ?>uploads/<?= $id ?>/<?= $perfiltemp?>" alt="ced temp" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Cédula de ciudadania. Asegurese que el documento sea legible, vigente y a color.</li>
                    <li class="active">.jpg .png .gif de max 2MB.</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <form enctype="multipart/form-data" id="frmCedula" action="javascript:subirCedula();">
            <div align="center"><img id="foto_doc" src="<?= base_url() ?>uploads/<?= $id ?>/<?php
                foreach ($doc as $row) {
                    echo $row->foto_cedula;
                }
                ?>" alt="Sin documento" width="890px" height="292px"/></div>
            <div align="center">
                <input type="file" name="userfile" class="fotocedula" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($cedulatemp)){?>
        <div align="left"><img src="<?= base_url() ?>uploads/<?= $id ?>/<?= $cedulatemp?>" alt="ced temp" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv?></div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Licencia de conducción. Asegurese que el documento sea legible, vigente y a color.</li>
                    <li class="active">.jpg .png .gif de max 2MB</li>
                    <div style="clear: both;"></div>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

        <form enctype="multipart/form-data" id="frmLic" action="javascript:subirLicencia();">
            <div align="center"><img id="foto_lic" src="<?= base_url() ?>uploads/<?= $id ?>/<?php
                foreach ($lic as $row) {
                    echo $row->foto_licencia;
                }
                ?>" alt="Sin documento" width="890px" height="292px"/></div>
            <div align="center">
                <input type="file"  name="userfile" class="fotolic" accept="image/*" size="1024">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($lictemp)){?>
        <div align="left"><img src="<?= base_url() ?>uploads/<?= $id ?>/<?= $lictemp?>" alt="lic temp" width="60px" height="60px"/></div>
        <div align="left"><?= $obsv?></div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-12">
                <h1> <small></small></h1>
                <ol class="breadcrumb">
                    <li class="active"><i class="icon-file-alt"></i> Adjuntar Otros Documentos. En este archivo podría subir en un solo
documento
PDF:
- Certificado de Mercancías Peligrosas
- Certificado de Manipulación de alimentos
- Curso de Seguridad Vial
- Planilla de pago de Seguridad Social
- Y demás documentos que acrediten su labor profesional.</li>
                </ol>
            </div>
        </div><!-- /.row -->

        <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>
        <input type="hidden" name="pdf" value="<?= $perfil->pdf;?>"/>
        <form enctype="multipart/form-data" id="frmPdfUser" action="javascript:subirPdf();">
            <div align="center"><h4>Documento Actual:<a href="<?= base_url() . 'uploads/' . $id . '/' . $perfil->pdf ?>" target="_blank"> <?= $perfil->pdf?></a></h4></div>
            <div align="center">
                <input type="file"  name="userfile" class="pdf" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" size="2048">
                <input type="submit" value="Enviar"/>
            </div>
        </form>
        <?php if(isset($pdftemp)){?>
        <div align="left"><a href="<?= base_url() . 'uploads/' . $id . '/' . $pdftemp ?>" target="_blank"> <?= $pdftemp?></a></div>
        <div align="left"><?= $obsv?></div>
        <?php } ?>
        <div><a href="<?= base_url() . 'conductor/Perfil/completar_conductor' ?>"><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-right fa-2x"></i><i class="fa fa-angle-double-right fa-2x"></i></a></div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('conductor/vwFooter');
?>
