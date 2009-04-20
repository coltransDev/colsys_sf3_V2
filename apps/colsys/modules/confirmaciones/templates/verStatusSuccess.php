 Señores:<br />
<b>
<?=strtoupper($cliente->getCaCompania())?>
</b><br />
<br />
<table width="100%" cellspacing="1" border="1">
	if ( $tipo_msg == &quot;Confirmación&quot; ) {
	<tr>
		<td colspan="6">&quot;.nl2br($intro_body).&quot;</td>
	</tr>
	<?
					if ( $inoCliente->getCaNumorden() ) {
					?>
	<tr>
		<td><b>Orden:</b></td>
		<td colspan="5"><?=$inoCliente->getCaNumorden()?></td>
	</tr>
	<?
					}
					?>
	<tr>
		<td><b>Proveedor:</b></td>
		<td colspan="5"><?=$inoCliente->getCaProveedor()?></td>
	</tr>
	<tr>
		<td><b>Origen:</b></td>
		<td><?=$inoMaestra->getOrigen()->getCaCiudad()?></td>
		<td><b>Fch.Salida:</b></td>
		<td><?=$inoMaestra->getCaFchembarque()?></td>
		<td><b>Nombre del Buque:</b></td>
		<td><?=$inoMaestra->getCaMnllegada()?></td>
	</tr>
	<tr>
		<td><b>Destino:</b></td>
		<td><?=$inoMaestra->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Llegada:</b></td>
		<td><?=$inoMaestra->getCaFchconfirmacion()?>
			<br />
			<b>Hora: </b>
			<?=$inoMaestra->getCaHoraconfirmacion()?>
		</td>
		<?
					if ( $inoMaestra->getCaFchdesconsolidacion() ) {
					
				?>
		<td><b>Desconsolidación:</b></td>
		<td><?=$inoMaestra->getCaFchdesconsolidacion()?></td>
		<?	  
					} else {
					?>
		<td colspan="2">&nbsp;</td>
		<?
					}
					?>
	</tr>
	<tr>
		<td><b>No.Piezas:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaNumpiezas())?></td>
		<td><b>Volumen:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaVolumen())?></td>
		<td><b>Peso:</b></td>
		<td><?=Utils::formatNumber($inoCliente->getCaPeso())?></td>
	</tr>
	<tr>
		<td><b>No. HBL:</b></td>
		<td><?=$inoCliente->getCaHbls()?></td>
		<td><b>Reg. Aduanero:</b></td>
		<td><?=$inoMaestra->getCaRegistroadu()?></td>
		<td><b>Fch.Registro:</b></td>
		<td><?=$inoMaestra->getCaFchregistroadu()?></td>
	</tr>
	<tr>
		<td><b>Reg. Capitania:</b></td>
		<td><?=$inoMaestra->getCaRegistrocap()?></td>
		<td><b>Bandera:</b></td>
		<td colspan="3"><?=$inoMaestra->getCaBandera()?></td>
	</tr>
	if (strlen($$personal) != 0){
	<tr>
		<td colspan="6"><b>Nota:</b><br/>
			&quot;.$$personal.&quot;</td>
	</tr>
	}
	<?
	$equipos = $inoMaestra->getInoEquiposSeas();
	
	if (count($equipos)> 0){
	?>
	<tr>
		<td colspan="6"><table width="100%" cellspacing="1" border="1">
				<tr>
					<th colspan="4">Relación de Contenedores</th>
				</tr>
				<tr>
					<th>Concepto</th>
					<th>Cantidad</th>
					<th>ID Equipo</th>
					<th>Observaciones</th>
				</tr>
				<?				
				foreach( $equipos as $equipo ){
				?>
				<tr>
					<td><?=$equipo->getConcepto()->getCaConcepto()?></td>
					<td><?=$equipo->getCaCantidad()?></td>
					<td><?=$equipo->getCaIdequipo()?></td>
					<td><?=$equipo->getCaObservaciones()?$equipo->getCaObservaciones():"&nbsp;"?></td>
				</tr>
				<?
				}
				?>
			</table></td>
	</tr>
	<?
	}
	
	if ( $inoCliente->getCaNumorden() ) {
	?>
	<tr>
		<td><b>Orden :</b></td>
		<td colspan="5"><?=$inoCliente->getCaNumorden()?>
		</td>
	</tr>
	<?
	}
	?>
	<tr>
		<td><b>Proveedor :</b></td>
		<td colspan="5"><?=$inoCliente->getCaProveedor()?>
		</td>
	</tr>
	<tr>
		<td><b>Origen:</b></td>
		<td><?=$inoMaestra->getOrigen()->getCaCiudad()?></td>
		<td><b>Destino:</b></td>
		<td><?=$inoMaestra->getDestino()->getCaCiudad()?></td>
		<td><b>Fch.Salida:</b></td>
		<td><?=$inoMaestra->getcaFchembarque()?></td>
	</tr>
	<?
	$statusList = $reporte->getRepStatuss();
	if( count( $statusList)>0 ){
	?>
	<tr>
		<td colspan="6"><table width="100%" cellspacing="1" border="1">
				<tr>
					<th colspan="2">Status del Embarque</th>
				</tr>
				<tr>
					<th>Fecha</th>
					<th>Status</th>
				</tr>				
				<?
				foreach( $statusList as $lstatus ){ 
				?>
				<tr>
					<td><?=$lstatus->getCaFchenvio()?></td>
					<td><?=$lstatus->getStatus()?></td>
				</tr>
				<?
				}
				?>
			</table></td>
	</tr>
	<?
	}
	?>
