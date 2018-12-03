<?php
$this->load->view('admin/vwHeader');
?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Documentos conductor pendientes por aprobar</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Conductores' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-user"></i>
                    <?php if (isset($nombre)) {
                        echo $nombre;
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
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">FOTO PERFIL</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php echo "<tr><td>";
                      if(isset($fechaperfil)){
                        echo $fechaperfil."</td><td>";
                      }
                      if(isset($linkPerfil)){
                        echo $linkPerfil."</td><td>";
                      }
                      if(isset($btnPerfil)){
                        echo $btnPerfil."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">CÉDULA</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php echo "<tr><td>";
                      if(isset($fechacedula)){
                        echo $fechacedula."</td><td>";
                      }
                      if(isset($linkCedula)){
                        echo $linkCedula."</td><td>";
                      }
                      if(isset($btnCedula)){
                        echo $btnCedula."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">LICENCIA DE CONDUCCIÓN</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechaLic)){
                        echo "<tr><td>".$fechaLic."</td><td>";
                      }
                      if(isset($linkLic)){
                        echo $linkLic."</td><td>";
                      }
                      if(isset($btnLic)){
                        echo $btnLic."</td></tr>";
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