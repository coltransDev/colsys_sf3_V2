<?
use_helper("ExtCalendar");

$inoClientes = $sf_data->getRaw("inoClientes");
$bodegas = $sf_data->getRaw("bodegas");


switch( $modo ){
	case "otm":
		$titulo = "Módulo de Avisos de OTM";
		break;
	default: 
		$titulo = "Módulo de Status y Confirmaciones de Llegada";
		$modo="conf";
		break;
}
?>
<script language="javascript" type="text/javascript">

function validarFormConfirmacion(){	
	
	<?
	if( $modo=="otm"){
		?>
		var oids = new Array (
		<?
		$i = 0;
		foreach( $inoClientes as $inoCliente ){
			if( $i++!=0 ){
				echo ",";
			}
			echo $inoCliente->getOid();
		}
		?>
		);
		
		for( var i=0 ; i<oids.length ; i++ ){		
			var checkbox = document.getElementById("checkbox_"+oids[i]);		
			if( checkbox.checked ){					
				if( document.getElementById("divmessage_"+oids[i]).innerHTML=="" && document.getElementById("mensaje_"+oids[i]).value=="" ){
					alert("Por favor coloque un mensaje para el status");
					document.getElementById("mensaje_"+oids[i]).focus();
					return false;
				}
			}
		}	
		return true;
		
		
		<?	
	}else{
	?>
	
   if (document.getElementById('confirmacion_tbl').style.display == 'block'){
   		
	  if ( document.form1.fchconfirmacion.value == '')
		  alert('Debe Especificar la Fecha de llegada de la Carga');
	  else if (document.form1.horaconfirmacion.value == '')
		  alert('Debe Especificar la Hora exacta de llegada de la Carga');
	  else if (document.form1.registroadu.value == '')
		  alert('Debe ingresar el Registro Aduanero');
	  else if (document.form1.registrocap.value == '')
		  alert('Ingrese el Número de Registro de Capitania');
	  else if (document.form1.bandera.value == '')
		  alert('Ingrese la Bandera del Buque');
	  else if (document.form1.mnllegada.value == '')
		  alert('Ingrese el nombre de la Motonoave de Llegada');
	  else{		  
		  return (true);		  
	  }
	  return (false);
   }else{
	  if (document.form1.status_body.value == '')
		  alert('Debe incluir un mensaje de status!');
	  else
		  return (true);
	  return (false);
   }
   <?
   }
   ?>
}
 
/*function asignar_email(campo){
   cadena = campo.getAttribute('ID');
   indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);
   objeto = document.getElementById('ar_' + indice);
   if(campo.checked && objeto.value.length > 1) {
	  campo.value = objeto.value; }
   else {
	  campo.value = '' };
}*/
function habilitar( oid ){
   objeto = document.getElementById('tb_' + oid);
   campo = document.getElementById('checkbox_' + oid);
   if(campo.checked) {
	  objeto.style.display = "inline";
   }
   else {
	  objeto.style.display = "none"; 
	}
}


function mostrar(oid){
	
	
	eval('var tipo = document.form1.tipo_'+oid );
	var value='';	
	for (i=0;i<tipo.length;i++){
		  if ( tipo[i].checked ){
				 value = tipo[i].value;
		  }
	} 
	
	var objeto_1 = document.getElementById('divfchllegada_' + oid);
	var objeto_2 = document.getElementById('divbodega_' + oid);
	var objeto_3 = document.getElementById('divmessage_' + oid);
	var objeto_4 = document.getElementById('mensaje_' + oid);
	var objeto_5 = document.getElementById('divfchplanilla_' + oid);
	switch( value ){
		<?
		foreach( $etapas as $etapa ){
		?>
		case '<?=$etapa->getCaIdetapa()?>':
			objeto_3.innerHTML = '<?=$etapa->getCaMessage()?>';
			break;
		<?
		}
		?>
		default:
			objeto_3.innerHTML = '';
			break;
	}
	
	switch( value ){
		<?
		foreach( $etapas as $etapa ){
		?>
		case '<?=$etapa->getCaIdetapa()?>':
			objeto_4.value = '<?=$etapa->getCaMessageDefault()?>';
			break;
		<?
		}
		if( $modo=="otm" ){
		?>
		case '99999':
			
			objeto_4.value = '<?=str_replace("\n", "", $textos['mensajeCierreOTM'])?>';
			break;
		<?
		}
		?>
		default:			
			objeto_4.value = '';
			break;
	}
	
	
			
	if(value == "IMCOL") {
		objeto_1.style.display = 'inline';
		objeto_2.style.display = 'inline';
	}
	else {
		objeto_1.style.display = 'none';
		objeto_2.style.display = 'none';
	}
    <?
    if($modo=="otm"){
        ?>
        if(value == "99999") {
            objeto_5.style.display = 'inline';
        }
        else {
            objeto_5.style.display = 'none';
        }
    <?
    }
    ?>
}

