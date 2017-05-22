<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$sessions = $sf_data->getRaw("sessions");

$totals = array();
?>
<div class="content" align="center" >

    Hora actual <?=date("Y-m-d H:i:s",time())?>
    <table class="tableList" width="90%" >
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Inactivo desde</th>
            <th>Tiempo de Inactividad</th>            
            <th>IP</th>
            <th>Acciones</th>
        </tr>
        <?
        $numUsers = 0;
        for($i=0; $i<count($sessions); $i++ ){
            $session = $sessions[$i];
              
	          
                  
                  //print_r( $session["userdata"] );
                  //echo "<br />";
                                      
                    $attrib = $session["userdata"]["symfony/user/sfUser/attributes"]["symfony/user/sfUser/attributes"];
                    if(!isset( $totals[$sessions[$i]["ipAddress"]] )){
                        $totals[$sessions[$i]["ipAddress"]] = 0;
                    }
                    $totals[$sessions[$i]["ipAddress"]]++;
                    ?>
                    <tr>
                        <td><?=$session["id"]?></td>
                        <td><?=$attrib["user_id"]?></td>
                        <td><?=date("Y-m-d H:i:s",$session["lastRequest"]) //Utils::fechaMes(date("Y-m-d H:i:s",$session["lastRequest"]))?></td>
                        <td><?=time()-$session["lastRequest"]?> seg</td>
                        <td><?=$sessions[$i]["ipAddress"]?></td>
                        <td><?=link_to("Kick","users/kickUser?id=".$session["id"])?></td>
                    </tr>
                    <?
                    $numUsers++;
                  //}
                 
              
        }
        ?>
    </table>
    <br />
    <table class="tableList" width="50%" >
        <tr>
            <th>IP</th>
            <th># Usuarios</th>
        </tr>
    <?
    foreach( $totals as $key=>$val ){
    ?>
        <tr>
            <td><?=$key?></td>
            <td><?=$val?></td>
        </tr>
    <?
    }
    ?>
    </table>
    <b><?=$numUsers?> usuarios</b>

</div>
