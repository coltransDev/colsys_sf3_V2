<div class="content" align="center">
<h3>Maestra de Agentes</h3><br />
	
<?
$ultTrafico = null;
foreach( $agentes as $agente ){
	
	$indicativo = "(".substr($agente->getCiudad()->getCaIdtrafico(), strpos($agente->getCiudad()->getCaIdtrafico(),"-")+1, 5 ).") (".substr($agente->getCaIdCiudad(), strpos($agente->getCaIdCiudad(),"-")+1, 5 ).")";
	
	if( $agente->getCiudad()->getCaIdtrafico()!=$ultTrafico ){	
		$ultTrafico=$agente->getCiudad()->getCaIdtrafico();
	?>
	<br />
	<br />
	<h3><?=$agente->getCiudad()->getTrafico()->getCaNombre()?></h3>
	
	<br />
	<?
	}
	?>	
	<table width="60%" border="0" class="tableList">
	<tr >
		<th colspan="4" scope="col">
			<div align="left"><b>
				<?=$agente->getCaNombre()?> <?=(!$agente->getCaActivo()?"(INACTIVO)":"")?>
			</b></div></th>
		<th scope="col">
			<?
			if( $nivel>0 ){
			?>
			<div align="right"><?=link_to(image_tag("16x16/edit.gif"), "agentes/formAgentes?idagente=".$agente->getcaIdagente())?></div>
			<?
			}else{
				echo "&nbsp;";
			}
			?>		</th>
	</tr>
	<tr class="row0">
		<td width="25%"><div align="left"><b>Direcci&oacute;n:</b></div></td>
		<td colspan="4">
			<div align="left">
				<?=$agente->getCaDireccion()?>
				</div></td>
		</tr>
	<tr class="row0">
		<td><div align="left"><b>Ciudad:</b></div></td>
		<td colspan="2"><div align="left">
			<div align="left">
					<?=$agente->getCiudad()->getCaCiudad()." - ".$agente->getCiudad()->getTrafico()->getCaNombre()?>
				</div>
		</div></td>
		<td width="25%"><div align="left"><b>Zip Code: </b></div></td>
		<td width="25%"><div align="left">
			<?=$agente->getCaZipcode()?>
		</div></td>
	</tr>
	<tr class="row0">
		<td><div align="left"><b>Tel&eacute;fonos:</b></div></td>
		<td colspan="2"><div align="left">  <?=$indicativo." ".$agente->getCaTelefonos()?>
		</div></td>
		<td><div align="left"><b>Fax:</b></div></td>
		<td><div align="left">
			<?=$indicativo." ".$agente->getCaFax()?>
		</div></td>
	</tr>
	<tr class="row0">
		<td><div align="left"><b>e-mail:</b></div></td>
		<td colspan="2"><div align="left">
			<?=$agente->getCaEmail()?>
		</div></td>
		<td><div align="left"><b>Website:</b></div></td>
		<td><div align="left">
			<?=$agente->getCaWebsite()?>
		</div></td>
	</tr>
	<tr class="row0">
		<td><div align="left"><b>Tipo:</b></div></td>
		<td colspan="2"><div align="left">
			<?=$agente->getCaTipo()?>
		</div></td>
		<td><div align="left"></div></td>
		<td><div align="left"></div></td>
	</tr>
	<tr class="row2">
		<td colspan="4" ><div align="left"><b>Contactos</b></div></td>
		<td >
		<?
		if( $nivel>0 ){
		?>
		<div align="right"><?=link_to(image_tag("16x16/new.gif"), "agentes/formContactos?idagente=".$agente->getcaIdagente())?></div>
		<?
		}else{
			echo "&nbsp;";
		}
		?>		</td>
	</tr>
		<?
		$c = new Criteria();
		$c->addJoin( ContactoAgentePeer::CA_IDCIUDAD,  CiudadPeer::CA_IDCIUDAD );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		$c->addDescendingOrderByColumn( ContactoAgentePeer::CA_SUGERIDO ); 
		$c->addAscendingOrderByColumn( ContactoAgentePeer::CA_NOMBRE ); 
		$contactos = $agente->getContactoAgentes( $c );
		$ultCiudad = null;
		
		if( count($contactos)==0 ){
			?>		
	<tr >
		<td colspan="5"><div align="left">No hay contactos registrados</div></td>		
	</tr>
		<?
		}
		
		foreach( $contactos as $contacto ){
			if( $ultCiudad!=$contacto->getCaIdciudad() ){
				$ultCiudad=$contacto->getCaIdciudad();
				$idtrafico=$contacto->getCiudad()->getCaidtrafico();
				$indicativo = "(".substr($idtrafico, strpos($idtrafico,"-")+1, 5 ).") (".substr($ultCiudad, strpos($ultCiudad,"-")+1, 5 ).")";
		?>
		
	<tr class="row2">
		<td colspan="5"><div align="left"><?=$contacto->getCiudad()->getCaCiudad()?></div></td>		
	</tr>
		<?
			}
		?>
	<tr class="<?=$contacto->getCaSugerido()?"yellow":"row0"?>">
		<td colspan="4" ><div align="left"><b><?=$contacto->getCaNombre()?></b></div></td>
		<td >
		<?
		if( $nivel>0 ){
		?>
		<div align="right"><?=link_to(image_tag("16x16/edit.gif"), "agentes/formContactos?idagente=".$agente->getcaIdagente()."&idcontacto=".$contacto->getCaIdcontacto())?></div>
		<?
		}else{
			echo "&nbsp;";
		}
		?>
		</td>
	</tr>	
	
	<tr >
		<td width="25%" rowspan="6">&nbsp;</td>
		<td >
			<div align="left"><b>Direcci&oacute;n:</b></div></td>
		<td colspan="3" ><?=$contacto->getCaDireccion()?></td>
	</tr>
	
	<tr >
		<td><div align="left"><b>Tel&eacute;fonos:</b></div></td>
		<td><div align="left"><?=$indicativo." ".$contacto->getCaTelefonos()?></div></td>
		<td><div align="left"><b>Fax:</b></div></td>
		<td><div align="left">
			<?=$indicativo." ".$contacto->getCaFax()?>
		</div></td>
	</tr>
	<tr >
		<td><div align="left"><b>e-mail:</b></div></td>
		<td><div align="left">
			<?=$contacto->getCaEmail()?>
		</div></td>
		<td><div align="left"></div></td>
		<td><div align="left"></div></td>
	</tr>
	<tr >
		<td><div align="left"><b>Atiende:</b></div></td>
		<td><div align="left">
			<?=str_replace("|", " ",$contacto->getCaImpoexpo())?>
		</div></td>
		<td><div align="left"><b>Transporte:</b></div></td>
		<td><div align="left">
			<?=str_replace("|", " ",$contacto->getCaTransporte() )?>
		</div></td>
	</tr>
	<tr >
		<td><div align="left"><b>Cargo:</b></div></td>
		<td><div align="left">
			<?=$contacto->getCaCargo()?>
		</div></td>
		<td><div align="left"><b>Detalles:</b></div></td>
		<td><div align="left">
			<?=$contacto->getCaDetalle()?>
		</div></td>
	</tr>
	<tr >
		<td><div align="left"><b>Sugerido en cotizaciones:</b></div></td>
		<td><div align="left">
			<?=$contacto->getCaSugerido()?"S&iacute;":"No"?>
		</div></td>
		<td><div align="left"></div></td>
		<td><div align="left"></div></td>
	</tr>
	
	<?
		}
	?>
	</table>
	

	<?
	}
	?>


</div>