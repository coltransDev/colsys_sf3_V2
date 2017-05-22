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
      <h2>AUTORIZACIÓN PARA DEVOLUCION DE CONTENEDORES VACIOS</h2><br/>
    <b>Fecha</b> <?=Utils::fechaLarga(date("Y-m-d"))?>
</div>
<div class="content">
    <?
    if( $format!="email" ){
    ?>
    <div id="emailForm"  style="display:none" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("antecedentes/enviarContenedores?ref=".str_replace(".","|",$ref->getCaReferencia()))?>" >
        <?

        $asunto  = "Autorización Devolución de Contenedores Vacios ".$ref->getCaReferencia();
        $mensaje = "Respetados Señores, cordialmente solicitamos su autorizaci&oacute;n para la devoluci&oacute;n de acuerdo a la siguiente instrucci&oacute;n";
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));
        
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
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <b>ETD: </b> <?=$ref->getCaFchembarque()?>
            </td>
            <td>
                <b>ETA</b> <?=$ref->getCaFcharribo()?>
            </td>
            <td>&nbsp;</td>
        </tr>        
    </table>

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
        
        foreach( $hijas as $hija ){
            $tpeso+=$hija->getCaPeso();
            $tvolumen+=$hija->getCaVolumen();
            $tpiezas+=$hija->getCaNumpiezas();
        ?>
        <tr>
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
    <br />
    <br />
    <div align="center">
        <h2>Informaci&oacute;n de Contenedores</h2>
        <table class="tableList alignLeft">
              <tr>
                 <th>Equipo</th>
                 <th>Id Equipo</th>
                 <th>Dep&oacute;sito</th>
                 <th>Fch.Entrega Comodato</th>
                 <th>Nota Inspecci&oacute;n</th>
                 <th>Fch.Devoluci&oacute;n</th>
                 <th>Observaciones</th>
                 <th>Sel.</th>
                 <th>Devolución</th>
              </tr>
              <?
              foreach ($equipos as $key => $val) {
              ?>
              <tr>
                 <td><?=$equipos[$key]["cp_ca_concepto"]?></td>
                 <td><?=$equipos[$key]["ie_ca_idequipo"]?></td>
                 <td><?=$equipos[$key]["pt_ca_nombre"]?></td>
                 <td><?=$equipos[$key]["ic_ca_entrega_comodato"]?></td>
                 <td><?=$equipos[$key]["ic_ca_inspeccion_nta"]?></td>
                 <td><?=$equipos[$key]["ic_ca_inspeccion_fch"]?></td>
                 <td><?=$equipos[$key]["ic_ca_observaciones"]?></td>
                 <td><input id="contenedores" name="contenedores" type="checkbox" value="<?=$equipos[$key]["ie_ca_idequipo"]?>"></td>
                 <td><select id="destino" name="destino">
                       <?
                       foreach($destinos as $destino){
                          ?>
                           <option value="<?=$destino?>"><?=$destino?>
                          <?
                       }
                       ?>
                    </select>
                 </td>
                 
              </tr>
              <?
              }
              ?>
                 
           </table>
       </div>
<br />
<?
    $usuario = $ref->getUsuCreado();
    $sucursal = $usuario->getSucursal();
    //if($sucursal)
    //   echo $sucursal->getCaNombre();
?>
<table cellspacing="0" width="100%" class="tableList alignLeft">
        <tbody>
            <tr class="row0">
                <td width="33%">
                    <div align="left">
                        <b>Ciudad:</b><br />
                        <?=$sucursal?$sucursal->getCaNombre():"&nbsp;"?>
                    </div>
                </td>
                <td width="33%">
                    <div align="left">
                        <b>Elaborado por:</b><br />
                        <?=$ref->getCaUsucreado()?> <?=UTils::fechaMes($ref->getCaFchcreado())?>
                    </div>
                </td>
                <td width="34%">
                    <div align="left">
                        <b>Actualizado por:</b><br />
                        <?=$ref->getCaUsuactualizado()?$ref->getCaUsuactualizado():"&nbsp;"?> <?=UTils::fechaMes( $ref->getCaFchactualizado() )?>
                    </div>
                </td>     
                
            </tr>
            </tbody>
        </table>
</div>
