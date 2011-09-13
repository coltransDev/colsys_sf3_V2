<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <div id="emailForm" align="center">     
        <form name="form1" id="form1" method="post" action="<?=url_for("reportesNeg/enviarEmailInstrucciones?idreporte=".$reporte->getCaIdreporte())?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $cli_txt=($repotm->getCaIdimportador()>0)?$repotm->getImportador()->getCaNombre():$repotm->getCliente()->getCaNombre();
        //echo $repotm->getCliente()->getCaNombre();
        //$clin_txt=$repotm->getCliente()->getCaNombre();
        $asunto  = "DOC OTM ".$cli_txt." HBL No.".$repotm->getCaHbls(). " ETA ".$repotm->getCaFcharribo();
        
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
        $html ="<table class='tableList alignLeft'><tr><th colspan='2'> ".$cli_txt."</th></tr>";
        $html .="<tr><td>HBL No. :</td><td>".$repotm->getCaHbls()."</td></tr>";
        $html .="<tr><td>ETA: </td><td>".$repotm->getCaFcharribo()."</td></tr>";
        $html .="<tr><td>MOTONAVE : </td><td>".$repotm->getCaMotonave()."</td></tr>";
        $html .="<tr><td>MUELLE: </td><td>".$repotm->getInoDianDepositos()->getCaNombre()."</td></tr>";
        $html .="<tr><td>REF: </td><td>".$reporte->getCaOrdenClie()."</td></tr>";
        $html .="<tr><td>TERMINO DE NEGOCIACION: </td><td>". $reporte->getCaIncoterms() ."</td></tr>";
        $html .="<tr><td>BODEGA: </td><td>".utf8_encode($reporte->getBodega()->getCaNombre())."</td></tr>";
        $html .="<tr><td>DESCRIPCION : </td><td>".$reporte->getCaMercanciaDesc() ."</td></tr>";
        $html .="<tr><td>Datos de liberación: </td><td>".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS")."</td></tr>";
        $html .="<tr><td>DATOS DEL ACI:</td><td>".(($user->getIdempresa()=="4")?"CONSOLCARGO":"COLTRANS")."</td></tr></table>";
        //echo $mensaje;
//        $mensaje ="sdfsdf";
        include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));

        ?>
            <div>
                <? include_component("reportesNeg", "fileManager", array("reporte"=>$reporte));?>
            </div>
        <br />
        <?=$html?>
        <input type="hidden" name="html" id="html" value="<?=$html?>" />
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>