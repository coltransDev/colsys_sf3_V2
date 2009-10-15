<script language="javascript" type="text/javascript">
	function closeWindow(){
		parent.document.getElementById('find_texts').style.display='none';
		parent.document.body.scroll='yes';  
	}
	
	function incluirInstrucciones(){
		var i=0;
		
		var result = "";
		while( i< <?=count($parametros)?>){ 		
			instrucciones = document.getElementById("instrucciones_"+i);			
			if( instrucciones.checked ){	
				result += instrucciones.value+"\n\n";
				instrucciones.checked = false;			
			}
			i++;					
		}	
		if( parent.document.getElementById('instrucciones').value!="" ){
			parent.document.getElementById('instrucciones').value+="\n";
		}
		parent.document.getElementById('instrucciones').value+=result;
		
		closeWindow();			
	}
	
	
</script>
<div class="content" align="center">
<form name="form1" onSubmit="return false;">
<table width="90%" border="0" class="tableList">
	<tr>
		<th width="91%" scope="col">Textos Predefinidos para el cuadro de Instrucciones Especiales</th>
		<th width="9%" scope="col">Incluir</th>
	</tr>
	<?
	$i=0;
	foreach( $parametros as $parametro){
		
	?>
	<tr>
		<td><div align="left">
			<?=$parametro->getCaValor()?>
		</div></td>
		<td><div align="center">
			<input type="checkbox" value="<?=$parametro->getCaValor()?>" name="instrucciones_<?=$i?>" id="instrucciones_<?=$i?>">
		</div></td>
	</tr>
	<?
		$i++;
	}
	?>
	<tr>
		<td colspan="2">
			<div align="center">
				<input type="button" value="Incluir" class="button" onClick="incluirInstrucciones()" > &nbsp;
				<input type="button" value="Cancelar" class="button" onClick="closeWindow()" >
			</div>
		</td>
	</tr>
</table>
</form>
</div>