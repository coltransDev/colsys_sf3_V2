<?
use_helper("MimeType");
$reportes = $sf_data->getRaw("reportes");
?>
<div class="content" >
    <form action="<?=url_for("traficos/enviarCorreoTraficos?reporte=".$consecutivo)?>" method="post">
        <input type="hidden" name="idcliente" id="idcliente" value="<?=$idCliente?>" />
        <input type="hidden" name="modo" id="modo" value="<?=$modo?>" />

        <div align="left">
            <?
            $subject=Utils::fechaMes(date("Y-m-d")). " - CUADRO DE SEGUIMIENTOS - ".$cliente->getCaCompania();
            $message="Se?ores\n\n".$cliente->getCaCompania()."\n".$cliente->getCiudad()."\n\n";
            $hora = date("G");
            if( $hora <12 ){
                $message.="Buenos dias,";
            }elseif($hora <19){
                $message.="Buenas tardes,";
            }else{
                $message.="Buenas noches,";
            }	
            $message.="\n\nRemitimos  cuadro de seguimientos con status de las cargas que estamos manejando actualmente.";
            $message.="\n\nQuedamos a  su  entera  disposici?n  para  atender  cualquier inquietud adicional.";
            $message.="\n\nReciban un cordial saludo,\n\n";
            $message.=$usuario->getFirma();

            $contactos =  $cliente->getCaConfirmar();

            if($user->getEmail()=="sercliente-mar1@coltrans.com.co" || $user->getEmail()=="sercliente-mar2@coltrans.com.co" || $user->getEmail()=="sercliente-mar3@coltrans.com.co"|| $user->getEmail()=="sercliente-mar4@coltrans.com.co"|| $user->getEmail()=="sercliente-mar5@coltrans.com.co" ){			
                $from = array('sercliente-mar1@coltrans.com.co'=>'sercliente-mar1@coltrans.com.co', 'sercliente-mar2@coltrans.com.co'=>'sercliente-mar2@coltrans.com.co', 'sercliente-mar3@coltrans.com.co'=>'sercliente-mar3@coltrans.com.co', 'sercliente-mar4@coltrans.com.co'=>'sercliente-mar4@coltrans.com.co', 'sercliente-mar5@coltrans.com.co'=>'sercliente-mar5@coltrans.com.co');
            }else{
                $from=array();
            }

            include_component("email", "formEmail", array("subject"=>$subject, "message"=>$message, "contacts"=>$contactos, "from"=> $from ));
            ?>
        </div>
        <br /><br />
        <table width="50%" border="0" cellspacing="0" cellpadding="0" class="tableForm">
            <tr>
                <td>
                    <div align="left" style="border:1px solid #b5b8c8;">
                        <b>Por favor seleccione el archivo de excel que desea adjuntar en el correo.</b><br/>
                        <input type="radio" name="informeExcel" value="informeTraficosFormato1" checked='checked'><img src="/images/22x22/kchart_chrt.gif" style="cursor: pointer" onclick="" /> Informe en Excel convencional<br>
                        <input type="radio" name="informeExcel" value="informeTraficosFormato2"><img src="/images/22x22/excel.gif" style="cursor: pointer" onclick="" /> Informe en Excel por tr?ficos<br>
                    </div>
                </td>
            </tr>
        </table>
        <div align="left"><br>
            <b>Adjuntos asociados a los reportes</b><br /><br />
        </div>

        <table width="100%" border="1" class="tableList" id="lista">
            <tr>
                <th scope="col"><div align="left">Fecha Rep </div></th>
                <th scope="col"><div align="left">Reporte</div></th>
                <th scope="col"><div align="left">Origen</div></th>
                <th scope="col"><div align="left">Destino</div></th>
                <th scope="col"><div align="left">Proveedor</div></th>
                <th scope="col"><div align="left">CNEE</div></th>
            </tr>
        <?
            foreach( $reportes as $reporte ){
                if( !$reporte->esUltimaVersion() ){
                        continue;
                }
                $files = $reporte->getFiles();
                if( count($files) ){			
                    $class= $reporte->getColorStatus();			
                    ?>
                    <tr class="<?=$class?>" id="tr_<?=$reporte->getCaIdreporte()?>" onclick="actualizar('<?=$reporte->getCaIdreporte()?>')" >
                        <td><div align="left">
                            <?=$reporte->getCaFchreporte()?>
                        </div></td>
                        <td><div align="left">
                            <?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?>
                        </div></td>
                        <td><div align="left">
                            <?=Utils::replace($reporte->getOrigen()->getCaCiudad())?>
                        </div></td>
                        <td><div align="left">
                            <?=Utils::replace($reporte->getDestino()->getCaCiudad())?>
                        </div></td>
                        <td><div align="left">
                            <?=$reporte->getProveedoresStr()?>
                        </div></td>
                        <td><div align="left">
                            <?=$reporte->getConsignatario()?>
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"  > 
                            <div align="left"><b>Adjuntar documento :</b><br />
                                <?			
                                foreach( $files as $file ){
                                    //$fileIdx = $user->addFile( $file );                                    
                                    ?>
                                    <input type="checkbox" name="attachments[]" value="<?=$reporte->getCaIdreporte()."_".base64_encode(basename($file))?>" />
                                    <?
                                    echo mime_type_icon( basename($file) )." ".link_to(basename( $file ), url_for("traficos/fileViewer?idreporte=".$reporte->getCaIdreporte()."&file=".base64_encode(basename($file)) ) )."<br />";				
                                }
                                // Archivos ubicados en directorio de Gestion Documental    
                                $referencia = $reporte->getNumReferencia();
                                if($referencia){
                                    $archivos = $reporte->getFilesGestDoc();
                                    if(count($archivos)){
                                        foreach( $archivos as $file ){
                                            $filename = $file->getCaNombre();                                             
                                            ?>
                                                <input type="checkbox" name="attachments1[]" value="<?=$reporte->getCaIdreporte()."_".base64_encode(basename($filename))?>" />
                                            <?
                                                echo mime_type_icon( basename($filename) )." ".link_to(basename( $filename ), url_for("traficos/fileViewer?idreporte=".$reporte->getCaIdreporte()."&gestDoc=true&file=".base64_encode(basename($filename))) )."<br />";
                                        }                                        
                                    }
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                <?
                }
            }
        ?>
        </table><br />
        <div align="center"><input type="submit" class="button" value="Enviar" /></div>
    </form><br />
    <?
    if( count($emails)>0 ){
    ?>
    <br />
    <br />
    <table class="tableList">
        <tr >
            <th>Fecha Envio</th>
            <th>Asunto</th>
            <th>Destinatarios</th>
            <th>Email</th>
        </tr>
        <?
        foreach( $emails as $email ){
            ?>
            <tr >
                <td><?=$email->getCaFchenvio()?></td>
                <td><?=$email->getCaSubject()?></td>
                <td><?=$email->getCaAddress()?></td>
                <td><a href='<?=url_for("email/verEmail?id=".$email->getCaIdemail())?>' target="_blank"><?=image_tag("22x22/email.gif")?></a></td>
            </tr>
            <?
        }
    ?>
    </table>
    <?
}
?>
</div>
