<?
use_helper("Object");
?>
<script language="javascript" type="text/javascript">
function cambiarTransporte( tipo ){
		if(tipo=="Aéreo"){
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "inline";
			document.getElementById("tipo_carga_ter").style.display = "none";					
		}
		
		if(tipo=="Marítimo"){			
			document.getElementById("tipo_carga_mar").style.display = "inline";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "none";			
		}
		
		if(tipo=="Terrestre"){				
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("tipo_carga_ter").style.display = "inline";			
		}
	}
</script>	

<?=form_tag("pricing/pricingManagement")?>

<table cellspacing="1" width="580" class="tableForm">
	<tbody>
		<tr>
			<th colspan="3">Datos b&aacute;sicos del Tr&aacute;fico</th>
		</tr>
		<tr>
			<td width="133"><center>
				<strong>Impor/Exportaci&oacute;n :</strong><br />
				<center>
					<select  name="impoexpo">
						<option value="Importaci&oacute;n" selected="selected">Importaci&oacute;n</option>
						<option value="Exportaci&oacute;n">Exportaci&oacute;n</option>
					</select>
				</center>
			</center></td>
			<td width="144"><strong>Transporte :</strong><br />
				<center>
					<?=select_tag("transporte", options_for_select(array("A&eacute;reo"=>"A&eacute;reo", "Mar&iacute;timo"=>"Mar&iacute;timo", "Terrestre"=>"Terrestre"  ) ), "onChange='cambiarTransporte(this.value)'")?>
				</center></td>
			<td><center>
				<center>
					<strong>Modalidad :</strong><br />
					<center>
						<div id='tipo_carga_mar'>
						<?
						echo select_tag("modalidad_mar", objects_for_select($subModMar, "getCaValor", "getCaValor") );
						?>
					</div>	
					<div id='tipo_carga_aer'>
						<?
						echo select_tag("modalidad_aer", objects_for_select($subModAer, "getCaValor", "getCaValor") );
						?>
					</div>	
					<div id='tipo_carga_ter'>
						<?
						echo select_tag("modalidad_ter", objects_for_select($subModTer, "getCaValor", "getCaValor") );
						?>
					</div>	
					</center>
				</center>
			</center></td>
		</tr>
		<tr>
			<th colspan="3">Ciudad de Origen</th>
		</tr>
		<tr>
			<td colspan="2"><?=select_tag( "trafico_id", objects_for_select( $traficos, "getId", "getCaNombre") );
?></td>
			<td width="291">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3"><div align="center"><?=submit_tag("Consultar")?></div></td>
		</tr>
		
	</tbody>
</table>
</form>
<br />

<script language="JavaScript" type="text/javascript">		
	cambiarTransporte( document.getElementById('transporte').value );
	
</script>


