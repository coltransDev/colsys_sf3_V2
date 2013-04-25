<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if( $format!="email" ){
?>
<script language="javascript" type="text/javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){
			document.getElementById('emailForm').style.display="inline";
		}else{
			document.getElementById('emailForm').style.display="none";
		}
	}
</script>
<?
}
?>

<div align="center">
    <h2>ENTREGA DE ANTECEDENTES</h2><br/>
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
        
        foreach( $hijas as $hija ){
            if($hija->getReporte()->getCaDeclaracionant()==true){
                $da = " (***Declaración Anticipada***)";
                break;
            }
        }
        
        $asunto  = "Envio de Antecedentes ".$ref->getCaReferencia().$da;
        $mensaje = "Adjunto encontrará los antecedentes de la referencia ".$ref->getCaReferencia();
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos,"contacts1"=>$contactos1,"nameContacts1"=>"Contactos Aduana"));
        
        ?>
        <br />
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>

    </div>
    <?
    }
    //$master=$ref->getCaMbls();
    ?>
    <table class="tableList alignLeft" width="100%">
         <tr>
             <th colspan="3">
                Datos Basicos
             </th>
         </tr>
         <tr>
            <td>
                <b>Referencia:</b> <?=$ref->getCaReferencia()?>
            </td>
            <td>
                <b>Master:</b> <?=$ref->getCaMbls()?>
            </td>
            <td>
                <b>Fecha Master:</b> <?=$ref->getCaFchmbls()?>
            </td>
        </tr>

        <tr>
            <td>
                <b>Naviera:</b> <?=$ref->getIdsProveedor()->getIds()->getCaNombre()?>
            </td>
            <td>
                <b>Motonave:</b> <?=$ref->getCaMotonave()?>
            </td>
           <td>
                <b>No Viaje:</b> <?=$ref->getCaCiclo()?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Origen:</b> <?=$ref->getOrigen()->getTrafico()->getCaNombre()." - ".$ref->getOrigen()->getCaCiudad()?>
            </td>
            <td>
                <b>Destino:</b> <?=$ref->getDestino()->getTrafico()->getCaNombre()." - ".$ref->getDestino()->getCaCiudad()?>
            </td>
            <td>
            <?if($ref->getCaTipo()){?>
                <b>Tipo:</b> <?=$ref->getCaTipo()?>
            <?}else{?>
                &nbsp;
            <?}?>
            </td>
        </tr>
        <tr>
            <td>
                <b>ETD: </b> <?=$ref->getCaFchembarque()?>
            </td>
            <td>
                <b>ETA</b> <?=$ref->getCaFcharribo()?>
            </td>
            <td><b>Emisión BL Master:</b> <?=$ref->getCaEmisionbl()?></td>
        </tr>        
        <tr>
            <td colspan="2">
                <b>Observaciones: </b><br />
                <?=$ref->getCaObservaciones()?>
            </td>

        </tr>
    </table>

    <?
    
    if( $format!="email" )
    {
        include_component("antecedentes", "fileManager", array("ref"=>$ref));
    }
    else
    {
?>
         <table class="tableList alignLeft" width="100%">         
         <tr>
            <th>Archivos Adjuntados</th>
         </tr>
         <tr><td>
<?
        foreach($filenames as $file)
        {
            echo $file["file"]."<br>";
        }
?>
        </td></tr>
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
                HBL
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
                Piezas
            </th>
            <th>
                CMB
            </th>
           
            <th>
                Vendedor
            </th>

            <th>
                Hbls Dest.
            </th>
        </tr>
        <?
        $tpeso=0;
        $tvolumen=0;
        $tpiezas=0;
        $fechaAnt="";
        foreach( $hijas as $hija ){
            if($fechaAnt=="")
                $fechaAnt=$hija->getCaFchantecedentes();
                $tpeso+=$hija->getCaPeso();
                $tvolumen+=$hija->getCaVolumen();
                $tpiezas+=$hija->getCaNumpiezas();
        ?>
        <tr style="background-color: <?echo ($hija->getReporte()->getCaDeclaracionant()==true)?"#f94949":"white"?>">
            <td>
                <?=$hija->getCliente()->getCaCompania()?>
            </td>
             <td>
                <?=$hija->getCaHbls()?>
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
            <td align="right" >
                <?=number_format($hija->getCaPeso(),3)?>
            </td>
            <td align="right" >
                <?=number_format($hija->getCaNumpiezas(),3)?>
            </td>
            <td align="right">
                <?=number_format($hija->getCaVolumen(),3)?>
            </td>
            <td>
                <?=$hija->getVendedor()->getCaNombre()?>
            </td>
            <td>
                <?=($hija->getCaImprimirorigen()?"Sí":"No")?>
            </td>
        </tr>
        <?
        }
        ?>
        <tr style="border: #000000 2px solid">
            <td colspan="4">
                Totales: <?=count($hijas)?> registros
            </td>
            <td align="right" >
                <?=number_format($tpeso,3)?>
            </td>
            <td align="right" >
                <?=number_format($tpiezas,3)?>
            </td>
            <td align="right">
                <?= number_format($tvolumen,4)?>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        
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

<br />
<?
    $usuario = $ref->getUsuCreado();
    $sucursal = $usuario->getSucursal();
?>
<table cellspacing="0" width="100%" class="tableList alignLeft">
        <tbody>
            <tr class="row0">
                <td width="25%">
                    <div align="left">
                        <b>Ciudad:</b><br />
                        <?=$sucursal?$sucursal->getCaNombre():"&nbsp;"?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Elaborado por:</b><br />
                        <?=$ref->getCaUsucreado()?> <?=UTils::fechaMes($ref->getCaFchcreado())?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Actualizado por:</b><br />
                        <?=$ref->getCaUsuactualizado()?$ref->getCaUsuactualizado():"&nbsp;"?> <?=UTils::fechaMes( $ref->getCaFchactualizado() )?>
                    </div>
                </td>
                <td width="25%">
                    <div align="left">
                        <b>Fecha Recibido:</b><br />
                        <?=UTils::fechaMes( $fechaAnt )?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
</div>

