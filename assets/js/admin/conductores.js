function updateFotoPerfil(){
        //información del formulario
        var formData = new FormData($("#frmFotoPerfil")[0]);
        //hacemos la petición ajax  
        $.ajax({
            url: get_base_url()+"admin/Conductores/subir_foto_user_ajax",  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                swal({
                    title: "Aviso!",
                    text: "Subiendo archivo.",
                    imageUrl: get_base_url()+'assets/img/loaderdocs.gif',
                    showConfirmButton: false
                  });
            },
            //una vez finalizado correctamente
            success: function(data){
                swal({
                        title: "Exito!",
                        type: "success",
                        text: "La imagen ha subido correctamente",
                        showConfirmButton: false
                    });
                location.reload();
            },
            //si ha ocurrido un error
            error: function(){
                swal({
                        title: "Error!",
                        type: "error",
                        text: "Ha ocurrido un error.",
                        showConfirmButton: false
                    });
            }
        });
    };
function updateFotoCedula(){
        //información del formulario
        var formData = new FormData($("#frmFotoCedula")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: get_base_url()+"admin/Conductores/subir_cedula_ajax",  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                swal({
                    title: "Aviso!",
                    text: "Subiendo archivo.",
                    imageUrl: get_base_url()+'assets/img/loaderdocs.gif',
                    showConfirmButton: false
                  });
            },
            //una vez finalizado correctamente
            success: function(data){
                swal({
                        title: "Exito!",
                        type: "success",
                        text: "La imagen ha subido correctamente",
                        showConfirmButton: false
                    });
                location.reload();
            },
            //si ha ocurrido un error
            error: function(){
                swal({
                        title: "Error!",
                        type: "error",
                        text: "Ha ocurrido un error.",
                        showConfirmButton: false
                    });
            }
        });
    };
function updateFotoLic(){
        //información del formulario
        var formData = new FormData($("#frmFotoLic")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: get_base_url()+"admin/Conductores/subir_lic_ajax",  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                swal({
                    title: "Aviso!",
                    text: "Subiendo archivo.",
                    imageUrl: get_base_url()+'assets/img/loaderdocs.gif',
                    showConfirmButton: false
                  });
            },
            //una vez finalizado correctamente
            success: function(data){
                swal({
                        title: "Exito!",
                        type: "success",
                        text: "La imagen ha subido correctamente",
                        showConfirmButton: false
                    });
                location.reload();
            },
            //si ha ocurrido un error
            error: function(){
                swal({
                        title: "Error!",
                        type: "error",
                        text: "Ha ocurrido un error.",
                        showConfirmButton: false
                    });
            }
        });
    };
function updatePdfConductor(){
        //información del formulario
        var formData = new FormData($("#frmPdfConductor")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: get_base_url()+"admin/Conductores/subir_pdf_user_ajax",  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                swal({
                    title: "Aviso!",
                    text: "Subiendo archivo.",
                    imageUrl: get_base_url()+'assets/img/loaderdocs.gif',
                    showConfirmButton: false
                  });
            },
            //una vez finalizado correctamente
            success: function(data){
                swal({
                        title: "Exito!",
                        type: "success",
                        text: "La imagen ha subido correctamente",
                        showConfirmButton: false
                    });
                location.reload();
            },
            //si ha ocurrido un error
            error: function(){
                swal({
                        title: "Error!",
                        type: "error",
                        text: "Ha ocurrido un error.",
                        showConfirmButton: false
                    });
            }
        });
    };

