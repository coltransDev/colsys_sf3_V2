<?
use_helper("Object");
use_helper('Validation');
use_helper('Modalbox');
use_helper('Javascript');
?>
<script language="JavaScript" type="text/javascript">
	
	function seleccionTercero( formName , sel) {
 		
		
		switch( formName ){
			case "expoReporteFormcliente":	
				var target = document.reporteForm;									
				target.idconcliente.value=document.getElementById("idcontacto_"+sel).value;
				target.cliente.value=document.getElementById("compania_"+sel).value;
				target.contacto_cli.value=document.getElementById("nombre_"+sel).value;
				target.direccion_cli.value=document.getElementById("direccion_"+sel).value;
				target.telefonos_cli.value=document.getElementById("telefonos_"+sel).value;
				target.fax_cli.value=document.getElementById("fax_"+sel).value;
				target.email_cli.value=document.getElementById("email_"+sel).value;
				target.login.value=document.getElementById("vendedor_"+sel).value;
				target.preferencias_clie.value=document.getElementById("preferencias_"+sel).value;		
				
				var confirmar =  document.getElementById("confirmar_"+sel).value ;						
				var brokenconfirmar=confirmar.split(",");				
				for(i=0; i<brokenconfirmar.length; i++){				
					document.getElementById("contactos_"+i).value=brokenconfirmar[i];
				}				
				document.reporteForm.cliente.focus();
				
				break;
			case "expoReporteFormconsignatario":	
			
				var target = document.reporteForm;									
				target.idconsignatario.value=document.getElementById("idtercero_"+sel).value;
				target.nombre_con.value=document.getElementById("nombre_"+sel).value;				
				target.contacto_con.value=document.getElementById("contacto_"+sel).value;				
				target.direccion_con.value=document.getElementById("direccion_"+sel).value;
				target.telefonos_con.value=document.getElementById("telefonos_"+sel).value;
				target.fax_con.value=document.getElementById("fax_"+sel).value;
				target.email_con.value=document.getElementById("email_"+sel).value;
						
				target.nombre_con.focus();
				
				break;
			case "expoReporteFormnotify":				
				var target = document.reporteForm;									
				target.idnotify.value=document.getElementById("idtercero_"+sel).value;
				target.nombre_noti.value=document.getElementById("nombre_"+sel).value;				
				target.contacto_noti.value=document.getElementById("contacto_"+sel).value;				
				target.direccion_noti.value=document.getElementById("direccion_"+sel).value;
				target.telefonos_noti.value=document.getElementById("telefonos_"+sel).value;
				target.fax_noti.value=document.getElementById("fax_"+sel).value;
				target.email_noti.value=document.getElementById("email_"+sel).value;
						
				target.nombre_con.focus();
				
				break;	
			case "cuadroStatusForm":						
				document.cuadroStatusForm.idcliente.value=idcliente;
				document.cuadroStatusForm.cliente.value=cliente; 
				break;
		}
		Modalbox.hide({params:''});
	}
	
	
	
	function cambiarTransporte( tipo ){
		if(tipo=="Aéreo"){
			document.getElementById("naviera").style.display = "none";
			document.getElementById("aerolinea").style.display = "inline";
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "inline";
			document.getElementById("tipo_carga_ter").style.display = "none";
			
		}
		
		if(tipo=="Marítimo"){
			document.getElementById("naviera").style.display = "inline";
			document.getElementById("aerolinea").style.display = "none";
			document.getElementById("tipo_carga_mar").style.display = "inline";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "none";
		}
		
		if(tipo=="Terrestre"){			
			document.getElementById("naviera").style.display = "none";
			document.getElementById("aerolinea").style.display = "none";	
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "inline";	
			document.getElementById("terrestre").style.display = "inline";	
		}else{		
			document.getElementById("terrestre").style.display = "none";
		}
	}
		
	function mostarIntruccionesAgente(){
		var campo = document.getElementById("intrucciones_agente");
		
		if( campo.style.display=="none" ){
			campo.style.display="inline";
		}else{
			campo.style.display="none";
		}
	}
