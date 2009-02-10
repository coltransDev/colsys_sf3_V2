<?


use_helper("Object", "MimeType", "Popup", "Validation", "YUICalendar");
echo form_tag("traficos/nuevoMensajeSubmit?tipo=".$tipo."&reporteId=".$reporte->getCaidreporte() );

$repexpo = null;


$piezasArr = explode(" ",$reporte->getPiezas());
$piezas = $piezasArr[0];
$piezasTipo = isset($piezasArr[1])?$piezasArr[1]:"";

$pesoArr = explode(" ",$reporte->getPeso());
$peso = $pesoArr[0];
$pesoTipo = isset($pesoArr[1])?$pesoArr[1]:"";

$volArr = explode(" ",$reporte->getVolumen());
$vol = $volArr[0];
$volTipo = isset($volArr[1])?$volArr[1]:"";

$mn=$reporte->getIdNave();
$doctransporte=$reporte->getDoctransporte();
$mensaje = "";

$ets=$reporte->getETS();		
$eta=$reporte->getETA();
$fchcont=$reporte->getFchLlegadaCont();		


$introPreaviso="";
$introConfirmacion="";
		
//Mensaje para cuando la carga se ha embarcado
if( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" ){
	if( $reporte->getCaTransporte()=="Marítimo" ){
		
		
		$mensajeEmbarque = "- FAVOR TENER EN CUENTA QUE LA FECHA DE ARRIBO ES UN ESTIMADO. TAN PRONTO EL BUQUE LLEGUE A PUERTO, NUESTRO DEPARTAMENTO OPERATIVO MARITIMO LES NOTIFICARÁ.";
		if( $reporte->getCaContinuacion()=="OTM"  ){		
			$mensajeEmbarque .="<br />- COMO REQUISITO INDISPENSABLE PARA EFECTUAR EL OTM NECESITAMOS COPIA DE LA FACTURA COMERCIAL EN LA CUAL APAREZCA LA NEGOCIACION INCOTERM CON SU RESPECTIVO VALOR, ORIGINAL DEL CONOCIMIENTO DE EMBARQUE (HBL).";			
		}
		
		$mensajeReserva = "- FAVOR TENER EN CUENTA QUE LA FECHA DE ZARPE Y DE ARRIBO SON UN ESTIMADO. TAN PRONTO EL BUQUE ZARPE, NUESTRO DEPARTAMENTO DE TRAFICOS LES NOTIFICARÁ.";
		
		$introAviso = "Estimado cliente, nos complace informar que su carga salió con el siguiente detalle:";
		$intro ="";
		$mensaje = "Cualquier información adicional que ustedes requieran, con gusto le será suministrada.";
		
	}else{
		//Nota para Aéreo
		
		$mensajeReserva = "La fecha de llegada es estimada ya que puede variar, porque estamos sujetos al cupo de las aerolíneas.<br />Cualquier información adicional que ustedes requieran, con gusto le será suministrada.";
		
		$mensaje = "Cualquier información adicional que ustedes requieran, con gusto le será suministrada.";
		$mensajeEmbarque = $mensaje;
		$intro ="";	
		$introAviso="";	
		$introPreaviso="Estimado cliente, nos complace informar que estamos confirmando detalles de vuelo para el siguiente embarque:";
		$introConfirmacion="Estimado cliente, nos complace informar que la carga en referencia llego en el vuelo ______________. Este vuelo ___ ha sido despaletizado, la operacion de descargue del vuelo se esta realizando el dia _____ asi que probablemente tendremos documentos hasta el dia ___________.";
	}
}else{		
	//Exportaciones
	$mensajeEmbarque ="Favor pedir  a su cliente que verifique el  estado en que recibe la carga y  el peso  de cada una  de acuerdo con la lista de empaque. Cualquier diferencia que surja debe comunicarla al remitente, de lo Contrario se da por bien recibida la carga y a entera satisfacción.";
	$mensajeReserva = "";
	$mensaje = "Cualquier información adicional que ustedes requieran, con gusto le será suministrada.";
	
	$contacto = $reporte->getContacto();	
		
	$sucursal = $user->getSucursal();	
	$intro = $sucursal->getCaNombre().',  '.Utils::fechaLarga(date("Y-m-d")).'<br /><br />'.$contacto->getCaSaludo().': <br />';
	$intro .= $contacto->getCaNombres()." ".$contacto->getCaPapellido()." ".$contacto->getCaSapellido().'<br />Ciudad<br /><br />';
	$intro .= 'Apreciado/a '.$contacto->getCaSaludo().':';
	
	$introAviso = $intro.'<br /><br />Por medio de la presente estamos confirmando la salida  de la carga de los señores  '.$reporte->getConsignatario().' como  sigue:';
}

