<?

use_helper("MimeType");

if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
	$contacto = $reporte->getContacto();	
		
	$sucursal = SucursalPeer::retrieveByPk( $user->getIdSucursal() );	
	$saludo = $sucursal->getCaNombre().',  '.Utils::fechaLarga(date("Y-m-d")).'\n\n'.$contacto->getCaSaludo().': \n';
	$saludo .= $contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido().'\nCiudad\n\n';
	$saludo .= 'Apreciado/a '.$contacto->getCaSaludo().':';
	
	$saludoAviso = $saludo.'\n\nPor medio de la presente estamos confirmando la salida  de la carga de los señores  '.$reporte->getConsignatario().' como  sigue:';
}

/*$saludo = $textos['saludo'];	
if( date("G")<12 ){
	$saludo .= "buenos días:"; 
}elseif( date("G")<18 ){
	$saludo .= "buenas tardes:"; 
}else{
	$saludo .= "buenas noches:"; 
}*/



?>
<script language="javascript" type="text/javascript">

var validarMensaje=function(){
	document.form1.mensaje_dirty.value = "1";
}

var mostrar=function( oid ){
		
	var tipo = document.form1.idetapa;
	var value='';	
	for (i=0;i<tipo.length;i++){		
		  if ( tipo[i].selected ){
				 value = tipo[i].value;
				 break;
		  }
	} 
	
	var divmensaje = document.getElementById('divmensaje');
	var mensaje = document.form1.mensaje;
	var mensaje_mask = document.form1.mensaje_mask;
		
	switch( value ){
		<?
		foreach( $etapas as $etapa ){
		?>
		case '<?=$etapa->getCaIdetapa()?>':
			var val = '<?=str_replace("\n", "<br />", $etapa->getCaMessage())?>';			
			divmensaje.innerHTML = val.split("<br />").join("\n");
			mensaje_mask.value = val.split("<br />").join("\n");		
			break;
		<?
		}
		?>
		default:
			divmensaje.innerHTML = '';
			mensaje_mask.value = '';
			break;
	}
	
	switch( value ){
		<?
		foreach( $etapas as $etapa ){
			if( $etapa->getIntroAsunto() ){
			?>
			case '<?=$etapa->getCaIdetapa()?>':						
				document.getElementById("asuntoIntro").innerHTML = "<?=$etapa->getIntroAsunto()?>";								
				break;
			<?
			}
		}
		?>
		default:			
			document.getElementById("asuntoIntro").innerHTML = "";				
			break;
	}
	
	
	if( !document.form1.mensaje_dirty.value ){
		switch( value ){
			<?
			foreach( $etapas as $etapa ){
			?>
			case '<?=$etapa->getCaIdetapa()?>':
				var val = '<?=str_replace("\n", "<br />", $etapa->getCaMessageDefault())?>';
				mensaje.value = val.split("<br />").join("\n");
				break;
			<?
			}
			?>
			default:			
				mensaje.value = '';
				break;
		}	
	}
	
	
	
	switch( value ){
		<?
		foreach( $etapas as $etapa ){
			if( $etapa->getCaIntro() ){
			?>
			case '<?=$etapa->getCaIdetapa()?>':
				var val = '<?=str_replace("\n", "<br />", $etapa->getCaIntro())?>';
				document.form1.introduccion.value = val.split("<br />").join("\n");
				
				break;
			<?
			}
		}
		if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
		?>
		case 'EECEM':
				var val = '<?=str_replace("\n", "<br />", $saludoAviso)?>';
				document.form1.introduccion.value = val.split("<br />").join("\n");			
				break;
		case 'EEETA':
				var val = '<?=str_replace("\n", "<br />", $saludoAviso)?>';
				document.form1.introduccion.value = val.split("<br />").join("\n");				
				break;
		<?
		}
		?>
		default:
			var val = '<?=str_replace("\n", "<br />", $textos['saludo']	)?>';
			document.form1.introduccion.value = val.split("<br />").join("\n");				
			break;
	}
	
	
	
	
}

var crearSeguimiento=function(){
	if(document.getElementById("prog_seguimiento").checked){
		document.getElementById("row_seguimiento").style.display="";
	}else{
		document.getElementById("row_seguimiento").style.display="none";
	}
}	

</script>


<div class="content" align="center">

<form action="<?=url_for("traficos/nuevoStatus?modo=".$modo."&idreporte=".$reporte->getCaidreporte() )?>" method="post" name="form1" >
<?
echo $form['mensaje_dirty']->render();
echo $form['mensaje_mask']->render();

