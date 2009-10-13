<?
use_helper("Javascript", "Object", "Validation");

?>


<h3>Sistema administrador de negocios</h3>
<br />
<br />
<table cellspacing="1" width="700" id="mainTable">
	<tbody>
		<tr>
			<th colspan="6" class="titulo">REPORTE DE NEGOCIO</th>
		</tr>
		<tr>
			<th width="173" class="titulo">&nbsp;</th>
			<td width="122" class="mostrar"><div align="center"><b>Reporte No.:</b><br />
							<?=$reporteNegocio->getCaConsecutivo()?>
			</div></td>
			<td width="90" class="mostrar" ><div align="center"><span class="titulo"><b>Fecha</b></span><br />
							<?=Utils::fechaMes($reporteNegocio->getCaFchreporte())?>
			</div></td>
			<td width="107" class="mostrar"><div align="center"><b>Versi&oacute;n No.</b>:<br />
							<?=$reporteNegocio->getCaVersion()."/".$reporteNegocio->numVersiones()?>
			</div></td>
			<td width="85" class="mostrar"><div align="left"><b>Cotizaci&oacute;n</b><br /><?=$reporteNegocio->getCaIdCotizacion()?>
</div></td>
			<?
		/*$cotProducto = $reporteNegocio->getCotProducto();
		if( $cotProducto ){
			
			$id_cotizacion = $cotProducto->getCaIdcotizacion();
		}else{
			
			$id_cotizacion = null;
		}*/
		?>
			<td width="102" class="mostrar"><div align="center">
				<?
				//$id_cotizacion
				?>
			</div></td>
		</tr>
		<tr>
			<th class="titulo" colspan="6">INFORMACION GENERAL</th>
		</tr>
		<tr>
			<td class="captura" style="vertical-align: top;"><b>1.&nbsp;Impor/Exportaci&oacute;n</b></td>
			<td colspan="2" class="captura"><div align="center"><b>2.Origen</b></div></td>
			<td colspan="3" class="captura"><div align="center"><b>3. Destino </b></div></td>
		</tr>
		<tr>
			<td class="captura" style="vertical-align: top;"><div align="center">
				<?=Utils::replace($reporteNegocio->getCaImpoExpo())?>
			</div></td>
			<td colspan="2" class="listar"><div align="center">
				<?=$reporteNegocio->getOrigen()?>
			</div></td>
			<td colspan="3" class="listar"><div align="center">
				<?=$reporteNegocio->getDestino()?>
			</div></td>
		</tr>
		<tr>
			<td rowspan="2" class="captura" valign="top"><div align="center"><b>4. Fecha Despacho:</b><br />
							<?=Utils::fechaMes($reporteNegocio->getCaFchdespacho())?>
			</div></td>
			<td height="46" colspan="4" class="mostrar"><b>5. Agente: </b><br />
					<span class="listar">
						<?=$reporteNegocio->getAgente()?$reporteNegocio->getAgente():"Directo"?>
			</span></td>
			<td rowspan="2" class="invertir">
				<table width="100%" border="0" cellspacing="2">
					<tr>
						<td><div align="right">Editar reporte:<br />
										<?=link_to(image_tag("22x22/edit.gif"), "reportesNeg/formReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo."&token=".md5(time()) )?>
						</div></td>
					</tr>
					<tr>
						<td><div align="right">Anular Reporte:<br />
								<?=link_to(image_tag("16x16/no.gif"), "reportesNeg/anularReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo, "confirm='Esta seguro?'")?>
						</div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
			<td colspan="4" class="mostrar"><b>6. Descripci&oacute;n de la Mercanc&iacute;a:</b><br />				
				<?=Utils::replace($reporteNegocio->getCaMercanciaDesc())?>			</td>
		</tr>
		<tr>
			<td class="captura" valign="top"><b>Cliente</b></td>
			<td colspan="5" class="mostrar">		
				<?											
				$contacto = $reporteNegocio->getContacto();
				if( $contacto ){
					$cliente = $contacto->getCliente();
				?>
				
				<table cellspacing="1" width="500" border="0">
					<tbody>
						<tr>
							<td width="220" colspan="2"><b>8. Nombre:</b><br />
								<?=Utils::replace($cliente->getCaCompania())?></td>
							<td width="280" colspan="2"><b>8.1 Orden:</b><br />								
								<?=$reporteNegocio->getCaOrdenClie()?></td>
						</tr>
						<tr>
							<td colspan="2"><b>8.2 Contacto:</b><br />
								<?=Utils::replace($contacto->getNombre())?> </td>
							<td colspan="2"><b>8.3 Direcci&oacute;n:</b><br />
								<?=str_replace("|", " ", Utils::replace($cliente->getCaDireccion()))." ".Utils::replace($cliente->getCaComplemento())?></td>
						</tr>
						<tr>
							<td><b>8.4 Tel&eacute;fono:</b><br />
								<?=$contacto->getCaTelefonos()?></td>
							<td><b>8.5 Fax:</b><br /><?=$contacto->getCaFax()?></td>
							<td colspan="2"><b>8.6 Correo   Electr&oacute;nico:</b><br />
								<?=$contacto->getCaEmail()?></td>
						</tr>
					</tbody>
				</table>	
				<?
				}
				?>			</td>
		</tr>
		<tr>
			<td class="captura" valign="top"><b>Consignatario:</b></td>
			<td colspan="5" class="mostrar">
				<?
				$consignatario = $reporteNegocio->getConsignatario();
				if( $consignatario ){
				?>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><b>9.1 Nombre:					
							</b><br />
							
						<?=Utils::replace($consignatario->getCaNombre())?></td>
						<td><b>9.1 Enviar Informaci&oacute;n</b>:<br />
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=Utils::replace( $reporteNegocio->getCaInformarCons() )?>						</td>
					</tr>
					<tr>
						<td colspan="2"><b>9.1.2 Contacto:</b><br />
							<?=Utils::replace($consignatario->getCaContacto())?>							</td>
						<td><b>9.1.3 Direcci&oacute;n:</b><br />
							<?=Utils::replace($consignatario->getCaDireccion())?>							</td>
					</tr>
					<tr>
						<td><b>9.1.4 Tel&eacute;fono</b>:<br />
							<?=$consignatario->getCaTelefonos()?>					</td>
						<td><b>9.1.5 Fax</b>:<br />
							<?=$consignatario->getCaFax()?>					</td>
						<td><b>9.1.6 Correo Electr&oacute;nico</b>:<br />
							<?=$consignatario->getCaEmail()?>					</td>
					</tr>				
				</table>
				<?
				}
				?>			</td>
		</tr>
		<?
				$notify = $reporteNegocio->getNotify();
				if( $notify ){
				?>
		<tr>
			<td class="captura" valign="top"><b>Notify:</b></td>
			<td colspan="5" class="mostrar">
				
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><b>9.1 Nombre:					
							</b><br />
							
						<?=Utils::replace($notify->getCaNombre())?></td>
						<td><b>9.2 Enviar Informaci&oacute;n</b>:<br />
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=Utils::replace( $reporteNegocio->getCaInformarNoti() )?>						</td>
					</tr>
					<tr>
						<td colspan="2"><b>9.1.2 Contacto:</b><br />
							<?=Utils::replace($notify->getCaContacto())?>							</td>
						<td><b>9.2.3 Direcci&oacute;n:</b><br />
							<?=Utils::replace($notify->getCaDireccion())?>							</td>
					</tr>
					<tr>
						<td><b>9.2.4 Tel&eacute;fono</b>:<br />
							<?=$notify->getCaTelefonos()?>					</td>
						<td><b>9.2.5 Fax</b>:<br />
							<?=$notify->getCaFax()?>					</td>
						<td><b>9.2.6 Correo Electr&oacute;nico</b>:<br />
							<?=$notify->getCaEmail()?>					</td>
					</tr>				
				</table>
			</td>
		</tr>
		<?
		}
				
		if( $modo=="expo" ){
		?>
		<tr>
			<td valign="top" class="captura"><b>Informaci&oacute;n de exportaciones </b></td>
			<td colspan="5" class="mostrar">
			<?				
			include_component("reportesNeg","formExpo", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
			?>	
			</td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td rowspan="3" class="captura" valign="top"><b>Instrucciones:</b></td>
			<td class="listar" colspan="5"><b>11.1 Preferencias del Cliente:</b><br />
			<?=Utils::replace($reporteNegocio->getCaPreferenciasClie())?></td>
		</tr>
		<tr>
			<td class="listar" colspan="5">
				<b>11.2 Instrucciones Especiales para el Agente:</b>
				
				<br />
				<?=Utils::replace($reporteNegocio->getCaInstrucciones())?></td>
		</tr>
		<tr>
			<td height="28" colspan="5" class="listar">
				<b>11.3 Copiar comunicaciones a:</b><br />
				<?=$reporteNegocio->getCaConfirmarClie() ?>
				
			</td>
		</tr>
		<tr>
			<td rowspan="4" valign="top" class="captura"><b>12. Transporte:</b><br /><?=Utils::replace($reporteNegocio->getCaTransporte())?>			</td>
			<td colspan="2" class="listar"><b>13. Modalidad <br />
			</b><?=$reporteNegocio->getCaModalidad()?></td>
			<td colspan="3" class="listar"><b>14.1 L&iacute;nea Transporte:</b>			
			<br />
			<?
			$transporte = $reporteNegocio->getTransportador();
			if( $transporte ){
				echo $transporte->getCaNombre(); 
			}
			?>			
			
			<?
			if( $modo=="expo" ){			
				$repexpo = $reporteNegocio->getRepExpo();
				if( $repexpo->getCaIdlineaterrestre() ){
					?>
					<br />
					<b>14.2 Linea de transporte terrestre:</b><br />
					<?
					echo $repexpo->getTransportadorTerrestre();
				}				
			}	
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><b>15. Transporte terrestre <br /> 
				<?
				echo $reporteNegocio->getCaColmas()
				?>
			</b></td>
			<td colspan="3" class="listar"><b>16.&nbsp;Seguro:</b><br />
				<?
				echo $reporteNegocio->getCaSeguro()
				?>			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><b>Incoterms<br />
			</b><?=$reporteNegocio->getCaIncoterms()?></td>
			<td colspan="3" class="listar"><b>Consignar MAWB/BL a :<br />
			</b><?=$reporteNegocio->getConsignarmaster()?></td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><b>Consignar HAWB/HBL a :<br />
			</b><?=$reporteNegocio->getConsignar()?></td>
			<td colspan="3" class="listar">&nbsp;</td>
		</tr>
		<?
		
		if( $reporteNegocio->getCaColmas() == "Sí"  ){		
		?>
		
		<tr>
			<td valign="top" class="captura"><b>Transporte terrestre nacional: </b></td>
			<td colspan="5" class="listar">
				<?		
				include_component("reportesNeg", "formTransporteNal", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
				?>			</td>
		</tr>
		<?
		}
		if( $reporteNegocio->getCaSeguro() == "Sí"  ){			
		?>
		<tr>
			<td valign="top" class="captura"><b> Informaci&oacute;n para la aseguradora </b></td>
			<td colspan="5" class="listar">
				<?									
				include_partial("reportesNeg/formAseguradora", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
				?>			</td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td class="invertir" colspan="7"><div align="right">
				<?=$option!="liquidar"?link_to(image_tag("22x22/edit.gif"), "reportesNeg/consultaReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=expo&option=liquidar&token=".md5(time()) ):"&nbsp;"?>
			</div></td>
		</tr>				
		
			
		<tr>
			<td class="invertir" colspan="7"><div align="center"><b>CONCEPTOS EMBARQUE </b></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">
				<?
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportesNeg/guardarConcepto?reporteId=".$reporteNegocio->getCaIdreporte()."&token=".md5(time()), 
							"update"=>"embarque" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formConceptos id=formConceptos");
				
				}
				?>
				<div align="center" id="embarque">
					<?
					include_component("reportesNeg","relacionDeConceptos", array( "reporteNegocio"=>$reporteNegocio,  "editable"=>$option=="liquidar" ));
					?>
				</div>
				<?
				if( $option=="liquidar" ){
					echo "</form>";
				}
				?>			</td>
		</tr>
		<?		
	   if( $reporteNegocio->getCatransporte() != "Terrestre"  ){//Queda pendiente agreagar los conceptos en la tabla
			
	   ?>
		<tr>
			<td class="invertir" colspan="7"><div align="center"><b>RELACI&Oacute;N DE RECARGOS </b></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">				
				<?				
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportesNeg/guardarRecargo?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=origen&token=".md5(time()), 
							"update"=>"recargos_origen" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formRecargos id=formRecargos");
				
				}
				?>
				<div align="center" id="recargos_origen">
				<?
				//En exportaciones no es necesario diferenciar entre recargos de origen y locales, 
				//luego en este punto se muestran todos y los locales no se muestran 			
				include_component("reportesNeg", "relacionDeRecargos", array("reporteNegocio"=>$reporteNegocio, "tipo"=>"origen", "editable"=>$option=="liquidar" ))?>
				</div>
			<?
				if( $option=="liquidar" ){
					echo "</form>";
				}
				?>
			</tr>
			<?
			if( $modo=="impo" ){ 
			?>	
			<tr>
				<td class="invertir" colspan="7">
				
				<?								
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportesNeg/guardarRecargo?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=local&token=".md5(time()), 
							"update"=>"recargos_local" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formRecargosLoc id=formRecargosLoc");
				
				}
				?>
				<div align="center" id="recargos_local">
				<?			
				include_component("reportesNeg", "relacionDeRecargos", array("reporteNegocio"=>$reporteNegocio, "tipo"=>"local", "editable"=>$option=="liquidar" ))?>
				</div>
				<?
				if( $option=="liquidar" ){
					echo "</form>";
				}
				?>			</td>
		</tr>
		<?
		}
   }
   
	
	if( ($reporteNegocio->getCaImpoExpo()=="Importación" && $reporteNegocio->getCaColmas()=="Sí") || ($reporteNegocio->getCaImpoExpo()=="Exportación" && $repexpo->getCaIdSia()==17 ) ){
	?>
		<tr>
			<td class="invertir" colspan="7"><div align="center"><b>CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.</b></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">
				<?
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportesNeg/guardarCosto?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=expo&token=".md5(time()), 
							"update"=>"costos_colmas" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formColmas id=formColmas");
				
				}
				?>

			<div align="center" id="costos_colmas">
				<?
				echo include_component("reportesNeg", "relacionDeCostos", array("reporteNegocio"=>$reporteNegocio, "editable"=>$option=="liquidar"))?>
			</div>
			<?
			if( $option=="liquidar" ){
				echo "</form>";
			}
			?>			</td>
		</tr>
	<?
	}	
	$usuario = $reporteNegocio->getUsuario();
	$sucursal = $usuario->getSucursal();
	?>
	<tr>
		<td colspan="6"  >
			<table cellspacing="1" width="100%">
				<tbody>
					<tr>
						<td class="listar"><b>Ciudad :</b><br />
								<?=$sucursal?$sucursal->getCaNombre():""?>
								</td>
						<td class="listar"><b>Elabor&oacute; :</b><br />
								<center>
									<?=$reporteNegocio->getCaUsucreado()?>
								</center></td>
						<td class="listar"><b>Fecha:</b><br />
								<center>									
									<?=$reporteNegocio->getCaFchcreado()?>
								</center></td>
						<td colspan="2" class="listar"><b>Rep. Comercial:</b><br />
								<center>
									<?=$usuario->getCaNombre()?>
								</center></td>
					</tr>
					<tr height="5">
						<td colspan="5"></td>
					</tr>
					</tbody>
				</table>			
			</td>
		</tr>
	</tbody>
</table>
<br />
 
