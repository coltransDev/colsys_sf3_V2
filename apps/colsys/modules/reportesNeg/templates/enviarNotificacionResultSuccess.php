<?
$asignaciones = $sf_data->getRaw("asignaciones");
$principal = $sf_data->getRaw("principal");
$destinatario = $sf_data->getRaw("destinatario");

?>
<div align="center" class="content">
<h1>Se ha enviado una notificación del reporte <?=$reporte->getCaConsecutivo()?> - <?=$reporte->getCaVersion()?> a los siguientes destinatarios:</h1>
<br />
<h3><?=link_to( "<h3>haga click aca para volver</h3>","/reportesNeg/verReporte?id=".$reporte->getCaIdreporte() );?></h3>
<br />

<table width="50%" border="0" class="tableList">

<tr>
	<th width="11%" scope="col"><b>Grupo</b></th>
	<th width="31%" scope="col"><b>Usuario</b></th>
	<th width="30%" scope="col"><b>e-mail</b></th>
</tr>

<tr>
	<td ><b>Principal</b></td>
	<td><?=$principal->getCaNombre()?></td>
	<td><?=$principal->getCaEmail()?></td>
</tr>
<?
foreach( $grupos as $grupo=>$logins ){
	foreach( $logins as $login ){
        if(!in_array( $login ,$asignaciones ) ){
            continue;
        }
		$usuario = Doctrine::getTable("Usuario")->find( $login );
	?>
	<tr>
		<td><?=ucfirst($grupo)?></td>		
		<td><?
				echo $usuario->getCaNombre();
			?></td>
		<td><?
				echo $usuario->getCaEmail();
			?></td>
	</tr>
	<?
	}
}

foreach( $gruposObligatorios as $grupo=>$logins ){
	foreach( $logins as $login ){
        if(!in_array( $login ,$asignaciones ) ){
            continue;
        }
		$usuario = Doctrine::getTable("Usuario")->find( $login );
	?>
	<tr>
		<td><?=ucfirst($grupo)?></td>		
		<td><?
				echo $usuario->getCaNombre();
			?></td>
		<td><?
				echo $usuario->getCaEmail();
			?></td>
	</tr>
	<?
	}
}

?>
<tr>
	<td >Notificar a:</td>	
    <td colspan="2"><?=$destinatario?></td>
	
</tr>
    
</table>
</div>