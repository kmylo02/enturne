<?php
$idEmpresa = $empresa->idEmpresa;
$urllogo = base_url('uploads/empresas') . '/' .
        $idEmpresa . '/' . $empresa->logo;
$nombre = $empresa->nombre_empresa;
$siglas = $empresa->siglas;
$nit = $empresa->nit;
$ciudad = $empresa->nombre_ciudad;
$direccion = $empresa->direccion;
$telefono = $empresa->telefono;
$fax = $empresa->fax;
$web = $empresa->web;
$tipoCarga = $empresa->tipo_carga;
$fecha = $empresa->created_at;
$urlrut = base_url('uploads/empresas') . '/' .
        $idEmpresa . '/' . $empresa->rut;
$urlcamara = base_url('uploads/empresas') . '/' .
        $idEmpresa . '/' . $empresa->camaracomercio;
$anexos = base_url('uploads/empresas') . '/' .
        $idEmpresa . '/' . $empresa->pdf;
$urlPerfil = base_url('uploads') . '/' . $admin->idUser .
        '/' . $admin->foto_ruta;

$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$type = pathinfo($urllogo, PATHINFO_EXTENSION);
$logoData = file_get_contents($urllogo, false, stream_context_create($arrContextOptions));
$logoBase64Data = base64_encode($logoData);
$logo = 'data:image/' . $type . ';base64,' .
        $logoBase64Data;

$type1 = pathinfo($urlrut, PATHINFO_EXTENSION);
$rutData = file_get_contents($urlrut, false, stream_context_create($arrContextOptions));
$rutBase64Data = base64_encode($rutData);
$rut = 'data:image/' . $type1 . ';base64,' .
        $rutBase64Data;

$type2 = pathinfo($urlcamara, PATHINFO_EXTENSION);
$camaraData = file_get_contents($urlcamara, false, stream_context_create($arrContextOptions));
$camaraBase64Data = base64_encode($camaraData);
$camara = 'data:image/' . $type2 . ';base64,' .
        $camaraBase64Data;

