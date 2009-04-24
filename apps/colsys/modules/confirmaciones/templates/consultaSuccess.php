<?
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

function validar(){
   if (document.getElementById('confirmacion_tbl').style.display == 'block'){
	  if (!chkDate(document.cabecera.fchconfirmacion))
		  alert('Debe Especificar la Fecha de llegada de la Carga');
	  else if (document.cabecera.horaconfirmacion.value == '')
		  alert('Debe Especificar la Hora exacta de llegada de la Carga');
	  else if (document.cabecera.registroadu.value == '')
		  alert('Debe ingresar el Registro Aduanero');
	  else if (document.cabecera.registrocap.value == '')
		  alert('Ingrese el Número de Registro de Capitania');
	  else if (document.cabecera.bandera.value == '')
		  alert('Ingrese la Bandera del Buque');
	  else if (document.cabecera.mnllegada.value == '')
		  alert('Ingrese el nombre de la Motonoave de Llegada');
	  else
		  return (true);
	  return (false);
   }else{
	  if (document.cabecera.status_body.value == '')
		  alert('Debe incluir un mensaje de status!');
	  else
		  return (true);
	  return (false);
   }
}
 
function asignar_email(campo){
   cadena = campo.getAttribute('ID');
   indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);
   objeto = document.getElementById('ar_' + indice);
   if(campo.checked && objeto.value.length > 1) {
	  campo.value = objeto.value; }
   else {
	  campo.value = '' };
}
function habilitar(campo){
   objeto = document.getElementById('tb_' + campo.value);
   if(campo.checked) {
	  objeto.style.display = "inline";
   }
   else {
	  objeto.style.display = "none"; 
	}
}

</script>

