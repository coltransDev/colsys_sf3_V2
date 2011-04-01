<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="content" align="center">

    <table class="tableList">
        <tr >
            <th>Fecha Env&iacute;o</th>
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

        if( count( $emails)==0 ){
           ?>
            <tr >
                <td><div align="center">No hay mensajes</div></td>

            </tr>
            <?
        }
    ?>
    </table>
    <br />

    <?=link_to(image_tag("22x22/1leftarrow.gif")."Volver", "ids/verIds?modo=".$modo."&id=".$id)?>

</div>