?>

<script language="javascript">
	function cambiarAviso(){		
		
		switch( document.getElementById('etapa').value){			
			case 'Carga con Reserva':
				var value = '<?=$mensajeReserva?>';
				var valueIntro = '<?=$intro?>';
				
				document.getElementById('infocarga').style.display="inline";
				document.getElementById('notas').value = value.split("<br />").join("\n");
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
					?>
					document.getElementById('est').innerHTML="Fecha Estimada de Salida:";
					var valueIntro = '<?=$intro?>';
					<?
				}else{
					?>
					var valueIntro = '<?=$introPreaviso?>';			
					<?
				}
				?>
				document.getElementById('estLlegada').innerHTML="Fecha de Estimada de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;	
			case 'Carga con Demora':
				var value = '<?=$mensaje?>';
				var valueIntro = '<?=$intro?>';
				//document.getElementById('infocarga').style.display="inline";
				document.getElementById('mensaje').value = value.split("<br />").join("\n");
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
				?>
					document.getElementById('est').innerHTML="Fecha Estimada de Salida:";
				<?
				}
				?>
				document.getElementById('estLlegada').innerHTML="Fecha de Estimada de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;
			case 'Carga Embarcada':
				var value = '<?=$mensajeEmbarque?>';
				var valueIntro = '<?=$introAviso?>';
				
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
					?>
					var valueIntro = '<?=$intro?>';
					
					<?
				}else{
					?>
					var valueIntro = '<?=$introAviso?>';
					<?
				}
				?>
				document.getElementById('est').innerHTML="Fecha de Salida:";
				document.getElementById('estLlegada').innerHTML="Fecha de Estimada de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;	
				
			case 'ETA':
				var value = '<?=$mensajeEmbarque?>';
				var valueIntro = '<?=$introAviso?>';
				//document.getElementById('infocarga').style.display="inline";
								
				document.getElementById('est').innerHTML="Fecha de Salida:";
				document.getElementById('estLlegada').innerHTML="Fecha de Estimada de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;	
			case 'En Bodega del Agente':
				var value = '<?=$mensaje?>';				
				var valueIntro = '<?=$intro?>';
				//document.getElementById('infocarga').style.display="inline";
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
				?>
				document.getElementById('est').innerHTML="Fecha de Salida:";
				<?
				}
				?>
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				document.getElementById('estLlegada').innerHTML="Fecha de llegada:";
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;	
			case 'Carga en Puerto de Destino':
				var value = '<?=$mensaje?>';
				var valueIntro = '<?=$intro?>';
				//document.getElementById('infocarga').style.display="inline";
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
				?>				
					document.getElementById('est').innerHTML="Fecha de Salida:";
				<?
				}
				?>
				document.getElementById('estLlegada').innerHTML="Fecha de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;
			case 'Carga en Aeropuerto de Destino':
				var value = '<?=$mensajeEmbarque?>';
				var valueIntro = '<?=$introConfirmacion?>';
				//document.getElementById('infocarga').style.display="inline";
				<?
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
				?>				
					document.getElementById('est').innerHTML="Fecha de Salida:";
				<?
				}
				?>
				document.getElementById('estLlegada').innerHTML="Fecha de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				document.getElementById('notas').value = value.split("<br />").join("\n");
				break;		
			default:
				var value = '<?=$mensaje?>';				
				var valueIntro = '<?=$intro?>';
				<?				
				if( $reporte->getCaImpoExpo()=="Exportación" || $reporte->getCaTransporte()=="Marítimo" ){
				?>
				document.getElementById('est').innerHTML="Fecha Estimada de Salida:";
				<?
				}
				?>
				document.getElementById('estLlegada').innerHTML="Fecha de Estimada de llegada:";
				document.getElementById('introduccion').value = valueIntro.split("<br />").join("\n");
				//document.getElementById('infocarga').style.display="none";					
				document.getElementById('notas').value = value.split("<br />").join("\n");		
				break;
		}
		
	}
</script>

