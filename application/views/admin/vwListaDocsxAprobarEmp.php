<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Documentos empresa pendientes por aprobar</h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-building"></i>
                    <?php if (isset($nombreEmpresa)) {
                        echo $nombreEmpresa;
                    } else {
                        echo "";
                    }
                    ?></li>
                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">LOGO</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?= "<tr><td>";
                      if(isset($fechalogo)){
                        echo $fechalogo."</td><td>";
                      }
                      if(isset($linkLogo)){
                        echo $linkLogo."</td><td>";
                      }
                      if(isset($btnLogo)){
                        echo $btnLogo."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">RUT</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?= "<tr><td>";
                      if(isset($fecharut)){
                        echo $fecharut."</td><td>";
                      }
                      if(isset($linkRut)){
                        echo $linkRut."</td><td>";
                      }
                      if(isset($btnRut)){
                        echo $btnRut."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">Camara de Comercio</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechacam)){
                        echo "<tr><td>".$fechacam."</td><td>";
                      }
                      if(isset($linkCamara)){
                        echo $linkCamara."</td><td>";
                      }
                      if(isset($btnCamara)){
                        echo $btnCamara."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">Otros Documentos</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechapdf)){
                        echo "<tr><td>".$fechapdf."</td><td>";
                      }
                      if(isset($linkPdf)){
                        echo $linkPdf."</td><td>";
                      }
                      if(isset($btnPdf)){
                        echo $btnPdf."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>