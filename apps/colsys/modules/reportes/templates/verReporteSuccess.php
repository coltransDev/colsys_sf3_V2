<div class="content" align="center">	
	

	<table width='830' cellspacing="1" border="0">
		<tr>
			<td class="partir" style='text-align:center; font-weight:bold; background:#FF0000;' >Favor Imprimir en Tamaño <b>CARTA</b>. Configure su impresora 8,5 x 11 pulg. ó 216 mm x 279 mm</td>
		</tr>
	</table>
	
	<iframe src ='/colsys_php/reporteneg.php?id=<?=$reporte->getCaIdreporte()?>' width='830' height='650' ></iframe>
	<br />
	<br />
	<?
	if( count( $logs )>0  ){
	?>
	<a href="#registro_aperturas" onclick="document.getElementById('registro_aperturas').style.display=''">Ver registro de aperturas</a>
	<div id="registro_aperturas" style="max-height:150px; width:830px; overflow:auto; display:none" >
	<h3>Registro de aperturas</h3>
	<br />
	<table width='800' cellspacing="1" border="0" class="tableList">
		<tr>
			<th width="311" >Usuario </th>
			<th width="270" >Abierto</th>
			
		</tr>
		<?		
		foreach( $logs as $log ){
			$usuario = $log->getUsuario();			
		?>
		<tr>
			<td ><?=Utils::replace($usuario->getCaNombre())?></td>
			<td ><?=Utils::fechaMes($log->getCaFchEvento("Y-m-d"))." ".$log->getCaFchEvento("H:i:s")?></td>
		</tr>
		<?
		}
		?>
	</table>
	<?
	}
	?>
	</div>
	<br>
	
</div>