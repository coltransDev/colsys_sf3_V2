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
                <b>Referencia</b>
            </th>
            <?
            if( $detalle ){
            ?>
            <th>
                <b>Cliente</b>
            </th>
            <?
            }
            ?>
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
        <?
        
        
        foreach( $refs as $ref ){
        ?>
        <tr class="row0">
            <td>
                <div align="left"><?=$ref->getCaReferencia()?></div>
            </td>
            <?
            if( $detalle ){
            ?>
            <td>
                &nbsp;
            </td>
            <?
            }
            ?>
            <td>
                <div align="right"><?=$ref->getCaMawb()?></div>
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
        
        if( $detalle ){
            $hijas = $ref->getInoClientesAir();

            foreach( $hijas as $hija ){
                ?>
                <tr >
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        <div align="left"><?=$hija->getCliente()->getCaCompania()?></div>
                    </td>
                    <td>
                        <div align="right"><?=$hija->getCaHawb()?></div>
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
            }
        }
        ?>
    </table>
    
    Generado <?=Utils::fechaMes(date("Y-m-d H:i:s"))?>
    
    <br />
    
    <div class="noprint" align="center">
        <input type="button" value="Volver" onclick="document.location='/colsys_php/reporteadorAereo.php'"        
    </div>
</div>