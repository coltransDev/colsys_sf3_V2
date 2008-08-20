<table cellspacing="0" cellpadding="0" width="520" align="center" class="tableList">
	<tr>
		<th colspan="4">Consulta por Cliente</th>
	</tr>
	
	<tr>
		<th>Nombre </th>
		<th>Direcci&oacute;n</th>
		<th>Tel&eacute;fono</th>
		<th>Fax</th>
	</tr>
	<?
	$j = 0;
	foreach( $clientes as $cliente ){
		$nombre = str_replace("\n", "", $cliente->getCacompania());
				
		if( $modo!="cliente" ){		
		?>				
		<tr>
			<td colspan="4" class="listar"><?=$nombre?></td>
		</tr>
		<?
		}else{
		?>
		<tr onclick="javascript:seleccionCliente('<?=isset($formName)?$formName:""?>', <?=$j?>)" style="cursor:pointer">
			<td class="listar"><?=$nombre?> </td>
			<td class="listar">Direcci&oacute;n</td>
			<td class="listar">Tel&eacute;fono</td>
			<td class="listar">Fax
			
			<?
			echo input_hidden_tag("idcliente[$j]",$cliente->getCaIdCliente() );
			echo input_hidden_tag("compania[$j]",$cliente->getCacompania() );			
			echo input_hidden_tag("direccion[$j]",str_replace("|" , " " , $cliente->getCaDireccion()) );
			echo input_hidden_tag("telefonos[$j]",$cliente->getCaTelefonos() );
			echo input_hidden_tag("fax[$j]",$cliente->getCaFax() );
			echo input_hidden_tag("email[$j]",$cliente->getCaEmail() );
			echo input_hidden_tag("preferencias[$j]",$cliente->getCaPreferencias() );
			echo input_hidden_tag("confirmar[$j]",$cliente->getCaConfirmar() );
			echo input_hidden_tag("vendedor[$j]",$cliente->getCaVendedor() );
			//echo input_hidden_tag("cupo[1]",$contacto->getIdContacto() );
			//echo input_hidden_tag("diascredito[1]",$contacto->getIdContacto() );
			$j++;
			?>
			</td>
		</tr>
		<?
		}		
		if( $modo!="cliente" ){			
			$contactos = $cliente->getContactos();
			$i=0;
			foreach( $contactos as $contacto ){
	?>
	<tr onclick="javascript:seleccionTercero('<?=isset($formName)?$formName:""?>', <?=$i?>)" style="cursor:pointer" >
		<td class="listar"><strong><?=$contacto->getNombre() ?> </strong><br /></td>
		<td class="listar"><?=str_replace("|" , " " , $cliente->getCaDireccion()) ?> </td>
		<td class="listar"><?=$contacto->getCaTelefonos() ?></td>
		<td class="listar">
			<?=$contacto->getCaFax() ?>
			<?
			echo input_hidden_tag("idcontacto[$i]",$contacto->getCaIdContacto() );
			echo input_hidden_tag("compania[$i]",$nombre );
			echo input_hidden_tag("nombre[$i]",$contacto->getNombre() );
			echo input_hidden_tag("direccion[$i]",str_replace("|" , " " , $cliente->getCaDireccion()) );
			echo input_hidden_tag("telefonos[$i]",$contacto->getCaTelefonos() );
			echo input_hidden_tag("fax[$i]",$contacto->getCaFax() );
			echo input_hidden_tag("email[$i]",$contacto->getCaEmail() );
			echo input_hidden_tag("preferencias[$i]",$cliente->getCaPreferencias() );
			echo input_hidden_tag("confirmar[$i]",$cliente->getCaConfirmar() );
			echo input_hidden_tag("vendedor[$i]",$cliente->getCaVendedor() );
			//echo input_hidden_tag("cupo[1]",$contacto->getIdContacto() );
			//echo input_hidden_tag("diascredito[1]",$contacto->getIdContacto() );
			$i++;
			?>			
		</td>
	</tr>	
	<?		
			}	
		}
	}
	?>
</table>
