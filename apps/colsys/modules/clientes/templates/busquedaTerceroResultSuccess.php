<?
/*
*	
*/
use_helper("Javascript");
use_helper("Modalbox");
?>
<table width="687" border="0" class="tableForm">
	<tr>
		<th width="148" scope="col">Identificacion</th>
		<th width="212" scope="col">Nombre del cliente </th>
		<th width="99" scope="col">Contacto</th>
		<th width="190" scope="col">E-Mail Contacto</th>
		<th width="4" scope="col"><?=($opcion=="consignatario"||$opcion=="notify")?m_link_to( image_tag("22x22/new.gif") , "clientes/agregarTercero?tipo=".$opcion."&formName=".$formName):""?></th>
	</tr>	
	<?
	$i=0;
	foreach( $terceros as $tercero ){
		$nombre = str_replace("\n", " ", $tercero->getCaNombre());	
		
		?>		
		
	<tr >
		<td onclick='seleccionTercero("<?=isset($formName)?$formName:""?>", <?=$i?>)'><?=$tercero->getCaIdtercero()?></td>
		<td onclick='seleccionTercero("<?=isset($formName)?$formName:""?>", <?=$i?>)'><?=$nombre?></td>
		<td onclick='seleccionTercero("<?=isset($formName)?$formName:""?>", <?=$i?>)'><?=$tercero->getCaContacto()?>&nbsp;</td>
		<td onclick='seleccionTercero("<?=isset($formName)?$formName:""?>", <?=$i?>)'><?=$tercero->getCaEmail()?>&nbsp;
		<?
		echo input_hidden_tag("idtercero[$i]",$tercero->getCaIdtercero() );
		echo input_hidden_tag("nombre[$i]",$nombre );
		echo input_hidden_tag("contacto[$i]",$tercero->getCaContacto() );
		echo input_hidden_tag("direccion[$i]",str_replace("|" , " " , $tercero->getCaDireccion()) );
		echo input_hidden_tag("telefonos[$i]",$tercero->getCaTelefonos() );
		echo input_hidden_tag("fax[$i]",$tercero->getCaFax() );
		echo input_hidden_tag("email[$i]",$tercero->getCaEmail() );
		
		$i++;
		?>		</td>
		<td >
		<?=($opcion=="consignatario"||$opcion=="notify")?m_link_to( image_tag("22x22/edit.gif") , "clientes/agregarTercero?tipo=".$opcion."&formName=".$formName."&id=".$tercero->getCaIdtercero()):""?>
			
		</td>
	</tr>
	<?
	}
	?>	
</table>
