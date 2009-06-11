<?
if( count($costos)>0 || $editable ){
?>
<table width="800" border="1" id="mainTable">
	<tr>
		<th scope="col">Recargo</th>
		<th scope="col">Tipo</th>
		
		<th scope="col">Neto</th>
		<th scope="col">Valor</th>
		<th scope="col">Minimo</th>
		<th scope="col">Mnd</th>
		<th scope="col">Observaciones</th>
		<th scope="col">&nbsp;</th>
	</tr>
	<?	
	
	
	
	foreach( $costos as $costo ){
	?>
	<tr  style='background:#F0F0F0' >
		<td valign="top" ><b><?=$costo->getCosto()->getCaCosto()?></b></td>
		<td valign="top">
		
		<div id="tipo_<?=$costo->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('tipo_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaTipo()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="tipo_<?=$costo->getOid()?>_div_hd" align="center" style="display:none">		
				
					<?=select_tag("tipo_".$costo->getOid(), options_for_select(array( "$"=>"$", "%25"=>"%"),  $costo->getCaTipo()=="%"?"%25":$costo->getCaTipo()),"onBlur=actualizarGrilla('tipo_".$costo->getOid()."')" )?>
				</div>
				<?
				echo observe_field("tipo_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'catipo='+value",
															) );
			}											
			?>
		</td>			
		<td valign="top">
			<div id="netcosto_<?=$costo->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('netcosto_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaNetcosto()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="netcosto_<?=$costo->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("netcosto_".$costo->getOid(),$costo->getCaNetcosto(), "size=6 onBlur=actualizarGrilla('netcosto_".$costo->getOid()."')")?>	
				</div>
				<?
				echo observe_field("netcosto_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'netcosto='+value",
															) );
			}											
			?>	
		</td>
		<td valign="top">
			<div id="vlrcosto_<?=$costo->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('vlrcosto_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaVlrcosto()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="vlrcosto_<?=$costo->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("vlrcosto_".$costo->getOid(),$costo->getCaVlrcosto(), "size=6 onBlur=actualizarGrilla('vlrcosto_".$costo->getOid()."')")?>	
				</div>
				<?
				echo observe_field("vlrcosto_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'vlrcosto='+value",
															) );
			}											
			?>
		</td>
		<td valign="top">
			<div id="mincosto_<?=$costo->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('mincosto_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaMincosto()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="mincosto_<?=$costo->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("mincosto_".$costo->getOid(),$costo->getCaMincosto(), "size=6 onBlur=actualizarGrilla('mincosto_".$costo->getOid()."')")?>	
				</div>
				<?
				echo observe_field("mincosto_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'mincosto='+value",
															) );
			}											
			?>
		</td>
		<td valign="top">
			<div id="id_moneda_<?=$costo->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('id_moneda_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaIdmoneda()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="id_moneda_<?=$costo->getOid()?>_div_hd" align="center" style="display:none">
					
					<?=select_tag("id_moneda_".$costo->getOid(), objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $costo->getCaIdmoneda()) , "onBlur=actualizarGrilla('id_moneda_".$costo->getOid()."')")?>	
				</div>
				<?
				echo observe_field("id_moneda_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'id_moneda='+value",
															) );
			}											
			?>
		</td>
		<td valign="top" align="left">
			<div id="observaciones_<?=$costo->getOid()?>_div" align="left" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('observaciones_<?=$costo->getOid()?>')"
				<?
				}
				?>
				>
				<?=$costo->getCaDetalles()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="observaciones_<?=$costo->getOid()?>_div_hd" align="left" style="display:none">
					<?=input_tag("observaciones_".$costo->getOid(),$costo->getCaDetalles(), "size=50 onBlur=actualizarGrilla('observaciones_".$costo->getOid()."')")?>	
				</div>
				<?
				echo observe_field("observaciones_".$costo->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeCostos?reporteId='.$reporteNegocio->getCaIdReporte().'&oid='.$costo->getOid()."&token=".md5(time()),
															'with'  => "'observaciones='+value",
															) );
			}											
			?>
		</td>
		<td valign="top">
		<?					
			if( $editable ){					
				echo link_to_remote(image_tag("16x16/delete.gif"), array("url"=>"reportesNeg/eliminarCosto?reporteId=".$reporteNegocio->getCaIdreporte()."&oid=".$costo->getOid()."&token=".md5(time().$costo->getOid()), 
																	"update"=>"costos_colmas" ,
																	"script"=>true,
																	"confirm"=>"Esta seguro que desea eliminar este item?",
																	));
			}
			?>
		</td>
	</tr>
	<?
	}
	if( $editable ){
	?>
	<tr style='background:#F0F0F0' >
		<td><div align="left">
			<?		
			echo form_error("idcosto");	
			echo select_tag("idcosto" ,objects_for_select($conceptos, "getCaIdCosto", "getCaCosto") );			
			?>
		</div></td>
		<td>
			<div align="center">
				<?=form_error("catipo")?>	
				<?=select_tag("catipo", options_for_select(array("$"=>"$", "%"=>"%")) )?>
			</div></td>		
		<td>
			<div align="center">
				<?=form_error("netcosto")?>	
				<?=input_tag("netcosto", null, "size=6 ")?>
			</div></td>
		<td>
			<div align="center">
				<?=form_error("vlrcosto")?>	
				<?=input_tag("vlrcosto", null, "size=6 ")?>
			</div></td>
		<td>
			<div align="center">
				<?=form_error("mincosto")?>
				<?=input_tag("mincosto", null, "size=6 ")?>
			</div></td>
		<td>
			<div align="center">
				<?=form_error("id_moneda")?>
				<?=select_tag("id_moneda", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", "COP") )?>
			</div></td>
		<td><div align="left">
			<?=input_tag('observaciones',null,"size=50")?>
		</div></td>
		<td>
		<?		
		echo submit_tag("Guardar");
		?>		</td>
	</tr>
	<?
	}
	?>
</table>
<?
}else{
?>
<div align="center">
	No se han definido costos
</div>
<?
}
?>