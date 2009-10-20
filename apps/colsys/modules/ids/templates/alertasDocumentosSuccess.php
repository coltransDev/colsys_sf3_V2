<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


<div class="content" align="center">
    <h1><?=$titulo?> con vencimiento hasta el día <?=Utils::fechaMes($fecha)?></h1>
    <br />
    
    <table class="tableList" width="80%">
        <tr>
            <th>Compa&ntilde;ia</th>
            <th>Documento</th>
            <th>Vencimiento</th>
        </tr>
        <?
        foreach( $documentos as $documento ){
        ?>
        <tr>
            <td><a href="https://www.coltrans.com.co/<?=url_for("ids/verIds?modo=".$modo."&id=".$documento["i_ca_id"])?>"><?=$documento["i_ca_nombre"]?></a></td>
            <td><?=$documento["t_ca_tipo"]?></td>
            <td>
                <?
                if( $documento["d_ca_fchvencimiento"]<=date("Y-m-d") ){
                ?>
                <span class="rojo">
                    <?=$documento["d_ca_fchvencimiento"]?>
                </span>    
                <?
                }else{
                    echo $documento["d_ca_fchvencimiento"];
                }
                ?>

            </td>
        </tr>
        <?
        }
        ?>
    </table>

</div>