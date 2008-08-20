<table cellspacing="1" >
	<tr>
		<th colspan="5">Maestra de Contactos por Cliente</th>
	</tr>
	<tr>
		<th>Nit Cliente</th>
		<th colspan="4">Nombre del Contacto</th>
	</tr>
	<tr>
		<td class="mostrar"><?=$cliente->getCaIdCliente()?>
		<?=$cliente->getCaDigito()?"-".$cliente->getCaDigito():""?></td>
		<td  class="mostrar" width="430" colspan="4"><strong>
			<?=$cliente->getCaCompania()?>
			<br />
			Direcci&oacute;n: </strong>
			<?=str_replace("|"," ",$cliente->getCaDireccion())?>
			&nbsp;&nbsp;<strong>Localidad: </strong>
			<?=$cliente->getCaLocalidad()?>
			<br />
			<strong>Tel&eacute;fonos: </strong>
			<?=$cliente->getCaTelefonos()?>
			&nbsp;&nbsp;&nbsp;&nbsp;<strong>Fax: </strong>
			<?=$cliente->getCaFax()?></td>
	</tr>
	<?
	$contactos = $cliente->getContactos();
	foreach( $contactos as $contacto ){
	?>
	<tr>
		<td rowspan="5" class="mostrar"></td>
		<td class="mostrar"><strong><?=Utils::replace( $contacto->getCaSaludo() )?></strong></td>
		<td colspan="3" class="mostrar"><strong><?=Utils::replace( $contacto->getNombre() )?></strong></td>
	</tr>
	
	<tr>
		<td class="mostrar">Cargo :</td>
		<td class="mostrar"><?=Utils::replace( $contacto->getCaCargo() )?></td>
		<td class="mostrar">&Aacute;rea o Departamento :</td>
		<td class="mostrar"><?=Utils::replace( $contacto->getCaDepartamento() )?></td>
	</tr>
	<tr>
		<td class="mostrar">Tel&eacute;fonos :</td>
		<td class="mostrar"><?=$contacto->getCaTelefonos()?></td>
		<td class="mostrar">Fax :</td>
		<td class="mostrar"><?=$contacto->getCaFax()?></td>
	</tr>
	<tr>
		<td class="mostrar" colspan="2">Email   :<br />
			<?=$contacto->getCaEmail()?>&nbsp;</td>
		<td class="mostrar" colspan="2">Observaciones   :<br />
			&nbsp;</td>
	</tr>
	<tr>
		<td class="mostrar" colspan="2"><strong>Estado tracking</strong><br />
		<?
			$trackingUser = $contacto->getTrackingUser();
			if( $trackingUser ){
				if( $trackingUser->getCaBlocked() ){
					echo image_tag("22x22/agt_update_critical.gif")."La clave se encuentra bloqueada";
					//desbloquear clave
				}elseif( $trackingUser->getCaActivated() ){
					echo image_tag("22x22/agt_action_success.gif")."La clave se encuentra activada<br />";						
					echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Recuperar clave","clientes/activarClave?contacto=".$contacto->getCaIdContacto()."&id=".$cliente->getCaIdCliente() , "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?");	
				}else{
					echo image_tag("22x22/agt_update_critical.gif")."La clave no se encuentra activada<br />";					
					echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Enviar email para activacion de clave","clientes/activarClave?contacto=".$contacto->getCaIdContacto()."&id=".$cliente->getCaIdCliente(), "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?" );	
				}
			}else{
				echo image_tag("22x22/agt_update_critical.gif")."No se ha asignado<br /><br />";
				echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Enviar email para activacion de clave","clientes/activarClave?contacto=".$contacto->getCaIdContacto()."&id=".$cliente->getCaIdCliente(), "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?" );
				//Asignar clave 
			}
			/*
			Asignar Clave Recuperar clave Ver historial de acceso Estadisticas uso tracking Frecuente no lo usa 
			
			que otros clientes puede ver
			*/			
			?></td>
		<td class="mostrar" colspan="2">&nbsp;</td>
	</tr>	
	
	<?
	}
	?>
	
</table>

<BR><TABLE CELLSPACING=10><TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:parent.frames[2].location.href = "/clientes.php?modalidad=N.i.t.&\criterio=<?=$cliente->getCaIdCliente()?>"'></TH></TABLE>
