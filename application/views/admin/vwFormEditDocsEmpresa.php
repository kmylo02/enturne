<?php
$this->load->view('admin/vwHeader');
?>

<!--
Author : Jhon Jairo Valdés Aristizabal
Downloaded from http://devzone.co.in
-->

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Documentos Actuales<small></small></h1>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <h1> <small></small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="icon-file-alt"></i>El Logo debe tener formato .jpg .png o .gif de maximo 2MB</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <form action="<?= base_url() . 'admin/Empresas/subir_foto_logo' ?>" enctype="multipart/form-data" method="post">
        <div align="center"><img id="foto_logo" src="<?= base_url() ?>uploads/empresas/<?= $row->idEmpresa . "/" . $row->logo; ?>" alt=""/></div>
        <div align="center">
            <input type="hidden" name="id" value="<?= $row->idEmpresa ?>"/>
            LOGO:<input type="file"  name="userfile" accept="image/*">
            <input type="submit" name="update_logo" value="Actualizar"/>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <h1> <small></small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="icon-file-alt"></i>El RUT debe tener formato .jpg .png o .gif de maximo 2MB</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <form action="<?= base_url() . 'admin/Empresas/subir_foto_rut' ?>" enctype="multipart/form-data" method="post">

        <div align="center"><img id="foto_rut" src="<?= base_url() ?>uploads/empresas/<?= $row->idEmpresa . "/" . $row->rut; ?>" alt=""/></div>
        <div align="center">

            <input type="hidden" name="id" value="<?= $row->idEmpresa ?>"/>
            RUT(*):<input type="file"  name="userfile" accept="image/*">
            <input type="submit" name="update_rut" value="Actualizar"/>
        </div>

    </form>

    <div class="row">
        <div class="col-lg-12">
            <h1> <small></small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="icon-file-alt"></i>Camara de comercio debe tener formato .jpg .png o .gif de maximo 2MB</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <form action="<?= base_url() . 'admin/Empresas/subir_foto_camara' ?>" enctype="multipart/form-data" method="post">
        <div align="center"><img id="foto_camara" src="<?= base_url() ?>uploads/empresas/<?= $row->idEmpresa . "/" . $row->camaracomercio; ?>" alt=""/></div>
        <div align="center">

            <input type="hidden" name="id" value="<?= $row->idEmpresa ?>"/>
            Camara de comercio(*):<input type="file"  name="userfile" accept="image/*">
            <input type="submit" name="update_camara" value="Actualizar"/>
        </div>

    </form>
    <!--</div>

    <div id="div_2" class="subida">-->
    <div class="row">
        <div class="col-lg-12">
            <h1> <small></small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="icon-file-alt"></i> Adjuntar Otros Documentos:</li>
            </ol>
        </div>
    </div><!-- /.row -->

    <form action="<?= base_url() . 'admin/Empresas/subir_pdf' ?>" enctype="multipart/form-data" method="post">

        <div align="center"><a href="<?= base_url() ?>uploads/empresas/<?= $row->idEmpresa . "/" . $row->pdf; ?>" target="_blank"><?= $row->pdf ?></a></div>
        <div align="center">

            <input type="hidden" name="id" value="<?= $row->idEmpresa ?>"/>
            <input type="file"  name="userfile" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf">
            <input type="submit" name="update_pdf" value="Actualizar"/>
        </div>
        <br>
        <div align="center">
            <a href="<?= base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-3x"></i></a>
        </div>
    </form>
    <!--</div>-->
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>
