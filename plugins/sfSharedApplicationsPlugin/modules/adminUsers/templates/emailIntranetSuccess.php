<html>
<body>
<style type="text/css" >
img.img{
    border: 0px;
}
a.link:link {
    text-decoration:none;
    color:#0000FF;
}
a.link:active {
    text-decoration:none;
    color:#0000FF;
}
a.link:visited {
    text-decoration: none;
    color: #062A7D;
}

.entry {
    border-bottom: 1px solid #DDDDDD;
    clear:both;
    padding: 0 0 10px;
}


.entry-even {
    background-color:#F6F6F6;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}

.entry-odd {
    background-color:#FFFFFF;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}

.entry-yellow {
    background-color:#FFFFCC;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}
.entry-red {
    background-color:#FDA2A2;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}
.entry-orange {
    background-color:#D99324;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}
.entry-blue {
    background-color:#E3F8FB;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;

}
.entry-date{
    float: right;
    color: #0464BB;
}
div.box1 {
    background: #F0F0F0 url(../images/bg_newsitem.png) repeat-x;
    border: 1px solid #EEE;
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
    border-bottom-left-radius : 6px;

}


div.box1 .title {
    color: #2A337C;    
    padding: 3px 4px;
}
div.box1 .body {
    
    font-size: 0.9em;
    text-align: justify;
}
</style>

<table width="80%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
    <!-- WHITE BACKGROUND -->
    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                <!-- MAIN CONTENT TABLE -->
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <!-- LOGO -->
            <tr><td colspan="3"><table><tr><td><img src="<?=$logo?>" />
<?
        if($asunto=="ingreso"){
            $folder="Usuarios/".$usuario->getCaLogin()."/foto120x150.jpg";
?>
            <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Nuevo Colaborador</b></font></td></tr></table></td></tr>
                    <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="4"><hr noshade size="1"></td></tr>
                    <!-- INTRO -->
                    <tr>
                        <td width="25">
                        <td width="110">
                                <div class="box1" align="center">
                                    <img style=" vertical-align: middle;" src="https://www.coltrans.com.co/gestDocumental/verArchivoLibreClave?idarchivo=<?=base64_encode($folder) ?>" width="120" height="150" />
                                </div>
                        </td>
                        <td width="300" valign="top">
                            <font color="blue" size="4" face="arial, helvetica, sans-serif" color="#000000"><b><?=  strtoupper($usuario->getCaNombres()." ".$usuario->getCaApellidos())?></b></font><br /><br />
                            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?=$usuario->getCaCargo()?></b></font><br />
                            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?=$usuario->getSucursal()->getEmpresa()->getCaNombre()?></b></font><br />
                            <font size="3" face="arial, helvetica, sans-serif" color="#000000"><b><?=$usuario->getSucursal()->getCaNombre()?></b></font>
                        </td>
                    </tr>
                    <tr>
                        <td width="25">
                        <td colspan="5" >
                            <font size="3" face="arial, helvetica, sans-serif" color="#000000">
                                <br />
                                &#9885; LE DAMOS LA MAS CORDIAL BIENVENIDA Y LE DESEAMOS MUCHO EXITO EN SU GESTION.<br />
                                <br />
                                <br />

                            </font>
                        </td>
                    </tr></table></table>
            <?
        }elseif ($asunto=="address") {
?>
            <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Cambio de Dirección</b></font></td></tr></table></td></tr>
            <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
            <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                <tr>
                    <td width="200" valign="top" colspan="2">
                        <font color="blue" size="3" face="arial, helvetica, sans-serif" color="#000000"><b>Colaborador: <?=  strtoupper($usuario->getCaNombres()." ".$usuario->getCaApellidos())?></b></font><br /><br />
                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal: <?=$usuario->getSucursal()->getCaNombre()?></b></font><br />
                    </td>
                </tr>
                <tr>
                    <td width="200" valign="top">
                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Direccion Antigua: <?=$direccion?></b></font><br />
                    </td>
                    <td width="200" valign="top">
                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Direccion Nueva: <?=$usuario->getCaDireccion()?></b></font><br />
                    </td>
                </tr>
              </table>
<?
        }elseif ($asunto=="desvinculacion") {
?>
            <tr><td colspan="3">
                    <table><tr><td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Desvinculación Colaborador</b></font></td></tr></table></td></tr>
            <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
            <table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
                <tr>
                    <td width="200" valign="top" colspan="2">
                        <font color="blue" size="3" face="arial, helvetica, sans-serif" color="#000000"><b>Colaborador: <?=  strtoupper($usuario->getCaNombres()." ".$usuario->getCaApellidos())?></b></font><br /><br />
                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Sucursal: <?=$usuario->getSucursal()->getCaNombre()?></b></font><br />
                    </td>
                </tr>
                <tr>
                    <td width="200" valign="top">
                        <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>El sistema informa que éste colaborador ha quedado inactivo en Colsys. <br />Favor revisar que los permisos en ISO Q se han retirado exitosamente</b></font><br />
                    </td>
                </tr>
              </table>
<?
        }
?>
    </table>
</table>

