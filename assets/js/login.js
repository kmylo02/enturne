function login() {
    var usuario = $("#username").val();

    var passw = $("#password").val();

    var url = get_base_url() + "Login/very_sesion";

    $.post(url, {usuario: usuario, passw: passw}).done(function (resp) {

        if (resp === '0') {

            window.location = get_base_url() + "admin/Dashboard";

        }

        if (resp === '1') {

            window.location = get_base_url() + "empresa/Dashboard";

        }

        if (resp === '2') {

            window.location = get_base_url() + "conductor/Dashboard";

        }

        if (resp === '3') {

            window.location = get_base_url() + "gps/Dashboard";

        }

        if (resp === '4') {

            swal({

                title: "Aviso!",

                text: "Usuario y/o contraseña erroneos",

                type: "error",

                confirmButtonText: "Ok"

            });

        }

        if (resp === '5') {

            swal({

                title: "Aviso!",

                text: "El usuario no esta activo, por favor verifique su correo si aún no ha validado su email, o comuniquese con Enturne por probable bloqueo.",

                type: "error",

                confirmButtonText: "Ok"

            });
        }
    })

            .fail(function () {

                swal({

                    title: "Error!",

                    text: "Error en bbdd",

                    type: "error",

                    confirmButtonText: "Ok"

                });

            });
}
