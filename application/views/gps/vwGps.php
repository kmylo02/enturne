<?php
$this->load->view('gps/vwHeader');
?>
<!--  
Load Page Specific CSS and JS here
Author : Jhon Jairo Valdés Aristizabal 
Downloaded from http://devzone.co.in
-->


<!-- Page Specific Plugins -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<!-- Page Specific CSS -->
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

<style type="text/css">
            
            #sidebar{
                position: absolute;
                width: 100px;
                height: 600px;
                background: #F7E000;
                color: #fff;
                margin-left: 860px;
                margin-top: -600px;
                border: 1px solid #F7E000;
            }
            ul{
                padding: 0;
                text-align: justify;		
            }

            #li_side{
                cursor: pointer;
                border-top: 1px solid #fff;
                background: #000000; 
                list-style: none;
                color: #F7E000
            }
            #li_side:hover{
                background: #F7E000;
                color: black;                 
            }
        </style>

<script src="<?php echo base_url() . 'assets/js/morris/chart-data-morris.js' ?>"></script>
<script type="text/javascript">
            function datos_marker(lat, lng, marker)
            {
                var mi_marker = new google.maps.LatLng(lat, lng);
                map.panTo(mi_marker);
                google.maps.event.trigger(marker, 'click');
            }
        </script>
        <?php echo $map['js'] ?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1>Panel Principal <small>Seguimiento Vehicular</small></h1>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> Tablero</li>
            </ol>           
        </div>
    </div><!-- /.row -->



    <div class="table-responsive">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-map"></i> </h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-chart-area"><?php echo $map['html'] ?>
                            <div id="sidebar">
                                <ul>
                                    <?php
                                    foreach ($datos as $marker_sidebar) {
                                        ?><li id="li_side" onclick="datos_marker(<?php echo $marker_sidebar->pos_y ?>,<?php echo $marker_sidebar->pos_x ?>, marker_<?php echo $marker_sidebar->id ?>)">
                                            <?php echo $marker_sidebar->id; ?>&nbsp;&nbsp;<?php echo substr($marker_sidebar->infowindow, 0, 14) ?></li><?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--/.row -->
    </div>



</div><!--/#page-wrapper -->


<!--PAge Code Ends here -->
<?php
$this->load->view('gps/vwFooter');
?>