<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Documentos vehiculo pendientes por aprobar</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Vehiculos' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-truck"></i>
                    <?php if (isset($placa)) {
                        echo $placa;
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
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">FOTO FRONTAL</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php echo "<tr><td>";
                      if(isset($fechafrontal)){
                        echo $fechafrontal."</td><td>";
                      }
                      if(isset($linkFrontal)){
                        echo $linkFrontal."</td><td>";
                      }
                      if(isset($btnFrontal)){
                        echo $btnFrontal."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">FOTO LATERAL</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechaLateral)){
                        echo "<tr><td>".$fechaLateral."</td><td>";
                      }
                      if(isset($linkLateral)){
                        echo $linkLateral."</td><td>";
                      }
                      if(isset($btnLateral)){
                        echo $btnLateral."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">FOTO TRASERA</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechatrasera)){
                        echo "<tr><td>".$fechatrasera."</td><td>";
                      }
                      if(isset($linkTrasera)){
                        echo $linkTrasera."</td><td>";
                      }
                      if(isset($btnTrasera)){
                        echo $btnTrasera."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">LICENCIA TRANSITO</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechalict)){
                        echo "<tr><td>".$fechalict."</td><td>";
                      }
                      if(isset($linkLict)){
                        echo $linkLict."</td><td>";
                      }
                      if(isset($btnLict)){
                        echo $btnLict."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">SOAT</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechasoat)){
                        echo "<tr><td>".$fechasoat."</td><td>";
                      }
                      if(isset($linkSoat)){
                        echo $linkSoat."</td><td>";
                      }
                      if(isset($btnSoat)){
                        echo $btnSoat."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">RTM</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechartm)){
                        echo "<tr><td>".$fechartm."</td><td>";
                      }
                      if(isset($linkRtm)){
                        echo $linkRtm."</td><td>";
                      }
                      if(isset($btnRtm)){
                        echo $btnRtm."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">REG. REMOLQUE</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fecharegremolque)){
                        echo "<tr><td>".$fecharegremolque."</td><td>";
                      }
                      if(isset($linkRegremolque)){
                        echo $linkRegremolque."</td><td>";
                      }
                      if(isset($btnRegremolque)){
                        echo $btnRegremolque."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">CÉDULA PROPIETARIO</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fechacedprop)){
                        echo "<tr><td>".$fechacedprop."</td><td>";
                      }
                      if(isset($linkCedprop)){
                        echo $linkCedprop."</td><td>";
                      }
                      if(isset($btnCedprop)){
                        echo $btnCedprop."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th colspan="3" style="background-color:#C0C0C0; text-align:center">RUT PROPIETARIO</th>
        </tr>
        <tr>
          <th style="background-color:#C0C0C0">Fecha Solicitud</th>  
          <th style="background-color:#C0C0C0">Documento</th>
          <th style="background-color:#C0C0C0">Acciones</th>
        </tr>
          </thead>
          <tbody>
                <?php if(isset($fecharutprop)){
                        echo "<tr><td>".$fecharutprop."</td><td>";
                      }
                      if(isset($linkRutprop)){
                        echo $linkRutprop."</td><td>";
                      }
                      if(isset($btnRutprop)){
                        echo $btnRutprop."</td></tr>";
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
                <?php if(isset($fechadocu)){
                        echo "<tr><td>".$fechadocu."</td><td>";
                      }
                      if(isset($linkDocu)){
                        echo $linkDocu."</td><td>";
                      }
                      if(isset($btnDocu)){
                        echo $btnDocu."</td></tr>";
                      } ?>
            </tbody>
        </table>
    </div>
</div><!-- /#page-wrapper -->

<?php
$this->load->view('admin/vwFooter');
?>