</script>

<div align="center">

	<?
	if( !sfConfig::get("app_smtp_user") ){
	?>
	<?=image_tag("22x22/alert.gif")?>La autenticación SMTP se encuentra desactivada, es posible que sus mensajes no lleguen al destinatario.
	<br />
	<br />
	<?
	}
	?>

	<form action='<?=url_for("confirmaciones/crearStatus?modo=".$modo)?>' method="post" enctype='multipart/form-data' name='form1' id="form1" onsubmit='return validarFormConfirmacion();'>
		<input type="hidden" name="referencia" value="<?=$referencia->getCaReferencia()?>" />
		<table cellspacing="1" class="tableList" width="90%" >
			<tr>
				<td class="partir" colspan="6"><div align="center">COLTRANS S.A.<br />
						<?
					echo $titulo;
					?>
					</div></td>
			</tr>
			<tr>
				<td width="6%" class="partir">&nbsp;</td>
				<td width="13%" class="partir">Referencia:</td>
				<td class="listar" style='font-size: 11px; font-weight:bold;' colspan="2"><?=$referencia->getCaReferencia()?></td>
				<td width="33%" class="partir">Fecha de Registro :</td>
				<td width="24%" class="listar" style='font-size: 11px; text-align: center;'><span class="listar" style="font-size: 11px; font-weight:bold;">
					<?=$referencia->getCaFchreferencia()?>
					</span></td>
				
			</tr>
            
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">&nbsp;</td>
				<td class="partir" style='font-size: 11px; text-align: center;' colspan="2">Ciudad de Origen</td>
				<td class="partir" style='font-size: 11px; text-align: center;' colspan="2">Ciudad de Destino</td>
			</tr>
			<tr>
				<td class="partir" style='text-align: center; vertical-align:top;'>&nbsp;</td>
				<td class="partir" style='text-align: center; vertical-align:top;'>Importación<br />
					&nbsp;<br />
					&nbsp;</td>
				<td width="14%" class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?=$origen->getCaCiudad()?></td>
				<td width="7%" class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?=$origen->getTrafico()?></td>
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?=$destino->getCaCiudad()?></td>
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;'><?=$destino->getTrafico()?></td>
			</tr>
           
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Transportista:</td>
				<td class="listar" colspan="2"><?=$linea->getIds()->getCaNombre()." ".$linea->getCaSigla()?></td>
				<td class="listar" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="partir" rowspan="2">&nbsp;</td>
				<td class="partir" rowspan="2">Modalidad:<br />
					<center>
						<?=$referencia->getCaModalidad()?>
					</center></td>
				<td class="listar"><b>Motonave:</b><br />
					<?=$referencia->getCaMotonave()?></td>
				<td class="listar"><b>MBL's:</b><br />
					<?=$referencia->getCaMbls()?></td>
				<td class="listar" colspan="2"><b>Observaciones:</b><br />
					<?=Utils::replace($referencia->getCaObservaciones())?></td>
			</tr>
            
			<tr>
				<td colspan="4" class="listar"><?
					$inoEquipos = $referencia->getInoEquiposSea();
					
					if( count($inoEquipos)>0 ){
					?>
					<table cellspacing="0" style='letter-spacing:-1px;' width="100%">
						<tr>
							<th>Concepto</th>
							<th>Cantidad</th>
							<th>Id Equipo</th>
							<th colspan="3">Contratos de Comodato</th>
						</tr>
						<?
						foreach( $inoEquipos as $inoEquipo ){
						
							$inoContrato = $inoEquipo->getInoContratosSea();
						?>
						<tr>
							<td  class="listar"><?=$inoEquipo->getConcepto()->getCaConcepto()?></td>
							<td  class="listar"><?=$inoEquipo->getCaCantidad()?></td>
							<td  class="listar"><?=$inoEquipo->getCaIdequipo()?></td>
							<td  class="listar"><?=$inoContrato?$inoContrato->getCaIdcontrato():"&nbsp;"?></td>
							<td  class="listar"><?=$inoContrato?$inoContrato->getCaFchcontrato():"&nbsp;"?></td>
							<td  class="listar"><?=$inoContrato?$inoContrato->getCaObservaciones():"&nbsp;"?></td>
						</tr>
						<?
						
						
						}
						?>
						<tr>
							<td class="listar">Sitio de Devolución:</td>
							<td class="listar" colspan="5"><?=$referencia->getCaSitiodevolucion()?></td>
						</tr>
					</table>
					<?
					}else{
						echo "&nbsp;";
					}
					?>				</td>
			</tr>
           
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Tránsito:&nbsp;</td>
				<td class="listar" style='font-weight:bold;'>Fecha Estim.Embarque:</td>
				<td class="listar"><?=$referencia->getCaFchembarque()?></td>
				<td class="listar" style='font-weight:bold;'>Fecha Estim.Arribo:</td>
				<td class="listar"><?=$referencia->getCaFcharribo()?></td>
			</tr>
            
			<tr height="5">
				<td class="invertir" colspan="6">&nbsp;</td>
			</tr>
            
			<?
			if( $modo=="otm" ){
			?>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Status OTM:&nbsp;</td>
				<td class="mostrar" colspan="4"><b>Introducción al Mensaje:</b><br />
					<textarea name='intro_body' wrap="virtual" rows="3" cols="93"><?=$textos['mensajeConfOTM']?>
</textarea></td>
				
			</tr>
			<?
			}else{
			?>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">
                        <input name="tipo_msg" value="Conf" checked="checked" onclick="document.getElementById('confirmacion_tbl').style.display='block';document.getElementById('status_tbl').style.display='none'" type="radio">
                        Confirmación:
                </td>
				<td class="mostrar" colspan="4" rowspan="2">

                    <table id="confirmacion_tbl" style="display: block;" cellspacing="1" width="100%">
						<tbody>
							<tr>
								<td class="mostrar">Fecha Confirmación:<br>
									<?
									echo extDatePicker('fchconfirmacion', $referencia->getCaFchconfirmacion("Y-m-d"));
									?>
										
								</td>								
							
								<td class="mostrar">Hora en Formato 24h:<br>
									<input name="horaconfirmacion" value="<?=$referencia->getCaHoraconfirmacion()?>" onblur="CheckTime(this)" size="9" maxlength="8" type="text">
									00-23hrs</td>
								<td class="mostrar">Registro Aduanero:<br>
									<input name="registroadu" value="<?=$referencia->getCaRegistroadu()?>" size="22" maxlength="20" type="text"></td>
								<td class="mostrar">Fecha Registro:<br>									
									<?
									echo extDatePicker('fchregistroadu', $referencia->getCaFchregistroadu("Y-m-d"));
									?>									
									</td>
							</tr>
							<tr>
								<td class="mostrar">Reg. Capitania:<br>
									<input name="registrocap" value="<?=$referencia->getCaRegistrocap()?>" size="20" maxlength="20" type="text"></td>
								<td class="mostrar">Bandera:<br>
									<input name="bandera" value="<?=$referencia->getCaBandera()?>" size="20" maxlength="20" type="text"></td>
								<td class="mostrar">Fecha Desconsolidación:<br>								
									<?
									echo extDatePicker('fchdesconsolidacion', $referencia->getCaFchdesconsolidacion("Y-m-d"));
									?>	
								</td>
								<td class="mostrar">Motonave Llegada:<br>
									<input name="mnllegada" value="<?=$referencia->getCaMnllegada()?>" size="20" maxlength="50" type="text"></td>
							</tr>
							<tr>
								<td class="mostrar" colspan="4"><b>Introducción al Mensaje de Confirmación:</b><br>
									<textarea name="intro_body" wrap="virtual" rows="3" cols="93"><?=$textos['mensajeConf']?>
</textarea></td>
							</tr>
						</tbody>
					</table>
					<table id="status_tbl" style="display: none;" cellspacing="1" width="100%">
						<tbody>
							<tr>
								<td class="mostrar" colspan="4"><b>Introducci&oacute;n al Status:</b><br>
									<textarea name="status_body_intro" wrap="virtual" rows="2" cols="93"><?=$textos['mensajeStatusIntro']?>
</textarea></td>
							</tr>
							<tr>
								<td class="mostrar" colspan="4"><b>Mensaje de Status:</b><br>
									<textarea name="status_body" wrap="virtual" rows="3" cols="93"><?=$textos['mensajeStatus']?>
</textarea></td>
							</tr>
						</tbody>
					</table>
                </td>
				
			</tr>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir"><input name="tipo_msg" value="Status" onclick="document.getElementById('status_tbl').style.display='block';document.getElementById('confirmacion_tbl').style.display='none'" type="radio">
					Status:</td>
			</tr>
			<?
			}
			?>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Adjuntar archivo:</td>
				<td class="mostrar" colspan="4"><input type='file' name='attachment' size="65" /></td>
			</tr>
			<tr>
				<td class="listar" colspan="6">&nbsp;</td>
			</tr>
			<?
			if( isset($confirmaciones) && $confirmaciones ){
			?>
			<tr>
				<td class="listar" colspan="6">
					<b>Otras Comunicaciones</b>
					<table width="100%" border="0" class="tableList">
						<tr>
							<th width="18%" >Fecha</th>							
							<th width="60%" >Asunto</th>
							<th width="22%" >Ver email</th>
							
						</tr>
						<?
						foreach( $confirmaciones as $confirmacion ){
						?>
						<tr>
							<td><?=Utils::fechaMes($confirmacion->getCaFchenvio())?></td>
							<td><?=$confirmacion->getCaSubject()?></td>
							<td>
							<?
							if( $confirmacion->getCaIdemail() ){
								echo "<a href='#' onClick=window.open('".url_for("general/verEmail?id=".$confirmacion->getCaIdemail())."')>".image_tag("22x22/email.gif")."</a>";
							}else{	
								echo "&nbsp;";
							}
							?></td>
							
						</tr>
						<?
						}
						?>
					</table>

				</td>
			</tr>
			<?
			}
			?>

            
			<tr>
				<th class="titulo" colspan="6">Seleccione los Clientes para enviar Confirmación</th>
			</tr>
			<tr height="5">
				<td class="captura" colspan="6">&nbsp;</td>
			</tr>
            
			<?
			foreach( $inoClientes as $inoCliente ){
				$cliente = $inoCliente->getCliente();
				$reporte = $inoCliente->getReporte();
			?>
			<tr>
				<td class="listar" style='font-size: 11px; vertical-align:bottom'><b>Reporte:</b><br />
					<?=$reporte?$reporte->getCaConsecutivo():"&nbsp;"?></td>
				<td class="listar" style='font-size: 11px; vertical-align:bottom'><span class="listar" style="font-size: 11px; vertical-align:bottom"><b>Id Cliente:</b><br />
					<?=number_format($inoCliente->getCaIdcliente())?>
					</span></td>
				<td class="listar" style='font-size: 11px;' colspan="3"><b>Nombre del Cliente:</b><br />
					<?=Utils::replace($cliente->getCaCompania())?></td>
				<td class="listar" >
					<div align="right">
					<?
					if( $reporte ){
					?>					
						<input type="checkbox" name='oid[]' onclick="habilitar('<?=$inoCliente->getOid()?>');" id="checkbox_<?=$inoCliente->getOid()?>"  value="<?=$inoCliente->getOid()?>" />                        
                        <input type="hidden" name='idcliente_<?=$inoCliente->getOid()?>' value="<?=$inoCliente->getCaIdcliente()?>" />
                        <input type="hidden" name='hbls_<?=$inoCliente->getOid()?>' value="<?=$inoCliente->getCaHbls()?>" />
					<?
					}else{
                        echo "&nbsp;";
                    }
					?>				
					</div></td>
			</tr>
			<?
                if( $reporte ){
			?>
			<tr>
			
			<td class="invertir" colspan="6">
				<?
                
                include_component("confirmaciones","formConfirmacion", array("inoCliente"=>$inoCliente, "modo"=>$modo, "reporte"=>$reporte, "cliente"=>$cliente, "etapas"=>$etapas, "coordinadores"=>$coordinadores, "textos"=>$textos, $bodegas="bodegas"))
                ?>
            </td>
			</tr>
			
			<?
                $statusList = $reporte->getRepStatus();
			
                if( count( $statusList )>0 ){
			?>
			<tr id="rowstatusinfo_<?=$inoCliente->getOid()?>">
				<td colspan="6" class="invertir"><a href="#rowstatusinfo_<?=$inoCliente->getOid()?>" onclick="window.open('<?=url_for("traficos/verHistorialStatus?idreporte=".$reporte->getCaIdreporte() )?>')">Ver historial de status</a></td>
			</tr>
			<?		
                    }
                }else{//if( $reporte )
			?>
			<tr height="5">
				<td class="invertir" colspan="6"><?=image_tag("22x22/alert.gif")?>
					Debe tener reporte para poder hacer un status</td>
			</tr>
			<?	
                }
            }
			?>
			<tr height="5">
				<td class="invertir" colspan="6">&nbsp;</td>
			</tr>
			<tr>
				<td class="mostrar" colspan="6"><b>Ingrese mensaje adicional para el correo:</b><br />
					<textarea name='email_body' wrap="virtual" rows="3" cols="113"></textarea></td>
			</tr>
			<tr height="5">
				<td class="invertir" colspan="6"></td>
			</tr>

             
		</table>

       

		<br />
		<table cellspacing="10">
			<tr>
				<th><input class="submit" type='submit' name='accion' value='Enviar Correo' /></th>
				<th><input class="button" type='button' name='boton' value=' Regresar ' onclick="javascript:document.location.href = '<?=url_for("confirmaciones/index?modo=".$modo)?>'" /></th>
			</tr>
		</table>
	</form>
</div>
<script language="javascript" type="text/javascript">
	<?
	foreach( $inoClientes as $inoCliente ){
		if( $modo=="otm" ){
	?>	
			mostrar( '<?=$inoCliente->getOid()?>' );
	<?
	}
	?>
	habilitar( '<?=$inoCliente->getOid()?>' );	
	<?
	}
	?>
</script>

