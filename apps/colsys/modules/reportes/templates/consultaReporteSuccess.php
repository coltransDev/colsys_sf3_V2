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
			<td width="122" class="mostrar"><div align="center"><strong>Reporte No.:</strong><br />
							<?=$reporteNegocio->getCaConsecutivo()?>
			</div></td>
			<td width="90" class="mostrar" ><div align="center"><span class="titulo"><strong>Fecha</strong></span><br />
							<?=Utils::fechaMes($reporteNegocio->getCaFchreporte())?>
			</div></td>
			<td width="107" class="mostrar"><div align="center"><strong>Versi&oacute;n No.</strong>:<br />
							<?=$reporteNegocio->getCaVersion()."/".$reporteNegocio->numVersiones()?>
			</div></td>
			<td width="85" class="mostrar"><div align="center"><span class="titulo"><strong>Cotizaci&oacute;n</strong></span></div></td>
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
			<td class="captura" style="vertical-align: top;"><strong>1.&nbsp;Impor/Exportaci&oacute;n</strong></td>
			<td colspan="2" class="captura"><div align="center"><strong>2.Origen</strong></div></td>
			<td colspan="3" class="captura"><div align="center"><strong>3. Destino </strong></div></td>
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
			<td rowspan="2" class="captura" valign="top"><div align="center"><strong>4. Fecha Despacho:</strong><br />
							<?=Utils::fechaMes($reporteNegocio->getCaFchdespacho())?>
			</div></td>
			<td height="46" colspan="4" class="mostrar"><strong>5. Agente: </strong><br />
					<span class="listar">
						<?=$reporteNegocio->getAgente()?$reporteNegocio->getAgente():"Directo"?>
			</span></td>
			<td rowspan="2" class="invertir">
				<table width="100%" border="0" cellspacing="2">
					<tr>
						<td><div align="right">Editar reporte:<br />
										<?=link_to(image_tag("22x22/edit.gif"), "reportes/formReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo."&token=".md5(time()) )?>
						</div></td>
					</tr>
					<tr>
						<td><div align="right">Anular Reporte:<br />
								<?=link_to(image_tag("16x16/no.gif"), "reportes/anularReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo, "confirm='Esta seguro?'")?>
						</div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
			<td colspan="4" class="mostrar"><strong>6. Descripci&oacute;n de la Mercanc&iacute;a:</strong><br />				
				<?=Utils::replace($reporteNegocio->getCaMercanciaDesc())?>			</td>
		</tr>
		<tr>
			<td class="captura" valign="top"><strong>Cliente</strong></td>
			<td colspan="5" class="mostrar">		
				<?											
				$contacto = $reporteNegocio->getContacto();
				if( $contacto ){
					$cliente = $contacto->getCliente();
				?>
				
				<table cellspacing="1" width="500" border="0">
					<tbody>
						<tr>
							<td width="220" colspan="2"><strong>8. Nombre:</strong><br />
								<?=Utils::replace($cliente->getCaCompania())?></td>
							<td width="280" colspan="2"><strong>8.1 Orden:</strong><br />								
								<?=$reporteNegocio->getCaOrdenClie()?></td>
						</tr>
						<tr>
							<td colspan="2"><strong>8.2 Contacto:</strong><br />
								<?=Utils::replace($contacto->getNombre())?> </td>
							<td colspan="2"><strong>8.3 Direcci&oacute;n:</strong><br />
								<?=str_replace("|", " ", Utils::replace($cliente->getCaDireccion()))." ".Utils::replace($cliente->getCaComplemento())?></td>
						</tr>
						<tr>
							<td><strong>8.4 Tel&eacute;fono:</strong><br />
								<?=$contacto->getCaTelefonos()?></td>
							<td><strong>8.5 Fax:</strong><br /><?=$contacto->getCaFax()?></td>
							<td colspan="2"><strong>8.6 Correo   Electr&oacute;nico:</strong><br />
								<?=$contacto->getCaEmail()?></td>
						</tr>
					</tbody>
				</table>	
				<?
				}
				?>			</td>
		</tr>
		<tr>
			<td class="captura" valign="top"><strong>Consignatario:</strong></td>
			<td colspan="5" class="mostrar">
				<?
				$consignatario = $reporteNegocio->getConsignatario();
				if( $consignatario ){
				?>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><strong>9.1 Nombre:					
							</strong><br />
							
						<?=Utils::replace($consignatario->getCaNombre())?></td>
						<td><strong>9.1 Enviar Informaci&oacute;n</strong>:<br />
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=Utils::replace( $reporteNegocio->getCaInformarCons() )?>						</td>
					</tr>
					<tr>
						<td colspan="2"><strong>9.1.2 Contacto:</strong><br />
							<?=Utils::replace($consignatario->getCaContacto())?>							</td>
						<td><strong>9.1.3 Direcci&oacute;n:</strong><br />
							<?=Utils::replace($consignatario->getCaDireccion())?>							</td>
					</tr>
					<tr>
						<td><strong>9.1.4 Tel&eacute;fono</strong>:<br />
							<?=$consignatario->getCaTelefonos()?>					</td>
						<td><strong>9.1.5 Fax</strong>:<br />
							<?=$consignatario->getCaFax()?>					</td>
						<td><strong>9.1.6 Correo Electr&oacute;nico</strong>:<br />
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
			<td class="captura" valign="top"><strong>Notify:</strong></td>
			<td colspan="5" class="mostrar">
				
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><strong>9.1 Nombre:					
							</strong><br />
							
						<?=Utils::replace($notify->getCaNombre())?></td>
						<td><strong>9.2 Enviar Informaci&oacute;n</strong>:<br />
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=Utils::replace( $reporteNegocio->getCaInformarNoti() )?>						</td>
					</tr>
					<tr>
						<td colspan="2"><strong>9.1.2 Contacto:</strong><br />
							<?=Utils::replace($notify->getCaContacto())?>							</td>
						<td><strong>9.2.3 Direcci&oacute;n:</strong><br />
							<?=Utils::replace($notify->getCaDireccion())?>							</td>
					</tr>
					<tr>
						<td><strong>9.2.4 Tel&eacute;fono</strong>:<br />
							<?=$notify->getCaTelefonos()?>					</td>
						<td><strong>9.2.5 Fax</strong>:<br />
							<?=$notify->getCaFax()?>					</td>
						<td><strong>9.2.6 Correo Electr&oacute;nico</strong>:<br />
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
			<td valign="top" class="captura"><strong>Informaci&oacute;n de exportaciones </strong></td>
			<td colspan="5" class="mostrar">
			<?				
			include_component("reportes","formExpo", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
			?>	
			</td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td rowspan="3" class="captura" valign="top"><strong>Instrucciones:</strong></td>
			<td class="listar" colspan="5"><strong>11.1 Preferencias del Cliente:</strong><br />
			<?=Utils::replace($reporteNegocio->getCaPreferenciasClie())?></td>
		</tr>
		<tr>
			<td class="listar" colspan="5">
				<strong>11.2 Instrucciones Especiales para el Agente:</strong>
				
				<br />
				<?=Utils::replace($reporteNegocio->getCaInstrucciones())?></td>
		</tr>
		<tr>
			<td height="28" colspan="5" class="listar">
				<strong>11.3 Copiar comunicaciones a:</strong><br />
				<?=$reporteNegocio->getCaConfirmarClie() ?>
				
			</td>
		</tr>
		<tr>
			<td rowspan="4" valign="top" class="captura"><strong>12. Transporte:</strong><br /><?=Utils::replace($reporteNegocio->getCaTransporte())?>			</td>
			<td colspan="2" class="listar"><strong>13. Modalidad <br />
			</strong><?=$reporteNegocio->getCaModalidad()?></td>
			<td colspan="3" class="listar"><strong>14.1 L&iacute;nea Transporte:</strong>			
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
					<strong>14.2 Linea de transporte terrestre:</strong><br />
					<?
					echo $repexpo->getTransportadorTerrestre();
				}				
			}	
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><strong>15. Transporte terrestre <br /> 
				<?
				echo $reporteNegocio->getCaColmas()
				?>
			</strong></td>
			<td colspan="3" class="listar"><strong>16.&nbsp;Seguro&nbsp;con&nbsp;Anker:</strong><br />
				<?
				echo $reporteNegocio->getCaSeguro()
				?>			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><strong>Incoterms<br />
			</strong><?=$reporteNegocio->getCaIncoterms()?></td>
			<td colspan="3" class="listar"><strong>Consignar MAWB/BL a :<br />
			</strong><?=$reporteNegocio->getConsignarmaster()?></td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><strong>Consignar HAWB/HBL a :<br />
			</strong><?=$reporteNegocio->getConsignar()?></td>
			<td colspan="3" class="listar">&nbsp;</td>
		</tr>
		<?
		if( $reporteNegocio->getCaColmas() == "Sí"  ){
		?>
		<tr>
			<td valign="top" class="captura"><strong>Transporte terrestre nacional: </strong></td>
			<td colspan="5" class="listar">
				<?		
				include_component("reportes", "formTransporteNal", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
				?>			</td>
		</tr>
		<?
		}
		if( $reporteNegocio->getCaSeguro() == "Sí"  ){			
		?>
		<tr>
			<td valign="top" class="captura"><strong> Informaci&oacute;n para la aseguradora </strong></td>
			<td colspan="5" class="listar">
				<?									
				include_partial("reportes/formAseguradora", array("reporteNegocio"=>$reporteNegocio, "editable"=>false));				
				?>			</td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td class="invertir" colspan="7"><div align="right">
				<?=$option!="liquidar"?link_to(image_tag("22x22/edit.gif"), "reportes/consultaReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=expo&option=liquidar&token=".md5(time()) ):"&nbsp;"?>
			</div></td>
		</tr>				
		
			
		<tr>
			<td class="invertir" colspan="7"><div align="center"><strong>CONCEPTOS EMBARQUE </strong></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">
				<?
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportes/guardarConcepto?reporteId=".$reporteNegocio->getCaIdreporte()."&token=".md5(time()), 
							"update"=>"embarque" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formConceptos id=formConceptos");
				
				}
				?>
				<div align="center" id="embarque">
					<?
					include_component("reportes","relacionDeConceptos", array( "reporteNegocio"=>$reporteNegocio,  "editable"=>$option=="liquidar" ));
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
			<td class="invertir" colspan="7"><div align="center"><strong>RELACI&Oacute;N DE RECARGOS </strong></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">				
				<?				
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportes/guardarRecargo?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=origen&token=".md5(time()), 
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
				include_component("reportes", "relacionDeRecargos", array("reporteNegocio"=>$reporteNegocio, "tipo"=>"origen", "editable"=>$option=="liquidar" ))?>
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
					echo form_remote_tag(array("url"=>"reportes/guardarRecargo?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=local&token=".md5(time()), 
							"update"=>"recargos_local" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formRecargosLoc id=formRecargosLoc");
				
				}
				?>
				<div align="center" id="recargos_local">
				<?			
				include_component("reportes", "relacionDeRecargos", array("reporteNegocio"=>$reporteNegocio, "tipo"=>"local", "editable"=>$option=="liquidar" ))?>
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
			<td class="invertir" colspan="7"><div align="center"><strong>CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.</strong></div></td>
		</tr>
		<tr>
			<td class="invertir" colspan="7">
				<?
				if( $option=="liquidar" ){
					echo form_remote_tag(array("url"=>"reportes/guardarCosto?reporteId=".$reporteNegocio->getCaIdreporte()."&tipo=expo&token=".md5(time()), 
							"update"=>"costos_colmas" ,
							"script"=>true,
							'loading'  => "Element.show('indicator')",
							'complete' => "Element.hide('indicator')",
							), "name=formColmas id=formColmas");
				
				}
				?>

			<div align="center" id="costos_colmas">
				<?
				echo include_component("reportes", "relacionDeCostos", array("reporteNegocio"=>$reporteNegocio, "editable"=>$option=="liquidar"))?>
			</div>
			<?
			if( $option=="liquidar" ){
				echo "</form>";
			}
			?>			</td>
		</tr>
	<?
	}	
	?>
	<tr>
		<td colspan="6"  >
			<table cellspacing="1" width="100%">
				<tbody>
					<tr>
						<td class="listar"><strong>Ciudad :</strong><br />
								</td>
						<td class="listar"><strong>Elabor&oacute; :</strong><br />
								<center>
									<?=$reporteNegocio->getCaUsucreado()?>
								</center></td>
						<td class="listar"><strong>Fecha:</strong><br />
								<center>									
									<?=$reporteNegocio->getCaFchcreado()?>
								</center></td>
						<td colspan="2" class="listar"><strong>Rep. Comercial:</strong><br />
								<center>
									<?=$reporteNegocio->getCaLogin()?>
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
<?
if( $option=="liquidar" ){
?>
<div align="center">	
	<?=button_to("Registrar", "reportes/consultaReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo."&token=".md5(time()))?></div>

<?	
}else{
?>
	<div align="center"><?=button_to("Generar reporte", "reportes/generarPDF?reporteId=".$reporteNegocio->getCaIdreporte()."&token=".md5(time()))?>
	
	<?=button_to("Nueva version","reportes/copiarReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo."&option=nuevaVersion&token=".md5(time()))?>
	
	<?=button_to("Copiar en nuevo reporte","reportes/copiarReporte?reporteId=".$reporteNegocio->getCaIdreporte()."&modo=".$modo."&token=".md5(time()))?>
	</div>
<?
}
?>
 
