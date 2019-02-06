<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$master = $sf_data->getRaw("master");
$titulo = $sf_data->getRaw("titulo");
$intro_body = $sf_data->getRaw("intro_body");
$email_body = $sf_data->getRaw("email_body");
$datos = $sf_data->getRaw("datos");

?>

<html>
    <body>
        <!-- MAIN CONTENT TABLE -->
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <!-- LOGO -->
            <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.colsys.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><?= $titulo ?><br/><?= (($fchsyga) ? "Fecha finalizaci&oacute;n MUISCA : " . $fchsyga : "") ?></font></td></tr></table></td></tr>
            <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
            <!-- INTRO -->
            <tr>
                <td>&nbsp;</td><td>
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b><b>Origen :</b><?= $master->getOrigen()->getCaCiudad() ?></font><br />
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Nombre del Buque :</b><?= $datos["mnllegada"] ?></font><br />
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Bandera :</b><?= $datos["bandera"] ?></font><br /><br />

                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Destino :</b><?= $master->getDestino()->getCaCiudad() ?></font><br />
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fch.Llegada :</b><?= $master->getInoMasterSea()->getCaFchconfirmacion() ?> - <?= $master->getInoMasterSea()->getCaHoraconfirmacion() ?> </font><br />                

                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Reg.Aduanero :</b><?= $datos["registroadu"] ?></font><br />
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fch.Registro :</b><?= $datos["fchregistroadu"] ?></font><br />
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><br /><br />

                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha Vaciado :</b><?= $master->getInoMasterSea()->getCaFchvaciado() ?> - <?= $master->getInoMasterSea()->getCaHoravaciado() ?></font><br />
                <!--<font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha. Desconsolidacion :</b><?= $master->getInoMasterSea()->getCaFchdesconsolidacion() ?></font><br />-->
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Muelle</b>: <?= $master->getInoMasterSea()->getCaIdmuelle() . " - " . $muelle->getCaValor() ?></font><br />

                <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                    <?= $intro_body ?><br />
                    <?= $email_body ?><br />
                    La información ha sido registrada en el sistema, favor proceder a informar a los clientes.<br/>
                    Cordial Saludo.<br /><br />
                    <?
                        $sucursal = $usuario->getSucursal();
                        $empresa = $sucursal->getEmpresa();
                        $resultado = "<strong>" . Utils::replace(strtoupper($usuario->getCaNombre())) . "</strong><br />";
                        $resultado .= $usuario->getCaCargo() . "-" . strtoupper($empresa->getCaNombre()) . "<br />";

                        if ($sucursal) {
                            $resultado .= $sucursal->getCaDireccion() . "<br />";
                            $resultado .= "Tel.: " . $sucursal->getCaTelefono() . " " . $usuario->getCaExtension() . "<br />";
                            $resultado .= "Fax.: " . $sucursal->getCaFax() . "<br />";
                        }
                        $resultado .= Utils::replace($sucursal->getCaNombre()) . "-" . $empresa->getTrafico()->getCaNombre() . "<br />";
                        $resultado .= "<a href=\"http://" . $empresa->getCaUrl() . "\">" . $empresa->getCaUrl() . "</a>";
                        echo $resultado;
                    ?>
                </div>
            </td></tr>
        </table>
    </body>
</html>