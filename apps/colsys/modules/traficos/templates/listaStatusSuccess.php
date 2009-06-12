<?
use_helper("MimeType");

?>
<script language="javascript">
	
	function actualizar( id ){
		var tabla = document.getElementById( 'lista' );
		var trs = tabla.getElementsByTagName( 'tr' );
			
		for( i = 0 ; i<trs.length ;i++){			
			if(  trs[i].id.substr(0,7)=='infotr_' ){	
				if( trs[i].id != 'infotr_'+id ){													
					if( trs[i].style.display!="none" ){
						trs[i].style.display = 'none';						
					}					
				}
			}		
		}	
		
		
		if( document.getElementById('infotr_'+id).style.display=='none' ){
			document.getElementById('infotr_'+id).style.display = '';
		}else{
			document.getElementById('infotr_'+id).style.display = 'none';
		}						
	}
	
	
	function actualizarListaStatus( id ){
		
	}
	
	
	function actualizarArchivos( idreporte ){
		Ext.Ajax.request({
			url: '<?=url_for("traficos/listaArchivosReporte");?>',
			params: {							
				idreporte: idreporte
			},
			success: function(xhr) {			
				document.getElementById('archivosReporte_'+idreporte ).innerHTML = xhr.responseText;
				
			},
			failure: function() {
				Ext.Msg.alert("Error", "Server communication failure");
			}
		});	
	}
	
	
	function eliminarArchivos( idreporte, idxArchivo ){
		if( confirm("Esta seguro que desea eliminar este archivo?") ){
			Ext.Ajax.request({
				url: '<?=url_for("traficos/eliminarArchivosReporte");?>',
				params: {							
					idreporte: idreporte,
					idxArchivo: idxArchivo
				},
				success: function(xhr) {			
					actualizarArchivos( idreporte );
					
				},
				failure: function() {
					Ext.Msg.alert("Error", "Server communication failure");
				}
			});	
		}
	}
</script>



<div align="center" class="content" >
<h3><?=Utils::replace( isset($cliente)?$cliente->getCacompania():"" )?></h3>
<br /><br />

<table width="100%" border="1" class="tableList" id="lista">
	<tr>
		<th width="10%" scope="col"><div align="left">Fecha Rep </div></th>
		<th width="10%" scope="col"><div align="left">Reporte</div></th>
		<th width="9%" scope="col"><div align="left">Origen</div></th>
		<th width="9%" scope="col"><div align="left">Destino</div></th>
		<th width="9%" scope="col">
			<div align="left">Modalidad</div>		</th>
		<th width="36%" scope="col"><div align="left">
			<?
				if( $modo=="expo" ){
					echo "CCNE";
				}else{								
					echo "Proveedor";
					
				}
				
			?>
		</div></th>
		<th width="17%" scope="col"><div align="left">Etapa actual </div></th>
	</tr>
	<?
	$ultReporte = null;
	$numReportes = 0;
	foreach( $reportes as $reporte ){		
		if( !$reporte->esUltimaVersion() ){
			continue;
		}	
		$numReportes++;		
		$ultReporte=  $reporte->getCaIdreporte();	
		$class= $reporte->getColorStatus();		
	?>
	<tr class="<?=$class?>" id="tr_<?=$reporte->getCaIdreporte()?>" onclick="actualizar('<?=$reporte->getCaIdreporte()?>')" style="cursor:pointer">
		<td>
		<div align="left">
			<?=$reporte->getCaFchReporte()?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getOrigen()->getCaCiudad())?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getDestino()->getCaCiudad())?>
		</div></td>
		<td><div align="left">
			<?=$reporte->getCaModalidad()?>
		</div></td>
		<td><?
			if( $modo=="expo" ){
				echo $reporte->getConsignatario();
			}else{	
				echo $reporte->getProveedoresStr();
				
			}
			
			
			?></td>
		<td><div align="left">
			<?
			$etapa = $reporte->getTrackingEtapa();
			if( $etapa ){
				echo $etapa->getCaEtapa();
			}
			?>
		</div></td>
	</tr>
	<tr  style="display:none" id="infotr_<?=$reporte->getCaIdreporte()?>" >
		<td colspan="7"  > 			 
			<?
			include_component("traficos", "infoReporte", array( "reporte"=>$reporte ));
			?>
		</td>
	</tr>
	<?
	}
	?>
</table>
<br />

<div align="left">
	<table width="200" border="1" cellspacing="0" cellpadding="0" class="tableList">
		<tr>
			<th ><b>Convenciones</b></th>		
		</tr>
		<tr>		
			<td>Sin novedad</td>
		</tr>
		<tr class="green">		
			<td>Nuevo Status</td>
		</tr>
		<tr class="yellow">		
			<td >Pendiente por instrucciones</td>
		</tr>		
		<tr class="blue">		
			<td>Carga embarcada</td>
		</tr>		
		<tr class="orange">		
			<td>Carga entregada</td>
		</tr>
		<tr class="purple">		
			<td>Carga en transito terrestre</td>
		</tr>
		<tr class="pink">
			<td>Orden Anulada </td>
		</tr>
	</table>
</div>

</div>

<iframe name="uploadFrame" id="uploadFrame" width="600" height="400" style="display:none"  ></iframe>

<?
if( $numReportes==1 ){
	$idreporte = $ultReporte;
}

if( $idreporte ){
?>
<script language="javascript" type="text/javascript" >
	actualizar( <?=$idreporte?> );

</script>
<?
}
?>

