<?php
$this->load->view('empresa/vwHeader');
?>
<div id="page-wrapper">

  <div class="row">
    <div class="col-lg-12">
      <h1>Documentos Empresa</h1><h4>* (Las imagenes deben tener máximo 1mb de tamaño y los nombres de los archivos a enviar no deben tener tíldes).</h4>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
      <h1> <small></small></h1>
      <ol class="breadcrumb">
        <li class="active"><i class="icon-file-alt"></i>LOGO</li>
      </ol>
    </div>
  </div><!-- /.row -->    
  <div align="center"><img name="foto_logo" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $logo?>" width="240" heigth="240" alt=""/></div>
  <form id="frmLogo" action="javascript:subirLogoTemp()" enctype="multipart/form-data">
    <div align="center">
      <input type="hidden" name="id" value="<?= $idempresa ?>">
      LOGO:<input type="file" name="userfile"  accept="image/*"/>
      <input type="submit" name="update_logo" value="Enviar"/>
    </div>
  </form>
  <?php if(isset($logotemp)){?>
  <div align="left"><img name="foto_logo" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $logotemp?>" alt="rut temp" width="60" height="60"/></div>
  <div align="left"><?= $obsv?></div>
  <?php } ?>
  <div class="row">
    <div class="col-lg-12">
      <h1> <small></small></h1>
      <ol class="breadcrumb">
        <li class="active"><i class="icon-file-alt"></i>RUT</li>
      </ol>
    </div>
  </div><!-- /.row -->

  <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>

  <form id="frmRut" action="javascript:subirRutTemp()" enctype="multipart/form-data" >
    <div align="center"><img name="foto_rut" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $rut?>" width="240" heigth="240" alt=""/></div>
    <div align="center">
        <input type="hidden" name="id" value="<?= $idempresa ?>">
      RUT(*):<input type="file"  name="userfile" accept="image/*">
      <input type="submit" name="update_rut" value="Enviar">
    </div>
  </form>
  <?php if(isset($ruttemp)){?>
  <div align="left"><img name="foto_rut" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $ruttemp?>" alt="rut temp" width="60" height="60"/></div>
  <div align="left"><?= $obsv?></div>
  <?php } ?>
  <div class="row">
    <div class="col-lg-12">
      <h1> <small></small></h1>
      <ol class="breadcrumb">
        <li class="active"><i class="icon-file-alt"></i>Camara de comercio</li>
      </ol>
    </div>
  </div><!-- /.row -->
  <form id="frmCamara" action="javascript:subirCamaraTemp()" enctype="multipart/form-data" >
    <div align="center"><img name="foto_camara" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $camara?>" width="240" heigth="240" alt=""/></div>
    <div align="center"><input type="hidden" name="id" value="<?= $idempresa ?>">
      Camara de comercio(*):<input type="file"  name="userfile" accept="image/*">
      <input type="submit" name="update_camara" value="Enviar"/>
    </div>
  </form>
  <?php if(isset($camaratemp)){?>
  <div align="left"><img name="foto_camara" src="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $camaratemp?>" alt="camara temp" width="60" height="60"/></div>
  <div align="left"><?= $obsv?></div>
  <?php } ?>
  <div class="row">
    <div class="col-lg-12">
      <h1> <small></small></h1>
      <ol class="breadcrumb">
        <li class="active"><i class="icon-file-alt"></i> Adjuntar Otros Documentos </li>
      </ol>
    </div>
  </div><!-- /.row -->
  <form id="frmPdf" action="javascript:subirPdfEmpresa()" enctype="multipart/form-data">
    <div align="center"><a href="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $pdf?>" target="_blank" title="<?= $pdf?>"><?= $pdf?></a></div>
    <div align="center"><input type="hidden" name="id" value="<?= $idempresa ?>">
      <input type="file" name="userfile" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf">
      <input type="submit" name="update_pdf" value="Enviar"/>
    </div>

    <div align="center">
      <a href="<?= base_url() . 'empresa/Perfil/ver_completar' ?>"><i class="fa fa-angle-double-right fa-3x"></i><i class="fa fa-angle-double-right fa-3x"></i><i class="fa fa-angle-double-right fa-3x"></i><i class="fa fa-angle-double-right fa-3x"></i><i class="fa fa-angle-double-right fa-3x"></i></a>
    </div>
  </form>
  <?php if(isset($pdftemp)){?>
  <div align="left"><a href="<?= base_url() ?>uploads/empresas/<?= $idempresa ?>/<?= $pdftemp?>" target="_blank" title="<?= $pdftemp?>"><?= $pdftemp?></a></div>
  <div align="left"><?= $obsv?></div>
  <?php } ?>
  <!--</div>-->
</div><!-- /#page-wrapper -->

<?php
$this->load->view('empresa/vwFooter');
?>
