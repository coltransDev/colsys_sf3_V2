<?
//echo $tipo;


?>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
    <!-- LOGO -->
    <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.coltrans.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"></font></td></tr></table></td></tr>
    <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
    <!-- INTRO -->
    <tr>
        <td>&nbsp;</td>
        <td >
<?
            if($tipo=="AG")
            {
                $mensaje_comercial = $sf_data->getRaw("mensaje_comercial");
                $reporte = $sf_data->getRaw("reporte");
                $agente = $sf_data->getRaw("agente");
                $trayecto = $sf_data->getRaw("trayecto");
                $proveedor = $sf_data->getRaw("proveedor");

?>
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>No:<?=$reporte->getCaConsecutivo()?></b></font><br />
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Agente:</b><?=$agente?></font><br />
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Trayecto:</b><?=$trayecto?></font><br />
                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Proveedor:</b><?=$proveedor?></font><br />
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Cliente:</b><?=$reporte->getContacto()->getCliente()->getCaCompania().' - '.$reporte->getCaOrdenClie()?></font><br />
            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Mercancia:</b><?=$reporte->getCaMercanciaDesc()?></font><br />



            <div ><font size="2" face="arial, helvetica, sans-serif" color="#000000"><?=$mensaje_comercial?></font></div>

<?
            }
            if($tipo=="CIERRE")
            {
                echo "<div>Se Cerraron los siguientes Reportes de negocios</div><div>";
                foreach($reportes as $rep)
                {
?>
                <div style="float: left; width: 10%"><?=$rep?></div>
<?
                }
                echo "</div>";
            }
?>
         </td>
    </tr>

    <tr><td colspan="2"><hr noshade size="1"></td></tr>
    <tr><td>&nbsp;</td><td>
            <font size="1" face="arial, helvetica, sans-serif" color="#000000"> <br>Coltrans S.A. - Colmas Ltda. Agencia de Aduanas Nivel 1<br>
                <a href="https://www.coltrans.com.co/">http://www.coltrans.com.co/</a>
            </font>
        </td>

        <td>&nbsp;</td>
    </tr>
</table>