<?
use_helper("Javascript");
?>



<script language="javascript">
	
	function actualizar( id ){
		<?
		//No se usa remote_function debido a que no se le puede pasar el id del objeto dinamicamente
		?>
		new Ajax.Updater('info_'+id, "<?=url_for('traficos/infoReporte')?>", {asynchronous:true, evalScripts:true, onComplete:function(request, json){new Effect.Fade('indicator', {});new Effect.BlindDown('info_'+id, {duration:0.3}); }, onLoading:function(request, json){new Effect.Appear('indicator', {});}, parameters:'reporteId='+id});
		
		var tabla = document.getElementById( 'lista' );
		var trs = tabla.getElementsByTagName( 'div' );
			
		for( i = 0 ; i<trs.length ;i++){			
			if(  trs[i].id.substr(0,5)=='info_' ){	
				if( trs[i].id != 'info_'+id ){													
					if( trs[i].style.display!="none" ){
						new Effect.BlindUp(trs[i].id, {duration:.3});
						
					}					
				}
			}		
		}								
	}
</script>
<div align="center">

<strong><?=Utils::replace( isset($cliente)?$cliente->getCacompania():"" )?></strong>
</div>
<br />
<table width="100%" border="1" class="tableList" id="lista">
	<tr>
		<th scope="col"><div align="left">Fecha Rep </div></th>
		<th scope="col"><div align="left">Reporte</div></th>
		<th scope="col"><div align="left">Origen</div></th>
		<th scope="col"><div align="left">Destino</div></th>
		<th scope="col">
			<div align="left">
			<?
				if( $modo=="expo" ){
					echo "CCNE";
				}else{
					if($ver=="reporte"){
						echo "Cliente";
					}else{					
						echo "Proveedor";
					}
				}
				
			?>
			</div>		</th>
		<th scope="col">Incoterms</th>
		<th scope="col"><div align="left">Etapa actual </div></th>
	</tr>
	<?
	foreach( $reportes as $reporte ){
		if( !$reporte->esUltimaVersion() ){
			continue;
		}
		
		
		 
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
			<?=Utils::replace($reporte->getOrigen())?>
		</div></td>
		<td><div align="left">
			<?=Utils::replace($reporte->getDestino())?>
		</div></td>
		<td><div align="left">
			<?
			if( $modo=="expo" ){
				echo $reporte->getConsignatario();
			}else{	
				if($ver=="reporte"){			
					echo $reporte->getCliente();
				}else{
					echo $reporte->getProveedor();
				}
			}
			
			
			?>
		</div></td>
		<td><?
			$array = explode("|",$reporte->getCaIncoterms());
			$array = array_unique( $array );
			$incoterms = implode(" ", $array );
			echo $incoterms;
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
	<tr >
		<td colspan="7"  > 
			<div style="display:none" id="info_<?=$reporte->getCaIdreporte()?>" >
			<?
			//include_component("traficos", "infoReporte", array( "idReporte"=>$reporte->getCaIdreporte() ))
			?>
			</div>		</td>
	</tr>
	<?
	}
	?>
</table>
<br />

<div align="left">
	<table width="200" border="1" cellspacing="0" cellpadding="0" class="tableList">
		<tr>
			<td ><strong>Leyenda</strong></td>		
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

