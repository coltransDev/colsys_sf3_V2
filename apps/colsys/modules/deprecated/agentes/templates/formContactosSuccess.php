<div class="content" align="center">
	<h3>Maestra de Agentes - Contactos</h3>
	<br />
	<form action="<?=url_for("agentes/formContactos")?>" method="post">
	<?
	echo $form['idagente']->renderError();	
	$form->setDefault('idagente', $agente->getCaIdagente() ); 	 			   
	 echo $form['idagente']->render();
	?>
	<table cellspacing="1" width="50%" class="tableList">
		<tbody>
			<tr>
				<th colspan="4">Nuevos Datos para el Agente</th>
			</tr>
			<?
			if( $form->renderGlobalErrors() ){
			?>
			<tr>
				<td colspan="4" >				
				 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
			</tr>		
			<?
			}
			?>
			<tr>
				<td width="22%"><b>Agente</b></td>
				<td colspan="3">
					<?
					echo $agente->getCaNombre();					
					?>				</td>
			</tr>			
			<?			
			if( $contacto ){
			?>			
			<tr>
				<td><b>Identificaci&oacute;n:</b></td>
				<td colspan="3">
					<?
					echo $contacto->getCaIdcontacto();
					
					echo $form['idcontacto']->renderError();
					 if( $contacto ){
						$form->setDefault('idcontacto', $contacto->getCaIdcontacto() ); 
					 }			   
					 echo $form['idcontacto']->render();
					?>				</td>
			</tr>
			<?
			}
			?>			
			<tr>
				<td><b>Nombre:</b></td>
				<td colspan="3">				
				<?
				 echo $form['nombre']->renderError();
				 if( $contacto ){
					$form->setDefault('nombre', $contacto->getCaNombre() ); 
				 }			   
				 echo $form['nombre']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Apellido:</b></td>
				<td colspan="3">				
				<?
				 echo $form['apellido']->renderError();
				 if( $contacto ){
					$form->setDefault('apellido', $contacto->getCaApellido() ); 
				 }			   
				 echo $form['apellido']->render();
				 ?>				</td>
			</tr>
			
			<tr>
				<td><b>Direcci&oacute;n:</b></td>
				<td colspan="3">
				<?
				 echo $form['direccion']->renderError();
				 if( $contacto ){
					$form->setDefault('direccion', $contacto->getCaDireccion() ); 
				 }			   
				 echo $form['direccion']->render();
				 ?>				 </td>
			</tr>
			<tr>
				<td><b>Tel&eacute;fonos:</b></td>
				<td colspan="3">				
				<?
				 echo $form['telefonos']->renderError();
				 if( $contacto ){
					$form->setDefault('telefonos', $contacto->getCaTelefonos() ); 
				 }			   
				 echo $form['telefonos']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Fax:</b></td>
				<td colspan="3">
				<?
				 echo $form['fax']->renderError();
				 if( $contacto ){
					$form->setDefault('fax', $contacto->getCaFax() ); 
				 }			   
				 echo $form['fax']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Ciudad:</b></td>
				<td colspan="3">
				<?
				 echo $form['idciudad']->renderError();
				 if( $contacto ){
					$form->setDefault('idciudad', $contacto->getCaIdciudad() ); 
				 }			   
				 echo $form['idciudad']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Correo Electr&oacute;nico:</b></td>
				<td colspan="3">
				<?
				 echo $form['email']->renderError();
				 if( $contacto ){
					$form->setDefault('email', $contacto->getCaEmail() ); 
				 }			   
				 echo $form['email']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Atiende Impo/Expo :</b></td>
				<td width="31%">
				<?
				 echo $form['impoexpo']->renderError();
				 if( $contacto ){
					$form->setDefault('impoexpo', explode("|", $contacto->getCaImpoexpo() )); 
				 }			   
				 echo $form['impoexpo']->render();
				 ?>				</td>
				<td width="22%"><b>Transporte</b></td>
				<td width="25%"><?
				 echo $form['transporte']->renderError();
				 if( $contacto ){
					$form->setDefault('transporte', explode("|", $contacto->getCaTransporte() )); 
				 }			   
				 echo $form['transporte']->render();
				 ?></td>
			</tr>
			
			<tr>
				<td><b>Cargo:</b></td>
				<td colspan="3">
				
				<?
				 echo $form['cargo']->renderError();
				 if( $contacto ){
					$form->setDefault('cargo', $contacto->getCaCargo() ); 
				 }else{
				 	$form->setDefault('cargo', 'Contacto Operativo' ); 
				 }			   
				 echo $form['cargo']->render();
				 ?>				</td>
			</tr>
			<tr>
				<td><b>Detalles:</b></td>
				<td colspan="3">
				<?
				 echo $form['detalles']->renderError();
				 if( $contacto ){
					$form->setDefault('detalles', $contacto->getCaDetalle() ); 
				 }			   
				 echo $form['detalles']->render();
				 ?>				</td>
			</tr>
			
			<tr>
				<td><b>Cotizaciones :</b></td>
				<td colspan="3"><?
					 echo $form['sugerido']->renderError();
					 if( $contacto ){
						$form->setDefault('sugerido', $contacto->getCaSugerido() ); 
					 }			   
					 echo $form['sugerido']->render();
					 ?> Sugerir en cotizaciones
</td>
			</tr>
			<tr>
				<td><b>Activo: </b></td>
				<td colspan="3">
					<?
					 echo $form['activo']->renderError();
					 if( $contacto ){
						$form->setDefault('activo', $contacto->getCaActivo() ); 
					 }			   
					 echo $form['activo']->render();
					 ?>
					Activo<br /></td>
			</tr>
			
			<tr>
				<td colspan="4" ><div align="center">
			<input type="submit" value="Guardar" class="button" />&nbsp;
			
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("agentes/consultarAgentes?buscar=".$agente->getCaNombre())?>'" />
		</div></td>
		</tr>
		</tbody>
	</table>
	</form>


</div>
