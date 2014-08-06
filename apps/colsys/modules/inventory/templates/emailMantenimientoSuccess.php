<?
$i=0;
foreach( $mantenimientos as $mantenimiento ){
    if($mantenimiento&&$i==0){
        $activo = $mantenimiento->getInvActivo()->getCaIdentificador();
        $marca = $mantenimiento->getInvActivo()->getCaMarca();
        $modelo = $mantenimiento->getInvActivo()->getCaModelo();
        $login_asig = $mantenimiento->getInvActivo()->getUsuario()->getCaLogin();
        $asignacion = $mantenimiento->getInvActivo()->getUsuario()->getCaNombre();
        $fchmantenimiento = Utils::fechaLarga($mantenimiento->getCaFchmantenimiento());
        $observaciones = str_replace("\n","<br />",$mantenimiento->getCaObservaciones());
        $fchfirma = $mantenimiento->getCaFchfirma();
        $firma = $mantenimiento->getUsuFirma()->getCaNombre();
        $firmado = $mantenimiento->getCaFirmado();
        $idman = $mantenimiento->getCaIdmantenimiento();
        
?>
<html>
<body>
<!-- GREY BORDER -->
<table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
    <!-- WHITE BACKGROUND -->
    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF">
        <tr><td>
                <!-- MAIN CONTENT TABLE -->
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <!-- LOGO -->
            <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.coltrans.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                            <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"><b>Mantenimiento Preventivo</b></font></td></tr></table></td></tr>
            <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
            <!-- INTRO -->
            <tr>
                <td>&nbsp;</td>
                <td>
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Activo # <?=$activo.": ".$marca.'-'.$modelo ?></b></font><br />
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Fecha de Mantenimiento:</b> <?=$fchmantenimiento?></font><br />
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Equipo asignado a:</b> <?=$asignacion?></font><br />
                    <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Mantenimiento realizado por: </b> <?=$mantenimiento->getUsuario()->getCaNombre() ?></font><br />

                    <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px ;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                        <div style="float:right; color: #0464BB;"><?=Utils::fechaMes($mantenimiento->getCaFchcreado())?></div>
                            <b><?=($mantenimiento->getUsuario()?$mantenimiento->getUsuario()->getCaNombre():$mantenimiento->getCaUsucreado())?></b><br /><br />
                            El día <b><?=$fchmantenimiento?></b> se efectuó Mantenimiento Preventivo en el equipo en referencia.<br /><br />
<?
                            $labores =$mantenimiento->getInvMantenimientoLabores();
                            $j = 1;
                            foreach($labores as $labor){
                                if($labor &&$j==1){
?>
                                    Labores realizadas: <br />
<?
                                }
                                $etapas = $labor->getInvMantenimientoEtapas()->getCaEtapa();
                                echo '  '.$j.'.  '.$etapas.'<br />';
                                $j++;
                            }
                            if($observaciones){
?>
                                <br />Por favor tener en cuenta las siguientes observaciones:<br /><br />
<?
                                echo '-'.$observaciones.'<br />';                  
                            }
                            if($anotaciones){
                                $i=1;
                                foreach($anotaciones as $anotacion){
                                    if($anotacion->getCaIdmantenimiento()==$mantenimiento->getCaIdmantenimiento()){
                                        if($i==1){
?>
                                            <br />
                                                <div style="background-color:#FFFFCC;border-color:#CCCCCC;border-style:dotted;border-width:1px;padding:10px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                                <h3>Anotaciones adicionales:</h3><br />
<?
                                        }
?>
                                                <div style="float:right; color: #0464BB;"><?=Utils::fechaMes($anotacion->getCaFchcreado())?></div>
                                                &nbsp;<b><?=$anotacion->getUsuario()->getCaNombre()?> : </b>
<?
                                                echo $anotacion->getCaAnotacion()."<br />";
                                                $i++;
                                    }
                                }
?>      
                                            </div>
<?   
                            }   
?>
                    </div>
<?
                    if(!$respuesta){
                        if($recordatorio){
?>  
                    <div style="background-color:#E3F8FB;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                            <b>Recordatorio:</b><br /><br />
                            Agradecemos su colaboración para la firma de este documento ya que es indispensable para el registro de esta labor.<br />
                            Para firmar, por favor escoja la opción en la sección de <b>Evaluacion</b>. El sistema le dirigirá a Colsys y se completará el proceso.<br />
                        </div>
<?
                        }
?>
                        <div style="background-color:#F6F6F6;border-color:#CCCCCC;border-style:dotted;border-width:1px ;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                            <b>Evaluacion:</b><br /><br />
                            Para evaluar la calidad de nuestro servicio por favor notificar si está de acuerdo con el mantenimiento realizado en su equipo dando click en la opción de su preferencia.<br /><br />
                            <table>
                                <tr>
                                    <td>
                                        <div>
                                            <a href='https://www.coltrans.com.co<?=url_for("inventory/emailMantenimiento?idactivo=".$idactivo.'&idman='.$idman.'&respuesta=si')?>'><font color="blue"><u><h2>Acepto</h2></u></font></a>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td>
                                        <div>
                                            <a href='https://www.coltrans.com.co<?=url_for("inventory/emailMantenimiento?idactivo=".$idactivo.'&idman='.$idman.'&respuesta=no')?>'><font color="blue"><u><h2>No acepto</h2></u></font></a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
<?
                    }
                    if($respuesta=="si"){
                        if($user==$login_asig){
                            if($fchfirma == NULL){
                                $mantenimiento->setCaFchfirma(date("Y-m-d"));
                                $mantenimiento->setCaFirma($user);
                                $mantenimiento->setCaFirmado("firmado");
                                $mantenimiento->save();
?>
                                <div style="background-color:#FFFFCC;border-color:#CCCCCC;border-style:dotted;border-width:1px;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    <b>Firma Digital,<br /><br /><br />
                                    <font color="blue"><u><?=$usuario->getCaNombre()?></u></font></b><br />
                                    <font color="blue"><?=date('Y-m-d')?></font><br /><br />
                                    Damos por hecho que se ha realizado correctamente el Mantenimiento Preventivo y usted de encuentra conforme con esta labor. <br />
                                    Esta aceptación será valida como firma de Registro de mantenimiento.<br />

                                    Gracias.<br />
                                    Cordialmente: <br />
                                    DEPARTAMENTO DE SISTEMAS
                                </div>
<?
                            }else{
?>
                                <div style="background-color:#D99324;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    Este documento ya fue firmado por <font color="blue"><u><?=$usuario->getCaNombre()?></u></font></b> , el día <?=$fchfirma?> <br />
                                    Cualquier requerimiento, por favor comunicarse con este usuario.
                                </div>
<?
                            }
                        }else{
?>        
                            <div style="background-color:#FDA2A2;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                <b>Error en la firma<br /><br /><br />
                                Este documento solo puede ser firmado por la persona a la cuál está asignada la máquina.<br />
                                Gracias.<br />
                                Cordialmente: <br />
                                DEPARTAMENTO DE SISTEMAS
                            </div>
<?              
                        }
                    }
                    if($respuesta=="no"){
                        if($user==$login_asig){
                            if($fchfirma == NULL){
                                $mantenimiento->setCaFchfirma(date("Y-m-d"));
                                $mantenimiento->setCaFirma($user);
                                $mantenimiento->setCaFirmado("noaceptado");
                                $mantenimiento->save();
?>
                                <div style="background-color:#FDA2A2;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    <b>ESTE DOCUMENTO NO HA SIDO FIRMADO</b> <br /><br />

                                    De acuerdo a su elección, por favor indiquenos las razones por las cuáles no está conforme con el mantenimiento realizado en su equipo. <br />
                                    Las tomaremos como referencia para mejorar el servicio y evaluaremos la opción de programar un nuevo mantenimiento.<br />

                                    Gracias.<br /><br/>
                                    Cordialmente: <br /><br/>
                                    DEPARTAMENTO DE SISTEMAS<br>
                                </div>
                                <div style="background-color:#FFFFFF;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    <form action="<?=url_for("inventory/guardarAnotacion?fuente=email&idactivo=$idactivo&idmantenimiento=$idman")?>" method="post">
                                        <b>Observaciones Mantenimiento</b><br /><br /> 
                                        <textarea name="text-anotacion" style="width:500px" rows="5">El mantenimiento no fue aceptado
Razones:
1. 
                                        </textarea><br />
                                        <input type="submit" value="Guardar" />
                                        </form>
                                </div>
<?  
                            }elseif($firmado=="firmado"){
?>    
                                <div style="background-color:#D99324;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    Este documento ya fue firmado por <font color="blue"><u><?=$usuario->getCaNombre()?></u></font></b> , el día <?=$fchfirma?> <br />
                                    Cualquier requerimiento, por favor comunicarse con este usuario.
                                </div>
<?  
                            }elseif($firmado=="noaceptado"){
?>    
                                <div style="background-color:#D99324;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                    Este documento NO FUE ACEPTADO por <font color="blue"><u><?=$usuario->getCaNombre()?></u></font></b> , el día <?=$fchfirma?> <br />
                                    El departamento está evaluando las inconformidades y aplicará los correctivos necesarios si así aplica.
                                </div>
<?    
                            }
                        }else{
?>        
                            <div style="background-color:#FDA2A2;border-color:#CCCCCC;border-style:dotted;border-width:1px;margin:12px 0 0;padding:12px 12px 24px;font-size: 12px;font-family: arial, helvetica, sans-serif;">
                                <b>Error en la firma<br /><br /><br />

                                Este documento solo puede ser firmado por la persona a la cuál está asignada la máquina.<br />

                                Gracias.<br />
                                Cordialmente: <br />
                                DEPARTAMENTO DE SISTEMAS
                            </div>
<?              
                        }
                    }
?>
                </td>
                <td width="50"><img src="https://www.coltrans.com.co/images/spacer.gif" width="75" height="1" alt=""></td></tr>
            <tr><td>&nbsp;</td>
                <td>
                    <font size="1" face="arial, helvetica, sans-serif" color="#000000">Coltrans S.A. - Colmas Ltda. Agencia de Aduanas Nivel 1<br>
                        <a href="https://www.coltrans.com.co/">http://www.coltrans.com.co/</a>
                    </font>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table></td></tr>
    </table></td></tr>
    <!-- COPYRIGHT -->
    <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1. Colotm S.A.S.</font></td></tr>
</table>

<img src="https://www.coltrans.com.co/images/spacer.gif" style="width:1px; height:1px;"/>
</body>
<script>
    loadhtml = function ()
    {
        
    }
</script>
</html>
<?
    }
}
?>