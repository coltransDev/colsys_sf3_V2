<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <div id="emailForm" align="center">     
        <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg/enviarEmailInstrucciones?idreporte=".$reporte->getCaIdreporte())?>" onsubmit="return loadhtml()" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $cli_txt=($this->repotm!==false)?$reporte->getCliente()->getCaCompania():(($repotm->getCaIdimportador()>0)?$repotm->getImportador()->getCaNombre():$repotm->getCliente()->getCaNombre());
        //echo $repotm->getCliente()->getCaNombre();
        //$clin_txt=$repotm->getCliente()->getCaNombre();
        $asunto  = "DOC OTM:".$reporte->getOrigen()->getCaCiudad()."/".$reporte->getDestino()->getCaCiudad()." ".$cli_txt." HBL No.".$repotm->getCaHbls(). " ETA ".$repotm->getCaFcharribo();
        
        /*$mensaje ="\nCLIENTE :".$cli_txt;
        $mensaje .="\nHBL No. :".$repotm->getCaHbls();
        $mensaje .="\nETA: ".$repotm->getCaFcharribo();
        $mensaje .="\nMOTONAVE : ".$repotm->getCaMotonave();
        $mensaje .="\nMUELLE: ".$repotm->getInoDianDepositos()->getCaNombre();
        $mensaje .="\nREF: ".$reporte->getCaOrdenClie();
        $mensaje .="\nTERMINO DE NEGOCIACION: ". $reporte->getCaIncoterms() ;
        $mensaje .="\nBODEGA: ".utf8_encode($reporte->getBodega()->getCaNombre());
        $mensaje .="\nDESCRIPCION : ".$reporte->getCaMercanciaDesc() ;
        $mensaje .="\nDatos de liberación: ".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS");
        $mensaje .="\nDATOS DEL ACI:".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS");
         * 
         */
        //strip_tags($html, "<table><tr><td>");
        $mensaje="Señores:\n\n".(($reporte->getConsignatario())?$reporte->getConsignatario()->getCaNombre():"")."\nEsta carga será entregada a ustedes para el manejo del OTM.\nNota importante: favor revisar la documentación y dejarnos saber hoy mismo si tiene algún inconveniente. ";
        $html ="<table class='tableList alignLeft' width='40%'><tr><th colspan='2'> <input style='width: 100%' id='cliente' name='cliente' value='".$cli_txt."'></th></tr>";
        $html .="<tr><td style='width: 30%'>HBL No. :</td><td><input style='width: 100%'  id='hbls' name='hbls' value='".$repotm->getCaHbls()."'></td></tr>";
        $html .="<tr><td>ETA: </td><td><input style='width: 100%' id='eta' name='eta' value='".$repotm->getCaFcharribo()."'></td></tr>";
        $html .="<tr><td>MOTONAVE : </td><td><input style='width: 100%' id='motonave' name='motonave' value='".$repotm->getCaMotonave()."'></td></tr>";
        $html .="<tr><td>MUELLE: </td><td><input style='width: 100%' id='muelle' name='muelle' value='".$repotm->getInoDianDepositos()->getCaNombre()."'></td></tr>";
        $html .="<tr><td>REF: </td><td><input style='width: 100%' id='ref' name='ref' value='".$reporte->getCaOrdenClie()."'></td></tr>";
        $html .="<tr><td>TERMINO DE NEGOCIACION: </td><td><input style='width: 100%' id='incoterm' name='incoterm' value='". $reporte->getCaIncoterms() ."'></td></tr>";
        $html .="<tr><td>BODEGA: </td><td><input style='width: 100%' id='bodega' name='bodega' value='".($reporte->getBodega()->getCaNombre())."'></td></tr>";
        $html .="<tr><td>DESCRIPCION : </td><td><input style='width: 100%' id='mercancia' name='mercancia' value='".$reporte->getCaMercanciaDesc() ."'></td></tr>";
        $html .="<tr><td>Datos de liberación: </td><td>".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS")."</td></tr>";
        $html .="<tr><td>DATOS DEL ACI:</td><td>".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS")."</td></tr></table>";

        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));
        ?>
            <div>
                <? include_component("reportesNeg", "fileManager", array("reporte"=>$reporte));?>
            </div>
        <br />
        <?=$html?>
<!--        <input type="hidden" name="html" id="html" value="<?=$html?>" />-->
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>

<script>
    loadhtml = function ()
    {
        
    }
</script>