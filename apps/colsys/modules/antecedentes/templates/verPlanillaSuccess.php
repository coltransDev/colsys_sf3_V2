<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


if( $format!="email" ){
    include_component("gestDocumental", "widgetUploadButton");

?>

<script language="javascript" type="text/javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){
			document.getElementById('emailForm').style.display="inline"
		}else{
			document.getElementById('emailForm').style.display="none"
		}
	}
    <?
    if( $format!="maritimo" ){
    ?>
    Ext.onReady(function(){
        var wd = Ext.getBody().getWidth();


        var uploadButton = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Antecedentes/".$ref->getCaReferencia())?>",
            filePrefix: "MBL",
            update: "master_bl",
            confirm: true
        });
        uploadButton.render("button1");

        var uploadButton2 = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Antecedentes/".$ref->getCaReferencia())?>",
            filePrefix: "HBL",
            update: "hbl_defs",
            confirm: true
        });
        uploadButton2.render("button2");

       
     });
    <?
    }
    ?>

	

</script>
<?
}
?>


<div align="center">
    <h2>ENTREGA DE ANTECEDENTES</h2><br />
    <b>Fecha</b> <?=Utils::fechaLarga(date("Y-m-d"))?>
</div>
<div class="content">
    <?
    if( $format!="email" ){
    ?>
    <div id="emailForm"  style="display:none" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("antecedentes/enviarAntecedentes?ref=".str_replace(".","|",$ref->getCaReferencia()))?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />

        <?

        $asunto  = "Envio de Antecedentes ".$ref->getCaReferencia();
        $mensaje = "Adjunto encontrara las instrucciónes de embarque de la referencia ".$ref->getCaReferencia();
        //,"contacts"=>$contactos
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje));
        ?>
        <br />
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>

    </div>
    <?
    }
    ?>

    <table class="tableList alignLeft" width="100%">
         <tr>
             <th colspan="2">
                Datos Basicos
             </th>
         </tr>
         <tr>
            <td>
                <b>Referencia:</b> <?=$ref->getCaReferencia()?>
            </td>
            <td>
                <b>Master:</b> <?=$ref->getCaMbls()?>
<!--                 <b>Agente: </b> Pendiente-->
            </td>
        </tr>
        <tr>
            <td>
                <b>Naviera:</b> <?=$ref->getIdsProveedor()->getIds()->getCaNombre()?>
            </td>
            <td>
                <b>Motonave:</b> <?=$ref->getCaMotonave()?>
            </td>
            
        </tr>
        <tr>
            <td>
                <b>Origen:</b> <?=$ref->getOrigen()->getTrafico()->getCaNombre()." - ".$ref->getOrigen()->getCaCiudad()?>
            </td>
            <td>
                <b>Destino:</b> <?=$ref->getDestino()->getTrafico()->getCaNombre()." - ".$ref->getDestino()->getCaCiudad()?>
            </td>
        </tr>
        <tr>
            <td>
                <b>ETD: </b> <?=$ref->getCaFchembarque()?>
            </td>
            <td>
                <b>ETA</b> <?=$ref->getCaFcharribo()?>
            </td>            
        </tr>
        
        <tr>
            <td colspan="2">
                <b>Observaciones: </b><br />
                <?=$ref->getCaObservaciones()?>
            </td>

        </tr>
    </table>

    <?
    
    if( $format!="email" ){
    ?>
    <table class="tableList alignLeft" width="100%">
        <tr>
           <th colspan="2">
               Archivos
           </th>
        </tr>
        <tr>
            <td width="130px">
               <b>Imagen BL <?=$ref->getCaMbls()?>:</b>
               <div id="master_bl"><?=isset($filenames["MBL"])?link_to(basename($filenames["MBL"]["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($filenames["MBL"]["file"])):"<span class='rojo'>No se ha subido el archivo</span>"?></div>
               <div id="button1" ></div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td width="130px">
                <b>Imagen HBL Definitivos:</b>
                <div id="hbl_defs"><?=isset($filenames["HBL"])?link_to(basename($filenames["HBL"]["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($filenames["HBL"]["file"])):"<span class='rojo'>No se ha subido el archivo</span>"?></div>
               <div id="button2" ></div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
    </table>
    <?
    }
    ?>

    <table class="tableList alignLeft" width="100%">
        <tr>
            <th>
                Cliente
            </th>
             <th>
                Reporte
            </th>
            <th>
                Proveedor
            </th>
            <th>
                Peso
            </th>
            <th>
                CMB
            </th>
           
            <th>
                Vendedor
            </th>
        </tr>
        <?       
        foreach( $hijas as $hija ){
        ?>
        <tr>
            <td>
                <?=$hija->getCliente()->getCaCompania()?>
            </td>
            <td>
                <?
                if( $format=="email" ){
                    echo $hija->getReporte()->getCaConsecutivo()." V".$hija->getReporte()->getCaVersion();
                }else{
                    echo link_to($hija->getReporte()->getCaConsecutivo()." V".$hija->getReporte()->getCaVersion(), "/reportesNeg/verReporte?id=".$hija->getReporte()->getCaIdreporte(), array("target"=>"_blank"));
                }
                ?>
            </td>
            <td>
                <?=$hija->getTercero()->getCaNombre()?>
            </td>
            <td>
                <?=$hija->getCaPeso()?>
            </td>
            <td>
                <?=$hija->getCaVolumen()?>
            </td>
            
            <td>
                <?=$hija->getVendedor()->getCaNombre()?>
            </td>
        </tr>
        <?
        }
        ?>
        
    </table>
    <?
    if( count($emails)>0 && $format!="email" ){
    ?>
    <br />
    <br />
    <div align="center">
        <h2>Historial de envios</h2>
    <table class="tableList alignLeft">
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
                <td>
                <?=$email->getCaSubject()?></td>
                <td><?=$email->getCaAddress()?></td>

                <td>
                    <a href='#' onClick=window.open('<?=url_for("email/verEmail?id=".$email->getCaIdemail())?>')><?=image_tag("22x22/email.gif")?></a>
                </td>
            </tr>
            <?
        }
    ?>
    </table>
    </div>
    <?


}
?>

<?

if( $format=="maritimo" ){
?>
    <br /><br />

<div align="center">
   <?=image_tag("22x22/unlock.gif")?> <a href="<?=url_for("antecedentes/aceptarReferencia?ref=".  str_replace(".", "|", $ref->getCaReferencia()))?>">Haga click aca para desbloquear esta referencia y<br /> confirmar la aceptaci&oacute;n de esta referencia</a>
</div>
<?
}
?>
<br />
</div>