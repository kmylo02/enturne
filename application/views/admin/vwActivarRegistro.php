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
            <h1>Datos <small> Registro</small></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'admin/Empresas' ?>"><i class="fa fa-level-up fa-2x"></i></a></li>
                <li class="active"><i class="fa fa-registered"></i> Datos de registro</li>

                <div style="clear: both;"></div>
            </ol>
        </div>
    </div><!-- /.row -->

    <div id="dialog_mi_popup" style="display: none" title="Nueva Ventana"></div>



    <form method="post" action="<?php echo base_url().'Registros/activar_registro'?>" id="basicBootstrapForm" class="form-horizontal">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php
            foreach ($registro as $fila) {
                echo $fila->id;
            }
            ?>"/>
            <label class="col-xs-3 control-label">Nombre</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php
            
                echo $fila->nombre;
            
            ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Apellidos</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "apellidos" value="<?php
        
            echo $fila->apellidos;
        
            ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Email</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" name = "email" value="<?php
                
                    echo $fila->email;
                
            ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <label class = "col-xs-3 control-label">Usuario registro</label>
            <div class = "col-xs-4">
                <input type = "text" class = "form-control" value="<?php
                
                        echo $fila->usuario;
               
            ?>" disabled/>
            </div>
        </div>

        <div class = "form-group">
            <div class = "col-xs-6 col-xs-offset-3">
                <div class = "checkbox">
                    <label>
                        <input type = "checkbox" name = "activar" value = "1" /> Activar Registro
                    </label>
                </div>
            </div>
        </div>
        
        <div class = "form-group">
            <div class = "col-xs-9 col-xs-offset-3">
                <button type = "submit" class = "btn btn-primary" name = "submit_reg" value = "Sign up">Aceptar</button>
            </div>
        </div>
    </form>
</div><!--/#page-wrapper -->


<?php
$this->load->view('admin/vwFooter');
?>
