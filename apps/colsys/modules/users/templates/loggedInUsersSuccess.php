<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$sessions = $sf_data->getRaw("sessions");


?>
<div class="content" align="center" >
    <table class="tableList" width="90%" >
        <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>Inactivo desde</th>
            <th>Tiempo de Inactividad</th>
            <th>Max Tiempo de Inactividad</th>
            <th>IP</th>
            <th>Acciones</th>

        </tr>
        <?
        $i = 0;
        foreach($sessions as $session){
            $handle = $session->getSessData();            
            $data = fgets($handle, 4096);
            fclose($handle);

            $str = "symfony/user/sfUser/authenticated|b:";
			$k = strpos( $data, $str );
	        if( $k!==false ){
				$value = substr( $data, $k+strlen( $str ), 1 );
				if( $value=="1" ){

					$data = substr( $data, strpos( $data , "\"user_id\";s:" )+12);
					$idx = strpos( $data , ":" );
					$len = substr( $data , 0, $idx );
					$usuario = substr( $data, $idx+2, $len );
                    
                    $i++;
                ?>
                <tr>
                    <td><?=$session->getSessId()?></td>
                    <td><?=$usuario?></td>
                    <td><?=Utils::fechaMes(date("Y-m-d H:i:s",$session->getSessTime()))?></td>
                    <td><?=time()-$session->getSessTime()?> seg</td>
                    <td><?=$session->getMaxInactive()?> seg</td>
                    <td><?=$session->getIpAddress()?></td>
                    <td><?=link_to("Kick","users/kickUser?id=".$session->getSessId())?></td>
                </tr>
                <?
                }
            }
        }
        ?>
    </table>
    <b><?=$i?> usuarios</b>

</div>
