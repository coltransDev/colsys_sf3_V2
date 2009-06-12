<div class="content" align="center">

<form action="<?=url_for("traficos/nuevoStatus?&idreporte=".$reporte->getCaidreporte() )?>" method="post" >


<table width="70%" border="0" class="tableList">
	<tr>
		<th colspan="2"><div align="center"><b>Nuevo Status </b></div></th>
		</tr>
	<tr>
		<td width="33%" valign="top"><b>Remitente</b></td>
		<td width="34%" valign="top">&nbsp;</td>
		</tr>
	<tr>
		<td valign="top">
			<b>Enviar a: </b><br />
			<?		
			
			$contacto = $reporte->getContacto();	
			//echo checkbox_tag("destinatarios[]", $contacto->getCaEmail() , 1)." &nbsp;".$contacto->getCaNombres()." ".$contacto->getCaPApellido()."<br />";	
			if( $reporte->getCaConfirmarclie() ){
				$contactosClie = explode(",",$reporte->getCaConfirmarclie());
				
				foreach( $contactosClie as $contacto ){
					?>
					<input type="checkbox" name="destinatarios[]" value="<?=$contacto?>" checked="checked"/><?=$contacto?><br />
					<?
					
				}
			}
						
			/*
			if ( $reporte->getCaContinuacion()!="N/A" ) {
				echo checkbox_tag("copiar_cont", 1, 1  )." &nbsp;Coordinador OTM/DTA<br />";		
			}
			if ( $reporte->getCaSeguro()=="Sí" ) {
				$repseguro = $reporte->getRepSeguro();
				if( $repseguro ){
					$segConf = explode(",", $repseguro->getCaSeguroConf() );
					$usuario = UsuarioPeer::retrieveByPk( $repseguro->getCaSeguroConf() );	
					if( $usuario ){
						echo checkbox_tag("destinatarios[]", $usuario->getCaEmail(), 1 )." &nbsp;Analista de Seguros<br />";								
					}						
				}
				
			}
			if ( $reporte->getCaColmas()=="Sí" ) {
				$repaduana = $reporte->getRepAduana();				
				$coordinador = null;
				if( $repaduana ){
					$coordinador = UsuarioPeer::retrieveByPk($repaduana->getCaCoordinador());
				}
				
				if( $coordinador ){				
					echo checkbox_tag("copiar_adua", 1, 1  )." &nbsp;".$coordinador->getCaNombre()."<br />";		
				}else{
					echo "- No se ha definido coordinador de aduana en Maestra de Clientes<br />";
				}
			}	*/		
			?>		</td>
		<td valign="top">
			<b>Copiar a: </b>
			<br />
			<?
			for( $i=0; $i<NuevoStatusForm::NUM_CC; $i++ ){
				 echo $form['cc_'.$i]->renderError(); 
				 echo $form['cc_'.$i]->render()."<br />";

			}
			?>		</td>
		</tr>
	<tr>
		<td>
			<b>Etapa:</b><br />
			 <?
			 echo $form['idetapa']->renderError(); 
			 echo $form['idetapa']->render();
			 ?>		</td>
		<td>&nbsp;</td>
		</tr>
	<tr>
		<td colspan="2"><b>Asunto:</b><br />
			 <?
			 echo $form['asunto']->renderError(); 
			 echo $form['asunto']->render();
			 ?>		</td>
	</tr>
	<tr>
		<td><b>Informaci&oacute;n de la carga</b></td>
		<td>&nbsp;</td>
		</tr>
	<tr>
		<td colspan="2">
			<table width="100%" border="0" class="tableList">
			<tr>
				<td><b>Origen</b>:<br />
					<?=$reporte->getOrigen()?>
				</td>
				<td><b><b>Fecha de salida:</b></b></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><b>Destino:</b><br />
					<?=$reporte->getDestino()?>	
				</td>
				<td><b><b>Fecha de llegada:</b></b></td>
				<td>&nbsp;</td>
			</tr>
			<?				
			if( $reporte->getCaContinuacion()!="N/A" ){
			?>
			<tr>
				<td><b>Continuación:</b><br />
					<?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?>			
				</td>
				<td><b><b>Fecha de llegada:</b></b></td>
				<td>&nbsp;</td>
			</tr>
			<?
			}
			?>
			<tr>
				<td><b>Piezas</b>:<br />
				<?
				 echo $form['piezas']->renderError(); 
				 echo $form['piezas']->render()."&nbsp;";
				 echo $form['un_piezas']->render()."&nbsp;";
				 ?>				
				</td>
				<td><b>Peso</b>:<br />
					<?
					 echo $form['peso']->renderError(); 
					 echo $form['peso']->render()."&nbsp;";
					 echo $form['un_peso']->render()."&nbsp;";
					 ?>
				</td>
				<td><b>Volumen</b>:<br />
					<?
					 echo $form['volumen']->renderError(); 
					 echo $form['volumen']->render()."&nbsp;";
					 echo $form['un_volumen']->render()."&nbsp;";
					 ?>
				</td>
			</tr>
			<tr>
				<td><b>Guia</b>:</td>
				<td><b>Vuelo</b>:</td>
				<td>&nbsp;</td>
			</tr>
		</table></td>
		</tr>
	<tr>
		<td colspan="2"><b>Introducci&oacute;n al mensaje:</b><br />
			 <?
			 echo $form['introduccion']->renderError(); 
			 echo $form['introduccion']->render();
			 ?>		</td>
	</tr>
	<tr>
		<td colspan="2"><b>Descripci&oacute;n del Status</b><br />
			 <?
			 echo $form['mensaje']->renderError(); 
			 echo $form['mensaje']->render();
			 ?>		</td>
		</tr>
	<tr>
		<td colspan="2"><b>Notas</b><br />
			 <?
			 echo $form['notas']->renderError(); 
			 echo $form['notas']->render();
			 ?>		
		</td>
	</tr>
	<tr>
		<td><b>Fecha Recibido Status:</b></td>
		<td><b>Hora de Recibido - Formato 24h: (HH:mm)</b><br />
			<?
			 echo $form['horarecibo']->renderError(); 
			 echo $form['horarecibo']->render();
			 ?>
		</td>
		</tr>
	<tr>
		<td colspan="2"><div align="center">
			<input type="submit" value="Enviar" class="button" />
		</div></td>
		</tr>
</table>



</form>
</div>