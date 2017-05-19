<html>
    <body>
        <table width="80%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                    <!-- WHITE BACKGROUND -->
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF">
                        <tr>
                            <td colspan="5">
                                <!-- MAIN CONTENT TABLE -->
                                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                        <!-- LOGO -->
                                        <?
                                        if ($asunto != "cumpleanos") {
                                            $folder = "Usuarios/" . $usuario->getCaLogin() . "/foto120x150.jpg";
                                            ?>
                                        <tr><td colspan="3"><table><tr><td><img src="<?= $logo ?>" />
                                                            <?
                                                        }if ($asunto == "ingreso") {
                                                            ?>
                                                        <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Nuevo Colaborador</b></font></td>
                                                    </tr>
                                                </table></td></tr>
                                        <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="4"><hr noshade size="1"></td></tr>
                                        <!-- INTRO -->
                                        <tr>
                                            <td width="25">
                                            <td width="110">
                                                <div  align="center" style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                                                      border: 1px solid #EEE  ;
                                                      border-color: #EEE #EEE #DDD #EEE;
                                                      clear: both;
                                                      color: #333;
                                                      line-height: 1.5;
                                                      padding: 10px;

                                                      -moz-border-radius-topright : 6px;
                                                      border-top-right-radius : 6px;
                                                      -moz-border-radius-topleft : 6px;
                                                      border-top-left-radius : 6px;
                                                      -moz-border-radius-bottomright : 6px;
                                                      border-bottom-right-radius : 6px;
                                                      -moz-border-radius-bottomleft : 6px;
                                                      border-bottom-left-radius : 6px;">
                                                    <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" width="120" height="150" />
                                                </div>
                                            </td>
                                            <td width="300" valign="top">
                                                <font color="blue" size="4" face="arial, helvetica, sans-serif" color="#000000"><b><?= strtoupper($usuario->getCaNombres() . " " . $usuario->getCaApellidos()) ?></b></font><br /><br />
                                                <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getCaCargo() ?></b></font><br />
                                                <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></b></font><br />
                                                <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getCaNombre() ?></b></font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="25">
                                            <td colspan="5" >
                                                <br /><font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Le damos la m&aacute;s cordial bienvenida y le deseamos mucho &eacute;xito en su gesti&oacute;n</b></font><br /> 
                                            </td>
                                        </tr></table></table>
                        <?
                    } elseif ($asunto == "address") {
                        ?>
                    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Cambio de Direcci&oacute;n</b></font></td>
                </tr></table></td></tr>
    <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="4"><hr noshade size="1"></td></tr>
    <!-- INTRO -->
    <tr>
        <td width="25">
        <td width="110">
            <div  align="center" style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                  border: 1px solid #EEE  ;
                  border-color: #EEE #EEE #DDD #EEE;
                  clear: both;
                  color: #333;
                  line-height: 1.5;
                  padding: 10px;

                  -moz-border-radius-topright : 6px;
                  border-top-right-radius : 6px;
                  -moz-border-radius-topleft : 6px;
                  border-top-left-radius : 6px;
                  -moz-border-radius-bottomright : 6px;
                  border-bottom-right-radius : 6px;
                  -moz-border-radius-bottomleft : 6px;
                  border-bottom-left-radius : 6px;">
                <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" width="120" height="150" />
            </div>
        </td>
        <td width="300" valign="top">
            <font color="blue" size="4" face="arial, helvetica, sans-serif" color="#000000"><b><?= strtoupper($usuario->getCaNombres() . " " . $usuario->getCaApellidos()) ?></b></font><br /><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getCaCargo() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getCaNombre() ?></b></font>
        </td>
    </tr>
    <tr>
        <td width="25">
        <td colspan="5" >
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Direccion Antigua: <?= $direccion ?></b></font><br />                        
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Direccion Nueva: <?= $usuario->getCaDireccion() ?></b></font><br /><br />
            <font size="2" face="arial, helvetica, sans-serif" color="#000000">Se env&iacute;a copia a Jefe Administrativo de la sucursal para efectuar visita domiciliaria en caso que se requiera.</font><br />
        </td>
    </tr></table></table>
    <?
} elseif ($asunto == "desvinculacion") {
    ?>
    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Desvinculaci&oacute;n Colaborador</b></font></td></tr></table></td></tr>
    <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="4"><hr noshade size="1"></td></tr>
    <!-- INTRO -->
    <tr>
        <td width="25">
        <td width="110">
            <div  align="center" style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                  border: 1px solid #EEE  ;
                  border-color: #EEE #EEE #DDD #EEE;
                  clear: both;
                  color: #333;
                  line-height: 1.5;
                  padding: 10px;

                  -moz-border-radius-topright : 6px;
                  border-top-right-radius : 6px;
                  -moz-border-radius-topleft : 6px;
                  border-top-left-radius : 6px;
                  -moz-border-radius-bottomright : 6px;
                  border-bottom-right-radius : 6px;
                  -moz-border-radius-bottomleft : 6px;
                  border-bottom-left-radius : 6px;">
                <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" width="120" height="150" />
            </div>
        </td>
        <td width="300" valign="top">
            <font color="blue" size="4" face="arial, helvetica, sans-serif" color="#000000"><b><?= strtoupper($usuario->getCaNombres() . " " . $usuario->getCaApellidos()) ?></b></font><br /><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getCaCargo() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getCaNombre() ?></b></font>
        </td>
    </tr>
    <tr>
        <td width="25">
        <td colspan="5" >
            <font size="3" face="arial, helvetica, sans-serif" color="#000000">
            <br />
            TALENTO HUMANO se permite informar la desvinculaci&oacute;n de &eacute;ste colaborador de la compa&ntilde;&iacute;a<br />
            <br />
            <br />
            <br />

            </font>
        </td>
    </tr></table></table>
    <?
} elseif ($asunto == "reconocimiento") {
    $timestamp = strtotime($fchingreso);
    $mes = date("m", $timestamp);
    $fecha = date("d", $timestamp) . " de " . Utils::mesLargo($mes);
    ?>
    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Reconocimiento Especial</b></font></td></tr></table></td></tr>
    <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="4"><hr noshade size="1"></td></tr>
    <!-- INTRO -->
    <tr>
        <td width="25">
        <td width="110">
            <div  align="center" style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                  border: 1px solid #EEE  ;
                  border-color: #EEE #EEE #DDD #EEE;
                  clear: both;
                  color: #333;
                  line-height: 1.5;
                  padding: 10px;

                  -moz-border-radius-topright : 6px;
                  border-top-right-radius : 6px;
                  -moz-border-radius-topleft : 6px;
                  border-top-left-radius : 6px;
                  -moz-border-radius-bottomright : 6px;
                  border-bottom-right-radius : 6px;
                  -moz-border-radius-bottomleft : 6px;
                  border-bottom-left-radius : 6px;">
                <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" width="120" height="150" />
            </div>
        </td>
        <td width="300" valign="top">
            <font color="blue" size="4" face="arial, helvetica, sans-serif" color="#000000"><b><?= strtoupper($usuario->getCaNombres() . " " . $usuario->getCaApellidos()) ?></b></font><br /><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getCaCargo() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></b></font><br />
            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $usuario->getSucursal()->getCaNombre() ?></b></font>
        </td>
    </tr>
    <tr>
        <td width="25">
        <td colspan="5" >
            <font size="3" face="arial, helvetica, sans-serif" color="#000000">
            <br />
            Este mensaje es recordatorio que el pr&oacute;ximo <b><?= $fecha ?></b> nuestro colaborador cumplir&aacute; <?= $tiempo ?> a&ntilde;os de labores en <br/><b><?= $usuario->getSucursal()->getEmpresa()->getCaNombre() ?></b><br />
            <br />
            <br />
            <br />

            </font>
        </td>
    </tr></table></table>
    <?
} elseif ($asunto == "cumpleanos") {

    $timestamp = strtotime($fchingreso);
    $mes = date("m", $timestamp);
    $fecha = date("d", $timestamp) . " de " . Utils::mesLargo($mes);
    ?>                  
    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b></b></font></td>
    </tr></table></td></tr>
    <tr>
        <td align="center"><img src="http://www.coltrans.com.co/intranet/images/cumpleanos1.gif"></td>
        <?if($usuario->getSucursal()->getCaIdempresa()!=4){?>
        <td colspan="6" style="font-family: 'Bookman, serif';color:#062A7D;font-size:30px;font-style:oblique;"><b>El Grupo Empresarial Coltrans envía sus más sinceras felicitaciones</b></font></td>
        <?}else{?>
        <td colspan="6" style="font-family: 'Bookman, serif';color:#062A7D;font-size:30px;font-style:oblique;"><b>La familia Consolcargo envía sus más sinceras felicitaciones</b></font></td>
        <?}?>
    </tr>
    <tr></tr>
    <!-- INTRO -->
    <?
    $manana = 0;
    $pasado = 0;
    $posterior = 0;

    foreach ($users as $user) {
        $folder = "Usuarios/" . $user->getCaLogin() . "/foto120x150.jpg";
        $idempresa = $user->getSucursal()->getEmpresa()->getCaIdempresa();
        $logo = $user->getLogoHtml($idempresa);

        if (Utils::parseDate($user->getCaCumpleanos(), 'm-d') == date('m-d', time() + 86400)) {
            if ($manana == 0) {
                ?>
                <b>SABADO</b><br/>
                <?
                $manana = $manana + 1;
            }
        } elseif (Utils::parseDate($user->getCaCumpleanos(), 'm-d') == date('m-d', time() + 86400 * 2)) {
            if ($pasado == 0) {
                ?>
                <b>DOMINGO</b><br/>
                <?
                $pasado = $pasado + 1;
            }
        }
        ?>
        <tr>
            <td width="60">
                <div  align="center" style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                      border: 1px solid #EEE  ;
                      border-color: #EEE #EEE #DDD #EEE;
                      clear: both;
                      color: #333;
                      line-height: 1.5;
                      padding: 10px;

                      -moz-border-radius-topright : 6px;
                      border-top-right-radius : 6px;
                      -moz-border-radius-topleft : 6px;
                      border-top-left-radius : 6px;
                      -moz-border-radius-bottomright : 6px;
                      border-bottom-right-radius : 6px;
                      -moz-border-radius-bottomleft : 6px;
                      border-bottom-left-radius : 6px;">
                    <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" width="120" height="150" />
                </div>
            </td>
            <td width="350" valign="top">
                <font  size="4" face="arial, helvetica, sans-serif" color="#000000"><b style="text-decoration:underline;"><?= strtoupper($user->getCaNombres() . " " . $user->getCaApellidos()) ?></b></font><br /><br />
                <font color="#062A7D" size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?= $user->getSucursal()->getEmpresa()->getCaNombre() ?></b></font><br />
                <font color="gray"size="3" face="arial, helvetica, sans-serif" color="#000000"><?= $user->getCaCargo() ?></font><br />                            
                <font color="gray" size="3" face="arial, helvetica, sans-serif" color="#000000"><?= $user->getSucursal()->getCaNombre() ?></font>
            </td>
        </tr>
        <?
    }
    ?>
    </table>
    <?
}
?>
</table>
</body>
</html>