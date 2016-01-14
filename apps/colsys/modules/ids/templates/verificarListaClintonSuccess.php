<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$stmt = $sf_data->getRaw("stmt");


?>
<div class="content" align="center">
   La siguiente es una relación de <b>SIMILITUDES</b>, halladas entre el cliente consultado y la lista OFAC publicada el <?=$fechaActualizacion?>.
   <br />Tener en cuenta que se compara Número de Nit y Razón Social.<br /><br />

    <table align="center" class="tableList">

    <?
    $i= 0;
    while( $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ){
        //print_r( $row );
        $keys = array_keys( $row );
        if( $i++==0 ){
            ?>
            <tr>
            <?
            foreach( $keys as $key ){
            ?>
                <th><?=ucfirst(str_replace("_", " ",str_replace("ca_", "",$key)))?></th>
            <?
            }
            ?>
            </tr>
            <?
        }
        ?>
        <tr>
            <?
            foreach( $keys as $key ){
            ?>
                <td><?=$row[$key]?></td>
            <?
            }
        ?>
        </tr>
        <?

    }

    ?>
    </table>

   <br>
   <?
   if( $id ){
   ?>
   <input type="button" value="Regresar" class="button" onClick="document.location='<?=url_for("ids/verIds?modo=".$modo."&id=".$id)?>'" />
   <?
   }
   ?>

</div>