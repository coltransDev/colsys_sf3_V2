<div class="content" align="center" >

<h3>Auditoria de accesos para usuarios de NOVELL</h3>
<br>

<table width="100%" border="1" class="tableList">
	<tr>
		<th width="9%" scope="col">Grupo</th>
		<th width="18%" scope="col">Programa</th>
		<th width="48%" scope="col">Descripci&oacute;n</th>
		
		
		<th width="19%" scope="col">Opciones</th>	
		
		
	</tr>
	<?
	$lastGrp = null; 
	foreach( $opciones as $opcion ){ 
	if( $lastGrp!=$opcion->getCaGrupo() ){
		$lastGrp=$opcion->getCaGrupo();
	?>
	<tr class="row0">
		<td colspan="4"> <?=$opcion->getCaGrupo()?></td>					
	</tr>
	<?
	}
	?>
	<tr>
		<td><div align="center"></div></td>
		<td><?=$opcion->getCaOpcion()?></td>
		<td><?=$opcion->getCaDescripcion()?></td>
		
		
		<td width="9%" scope="col"><div align="center"><?=link_to("Usuarios con acceso", "pruebas/listaAccesoUsuarios?rutina=".$opcion->getcaRutina())?></div></td>	
		
		
		
		
	</tr>
	<?
	}
	?>
</table>
</div>