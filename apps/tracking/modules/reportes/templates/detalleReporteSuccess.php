<?
use_helper ( "Modalbox", "Javascript", "Popup", "MimeType" );
$fileIdx = 0;
?>
<table width="90%" border="1" class="table1">
	<tr>
		<th colspan="2">Detalles del embarque</th>
	</tr>
	<tr>
		<td colspan="2">
		<div align="left"><strong>Proveedor:</strong><br>
	        <?=$reporte->getTercero ()?>		
        </div>		</td>
	</tr>
	<tr>
		<td width="50%">
		<div align="left"><strong>Origen:</strong><br />
		  <?=$reporte->getOrigen ()?>	  
		  </div>		</td>
		<td width="50%">
		<div align="left"><strong>Destino:<br />
		</strong>
	      <?=$reporte->getDestino ()?> 
	    </div>		</td>
	</tr>
	<tr>
		<td>
		<div align="left">
		  <?
				$transportador = $reporte->getTransportador ();
				if ($transportador) {
					?>
		  <strong>Transportador</strong><br />
		  <?
					echo $transportador->getCaNombre ();
				}
				?>
		  </div>		</td>
		<td>
		<div align="left"><strong>Modalidad:</strong> <br />
		  <?=$reporte->getCaModalidad ()?>
		  </div>		</td>
	</tr>
	<?
	
	$via = $reporte->getCaTransporte ();
	$referencia = null;
	if ($via == "Marítimo") {
		$referencia = $reporte->getInoClientesSea ();
	}
	
	if ($via == "Aéreo") {
		$referencia = $reporte->getInoClientesAir ();
	}
	
	
		?>
	
	<tr>
		<td><div align="left"><strong>ETS</strong><br />
			<?=$reporte->getETS ()?>
		</div></td>
		<td><div align="left"><strong>ETA</strong><br />
			<?=$reporte->getETA ()?></div></td>
	</tr>
	<tr>
		<td width="50%">
		<div align="left"><strong><?=$reporte->getCaTransporte()=="Aéreo"?"HAWB":"HBL"?></strong> <br />
	      <?=$reporte->getDoctransporte ()?>
		  </div>		</td>
		<td width="50%">
		<div align="left"><strong>Piezas:<br />
		</strong>
	      <?=$reporte->getPiezas () ?>
		  </div>		</td>
	</tr>
	<tr>
		<td>
		<div align="left"><strong>Peso Neto </strong> <br />
        <?= $reporte->getPeso () ?>
	    </div>		</td>
		<td>
		<div align="left"><strong>Volumen </strong><br />
        <?=$reporte->getVolumen () ?>
	    </div>		</td>
	</tr>
		<?
	if ($referencia) {

		if ($via =="Marítimo" &&$referencia->getCaFchLiberacion ()) {
			?>
	<tr>
		<td>
		<div align="left"><strong>Fecha Liberaci&oacute;n</strong><br />
  	      <?=$referencia->getCaFchLiberacion ()?>
  	    </div>		</td>
		<td>
		<div align="left"><strong>Nota Liberaci&oacute;n</strong><br />
  	      <?=$referencia->getCaNotaLiberacion ()?>
  	    </div>		</td>
	</tr>
		<?
		}
		if( $via =="Marítimo" ){
			$ingresos = $referencia->getInoIngresosSeas ();
		}
		if( $via =="Aéreo" ){
			$ingresos = $referencia->getInoIngresosAirs ();
		}
		
		foreach ( $ingresos as $ingreso ) {
			?>	
		<tr>
		<td>
		<div align="left"><strong>Factura</strong><br />
	        <?=$ingreso->getCaFactura ()?>
		    </div>		</td>
		<td>
		<div align="left"><strong>Fecha factura</strong><br />
	        <?=$ingreso->getCaFchfactura ()?>
		    </div>		</td>
	</tr>
		<?
			if ($ingreso->getCaReccaja ()) {
				?>
		<tr>
		<td>
		<div align="left"><strong>Recibo de caja </strong><br />
	        <?=$ingreso->getCaReccaja () ? $ingreso->getCaReccaja () : "&nbsp;"?>
		    </div>		</td>
		<td>
		<div align="left"><strong>Referencia:</strong><br />
        <?=$referencia->getCaReferencia ()?>
	    </div>		</td>
	</tr>	  
	
	  		<?
			}
			$imagen = $ingreso->getImagenFactura ();
			
			if ($imagen) {
				?>
		
			<tr class="row0">
		<td colspan="2">
				<?
				$user->addFile ( $imagen );
				echo link_popup ( image_tag ( "22x22/pdf.gif" ) . "Haga click aca para ver la factura", "general/fileViewer?idx=" . $fileIdx . "&token=" . md5 ( time () ), "800", "600" );
				$fileIdx ++;
				
				?></td>
	</tr>		
			<?
			
			}
		}
	} else {
		?>
		
	<?
	}
	
	?>
