<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $reporte->getCaImpoexpo()==Constantes::EXPO){
?>
<table class="tableList alignLeft" width="100%" id="consignar-expo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
         <td width="33%">
             <b>Consignar Master (<?=$nomGuiasM?>) a:</b>
         </td>
         <td width="67%" <?=($comparar)? (($reporte->compDato("Consignarmaster")!=0)?"class='rojo'":"") :""?>>
            <?=$reporte->getConsignarmaster()?>
        </td>
    </tr>
     <tr>
         <td>
             <b>Consignar <?=$nomGuiasH?> a :</b>
         </td>
         <td <?=($comparar)? (($reporte->compDato("Consignar")!=0)?"class='rojo'":"") :""?>>
            <? $reporte->getConsignar()?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="Ver rep. al exterior" onclick="popup('<?=url_for("reporteExt/verReporte?idreporte=".$reporte->getCaIdreporte()."&layout=popup")?>')" class="button" />
         </td>

    </tr>
</table>
<?
}else{
?>
<table class="tableList alignLeft" width="100%" id="consignar-impo">
     <tr >
         <th colspan="2" ><b>Instrucciones para el corte de guias</b></th>
     </tr>
     <tr>
        <td width="33%">
             <b>Consignar <?=$nomGuiasH?> a:</b>
         </td>
         <td width="67%" <?=($comparar)? (($reporte->compDato("CaIdconsignatario")!=0)?"class='rojo'":"") :""?>>
            <?
            if($reporte->getCaIdconsignatario())
            {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignatario());
                if($tercero)
                    echo  ($tercero->getCaNombre());
            }            

/*            if( $reporte->getCaIdconsignar() ){
                $bodega = $reporte->getBodegaConsignar();
                echo $bodega->getCaNombre();
            }
 * 
 */
            ?>
        </td>
    </tr>
    <tr>
        <td width="33%" <?=($comparar)? (($reporte->compDato("CaIdbodega")!=0 || $reporte->compDato('Property',"entrega_lugar_arribo" )!=0 ) ?"class='rojo'":"") :""?>>
             <b>Trasladar a:</b>
         </td>
         <td width="67%">
            <?
            
            if($reporte->getProperty("entrega_lugar_arribo")=="true" || $reporte->getProperty("entrega_lugar_arribo")=="1")
            {
                echo "  Entrega en Lugar de Arribo /";
            }
            
            if( $reporte->getCaIdbodega() ){
                $bodega = $reporte->getBodega();
                echo $bodega->getCaTipo()." - ".$bodega->getCaNombre()." ".$bodega->getCaDireccion();
            }
            ?>
        </td>
    </tr>
    
    <tr>
         <td>
             <b>Igualar Master/Hijo:</b>
         </td>
         <td <?=($comparar)? (($reporte->compDato("CaMastersame")!=0)?"class='rojo'":"") :""?> >
            <?
            echo $reporte->getCaMastersame();
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="Ver rep. al exterior" onclick="popup('<?=url_for("reporteExt/verReporte?idreporte=".$reporte->getCaIdreporte()."&layout=popup")?>')" class="button" />
         </td>

    </tr>
</table>
<?
}
?>

<br />

<table class="tableList alignLeft" width="100%">
        <tr>
            <th colspan="6"><b>Otros datos</b></th>
            
        </tr>
        <?
        if( $reporte->getCaIdconsignatario() ){
        ?>
        <tr class="row0">
            <td  colspan="6"><b>Consignatario:</b></td>
        </tr>
        <tr>
            <td colspan="6" <?=($comparar)? (($reporte->compDato("CaIdconsignatario")!=0)?"class='rojo'":"") :""?> >
                <?
                include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdconsignatario(), "reporte"=>$reporte));
                ?>
            </td>
        </tr>
        <?
        }

        if( $reporte->getCaIdnotify() ){
        ?>
        <tr class="row0">
            <td  colspan="6"><b>Notify</b></td>
        </tr>
        <tr>
            <td colspan="6" <?=($comparar)? (($reporte->compDato("CaIdnotify")!=0)?"class='rojo'":"") :""?> >
                <?
                include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdnotify(), "reporte"=>$reporte));
                ?>
            </td>
        </tr>
        <?
        }

        if( $reporte->getCaIdrepresentante() ){
        ?>
        <tr class="row0">
            <td  colspan="6"><b>Representante</b></td>
        </tr>
        <tr>
            <td colspan="6" <?=($comparar)? (($reporte->compDato("CaIdrepresentante")!=0)?"class='rojo'":"") :""?> >
                <?
                include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdrepresentante(), "reporte"=>$reporte));
                ?>
            </td>
        </tr>
        <?
        }

        if( $reporte->getCaIdmaster() ){
        ?>
        <tr class="row0">
            <td  colspan="6"><b>Consigna. Master:</b></td>
        </tr>
        <tr>
            <td colspan="6" <?=($comparar)? (($reporte->compDato("CaIdmaster")!=0)?"class='rojo'":"") :""?> >
                <?
                include_component("reportesNeg", "previewTercero", array("idtercero"=>$reporte->getCaIdmaster(), "reporte"=>$reporte));
                ?>
            </td>
        </tr>
        <?
        }
        ?>
    </table>