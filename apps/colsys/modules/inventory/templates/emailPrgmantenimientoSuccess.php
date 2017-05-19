<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<table width="100%" border="0" cellspacing="5" cellpadding="0">
<!-- LOGO -->
    <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.colsys.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
        <td><font size="4" face="arial, helvetica, sans-serif" color="#062A7D"><b>    <?=$idsuc?> -Programación de Mantenimiento: <?=$mesLargo?> de <?=$anoprg?></b></font></td></tr></table></td></tr>
    <tr><td width="25"><img src="https://www.colsys.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
    <tr>
        <td>&nbsp;</td><td>
            
            <table width="100%" border="1" style="border-collapse:collapse;" class="tableList" align="center">
                <tr>
                    <th>Fecha Programación</th>
                    <th>Categoría</th>
                    <th>Activo #</th>
                    <th>Marca #</th>
                    <th>Modelo #</th>
                    <th>Usuario</th>
                    <th>Departamento</th>
                <tr/>
            <?
                foreach($activos as $activo){
                    $cat = $activo->getInvCategory();
                    $parent = $cat->getParent();
            ?>
                <tr>
                    <td>
                        <?=$activo->getCaPrgmantenimiento()?>
                    </td>
                    <td>
                        <?=$parent->getCaName()?>
                    </td>
                    <td>
                        <?=$activo->getCaIdentificador()?>
                    </td>
                    <td>
                        <?=$activo->getCaMarca()?>
                    </td>
                    <td>
                        <?=$activo->getCaModelo()?>
                    </td>
                    <td>
                        <?=$activo->getUsuario()->getCaNombre()?>
                    </td>
                    <td>
                        <?=$activo->getUsuario()->getCaDepartamento()?>
                    </td>
                </tr>
             <?
               }
             ?>
            </table>
            <table width="70%" border="0" align="center">
            <tr><td>
                    <div class="entry-even" style="font-size: 11px;">
                        <b>Observaciones Generales:</b><br /><br />
                        Favor tener en cuenta la fecha de programación de Mantenimiento Preventivo para su equipo, en la cuál se realizarán las siguientes
                        labores:<br /><br />
                        <?
                        $j=1;
                        foreach($etapas as $etapa){
                            echo '  '.$j.'.  '.$etapa->getCaEtapa().'<br />';
                            $j++;
                        }

                        ?>
                        <br />
<?          
                        if($idsuc=='BOG'){
?>
                            <b>El mantenimiento se realizará en el horario de 6:30 am a 8:00 am<br />
                                Solicitamos dejar el computador libre de pos-it, muñecos y demás elementos que no pertenezcan al equipo. <br />
                                Dejar abierta la oficina (si aplica).</b>
<?
                        }
?>
                    </div>
                </td></tr>
            </table>
</table>