<div align="center">
	<form action='<?=url_for("confirmaciones/crearStatus?modo=".$modo)?>' method="post" enctype='multipart/form-data' name='cabecera' id="cabecera" onsubmit='return validar();'>
		<input type='hidden' name='id' value='400.25.02.002.9' />
		<table width="600" cellspacing="1" class="tableList">
			<tr>
				<td class="partir" colspan="7"><div align="center">COLTRANS S.A.<br />
					<?
					echo $titulo;
					?>
					</div></td>
			</tr>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Referencia:</td>
				<td class="listar" style='font-size: 11px; font-weight:bold;' colspan="2"><?=$referencia->getCaReferencia()?></td>
				<td class="partir">Fecha de Registro :</td>
				<td style='font-size: 11px; text-align: center;' class="listar"><span class="listar" style="font-size: 11px; font-weight:bold;">
					<?=$referencia->getCaFchreferencia()?>
					</span></td>
				<td width="44" rowspan="7" class="listar"></td>
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
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;' width="160"><?=$origen->getCaCiudad()?></td>
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;' width="160"><?=$origen->getTrafico()?></td>
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;' width="160"><?=$destino->getCaCiudad()?></td>
				<td class="listar" style='font-size: 11px; text-align: center; font-weight:bold;' width="160"><?=$destino->getTrafico()?></td>
			</tr>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Transportista:</td>
				<td class="listar" colspan="2"><?=$linea->getCaNombre()." ".$linea->getCaSigla()?></td>
				<td class="listar" colspan="2"><?=$transportista->getCaNombre()?></td>
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
					$inoEquipos = $referencia->getInoEquiposSeas();
					
					if( count($inoEquipos)>0 ){
					?>
					<table width="100%" cellspacing="0" style='letter-spacing:-1px;'>
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
							<td width="124" class="listar"><?=$inoEquipo->getConcepto()->getCaConcepto()?></td>
							<td width="64" class="listar"><?=$inoEquipo->getCaCantidad()?></td>
							<td width="123" class="listar"><?=$inoEquipo->getCaIdequipo()?></td>
							<td width="54" class="listar"><?=$inoContrato?$inoContrato->getCaIdcontrato():"&nbsp;"?></td>
							<td width="55" class="listar"><?=$inoContrato?$inoContrato->getCaFchcontrato():"&nbsp;"?></td>
							<td width="140" class="listar"><?=$inoContrato?$inoContrato->getCaObservaciones():"&nbsp;"?></td>
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
					?>
				</td>
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
				<td class="invertir" colspan="7">&nbsp;</td>
			</tr>
			<?
			if( $modo=="otm" ){
			?>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir">Avisos OTM:&nbsp;</td>
				<td class="mostrar" colspan="4"><b>Introducción al Mensaje:</b><br />
					<textarea name='intro_body' wrap="virtual" rows="3" cols="93"><?=$textos['mensajeConf']?></textarea></td>
				<td class="mostrar">&nbsp;</td>
			</tr>
			<?
			}else{
			?>
			<tr>
				<td class="partir">&nbsp;</td>
				<td class="partir"><input name="tipo_msg" value="Confirmación" checked="checked" onclick="document.getElementById('confirmacion_tbl').style.display='block';document.getElementById('status_tbl').style.display='none'" type="radio">
					Confirmación:</td>
				<td class="mostrar" colspan="4" rowspan="2"><table id="confirmacion_tbl" style="display: block;" cellspacing="1" width="100%">
						<tbody>
							<tr>
								<td class="mostrar">Fecha Confirmación:<br>
									<input name="fchconfirmacion" value="<?=$referencia->getCaFchconfirmado("Y-m-d")?>
					" size="12" onkeydown="chkDate(this)" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" type="text"></td>
				<td class="mostrar">Hora en Formato 24h:<br>
					<input name="horaconfirmacion" value="<?=$referencia->getCaFchconfirmado("H:i:s")?>" onblur="CheckTime(this)" size="9" maxlength="8" type="text">
					00-23hrs</td>
				<td class="mostrar">Registro Aduanero:<br>
					<input name="registroadu" value="<?=$referencia->getCaRegistroadu()?>" size="22" maxlength="20" type="text"></td>
				<td class="mostrar">Fecha Registro:<br>
					<input name="fchregistroadu" value="<?=$referencia->getCaFchregistroadu()?>" size="12" onkeydown="chkDate(this)" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" type="text"></td>
			</tr>
			<tr>
				<td class="mostrar">Reg. Capitania:<br>
					<input name="registrocap" value="<?=$referencia->getCaRegistrocap()?>" size="20" maxlength="20" type="text"></td>
				<td class="mostrar">Bandera:<br>
					<input name="bandera" value="<?=$referencia->getCaBandera()?>" size="20" maxlength="20" type="text"></td>
				<td class="mostrar">Fecha Desconsolidación:<br>
					<input name="fchdesconsolidacion" value="<?=$referencia->getCaFchdesconsolidacion()?>" size="12" onkeydown="chkDate(this)" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" type="text"></td>
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
					<td class="mostrar" colspan="4"><b>Mensaje de Status:</b><br>
						<textarea name="status_body" wrap="virtual" rows="3" cols="93"><?=$textos['mensajeStatus']?></textarea></td>
				</tr>
			</tbody>
		</table>
		</td>
		<td class="mostrar" rowspan="6">&nbsp;</td>
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
			<td class="partir">Adjuntar&nbsp;Archivo:</td>
			<td class="mostrar" colspan="3"><input type='file' name='attachment' size="75" />
			</td>
			<td class="mostrar"></td>
		</tr>
		<tr>
			<td class="imprimir" colspan="7">&nbsp;</td>
		</tr>
		<tr>
			<th class="titulo" colspan="7">Seleccione los Clientes para enviar Confirmación</th>
		</tr>
		<tr height="5">
			<td class="captura" colspan="7"></td>
		</tr>
		<?
			
			$c = new Criteria();
			$c->addJoin( InoClientesSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE );
			$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );
			
			$inoClientes = $referencia->getInoClientesSeas( $c );
			
			foreach( $inoClientes as $inoCliente ){
				$cliente = $inoCliente->getCliente();
				$reporte = $inoCliente->getReporte();
			?>
		<tr>
			<td class="listar" style='font-size: 11px; vertical-align:bottom'><b>Reporte:</b><br />
				<?=$reporte?$reporte->getCaConsecutivo():"&nbsp;"?></td>
			<td class="listar" style='font-size: 11px; vertical-align:bottom'><span class="listar" style="font-size: 11px; vertical-align:bottom"><b>Id Cliente:</b><br />
				<?=number_format($inoCliente->getCaIdCliente())?>
				</span></td>
			<td class="listar" style='font-size: 11px;' colspan="4"><b>Nombre del Cliente:</b><br />
				<?=Utils::replace($cliente->getCaCompania())?></td>
			<td class="listar"><?
					if( $reporte ){
					?>
				<input type="checkbox" name='oid[]' onclick='habilitar(this);' value="<?=$inoCliente->getOid()?>" />
				<?
					}
					?>
			</td>
		</tr>
		<?
			if( $reporte ){
			?>
		<tr>
			<td class="invertir" colspan="7">
				<table id="tb_<?=$inoCliente->getOid()?>" style='display: none' width="100%" cellspacing="1">
					<tr>
						<td class="listar"><b>Vendedor:</b><br />
							<?=$inoCliente->getCaLogin()?></td>
						<td class="listar"><b>HBL:</b><br />
							<?=$inoCliente->getCaHbls()?></td>
						<td class="listar"><b>No.Piezas:</b><br />
							<?=Utils::formatNumber($inoCliente->getCaNumpiezas())?></td>
						<td class="listar"><b>Peso en Kilos:</b><br />
							<?=Utils::formatNumber($inoCliente->getCaPeso())?></td>
						<td class="listar"><b>Volumen CMB:</b><br />
							<?=Utils::formatNumber($inoCliente->getCaVolumen())?></td>
					</tr>
					<tr>
						<td class="listar"><b>ID Proveedor:</b><br />
							<?=$inoCliente->getCaIdproveedor()?></td>
						<td class="listar" colspan="2"><b>Proveedor:</b><br />
							<?=$inoCliente->getCaProveedor()?></td>
						<td class="listar" colspan="2" rowspan="<?=$modo=="otm"?4:2?>" valign="2"><b>Correos Electrónicos a enviar Confirmación:</b><br />
							<?								
								$confirmar = $reporte?explode(",", $reporte->getCaConfirmarclie()):array();
                       			$emails = explode(",", $cliente->getCaConfirmar());
								
								$count = max( count($confirmar)+2, 8 );
								for ($i= 0; $i< $count; $i++){
             		               $chequear = (isset($confirmar[$i]) and in_array($confirmar[$i],$emails) and $confirmar[$i]!="")?"checked='checked'":"";
								
								?>
							<input id="ar_<?=$inoCliente->getOid()?>_<?=$i?>" type='text' name='ar_<?=$inoCliente->getOid()?>_<?=$i?>' value='<?=isset($confirmar[$i])?$confirmar[$i]:""?>' size="35" maxlength="50" />
							<input id="em_<?=$inoCliente->getOid()?>_<?=$i?>" type="checkbox" name='em_<?=$inoCliente->getOid()?>[]' value='<?=$i?>'  <?=$chequear?>>
							<br />
							<?
								}
								?>
						</td>
					</tr>
					<?
						if( $modo=="otm" ){
						?>
					<tr>
						<td class="listar"><input name='tipo_<?=$inoCliente->getOid()?>' type='radio' value = 'Status' checked="checked" onclick='mostrar(this);' />
							Status<br />
							<input name='tipo_<?=$inoCliente->getOid()?>' type='radio' value = 'Confirmaci&oacute;n' onclick='mostrar(this);' />
							Confirmación<br />
							<input name='tipo_<?=$inoCliente->getOid()?>' type='radio' value = 'Cierre' onclick='mostrar(this);' />
							Cierre</td>
						<td class="listar" style='vertical-align:bottom;'><b>Destino OTM:</b><br />
							<input style='display: none;' type='text' name='ciudad_dest_<?=$inoCliente->getOid()?>' value='Bogot&aacute; D.C.' size="18" readonly="READONLY" /></td>
						<td class="listar" style='vertical-align:bottom;'><b>Fecha llegada:</b><br />
							<input style='display: none;' type='text' name='fchllegada_<?=$inoCliente->getOid()?>' value='2009-04-14' size="12" onkeydown="chkDate(this)" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" /></td>
					</tr>
					<tr>
						<td class="listar" colspan="3" style='vertical-align:bottom;'><b>Bodega:</b><br />
							<select style='display: none' name='bodega_<?=$inoCliente->getOid()?>'>
								<option value='0|Aintercarga S.A.'>Aintercarga S.A. </option>
								<option value='1|Alandino Ltda.'>Alandino Ltda. </option>
								<option value='2|Alcomex S.A.'>Alcomex S.A. </option>
								<option value='3|Algranel S.A.'>Algranel S.A. </option>
							</select>
						</td>
					</tr>
					<?
							}
							
							
							if( $modo=="otm" ){
								$mensaje = "";	
							}else{					
																
								if( isset($coordinadores[$inoCliente->getCaContinuacionDest()]) && $coordinadores[$inoCliente->getCaContinuacionDest()] ){
									$coord = $coordinadores[$inoCliente->getCaContinuacionDest()];
								}else{
									$coord = $coordinadores["COL-0000"];
								}
														
								if( $inoCliente->getCaContinuacion()!='N/A' ){
									$mensaje = chr(13).chr(13).$textos['mensajeConfOTMCliente'].$coord;
								}else{
									$mensaje = "";	
								}
								
							}
						
						?>
					<tr>
						<td class="listar" colspan="3"><b>Ingrese mensaje exclusivo para este cliente:</b><br />
							<textarea name='mensaje_<?=$inoCliente->getOid()?>' wrap="virtual" rows="5" cols="65"><?=$inoCliente->getCaMensaje().$mensaje?>
</textarea></td>
					</tr>
					<tr>
						<td class="invertir">Adjunto para Cliente : </td>
						<td class="mostrar" colspan="4"><input type='file' name='attachment_<?=$inoCliente->getOid()?>' size="75" /></td>
					</tr>
				</table></td>
		</tr>
		<?	
				}else{//if( $reporte )
			?>
		<tr height="5">
			<td class="invertir" colspan="7"><?=image_tag("22x22/alert.gif")?>
				Debe tener reporte para poder hacer un status</td>
		</tr>
		<?	
				}
			}
			?>
		<tr height="5">
			<td class="invertir" colspan="7"></td>
		</tr>
		<tr>
			<td class="mostrar" colspan="7"><b>Ingrese mensaje adicional para el correo:</b><br />
				<textarea name='email_body' wrap="virtual" rows="3" cols="113"></textarea></td>
		</tr>
		<tr height="5">
			<td class="invertir" colspan="7"></td>
		</tr>
		</table>
		<br />
		<table cellspacing="10">
			<tr>
				<th><input class="submit" type='submit' name='accion' value='Enviar Correo' /></th>
				<th><input class="button" type='button' name='boton' value=' Regresar ' onclick='javascript:document.location.href = &quot;confirma_otm.php&quot;' /></th>
			</tr>
		</table>
	</form>
</div>
