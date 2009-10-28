<?


?>

<div class="content" align="center">
<h3>Reportes de Negocio</h3>
<br />
<br />
<table cellspacing="1" width="80%" class="tableList">
	<tbody>
		<tr>
			<th colspan="6" class="titulo">REPORTE DE NEGOCIO</th>
		</tr>
		<tr>
			<th width="173" class="titulo">&nbsp;</th>
			<td width="122" class="mostrar"><div align="center"><strong>Reporte No.:</strong><br />
							<?=$reporte->getCaConsecutivo()?>
			</div></td>
			<td width="90" class="mostrar" ><div align="center"><span class="titulo"><strong>Fecha</strong></span><br />
							<?=Utils::fechaMes($reporte->getCaFchreporte())?>
			</div></td>
			<td width="107" class="mostrar"><div align="center"><strong>Versi&oacute;n No.</strong>:<br />
							<?=$reporte->getCaVersion()."/".$reporte->numVersiones()?>
			</div></td>
			<td width="85" class="mostrar"><div align="left"><strong>Cotizaci&oacute;n</strong><br /><?=$reporte->getCaIdcotizacion()?>
</div></td>
			<?
		/*$cotProducto = $reporte->getCotProducto();
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
				<?=Utils::replace($reporte->getCaImpoexpo())?>
			</div></td>
			<td colspan="2" class="listar"><div align="center">
				<?=$reporte->getOrigen()?>
			</div></td>
			<td colspan="3" class="listar"><div align="center">
				<?=$reporte->getDestino()?>
			</div></td>
		</tr>
		<tr>
			<td rowspan="2" class="captura" valign="top"><div align="center"><strong>4. Fecha Despacho:</strong><br />
							<?=Utils::fechaMes($reporte->getCaFchdespacho())?>
			</div></td>
			<td height="46" colspan="4" class="mostrar"><strong>5. Agente: </strong><br />
					<span class="listar">
						<?=$reporte->getIdsAgente()?$reporte->getIdsAgente()->getIds()->getCaNombre():"Directo"?>
			</span></td>
			<td rowspan="2" class="invertir">
				<table width="100%" border="0" cellspacing="2">
					<tr>
						<td><div align="right">Editar reporte:<br />
										<?=link_to(image_tag("22x22/edit.gif"), "reportesNeg/formReporte?reporteId=".$reporte->getCaIdreporte()."&token=".md5(time()) )?>
						</div></td>
					</tr>
					<tr>
						<td><div align="right">Anular Reporte:<br />
								<?=link_to(image_tag("16x16/no.gif"), "reportesNeg/anularReporte?reporteId=".$reporte->getCaIdreporte(), "confirm='Esta seguro?'")?>
						</div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
			<td colspan="4" class="mostrar"><strong>6. Descripci&oacute;n de la Mercanc&iacute;a:</strong><br />				
				<?=Utils::replace($reporte->getCaMercanciaDesc())?>			</td>
		</tr>
		<tr>
			<td class="captura" valign="top"><strong>Cliente</strong></td>
			<td colspan="5" class="mostrar">		
				<?											
				$contacto = $reporte->getContacto();
				if( $contacto ){
					$cliente = $contacto->getCliente();
				?>
				
				<table cellspacing="1" width="500" border="0">
					<tbody>
						<tr>
							<td width="220" colspan="2"><strong>8. Nombre:</strong><br />
								<?=Utils::replace($cliente->getCaCompania())?></td>
							<td width="280" colspan="2"><strong>8.1 Orden:</strong><br />								
								<?=$reporte->getCaOrdenClie()?></td>
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
				$consignatario = $reporte->getConsignatario();
				if( $consignatario ){
				?>
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2"><strong>9.1 Nombre:					
							</strong><br />
							
						<?=Utils::replace($consignatario->getCaNombre())?></td>
						<td><strong>9.1 Enviar Informaci&oacute;n</strong>:<br />
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=Utils::replace( $reporte->getCaInformarCons() )?>						</td>
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
				$notify = $reporte->getNotify();
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
							<?=Utils::replace( $reporte->getCaInformarNoti() )?>						</td>
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
				
		?>
		<tr>
			<td rowspan="3" class="captura" valign="top"><strong>Instrucciones:</strong></td>
			<td class="listar" colspan="5"><strong>11.1 Preferencias del Cliente:</strong><br />
			<?=Utils::replace($reporte->getCaPreferenciasClie())?></td>
		</tr>
		<tr>
			<td class="listar" colspan="5">
				<strong>11.2 Instrucciones Especiales para el Agente:</strong>
				
				<br />
				<?=Utils::replace($reporte->getCaInstrucciones())?></td>
		</tr>
		<tr>
			<td height="28" colspan="5" class="listar">
				<strong>11.3 Copiar comunicaciones a:</strong><br />
				<?=$reporte->getCaConfirmarClie() ?>
				
			</td>
		</tr>
		<tr>
			<td rowspan="4" valign="top" class="captura"><strong>12. Transporte:</strong><br /><?=Utils::replace($reporte->getCaTransporte())?>			</td>
			<td colspan="2" class="listar"><strong>13. Modalidad <br />
			</strong><?=$reporte->getCaModalidad()?></td>
			<td colspan="3" class="listar"><strong>14.1 L&iacute;nea Transporte:</strong>			
			<br />
			<?
			$transporte = $reporte->getIdsProveedor();
			if( $transporte ){
				echo $transporte->getIds()->getCaNombre();
			}
			?>			
			
			<?
			if( $modo=="expo" ){			
				$repexpo = $reporte->getRepExpo();
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
				echo $reporte->getCaColmas()
				?>
			</strong></td>
			<td colspan="3" class="listar"><strong>16.&nbsp;Seguro:</strong><br />
				<?
				echo $reporte->getCaSeguro()
				?>			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><strong>Incoterms<br />
			</strong><?=$reporte->getCaIncoterms()?></td>
			<td colspan="3" class="listar"><strong>Consignar MAWB/BL a :<br />
			</strong><?=$reporte->getConsignarmaster()?></td>
		</tr>
		<tr>
			<td colspan="2" class="listar"><strong>Consignar HAWB/HBL a :<br />
			</strong><?=$reporte->getConsignar()?></td>
			<td colspan="3" class="listar">&nbsp;</td>
		</tr>
			
		<tr>
			<td class="invertir" colspan="7"><div align="right">
				<?=link_to(image_tag("16x16/edit.gif"), "reportesNeg/liquidarReporte?id=".$reporte->getCaIdreporte()) ?>
			</div></td>
		</tr>				
		
			
		<tr>
			<td class="invertir" colspan="7"><div align="center"><strong>CONCEPTOS EMBARQUE </strong></div></td>
		</tr>
   </table>
   <table cellspacing="1" width="80%" >
		<tr>
			<td colspan="7">
                <div id="panel-conceptos"></div>
			</td>
		</tr>
		<?		
	  
	
	$usuario = $reporte->getUsuario();
	$sucursal = $usuario->getSucursal();
	?>
	<tr>
		<td colspan="6"  >
			<table cellspacing="1" width="100%">
				<tbody>
					<tr>
						<td class="listar"><strong>Ciudad :</strong><br />
								<?=$sucursal?$sucursal->getCaNombre():""?>
								</td>
						<td class="listar"><strong>Elabor&oacute; :</strong><br />
								<center>
									<?=$reporte->getCaUsucreado()?>
								</center></td>
						<td class="listar"><strong>Fecha:</strong><br />
								<center>									
									<?=$reporte->getCaFchactualizado()?$reporte->getCaFchactualizado():$reporte->getCaFchcreado()?>
								</center></td>
						<td colspan="2" class="listar"><strong>Rep. Comercial:</strong><br />
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
 
</div>



<?
include_component("reportesNeg","mainPanel", array("reporte"=>$reporte));
include_component("reportesNeg","panelConceptosFletes", array("reporte"=>$reporte));

?>
<script language="javascript">
      
      var guardarCambios = function(){
          panelFletes.guardarCambios();
          
      }

      var panelFletes = new PanelConceptosFletes({
          title: 'Conceptos de fletes'
      });

      tbarObj = [{
            text:'Guardar',            
            iconCls: 'disk',
            scope:this,
            handler: guardarCambios
        },
        '-'
      ]

      var mainPanel = new MainPanel({
                            width: 800,
                            height: 400,                            
                            items: [panelFletes],
                            tbar: tbarObj

                      });
      mainPanel.render("panel-conceptos");

      mainPanel.setWidth(Ext.getBody().getWidth()-250);


</script>