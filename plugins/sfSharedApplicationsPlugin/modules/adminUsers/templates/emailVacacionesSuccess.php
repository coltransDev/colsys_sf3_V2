<?
$folder = "Usuarios/" . $usuario->getCaLogin() . "/foto120x150.jpg";
$mensajeInicial = $encargado1?"En mi ausencia estará para apoyarlo <span style='font-weight: bold; '>".$encargado1->getCaNombre()."</span> al correo <span style='font-weight: bold; '>".$encargado1->getCaEmail()."</span>, teléfono  <span style='font-weight: bold; '>".$encargado1->getSucursal()->getCaTelefono()." Ext. ".$encargado1->getCaExtension()."</span>":"";
$mensajeInicial.=$encargado2?" y/o <span style='font-weight: bold; '>".$encargado2->getCaNombre()."</span> al correo <span style='font-weight: bold; '>".$encargado2->getCaEmail()."<span>, teléfono: <span style='font-weight: bold; '>".$encargado2->getSucursal()->getCaTelefono()." Ext. ".$encargado2->getCaExtension().".</span><br/>":"<br/>";                                        
$contenido = $mensaje?$mensajeInicial."<br/>".utf8_decode(htmlspecialchars_decode($mensaje)):$mensajeInicial;
?>
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
                                <td><div  style="background:#F0F0F0 url(../images/bg_newsitem.png) repeat-x;
                                    border: 1px solid #EEE  ;
                                    border-color: #EEE #EEE #DDD #EEE;
                                    clear: both;
                                    color: #333;
                                    line-height: 1.5;
                                    padding: 2px 2px 5px 2px;

                                    -moz-border-radius-topright : 6px;
                                    border-top-right-radius : 6px;
                                    -moz-border-radius-topleft : 6px;
                                    border-top-left-radius : 6px;
                                    -moz-border-radius-bottomright : 6px;
                                    border-bottom-right-radius : 6px;
                                    -moz-border-radius-bottomleft : 6px;
                                    border-bottom-left-radius : 6px;">
                                        <table>
                                            <tr>
                                                <td><div style="padding: 5px;"><img src="<?=$logo?>" /></div></td>
                                                <td><p style="font-style: oblique; font-size: 12px; font-weight: bold;"><?=$usuario->getCaNombre()?> en Vacaciones</p></td>
                                            </tr>                                            
                                        </table>                                    
                                    <div align="center"><img style=" vertical-align: middle;" src="http://www.coltrans.com.co/intranet/images/fotovacaciones.jpg" height="150" />
                                    <img style=" vertical-align: middle;" src="https://www.colsys.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?= base64_encode($folder) ?>" height="150" /></div>
                              </div></td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-style: oblique; font-size: 18px; color:#2F3686; text-align: justify;">
                                        No importa que tan lejos vayamos. Siempre habrá alguien pensando en usted para brindarle la atención que se merece.
                                    </p>
                                    <span style="font-style: oblique !important; font-size: 16px !important; ">
                                        <p style="text-align: justify;">
                                            Estaré de descanso desde el <b><?=$from?></b> hasta el <b><?=$to?></b>, retomando mi labor el <b><?=$returnDate?>.</b>
                                        </p>
                                        <p style="text-align: justify;">
                                            <?=$contenido?><br/>                                            
                                        </p>
                                        <p style="text-align: justify;">
                                            Recuerde que nuestro compromiso es con usted, por lo cual lo atenderemos en el menor tiempo posible.
                                        </p>
                                    </span><br/>
                                    <span style="font-style: oblique; font-size: 16px; text-align: justify;">
                                        <?=$usuario->getCaNombre()?><br/><span>
                                    <span style="font-style: oblique; font-weight: bold; font-size: 16px;">
                                        <?=$usuario->getCaCargo()?><br/>
                                        <?=$usuario->getSucursal()->getCaNombre()?><br/>
                                    </span>
                                </td>                                
                            </tr>
                        </table>
                    </td>
                </tr>              
            </table>
        </table>
    </body>
</html>