if( !sfConfig::get("app_smtp_user") ){
?>

<?=image_tag("22x22/alert.gif")?>La autenticación SMTP se encuentra desactivada, es posible que sus mensajes no lleguen al destinatario.
<br />
<br />


<?
}
?>



<table width="60%" border="0" class="tableList">
	<tr>
		<th colspan="2"><div align="center"><b>Nuevo <?=$tipo=="aviso"?"Aviso":"Status"?> </b></div></th>
	</tr>
	<?
	if( $form->renderGlobalErrors() ){
	?>
	<tr>
		<td colspan="2">				
		 <div align="left"><?php echo $form->renderGlobalErrors() ?>		</div></td>	
	</tr>
	<?
	}
	?>	
	<tr>
		<td width="50%" >				
			<div align="left"><b>Cliente:</b><br /><?=$reporte->getCliente()->getCaCompania()?></div>		</td>	
		<td width="50%" >				
			 <div align="left"><b>Reporte:</b><br /><?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?></div>		</td>	
	</tr>
	
	<tr>
		<td valign="top"><div align="left"><b>Remitente:</b>
			<?
			if($user->getIdSucursal()=="BOG" && $reporte->getCaTransporte()==Constantes::MARITIMO && $reporte->getCaImpoexpo()==Constantes::IMPO ){			
				echo $form['remitente']->renderError(); 			
				echo $form['remitente']->render();					
			}else{
				echo $usuario->getCaNombre()." &lt;".$usuario->getCaEmail()."&gt;";
			}
			?>	
		</div></td>
		<td valign="top"><div align="left">&nbsp;</div></td>
	</tr>
	
	<tr>
		<td valign="top">
			<div align="left"><b>Enviar a: </b><br />
					<?		
			$destinatarios = $form->getDestinatarios();
			for( $i=0; $i< count($destinatarios) ; $i++ ){					
				 echo $form['destinatarios_'.$i]->renderError(); 
				 $form->setDefault('destinatarios_'.$i, 1 ); 	
				 echo $form['destinatarios_'.$i]->render().$form['destinatarios_'.$i]->renderLabel()."<br />";
			}
						
			if ( $reporte->getCaContinuacion()!="N/A" && $reporte->getCaTransporte()==Constantes::MARITIMO ) {
				echo " &nbsp;&nbsp;&nbsp;Coordinador OTM/DTA<br />";		
			}
			
			if ( $reporte->getCaSeguro()=="Sí" ) {
				$repseguro = $reporte->getRepSeguro();
				if( $repseguro ){
					
					$usuario = UsuarioPeer::retrieveByPk( $repseguro->getCaSeguroConf() );	
					if( $usuario ){
						echo " &nbsp;&nbsp;&nbsp;Seguros: ".$usuario->getCaEmail()."<br />";
						if( $usuario->getCaEmail()!="seguros@coltrans.com.co" ){
							echo " &nbsp;&nbsp;&nbsp;Seguros: seguros@coltrans.com.co<br />";	
						}		
					}else{
						echo " &nbsp;&nbsp;&nbsp;Seguros: seguros@coltrans.com.co<br />";								
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
					echo " &nbsp;&nbsp;&nbsp;".$coordinador->getCaNombre()."<br />";		
				}else{
					echo "- No se ha definido coordinador de aduana en Maestra de Clientes<br />";
				}
			}			
			?>		
			</div></td>
		<td valign="top">
			<div align="left"><b>Copiar a: </b>
					<br />
					<?
			for( $i=0; $i<NuevoStatusForm::NUM_CC; $i++ ){
				 echo $form['cc_'.$i]->renderError(); 
				 echo $form['cc_'.$i]->render()."<br />";

			}
			?>		
			</div></td>
		</tr>
	<tr>
		<td>
			<div align="left"><b>Etapa:</b><br />
					<?
			 echo $form['idetapa']->renderError(); 
			 if( $tipo=="aviso" ){
			 	if( $reporte->getCaImpoexpo()==Constantes::EXPO ){
				 	$form->setDefault('idetapa', "EEETA" ); 	
				}else{
				 	$form->setDefault('idetapa', "IMETA" ); 	
				}
			 }else{
			 	if( $ultStatus ){
					$form->setDefault('idetapa', $ultStatus->getCaIdetapa() ); 			 
				}
			 }
			 echo $form['idetapa']->render();
			 ?>		
			</div></td>
		<td><div align="left"></div></td>
	</tr>
	<?	
	$asunto = "";
				
	$origen = $reporte->getOrigen()->getCaCiudad();
	$destino = $reporte->getDestino()->getCaCiudad();
	$cliente = $reporte->getCliente();			
	
	if( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" ){
		$proveedor = substr($reporte->getProveedoresStr(),0,130);					
		$asunto .= $proveedor." / ".$cliente." [".$origen." -> ".$destino."] ".$reporte->getCaOrdenClie();					
	}else{
		$consignatario = $reporte->getConsignatario();
		$asunto .= $consignatario." / ".$cliente." [".$origen." -> ".$destino."] ";	
	}
	
	
	
	?>
	<tr>
		<td colspan="2"><div align="left"><b>Asunto:</b><br />
			<div id="asuntoIntro"></div> 
			<?
			 echo " Id.: ".$reporte->getCaConsecutivo()." ";
			 echo $form['asunto']->renderError(); 			 
			 echo $form->setDefault('asunto', $asunto); 
			 echo $form['asunto']->render();
			 ?>		
		</div></td>
	</tr>
	<?
	
	?>
	<tr>
		<td><div align="left"><b>Informaci&oacute;n de la carga</b></div></td>
		<td><div align="left"></div></td>
		</tr>
	<tr>
		<td colspan="2">
			<table width="100%" border="0" class="tableList">
			<tr>
				<td width="34%"><div align="left"><b>Origen</b>:<br />
						<?=$reporte->getOrigen()?>	
									
				</div></td>
				<td width="31%"><div align="left"><b>Fecha de salida:</b><br />
					<?			
					echo $form['fchsalida']->renderError(); 
					if( $ultStatus ){	
					 	$form->setDefault('fchsalida', $ultStatus->getCaFchsalida() ); 
					 }
					echo $form['fchsalida']->render();
					?>		
				</div></td>
				<td width="35%">
					<div align="left">
					<?
					if( $reporte->getCaImpoexpo()==Constantes::EXPO ){					
					?>
					<b>Hora de salida:</b><br />
					<?
						echo $form['horasalida']->renderError(); 
						if( $ultStatus ){
							$form->setDefault('horasalida', $ultStatus->getCaHorasalida() ); 
						}
						echo $form['horasalida']->render();					
					}else{
						echo "&nbsp;";
					}
					?>
					</div></td>
			</tr>
			<tr>
				<td><div align="left"><b>Destino:</b><br />
						<?=$reporte->getDestino()?>				
				</div></td>
				<td><div align="left"><b>Fecha de llegada:</b><br />
					<?			
					echo $form['fchllegada']->renderError(); 
					if( $ultStatus ){	
					 	$form->setDefault('fchllegada', $ultStatus->getCaFchllegada() ); 
					 }
					echo $form['fchllegada']->render();
					?>
					
					
				</div></td>
				<td>&nbsp;					</td>
			</tr>
			<?				
			if( $reporte->getCaContinuacion()!="N/A" ){
			?>
			<tr>
				<td><div align="left"><b>Continuación:</b><br />
						<?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?>				
				</div></td>
				<td><div align="left"><b><b>Fecha de llegada:</b></b></div></td>
				<td><div align="left">
					<?			
					echo $form['fchcontinuacion']->renderError(); 
					if( $ultStatus ){	
					 	$form->setDefault('fchcontinuacion', $ultStatus->getCaFchcontinuacion() ); 
					 }
					echo $form['fchcontinuacion']->render();
					?>
				</div></td>
			</tr>
			<?
			}
			?>
			<tr>
				<td><div align="left"><b>Piezas</b>:<br />
					<?
					 echo $form['piezas']->renderError(); 					 
					 if( $ultStatus && $ultStatus->getCaPiezas() ){	
					 	$piezasArr = explode("|",$ultStatus->getCaPiezas());
						$piezas = $piezasArr[0];
						$piezasTipo = isset($piezasArr[1])?$piezasArr[1]:"";								
					 	$form->setDefault('piezas', $piezas); 
						$form->setDefault('un_piezas', $piezasTipo); 
					 }					 
					 echo $form['piezas']->render()."&nbsp;";
					 echo $form['un_piezas']->render()."&nbsp;";
					 ?>				
				</div></td>
				<td><div align="left"><b>Peso</b>:<br />
					<?				
					 echo $form['peso']->renderError(); 					 
					 if( $ultStatus && $ultStatus->getCaPeso() ){	
					 	$pesoArr = explode("|",$ultStatus->getCaPeso());
						$peso = $pesoArr[0];
						$pesoTipo = isset($pesoArr[1])?$pesoArr[1]:"";								
					 	$form->setDefault('peso', $peso); 
						$form->setDefault('un_peso', $pesoTipo); 
					 }
					 echo $form['peso']->render()."&nbsp;";						
					 echo $form['un_peso']->render()."&nbsp;";
					 ?>				
				</div></td>
				<td><div align="left"><b>Volumen</b>:<br />
						<?
					 echo $form['volumen']->renderError(); 
					 if( $ultStatus && $ultStatus->getCaVolumen() ){	
					 	$volArr = explode("|",$ultStatus->getCaVolumen());
						$vol = $volArr[0];
						$volTipo = isset($volArr[1])?$volArr[1]:"";								
					 	$form->setDefault('volumen', $vol); 
						$form->setDefault('un_volumen', $volTipo); 
					 }					 
					 echo $form['volumen']->render()."&nbsp;";
					 echo $form['un_volumen']->render()."&nbsp;";
					 ?>				
				</div></td>
			</tr>
			<tr>
				<td><div align="left"><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"HBL:":"HAWB:"?></b><br />
						<?
					 echo $form['doctransporte']->renderError(); 
					 if( $ultStatus ){	
					 	$form->setDefault('doctransporte', $ultStatus->getCaDoctransporte() ); 
					 }
					 echo $form['doctransporte']->render();
					 ?>				
				</div></td>
				<td><div align="left"><b><?=$reporte->getCaTransporte()==Constantes::MARITIMO?"Motonave:":"Vuelo:"?></b><br />
					
						<?
					 echo $form['idnave']->renderError(); 
					 if( $ultStatus ){	
					 	$form->setDefault('idnave', $ultStatus->getCaIdnave() ); 
					 }
					 echo $form['idnave']->render();
					 ?>
				</div></td>
				<td><div align="left"></div></td>
			</tr>
			
			
			<?
			$widgets = $form->getWidgetsClientes();
			if( count($widgets)>0 ){
				foreach( $widgets as $name=>$val ){									
			?>
					<tr>
						<td colspan="3">
						
							<div align="left">
								<?
							 echo "<b>".$val["label"].":</b><br />"; 
							 echo $form[$name]->renderError(); 
							 if( $ultStatus ){	
								$form->setDefault($name, $reporte->getProperty($name) ); 
							 }
							 echo $form[$name]->render();
							 ?>
								</div></td>
					</tr>						
			<?
				}
			}
			
			if( $reporte->getcaModalidad()=="FCL" ){
			?>
			<tr>
				<td valign="top"><b>No. Master:</b>
				<?
				 echo $form['docmaster']->renderError(); 
				 if( $ultStatus ){	
					$form->setDefault('docmaster', $ultStatus->getCaDocmaster() ); 
				 }
				 echo $form['docmaster']->render();
				 ?>				</td>
				
				
				<td colspan="2">
					<b> Equipos para el embarque :&nbsp;</b><br />
					<table  width="100%" border="1" class="tableList">
						<tbody>
							<tr>
								<th width="34%">Tipo</th>
								<?
								if( $reporte->getCaImpoExpo()==Constantes::EXPO ){
								?>
								<th width="21%">Serial</th>
								<?
								}
								?>
								<th width="45%">Cantidad</th>
							</tr>
						<?
						$repequipos = $reporte->getRepEquipos();
						for( $i=0; $i<NuevoStatusForm::NUM_EQUIPOS; $i++){
							$repequipo = array_pop( $repequipos );
						?>
							<tr>
								<td>
								<?
								 echo $form['equipos_tipo_'.$i]->renderError(); 
								 if( $repequipo ){	
									$form->setDefault('equipos_tipo_'.$i, $repequipo->getCaIdConcepto() ); 
								 }
								 echo $form['equipos_tipo_'.$i]->render();
								?>								</td>
								<?
								if( $reporte->getCaImpoExpo()==Constantes::EXPO ){
								?>
									<td>
									<?
									 echo $form['equipos_serial_'.$i]->renderError(); 
									 if( $repequipo ){	
										$form->setDefault('equipos_serial_'.$i, $repequipo->getCaIdEquipo() ); 
									 }
									 echo $form['equipos_serial_'.$i]->render();
									?>									</td>	
								<?
								}
								?>
								<td>
								<?
								 echo $form['equipos_cant_'.$i]->renderError(); 
								 if( $repequipo ){	
									$form->setDefault('equipos_cant_'.$i, $repequipo->getCaCantidad() ); 
								 }
								 echo $form['equipos_cant_'.$i]->render();
								?>								</td>											
							</tr>
							<?
						}
					
					?>
						</tbody>
					</table>				</td>				
			</tr>
			<?
			}
			?>		
		</table></td>
	</tr>
	
	<?
			if( $reporte->getCaImpoExpo()==Constantes::EXPO ){
				$repexpo = $reporte->getRepExpo();	
				//if( $repexpo->getCaEmisionbl()=="Destino" ){												?>
				<tr>
					<td colspan="2"><div align="left"><b>Datos en destino para reclamar el BL:</b><br />
							<?
							echo $form['datosbl']->renderError(); 
							$datosbl = str_replace("<br />", "\n" , $repexpo->getCaDatosbl());	
							$form->setDefault('datosbl',$repexpo->getCaDatosbl()?$datosbl:"Empresa:\nTel:\nContacto:" ); 
							echo $form['datosbl']->render();
							
							?>								
					</div></td>
				</tr>
				<?
				//}
			}
			?>
	
	<tr>
		<td colspan="2"><div align="left"><b>Introducci&oacute;n al mensaje:</b><br />
			<?
			echo $form['introduccion']->renderError(); 
			$form->setDefault('introduccion', $textos['saludo'] ); 
			echo $form['introduccion']->render();
			
			?>		
		</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="left"><b>Descripci&oacute;n del Status</b><br />
			<div id="divmensaje"></div>
			<?
			 echo $form['mensaje']->renderError(); 
			 echo $form['mensaje']->render();
			 ?>		
		</div></td>
		</tr>
	<?
	/*
	<tr>
		<td colspan="2"><div align="left"><b>Notas</b><br />
				<?
			// echo $form['notas']->renderError(); 
			// echo $form['notas']->render();
			 ?>		
		</div></td>
	</tr>
	*/
	
	if( count($files)>0 ){
	?>
	<tr>
		<td colspan="2">
			<div align="left"><b>Adjuntar documento:</b><br />
				
					<?		
			foreach( $files as $file ){
				
				if(  array_search( $file, $att )!==false ){
					$option = 'checked="checked"';					
				}else{
					$option = '';
				}
				?>
				<input type="checkbox" name="attachments[]" value="<?=base64_encode($file)?>"  <?=$option?> />  
				<?
				echo mime_type_icon( basename($file) )." ".link_to(basename( $file ), url_for("traficos/fileViewer?idreporte=".$reporte->getCaIdreporte()."&file=".base64_encode(basename($file)) ) )."<br />";				
			}
			?>
				</div></td>
	</tr>
	<?
	}
	?>
	<tr>
		<td><div align="left"><b>Fecha Recibido Status:</b><br />
				<?			
			echo $form['fchrecibo']->renderError(); 
			echo $form['fchrecibo']->render();
			?>		
		</div></td>
		<td><div align="left"><b>Hora de Recibido - Formato 24h: (HH:mm)</b><br />
				<?
			 echo $form['horarecibo']->renderError(); 
			 echo $form['horarecibo']->render();
			 ?>		
		</div></td>
	</tr>
	<?
	$tarea = $reporte->getNotTarea();
	?>
	<tr>
		<td colspan="2"><div align="left"><b>Programar seguimiento:</b>
			<?
			 echo $form['prog_seguimiento']->renderError(); 
			 if( $tarea ){
			 	$form->setDefault('prog_seguimiento', true ); 
			 }	
			 echo $form['prog_seguimiento']->render();
			 ?>
			 
			 </div></td>
	</tr>
	<tr>
		<td colspan="2" id="row_seguimiento"><div align="left"><b>Fecha seguimiento:</b>
				<?
			 echo $form['fchseguimiento']->renderError();
			 if( $tarea ){
			 	$form->setDefault('fchseguimiento', $tarea->getCaFchvencimiento("Y-m-d") ); 
			 }			   
			 echo $form['fchseguimiento']->render();
			 ?>
		</div>			
		<br />
		<div align="left"><b>Recordar sobre:</b>
				<?
			 echo $form['txtseguimiento']->renderError(); 
			 if( $tarea ){
			 	$form->setDefault('txtseguimiento', $tarea->getCaTexto() ); 
			 }	
			 echo $form['txtseguimiento']->render();
			 ?>
			</div></td>
		</tr>
	<tr>
		<td colspan="2"><div align="center">
			<input type="submit" value="Enviar" class="button" />&nbsp;
			
			<input type="button" value="Cancelar" class="button" onClick="document.location='<?=url_for("traficos/listaStatus?modo=".$modo."&reporte=".$reporte->getCaConsecutivo())?>'" />
		</div></td>
		</tr>
</table>



</form>
</div>
<script language="javascript" type="text/javascript">
	mostrar();
	crearSeguimiento();
</script>