</table>
<br />
<?
$statuss = $reporte->getHistorialStatus ();

?>
<table width="90%" border="1" class="table1">
	<tr>
		<th colspan="3" scope="col">Status</th>
	</tr>
	<tr>
		<td>
		<div align="left"><strong>Fecha </strong></div>
		</td>
		<td>
		<div align="left"><strong> Status</strong></div>
		</td>
		<td><strong>Opciones</strong></td>
	</tr>
	<?
	if( count($statuss) ){
		foreach( $statuss as $timestamp=>$status ){
	?>
	
	<tr>
		<td width="19%" valign="top">
		<div align="left"><strong><?=Utils::fechaMes(date("Y-m-d", $timestamp ))." ".date("h:i A", $timestamp ) ?> </strong>
		</div>
		</td>
		<td width="70%">
		<div align="left" class="info">	
			
			
			<?=Utils::replace ( $status["status"] )?>		
			</div>
		</td>
		<td width="11%"><?php
			if( isset($status["emailid"]) ){
				echo m_link_to ( image_tag ( "24x24/mail_foward.png" ), 'reportes/verEmail?email=' .$status["emailid"] , array ("title" => "Vista previa del correo electronico" ), array ("width" => 850 ) );
				
				
			}
			?></td>
	</tr>
	<?
		}		
	}else{
	?>
	<tr>
		<td width="19%" valign="top" colspan="3"><div align="center">No se han creado status en el momento</div></td>
	</tr>
	<?
	}
	?>
</table>
<?


	?>
<br />
<table width="90%" border="1" class="table1">
	<tr>
		<th scope="col">Archivos</th>
	</tr>
	<?	
	//Los archivos en la carpeta
	if ($files) {
		foreach ( $files as $file ) {
			$user->addFile ( $file, $fileIdx );
		?>
	<tr>
		<td width="70%">
		<div align="left" class="info"><?=mime_type_icon ( basename ( $file ) ) . " " . link_popup ( basename ( $file ), "general/fileViewer?idx=" . $fileIdx . "&token=" . md5 ( time().basename($file)),"800","600" )?></div>
		</td>
	</tr>
		<?
			$fileIdx++;
		}
	}
	
	
	//Los archivos en los attachments
	
	$repavisos = $reporte->getRepAvisos();
	
	
	foreach( $repavisos as $repaviso ){
		$email = $repaviso->getEmail();
		$attachments = $email ->getEmailAttachments();
		
		foreach( $attachments as $attachment ){
		?>
		<tr>
			<td width="70%">
			<div align="left" class="info"><?=mime_type_icon ( $attachment->getCaHeaderFile() ) . " " . link_popup ( $attachment->getCaHeaderFile(), "general/attachmentViewer?idx=" . $attachment->getCaIdattachment() . "&token=" . md5 ( time().$attachment->getCaHeaderFile()),"800","600" )?></div>
			</td>
		</tr>
		<?
		}
		 
	}
	
	$repstatuss = $reporte->getRepStatuss();	
	foreach( $repstatuss as $repstatus ){
		$email = $repstatus->getEmail();
		$attachments = $email ->getEmailAttachments();		
		
		foreach( $attachments as $attachment ){
		?>
		<tr>
			<td width="70%">
			<div align="left" class="info"><?=mime_type_icon ( $attachment->getCaHeaderFile() ) . " " . link_popup ( $attachment->getCaHeaderFile(), "general/attachmentViewer?idx=" . $attachment->getCaIdattachment() . "&token=" . md5 ( time().$attachment->getCaHeaderFile()),"800","600" )?></div>
			</td>
		</tr>
		<?
		}
	}
	?>
</table>



