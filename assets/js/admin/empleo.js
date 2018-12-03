function cerrarVacante(id) { 
  swal({
        title: "Esta seguro que desea cerrar esta oferta de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function() {
        url= get_base_url()+"conductor/Empleo/cerrar_vacante";
        $.ajax({
            url:url,
            type:'POST',
            data:{id},
            success:function(resp){
                if(resp==="ok"){
                  swal({
                   title: "Exito!",
                   text: "Vacante eliminada correctamente .",
                   type: "success",
                   confirmButtonText: "Ok",
                   closeOnConfirm: false
                  }).then(function(){
                   location.reload();
                  });
                }
                if(resp==="error"){
                    swal({
                     title: "Aviso!",
                     text: "Error en bbdd.",
                     type: "warning",
                     confirmButtonText: "Ok",
                     closeOnConfirm: false
                    }).then(function(){
                     location.reload();
                    });
                }	
            }
        });
    },function(dismiss) {
        if(dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}
function eliminarVacante(id) { 
  swal({
        title: "Esta seguro que desea eliminar esta oferta de empleo?",
        text: "Esta acción no podra ser removida!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    }).then(function() {
        url= get_base_url()+"conductor/Empleo/eliminar_vacante";
        $.ajax({
            url:url,
            type:'POST',
            data:{id},
            success:function(resp){
                if(resp==="ok"){
                  swal({
                   title: "Exito!",
                   text: "Vacante eliminada correctamente .",
                   type: "success",
                   confirmButtonText: "Ok",
                   closeOnConfirm: false
                  }).then(function(){
                   location.reload();
                  });
                }
                if(resp==="error"){
                    swal({
                     title: "Aviso!",
                     text: "Error en bbdd.",
                     type: "warning",
                     confirmButtonText: "Ok",
                     closeOnConfirm: false
                    }).then(function(){
                     location.reload();
                    });
                }	
            }
        });
    },function(dismiss) {
        if(dismiss == 'cancel') {
            swal("Cancelado", "Acción no realizada!", "error");
        }
    });
}