</table>
<?=$inoCliente->getCaMensaje()?>
<br />
<?=$inoMaestra->getCaMensaje()?>
<br />
<br />
Nota: Estimado Cliente, le recordamos que el tiempo de permanencia de mercancìa en los depositos es de un (1) mes, contados desde la fecha de llegada de la mercancìa, y pueden solicitar una posible prorroga por un (1) mes adicional acorde al Decreto 2557 del 06 de Julio 2007 art. 10<br />
<br />
Gracias por contar con nuestro servicio.<br />
<br />
Cordial Saludo.<br />
<br />
<br />
<?
echo $user->getFirmaHTML();
?>
<?

/* 
if ( $tipo_msg == "Confirmación" ) {
				 if (!$rf->Open(&quot;update tb_inomaestra_sea set ca_fchconfirmacion = '$fchconfirmacion', ca_horaconfirmacion = '$horaconfirmacion', ca_registroadu = '$registroadu', ca_fchregistroadu = '$fchregistroadu', ca_registrocap = '$registrocap', ca_bandera = '$bandera', ca_mensaje = '$email_body', ca_fchdesconsolidacion = '$fchdesconsolidacion', ca_mnllegada = '$mnllegada', ca_fchconfirmado = to_timestamp('&quot;.date(&quot;d M Y H:i:s&quot;).&quot;', 'DD Mon YYYY hh:mi:ss'), ca_usuconfirmado = '$usuario' where ca_referencia = '$id'&quot;)) {
					 echo &quot;
						<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>
&quot;;  // Muestra el mensaje de error
					 echo &quot;
						<script>document.location.href = 'confirmaciones.php';</script>
&quot;;
					 exit; }
			 }
             if (!$rf-&gt;Open(&quot;select * from vi_inomaestra_sea where ca_referencia = '$id'&quot;)){
                 echo &quot;
					<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>
&quot;;  // Muestra el mensaje de error
                 echo &quot;
					<script>document.location.href = 'confirmaciones.php';</script>
&quot;;
                 exit; }
             if ($rf-&gt;Value('ca_modalidad')==&quot;FCL&quot;) {
                 $eq =&amp; DlRecordset::NewRecordset($conn);
                 if (!$eq-&gt;Open(&quot;select * from vi_inoequipos_sea where ca_referencia = '$id'&quot;)) {
                     echo &quot;
						<script>alert(\"".addslashes($eq->mErrMsg)."\");</script>
&quot;;  // Muestra el mensaje de error
                     echo &quot;
						<script>document.location.href = 'confirmaciones.php';</script>
&quot;;
                     exit; }
                 $equipos = &quot;
                 
             } else {
                 $equipos = &quot;&quot;;
             }

             for ($i=0; $i &lt; count($oid); $i++) {
                $correo = &quot;em_&quot;.$oid[$i];
                $confirmar = isset($$correo)?implode(&quot;,&quot;,$$correo):&quot;&quot;;
                $personal = 'mensaje_'.$oid[$i];

                if (!$rs-&gt;Open(&quot;select * from vi_inoclientes_sea where ca_oid = &quot;.$oid[$i])) {
                    echo &quot;
					<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>
&quot;;  // Muestra el mensaje de error
                    echo &quot;
					<script>document.location.href = 'confirmaciones.php';</script>
&quot;;
                    exit;
                    }
				if ( $tipo_msg == &quot;Confirmación&quot; ) {
	                $asunto = &quot;Confirmación de Llegada Ref:&quot;.$rf-&gt;Value('ca_referencia').&quot; Buque:&quot;.$rf-&gt;Value('ca_mnllegada');
					$id_etapa = (($rs-&gt;Value('ca_continuacion') != 'N/A')?&quot;15&quot;:&quot;20&quot;);
					if (!$rp-&gt;Open(&quot;update tb_reportes set ca_etapa_actual = (select ca_valor from tb_parametros where ca_casouso = 'CU045' and ca_identificacion = $id_etapa) where ca_consecutivo = '&quot;.$rs-&gt;Value('ca_consecutivo').&quot;' and ca_version = (select max(ca_version) from tb_reportes where ca_consecutivo = '&quot;.$rs-&gt;Value('ca_consecutivo').&quot;')&quot;)) {
						echo &quot;
						<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>
&quot;;  // Muestra el mensaje de error
						echo &quot;
						<script>document.location.href = 'confirmaciones.php';</script>
&quot;;
						exit;
						}
				} else {
	                $asunto = &quot;Status de Carga Ref:&quot;.$rf-&gt;Value('ca_referencia');
				}

                $mensaje = &quot;
				<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
				<HTML>
				<HEAD>
				<meta http-equiv="Content-Type" content="\&quot;text/html;" charset="iso-8859-1\&quot;" />
				<meta content="\MSHTML" 6.00.2800.1106\ name="GENERATOR" />
				</HEAD>
*/ 