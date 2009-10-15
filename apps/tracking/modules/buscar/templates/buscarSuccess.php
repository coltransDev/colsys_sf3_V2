<div align="center">
<table width="90%" border="1" class="table1">
	<tr>
		<th width="11%" scope="col">Modalidad</th>
		
		<th width="8%" scope="col">Origen</th>
		<th width="8%" scope="col">Destino</th>
		<th width="19%" scope="col">Proveedor</th>
		<th width="9%" scope="col">Linea</th>
		<th width="8%" scope="col">Orden</th>
		<th width="8%" scope="col">ETS </th>
		<th width="8%" scope="col">ETA </th>
		<th width="9%" scope="col">Ref</th>
	</tr>
	<?
	$i=0;
	foreach( $reportes as $reporte ){
		if( !$reporte->esUltimaVersion() ){
			continue;
		}	
		$i++;
		$class= $reporte->getColorStatus();
		
		$via = $reporte->getCaTransporte();
	?>
	<tr class="<?=$class?>"  onClick="document.location='<?=url_for("reportes/detalleReporte?rep=".$reporte->getCaConsecutivo())?>'" style="cursor:pointer">
		<td>			
			<div align="center" class="info">
			  <?
				if( $via =="Aéreo" ){
					echo image_tag("32x32/aer_ico.jpg");
				}
				if( $via =="Marítimo" ){
					echo image_tag("32x32/mar_ico.jpg");
				}
				?>
			</div>
		</td>
		
		<td><div align="left"  class="info"><?
			$origen = $reporte->getOrigen();
			if( $origen ){
				echo $origen->getCaCiudad();
			}
			?>
      </div></td>
		<td><div align="left"  class="info">
			<?
			$destino = $reporte->getDestino();
			if( $destino ){
				echo $destino->getCaCiudad();
			}
			?>
        </div></td>
		<td><div align="left" class="info">
			<?=$reporte->getProveedoresStr()?>
		</div></td>
		<td>
			<div align="left" class="info">
				<?
			$transportador = $reporte->getTransportador();		
			if( $transportador && $reporte->getCaModalidad()!="LCL"  && $reporte->getCaModalidad()!="COLOADING"){												
				echo $transportador->getCaNombre()." ";
			}	
			?>
			</div></td>
		<td><div align="left" class="info">
			<?=$reporte->getCaOrdenClie()?>&nbsp;
		</div></td>
		<td>
			<div align="left" class="info">
			<?=$reporte->getETS()?>&nbsp;			</div></td>
		<td>
			<div align="left" class="info">
			<?=$reporte->getETA()?>&nbsp;			</div></td>
		<td>
			
			<div align="left" class="info">
			<?
			$referencia = null;
			if( $via=="Marítimo" ){
				$referencia = $reporte->getInoClientesSea();
			}
			
			if( $via=="Aéreo" ){				
				$referencia = $reporte->getInoClientesAir();	
			
			}
			
			echo $reporte->getCaConsecutivo();
			if( $referencia ){
				echo "<br />".$referencia->getCaReferencia();
			}
			?>
			</div></td>
	</tr>
	<?
	}
	
	if( $i==0 ){
	?>
	<tr>
		<td colspan="9"><div align="center">No se han encontrado resultados</div></td>
	</tr>	
	<?	
	}
	?>
</table>
</div>

