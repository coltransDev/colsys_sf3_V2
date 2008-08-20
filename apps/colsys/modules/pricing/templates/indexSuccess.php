<?
//use_helper("Object");
?>
<script language="javascript" type="text/javascript">
function cambiarTransporte( tipo ){		
		if(tipo=="Aéreo"){
			document.getElementById("tipo_carga_mar").style.display = "none";
			document.getElementById("tipo_carga_aer").style.display = "inline";
			
			document.getElementById("naviera").style.display = "none";
			document.getElementById("aerolinea").style.display = "inline";				
		}
		
		if(tipo=="Marítimo"){			
			document.getElementById("tipo_carga_mar").style.display = "inline";
			document.getElementById("tipo_carga_aer").style.display = "none";
			document.getElementById("naviera").style.display = "inline";
			document.getElementById("aerolinea").style.display = "none";			
		}
		
	}
</script>	

<form action="<?=url_for("pricing/pricingManagement")?>" method="post">

<table cellspacing="1" width="400" class="tableForm">
	<tbody>
		
		<tr>
			<th >Datos b&aacute;sicos del Tr&aacute;fico</th>
		</tr>
		
		<tr>
			<td width="233" class="listar"><strong>Impor/Exportaci&oacute;n:</strong><br />				
					<?=$form['impoexpo']->renderError() ?>
        			<?=$form['impoexpo'] ?>
				</td>
		</tr>
		<tr>
			<td class="listar"><strong>Transporte:</strong><br />
				<?=$form['transporte']->renderError() ?>
        		<?=$form['transporte'] ?>
			</td>
		</tr>
		<tr>
			<td class="listar" >
				<strong>Modalidad:</strong><br />

				<div id='tipo_carga_mar'>
					<?=$form['modalidad_mar']->renderError() ?>
        			<?=$form['modalidad_mar'] ?>
				</div>	
				<div id='tipo_carga_aer'>
					<?=$form['modalidad_aer']->renderError() ?>
        			<?=$form['modalidad_aer'] ?>
										
				</div>			</td>
		</tr>
		<tr>
			<td class="listar"><strong>Origen:</strong><br />
					<?=$form['trafico_id']->renderError() ?>
        			<?=$form['trafico_id'] ?>
			</td>
		</tr>
		<tr>
			<td class="listar">
				<div id='naviera'>
					<strong>Naviera:</strong><br />
					<?=$form['idnaviera']->renderError() ?>
        			<?=$form['idnaviera'] ?>					
				</div>
				<div id='aerolinea'>
					<strong>Aerolinea:</strong><br />	
					<?=$form['idaerolinea']->renderError() ?>
        			<?=$form['idaerolinea'] ?>					
				</div>			</td>
		</tr>
		<tr>
			<td class="listar"><div align="center"><input type="submit" value="Consultar" /></div></td>
		</tr>
	</tbody>
</table>
</form>
<br />



<script language="JavaScript" type="text/javascript">		
	cambiarTransporte( document.getElementById('transporte').value );	
</script>
