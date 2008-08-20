<?
if( count($conceptos)>0 || $editable ){
?>
<table width="800" border="1" id="mainTable">
	<tr>
		<th scope="col">Concepto</th>
		<?
		if( $reporteNegocio->getCaTransporte()=="Marítimo" ){
		?>	
		<th scope="col">Cant</th>			
		<?
		}
		?>
		<th scope="col">T.Neta</th>
		<th scope="col">T.M&iacute;n</th>
		<th scope="col">Mnd</th>		
		<th scope="col">T. Reportar </th>
		<th scope="col">T. Min</th>
		<th scope="col">Mnd</th>		
		<th scope="col">T.Cobrar</th>
		<th scope="col">T. Min</th>
		<th scope="col">Mnd</th>
		<th scope="col">&nbsp;</th>
	</tr>
	<?		
	foreach( $conceptos as $concepto ){
	?>
	<tr  style='background:#F0F0F0' >
		<td ><strong><?=$concepto->getConcepto()->getCaConcepto()?></strong></td>	
		<?
		if( $reporteNegocio->getCaTransporte()=="Marítimo" ){
		?>		
		<td >
			<div id="cantidad_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cantidad_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaCantidad()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cantidad_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("cantidad_".$concepto->getOid(),$concepto->getCaCantidad(), "size=6 onBlur=actualizarGrilla('cantidad_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("cantidad_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'cantidad='+value",
															) );
			}											
			?>	
		
		</td>
		<?
		}
		?>
		<td >
			<div id="neta_tar_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('neta_tar_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=Utils::formatNumber($concepto->getCaNetatar())?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="neta_tar_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("neta_tar_".$concepto->getOid(),$concepto->getCaNetatar(), "size=6 onBlur=actualizarGrilla('neta_tar_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("neta_tar_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'neta_tar='+value",
															) );
			}											
			?>		</td>		
		<td>
			<div id="neta_min_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('neta_min_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=Utils::formatNumber( $concepto->getCaNetamin() )?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="neta_min_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("neta_min_".$concepto->getOid(),$concepto->getCaNetamin(), "size=6 onBlur=actualizarGrilla('neta_min_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("neta_min_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'neta_min='+value",
															) );
			}											
			?>	
		</td>
		<td>
		<div id="neta_idm_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('neta_idm_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaNetaIdm()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="neta_idm_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">						
					<?=select_tag("neta_idm_".$concepto->getOid(), objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $concepto->getCaNetaIdm()) , "onBlur=actualizarGrilla('neta_idm_".$concepto->getOid()."')")?>
				</div>
				<?
				echo observe_field("neta_idm_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'neta_idm='+value",
															) );
			}											
			?>		
		</td>
		
		<td>
			<div id="reportar_tar_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('reportar_tar_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaReportartar()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="reportar_tar_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("reportar_tar_".$concepto->getOid(),$concepto->getCaReportartar(), "size=6 onBlur=actualizarGrilla('reportar_tar_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("reportar_tar_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'reportar_tar='+value",
															) );
			}											
			?>	
		</td>
		<td>
			<div id="reportar_min_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('reportar_min_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaReportarmin()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="reportar_min_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("reportar_min_".$concepto->getOid(),$concepto->getCaReportarmin(), "size=6 onBlur=actualizarGrilla('reportar_min_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("reportar_min_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'reportar_min='+value",
															) );
			}											
			?>	
		</td>
		<td>
			<div id="reportar_idm_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('reportar_idm_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaReportarIdm()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="reportar_idm_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">						
					<?=select_tag("reportar_idm_".$concepto->getOid(), objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $concepto->getCaReportarIdm()) , "onBlur=actualizarGrilla('reportar_idm_".$concepto->getOid()."')")?>
				</div>
				<?
				echo observe_field("reportar_idm_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'reportar_idm='+value",
															) );
			}											
			?>
		</td>
		
		<td>
			<div id="cobrar_tar_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cobrar_tar_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaCobrartar()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cobrar_tar_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("cobrar_tar_".$concepto->getOid(),$concepto->getCaCobrartar(), "size=6 onBlur=actualizarGrilla('cobrar_tar_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("cobrar_tar_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'cobrar_tar='+value",
															) );
			}											
			?>	
		</td>
		<td>
		<div id="cobrar_min_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cobrar_min_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaCobrarmin()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cobrar_min_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("cobrar_min_".$concepto->getOid(),$concepto->getCaCobrarmin(), "size=6 onBlur=actualizarGrilla('cobrar_min_".$concepto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("cobrar_min_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'cobrar_min='+value",
															) );
			}											
			?>	
		</td>
		<td>
			<div id="cobrar_idm_<?=$concepto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cobrar_idm_<?=$concepto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$concepto->getCaCobrarIdm()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cobrar_idm_<?=$concepto->getOid()?>_div_hd" align="center" style="display:none">						
					<?=select_tag("cobrar_idm_".$concepto->getOid(), objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $concepto->getCaCobrarIdm()) , "onBlur=actualizarGrilla('cobrar_idm_".$concepto->getOid()."')")?>
				</div>
				<?
				echo observe_field("cobrar_idm_".$concepto->getOid(), array('update'   => '',
															'url'      => 'reportes/observeConceptos?reporteId='.$reporteNegocio->getCaIdreporte().'&oid='.$concepto->getOid()."&token=".md5(time()),
															'with'  => "'cobrar_idm='+value",
															) );
			}											
			?>
		</td>
		<td>
			<?
				
			if( $editable ){					
				echo link_to_remote(image_tag("16x16/delete.gif"), array("url"=>"reportes/eliminarConcepto?reporteId=".$reporteNegocio->getCaIdreporte()."&oid=".$concepto->getOid()."&token=".md5(time().$concepto->getOid()), 
																	"update"=>"embarque" ,
																	"script"=>true,
																	"confirm"=>"Esta seguro que desea eliminar este item?",
																	));
			}
			?></td>
	</tr>
	<?
	}
	if( $editable ){
	?>
	<tr style='background:#F0F0F0' >
		<td >
			
			<div align="left">
				<?
			echo form_error("idconcepto");
			echo select_tag("idconcepto" ,objects_for_select($conceptosSel, "getCaIdconcepto", "getCaConcepto", $sf_params->get('idrecargo')) );
			
			?>
			</div></td>
		<?
		if( $reporteNegocio->getCaTransporte()=="Marítimo" ){
		?>	
		<td >
			<div align="center">
				<?=form_error("cantidad")?>
				<?=input_tag("cantidad", $sf_params->get('cantidad'), "size=8 '")?>
			</div></td>
		<?
		}
		?>
		<td ><div align="center">
			<?=form_error("neta_tar")?>
			<?=input_tag("neta_tar",$sf_params->get('neta_tar'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("neta_min")?>
			<?=input_tag("neta_min", $sf_params->get('neta_min'), "size=6 ")?>
		</div></td>
		<td ><?=form_error("neta_idm")?>
		<?=select_tag("neta_idm", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $sf_params->get('neta_idm')?$sf_params->get('neta_idm'):"USD") )?></td>		
		<td ><div align="center">
			<?=form_error("reportar_tar")?>			
			<?=input_tag("reportar_tar", $sf_params->get('reportar_tar'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("reportar_min")?>			
			<?=input_tag("reportar_min", $sf_params->get('reportar_min'), "size=6 ")?>
		</div></td>
		<td ><?=form_error("reportar_idm")?>
			<?=select_tag("reportar_idm", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $sf_params->get('reportar_idm')?$sf_params->get('reportar_idm'):"USD") )?></td>
		
		<td ><div align="center">
			<?=form_error("cobrar_tar")?>	
			<?=input_tag("cobrar_tar", $sf_params->get('cobrar_tar'), "size=6 ")?>
		</div></td>		
		<td ><div align="center">
			<?=form_error("cobrar_min")?>	
			<?=input_tag("cobrar_min", $sf_params->get('cobrar_min'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("cobrar_idm")?>	
			<?=select_tag("cobrar_idm", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $sf_params->get('cobrar_idm')?$sf_params->get('cobrar_idm'):"USD") )?>
		</div>		</td>
		<td >
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
	No se han definido conceptos de embarque
</div>
<?
}
?>