</script>
<?php echo form_error('name') ?>
<h3>Sistema Reportes de Negocio</h3>
<br>
<br>
<?=form_tag("reportes/formReporteGuardar?modo=".$modo, "name=reporteForm id=reporteForm")?>
<?=input_hidden_tag("reporteId", $reporteNegocio->getCaIdReporte() )?>
<table cellspacing="1" width="90%" id="mainTable">
	<tbody>
		<tr>
			<th class="titulo" colspan="6">REPORTE DE NEGOCIO</th>
		</tr>
		<tr>
			<td width="121" class="captura">Informaci&oacute;n :</td>
			<td width="54" colspan="2" class="mostrar">N&uacute;mero del reporte </td>
			<td width="93" colspan="1" class="mostrar">Fecha del Reporte:<br />
					<?=input_tag("fchReporte", $reporteNegocio->getCaFchreporte("Y-m-d")?$reporteNegocio->getCaFchreporte("Y-m-d"):date("Y-m-d"), "readOnly=true")?></td>
			<td class="mostrar"><!--Cotizaci&oacute;n:--></td>
			<?
				
				?>
			<td class="mostrar">
			<!--<? //input_hidden_tag("id_producto", $id_producto)?>
					<?
					
					//input_tag("id_cotizacion",$id_cotizacion, "size=10 readOnly=readOnly")?>
					<?=image_tag("22x22/lupa.gif", "onClick=cuadro_busqueda('".url_for("general/buscarCotizacion")."')")?>
					<br />
				Buscar Cotizaci&oacute;n--></td>
		</tr>
		<tr>
			<td class="titulo">1. Importaci&oacute;n/Exportaci&oacute;n</td>
			<td class="titulo" colspan="3">2. Ciudad de Origen</td>
			<td class="titulo" colspan="2">3. Ciudad de Destino</td>
		</tr>
		<tr>
			<td class="captura" style="vertical-align: top;"><?=$modo=="expo"?"<strong>Exportaci&oacute;n</strong>":"<strong>Importaci&oacute;n</strong>"?></td>
			<td width="54" class="listar"><?=select_tag("pais_origen", array("Colombia"))?>			</td>
			<td colspan="2" class="listar"><?
					if( $reporteNegocio->getDestino() ){
						$trafico = $reporteNegocio->getDestino()->getCaIdtrafico();
						$selected= $reporteNegocio->getDestino()->getId();
					}else{						
						if( $sf_params->get('Destino') ){
							$trafico = $sf_params->get('Destino');
						}else{
							$trafico = "DE-049";
						}
					}
					?>
					<div id="ciudadOrigen">
						<?=include_component("general", "seleccionCiudad", array("trafico_id"=>"CO-057", "fieldName"=>"idCiudadOrigen", "selected"=>$reporteNegocio->getCaOrigen() ))?>
				</div></td>
			<td width="119" class="listar"><?
				
					
					include_component("general", "seleccionTrafico", array("fieldName"=>"Destino", "selected"=>$trafico));		
					?>			</td>
			<td class="listar" width="121"><div id="ciudadDestino">
				<?=include_component("general", "seleccionCiudad", array("trafico_id"=>$trafico, "selected"=>$reporteNegocio->getCaDestino()))?>
			</div></td>
		</tr>
		<tr>
			<td rowspan="3" class="captura">4. Fecha despacho <br />
				<?=input_tag("fchDespacho", $reporteNegocio->getCaFchDespacho("Y-m-d")?$reporteNegocio->getCaFchreporte("Y-m-d"):date("Y-m-d"), "readOnly=true")?>			</td>
			<td colspan="6" class="mostrar"><span class="listar">5. Agente: <br />
						<?=select_tag("agente", options_for_select(array(""=>"Directo")).objects_for_select($agentes, "getId", "getCaNombre", $reporteNegocio->getCaIdagente()  ) )?>
			</span>
			<br />			</td>
		</tr>
		<tr>
			<td colspan="6" class="mostrar">6. Descripci&oacute;n de la Mercanc&iacute;a:<br />
				<?php echo form_error('mercancia_desc') ?>
				<span class="listar">
				<?=textarea_tag( "mercancia_desc", $reporteNegocio->getCaMercanciaDesc(), "size=93x3")?>
			    </span></td>
		</tr>
		<tr>
			<td colspan="6" class="mostrar"><span class="listar">Incoterms : <br />
					<?=select_tag("incoterms", objects_for_select($incoterms, "getCavalor","getCavalor", $reporteNegocio->getCaIncoterms() ) )?>
			</span></td>
		</tr>
		<tr>
			<td class="captura">Cliente</td>
			<td colspan="6" class="mostrar">
				<?
				$contacto = $reporteNegocio->getContacto();
				if( $contacto ){
					$cliente = $contacto->getCliente();
				}
				?>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2">8. Nombre:<br />
							<div style="display:none"><?=input_tag( "idconcliente",  $reporteNegocio->getCaIdConcliente(), "size=11 readonly=readonly" )?></div>
							<?php echo form_error('idconcliente') ?>
							<?=input_tag( "cliente", $reporteNegocio->getCliente(), "size=50 readonly=readOnly" )?>						</td>
					<td width="74">8.1 Orden:<br />
						<?=input_tag("orden_clie", $reporteNegocio->getCaOrdenClie(), "size=15")?>					</td>
					<td width="166" ><?php echo m_link_to(image_tag("22x22/lupa.gif")." Buscar", 'clientes/busquedaClientes?opcion=cliente&formName=expoReporteFormcliente', array("title"=>"Por favor selecciona un cliente") , array( "width"=>850 ) ) ?> </td>
				</tr>
				<tr>
					<td colspan="2">8.2 Contacto:<br />
							<?=input_tag("contacto_cli",  $contacto?$contacto->getNombre():"", "size=50 readonly=readOnly")?></td>
					<td colspan="2">8.3 Direcci&oacute;n:<br />
							<?=input_tag("direccion_cli",  $contacto?str_replace("|", " ", $cliente->getCaDireccion()):"", "size=40 readonly=readOnly")?>					</td>
				</tr>
				<tr>
					<td width="150">8.4 Tel&eacute;fono:<br />
							<?=input_tag("telefonos_cli",  $contacto?$contacto->getCaTelefonos():"", "size=23 maxlength=30 readonly=readOnly")?>					</td>
					<td width="150">8.5 Fax:<br />
						<?=input_tag("fax_cli",  $contacto?$contacto->getCaFax():"", "size=23 maxlength=30 readonly=readOnly")?>							</td>
					<td colspan="2">8.6 Correo Electr&oacute;nico:<br />
						<?=input_tag("email_cli",  $contacto?$contacto->getCaEmail():"", "size=30 maxlength=40 readonly=readOnly")?>					</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td class="captura">Consignatario</td>
			<td colspan="6" class="mostrar">
				<?
				$consignatario = $reporteNegocio->getConsignatario();
				?>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2">9.1 Nombre:					
						<br />
						<div style="display:none">
						<?=input_tag( "idconsignatario", $consignatario?$consignatario->getCaIdtercero():"" , "size=60 readonly=readOnly" )?>
						</div>
						<?php echo form_error('idconsignatario') ?>
						<?=input_tag( "nombre_con", $consignatario?$consignatario->getCaNombre():"" , "size=60 readonly=readOnly" )?></td>
					<td>
						<?
						if( $modo!="expo" ){ //Esta casilla solamente es util en el caso de la importaciones 
						?>
						9.1.1 Enviar Informaci&oacute;n:<br />
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_cons", "Sí",   $reporteNegocio->getCaInformarCons()=="Sí"||!$reporteNegocio->getCaInformarCons() )?>	
						S&iacute;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_cons", "No",   $reporteNegocio->getCaInformarCons()=="No" )?>	
						No
						<?
						}else{
							echo "&nbsp;";
						}
						?>						</td>
					<td  ><span class="listar"><?php echo m_link_to(image_tag("22x22/lupa.gif")." Buscar", 'clientes/busquedaClientes?opcion=consignatario&formName=expoReporteFormconsignatario', array("title"=>"Por favor seleccione un consignatario") , array( "width"=>850 ) ) ?></span>					</td>
				</tr>
				<tr>
					<td colspan="2">9.1.2 Contacto:<br />
						<?=input_tag( "contacto_con",  $consignatario?$consignatario->getCaContacto():"", "size=50 maxlength=60 readonly=readOnly" )?>							</td>
					<td colspan="2">9.1.3 Direcci&oacute;n:<br />
						<?=input_tag( "direccion_con",  $consignatario?$consignatario->getCaDireccion():"", "size=50 maxlength=60 readonly=readOnly" )?>							</td>
				</tr>
				<tr>
					<td>9.1.4 Tel&eacute;fono:<br />
						<?=input_tag( "telefonos_con",  $consignatario?$consignatario->getCaTelefonos():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
					<td>9.1.5 Fax:<br />
						<?=input_tag( "fax_con",  $consignatario?$consignatario->getCaFax():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
					<td colspan="2">9.1.6 Correo Electr&oacute;nico:<br />
						<?=input_tag( "email_con",  $consignatario?$consignatario->getCaEmail():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
				</tr>				
			</table>			</td>
		</tr>
		
		<tr>
			<td class="captura">Notify</td>
			<td colspan="6" class="mostrar">
				<?
				$notify = $reporteNegocio->getNotify();
				?>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2">9.2 Nombre:					
						<br />
						<div style="display:none">
						<?=input_tag( "idnotify", $notify?$notify->getCaIdtercero():"" , "size=60 readonly=readOnly" )?>
						</div>
						<?php echo form_error('idnotify') ?>
						<?=input_tag( "nombre_noti", $notify?$notify->getCaNombre():"" , "size=60 readonly=readOnly" )?></td>
					<td>
						<?
						if( $modo!="expo" ){ //Esta casilla solamente es util en el caso de la importaciones 
						?>
						9.2.1 Enviar Informaci&oacute;n:<br />
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_noti", "Sí",   $reporteNegocio->getCaInformarNoti()=="Sí"||!$reporteNegocio->getCaInformarNoti() )?>	
						S&iacute;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_noti", "No",   $reporteNegocio->getCaInformarNoti()=="No" )?>	
						No
						<?
						}else{
							echo "&nbsp;";
						}
						?>						</td>
					<td  ><span class="listar"><?php echo m_link_to(image_tag("22x22/lupa.gif")." Buscar", 'clientes/busquedaClientes?opcion=notify&formName=expoReporteFormnotify', array("title"=>"Por favor seleccione un notify") , array( "width"=>850 ) ) ?></span>					</td>
				</tr>
				<tr>
					<td colspan="2">9.2.2 Contacto:<br />
						<?=input_tag( "contacto_noti",  $notify?$notify->getCaContacto():"", "size=50 maxlength=60 readonly=readOnly" )?>							</td>
					<td colspan="2">9.2.3 Direcci&oacute;n:<br />
						<?=input_tag( "direccion_noti",  $notify?$notify->getCaDireccion():"", "size=50 maxlength=60 readonly=readOnly" )?>							</td>
				</tr>
				<tr>
					<td>9.2.4 Tel&eacute;fono:<br />
						<?=input_tag( "telefonos_noti",  $notify?$notify->getCaTelefonos():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
					<td>9.2.5 Fax:<br />
						<?=input_tag( "fax_noti",  $notify?$notify->getCaFax():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
					<td colspan="2">9.2.6 Correo Electr&oacute;nico:<br />
						<?=input_tag( "email_noti",  $notify?$notify->getCaEmail():"", "size=30 maxlength=23 readonly=readOnly" )?>					</td>
				</tr>				
			</table>			</td>
		</tr>
		<?
		if( $modo=="expo" ){	
		?>
		<tr>
			<td class="captura">Informaci&oacute;n Exportaciones </td>
			<td colspan="5" class="listar"><?
				include_component("reportes", "formExpo", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));
				?></td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td colspan="4" class="invertir"> 11.1 Preferencias del cliente:<br />
					<?=textarea_tag("preferencias_clie",$reporteNegocio->getCaPreferenciasClie(), "size=90x10")?>			</td>
			<td colspan="2" rowspan="2" class="invertir" valign="top"><!--Informaciones a: -->
			
				11.3 Informaciones a:<br />
				<table cellspacing="1" cellpadding="0" width="200" border="0">
					<tbody>
						<?
						if($sf_params->get('contactos')){						
							$confirmar = $sf_params->get('contactos');
						}else{
							$confirmar = explode(",",$reporteNegocio->getCaConfirmarClie());
						}
						
						for( $i=0; $i<10; $i++ ){							
						?>
						<tr>
							<td width="160" class="invertir"><?=input_tag("contactos[]", isset($confirmar[$i])&&$confirmar[$i]?$confirmar[$i]:"", "size=40 maxlength=50 class=field id=contactos_{$i}");?></td>
							<td width="40" class="invertir"><?=checkbox_tag("confirmar[]", $i, isset($confirmar[$i])&&$confirmar[$i]?true:false)?></td>
						</tr>
						<?
						}
						?>
					</tbody>
				</table></td>
		</tr>
		<tr>
			<td colspan="4" class="invertir"><div onclick="mostarIntruccionesAgente()">11.2 Instrucciones Especiales:</div>
					<br />
					<div id="intrucciones_agente" style="display:<?=$reporteNegocio->getCaInstrucciones()?"inline":"none"?>">
						<?=textarea_tag("instrucciones_agente", $reporteNegocio->getCaInstrucciones(), "size=90x10")?>
				</div></td>
		</tr>
		<tr>
			<td rowspan="2" class="listar">12. Transporte:<br />
				<span class="listar">
					<?=select_tag("transporte", options_for_select(array("A&eacute;reo"=>"A&eacute;reo", "Mar&iacute;timo"=>"Mar&iacute;timo", "Terrestre"=>"Terrestre"  ), Utils::replace($reporteNegocio->getCaTransporte()) ) , "onChange='cambiarTransporte(this.value)'")?>
			</span></td>
			<td colspan="3" rowspan="2" class="listar">13. Modalidad:<br />				
				<div id='tipo_carga_mar'>
					<?
					echo select_tag("modalidad_mar", objects_for_select($subModMar, "getCaValor", "getCaValor",$reporteNegocio->getCaModalidad()) );
					?>
				</div>	
				<div id='tipo_carga_aer'>
					<?
					echo select_tag("modalidad_aer", objects_for_select($subModAer, "getCaValor", "getCaValor",$reporteNegocio->getCaModalidad()) );
					?>
				</div>	
				<div id='tipo_carga_ter'>
					<?
					echo select_tag("modalidad_ter", objects_for_select($subModTer, "getCaValor", "getCaValor",$reporteNegocio->getCaModalidad()) );
					?>
				</div>				</td>
			<td colspan="2" class="listar">
					<div id='naviera'>
						14.1 L&iacute;nea  de transporte:<br />
						<?=select_tag("idnaviera", objects_for_select($navieras, "getId", "getCaNombre", $reporteNegocio->getCaIdlinea() ) )?>
					</div>
				<div id='aerolinea'>
					14.1 L&iacute;nea  de transporte:<br />	
						<?=select_tag("idaerolinea", objects_for_select($aerolineas, "getId", "getCaNombre" , $reporteNegocio->getCaIdlinea() ) )?>
				</div>			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar"> 
				<div id='terrestre'>					
						<?
						if( $modo=="expo" ){
						?>
						14.2 Linea de transporte terrestre:<br />
						<?
							$repexpo = $reporteNegocio->getRepExpo();
							echo select_tag("idlineaterrestre", objects_for_select($transportadores, "getId", "getCaNombre",  $repexpo->getCaIdlineaterrestre()  ) );
						}	
						?>
				</div></td>
		</tr>
		<tr>
			<td colspan="6" class="invertir">19 Instrucciones para el corte de las guias:</td>
		</tr>
		<tr>
			<td class="listar">19.1 Consignar Master (MAWB/BL) a :</td>
			<td colspan="5" class="listar">				
			<?				
			echo select_tag("idconsignarmaster", objects_for_select($consignarMaster, "getCaIdentificacion","getCavalor", $reporteNegocio->getCaIdConsignarmaster()));			
			?></td>
		</tr>
		<tr>
			<td class="listar">19.2 Consignar hijas (HAWB/HBL) a :</td>
			<td colspan="5" class="listar">				
			<?				
			echo select_tag("idconsignar", objects_for_select($consignar, "getCaIdentificacion","getCavalor", $reporteNegocio->getCaIdConsignar()));			
			?></td>
		</tr>
		
		<tr>
			<td class="invertir">20. Seguro Anker:<br />						
					<?=radiobutton_tag("seguro" , "Si" , $reporteNegocio->getCaSeguro()=="Sí", "onClick=cambiarDisplay('formAseguradora','inline')")?>
					S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;
	<?=radiobutton_tag("seguro" , "No" , $reporteNegocio->getCaSeguro()?$reporteNegocio->getCaSeguro()=="No":true , "onClick=cambiarDisplay('formAseguradora','none')" )?>
					No			</td>
			<td colspan="5" class="invertir">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6" class="listar">
				<div id="formAseguradora" style="display:<?=$sf_params->get('seguro')=="Si"||$reporteNegocio->getCaSeguro()=="Sí"?"inline":"none" ?>">
					<?
				include_partial("reportes/formAseguradora", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));
				?>
				</div>			</td>
		</tr>		
		<tr>
			<td class="invertir">21. Transporte Terrestre:<br />		
					<?=radiobutton_tag("colmas" , "Si" , $reporteNegocio->getCaColmas()=="Sí", "onClick=cambiarDisplay('formColmas','inline')")?>
					S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;								
					<?=radiobutton_tag("colmas" , "No" ,  $reporteNegocio->getCaColmas()?$reporteNegocio->getCaColmas()=="No":true , "onClick=cambiarDisplay('formColmas','none')")?>
			No				</td>
			<td colspan="5" class="invertir">&nbsp;</td>
		</tr>	
		<tr >
			<td colspan="6" class="listar">
				<div id="formColmas" style="display:<?=$sf_params->get('colmas')=="Si"||$reporteNegocio->getCaColmas()=="Sí"?"inline":"none" ?>">
			
				
				<?		
				include_component("reportes", "formTransporteNal", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));				
				?>
				</div>			</td>
		</tr>
		<tr>
			<td class="captura">Rep. Comercial: </td>
			<td colspan="3" class="listar"><span class="invertir">
				<?
		$cliente = $reporteNegocio->getCliente();
		
		if( $cliente ){
			$vendedor = $cliente->getCaVendedor();
		}else{
			$vendedor = "";
		}	
		
		if( $user->getNivelAcceso()>0 ){
			$options = "";					
		}else{	
			$options = "disabled=true";		
		}
		
		echo select_tag("login", objects_for_select($comerciales, "getCaLogin", "getCaNombre", $reporteNegocio->getCaLogin()?$reporteNegocio->getCaLogin():$vendedor ) , $options);
		
	   	
			
		?>
			</span></td>
			<td colspan="2" class="listar">Elaboro: <strong>
				<?=$user->getUserid()?>
			</strong> </td>
		</tr>
	</tbody>
</table>
<br>
<table cellspacing="10">
	<tbody>
		<tr>
			<th><?=submit_tag("Guardar")?></th>
		<!--	<th><?=input_tag("Nueva version","Nueva version", "type=button onClick=javascript:guardarReporte('nuevaVersion') ")?></th>
			<th><?=input_tag("Copiar en nuevo reporte","Copiar en nuevo reporte", "type=button onClick=javascript:guardarReporte('copiar') ")?></th>-->
			<th><?=button_to("Cancelar", "reportes/index?modo=".$modo)?></th>
		</tr>
	</tbody>
</table>
</form>
<script language="JavaScript" type="text/javascript">		
	cambiarTransporte( document.getElementById('transporte').value );
</script>
