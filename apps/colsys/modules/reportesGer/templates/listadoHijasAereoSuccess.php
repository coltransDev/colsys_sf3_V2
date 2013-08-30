<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center">
    <table class="tableList" width="80%">
        <tr>
            <th>
                <b>Referencia:</b>
            </th>
            <th>
                <b>Guia:</b>
            </th>
            <th>
                <b>Piezas</b>
            </th>
            <th>
                <b>Peso</b>
            </th>
            <th>
                <b>Peso Vol.</b>
            </th>
        </tr>
        <tr class="row0">
            <td>
                <?=$ref->getCaReferencia()?>
            </td>
            <td>
                <?=$ref->getCaMawb()?>
            </td>
            <td>
                <div align="right">
                    <?=number_format($ref->getCaPiezas(), 2)?>
                </div>
            </td>
            <td>
                <div align="right">
                    <?=number_format($ref->getCaPeso(), 2)?>
                </div>            
            </td>
            <td>
                <div align="right">
                    <?=number_format($ref->getCaPesovolumen(), 2)?>
                </div>                
            </td>
        </tr>
        <?
        $hijas = $ref->getInoClientesAir();
        
        foreach( $hijas as $hija ){
        ?>
        <tr >
            <td>
                &nbsp;
            </td>
            <td>
                <?=$hija->getCaHawb()?>
            </td>
            <td>
                <div align="right">
                    <?=number_format($hija->getCaNumpiezas(), 2)?>
                </div>
            </td>
            <td>
                <div align="right">
                    <?=number_format($hija->getCaPeso(), 2)?>
                </div>            
            </td>
            <td>
                <div align="right">
                    <?=number_format($hija->getCaVolumen(), 2)?>
                </div>                
            </td>
        </tr>
        <?
        }
        ?>
    </table>
    
    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>
    
    <br />
    
    <div class="noprint" align="center">
        <input type="button" value="Volver" onclick="document.location='/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia=<?=$ref->getCaReferencia()?>'"        
    </div>
</div>