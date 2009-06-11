<?

?>
<script language="javascript" type="text/javascript">
	function habilitar( value ){
		
		if( value=="activos" ){
			Ext.getCmp("reporte").disable();
			Ext.getCmp("cliente").enable();			
		}else{			
			Ext.getCmp("reporte").enable();
			Ext.getCmp("cliente").disable();			
		}
	}
	
</script>

<div class="content" align="center" >
	<form action="<?=url_for("traficos/listaStatus?modo=".$modo)?>" method="get" name="form1">
	<table width="50%" border="0" class="tableList">
		<tr>
			<th colspan="2" scope="col"><div align="center"><b>Modulo de status de tr&aacute;ficos </b></div></th>
		</tr>
		<tr>
			<td width="29%"><div align="right"></div></td>
			<td width="71%">
				<div align="left">
					<b>
					<input type="radio" name="ver"  id="ver" value="activos" checked="checked" onclick="habilitar('activos')" />
					Ver reportes activos: </b>
					<?=include_component("widgets", "comboClientes" )?>			
				</div>			</td>
		</tr>
		<tr>
			<td class="row1"><div align="right"></div></td>
			<td class="row1"><div align="left"><b>
				<input type="radio" name="ver" id="ver" value="reporte" onclick="habilitar('reporte')"/>
				Por n&uacute;mero de reporte </b><br />
				<?							
				if( $modo=="maritimo" ){
					$options = array("impoexpo"=> Constantes::IMPO ,
									"transporte"=> Constantes::MARITIMO );	
				}
				
				if( $modo=="aereo" ){
					$options = array("impoexpo"=> Constantes::IMPO ,
									"transporte"=> Constantes::AEREO );	
				}
				
				if( $modo=="expo" ){
					$options = array("impoexpo"=> Constantes::EXPO );	
				}
				
				include_component("widgets", "comboReportes", $options  );
				
				?>
</div></td>
		</tr>
		<tr>
			<td colspan="2"><div align="center">
					<input type="submit" class="button" value="Continuar" />
			</div></td>
		</tr>
	</table>
	</form>
</div>
<script language="javascript" type="text/javascript">
	Ext.onReady(function(){
		var ver = document.form1.ver
		var value='';	
		for (i=0;i<ver.length;i++){
			  if ( ver[i].checked ){
					 value = ver[i].value;
			  }
		} 
	
		habilitar(value);
	});
</script>