<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableForm">
	<tr>
		<td colspan="3"><div align="center"><strong>Nuevo
				<?=$tipo=="aviso"?"Aviso":"Status"?>
				</strong></div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="left"><strong>Remitente:</strong> <br />
				<?
				echo "".$user->getNombre()." &lt;".$user->getEmail()."&gt;";
				?>
		</div></td>
		<td><div align="left"><strong>Solicitar Acuse de recibo:</strong> <br />
			<?=checkbox_tag("readreceipt", "true", false);?>
		</div></td>
	</tr>
	<tr>
		<td width="35%" valign="top"><div align="left" style="max-height:150px; overflow:auto;"><strong>Contactos Agente :</strong><br />
			<?
				$agente = $reporte->getAgente();
				if( $agente ){
					
					foreach( $contactosAg as $contactoAg ){
						echo checkbox_tag("destinatarios[]", $contactoAg->getCaEmail() )." ".$contactoAg->getCaNombre()."<br />";
					}
				}else{
					echo "&nbsp;";
				}
				?>
		</div></td>
		<td width="32%" valign="top"><div align="left"><strong>Enviar a </strong><br />
			<?		
			
			$contacto = $reporte->getContacto();	
			//echo checkbox_tag("destinatarios[]", $contacto->getCaEmail() , 1)." &nbsp;".$contacto->getCaNombres()." ".$contacto->getCaPApellido()."<br />";	
			if( $reporte->getCaConfirmarclie() ){
				$contactosClie = explode(",",$reporte->getCaConfirmarclie());
				
				foreach( $contactosClie as $contacto ){
					echo checkbox_tag("destinatarios[]", $contacto, 1 )." ".$contacto."<br />";
				}
			}
						
			
			if ( $reporte->getCaContinuacion()!="N/A" ) {
				echo checkbox_tag("copiar_cont", 1, 1  )." &nbsp;Coordinador OTM/DTA<br />";		
			}
			if ( $reporte->getCaSeguro()=="Sí" ) {
				$repseguro = $reporte->getRepSeguro();
				if( $repseguro ){
					$segConf = explode(",", $repseguro->getCaSeguroConf() ); 
					
					
					
					foreach( $segConf as $dest ){
						echo checkbox_tag("destinatarios[]", $dest, 1 )." &nbsp;Analista de Seguros<br />";						
					}
				}
				
			}
			if ( $reporte->getCaColmas()=="Sí" ) {
				$coordinador = $reporte->getCliente()->getCoordinador();
				if( $coordinador ){				
					echo checkbox_tag("copiar_adua", 1, 1  )." &nbsp;Coordinador Aduanas:<br />";		
				}else{
					echo "- No se ha definido coordinador de aduana en Maestra de Clientes<br />";
				}
			}			
			?>
		</div></td>
		<td width="33%" valign="top"><div align="left"><strong>Copiar a </strong><br />
			<?		
			if($sf_params->get('cc')){						
				$cc = $sf_params->get('cc');
			}	
			for( $i=0 ; $i<7; $i++ ){
				echo "".input_tag("cc[]",isset($cc[$i])&&$cc[$i]?$cc[$i]:"", "size=35 style=margin:2px")."<br />";
			}
			?>		
		</div></td>
	</tr>	
	<tr>
		<td colspan="3"><div align="left"><strong>Etapa:</strong><br />
			<?
			if( $tipo=="aviso" ){
				echo "ETA";
				echo input_hidden_tag("etapa", "ETA");
			}else{
				echo select_tag("etapa", objects_for_select( $etapas, "getCaValor" , "getCaValor", $reporte->getCaEtapaActual() ), "onChange=cambiarAviso() ");
			}
				
				?>
		</div></td>
	</tr>
	<tr>
		<td colspan="3"><div align="left"><strong>Asunto:</strong><br />
				<?
				
				$origen = $reporte->getOrigen()->getCaCiudad();
				$destino = $reporte->getDestino()->getCaCiudad();	
				if( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" ){
					$proveedor = $reporte->getProveedor();					
					$asunto = $proveedor." / ".$cliente." [".$origen." -> ".$destino."] Id.: ".$reporte->getCaConsecutivo();					
				}else{
					$consignatario = $reporte->getConsignatario();
					$asunto = $consignatario." / ".$cliente." [".$origen." -> ".$destino."] Id.: ".$reporte->getCaConsecutivo();	
				}
				
				?>
				<?=input_tag("asunto", $asunto , "size=120")?>
			</div></td>
	</tr>
	<tr>
		<td colspan="3">
			
			
			<div id="infocarga">
			<fieldset >
				<legend >Información de la carga</legend>
				<div align="left">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="31%"><div align="left"><strong>Origen:</strong><br />
									<?=$origen?>
							</div></td>
							<td width="35%">
								<?
								if( $reporte->getCaimpoExpo()=="Exportación" || ( $reporte->getCaImpoExpo()=="Importación" || $reporte->getCaImpoExpo()=="Triangulación" && $reporte->getCaTransporte()!="Aéreo") ){ //Segun ticket #608, impo aereo solo usa fch salida  
								?>
								<div align="left"><strong>
								<div id="est"></div>
										</strong><br />
									<?=form_error("fchsalida")?>		
									<?=yui_calendar("fchsalida", $ets?$ets:"", null, "2008-03-01" )?>
									<?=image_tag("16x16/no.gif", array("onClick"=>"document.getElementById('fchsalida').value=''") )?>
							</div>
								<?
								}
								?>							</td>
							<td width="34%">
								<?
								//Esto solamente lo necesita exportaciones
								if( $reporte->getcaimpoExpo()=="Exportación" ){
								?>								
									<div align="left"><strong>Hora de Salida:</strong><br />
										<?=input_tag("horasalida", "", "size=12 rich=true")?>
									</div>
								<?
								}else{
									echo "&nbsp;";
								}
								?>							</td>
						</tr>
						<tr>
							<td><div align="left"><strong>Destino:</strong><br />
									<?=$destino?>
							</div></td>
							<td colspan="2"><div align="left"><strong><div id="estLlegada"></div>
							</strong><br />
									<?=form_error("fchllegada")?>
									<?=yui_calendar("fchllegada", $eta?$eta:"", null, "2008-03-01" )?>
									<?=image_tag("16x16/no.gif", array("onClick"=>"document.getElementById('fchllegada').value=''") )?>
							</div></td>
						</tr>
						<?				
				if( $reporte->getCaContinuacion()!="N/A" ){
				?>
						<tr>
							<td><div align="left"><strong>Continuación:</strong><br />
									<?=$reporte->getCaContinuacion()." -> ".$reporte->getDestinoCont()?>
							</div></td>
							<td colspan="2"><div align="left"><strong>Fecha Estimada de Llegada:</strong><br />
									<?=form_error("fchcontinuacion")?>
									<?=yui_calendar("fchcontinuacion", $fchcont?$fchcont:'', null, "2008-03-01" )?>
									<?=image_tag("16x16/no.gif", array("onClick"=>"document.getElementById('fchcontinuacion').value=''") )?>
							</div></td>
						</tr>
						<?
				}
				?>
						<tr>
							<td><div align="left"><strong>Piezas:</strong><br />
									<?
						echo form_error("piezas");
						echo input_tag("piezas", $piezas , "size=8")."&nbsp;";
						echo select_tag("tipo_piezas",  objects_for_select($tipo_piezas, "getCavalor","getCavalor", $piezasTipo));
						?>
							</div></td>
							<td><div align="left"><strong>Peso:</strong><br />
									<?
						echo form_error("peso");
						echo input_tag("peso", $peso, "size=8")."&nbsp;";
						echo select_tag("tipo_peso",  objects_for_select($tipo_pesos, "getCavalor","getCavalor", $pesoTipo));
						?>
							</div></td>
							<td><div align="left"><strong>Volumen:</strong><br />
						<?
						echo form_error("volumen");
						echo input_tag("volumen", $vol, "size=8")."&nbsp;";
						echo select_tag("tipo_volumen",  objects_for_select($tipo_volumen, "getCavalor","getCavalor", $volTipo));
						?>
							</div></td>
						</tr>
						<tr>
							<td>
							<strong><?=$reporte->getCaTransporte()=="Marítimo"?"No. Hbl:":"Guia:"?></strong><br />								
							<?							
							echo form_error("doctransporte");
							echo input_tag("doctransporte", $doctransporte , "size=22 maxlength=20 ");
							?>							</td>
							<td><strong><?=$reporte->getCaTransporte()=="Marítimo"?"Motonave:":"Vuelo:"?></strong><br />								
							<?
							echo form_error("idnave");
							echo input_tag("idnave", $mn, "size=52 maxlength=50");
							?>							</td>
							<td><div align="left"></div></td>
						</tr>
				<?
				if( $parametros && count($parametros)>0 ){
					$parametro = $parametros[0];
				?>
						<tr>
							<td colspan="3">
							<strong><?=$parametro->getCaValor2()?></strong><br />								
							<?							
							echo form_error($parametro->getCaValor());
							$ordenreqdtno = $reporte->getProperty($parametro->getCaValor());
							echo yui_calendar($parametro->getCaValor(), $ordenreqdtno?$ordenreqdtno:'', null, "2008-03-01" ); 
							echo image_tag("16x16/no.gif", array("onClick"=>"document.getElementById('".$parametro->getCaValor()."').value=''") );	
							?></td>
						</tr>						
				<?
				}
				if( $reporte->getcaModalidad()=="FCL" ){
				?>
						<tr>
							<td><strong>No. Master:&nbsp;</strong><br />
								<?
						echo form_error("docmaster");
						echo input_tag("docmaster", "", "size=22 maxlength=100 ");
						?></td>
							<td colspan="2"><?
						if( $reporte->getcaModalidad()=="FCL" ){
						?>
								<strong> Equipos para el embarque :&nbsp;</strong>(Tipo
								<?=$reporte->getCaImpoExpo()=="Exportación"?"/serial":""?>
								/cantidad)<br />
								<table cellspacing="1" width="100%" border="0" class="tableForm">
									<tbody>
									<?
									$repequipos = $reporte->getRepEquipos();
									for( $i=0; $i<5; $i++){
										$repequipo = array_pop( $repequipos );
										if( !$repequipo ){
											$repequipo = new RepEquipo();
										}
									?>
										<tr>
											<td>
										<?
										echo select_tag("equipos[".$i."][tipo]", objects_for_select($equipos, "getCaIdConcepto", "getCaConcepto", $repequipo->getCaIdConcepto(), "include_blank=true" ))."&nbsp;";
										if( $reporte->getCaImpoExpo()=="Exportación" ){
											echo input_tag("equipos[".$i."][serial]", $repequipo->getCaIdEquipo(), "maxlength='11' size='11' ")."&nbsp;";
										}										
										echo input_tag("equipos[".$i."][cant]", $repequipo->getCaCantidad(), "maxlength=5 size=5 ");
										?>											</td>
										</tr>
										<?
									}
								
								?>
									</tbody>
								</table>
								<?
						}else{
							echo "&nbsp;";
						}
						?></td>
						</tr>
						<?
				}
				
					if( $reporte->getCaImpoExpo()=="Exportación" ){
						$repexpo = $reporte->getRepExpo();	
						if( $repexpo->getCaEmisionbl()=="Destino" ){												?>
						<tr>
							<td colspan="4"><div align="left"><strong>Datos en destino para reclamar el BL:</strong><br />
									<?=textarea_tag("datosbl",$repexpo->getCaDatosbl()?$repexpo->getCaDatosbl():"Empresa:\nTel:\nContacto:", array('rich'=>'fck', 'height' => 100,'width'=> 600 ))?>								
							</div></td>
								</tr>
						<?
						}
					}
					?>
								</table>
				</fieldset>			
				</div>
			</td>
	</tr>
	<tr>
		
		<td colspan="3">
			<div align="left"><strong>Introducci&oacute;n al mensaje:</strong><br />
				<?
				
				echo textarea_tag("introduccion", $intro, array('size'=>'120x3')); //,'rich'=>'fck', 'height' => 100,'width'=> 600 )				
				?>
				<br />
			</div>
			
			<div align="left"><strong>Descripci&oacute;n del Status</strong><br />
				<?
		
				echo textarea_tag("mensaje","", array('size'=>'120x4' ));
				?>		
				<br /><strong>Notas</strong><br />
				<?
				
				echo textarea_tag("notas","", array('size'=>'120x4' ));
				?>		
		</div></td>
	</tr>
	<?
	$fileIdx = 0;
	
	
	if( count($files) ){
	?>
	<tr>
		<td colspan="3"><div align="left"><strong>Adjuntar documento :</strong><br />
				<?			
			foreach( $files as $file ){
				$user->addFile( $file, $fileIdx );
				echo checkbox_tag("attachments[]", base64_encode($file) )." ".mime_type_icon( basename($file) )." ".link_popup(basename( $file ),"gestDocumental/fileViewer?idx=".$fileIdx."&token=".md5(time().basename($file)),"800","600" )."</br>";
				$fileIdx++;
			}
			?>
			</div></td>
	</tr>
	<?
	}
	
	if( $tipo!="aviso"){
	?>
	<tr>
		<td><div align="left"><strong>Fecha Recibido Status:</strong><br />
			<?=form_error("fchrecibo")?>				
			<?=yui_calendar("fchrecibo", date("Y-m-d"), null, "2008-03-01" )?>
		</div></td>
		<td colspan="2"><div align="left"><strong>Hora de Recibido - Formato 24h: (HH:mm)</strong><br />
				<?=form_error("horarecibo")?>
				<?=input_tag("horarecibo", "" , "size=20")?>
00-23hrs</div></td>
	</tr>
	<?
	}
	?>
	<tr>
		<td colspan="3">
			<div align="center">
				<?=submit_tag("Enviar", "class=button")?>
			</div>		</td>
	</tr>
</table>
<script language="javascript">
	<?
	if( $tipo=="aviso" ){
	?>
		document.getElementById('etapa').value="ETA";
	<?
	}
	?>
	cambiarAviso();
</script>
	

</form>
