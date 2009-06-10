<?

?>

<table width="100%" border="1" class="tableList">
	<tr>
		<th width="9%" scope="col">Acceso</th>
		<th width="18%" scope="col">Programa</th>
		<th width="48%" scope="col">Descripci&oacute;n</th>
		<th width="15%" scope="col">Nivel</th>
		<?
		if( $accesosPerfil ){
		?>
		<th width="19%" scope="col">Accesos Heredados</th>	
		<?
		}
		?>
		
	</tr>
	<?
	$lastGrp = null; 
	foreach( $opciones as $opcion ){ 
	if( $lastGrp!=$opcion->getCaGrupo() ){
		$lastGrp=$opcion->getCaGrupo();
	?>
	<tr class="row0">
		<td colspan="<?=$accesosPerfil?5:4?>"> <?=$opcion->getCaGrupo()?></td>					
	</tr>
	<?
	
	}
	
	?>
	<tr>
		<td><div align="center">
			<input type="checkbox" name="acceso[<?=$opcion->getCaRutina()?>]" value="1" <?=isset($accesos[$opcion->getCaRutina()])?'checked="checked"':''?>  />
		</div></td>
		<td><?=$opcion->getCaOpcion()?></td>
		<td><?=$opcion->getCaDescripcion()?></td>
		<td>
			<select name="nivel[<?=$opcion->getCaRutina()?>]">
				<option value="-1" <?=(isset($accesos[$opcion->getCaRutina()])&&$accesos[$opcion->getCaRutina()]==-1)?'selected="selected"':''?> >Denegar acceso</option>
			<?
			if( isset($rutinasNivel[$opcion->getCaRutina()]) ){
				$opcionesRutina = $rutinasNivel[$opcion->getCaRutina()];
				foreach( $opcionesRutina as $opcionRutina ){
				?>
				<option value="<?=$opcionRutina['nivel']?>"  <?=(isset($accesos[$opcion->getCaRutina()])&&$accesos[$opcion->getCaRutina()]==$opcionRutina['nivel'])?'selected="selected"':''?>><?=$opcionRutina['valor']?></option>
				<?		
				}				
			}else{
				?>
				
				<option value="0"  <?=(isset($accesos[$opcion->getCaRutina()])&&($accesos[$opcion->getCaRutina()]>=0) )?'selected="selected"':''?>>Con acceso</option>			
			<?
			}
			?>
			
										
			</select>
		</td>
		<?
		if( $accesosPerfil ){
		?>
		<td width="9%" scope="col"><div align="center">
			<?			
			if(isset($accesosPerfil[$opcion->getCaRutina()])){
				echo "<b>".$accesosPerfil[$opcion->getCaRutina()]['perfil']."</b>";
				echo "<br />";
				
				if( isset($rutinasNivel[$opcion->getCaRutina()]) ){
					$opcionesRutina = $rutinasNivel[$opcion->getCaRutina()];
					foreach( $opcionesRutina as $opcionRutina ){
						if( $accesosPerfil[$opcion->getCaRutina()]['nivel'] == $opcionRutina['nivel'] ){
							echo $opcionRutina['valor'];
						}
					}
				}elseif($accesosPerfil[$opcion->getCaRutina()]['nivel']>=0){
					echo "Con acceso";
				}else{
					echo "Denegar acceso";
				}
				
				
			}else{
				echo "&nbsp;";
			}
			?>
			
		</div></td>	
		<?
		}
		?>
		
		
		
	</tr>
	<?
	}
	?>
</table>
