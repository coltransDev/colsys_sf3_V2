<?
if( count($gastos) || $editable ){
	echo input_hidden_tag("clicked_record_recargos"); 
	if( $reporteNegocio->getCaImpoExpo()=="Exportación" ){
		$origen = " ";
	}else{
		$origen = "en origen";
	}
?>

<script language="javascript">
	function actualizarRecargos(btn, text){        		
		//llamado remoto
		var id = document.getElementById("clicked_record_recargos").value;
		document.getElementById("observacionrec_"+id).value = text;
		<?
		echo remote_function( array('url' => 'reportesNeg/observeRecargos?reporteId='.$reporteNegocio->getCaIdreporte()."&token=".md5(time()), 'update'=>'result2',
															'with'  => "'oid='+id+'&observaciones='+document.getElementById('observacionrec_'+id).value",
															) );	
		?>	
		
    };

	
	function observacionRecargos( id ){
		var observacion = document.getElementById("observacionrec_"+id);
		document.getElementById("clicked_record_recargos").value = id;
		Ext.MessageBox.show({
           title: 'Observaciones',
           msg: 'Por favor coloque las observaciones:',
           width:300,
           buttons: Ext.MessageBox.OKCANCEL,
           multiline: true,
           fn: actualizarRecargos,
           animEl: 'mb3',
		   value: observacion.value
       });

	}
</script>
<div id="result2"></div>
<table width="<?=$tipo=="local"?"600":"800"?>" border="1" id="mainTable">
	<tr>
		<th scope="col">Recargo <?=$tipo!="local"?$origen:"locales"?></th>
		<th scope="col">Concepto</th>
		<th scope="col">Aplicaci&oacute;n</th>
		<th scope="col">Tipo</th>
		<?
		if( $tipo!="local" ){
		?>
		<th scope="col">T.Neta</th>
		<th scope="col">T.M&iacute;n</th>
		<th scope="col">T. Reportar </th>
		<th scope="col">T. Min</th>
		<?
		}
		?>
		<th scope="col">T.Cobrar</th>
		<th scope="col">T. Min</th>
		<th scope="col">Mnd</th>
		<th scope="col">&nbsp;</th>
	</tr>
	<?		
	foreach( $gastos as $gasto ){
	?>
	<tr  style='background:#F0F0F0' >
		<td ><div align="left"><strong>
			<?=$gasto->getTipoRecargo()->getCaRecargo()?>
		</strong></div></td>
		<td ><div align="left"><strong>
			<?=$gasto->getConcepto()->getCaConcepto()?>
		</strong></div></td>
		<td >
			<div id="aplicacion_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('aplicacion_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaAplicacion()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="aplicacion_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">						
					<?=select_tag("aplicacion_".$gasto->getOid(), options_for_select(array("Valor Fijo"=>"Valor Fijo", "Sobre Flete"=>"Sobre Flete", "Unitario x Peso/Volumen"=>"Unitario x Peso/Volumen", "Unitario x Pieza"=>"Unitario x Pieza", "Unitario x Bls/AWBs"=>"Unitario x Bls/AWBs") , $gasto->getCaAplicacion()) , "onBlur=actualizarGrilla('aplicacion_".$gasto->getOid()."')")?>
				</div>
				<?
				echo observe_field("aplicacion_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'aplicacion='+value",
															) );
			}											
			?>		</td>
		<td>
			
			<div id="tipo_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('tipo_<?=$gasto->getOid()?>')"
				<?
				}
				?>
			
			>
				<?=$gasto->getCaTipo()?>
			</div>
			<?
			if( $editable ){
			?>
				<div id="tipo_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">				
					<?=select_tag("tipo_".$gasto->getOid(), options_for_select(array("%25"=>"%", "$"=>"$"), $gasto->getCaTipo()=="%"?"%25":$gasto->getCaTipo() ) , "onBlur=actualizarGrilla('tipo_".$gasto->getOid()."')")?>
				</div>
				<?
				echo observe_field("tipo_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'ca_tipo='+value",
															) );
			}
			?>		</td>
		<?
		if( $tipo!="local" ){
		?>
		<td >
			<div id="neta_tar_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('neta_tar_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaNetatar()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="neta_tar_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("neta_tar_".$gasto->getOid(),$gasto->getCaNetatar(), "size=6 onBlur=actualizarGrilla('neta_tar_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("neta_tar_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'neta_tar='+value",
															) );
			}											
			?>		</td>		
		<td>
			<div id="neta_min_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('neta_min_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaNetamin()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="neta_min_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("neta_min_".$gasto->getOid(),$gasto->getCaNetamin(), "size=6 onBlur=actualizarGrilla('neta_min_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("neta_min_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'neta_min='+value",
															) );
			}											
			?>		</td>
		<td>
			<div id="reportar_tar_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('reportar_tar_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaReportartar()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="reportar_tar_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("reportar_tar_".$gasto->getOid(),$gasto->getCaReportartar(), "size=6 onBlur=actualizarGrilla('reportar_tar_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("reportar_tar_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'reportar_tar='+value",
															) );
			}											
			?>		</td>
		<td>
			<div id="reportar_min_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('reportar_min_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaReportarmin()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="reportar_min_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("reportar_min_".$gasto->getOid(),$gasto->getCaReportarmin(), "size=6 onBlur=actualizarGrilla('reportar_min_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("reportar_min_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'reportar_min='+value",
															) );
			}											
			?>		</td>
		<?
		}
		?>
		<td>
			<div id="cobrar_tar_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cobrar_tar_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=Utils::formatNumber ($gasto->getCaCobrartar(), 3)?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cobrar_tar_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("cobrar_tar_".$gasto->getOid(),$gasto->getCaCobrartar(), "size=6 onBlur=actualizarGrilla('cobrar_tar_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("cobrar_tar_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'cobrar_tar='+value",
															) );
			}											
			?>		</td>
		<td>
			<div id="cobrar_min_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('cobrar_min_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaCobrarmin()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="cobrar_min_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">
					<?=input_tag("cobrar_min_".$gasto->getOid(),$gasto->getCaCobrarmin(), "size=6 onBlur=actualizarGrilla('cobrar_min_".$gasto->getOid()."')")?>	
				</div>
				<?
				echo observe_field("cobrar_min_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'cobrar_min='+value",
															) );
			}											
			?>		</td>
		<td>
			<div id="id_moneda_<?=$gasto->getOid()?>_div" align="center" style="display:inline" 
				<?
				if( $editable ){			
				?>
					onclick="editarGrilla('id_moneda_<?=$gasto->getOid()?>')"
				<?
				}
				?>
				>
				<?=$gasto->getCaIdmoneda()?>
			</div>
			<?
			if( $editable ){			
				?>
				<div id="id_moneda_<?=$gasto->getOid()?>_div_hd" align="center" style="display:none">						
					<?=select_tag("id_moneda_".$gasto->getOid(), objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $gasto->getCaIdmoneda()) , "onBlur=actualizarGrilla('id_moneda_".$gasto->getOid()."')")?>
				</div>
				<?
				echo observe_field("id_moneda_".$gasto->getOid(), array('update'   => '',
															'url'      => 'reportesNeg/observeRecargos?oid='.$gasto->getOid()."&token=".md5(time()),
															'with'  => "'id_moneda='+value",
															) );
			}											
			?>		</td>
		<td>
			<?
				
			if( $editable ){					
				echo link_to_remote(image_tag("16x16/delete.gif"), array("url"=>"reportesNeg/eliminarRecargo?reporteId=".$reporteNegocio->getCaIdreporte()."&oid=".$gasto->getOid()."&tipo=".$tipo."&token=".md5(time().$gasto->getOid()), 
																	"update"=>"recargos_".$tipo ,
																	"script"=>true,
																	"confirm"=>"Esta seguro que desea eliminar este item?",
																	));
				echo input_hidden_tag( "observacionrec_".$gasto->getOid(), $gasto->getCaDetalles() );																	
				echo image_tag("22x22/inline_table.gif", "onclick=observacionRecargos('".$gasto->getOid()."')");
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
			echo form_error("idrecargo");
			echo select_tag("idrecargo" ,objects_for_select($recargos, "getCaIdrecargo", "getCaRecargo", $sf_params->get('idrecargo')) );
			
			?>
			</div></td>
		<td >
			<div align="left">
				<?
			echo form_error("idconcepto");
			echo select_tag("idconcepto" ,options_for_select(array("9999"=>"Igual para todos")).objects_for_select($conceptosSel, "getCaIdconcepto", "getCaConcepto", $sf_params->get('idrecargo')) );
			
			?>
		</div></td>
		<td >
			<div align="center">
				<?=form_error("aplicacion")?>
				<?=select_tag("aplicacion", options_for_select(array("Valor Fijo"=>"Valor Fijo", "Sobre Flete"=>"Sobre Flete", "Unitario x Peso/Volumen"=>"Unitario x Peso/Volumen", "Unitario x Pieza"=>"Unitario x Pieza", "Unitario x Bls/AWBs"=>"Unitario x Bls/AWBs"),$sf_params->get('aplicacion') ) )?>
			</div></td>
		<td ><div align="center">
			<?=form_error("ca_tipo")?>
			<?=select_tag("ca_tipo", options_for_select(array("%"=>"%", "$"=>"$"), $sf_params->get('ca_tipo')) )?>
		</div></td>
		<?
		if( $tipo!="local" ){
		?>
		<td ><div align="center">
			<?=form_error("neta_tar")?>
			<?=input_tag("neta_tar",$sf_params->get('neta_tar'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("neta_min")?>
			<?=input_tag("neta_min", $sf_params->get('neta_min'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("reportar_tar")?>			
			<?=input_tag("reportar_tar", $sf_params->get('reportar_tar'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("reportar_min")?>			
			<?=input_tag("reportar_min", $sf_params->get('reportar_min'), "size=6 ")?>
		</div></td>
		<?
		}
		?>
		<td ><div align="center">
			<?=form_error("cobrar_tar")?>	
			<?=input_tag("cobrar_tar", $sf_params->get('cobrar_tar'), "size=6 ")?>
		</div></td>		
		<td ><div align="center">
			<?=form_error("cobrar_min")?>	
			<?=input_tag("cobrar_min", $sf_params->get('cobrar_min'), "size=6 ")?>
		</div></td>
		<td ><div align="center">
			<?=form_error("id_moneda")?>	
			<?=select_tag("id_moneda", objects_for_select($monedas, "getCaIdmoneda", "getCaIdmoneda", $sf_params->get('cobrar_min')?$sf_params->get('cobrar_min'):"USD") )?>
		</div>		</td>
		<td >
			<?
			if( $tipo=="local" ){
				echo input_hidden_tag("neta_tar",0, "size=6 ");			
				echo input_hidden_tag("neta_min", 0, "size=6 ");			
				echo input_hidden_tag("reportar_tar", 0, "size=6 ");			
				echo input_hidden_tag("reportar_min", 0, "size=6 ");			
			}			
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
	No se han definido recargos <?=$tipo!="local"?"en Origen":"locales"?>
</div>
<?
}
?>