<div class="content" align="center">
	<h3>Maestra de Agentes</h3>
	<br />
	<form action="<?=url_for("agentes/formAgentes")?>" method="post">
	
	
	<table cellspacing="1" width="50%" class="tableList">
		<tbody>
			<tr>
				<th colspan="2">Nuevos Datos para el Agente</th>
			</tr>
			<?
			if( $form->renderGlobalErrors() ){
			?>
			<tr>
				<td colspan="2" >				
				 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
			</tr>
			<?
			}
			
			if( $agente ){
			?>			
			<tr>
				<td><b>Identificaci&oacute;n:</b></td>
				<td>
					<?
					echo $agente->getCaIdagente();
					
					echo $form['idagente']->renderError();
					 if( $agente ){
						$form->setDefault('idagente', $agente->getCaIdagente() ); 
					 }			   
					 echo $form['idagente']->render();
					?>
					
					
					
				</td>
			</tr>
			<?
			}
			?>			
			<tr>
				<td><b>Nombre:</b></td>
				<td>
				
				<?
				 echo $form['nombre']->renderError();
				 if( $agente ){
					$form->setDefault('nombre', $agente->getCaNombre() ); 
				 }			   
				 echo $form['nombre']->render();
				 ?>				
				</td>
			</tr>
			<tr>
				<td><b>Direcci&oacute;n:</b></td>
				<td>
				<?
				 echo $form['direccion']->renderError();
				 if( $agente ){
					$form->setDefault('direccion', $agente->getCaDireccion() ); 
				 }			   
				 echo $form['direccion']->render();
				 ?>
				 </td>
			</tr>
			<tr>
				<td><b>Tel&eacute;fonos:</b></td>
				<td>
				
				<?
				 echo $form['telefonos']->renderError();
				 if( $agente ){
					$form->setDefault('telefonos', $agente->getCaTelefonos() ); 
				 }			   
				 echo $form['telefonos']->render();
				 ?>
				
				</td>
			</tr>
			<tr>
				<td><b>Fax:</b></td>
				<td>
				<?
				 echo $form['fax']->renderError();
				 if( $agente ){
					$form->setDefault('fax', $agente->getCaFax() ); 
				 }			   
				 echo $form['fax']->render();
				 ?>
				</td>
			</tr>
			<tr>
				<td><b>Ciudad:</b></td>
				<td>
				<?
				 echo $form['idciudad']->renderError();
				 if( $agente ){
					$form->setDefault('idciudad', $agente->getCaIdciudad() ); 
				 }			   
				 echo $form['idciudad']->render();
				 ?>
				</td>
			</tr>
			<tr>
				<td><b>Correo Electr&oacute;nico:</b></td>
				<td>
				<?
				 echo $form['email']->renderError();
				 if( $agente ){
					$form->setDefault('email', $agente->getCaEmail() ); 
				 }			   
				 echo $form['email']->render();
				 ?>
				</td>
			</tr>
			<tr>
				<td><b>P&aacute;gina Web:</b></td>
				<td>
				<?
				 echo $form['website']->renderError();
				 if( $agente ){
					$form->setDefault('website', $agente->getCaWebsite() ); 
				 }			   
				 echo $form['website']->render();
				 ?>
				</td>
			</tr>			
			<tr>
				<td><b>Zip Code:</b></td>
				<td>
				
				<?
				 echo $form['zipcode']->renderError();
				 if( $agente ){
					$form->setDefault('zipcode', $agente->getCaZipcode() ); 
				 }			   
				 echo $form['zipcode']->render();
				 ?>
				
				</td>
			</tr>
			<tr>
				<td><b>Tipo :</b></td>
				<td>
				<?
				 echo $form['tipo']->renderError();
				 if( $agente ){
					$form->setDefault('tipo', $agente->getCaTipo() ); 
				 }			   
				 echo $form['tipo']->render();
				 ?>
				</td>
			</tr>
			<tr>
				<td><b>Activo: </b></td>
				<td>
					<?
					 echo $form['activo']->renderError();
					 if( $agente ){
						$form->setDefault('activo', $agente->getCaActivo() ); 
					 }			   
					 echo $form['activo']->render();
					 ?>
					Activo<br /></td>
			</tr>
			
			<tr>
				<td colspan="2" ><div align="center">
			<input type="submit" value="Guardar" class="button" />&nbsp;
			
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("agentes/consultarAgentes?buscar=".$agente->getCaNombre())?>'" />
		</div></td>
		</tr>
			
		</tbody>
	</table>
	</form>


</div>