$type3 = pathinfo($urlPerfil, PATHINFO_EXTENSION);
$perfilData = file_get_contents($urlPerfil, false, stream_context_create($arrContextOptions));
$perfilBase64Data = base64_encode($perfilData);
$fotoperfiladmin = 'data:image/' . $type3 . ';base64,' .
        $perfilBase64Data;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?></title>
        <style type="text/css">
            .footer {
                position: fixed;
                left: 0px;
                bottom: -180px;
                right: 0px;
                height: 220px;
                text-align: center
            }
            .footer .page:after {
                content: counter(page, upper-roman);
            }
            h2{
                color: #DFBE00;
                text-decoration: underline;
                text-align: left
            }
            h3{
                color: #DFBE00;
                text-decoration: none;
                text-align: left
            }
            h4 {
                color: black;
                text-decoration: none
            }
            h5 {
                color: #B4002A;
                text-align: center;
            }
            hr {color:#DFBE00;
                width: 100%
            }
            .docs {
                max-width:100%;width:auto;height:auto
            }
        </style>
    </head>
    <body>
        <div class="footer"><hr><h5>Enturne En Línea SAS, No se hace responsable de la informacion contenida en esta hoja de vida, es deber del usuario que haga uso de ésta,
                validar su autenticidad y de realizar el uso adecuado.</h5></div>
    <center><img src = "<?= $logo ?>" width = "120" height = "120"></center><br><br><br>
    <h2>INFORMACIÓN DE LA EMPRESA</h2>
    <table>
        <tr>
            <td><b>Nombre:</b></td>
            <td><?= $nombre ?></td>
        </tr>
        <tr>
            <td><b>Siglas:</b></td>
            <td><?= $siglas ?></td>
        </tr>
        <tr>
            <td><b>Nit:</b></td>
            <td><?= $nit ?></td>
        </tr>
        <tr>
            <td><b>Ciudad:</b></td>
            <td><?= $ciudad ?></td>
        </tr>
        <tr>
            <td><b>Dirección:</b></td>
            <td><?= $direccion ?></td>
        </tr>
        <tr>
            <td><b>Teléfono:</b></td>
            <td><?= $telefono ?></td>
        </tr>
        <tr>
            <td><b>Fax:</b></td>
            <td><?= $fax ?></td>
        </tr>
        <tr>
            <td><b>Página Web:</b></td>
            <td><?= $web ?></td>
        </tr>
        <tr>
            <td><b>Tipo de carga:</b></td>
            <td><?= $tipoCarga ?></td>
        </tr>
        <tr>
            <td><b>Número de usuarios:</b></td>
            <td>2</td>
        </tr>
        <tr>
            <td><b>Fecha de registro:</b></td>
            <td><?= $fecha ?></td>
        </tr>
    </table><br>

    <h2>USUARIO ADMINISTRADOR</h2>
    <table>
        <tr>
            <td><h3>SUCURSAL: <?= $admin->nombre_ciudad . '-' . $admin->nombre_dpto ?></h3>
                <table>
                    <tr>
                        <td><b>Nombre:</b></td>
                        <td><?= $admin->nombre . ' ' . $admin->apellidos ?></td>
                    </tr>
                    <tr>
                        <td><b>Cédula de ciudadania:</b></td>
                        <td><?= $admin->cedula ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha de nacimiento:</b></td>
                        <td><?= $admin->fecha_nac ?></td>
                    </tr>
                    <tr>
                        <td><b>Dirección:</b></td>
                        <td><?= $admin->direccion ?></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono:</b></td>
                        <td><?= $admin->telefono ?></td>
                    </tr>
                    <tr>
                        <td><b>Mail:</b></td>
                        <td><?= $admin->email ?></td>
                    </tr>
                </table>
            </td>
            <td style="text-align: right">
                <img src = "<?= $fotoperfiladmin ?>" width="100" height="160" alt="sin foto de perfil">
            </td>
        </tr>
    </table><br><br><br><br><br><br><br><br>
    <?php if (!$personal) { ?>
        <?php
    } else {
        echo "<h2>OTROS USUARIOS AUTORIZADOS</h2>"
        ?>
        <table>
            <?php foreach ($personal as $value) { ?>
                <tr>
                    <td><h3>SUCURSAL: <?= $value->nombre_ciudad . '-' . $value->nombre_dpto ?></h3>
                        <table>
                            <tr>
                                <td><b>Nombre:</b></td>
                                <td><?= $value->nombre . ' ' . $value->apellidos ?></td>
                            </tr>
                            <tr>
                                <td><b>Cédula de ciudadania:</b></td>
                                <td><?= $value->cedula ?></td>
                            </tr>
                            <tr>
                                <td><b>Fecha de nacimiento:</b></td>
                                <td><?= $value->fecha_nac ?></td>
                            </tr>
                            <tr>
                                <td><b>Dirección:</b></td>
                                <td><?= $value->direccion ?></td>
                            </tr>
                            <tr>
                                <td><b>Teléfono:</b></td>
                                <td><?= $value->telefono ?></td>
                            </tr>
                            <tr>
                                <td><b>Mail:</b></td>
                                <td><?= $value->email ?></td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align: right">
                        <?php
                        $urlPerfilUsers = base_url('uploads') . '/' . $value->idUser . '/' . $value->foto_ruta;
                        $type4 = pathinfo($urlPerfilUsers, PATHINFO_EXTENSION);
                        $perfiluserData = file_get_contents($urlPerfilUsers, false, stream_context_create($arrContextOptions));
                        $perfiluserBase64Data = base64_encode($perfiluserData);
                        $fotoperfiluser = 'data:image/' . $type . ';base64,' . $perfiluserBase64Data;
                        ?>
                        <img src = "<?= $fotoperfiluser ?>" width="100" height="160" alt="sin foto de perfil">
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
    }
    ?>
    <h2>DOCUMENTACIÓN</h2><br>
    <center><img class = "docs" src = "<?= $rut ?>" width = "300" height = "400" alt="rut"></center>
    <br>
    <center><img class = "docs" src = "<?= $camara ?>" width = "300" height = "400" alt="camara"></center>
    <br>
    <center><a href="<?= $anexos ?>" target="_blank">Otros. (para visualizar en una ventana nueva, dar clic derecho y seleccionar ventana nueva)</a></center>
</body>
</html>
