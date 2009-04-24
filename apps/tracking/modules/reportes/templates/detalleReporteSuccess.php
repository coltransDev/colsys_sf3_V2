<?
use_helper (   "MimeType" );
$fileIdx = 0;
?>
<script language="javascript">
	function comentar( id ){		
		document.getElementById( "coment_status_txt_"+id ).style.display = "inline";
		document.getElementById( "coment_status_"+id ).style.display = "none";
	}
	function cancelar_comentar( id ){
		document.getElementById( "coment_status_"+id ).style.display = "inline";
		document.getElementById( "coment_status_txt_"+id ).style.display = "none";
	}
	
	function guardar_comentario( id ){
		cancelar_comentar( id );
		
		var txt = document.getElementById( "coment_status_field_"+id ).value;
		document.getElementById( "coment_status_field_"+id ).value="";
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando...',						
				url: '<?=url_for("reportes/guardarRespuesta")?>', 														
				params : {
					idstatus: id,					
					comentario: txt
				},
										
				callback :function(options, success, response){	
					document.getElementById("coments_"+id).innerHTML = response.responseText; 
					<?
					if(!$user->getTrackingUser()){
					?>
					alert("El mensaje se ha enviado, proximamente recibirá una respuesta");
					<?
					}else{
					?>
					alert("El mensaje se ha enviado, se enviará una copia al cliente");
					<?
					}
					?>
				}	
			 }
		); 				
		
	}
		
</script>
<div align="center">

