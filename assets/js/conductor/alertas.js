$(document).on("ready");
function consultaSos() {
	var contIni = $("#numsos").html();
	$.ajax({
		url: get_base_url()+"conductor/Alertas/get_contsos",		
		success:function(resp){
			var contAct = resp
			if(contAct != contIni){					
				$("#numsos").html(contAct);
			}	
            if(contAct > contIni){					
				$("#numsos").html(contAct);
				ion.sound({
					sounds: [
						{name: "beer_can_opening"},
						{name: "bell_ring"},
						{name: "branch_break"},
						{name: "button_click"}
					],

					// main config
					path: get_base_url()+"assets/js/ion.sound/sounds/",
					preload: true,
					multiplay: true,
					volume: 0.9
				});

				// play sound
				ion.sound.play("bell_ring");
		  }			
		}
	});
};
/*function consultaMensajes() {
	$.ajax({
		url: get_base_url()+"conductor/Dashboard/mensajeria",		
		success:function(resp){				
                    $("#mensajes").html(resp);		
		}
	});
};*/
function very_licc(){
 url=get_base_url()+"conductor/Dashboard/very_licc";
 $.ajax({
  url:url,
  type:'POST',
  success:function(resp){
   if(resp){
    swal({
     title: "Atención!",
     text: resp,
     type: "warning",
     showCancelButton: true,
     confirmButtonText: "Entendido",
     cancelButtonText: "No recordar",
     closeOnConfirm: false
    }).then(function() {
        
    },function(dismiss) {
        if(dismiss === 'cancel') {
            $.ajax({
		url: get_base_url()+"conductor/Dashboard/cancel_recordatorio",
                type:'POST',
		success:function(res){
                    if(res==='ok'){
                        swal({
                         title: "Exito!",
                         text: "Recordatorio cancelado",
                         type: "success",
                         confirmButtonText: "Ok",
                         closeOnConfirm: false
                        });
                    } else {
                        swal("Aceptar", "Error en bbdd!", "error");
                    }
		}
            });
        }
    }); 
   }
  }
 });
}
setInterval(consultaSos,6000);