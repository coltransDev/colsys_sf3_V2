<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div align="center">
	<?=image_tag("32x32/agt_action_success.gif")?><h3>El recordatorio ha sido enviado correctamente.</h3>
	<br />
<a href="<?=url_for("inventory/informeMantenimientosRealizados?mes_man=".$mes_man.'&idsucursal='.$idsucursal.'&opcion=buscar')?>">Haga click aca para volver</a>