<table width="90%" border="1" class="table1">
	<tr>
		<th colspan="2">Detalles del embarque</th>
	</tr>
	<tr>
		<td colspan="2">
		<div align="left"><b>Proveedor:</b><br>
	        <?
	        $proveedoresStr ="";
			$proveedores = $reporte->getProveedores();
			foreach( $proveedores as $proveedor ){				
				$proveedoresStr.= $proveedor->getCaNombre()."<br />";					
			}
			echo $proveedoresStr;
	        ?>		
        </div>		</td>
	</tr>
	<tr>
		<td width="50%">
		<div align="left"><b>Reporte:</b><br />
		  <?=$reporte->getCaConsecutivo ()?>	  
		  </div>		</td>
		<td width="50%">
		<div align="left"><b>Orden:<br />
		</b>
	      <?=$reporte->getCaOrdenClie()?> 
	    </div>		</td>
	</tr>
	<tr>
		<td width="50%">
		<div align="left"><b>Origen:</b><br />
		  <?=$reporte->getOrigen ()?>	  
		  </div>		</td>
		<td width="50%">
		<div align="left"><b>Destino:<br />
		</b>
	      <?=$reporte->getDestino ()?> 
	    </div>		</td>
	</tr>
	<?
	if( $reporte->getCaModalidad()!="COLOADING" && $reporte->getCaModalidad()!="LCL" ){	
	?>	
	<tr>
		<td>
		<div align="left">
		  <?
		  	
				$transportador = $reporte->getTransportador ();
				if ($transportador) {
					?>
		  <b>Transportador</b><br />
		  <?
					echo $transportador->getCaNombre ();
				}
			
				?>
		  </div>		</td>
		<td>
		<div align="left"><b>Modalidad:</b> <br />
		  <?=$reporte->getCaModalidad ()?>
		  </div>		</td>
	</tr>
	<?
	}
	
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
		<td><div align="left"><b>ETS</b><br />
			<?=$reporte->getETS ()?>
		</div></td>
		<td><div align="left"><b>ETA</b><br />
			<?=$reporte->getETA ()?></div></td>
	</tr>
	<tr>
		<td width="50%">
		<div align="left"><b><?=$reporte->getCaTransporte()=="Aéreo"?"HAWB":"HBL"?></b> <br />
	      <?=$reporte->getDoctransporte ()?>
		  </div>		</td>
		<td width="50%">
		<div align="left"><b>Piezas:<br />
		</b>
	      <?=$reporte->getPiezas () ?>
		  </div>		</td>
	</tr>
	<tr>
		<td>
		<div align="left"><b>Peso </b> <br />
        <?= $reporte->getPeso () ?>
	    </div>		</td>
		<td>
		<div align="left"><b>Volumen </b><br />
        <?=$reporte->getVolumen () ?>
	    </div>		</td>
	</tr>
		<?
	if ($referencia) {

		if ($via =="Marítimo" &&$referencia->getCaFchLiberacion ()) {
			?>
	<tr>
		<td>
		<div align="left"><b>Fecha Liberaci&oacute;n</b><br />
  	      <?=$referencia->getCaFchLiberacion ()?>
  	    </div>		</td>
		<td>
		<div align="left"><b>Nota Liberaci&oacute;n</b><br />
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
		<div align="left"><b>Factura</b><br />
	        <?=$ingreso->getCaFactura ()?>
		    </div>		</td>
		<td>
		<div align="left"><b>Fecha factura</b><br />
	        <?=$ingreso->getCaFchfactura ()?>
		    </div>		</td>
	</tr>
		<?
			if ($ingreso->getCaReccaja ()) {
				?>
		<tr>
		<td>
		<div align="left"><b>Recibo de caja </b><br />
	        <?=$ingreso->getCaReccaja () ? $ingreso->getCaReccaja () : "&nbsp;"?>
		    </div>		</td>
		<td>
		<div align="left"><b>Referencia:</b><br />
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
		<div align="left"><b>Fecha </b></div>
		</td>
		<td>
		<div align="left"><b> Status</b></div>
		</td>
		<td><b>Opciones</b></td>
	</tr>
	<?
	if( count($statuss) ){
		foreach( $statuss as $timestamp=>$status ){
	?>
	
	<tr>
		<td width="16%" valign="top">
		<div align="left" class="story"><?=Utils::fechaMes(date("Y-m-d", $timestamp ))." ".date("h:i A", $timestamp ) ?> 
		</div>
	  </td>
		<td width="73%">			
			<div class="story">			
				<?=Utils::replace ( $status["status"] )?>	
				<br />			
			</div>
			<div id="coments_<?=$status["idstatus"]?>">
			<?
			include_component("reportes","listaRespuestas", array("idstatus"=>$status['idstatus'] ));
			?>
			</div>
			<?php 
			if( $status['idstatus'] ){
			?>
			<div class="story_coment" id="coment_status_txt_<?=$status['idstatus']?>" style="display:none" >
				<textarea rows="1" cols="50" id="coment_status_field_<?=$status['idstatus']?>" onkeyup="autoGrow(this)" onfocus="autoGrow(this)"></textarea>
				<br />
				
				<b><a onclick="guardar_comentario( <?=$status['idstatus']?>  )">Guardar</b></a> <b><a onclick="cancelar_comentar('<?=$status['idstatus']?>')">Cancelar</a></b>
			</div>	
			<div class="story_coment" id="coment_status_<?=$status['idstatus']?>" onclick="comentar('<?=$status['idstatus']?>')">
				<b>Respuesta</b>
			</div>	
			<?php 
			}
			?>
	  </td>
		<td width="11%"><?php
			if( isset($status["emailid"]) ){
				echo link_to ( image_tag ( "24x24/mail_post_to.gif" ), 'reportes/verEmail?email=' .$status["emailid"].'&idstatus='.$status["idstatus"]  );
				
				
			}			
			?></td>
	</tr>
	<?
		}		
	}else{
	?>
	<tr>
	  <td valign="top" colspan="3"><div align="center">No se han creado status en el momento</div></td>
	</tr>
	<?
	}
	?>
</table>
<?


	?>
<br />
<a name="archivos"></a>
<table width="90%" border="1" class="table1">
	<tr>
		<th scope="col">Archivos</th>
	</tr>
	<?	
	//Los archivos en la carpeta
	if ($files) {
		foreach ( $files as $file ) {
			$user->addFile ( $file, $fileIdx );
			$url = "general/fileViewer?idx=" . $fileIdx . "&token=" . md5 ( time().basename($file));
		?>
	<tr>
		<td width="70%">
		<div align="left" class="info"><?=mime_type_icon ( basename ( $file ) )?> 
			<a href="#archivos" onClick="popup('<?=url_for($url)?>', '800', '600' , '')"><?=basename ( $file )?></a>
		</div>
		</td>
	</tr>
		<?
			$fileIdx++;
		}
	}
	
	
	//Los archivos en los attachments
		
	
	
	$repstatuss = $reporte->getRepStatuss();	
	foreach( $repstatuss as $repstatus ){
		$email = $repstatus->getEmail();
		if( $email ){
			$attachments = $email->getEmailAttachments();		
			
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
	}
	
	if( $fileIdx==0 ){
	?>
	<tr>
				<td width="70%">
				<div align="center" class="info">No se han colocado archivos</div>
				</td>
		</tr>
	<?
	}
	?>
</table>

</div>