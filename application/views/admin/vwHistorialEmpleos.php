<?php
$this->load->view('admin/vwHeader');
?>
<div id="page-wrapper">

  <div class="row">
    <div class="col-lg-12">
      <h1>Historial Ofertas de Empleo Cerradas</h1>
      <ol class="breadcrumb">
        <li><h3>Por empresas</li><li></li><li></li><li><a href="<?php echo base_url().'admin/Empleo'?>" title="Atras"><i class="fa fa-level-up fa-2x"></i></a></li>
        <div style="clear: both;"></div>
      </ol>
    </div>
  </div><!-- /.row -->



      <div class="table-responsive">
        <table class="table table-hover tablesorter">
          <thead>
            <tr>
              <th class="header">Fecha Oferta</th>
              <th class="header">Descripcion</th>
              <th class="header">1</th>
              <th class="header"></th>
            </tr>
          </thead>
          <tbody>
           <?php
          if (!$ofertase) {
              echo "<tr>";
              echo "<td>" . $mensaje . "</td>";
              echo "</tr>";
          } else {
              foreach ($ofertase as $row) {
                  echo "<tr>";
                  echo"<td>" . $row->created_at . "</td>";
                  echo"<td>" . $row->descripcion . "</td>";
                  echo"<td>" . $row->nombre_empresa . "</td>";
                  echo"<td>" . anchor(base_url() . 'empresa/Empleo/get_oferta_xid/' . $row->id_oferta, '<i class="fa fa-newspaper-o fa-2x"></i>',array('title'=>'Ver oferta')) . "</td>";
                  echo "</tr>";
              }
          }
          ?>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <ol class="breadcrumb">
            <li><h3>Por transportadores</li>
            <div style="clear: both;"></div>
          </ol>
        </div>
      </div><!-- /.row -->



          <div class="table-responsive">
            <table class="table table-hover tablesorter">
              <thead>
                <tr>
                  <th class="header">Fecha Oferta</th>
                  <th class="header">Descripcion</th>
                  <th class="header">Transportador</th>
                  <th class="header"></th>
                </tr>
              </thead>
              <tbody>
               <?php
              if (!$ofertast) {
                  echo "<tr>";
                  echo "<td>" . $mensaje . "</td>";
                  echo "</tr>";
              } else {
                  foreach ($ofertast as $row) {
                      echo "<tr>";
                      echo"<td>" . $row->created_at . "</td>";
                      echo"<td>" . $row->descripcion . "</td>";
                      echo"<td>" . $row->nombre." ".$row->apellidos. "</td>";
                      echo"<td>" . anchor(base_url() . 'empresa/Empleo/get_ofertat_xid/' . $row->id_oferta, '<i class="fa fa-newspaper-o fa-2x"></i>',array('title'=>'Ver oferta')) . "</td>";
                      echo "</tr>";
                  }
              }
              ?>
              </tbody>
            </table>
          </div>



</div><!-- /#page-wrapper -->
<?php
$this->load->view('admin/vwFooter');
?>
