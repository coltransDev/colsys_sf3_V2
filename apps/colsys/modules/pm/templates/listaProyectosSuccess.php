<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>

<div class="content" >

    <table border="0" width="100%" >
        <tr>
            <td width="65%" valign="top" style="padding: 10px;">
                <h3>Estado de Proyectos</h3>
                
                
                    <?
                    foreach( $projects as $project ){
                        $porcentaje = round( $project["p_tc"]*100/($project["p_tc"]+$project["p_ta"]), 1);

                    ?>
                    <br />
                    <table class="tableList" width="100%">
                        <tr class="row0">
                            <td >
                                <b><b><?=$project["p_ca_name"]?></b></b>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div id="progress_<?=$project["p_ca_idproject"]?>"></div>

                                <?=link_to("Detalles del proyecto", "pm/detalleProyecto?id=".$project["p_ca_idproject"] );?>
                                <script language="javascript">
                                    new Ext.ProgressBar({
                                        text:'<?=$project["p_ta"]." Abiertos/".$project["p_tc"]." Cerrados ".$porcentaje."% Terminado "?>',                                                                                
                                        renderTo:'progress_<?=$project["p_ca_idproject"]?>',
                                        value: <?=$porcentaje/100?>,
                                        width: 400
                                    });

                                </script>
                            </td>
                        </tr>
                     </table>
                    <?
                    }
                    ?>
               
            </td>
            <td width="35%" valign="top"  style="padding: 10px;"> <h3>Tickets por usuarios</h3> </td>

        </tr>
    </table>
</div>