<div align="center">
<table width="90%" border="1" class="table1">
	<tr>
		<th width="11%" scope="col">Modalidad</th>
		
		<th width="8%" scope="col">Origen</th>
		<th width="8%" scope="col">Destino</th>
		<th width="19%" scope="col">Proveedor</th>		
		<th width="8%" scope="col">Orden</th>		
		<th width="9%" scope="col">Ref</th>
	</tr>
	<?
	$i=0;
  	foreach($resul as $row){
		/*if( !$reporte->esUltimaVersion() ){
			continue;
		}*/
		$i++;
		
		
		$via = $row["ca_transporte"];
	?>
	<tr class="<?=$class?>"  onClick="document.location='<?=url_for("reportes/detalleReporte?rep=".$row["ca_consecutivo"])?>'" style="cursor:pointer">
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
			echo $row["origen"];
			?>
      </div></td>
		<td><div align="left"  class="info">
			<?
			echo $row["destino"];
			?>
        </div></td>
		<td><div align="left" class="info">
			<?
			echo $row["proveedor"];
			?>
		</div></td>
		
		<td><div align="left" class="info">
			<?=$row["ca_orden_clie"];?>&nbsp;
		</div></td>
		
		<td>
			
			<div align="left" class="info">
			<?= $row["ca_consecutivo"];?>&nbsp;
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

