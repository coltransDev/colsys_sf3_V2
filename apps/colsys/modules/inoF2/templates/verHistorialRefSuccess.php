<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$logs = $sf_data->getRaw("logs");
$emails = $sf_data->getRaw("emails");
?>
<table class="tableList" width="100%">
     <tr >
         <th><b>Accion</b></th>
         <th><b>Fecha</b></th>
         <th><b>Usuario</b></th>
         <th><b></b></th>
     </tr>
<?
foreach($logs as $l)
{
?>
     <tr >
         <td><?=$l->getCaEvent()?></td>
         <td><?=$l->getCaFchevento()?></td>
         <td><?=$l->getCaLogin()?></td>
         <td><?=$l->getCaUseragent()?></td>
     </tr>
<?
}
?>
</table>

<?
if( count($emails)>0 && $format!="email" ){
    ?>
    <br />
    <br />
    <div align="center">
        <h2>Historial de envios Antecedentes</h2>
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
