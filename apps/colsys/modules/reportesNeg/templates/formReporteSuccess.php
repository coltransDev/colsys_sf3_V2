<?
use_helper("Object");
use_helper('Validation');
use_helper('Modalbox');
use_helper('Javascript');
use_helper('YUICalendar');


?>
<script language="JavaScript" type="text/javascript">
	
	
	function handleSelectContacto (record, index){ 		
		
		
		document.getElementById("con_cliente").value=record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido;
		document.getElementById("cliente").value=record.data.compania;		
		document.getElementById("idconcliente").value=record.data.id;				
		document.getElementById("preferencias_clie").value=record.data.preferencias;				
		document.getElementById("login").value=record.data.vendedor;				
		
		for(i=0; i<10; i++){				
			document.getElementById("contactos_"+i).value="";
			document.getElementById("confirmar_"+i).checked=false;
		}
		
		var confirmar =  record.data.confirmar ;						
		var brokenconfirmar=confirmar.split(",");			
		
		for(i=0; i<brokenconfirmar.length; i++){				
			document.getElementById("contactos_"+i).value=brokenconfirmar[i];
			document.getElementById("confirmar_"+i).checked=true;
		}					   
	}
    
	
	
	function seleccionAgente(){
		var listarTodos = document.getElementById('listarTodos').checked;
		if( listarTodos ){
			<?
			echo remote_function( array("url"=>"general/selectAgentes", "update"=>"agentes"));
			?>

		}else{
			<?
			echo remote_function( array("url"=>"general/selectAgentes", "update"=>"agentes", "with"=>"'ciudad_id='+document.getElementById('idCiudad').value"));
			?>
		}	
	}
	
	function seleccionTercero( formName , sel) {
 		
		
		switch( formName ){
			
			case "expoReporteFormconsignatario":	
			
				var target = document.reporteForm;									
				target.idconsignatario.value=document.getElementById("idtercero_"+sel).value;
				target.nombre_con.value=document.getElementById("nombre_"+sel).value;									
				target.nombre_con.focus();
				
				break;
			case "expoReporteFormnotify":				
				var target = document.reporteForm;									
				target.idnotify.value=document.getElementById("idtercero_"+sel).value;
				target.nombre_not.value=document.getElementById("nombre_"+sel).value;				
			
				target.nombre_con.focus();
				
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
			<?
			if( $modo=="expo" ){
			?>
				document.getElementById("emisionbl").style.display = "none";
				document.getElementById("cuantosbl").style.display = "none";	
				document.getElementById("tipo_volumen_aereo").style.display = "inline";	
				document.getElementById("tipo_volumen_maritimo").style.display = "none";			
			<?
			}
			?>			
		}
		
		if(tipo=="Marítimo"){
			document.getElementById("naviera").style.display = "inline";
			document.getElementById("aerolinea").style.display = "none";
			document.getElementById("tipo_carga_mar").style.display = "inline";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "none";
			<?
			if( $modo=="expo" ){
			?>
				document.getElementById("emisionbl").style.display = "inline";
				document.getElementById("cuantosbl").style.display = "inline";	
				document.getElementById("tipo_volumen_aereo").style.display = "none";	
				document.getElementById("tipo_volumen_maritimo").style.display = "inline";		
			<?
			}
			?>
		}
		
		if(tipo=="Terrestre"){			
			document.getElementById("naviera").style.display = "none";
			document.getElementById("aerolinea").style.display = "none";	
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "inline";	
			document.getElementById("terrestre").style.display = "inline";	
			<?
			if( $modo=="expo" ){
			?>
				document.getElementById("emisionbl").style.display = "none";
				document.getElementById("cuantosbl").style.display = "none";	
				document.getElementById("tipo_volumen_aereo").style.display = "none";	
				document.getElementById("tipo_volumen_maritimo").style.display = "inline";			
			<?
			}
			?>
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
<h3>Reporte de Negocio de <?=$modo=="expo"?"<strong>Exportaci&oacute;n</strong>":"<strong>Importaci&oacute;n</strong>"?></h3>
<br>
<br>
<?=form_tag("reportesNeg/formReporteGuardar?modo=".$modo, "name=reporteForm id=reporteForm")?>
<?=input_hidden_tag("reporteId", $reporteNegocio->getCaIdReporte() )?>
<table cellspacing="1" width="90%" class="tableForm">
	<tbody>
		<tr>
			<th class="titulo" colspan="4">REPORTE DE NEGOCIO</th>
		</tr>
		<tr>
			
			<td width="252" class="mostrar">N&uacute;mero del reporte <br />
			<?=$reporteNegocio->getCaConsecutivo()?></td>
			<td width="116"  class="mostrar">Fecha del Reporte:<br />
			<?=Utils::fechaMes($reporteNegocio->getCaFchreporte("Y-m-d")?$reporteNegocio->getCaFchreporte("Y-m-d"):date("Y-m-d"))?></td>
			<td width="194" class="mostrar"><!--Cotizaci&oacute;n:-->
				<span class="captura">1. Fecha despacho <br />
				
				<?=yui_calendar("fchDespacho", date("Y-m-d"), null, "2008-01-01" )?>
			</span></td>
			<?
				
				?>
			<td width="203" class="mostrar">
				2. Cotizaci&oacute;n:<br />
				<?=include_component("general", "comboCotizaciones", array("idcotizacion"=>$reporteNegocio->getCaIdCotizacion() ) )?></td>
		</tr>
		<tr>
			<td colspan="4" class="mostrar">
				
				 <fieldset >
					  <legend>3. Cliente</legend>

						<table width="592" cellpadding="0" cellspacing="0">
				<tr>
					<td width="445">
					<?=include_component("clientes", "comboContactosClientes", array("idcontacto"=>$reporteNegocio->getCaIdConcliente() ) )?>						<br /></td>
					<td width="145" >3.3 Orden:<br />
						<?=input_tag("orden_clie", $reporteNegocio->getCaOrdenClie(), "size=15")?></td>
				</tr>
			</table>
				</fieldset></td>
		</tr>
		<tr>			
			<td colspan="4" class="mostrar">
				 <fieldset >
					  <legend>4. Consignatario</legend>				
						<table cellspacing="0" cellpadding="0">
				<tr>
					<td width="115"> Nombre:					
						<br />
						<?
						include_component("clientes", "comboConsignatario", array( "id"=>"idconsignatario", "idtercero"=>$reporteNegocio->getCaIdconsignatario() ));
						?>						</td>
					<td width="116"><span class="listar"><?php echo m_link_to(image_tag("22x22/new.gif")." Nuevo", 'clientes/agregarTercero?tipo=consignatario&formName=expoReporteFormconsignatario', array("title"=>"Haga click aca para crear un nuevo consignatario") , array( "width"=>850 ) ) ?></span></td>
					<td width="294">
						<?
						if( $modo!="expo" ){ //Esta casilla solamente es util en el caso de la importaciones 
						?>
						 Enviar Informaci&oacute;n:<br />
						
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
					</tr>				
			</table>	
			</fieldset>			</td>
		</tr>
		
		<tr>
			
			<td colspan="4" class="mostrar">
				 <fieldset >
					  <legend>5. Notify</legend>
				
						<table cellspacing="0" cellpadding="0">
				<tr>
					<td width="117">Nombre:					
						<?
						include_component("clientes", "comboNotify", array( "id"=>"idconsignatario", "idtercero"=>$reporteNegocio->getCaIdnotify() ));
						?></td>
					<td width="117"><span class="listar"><?php echo m_link_to(image_tag("22x22/new.gif")." Nuevo", 'clientes/agregarTercero?tipo=notify&formName=expoReporteFormnotify', array("title"=>"Haga click aca para crear un nuevo notify") , array( "width"=>850 ) ) ?></span></td>
					<td width="293">
						<?
						if( $modo!="expo" ){ //Esta casilla solamente es util en el caso de la importaciones 
						?>
						 Enviar Informaci&oacute;n:<br />
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_noti", "Sí",   $reporteNegocio->getCaInformarNoti()=="Sí"||!$reporteNegocio->getCaInformarNoti() )?>	
						S&iacute;&nbsp;&nbsp;&nbsp;
						<?=radiobutton_tag( "informar_noti", "No",   $reporteNegocio->getCaInformarNoti()=="No" )?>	
						No
						<?
						}else{
							echo "&nbsp;";
						}
						?>										</td>
					</tr>				
			</table>	
			</fieldset>			</td>
		</tr>
		<tr>
			<td rowspan="2" class="listar">6. Transporte:<br />
				<span class="listar">
					<?=select_tag("transporte", options_for_select(array("A&eacute;reo"=>"A&eacute;reo", "Mar&iacute;timo"=>"Mar&iacute;timo", "Terrestre"=>"Terrestre"  ), Utils::replace($reporteNegocio->getCaTransporte()) ) , "onChange='cambiarTransporte(this.value)'")?>
			</span></td>
			<td  rowspan="2" class="listar">7. Modalidad:<br />				
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
			<td class="listar">
					<div id='naviera'>
						8 L&iacute;nea  de transporte:<br />
						<?=select_tag("idnaviera", objects_for_select($navieras, "getId", "getCaNombre", $reporteNegocio->getCaIdlinea() ) )?>
					</div>
				<div id='aerolinea'>
					8 L&iacute;nea  de transporte:<br />	
						<?=select_tag("idaerolinea", objects_for_select($aerolineas, "getId", "getCaNombre" , $reporteNegocio->getCaIdlinea() ) )?>
				</div>			</td>
			<td rowspan="2" class="listar">9. Incoterms : <br />
				<?=select_tag("incoterms", objects_for_select($incoterms, "getCavalor","getCavalor", $reporteNegocio->getCaIncoterms() ) )?></td>
		</tr>
		<tr>
			<td class="listar"> 
				<div id='terrestre'>					
						<?
						if( $modo=="expo" ){
						?>
						8 Linea de transporte terrestre:<br />
						<?
							$repexpo = $reporteNegocio->getRepExpo();
							echo select_tag("idlineaterrestre", objects_for_select($transportadores, "getId", "getCaNombre",  $repexpo->getCaIdlineaterrestre()  ) );
						}	
						?>
				</div></td>
		</tr>
		<tr>
			<td class="listar" style="vertical-align: top;">
			 <fieldset >
					  <legend>10.  Origen</legend>
					Pais:<br />
					<?=select_tag("pais_origen", array("Colombia"))?>			
			<?
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
					<br />Ciudad:<br />
					<div id="ciudadOrigen">
						<?=include_component("general", "seleccionCiudad", array("trafico_id"=>"CO-057", "fieldName"=>"idCiudadOrigen", "selected"=>$reporteNegocio->getCaOrigen() ))?>
				</div>			
				</fieldset>			</td>
			<td class="listar" style="vertical-align: top;">
				 <fieldset >
					  <legend>11. Destino</legend>
						Pais<br />
						<?
					include_component("general", "seleccionTrafico", array("fieldName"=>"Destino", "selected"=>$trafico));		
					?>			
					<br />Ciudad:<br />

					<div id="ciudadDestino">
				<?=include_component("general", "seleccionCiudad", array("trafico_id"=>$trafico, "selected"=>$reporteNegocio->getCaDestino()))?>
				
				
			</div>
			</fieldset></td>
			<td colspan="2" class="listar" style="vertical-align: top;">
				<fieldset >
					  <legend>12. Agente:</legend>
				 [Listar todos <?=checkbox_tag("listarTodos", "" ,false, "onclick=seleccionAgente()")?>] <br />
				<div id="agentes">
					<?=select_tag("agente", options_for_select(array(""=>"Directo")).objects_for_select($agentes, "getId", "getCaNombre", $reporteNegocio->getCaIdagente()  ) )?>
				</div>
				</fieldset>		
			</td>
		</tr>
		
		<tr>
			<td colspan="4" class="mostrar">	</td>
		</tr>
		<tr>
			<td colspan="4" class="mostrar">13. Descripci&oacute;n de la Mercanc&iacute;a:<br />
				<?php echo form_error('mercancia_desc') ?>
				<span class="listar">
				<?=textarea_tag( "mercancia_desc", $reporteNegocio->getCaMercanciaDesc(), "size=93x3")?>
		    </span></td>
		</tr>
		
		
		<?
		if( $modo=="expo" ){	
		?>
		<tr>
			
			<td colspan="4" class="listar">
				<fieldset >
					  <legend>14 Informaci&oacute;n Exportaciones</legend>
					<?
				include_component("reportesNeg", "formExpo", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));
				?>
				</fieldset>				</td>
		</tr>
		<?
		}
		?>		
		<tr>
			<td colspan="2" class="invertir"> 15. Preferencias del cliente:<br />
					<?=textarea_tag("preferencias_clie",$reporteNegocio->getCaPreferenciasClie(), "size=90x10")?>			</td>
			<td colspan="2" rowspan="2" class="invertir" valign="top"><!--Informaciones a: -->
			
				16 Informaciones a:<br />
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
							<td width="40" class="invertir"><?=checkbox_tag("confirmar[]", $i, isset($confirmar[$i])&&$confirmar[$i]?true:false, "id=confirmar_{$i}")?></td>
						</tr>
						<?
						}
						?>
					</tbody>
				</table></td>
		</tr>
		<tr>
			<td colspan="2" class="invertir"><div onclick="mostarIntruccionesAgente()">17. Instrucciones Especiales:</div>
					<br />
					<div id="intrucciones_agente" style="display:<?=$reporteNegocio->getCaInstrucciones()?"inline":"none"?>">
						<?=textarea_tag("instrucciones_agente", $reporteNegocio->getCaInstrucciones(), "size=90x10")?>
				</div></td>
		</tr>
		
		<tr>
			<td colspan="4" class="invertir">18 Instrucciones para el corte de las guias:</td>
		</tr>
		<tr>
			<td class="listar">18.1 Consignar Master (MAWB/BL) a :</td>
			<td colspan="3" class="listar">				
			<?				
			echo select_tag("idconsignarmaster", objects_for_select($consignarMaster, "getCaIdentificacion","getCavalor", $reporteNegocio->getCaIdConsignarmaster()));			
			?></td>
		</tr>
		<tr>
			<td class="listar">18.2 Consignar hijas (HAWB/HBL) a :</td>
			<td colspan="3" class="listar">				
			<?				
			echo select_tag("idconsignar", objects_for_select($consignar, "getCaIdentificacion","getCavalor", $reporteNegocio->getCaIdConsignar()));			
			?></td>
		</tr>
		
		<tr>
			<td class="invertir">19. Seguro Anker:<br />						
					<?=radiobutton_tag("seguro" , "Si" , $reporteNegocio->getCaSeguro()=="Sí", "onClick=cambiarDisplay('formAseguradora','inline')")?>
					S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;
	<?=radiobutton_tag("seguro" , "No" , $reporteNegocio->getCaSeguro()?$reporteNegocio->getCaSeguro()=="No":true , "onClick=cambiarDisplay('formAseguradora','none')" )?>
					No			</td>
			<td colspan="3" class="invertir">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" class="listar">
				<div id="formAseguradora" style="display:<?=$sf_params->get('seguro')=="Si"||$reporteNegocio->getCaSeguro()=="Sí"?"inline":"none" ?>">
					<?
				include_partial("reportesNeg/formAseguradora", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));
				?>
				</div>			</td>
		</tr>		
		<tr>
			<td class="invertir">20. Transporte Terrestre:<br />		
					<?=radiobutton_tag("colmas" , "Si" , $reporteNegocio->getCaColmas()=="Sí", "onClick=cambiarDisplay('formColmas','inline')")?>
					S&iacute;&nbsp;&nbsp;&nbsp;&nbsp;								
					<?=radiobutton_tag("colmas" , "No" ,  $reporteNegocio->getCaColmas()?$reporteNegocio->getCaColmas()=="No":true , "onClick=cambiarDisplay('formColmas','none')")?>
			No				</td>
			<td colspan="3" class="invertir">&nbsp;</td>
		</tr>	
		<tr >
			<td colspan="4" class="listar">
				<div id="formColmas" style="display:<?=$sf_params->get('colmas')=="Si"||$reporteNegocio->getCaColmas()=="Sí"?"inline":"none" ?>">
			
				
				<?		
				include_component("reportesNeg", "formTransporteNal", array("reporteNegocio"=>$reporteNegocio, "editable"=>true));				
				?>
				</div>			</td>
		</tr>
		<tr>
			<td colspan="2" class="listar">Rep. Comercial: <span class="invertir">
				<?
		$cliente = $reporteNegocio->getCliente();
		
		if( $cliente ){
			$vendedor = $cliente->getCaVendedor();
		}else{
			$vendedor = "";
		}	
		
		if( $user->getNivelAcceso()>0  ){
			echo select_tag("login", objects_for_select($comerciales, "getCaLogin", "getCaNombre", $reporteNegocio->getCaLogin()?$reporteNegocio->getCaLogin():$vendedor ) );				
		}else{	
			echo $reporteNegocio->getCaLogin()?$reporteNegocio->getCaLogin():$vendedor;
			echo input_hidden_tag("login", $reporteNegocio->getCaLogin()?$reporteNegocio->getCaLogin():$vendedor  );	
		}
		
		
		
	   	
			
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
			<th><?=button_to("Cancelar", "reportesNeg/index?modo=".$modo)?></th>
		</tr>
	</tbody>
</table>
</form>
<script language="JavaScript" type="text/javascript">		
	cambiarTransporte( document.getElementById('transporte').value );
	seleccionAgente();
</script>
