<div align="center">
<table cellspacing="1" class="tableList" >
	<tr>
		<th colspan="5">Maestra de Contactos por Cliente</th>
	</tr>
	<tr>
		<th>Nit Cliente</th>
		<th colspan="4">Nombre del Contacto</th>
	</tr>
	<tr>
		<td class="mostrar"><?=$cliente->getCaIdcliente()?>
		<?=$cliente->getCaDigito()?"-".$cliente->getCaDigito():""?></td>
		<td  class="mostrar" width="430" colspan="4"><b>
			<?=$cliente->getCaCompania()?>
			<br />
			Direcci&oacute;n: </b>
			<?=str_replace("|"," ",$cliente->getCaDireccion())?>
			&nbsp;&nbsp;<b>Localidad: </b>
			<?=$cliente->getCaLocalidad()?>
			<br />
			<b>Tel&eacute;fonos: </b>
			<?=$cliente->getCaTelefonos()?>
			&nbsp;&nbsp;&nbsp;&nbsp;<b>Fax: </b>
			<?=$cliente->getCaFax()?></td>
	</tr>
	<?
	$contactos = $cliente->getContacto();
	foreach( $contactos as $contacto ){
	?>
	<tr>
		<td rowspan="5" class="mostrar"></td>
		<td class="mostrar"><b><?=Utils::replace( $contacto->getCaSaludo() )?></b></td>
		<td colspan="3" class="mostrar"><b><?=Utils::replace( $contacto->getNombre() )?></b></td>
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
		<td class="mostrar" colspan="2"><b>Estado tracking</b><br />
		<?
			$trackingUser = $contacto->getTrackingUser();
			if( $trackingUser ){
				if( $trackingUser->getCaBlocked() ){
					echo image_tag("22x22/agt_update_critical.gif")."La clave se encuentra bloqueada";
					//desbloquear clave
				}elseif( $trackingUser->getCaActivated() ){
					echo image_tag("22x22/agt_action_success.gif")."La clave se encuentra activada<br />";
					echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Recuperar clave","clientes/activarClave?contacto=".$contacto->getCaIdcontacto()."&id=".$cliente->getCaIdcliente() , "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?");
				}else{
					echo image_tag("22x22/agt_update_critical.gif")."La clave no se encuentra activada<br />";
					echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Enviar email para activacion de clave","clientes/activarClave?contacto=".$contacto->getCaIdcontacto()."&id=".$cliente->getCaIdcliente(), "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?" );
				}
			}else{
				echo image_tag("22x22/agt_update_critical.gif")."No se ha asignado<br /><br />";
				echo link_to("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Enviar email para activacion de clave","clientes/activarClave?contacto=".$contacto->getCaIdcontacto()."&id=".$cliente->getCaIdcliente(), "confirm=Se enviara un email de confirmacion para recuperar la clave, desea continuar?" );
				//Asignar clave
			}
			/*
			Asignar Clave Recuperar clave Ver historial de acceso Estadisticas uso tracking Frecuente no lo usa

			que otros clientes puede ver
			*/
			?></td>
		<td class="mostrar" colspan="2">
			<b>Puede ver informaci&oacute;n de:<br /></b>
			<?
            if( $contacto->getCaEmail() ){
                $cns = Doctrine::getTable("Contacto")
                                 ->createQuery("c")
                                 ->where("c.ca_email = ?", $contacto->getCaEmail())
                                 ->execute();

                foreach( $cns as $cn ){
                    echo $cn->getCliente()?$cn->getCliente()->getCaCompania()."<br />":"";
                }
            }else{
                echo "&nbsp;";
            }
			?>

		</td>
	</tr>

	<?
	}
	?>

</table>

<BR><TABLE CELLSPACING=10><TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:parent.frames[2].location.href = "/clientes.php?modalidad=N.i.t.&\criterio=<?=$cliente->getCaIdcliente()?>"'></TH></TABLE>
</div>
